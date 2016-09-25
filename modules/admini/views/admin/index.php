<?php

use app\models\Admin;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = '列表';
?>
<div class="box">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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
    <!-- /.box-body -->
</div>
