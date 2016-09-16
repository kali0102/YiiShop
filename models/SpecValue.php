<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%spec_value}}".
 *
 * @property integer $id
 * @property integer $spec_id
 * @property string $name
 *
 * @property Spec $spec
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
            [['spec_id', 'name'], 'required'],
            [['spec_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpec()
    {
        return $this->hasOne(Spec::className(), ['id' => 'spec_id']);
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
