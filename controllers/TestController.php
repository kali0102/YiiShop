<?php
/**
 * Created by PhpStorm.
 * User: kalil
 * Date: 2016/9/23
 * Time: 14:07
 */

namespace app\controllers;


use yii\web\Controller;
use yii2tech\crontab\CronTab;

class TestController extends Controller
{
    public function actionIndex()
    {

        $cronTab = new CronTab();
        $cronTab->setJobs([
            ['line' => '* * * * * /usr/local/php5/bin/php /www/web/YiiShop/yii test']
        ]);
        $cronTab->apply();
    }
}