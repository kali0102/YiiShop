<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->blocks['content-header'] = '编辑分类';
$this->title = '商品分类';
$this->params['breadcrumbs'][] = ['label' => '商品分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = '编辑';

echo $this->render('_form', ['model' => $model]);
?>
