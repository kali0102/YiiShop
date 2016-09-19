<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '注册用户';
$this->params['breadcrumbs'][] = ['label' => '注册用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Hover Data Table</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                'mobile',
                'email:email',
                 'sex',
                // 'realname',
                // 'nickname',
                // 'avatar',
                // 'province_id',
                // 'city_id',
                // 'district_id',
                // 'street',
                // 'register_type',
                // 'login_time:datetime',
                // 'login_ip',
                 'logins',
                 'register_time:datetime',

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
