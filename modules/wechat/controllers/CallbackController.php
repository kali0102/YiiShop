<?php

/**
 * 微信模块
 * 授权登录控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\wap\controllers;

use Yii;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;
use app\modules\wechat\models\AuthLoginForm;

class CallbackController extends Controller
{
    public function actionIndex()
    {
        $options = Yii::$app->params['wechat'];
        $app = new Application($options);
        $user = $app->oauth->user();
        $openid = $user->getId();
        $avatar = $user->getAvatar();
        $nickname = $user->getNickname();

        $model = new AuthLoginForm;
        $model->openid = $openid;
        if ($model->login())
            return $this->redirect([$_GET['target']]);

        Yii::$app->end();
    }
}