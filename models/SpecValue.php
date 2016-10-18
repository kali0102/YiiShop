<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%spec_value}}".
 *
 * @property string $id
 * @property string $spec_id
 * @property string $name
 * @property string $thumb
 * @property integer $sort
 */
class SpecValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%spec_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spec_id', 'name', 'thumb', 'sort'], 'required'],
            [['spec_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['thumb'], 'string', 'max' => 128],
            [['spec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spec::className(), 'targetAttribute' => ['spec_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'spec_id' => '所属规格',
            'name' => '名称',
            'thumb' => '缩略图',
            'sort' => '排序',
        ];
    }

    /**
     * @inheritdoc
     * @return SpecValueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpecValueQuery(get_called_class());
    }
}
