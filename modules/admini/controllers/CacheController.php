<?php

/**
 * 管理模块
 * 缓存操作控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\controllers;

use Yii;
use yii\web\Controller;

class CacheController extends Controller
{
    /**
     * ①、刷新表结构缓存
     * ②、
     *
     */
    public function actionClear()
    {
        Yii::$app->db->schema->refresh();
    }
}