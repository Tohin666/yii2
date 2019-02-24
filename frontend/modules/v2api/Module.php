<?php

namespace frontend\modules\v2api;

/**
 * v2api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\v2api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Отсключаем сессии для авторизации через апи.
        // Отключаем здесь а не в конфиге, чтобы обычная авторизация через веб не отвалилась.
        \Yii::$app->user->enableSession = false;
    }
}
