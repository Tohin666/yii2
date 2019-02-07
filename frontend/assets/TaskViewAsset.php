<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class TaskViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/taskView.css'
    ];
    public $js = [
//        'js/alertButton.js'
    ];
    // указываем зависимости, чтобы подключалось после них
    public $depends = [
//        JqueryAsset::class,
//        'yii\web\JqueryAsset',
    ];

}