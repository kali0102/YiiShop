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

// 搜索表单ajax提交
$js = <<<JS
$(document).on('submit', 'form.form-inline', function(event) {
    $.pjax.submit(event, '#category-grid');
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
<div class="box">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'category-grid']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
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
</div>
