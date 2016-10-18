<?php

/**
 * 商品属性模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "{{%attribute}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $sort
 *
 * @property AttributeValue[] $attributeValues
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Attribute extends ActiveRecord
{

    public $values;
    private $_oldValues;

    public static function tableName()
    {
        return '{{%attribute}}';
    }

    public function rules()
    {
        return [
            [['name', 'values', 'sort'], 'required'],
            [['sort'], 'integer'],
            ['values', 'safe'],
            [['name'], 'string', 'max' => 64],
            ['values', 'normalizeValues']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '名称',
            'values' => '属性值',
            'sort' => '排序',
        ];
    }

    public function getSpecValues()
    {
        return $this->hasMany(AttributeValue::className(), ['attribute_id' => 'id']);
    }

    public static function find()
    {
        return new AttributeQuery(get_called_class());
    }

    public function afterFind()
    {
        parent::afterFind();
        if (!empty($this->attributeValues)) {
            $values = [];
            foreach ($this->attributeValues as $value)
                array_push($values, $value->name);
            $this->_oldValues = $values;
            $this->values = implode(',', $values);
        }
    }

    public function normalizeValues()
    {
        $values = explode(',', trim($this->values));
        $this->values = implode(',', array_unique($values));
    }

    /**
     * 显示属性值
     * @param $values
     * @return string
     */
    public static function showValues($values)
    {
        $content = '';
        if (count($values) == 0)
            return $content;
        foreach ($values as $v)
            $content .= $v->name . ',';
        return substr($content, 0, -1);
    }
}
