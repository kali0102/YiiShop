<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Type;

/* @var $this yii\web\View */
/* @var $model app\models\Spec */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spec-form">

    <?php $form = ActiveForm::begin([
        'id' => 'spec-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->radioList(\app\models\Spec::$types); ?>

    <?= $form->field($model, 'values')->textarea(['cols' => 4, 'rows' => 3]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
