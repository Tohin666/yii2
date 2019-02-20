<?php

namespace frontend\controllers;

use common\models\tables\Tasks;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class ApiTaskController extends ActiveController
{
    // переопределяем поведения, чтобы добавить BasicAuth
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentificator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function ($username, $password) {
                $user = User::findByUsername($username);
                if ($user !== null && $user->validatePassword($password)) {
                    return $user;
                }
                return null;
            },
        ];
        return $behaviors;
    }


    // переопределяем $modelClass, чтобы указать с активрекордом какого класса данному контроллеру работать.
    public $modelClass = Tasks::class;


    // переопределяем actionIndex
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    // переопределяем чтобы самим обрабатывать фильтры
    public function actionIndex()
    {
        // front.yii2/api-tasks?filter[month]=2&filter[project_id]=1&filter[responsible_id]=1&filter[status]=2
        $filter = \Yii::$app->request->get('filter');
        $query = Tasks::find();
        if ($filter) {
            // если есть фильтр по месяцам: filter[month]
            if ($filter['month']) {
                $query->where(['MONTH(date)' => $filter['month']]);
                unset($filter['month']);
            }

            // сработает на все остальные запросы: filter[responsible_id]&filter[status]&filter[project_id]
            $query->filterWhere($filter);
        }
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}