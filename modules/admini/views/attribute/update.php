<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attribute */

$this->blocks['content-header'] = '编辑属性';
$this->title = '商品属性';
$this->params['breadcrumbs'][] = ['label' => '商品属性', 'url' => ['index']];
$this->params['breadcrumbs'][] = '编辑';

echo $this->render('_form', ['model' => $model]);
?>
