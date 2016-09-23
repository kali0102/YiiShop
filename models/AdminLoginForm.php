<?php

/**
 * 管理模块
 * 登录模型类
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\models;

use Yii;
use yii\base\Model;

class AdminLoginForm extends Model
{

    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;
    private $_user = false;


    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['captcha', 'captcha', 'captchaAction' => 'admini/signin/captcha'],
        ];
    }


    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }


    public function login()
    {
        if ($this->validate())
            return Yii::$app->admin->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 60);
        return false;
    }


    public function getUser()
    {
        if ($this->_user === false)
            $this->_user = Admin::findByUsername($this->username);
        return $this->_user;
    }
}
