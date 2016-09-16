<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Spec;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpecSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spec-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Spec', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
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
