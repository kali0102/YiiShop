<?php

/**
 * 微信模块
 * 微信与用户交互控制器
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\wechat\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use EasyWeChat\Foundation\Application;

class InteractiveController extends Controller
{

    public $enableCsrfValidation = false;

    /**
     * 事件、消息、处理
     * @throws \EasyWeChat\Core\Exceptions\InvalidArgumentException
     */
    public function actionIndex()
    {
        $options = Yii::$app->params['wechat'];
        $request = Yii::$app->request;

        // 签名验证
        if (!$request->isPost)
            return $this->_checkSignature($request, $options);

        $app = new Application($options);
        $server = $app->server;
        $server->setMessageHandler(function ($message) use ($app) {
            switch ($message->MsgType) {
                case 'event':
                    return $this->_eventProcess($app, $message);
                    break;
                default:
                    break;
            }
        });
        $server->serve()->send();
    }

    /**
     * 事件处理
     * @param $app
     * @param $message
     */
    private function _eventProcess($app, $message)
    {
        switch ($message->Event) {
            case 'subscribe': // 订阅
                $user = $app->user;
                $userInfo = $user->get($message->FromUserName);
                User::subscribe($userInfo, $message);
                break;
        }
    }

    /**
     * 签名验证
     * @param $request
     * @param $options
     */
    private function _checkSignature($request, $options)
    {
        if (empty($_GET))
            exit;
        $echoStr = $request->get('echostr');
        $signature = $request->get('signature');
        $timestamp = $request->get('timestamp');
        $nonce = $request->get('nonce');
        $token = $options['token'];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature)
            echo $echoStr;
    }

}