<?php

namespace frontend\modules\v2api\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v2api` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
