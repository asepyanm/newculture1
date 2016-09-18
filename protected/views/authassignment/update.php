<?php
/* @var $this AuthassignmentController */
/* @var $model Authassignment */
?>

<?php
// var_dump($model2);exit;
$this->breadcrumbs=array(
	'Authassignments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Authassignment', 'url'=>array('index')),
	array('label'=>'Create Authassignment', 'url'=>array('create')),
	array('label'=>'View Authassignment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Authassignment', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2,'user'=>$user,'unit'=>$unit,'listdivisi'=>$listdivisi)); ?>