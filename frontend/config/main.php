<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','MyGlobalClass'],
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/foodtruck',
    'components' => [
        'MyGlobalClass'=>[
            'class'=>'app\components\GlobalClass'
         ],
        'request' => [
            'baseUrl' => '/foodtruck',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                  'name' => '_frontendUser', // unique for backend
                  'path'=>'/foodtruck'  // correct path for the backend app.
              ]
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'shimul@dcastalia.com',
                'password' => 'happy008',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        /*'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/web/themes/in-the-mountains'],
                'baseUrl' => '@web/themes/in-the-mountains',
            ],
        ],*/
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => array(
                'user/<action:\w+>/<type:(\w|\-)+>' => 'user/<action>',
                'landowner/<action:\w+>/<id:\d+>/<title:(\w|\ |\-)+>' => 'landowner/<action>'
            ),
        ],
        'urlManagerBackEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/foodtruck/backend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
    ],
    'params' => $params,
    'vendorPath' => dirname(__DIR__).'/../vendor',
];
