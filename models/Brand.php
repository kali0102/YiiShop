<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property string $id
 * @property string $name
 * @property string $thumb
 * @property string $letter
 * @property integer $sort
 * @property integer $category_id
 */
class Brand extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'thumb', 'letter'], 'required'],
            [['sort'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['thumb'], 'string', 'max' => 128],
            [['letter'], 'string', 'max' => 1],
            ['sort', 'default', 'value' => 0],
            ['thumb', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '主键',
            'name' => '名称',
            'thumb' => '缩略图',
            'letter' => '首字母',
            'sort' => '排序',
            'category_id' => '所属分类'
        ];
    }

    /**
     * @inheritdoc
     * @return BrandQuery the active query used by this AR class.
     */
    public static function find() {
        return new BrandQuery(get_called_class());
    }
}
