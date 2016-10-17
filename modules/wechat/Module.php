<?php

/**
 * 微信模块
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\wechat;

class Module extends \yii\base\Module
{

    public $layout = 'main';
    public $controllerNamespace = 'app\modules\wechat\controllers';

    public function init()
    {
        parent::init();
    }
}
