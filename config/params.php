<?php

return [
    'adminEmail' => 'admin@example.com',
    'wechat' => [
        'debug' => true,
        'app_id' => 'wx892a02d1637db0ab',
        'secret' => 'f29e568ea0bdbacd00e4ec35ef029f21',
        'token' => 's97xBKPd12ghw6RHUy49CmyyQ54eWa',
        'payment' => [
            'merchant_id' => '',
            'key' => '8i2Q9np324ghjB47yKjh9dMw3yTxy5O2',
            'cert_path' => '/www/web/YiiShop/data/apiclient_cert.pem',
            'key_path' => '/www/web/YiiShop/data/apiclient_key.pem'
        ],
        'log' => [
            'level' => 'debug',
            'file' => (__DIR__) . '/../runtime/wechat.log'
        ]
    ]
];
