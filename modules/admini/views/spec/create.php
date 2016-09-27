<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Spec */

$this->blocks['content-header'] = '添加规格';
$this->title = '商品规格';
$this->params['breadcrumbs'][] = ['label' => '规格', 'url' => ['index']];
$this->params['breadcrumbs'][] = '添加';

echo $this->render('_form', ['model' => $model]);
?>
