<?php

//return [
//    'adminEmail' => 'admin@example.com',
//    //--------------------------------------------------------------
//    // 公众号相关配置
//    // 1.基本配置交互地址
//    // 2.接口权限、网页授权获取用户基本信息、配置地址
//    // 3.公众号设置、业务域名配置、JS接口安全域名配置
//    // 4.微信支付、开发配置、地址配置
//    'wechat' => [
//        'debug' => true,
//        'app_id' => 'wx892a02d1637db0ab',
//        'secret' => 'f29e568ea0bdbacd00e4ec35ef029f21',
//        'token' => 's97xBKPd12ghw6RHUy49CmyyQ54eWa',
//        'payment' => [
//            'merchant_id' => '1302521001',
//            'key' => '8i2Q9np324ghjB47yKjh9dMw3yTxy5O2',
//            'cert_path' => '/www/web/YiiShop/data/apiclient_cert.pem',
//            'key_path' => '/www/web/YiiShop/data/apiclient_key.pem'
//        ],
//        'log' => [
//            'level' => 'debug',
//            'file' => (__DIR__) . '/../runtime/wechat.log'
//        ],
//        'guzzle' => [
//            'timeout' => 3.0, // 超时时间（秒）
//            'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
//        ],
//    ]
//];

$params = [];

// 管理员邮箱
$params['adminEmail'] = 'admin@example.com';

// 微信公众号
$params['wechat']['debug'] = true;
$params['wechat']['app_id'] = 'wx892a02d1637db0ab';
$params['wechat']['secret'] = 'f29e568ea0bdbacd00e4ec35ef029f21';
$params['wechat']['token'] = 's97xBKPd12ghw6RHUy49CmyyQ54eWa';
$params['wechat']['payment']['merchant_id'] = '1302521001';
$params['wechat']['payment']['key'] = '8i2Q9np324ghjB47yKjh9dMw3yTxy5O2';
$params['wechat']['payment']['cert_path'] = '/www/web/YiiShop/data/apiclient_cert.pem';
$params['wechat']['payment']['key_path'] = '/www/web/YiiShop/data/apiclient_key.pem';
$params['wechat']['log']['level'] = 'debug';
$params['wechat']['log']['file'] = (__DIR__) . '/../runtime/wechat.log';
$params['wechat']['guzzle']['timeout'] = 3.0;
$params['wechat']['guzzle']['verify'] = false;

return $params;
