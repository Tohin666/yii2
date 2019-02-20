<?php

namespace frontend\controllers;

use common\models\tables\Message;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class MessageController extends ActiveController
{
    // переопределяем поведения, чтобы добавить BasicAuth
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentificator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function($username, $password) {
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
    public $modelClass = Message::class;


//    // переопределяем actionIndex
//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['index']);
//        return $actions;
//    }
//    // переопределяем чтобы самим обрабатывать фильтры
//    public function actionIndex()
//    {
//        $filter = \Yii::$app->request->get('filter');
//        $query = Message::find();
//        if ($filter) {
//            $query->filterWhere($filter);
//        }
//        return new ActiveDataProvider([
//            'query' => $query
//        ]);
//    }

}