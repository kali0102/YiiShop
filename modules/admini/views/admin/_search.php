<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'realname') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'logins') ?>

    <?php // echo $form->field($model, 'login_time') ?>

    <?php // echo $form->field($model, 'login_ip') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
