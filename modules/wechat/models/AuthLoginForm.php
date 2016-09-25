<?php

namespace app\modules\wechat\models;

use Yii;
use yii\base\Model;
use app\models\User;

class AuthLoginForm extends Model
{

    public $openid;

    public function rules()
    {
        return [['openid', 'required']];
    }

    public function login()
    {
        if ($this->validate())
            return Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
        return false;
    }

    public function getUser()
    {
        return User::findByOpenid($this->openid);
    }
}
