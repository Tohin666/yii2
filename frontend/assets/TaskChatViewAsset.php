<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class TaskChatViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/taskChat.js'
    ];
    public $depends = [
    ];

}