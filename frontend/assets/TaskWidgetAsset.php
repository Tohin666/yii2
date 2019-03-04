<?php

namespace frontend\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;

class TaskWidgetAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/taskWidget.css'
    ];
    public $js = [
    ];
    public $depends = [
        BootstrapAsset::class,
        AppAsset::class,
    ];

}