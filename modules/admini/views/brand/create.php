<?php

/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->blocks['content-header'] = '添加品牌';
$this->title = '商品品牌';
$this->params['breadcrumbs'][] = ['label' => '商品品牌', 'url' => ['index']];
$this->params['breadcrumbs'][] = '添加';

echo $this->render('_form', ['model' => $model]);
?>

