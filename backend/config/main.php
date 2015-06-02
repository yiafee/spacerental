<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
    
);

require(__DIR__ . '/default_values_for_widgets.php');

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','app\base\settings'],
    'modules' => [
        'rbac' => [
            'class' => 'mdm\admin\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'homeUrl' => '/foodtruck/admin',
    'components' => [
        'request' => [
            'baseUrl' => '/foodtruck/admin',
            'enableCsrfValidation' => false,
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
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                  'name' => '_backendUser', // unique for backend
                  'path'=>'/foodtruck/admin'  // correct path for the backend app.
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/foodtruck/frontend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,

        ],
        /*'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],*/
        /*'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/basic'],
                'baseUrl' => '@web/themes/basic',
            ],
        ],*/
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'admin/*','site/logout','site/forgot_password','site/reset_password' // add or remove allowed actions to this list
        ]
    ],
    'params' => $params,
    'vendorPath' => dirname(__DIR__).'/../vendor',
];
