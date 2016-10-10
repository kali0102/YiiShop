<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\admini\models\Admin;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';

// 搜索表单ajax提交
$js = <<<JS
$(document).on('submit', 'form.form-inline', function(event) {
    $.pjax.submit(event, '#admin-grid');
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
<div class="box">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'admin-grid']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                'mobile',
                'email:email',
                'realname',
                [
                    'attribute' => 'sex',
                    'value' => function ($m) {
                        return Admin::$sexList[$m->sex];
                    }
                ],
                [
                    'attribute' => 'login_time',
                    'value' => function ($m) {
                        return $m->login_time ? date("Y/m/d H:i", $m->login_time) : '';
                    }
                ],
                'logins',
                'login_ip',
                [
                    'attribute' => 'status',
                    'value' => function ($m) {
                        return Admin::$statusList[$m->status];
                    }
                ],
                [
                    'attribute' => 'create_time',
                    'value' => function ($m) {
                        return date("Y/m/d", $m->create_time);
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
