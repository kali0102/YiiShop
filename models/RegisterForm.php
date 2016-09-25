<?php

/**
 * 注册表单模型类
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 */

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{

    public $mobile;
    public $captcha;
    public $password;
    public $smsCode;

    public function rules()
    {
        return [
            [['mobile', 'password', 'captcha'], 'required'],
            ['mobile', 'unique', 'targetClass' => User::className()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'mobile' => '手机号码',
            'smsCode' => '手机验证码',
            'captcha' => '图形码',
            'password' => '设置密码'
        ];
    }

    public function register()
    {
        if (!$this->validate())
            return false;

        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);
        if (!$user->register())
            return false;

        return true;
    }

    protected function loadAttributes(User $user)
    {
        $user->setAttributes($this->attributes);
    }


}