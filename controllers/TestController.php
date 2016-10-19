<?php
/**
 * Created by PhpStorm.
 * User: kalil
 * Date: 2016/9/23
 * Time: 14:07
 */

namespace app\controllers;


use yii\web\Controller;
use yii\web\Cookie;
use yii2tech\crontab\CronTab;

class TestController extends Controller
{
    public function actionIndex()
    {

//        $cronTab = new CronTab();
//        $cronTab->setJobs([
//            ['line' => '* * * * * /usr/local/php5/bin/php /www/web/YiiShop/yii test']
//        ]);
//        $cronTab->apply();

        $cookies = \Yii::$app->request->cookies;
        $fruit = $cookies->get('fruit');
        echo $fruit;
    }

    public function actionTest()
    {
        $cookies = \Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => 'fruit',
            'value' => 'orange'
        ]));

        echo 'set ok';
    }
}