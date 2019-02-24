<?php

namespace frontend\modules\v2api\controllers;

use common\models\tables\Tasks;
use common\models\User;
use frontend\modules\v2api\models\filters\ApiTaskFilter;
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
            // отключили, чтобы сделать аутентификацию через токен.
//            'auth' => function ($username, $password) {
//                $user = User::findByUsername($username);
//                if ($user !== null && $user->validatePassword($password)) {
//                    return $user;
//                }
//
//                return null;
//            },
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

        $filter = \Yii::$app->request->get('filter');

        // вынес фильтр в отедльную модель:
        $dataProvider = ApiTaskFilter::filter($filter);

        return $dataProvider;
    }

}