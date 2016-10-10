<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admini\models\Admin */

$this->blocks['content-header'] = '编辑管理员';
$this->title = '管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = '编辑';

echo $this->render('_form', ['model' => $model]);
?>
