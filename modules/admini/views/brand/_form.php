<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Brand */
/* @var $form yii\widgets\ActiveForm */

$defultFieldConfig = [
    'template' => "{label}\n<div class=\"col-xs-3\">{input}</div>\n<div class=\"col-xs-7\">{error}</div>",
    'labelOptions' => ['class' => 'col-xs-2 control-label'],
];
$otherFieldConfig = [
    'template' => "{label}\n<div class=\"col-xs-2\">{input}</div>\n<div class=\"col-xs-8\">{error}</div>",
    'labelOptions' => ['class' => 'col-xs-2 control-label'],
];

?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">品牌信息<?php if (!$model->isNewRecord): ?>：<?php echo $model->name; ?><?php endif; ?></h3>
    </div>
    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'id' => 'brand-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => $defultFieldConfig,
        ]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => '商品品牌的名称']) ?>
        <?= $form->field($model, 'category_id', $otherFieldConfig)->dropDownList(Category::lists(), ['prompt' => '-选择分类-']); ?>
        <?= $form->field($model, 'thumb')->fileInput() ?>
        <?= $form->field($model, 'sort', $otherFieldConfig)->textInput(['placeholder' => '0~255之间']) ?>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-11">
                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
