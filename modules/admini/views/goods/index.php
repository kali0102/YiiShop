<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品';
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';

// 搜索表单ajax提交
$js = <<<JS
$(document).on('submit', 'form.form-inline', function(event) {
    $.pjax.submit(event, '#goods-grid');
});
JS;
$this->registerJs($js, View::POS_END);
?>
<div class="box">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'goods-grid']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                'category_id',
                'brand_id',
                'thumb',
                'status',
                'price',
                'recommend',
                'views',
                'sales',
                'comments',
                'collects',
                'score',
//                'create_time',
//                'update_time',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>