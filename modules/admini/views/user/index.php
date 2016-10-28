<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '注册用户';
$this->params['breadcrumbs'][] = ['label' => '注册用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';

// 搜索表单ajax提交
$js = <<<JS
$(document).on('submit', 'form.form-inline', function(event) {
    $.pjax.submit(event, '#user-grid');
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>

<div class="box">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'user-grid']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => '会员',
                    'format' => 'raw',
                    'headerOptions' => ['width' => '15%'],
                    'value' => function ($model) {
                        return $model->nameText();
                    }
                ],
                [
                    'attribute' => 'sex',
                    'value' => function ($m) {
                        return User::$sexList[$m->sex];
                    }
                ],
                [
                    'label' => '所在地区',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->areaText();
                    }
                ],
                // 'realname',
                // 'nickname',
                // 'avatar',
                // 'province_id',
                // 'city_id',
                // 'district_id',
                // 'street',
                // 'register_type',
                'logins',
                [
                    'label' => '最近登录',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->loginText();
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
