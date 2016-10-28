<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property integer $level
 * @property string $letter
 */
class Region extends \yii\db\ActiveRecord {

    public static function tableName() {
        return '{{%region}}';
    }

    public function rules() {
        return [
            [['parent_id', 'name'], 'required'],
            [['parent_id', 'level'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['letter'], 'string', 'max' => 1],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => '主键',
            'parent_id' => '父级',
            'name' => '名称',
            'level' => '层级',
            'letter' => '首字母',
        ];
    }

    public static function find() {
        return new RegionQuery(get_called_class());
    }

    public static function province() {
        $models = Region::findAll(['parent_id' => 1]);
        return ArrayHelper::map($models, 'id', 'name');
    }

    public static function city($provinceId = 0) {
        if (0 == $provinceId)
            return [];
        $models = Region::findAll(['parent_id' => $provinceId]);
        return ArrayHelper::map($models, 'id', 'name');
    }

    public static function district($cityId = 0) {
        if (0 == $cityId)
            return [];
        $models = Region::findAll(['parent_id' => $cityId]);
        return ArrayHelper::map($models, 'id', 'name');
    }
}
