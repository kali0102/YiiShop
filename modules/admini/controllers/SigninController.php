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
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\AdminLoginForm;

class SigninController extends Controller
{

    public $layout = 'main-login';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 34,
                'minLength' => 3,
                'maxLength' => 4,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        if (!Yii::$app->admin->isGuest)
            return $this->goHome();

        $model = new AdminLoginForm;
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->login())
            return $this->goBack();

        return $this->render('index', compact('model'));
    }


}
