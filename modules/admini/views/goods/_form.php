<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */
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
        <h3 class="box-title">商品信息<?php if (!$model->isNewRecord): ?>：<?php echo $model->name; ?><?php endif; ?></h3>
    </div>
    <div class="box-body">
        <?php $form = ActiveForm::begin([
            'id' => 'brand-form',
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => $defultFieldConfig,
        ]); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => '商品品牌的名称']) ?>
        <?= $form->field($model, 'category_id', $otherFieldConfig)->dropDownList(\app\models\Category::lists(), ['prompt' => '-选择分类-']); ?>
        <?= $form->field($model, 'brand_id', $otherFieldConfig)->dropDownList(\app\models\Brand::lists(), ['prompt' => '-选择品牌-']); ?>
        <?= $form->field($model, 'thumb')->fileInput() ?>
        <?= $form->field($model, 'status', $otherFieldConfig)->dropDownList(\app\models\Goods::$statusList, ['prompt' => '-状态-']); ?>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => '商品品牌的名称']) ?>
        <?= $form->field($model, 'recommend', $otherFieldConfig)->dropDownList(\app\models\Goods::$recommendList, ['prompt' => '-推荐-']); ?>
        <?= $form->field($model, 'content')->textInput(['maxlength' => true, 'placeholder' => '商品品牌的名称']) ?>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-11">
                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
