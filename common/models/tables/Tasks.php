<?php

namespace common\models\tables;

use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $date
 * @property string $description
 * @property int $responsible_id
 * @property int $status
 * @property int $project_id
 *
 * @property string $created_at
 * @property string $updated_at
 * @property int $administrator_id
 *
 * @property User $users
 * @property User $administrator
 * @property Comments[] $comments
 * @property TaskAttachments[] $taskAttachments
 * @property TaskStatuses $statusName
 */
class Tasks extends ActiveRecord
{
    // добавляем поведение для добавления временных меток в таблицу при изменении или создании записи.
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime (для MySQL):
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date'], 'required'],
            [['date'], 'safe'],
            [['description'], 'string'],
            [['responsible_id', 'administrator_id', 'status', 'project_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
//            'title' => Yii::t("main", "TaskTitle"),
//            'date' => Yii::t("main", "TaskDate"),
//            'description' => Yii::t("main", "TaskDescription"),
//            'responsible_id' => Yii::t("main", "TaskResponsible"),
//            'status' => Yii::t("main", "TaskStatus"),

            'id' => 'ID',
            'title' => "Title",
            'date' => "Date",
            'description' => "Description",
            'responsible_id' => "Responsible",
            'status' => "Status",
            'project_id' => "Project",
            'created_at' => "CreateDate",
            'updated_at' => "UpdateDate",
            'administrator_id' => "Administrator",
        ];
    }


    // геттер. при запросе ответственного привяжет его имя по айди. название метода немного не правильное?.
    // getResponsible
    public function getUsers()
    {
        return $this->hasOne(User::class, ["id" => "responsible_id"]);

    }

    public function getAdministrator()
    {
        return $this->hasOne(User::class, ["id" => "administrator_id"]);

    }


    public function getComments()
    {
        return $this->hasMany(Comments::class, ["task_id" => "id"]); // ключ - куда ссылается, значение - атрибут
        // текущего класса
    }

    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::class, ["task_id" => "id"]); // ключ - куда ссылается, значение - атрибут
        // текущего класса
    }

    public function getStatusName()
//    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::class, ["id" => "status"]); // ключ - куда ссылается, значение - атрибут
        // текущего класса
    }
}
