<?php

namespace frontend\controllers;

use common\models\tables\Comments;
use common\models\tables\TaskChat;
use common\models\tables\TaskProjects;
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

        $model = new TaskProjects();
        $query = TaskProjects::find();

        // подготавливаем датапровайдер для списка проектов (листвью)
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }


    public function actionProject($project_id = null)
    {

        $model = new Tasks();

        if ($project = \Yii::$app->request->post('TaskProjects')) {
            // если новый проект
            $modelProject = new TaskProjects();
            $modelProject->name = $project['name'];
            $modelProject->save();

            return $this->render('project', [
                'model' => $model,
                'modelProject' => $modelProject,
            ]);

        } else {
            $modelProject = TaskProjects::findOne($project_id);
            $query = Tasks::find()->where(['project_id' => $project_id]);
            // подготавливаем датапровайдер для списка тасков (листвью)
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $this->render('project', [
                'model' => $model,
                'modelProject' => $modelProject,
                'dataProvider' => $dataProvider
            ]);
        }

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
            $project = TaskProjects::findOne($model->project_id);
            // подгружаем историю чата
            $history = TaskChat::find()->where(['task_id' => $id])->all();

            //Если создаем таск
        } else {
            $model = new Tasks();
            $projectId = \Yii::$app->request->get('project-id');
            $project = TaskProjects::findOne($projectId);
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
            'project' => $project,
        ]);

    }


    public function actionSave($id = null)
    {
        // если изменяем таск
        if ($id) {

            if ($model = Tasks::findOne($id)) {
                $model->load(\Yii::$app->request->post());
                $model->save();
//                \Yii::$app->session->setFlash('success', "Изменения сохранены!");
            }
//            else {
//                \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения!");
//            }


            // если создаем таск
        } else {
            $model = new Tasks();

            $model->load(\Yii::$app->request->post()) && $model->save();
//            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
//                \Yii::$app->session->setFlash('success', "Задача создана!");
//            } else {
//                \Yii::$app->session->setFlash('error', "Не удалось создать задачу!");
//            }

        }

//        $this->redirect(\Yii::$app->request->referrer);
        return $this->renderAjax('_form', [
            'model' => $model,
            'usersList' => User::getUsersList(),
            'statusesList' => TaskStatuses::getTasksList(),
//            'userId' => \Yii::$app->user->id,

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

            $comment->save();
//            if ($comment->save()) {
//                \Yii::$app->session->setFlash('success', "Комментарий добавлен");
//            } else {
//                \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
//            }

        }
//        else {
//            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
//        }


//        $this->redirect(\Yii::$app->request->referrer);
        $model = Tasks::findOne($comment->task_id);
        return $this->renderAjax('_comments', [
            'model' => $model,
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new Comments(),
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
        $attachment->save();
//        if ($attachment->save()) {
//            \Yii::$app->session->setFlash('success', "Файл добавлен");
//        } else {
//            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
//        }
//        $this->redirect(\Yii::$app->request->referrer);
        $model = Tasks::findOne($attachment->taskId);
        return $this->renderAjax('_attachments', [
            'model' => $model,
            'taskAttachmentsForm' => new TaskAttachmentsAddForm(),
        ]);
    }


}