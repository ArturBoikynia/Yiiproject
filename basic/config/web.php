<?php
use app\components\RememberUri;
use app\models\User;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'language'],
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'name' => 'MyCMS',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@photos'   => __DIR__ . '/../photos',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'cJQu3thHy9Sdfs_2EpbzdCsodKpWECWp',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => require __DIR__  . '/i18n.php',
        'authManager' => require __DIR__  . '/authManager.php',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],

        'language' => \app\components\web\LanguageComponent::class,

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => '/users/index'
            ],
        ],
    ],
    'modules' => [
        'admin' => [
        'class' => mdm\admin\Module::class,
        'layout' => '@app/views/layouts/main.php',
        ],
        'comment' => [
            'class' => \yii2mod\comments\Module::class,
        ]
    ],
    'as access' => [
        'class' => mdm\admin\components\AccessControl::class,
        'allowActions' => [
            'site/*',
//            'admin/*',
            'programminglanguages/*',
            'users/*',
            'menu/*',
            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'params' => $params,

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;

