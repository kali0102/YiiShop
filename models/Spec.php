<?php


/**
 * 商品规格模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "{{%spec}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $sort
 *
 * @property SpecValue[] $specValues
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Spec extends ActiveRecord
{

    public $values;
    private $_oldValues;

    const TYPE_TEXT = 1;
    const TYPE_IMAGE = 2;

    public static $typeList = [
        self::TYPE_TEXT => '文字',
        self::TYPE_IMAGE => '图片'
    ];

    public static function tableName()
    {
        return '{{%spec}}';
    }

    public function rules()
    {
        return [
            [['type', 'values', 'name'], 'required'],
            [['type', 'sort'], 'integer'],
            ['values', 'safe'],
            [['name'], 'string', 'max' => 64],
            ['type', 'in', 'range' => [1, 2]],
            ['sort', 'default', 'value' => 0],
            ['values', 'normalizeValues']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'type' => '类型',
            'name' => '名称',
            'values' => '规格值',
            'sort' => '排序',
        ];
    }

    public function getSpecValues()
    {
        return $this->hasMany(SpecValue::className(), ['spec_id' => 'id']);
    }

    public static function find()
    {
        return new SpecQuery(get_called_class());
    }

    /**
     * afterFind
     * 处理规格值
     * 编辑属性时使用
     */
    public function afterFind()
    {
        parent::afterFind();
        if (!empty($this->specValues)) {
            $values = [];
            foreach ($this->specValues as $value)
                array_push($values, $value->name);
            $this->values = $this->_oldValues = implode(',', $values);
        }
    }

    /**
     * afterSave
     * 处理规格值
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $model = new SpecValue;
        $model->processValues($this->_oldValues, $this->values, $this);
    }

    /**
     * 处理规格值
     * 去除重复
     */
    public function normalizeValues()
    {
        $values = explode(',', trim($this->values));
        $this->values = implode(',', array_unique($values));
    }

    /**
     * 显示规格值
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
