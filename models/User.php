<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $mobile
 * @property string $email
 * @property integer $sex
 * @property string $realname
 * @property string $nickname
 * @property string $avatar
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $street
 * @property integer $register_type
 * @property integer $login_time
 * @property string $login_ip
 * @property integer $logins
 * @property integer $register_time
 *
 * @property Address[] $addresses
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'province_id', 'city_id', 'district_id', 'register_type', 'login_time', 'logins', 'register_time'], 'integer'],
            [['username', 'email', 'realname', 'nickname', 'login_ip'], 'string', 'max' => 64],
            [['password', 'avatar', 'street'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'password' => '密码',
            'mobile' => '手机号码',
            'email' => '邮箱',
            'sex' => '性别',
            'realname' => '真名',
            'nickname' => '昵称',
            'avatar' => '头像',
            'province_id' => '省份',
            'city_id' => '城市',
            'district_id' => '区县',
            'street' => '街道详情',
            'register_type' => '注册类型（1网站、2微信、3app）',
            'login_time' => '最近登录时间',
            'login_ip' => '最近登录IP',
            'logins' => '登录次数',
            'register_time' => '注册时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
