<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-body">
    <div class="pull-left">
        <?= Html::a('创建管理员', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </div>
    <div class="pull-right">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'options' => ['class' => 'form-inline'],
            'method' => 'get',
            'fieldConfig' => ['template' => "{label}{input}"],
        ]); ?>
        <?= $form->field($model, 'username')->textInput(['class' => 'form-control input-sm', 'placeholder' => '管理员用户名'])->label('名称：'); ?>
        <div class="form-group">
            <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
