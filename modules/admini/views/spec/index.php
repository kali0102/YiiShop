<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Spec;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpecSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品规格';
$this->params['breadcrumbs'][] = ['label' => '商品规格', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';
?>
<div class="box">
<!--    <div class="box-header">-->
<!--        <h3 class="box-title">Hover Data Table</h3>-->
<!--    </div>-->
    <!-- /.box-header -->
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                [
                    'attribute' => 'values',
                    'value' => function ($m) {
                        return Spec::showValues($m->specValues);
                    }
                ],
                [
                    'attribute' => 'type',
                    'value' => function ($m) {
                        return Spec::$types[$m->type];
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
    <!-- /.box-body -->
</div>
