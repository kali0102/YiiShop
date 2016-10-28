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
 * @property string $openid
 *
 * @property Address[] $addresses
 * @property Region $province
 * @property Region $city
 * @property Region $district
 */
class User extends ActiveRecord implements IdentityInterface
{

    const REGISTER_TYPE_WEB = 1;
    const REGISTER_TYPE_SUBSCRIBE = 2;

    const SEX_SECRECY = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    public static $sexList = [
        self::SEX_MALE => '男',
        self::SEX_FEMALE => '女',
        self::SEX_SECRECY => '保密'
    ];

    public static $registerTypeList = [
        self::REGISTER_TYPE_WEB => '网站',
        self::REGISTER_TYPE_SUBSCRIBE => '扫码关注'
    ];

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
            [['username', 'mobile', 'password'], 'required', 'on' => 'register'],
            [['username', 'mobile'], 'unique', 'on' => 'register']
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
            'register_type' => '注册类型',//（1网站、2微信、3app）
            'login_time' => '最近登录时间',
            'login_ip' => '最近登录IP',
            'logins' => '登录次数',
            'register_time' => '注册时间',
            'openid' => 'OPENID'
        ];
    }

    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['user_id' => 'id']);
    }

    public function getProvince()
    {
        return $this->hasOne(Region::className(), ['id' => 'province_id']);
    }

    public function getCity()
    {
        return $this->hasOne(Region::className(), ['id' => 'city_id']);
    }

    public function getDistrict()
    {
        return $this->hasOne(Region::className(), ['id' => 'district_id']);
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * 用户手机注册
     * @return bool
     */
    public function register()
    {
        if (!$this->isNewRecord)
            return false;

        $this->register_time = time();
        $this->register_type = self::REGISTER_TYPE_WEB;
        $this->setPassword($this->password);

        if (!$this->save())
            return false;

        return true;
    }

    /**
     * 通过 手机号码|用户名 查找用户
     * @param $username
     * @return null|static
     */
    public static function findByUsername($username)
    {
        $usernameWhere = ['username' => $username];
        $mobileWhere = ['mobile' => $username];
        $user = self::find()->where($usernameWhere)->orWhere($mobileWhere)->one();
        if (null == $user)
            return null;
        return new static($user);
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

    /**
     * 验证密码
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * 加密密码
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * 通过微信openid查找用户
     * @param $openid
     * @return null|static
     */
    public static function findByOpenid($openid)
    {
        $user = self::find()->where(['openid' => $openid])->one();
        if ($user)
            return new static($user);
        return null;
    }

    /**
     * 用户扫码订阅
     * 解析用户行为
     * 创建用户账号
     * @param $userInfo
     * @param $message
     * @throws \yii\db\Exception
     */
    public static function subscribe($userInfo, $message)
    {
        $where = ['openid' => $userInfo->openid];
        $exists = self::find()->where($where)->exists();
        if (false == $exists) {
            $user['openid'] = $userInfo->openid;
            $user['register_time'] = $message->CreateTime;
            $user['register_type'] = self::REGISTER_TYPE_SUBSCRIBE;
            Yii::$app->db->createCommand()->insert('{{%user}}', $user)->execute();
        }
    }

    /**
     * 基本信息
     * @return string
     */
    public function nameText()
    {
        $avatar = $this->avatar ? $this->avatar : '/static/images/avatar.png';

        $string = '<div class="media">';
        $string .= '<a class="media-left" href="javascript:;" target="_blank">';
        $string .= '<img src="' . $avatar . '" style="width: 64px; height: 64px;" />';
        $string .= '</a>';
        $string .= '<div class="media-body">';
        $string .= '<h5 class="media-heading">' . $this->username . '</h5>';
        $string .= '<h6><i>' . $this->mobile . '</i></h6>';
        $string .= '</div></div>';
        return $string;
    }

    /**
     * 登录信息
     * @return string
     */
    public function loginText()
    {
        $string = '<h6><small>' . date('Y/m/d H:i', $this->login_time) . '</small></h6>';
        $string .= '<h6><small>' . $this->login_ip . '</small></h6>';
        return $string;
    }

    /**
     * 区域信息
     * @return string
     */
    public function areaText()
    {
        $province = isset($this->province) ? $this->province->name : '';
        $city = isset($this->city) ? $this->city->name : '';
        $district = isset($this->district) ? $this->district->name : '';
        return $province . ($city ? ('/' . $city) : '') . ($district ? ('/' . $district) : '');
    }
}
