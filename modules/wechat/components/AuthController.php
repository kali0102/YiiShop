<?php

/**
 * 微信模块
 * 授权认证父类控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\wap\components;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;

class AuthController extends Controller
{

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $options = Yii::$app->params['wechat'];
            $options['oauth']['scopes'] = ['snsapi_base'];
            $target = Url::to(['/wechat/' . $this->id . '/' . $this->action->id]);
            $callback = Url::to(['/wechat/callback', 'target' => $target]);
            $options['oauth']['callback'] = $callback;
            $app = new Application($options);
            $app->oauth->redirect()->send();
        }
        return parent::beforeAction($action);
    }

}