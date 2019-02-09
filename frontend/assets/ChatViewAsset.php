<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ChatViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/chat.js'
    ];
    public $depends = [
    ];

}