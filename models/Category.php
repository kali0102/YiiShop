<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $thumb
 * @property integer $sort
 */
class Category extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'thumb'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            ['parent_id', 'default', 'value' => 0],
            [['name'], 'string', 'max' => 64],
            [['thumb'], 'string', 'max' => 128],
            ['thumb', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '主键',
            'parent_id' => '父级',
            'name' => '名称',
            'thumb' => '缩略图',
            'sort' => '排序',
        ];
    }

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find() {
        return new CategoryQuery(get_called_class());
    }

    public static function lists() {
        $models = self::find()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
}
