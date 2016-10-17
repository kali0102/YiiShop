<?php

namespace app\modules\wechat\controllers;

use Yii;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $options = \Yii::$app->params['wechat'];

        $app = new Application($options);
        $js = $app->js;

        return $this->render('index', [
            'js' => $js
        ]);
    }
}
