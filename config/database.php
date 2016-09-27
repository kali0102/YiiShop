<?php

return [
    'class' => 'yii\db\Connection',
    'schemaCache' => 'cache',
    'enableSchemaCache' => YII_DEBUG,
    'schemaCacheDuration' => 3600 * 7,
    'dsn' => 'mysql:host=127.0.0.1;dbname=yiishop',
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8',
    'tablePrefix' => 'tb_'
];
