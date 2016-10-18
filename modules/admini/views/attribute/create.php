<?php


/* @var $this yii\web\View */
/* @var $model app\models\Attribute */

$this->blocks['content-header'] = '添加属性';
$this->title = '商品属性';
$this->params['breadcrumbs'][] = ['label' => '属性', 'url' => ['index']];
$this->params['breadcrumbs'][] = '添加';

echo $this->render('_form', ['model' => $model]);
?>
