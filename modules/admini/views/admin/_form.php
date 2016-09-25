<?php

use app\models\Admin;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */

$defultFieldConfig = [
    'template' => "{label}\n<div class=\"col-xs-3\">{input}</div>\n<div class=\"col-xs-7\">{error}</div>",
    'labelOptions' => ['class' => 'col-xs-2 control-label'],
];
$otherFieldConfig = [
    'template' => "{label}\n<div class=\"col-xs-2\">{input}</div>\n<div class=\"col-xs-8\">{error}</div>",
    'labelOptions' => ['class' => 'col-xs-2 control-label'],
];
$selectFieldConfig = [
    'template' => "{label}\n<div class=\"col-xs-1\">{input}</div>\n<div class=\"col-xs-8\">{error}</div>",
    'labelOptions' => ['class' => 'col-xs-2 control-label'],
];

?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">管理员信息<?php if (!$model->isNewRecord): ?>：<?php echo $model->username; ?><?php endif; ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'id' => 'brand-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => $defultFieldConfig,
        ]); ?>
        <?= $form->field($model, 'username', $otherFieldConfig)->textInput(['maxlength' => true, 'placeholder' => '管理员的用户名']) ?>
        <?= $form->field($model, 'password', $defultFieldConfig)->passwordInput(['placeholder' => '登录用密码']) ?>
        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true, 'placeholder' => '管理员的用户名']) ?>
        <?= $form->field($model, 'email', $defultFieldConfig)->textInput(['maxlength' => true, 'placeholder' => '管理员的用户名']) ?>
        <?= $form->field($model, 'realname', $otherFieldConfig)->textInput(['maxlength' => true, 'placeholder' => '管理员真实姓名']) ?>
        <?= $form->field($model, 'sex', $selectFieldConfig)->dropDownList(Admin::$sexList, []) ?>
        <?= $form->field($model, 'status', $selectFieldConfig)->dropDownList(Admin::$statusList) ?>
        <?= $form->field($model, 'avatar')->fileInput() ?>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-11">
                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-body -->
</div>
