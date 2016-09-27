<?php

/* @var $this yii\web\View */
/* @var $model app\models\Spec */

$this->blocks['content-header'] = '编辑规格';
$this->title = '商品规格';
$this->params['breadcrumbs'][] = ['label' => '商品规格', 'url' => ['index']];
$this->params['breadcrumbs'][] = '编辑';

echo $this->render('_form', ['model' => $model]);
?>
