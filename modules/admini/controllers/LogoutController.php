<?php
/**
 * 管理模块
 * 退出控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use Yii;
use yii\web\Controller;

class LogoutController extends Controller
{

    public function actionIndex()
    {
        Yii::$app->admin->logout();
        return $this->goHome();
    }
}