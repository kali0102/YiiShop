<?php


/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->blocks['content-header'] = '添加商品';
$this->title = '商品商品';
$this->params['breadcrumbs'][] = ['label' => '商品商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = '添加';

echo $this->render('_form', ['model' => $model]);
?>
