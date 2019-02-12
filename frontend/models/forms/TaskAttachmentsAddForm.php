<?php

namespace frontend\models\forms;

use common\models\tables\TaskAttachments;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * для загрузки файлов создали отедльную форму чтобы активрекорд этим не занимался, и чтобы не перегружать контроллер
 */
class TaskAttachmentsAddForm extends Model
{
    public $taskId;
    /** @var UploadedFile */
    public $file; // атрибут в который мы будем подгружать данные о загруженном файле (это будет экземпляр UploadedFile)

    protected $originalDir = '@img/tasks/';
    protected $copieslDir = '@img/tasks/small/';

    protected $filename;
    protected $filepath;

    protected $model;

    public function rules()
    {
        return [
            [['taskId', 'file'], 'required'],
            [['taskId'], 'integer'],
            [['file'], 'file', 'extensions' => ['jpg', 'png']],
        ];
    }

    public function save()
    {
        // проверяем что соответствует правилам указанным выше
        if ($this->validate()) {
            // сохраняем файл
            $this->saveUploadedFile();
            // сохраняем уменьшенную копию
            $this->createMinCopy();
            // сохраняем модель
            return $this->saveData();
        }
        return false;
    }

    protected function saveUploadedFile()
    {
        // формируем имя файла
        $this->filename = \Yii::$app->getSecurity()->generateRandomString(12)
            . "." . $this->file->getExtension();
        $this->filepath = \Yii::getAlias("{$this->originalDir}{$this->filename}");
        // и сохраняем в заданную папку с картинками
        $this->file->saveAs($this->filepath);
    }

    protected function createMinCopy()
    {
        // чтобы создать уменьшенную копию обращаемся к классу имедж именно из yii\imagine
        Image::thumbnail($this->filepath, 100, 100)
            ->save(\Yii::getAlias("{$this->copieslDir}{$this->filename}"));
    }

    protected function saveData()
    {
        // вызываем активрекорд
        $this->model = new TaskAttachments([
            // передаем ей данные
            'task_id' => $this->taskId,
            'path' => $this->filename,
        ]);
        // и сохраняем
        return $this->model->save();
    }
}