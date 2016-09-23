<?php

namespace app\commands;

use yii\console\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {
        $path = \Yii::$app->runtimePath;
        $file = $path . '/recd.txt';
        @file_put_contents($file, (date("Y/m/d H:i:s")) . PHP_EOL, FILE_APPEND);
    }
}