<?php

/**
 * 管理模块
 * 登录模型类
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\modules\admini\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{

    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;
    private $_user = false;

    public function rules()
    {
        return [
            // 不需要输入验证码
            [['username', 'password'], 'required'],
            // 需输入验证码
            [['username', 'password', 'captcha'], 'required', 'on' => ['captchaRequired']],
            ['captcha', 'captcha', 'captchaAction' => 'admini/signin/captcha', 'on' => ['captchaRequired']],
            // 通用规则
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'captcha' => '验证码'
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '错误的用户名或密码.');
            }
        }
    }


    public function login()
    {
        if ($this->validate())
            return Yii::$app->admin->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 60);
        else {
            $counter = Yii::$app->session->get('captchaRequired', 0) + 1;
            Yii::$app->session->set('captchaRequired', $counter);
            return false;
        }
    }


    public function getUser()
    {
        if ($this->_user === false)
            $this->_user = Admin::findByUsername($this->username);
        return $this->_user;
    }
}
