<?php

namespace app\modules\admini\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $mobile
 * @property string $email
 * @property integer $sex
 * @property string $avatar
 * @property string $realname
 * @property integer $status
 * @property string $logins
 * @property string $login_time
 * @property string $login_ip
 * @property string $create_time
 * @property string $update_time
 */
class Admin extends ActiveRecord implements IdentityInterface
{

    const SEX_SECRECY = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    public static $sexList = [
        self::SEX_SECRECY => '保密',
        self::SEX_MALE => '男',
        self::SEX_FEMALE => '女'
    ];

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public static $statusList = [
        self::STATUS_DISABLE => '禁用',
        self::STATUS_ENABLE => '启用'
    ];

    public static function tableName()
    {
        return '{{%admin}}';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['sex', 'status'], 'integer'],
            [['username', 'email', 'realname'], 'string', 'max' => 64],
            [['password', 'avatar'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 11],
            [['login_ip'], 'string', 'max' => 32],
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
            'sex' => '性别',//（0保密、1男、2女）
            'avatar' => '头像',
            'realname' => '真名',
            'status' => '状态',//（0禁用、1启用）
            'logins' => '登录次数',
            'login_time' => '最近登录时间',
            'login_ip' => '最近登录IP',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    public static function find()
    {
        return new AdminQuery(get_called_class());
    }

    public static function findByUsername($username)
    {
        $user = self::find()->where(['username' => $username])->one();
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->setPassword($this->password);
                $this->create_time = $this->update_time = time();
            } else
                $this->update_time = time();
            return true;
        }
        return false;
    }
}
