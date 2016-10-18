<?php

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
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'spec-grid']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
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
                        return Spec::$typeList[$m->type];
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
