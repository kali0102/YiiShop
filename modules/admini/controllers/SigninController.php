<?php

/**
 * 管理模块
 * 登录控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\admini\models\LoginForm;

class SigninController extends Controller
{

    public $layout = 'main-login';
    public $attempts = 1;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 34,
                'minLength' => 3,
                'maxLength' => 4,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    // 登录
    public function actionIndex()
    {
        if (!Yii::$app->admin->isGuest)
            return $this->goHome();

        // 实例
        if ($this->_captchaRequired()) {
            $model = new LoginForm;
            $model->scenario = 'captchaRequired';
        } else
            $model = new LoginForm;

        // 提交
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->login())
            return $this->goBack();

        return $this->render('index', compact('model'));
    }


    /**
     * 验证用户名及密码输入的错误次数
     * @return bool
     */
    private function _captchaRequired()
    {
        return Yii::$app->session->get('captchaRequired', 0) >= $this->attempts;
    }

}
