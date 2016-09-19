<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%address}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $receiver
 * @property string $mobile
 * @property string $zipcode
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $street
 * @property integer $default
 *
 * @property User $user
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'receiver', 'mobile', 'zipcode', 'province_id', 'city_id', 'district_id', 'street'], 'required'],
            [['user_id', 'province_id', 'city_id', 'district_id', 'default'], 'integer'],
            [['receiver'], 'string', 'max' => 64],
            [['mobile'], 'string', 'max' => 11],
            [['zipcode'], 'string', 'max' => 6],
            [['street'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'user_id' => '用户ID',
            'receiver' => '收货人',
            'mobile' => '手机号码',
            'zipcode' => '邮编',
            'province_id' => '省份',
            'city_id' => '城市',
            'district_id' => '区县',
            'street' => '街道详情',
            'default' => '默认',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return AddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AddressQuery(get_called_class());
    }
}
