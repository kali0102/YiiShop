<?php

/**
 * 商品规格值模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "{{%spec_value}}".
 *
 * @property string $id
 * @property string $spec_id
 * @property string $name
 * @property string $thumb
 * @property integer $sort
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class SpecValue extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%spec_value}}';
    }

    public function rules()
    {
        return [
            [['spec_id', 'name'], 'required'],
            [['spec_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['thumb'], 'string', 'max' => 128],
            [['spec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spec::className(), 'targetAttribute' => ['spec_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'spec_id' => '所属规格',
            'name' => '名称',
            'thumb' => '缩略图',
            'sort' => '排序',
        ];
    }

    public static function find()
    {
        return new SpecValueQuery(get_called_class());
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
     * 处理规格值
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
     * 添加规格值
     * @param $values
     * @param $attribute
     */
    public function addValues($values, $attribute)
    {
        if (empty($values))
            return;
        $specValue = $this;
        foreach ($values as $value) {
            $model = clone $specValue;
            $model->spec_id = $attribute->primaryKey;
            $model->name = $value;
            $model->save();
        }
    }

    /**
     * 删除规格值
     * @param $values
     */
    public function removeValues($values)
    {
        if (empty($values))
            return;
        self::deleteAll(['in', 'name', $values]);
    }
}
