<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-body">
    <div class="pull-left"></div>
    <div class="pull-right">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'options' => ['class' => 'form-inline'],
            'method' => 'get',
            'fieldConfig' => ['template' => "{label}{input}"],
        ]); ?>
        <?= $form->field($model, 'mobile')->textInput(['class' => 'form-control input-sm', 'placeholder' => '注册用户的手机号码'])->label('手机号码：'); ?>
        <?= $form->field($model, 'mobile')->textInput(['class' => 'form-control input-sm', 'placeholder' => '用户的手机号码'])->label('手机号码：'); ?>
        <div class="form-group">
            <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
