<?php

/**
 * db 配置
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

$db = [];
$db['class'] = 'yii\db\Connection';
$db['schemaCache'] = 'cache';
$db['enableSchemaCache'] = YII_DEBUG;
$db['schemaCacheDuration'] = 3600 * 7;
$db['dsn'] = 'mysql:host=127.0.0.1;dbname=yiishop';
$db['username'] = 'root';
$db['password'] = '123456';
$db['charset'] = 'utf8';
$db['tablePrefix'] = 'tb_';

return $db;