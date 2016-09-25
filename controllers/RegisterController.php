<?php

/**
 * 会员注册控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RegisterForm;

class RegisterController extends Controller
{
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = New RegisterForm;
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->register())
            return Yii::$app->user->loginRequired();

        echo $this->render('index', compact('model'));
    }
}
