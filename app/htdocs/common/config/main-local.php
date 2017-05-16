<?php
return [
    'components' => [

        'mailer' => [
             'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@common/mail',
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.mailtrap.io',
                    'username' => '19c6e4ea034778',
                    'password' => '929b6ae9dbc93e',
                    'port' => '2525',
                    'encryption' => 'tls',
                ],
        ],
    ],

    "modules" => [
        'debug' => [
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.*.*'],
        ],
        'gii' => [
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.*.*'],
        ]
    ]
];