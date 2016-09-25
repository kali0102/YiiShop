<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
class User extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['sex', 'province_id', 'city_id', 'district_id', 'register_type', 'login_time', 'logins', 'register_time'], 'integer'],
            [['username', 'email', 'realname', 'nickname', 'login_ip'], 'string', 'max' => 64],
            [['password', 'avatar', 'street'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 11],

            // 手机注册
            [['mobile', 'password'], 'required', 'on' => 'register'],
            ['mobile', 'unique', 'on' => 'register']
        ];
    }

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

    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id']);
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    // 注册
    public function register()
    {
        if (!$this->isNewRecord)
            return false;

        $this->register_time = time();
        $this->register_type = 1;
        $this->setPassword($this->password);

        if (!$this->save())
            return false;

        return true;
    }

    public static function findByUsername($username)
    {
        $user = self::find()->where(['mobile' => $username])->one();
        if ($user)
            return new static($user);
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }


}
