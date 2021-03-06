<?php

/**
 * 商品品牌模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "{{%brand}}".
 *
 * @property string $id
 * @property string $name
 * @property string $thumb
 * @property string $letter
 * @property integer $sort
 * @property integer $category_id
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Brand extends ActiveRecord
{


    public static function tableName()
    {
        return '{{%brand}}';
    }


    public function rules()
    {
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


    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '名称',
            'thumb' => '缩略图',
            'letter' => '首字母',
            'sort' => '排序',
            'category_id' => '所属分类'
        ];
    }

    public static function find()
    {
        return new BrandQuery(get_called_class());
    }

    public static function lists()
    {
        $models = self::find()->select(['id', 'name'])->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
}
