<?php

namespace frontend\controllers;

use common\models\tables\Comments;
use common\models\tables\TaskChat;
use common\models\tables\Tasks;
use common\models\tables\TaskStatuses;
use common\models\User;
use frontend\models\forms\TaskAttachmentsAddForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class TaskController extends Controller
{

    public function actionIndex()
    {

        if ($post = \Yii::$app->request->post()) {
            // если делаем фильтр по месяцам
            $query = Tasks::find()->where(['YEAR(date)' => $post['year'], 'MONTH(date)' => $post['month']]);

        } else {
            $query = Tasks::find();
        }

        // подготавливаем датапровайдер для списка тасков (листвью)
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);

    }


    public function actionView($id = null)
    {
//        // проверяем, может ли пользователь редактировать таски
//        if (!\Yii::$app->user->can('TaskEdit')) {
//            throw new ForbiddenHttpException();
//        }


        // Если открываем таск
        if ($id) {
            $model = Tasks::findOne($id);
            // подгружаем историю чата
            $history = TaskChat::find()->where(['task_id' => $id])->all();
            //Если создаем таск
        } else {
            $model = new Tasks();
            $history = null;
        }

        // в любом случае открываем таск, только в первом случае он будет заполнен, а во втором пустой.
        return $this->render('view', [
            'model' => $model,
            'usersList' => User::getUsersList(),
            'statusesList' => TaskStatuses::getTasksList(),
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new Comments(),
            'taskAttachmentsForm' => new TaskAttachmentsAddForm(),
            'history' => $history,
        ]);

    }


    public function actionSave($id = null)
    {
        // если изменяем таск
        if ($id) {

            if ($model = Tasks::findOne($id)) {
                $model->load(\Yii::$app->request->post());
                $model->save();
                \Yii::$app->session->setFlash('success', "Изменения сохранены!");
            } else {
                \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения!");
            }


            // если создаем таск
        } else {
            $model = new Tasks();

            if ($model->load(\Yii::$app->request->post()) && $model->save()) {

                // если отправлены данные и они успешно приняты, то перенаправляем назад.
                \Yii::$app->session->setFlash('success', "Задача создана!");

            } else {
                \Yii::$app->session->setFlash('error', "Не удалось создать задачу!");
            }

        }

//        $this->redirect(\Yii::$app->request->referrer);
        return $this->render('view', [
            'model' => $model,
            'usersList' => User::getUsersList(),
            'statusesList' => TaskStatuses::getTasksList(),
            'userId' => \Yii::$app->user->id,

        ]);

    }


    public function actionAddComment()
    {

        $comment = new Comments();

        if ($comment->load(\Yii::$app->request->post())) {

//            if ($file = UploadedFile::getInstance($model, 'photo')) {
//                $uploadModel = new Upload();
//                $uploadModel->file = $file;
//                $filename = $uploadModel->upload();
//                $model->photo = $filename;
//            }

            if ($comment->save()) {
                \Yii::$app->session->setFlash('success', "Комментарий добавлен");
            } else {
                \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
            }

        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }


//        $this->redirect(\Yii::$app->request->referrer);
        $model = Tasks::findOne($comment->task_id);
        return $this->render('view', [
            'model' => $model,
            'usersList' => User::getUsersList(),
            'statusesList' => TaskStatuses::getTasksList(),
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new Comments(),
            'taskAttachmentsForm' => new TaskAttachmentsAddForm(),
        ]);

    }


    public function actionAddAttachment()
    {
        // для загрузки файлов создали отедльную форму чтобы активрекорд этим не занимался, и чтобы не перегружать
        // контроллер
        $attachment = new TaskAttachmentsAddForm();
        // получаем TaskId
        $attachment->load(\Yii::$app->request->post());
        // отдельно загружаем файл
        $attachment->file = UploadedFile::getInstance($attachment, 'file');
        // метод сейв прописали в модели TaskAttachmentsAddForm
        if ($attachment->save()) {
            \Yii::$app->session->setFlash('success', "Файл добавлен");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
        }
//        $this->redirect(\Yii::$app->request->referrer);
        $model = Tasks::findOne($attachment->taskId);
        return $this->render('view', [
            'model' => $model,
            'usersList' => User::getUsersList(),
            'statusesList' => TaskStatuses::getTasksList(),
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new Comments(),
            'taskAttachmentsForm' => new TaskAttachmentsAddForm(),
        ]);
    }


}