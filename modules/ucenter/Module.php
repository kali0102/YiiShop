<?php

/**
 * 用户中心模块
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\ucenter;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\ucenter\controllers';

    public function init()
    {
        parent::init();
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $rote = $action->controller->id . '/' . $action->id;
            $allowPages = ['signin/index', 'signin/captcha'];
            if (in_array($rote, $allowPages))
                return true;
            if (\Yii::$app->user->isGuest)
                \Yii::$app->user->loginRequired();
            return true;
        } else
            return false;
    }
}
