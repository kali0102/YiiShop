<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%spec}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $sort
 *
 * @property SpecValue[] $specValues
 */
class Spec extends \yii\db\ActiveRecord {

    public $values;

    const TYPE_TEXT = 1;
    const TYPE_IMAGE = 2;

    public static $types = [
        self::TYPE_TEXT => '文字',
        self::TYPE_IMAGE => '图片'
    ];


    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%spec}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'name'], 'required'],
            [['type', 'sort'], 'integer'],
            ['values', 'safe'],
            [['name'], 'string', 'max' => 64],
            ['type', 'in', 'range' => [1, 2]],
            ['sort', 'default', 'value' => 0],
            //[['type'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '主键',
            'type' => '类型',
            'name' => '名称',
            'values' => '规格值',
            'sort' => '排序',
        ];
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getType() {
//        return $this->hasOne(Type::className(), ['id' => 'type']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecValues() {
        return $this->hasMany(SpecValue::className(), ['spec_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SpecQuery the active query used by this AR class.
     */
    public static function find() {
        return new SpecQuery(get_called_class());
    }

    public static function showValues($values) {
        $content = '';
        if (count($values) == 0)
            return $content;
        foreach ($values as $v)
            $content .= $v->name . ',';
        return substr($content, 0, -1);
    }
}
