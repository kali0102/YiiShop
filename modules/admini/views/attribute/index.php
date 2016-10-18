<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Attribute;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品属性';
$this->params['breadcrumbs'][] = ['label' => '商品属性', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';
?>
<div class="box">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'attribute-grid']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                [
                    'attribute' => 'values',
                    'value' => function ($m) {
                        return Attribute::showValues($m->specValues);
                    }
                ],
                'sort',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>