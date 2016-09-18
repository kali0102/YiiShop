<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $thumb
 * @property integer $level
 * @property integer $sort
 */
class Category extends ActiveRecord {

    public static function tableName() {
        return '{{%category}}';
    }

    public function rules() {
        return [
            [['name', 'thumb'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['parent_id', 'sort'], 'integer'],
            [['parent_id', 'sort'], 'default', 'value' => 0],
            ['thumb', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024]
        ];
    }

    public function attributeLabels() {
        return [
            'id' => '主键',
            'parent_id' => '父级',
            'name' => '名称',
            'thumb' => '缩略图',
            'level' => '层级',
            'sort' => '排序',
        ];
    }

    public static function find() {
        return new CategoryQuery(get_called_class());
    }

    public static function lists() {
        $models = self::find()->select(['id', 'name'])->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
}
