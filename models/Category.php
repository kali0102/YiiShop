<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $thumb
 * @property integer $sort
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'thumb'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['thumb'], 'string', 'max' => 128],
            ['thumb', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
