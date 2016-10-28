<?php

/**
 * 商品模型
 *
 * @author kali.liu <kali.liu@qq.com>
 * @link http://www.fansye.com/
 * @copyright Copyright &copy; 2016-2068 Fansye.com Inc
 *
 * This is the model class for table "{{%goods}}".
 *
 * @property string $id
 * @property string $name
 * @property string $category_id
 * @property string $brand_id
 * @property string $thumb
 * @property string $content
 * @property integer $status
 * @property string $price
 * @property integer $recommend
 * @property string $views
 * @property string $sales
 * @property string $comments
 * @property string $collects
 * @property string $score
 * @property integer $stock
 * $property string $title
 * @property integer $market_price
 * @property string $create_time
 * @property string $update_time
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Goods extends ActiveRecord
{

    const STATUS_OFF_SALE = 0;
    const STATUS_SALE_IN = 1;

    const RECOMMEND_ON = 0;
    const RECOMMEND_YES = 1;

    // 状态
    public static $statusList = [
        self::STATUS_OFF_SALE => '下架',
        self::STATUS_SALE_IN => '销售中'
    ];

    // 推荐
    public static $recommendList = [
        self::RECOMMEND_YES => '是',
        self::RECOMMEND_ON => '否'
    ];

    public static function tableName()
    {
        return '{{%goods}}';
    }


    public function rules()
    {
        return [
            [['name', 'category_id', 'brand_id', 'thumb', 'content', 'stock', 'create_time', 'update_time'], 'required'],
            [
                [
                    'category_id',
                    'brand_id',
                    'status',
                    'recommend',
                    'views',
                    'sales',
                    'comments',
                    'collects',
                    'score',
                    'create_time',
                    'update_time'
                ],
                'integer'
            ],
            [['content'], 'string'],
            [['price'], 'number'],
            [['name', 'thumb'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'id']],

            // 添加
            ['thumb', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024 * 1024]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '名称',
            'category_id' => '分类',
            'brand_id' => '品牌',
            'thumb' => '封面图',
            'content' => '描述详情',
            'status' => '状态',//（0下架、1销售中）
            'price' => '售价',
            'recommend' => '推荐',//（0否、1是）
            'views' => '浏览量',
            'sales' => '销量',
            'comments' => '评论次数',
            'collects' => '收藏次数',
            'score' => '评分',
            'title' => '标题',
            'market_price' => '市场价',
            'create_time' => '添加时间',
            'update_time' => '更新时间',
        ];
    }

    public static function find()
    {
        return new GoodsQuery(get_called_class());
    }
}
