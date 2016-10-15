<?php

/**
 * console 配置
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

$configs = [];
$configs['id'] = 'console';
$configs['basePath'] = dirname(__DIR__);
$configs['bootstrap'] = ['log'];
$configs['controllerNamespace'] = 'app\commands';

// 组件 -------------------------------------------------------------------------------------------------------------
$configs['components']['cache'] = ['class' => 'yii\caching\FileCache'];
$configs['components']['db'] = require(__DIR__ . '/database.php');
$configs['components']['log'] = [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
        ],
    ],
];

// 参数变量 ---------------------------------------------------------------------------------------------------------
$configs['params'] = require(__DIR__ . '/params.php');

return $configs;
