<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品分类';
$this->params['breadcrumbs'][] = ['label' => '商品分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';
?>
<div class="box">
    <!--    <div class="box-header">-->
    <!--        <h3 class="box-title">Hover Data Table</h3>-->
    <!--    </div>-->
    <!-- /.box-header -->

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'parent_id',
                'name',
                [
                    'attribute' => 'thumb',
                    'format' => 'raw',
                    'value' => function ($m) {
                        return Html::img($m->thumb, ['class' => 'img-circle', 'width' => 30]);
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
