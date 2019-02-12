<?php

namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller
{
    public function actionIndex()
    {
        $authManager = \Yii::$app->authManager;

        // createRole пока еще не записывает в базу данных, а создает объекты
        $admin = $authManager->createRole('admin');
        $moder = $authManager->createRole('moderator');

        // теперь добавляем в базу, в таблицу auth_item добавятся роли
        $authManager->add($admin);
        $authManager->add($moder);


        // создаем разрешения (операции, ограничения)
        $permissionTaskCreate = $authManager->createPermission('TaskCreate');
        $permissionTaskDelete = $authManager->createPermission('TaskDelete');
        $permissionTaskEdit = $authManager->createPermission('TaskEdit');

        // и добавляем в базу, в таблицу auth_item добавятся разрешения
        $authManager->add($permissionTaskCreate);
        $authManager->add($permissionTaskDelete);
        $authManager->add($permissionTaskEdit);


        // привязываем разрешения к ролям, добавятся связи в таблицу auth_item_child
        $authManager->addChild($admin, $permissionTaskCreate);
        $authManager->addChild($admin, $permissionTaskDelete);
        $authManager->addChild($admin, $permissionTaskEdit);

        $authManager->addChild($moder, $permissionTaskCreate);
        $authManager->addChild($moder, $permissionTaskEdit);


        // назначаем роли пользователям,
        // айдишники он потом берет из компонента юзерс - айдишник текущего залогиненного пользователя
        $authManager->assign($admin, 1);
        $authManager->assign($moder, 2);
//        $authManager->assign($moder, 3);
    }

    public function actionAddUser()
    {
        $auth = \Yii::$app->authManager;

        $permission = $auth->getPermission('TaskCreate');

        $user = $auth->createRole('user');

        $auth->add($user);
        $auth->addChild($user, $permission);

        $auth->assign($user, 3);
    }

}