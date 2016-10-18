<?php

/**
 * 商品属性值模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "{{%attribute_value}}".
 *
 * @property string $id
 * @property string $attribute_id
 * @property string $name
 * @property integer $sort
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class AttributeValue extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%attribute_value}}';
    }

    public function rules()
    {
        return [
            [['attribute_id', 'name'], 'required'],
            [['attribute_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [
                ['attribute_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Attribute::className(),
                'targetAttribute' => ['attribute_id' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'attribute_id' => '属性',
            'name' => '名称',
            'sort' => '排序',
        ];
    }

    public static function find()
    {
        return new AttributeValueQuery(get_called_class());
    }

    /**
     * 字符串转数组
     * @param $values
     * @return array
     */
    public static function string2array($values)
    {
        return preg_split('/\s*,\s*/', trim($values), -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * 处理属性值
     * 添加新记录
     * 删除旧记录
     * @param $oldValues
     * @param $newValues
     * @param $attribute
     */
    public function processValues($oldValues, $newValues, $attribute)
    {
        $oldValues = self::string2array($oldValues);
        $newValues = self::string2array($newValues);
        $this->addValues(array_diff($newValues, $oldValues), $attribute);
        $this->removeValues(array_diff($oldValues, $newValues));
    }

    /**
     * 添加属性值
     * @param $values
     * @param $attribute
     */
    public function addValues($values, $attribute)
    {
        if (empty($values))
            return;
        $attributeValue = $this;
        foreach ($values as $value) {
            $model = clone $attributeValue;
            $model->attribute_id = $attribute->primaryKey;
            $model->name = $value;
            $model->save();
        }
    }

    /**
     * 删除属性值
     * @param $values
     */
    public function removeValues($values)
    {
        if (empty($values))
            return;
        self::deleteAll(['in', 'name', $values]);
    }
}
