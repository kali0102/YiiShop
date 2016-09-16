<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%type}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Spec[] $specs
 */
class Type extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '主键',
            'name' => '名称',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecs() {
        return $this->hasMany(Spec::className(), ['type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TypeQuery the active query used by this AR class.
     */
    public static function find() {
        return new TypeQuery(get_called_class());
    }

    public static function lists() {
        $models = self::find()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
}
