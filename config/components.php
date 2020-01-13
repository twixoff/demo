<?php

return [
    'request' => [
        'baseUrl' => '',
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'jdjhdhfgunduskshddhdnc',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'app\modules\user\models\User',
        'enableAutoLogin' => true,
        'loginUrl' => ['user/default/login'],
    ],
    'authManager' => [
        'class' => 'yii\rbac\PhpManager',
    ],    
    'errorHandler' => [
        'errorAction' => 'main/default/error',
    ],
//    'cart' => [
//        'class' => 'yz\shoppingcart\ShoppingCart',
//        'cartId' => 'cart',
//    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_MailTransport',
        ],
//        'transport' => [
//            'class' => 'Swift_SmtpTransport',
//            'host' => 'smtp.mail.ru',
//            'username' => '',
//            'password' => '',
//            'port' => '465',
//            'encryption' => 'ssl',
//        ],
    ],
//    'i18n' => [
//        'translations' => [
//            'app*' => [
//                'class' => 'yii\i18n\PhpMessageSource',
//                //'basePath' => '@app/messages',
////                'sourceLanguage' => 'en-US',
//                'fileMap' => [
//                    'app' => 'app.php',
////                        'app/error' => 'error.php',
//                ],
//            ],
//            'modules/admin/*' => [
//                'class' => 'yii\i18n\PhpMessageSource',
//                'sourceLanguage' => 'en-US',
//                'basePath' => '@app/modules/admin/messages',
//                'fileMap' => [
//                    'modules/admin/backend' => 'backend.php',
//                ],
//            ]
//        ],
//    ],
    'page' => [
        'class' => 'app\components\Page',
    ],
//        'lang' => [
//            'class' => 'app\components\Language',
//            'queryParam' => 'lang',
//        ],
    'assetManager' => [
        'class' => 'yii\web\AssetManager',
        'bundles' => [
            'yii\web\JqueryAsset' => [
                'js' => [
                    YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                ]
            ],
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [
                    YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                ]
            ],
            'yii\bootstrap\BootstrapPluginAsset' => [
                'js' => [
                    YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                ]
            ]
        ],
    ],
    'assetsAutoCompress' => [
//        'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
        'class' => 'app\components\CustomAssetsAutoCompressComponent',
//        'enabled' => !YII_DEBUG,
        'enabled' => false,
//        'cssFileCompile' => true
    ],
    'urlManager' => require(__DIR__ . '/routes.php'),
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db' => require(__DIR__ . '/db.php')
];