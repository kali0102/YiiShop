<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%attribute_value}}".
 *
 * @property string $id
 * @property string $attribute_id
 * @property string $name
 * @property integer $sort
 */
class AttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attribute_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'name'], 'required'],
            [['attribute_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'attribute_id' => '属性',
            'name' => '名称',
            'sort' => '排序',
        ];
    }

    /**
     * @inheritdoc
     * @return AttributeValueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttributeValueQuery(get_called_class());
    }
}
