<?php

namespace backend\controllers;

use backend\models\filters\TasksSearch;
use common\models\tables\Tasks;
use common\models\tables\TaskStatuses;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        // получаем доступ к компоненту
//        $cache = \Yii::$app->cache;

        // ключ по которому данные будут лежать в кэше
//        $key = 'task';
        // чтобы для каждого таска создавался свой кэш, добавляем к имени ключа айдишник. Иначе для всех тасков будет
        // открываться последний закэшированный таск.
//        $key = 'task_' . $id;


//        // получаем данные по ключу, если они там есть
//        if ($cache->exists($key)){
//            $task = $cache->get($key);
//        } else {
//            // если данных в кэше нет, то получаем их и сохраняем в кэш
//            $task = $this->findModel($id);
//            $cache->set($key, $task, 60);
//        }


        // Создаем зависимость, чтобы при каких-то изменениях в базе данных сбрасывался кэш.
//        $dependency = new DbDependency();
//        // Кэш будет сбрасываться при изменении количества строк в таблице.
//        $dependency->sql = "SELECT COUNT(*) FROM tasks";
//
//
//        // При зависимости он обнуляет значение по ключу, но сам ключ остается, поэтому перепишем условие
//        if (!$task = $cache->get($key)){
//            // если данных в кэше нет под данному ключу, то получаем их и сохраняем в кэш под данному ключу
//            $task = $this->findModel($id);
//            $cache->set($key, $task, 200, $dependency);
//        }


//        return $this->render('view', [
//            'model' => $task,
//        ]);
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);


        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', [
            'model' => $model,
            // получаем и передаем дополнительно наш список пользователей в шаблон
            // create,а там еще раз передаем в шаблон _form
            'userList' => User::getUsersList(),
            'statusList' => TaskStatuses::getStatuses(),
        ]);
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            // получаем и передаем дополнительно наш список пользователей в шаблон
            // create,а там еще раз передаем в шаблон _form
            'userList' => User::getUsersList(),
            'statusList' => TaskStatuses::getStatuses(),
        ]);
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
