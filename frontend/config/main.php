<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'v2api' => [
            'class' => 'frontend\modules\v2api\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => '.yii2'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
//        'view' => [
//            'theme' => [
//                'basePath' => '@app/themes/23F',
//                'baseUrl' => '@web/themes/23F',
//                'pathMap' => [
//                    '@app/views' => '@app/themes/23F',
//                ],
//            ]
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
//                'GET messages' => 'message/index',
//                'POST messages' => 'message/create',
//                'GET messages/<id>' => 'message/view',
//                'PATCH messages/<id>' => 'message/update',
//                'DELETE messages/<id>' => 'message/delete',
                // все вышеописанное заменяет эта строчка:
                ['class' => 'yii\rest\UrlRule', 'controller' => 'message'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api-task'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v2api/api-task'],
            ],
        ],
    ],
    'params' => $params,
];
