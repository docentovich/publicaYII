<?php

switch ($_SERVER['SERVER_NAME']) {
    case  TOSEE_DEV:
    case  TOSEE_PROD:
        $domain_params = require "main-tosee.php";
        break;
    case PROBANK_DEV:
    case PROBANK_PROD :
        $domain_params = require "main-probank.php";
        break;

}

$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'name' => 'Publica',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => 'messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'post*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => 'messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app/post' => 'post.php',
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'dirMode' => 0777,
        ]
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['components']['assetManager']['forceCopy'] = true;
}
return yii\helpers\ArrayHelper::merge($domain_params, $config);
