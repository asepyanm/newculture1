<?php
/* @var $this AuthassignmentController */
/* @var $model Authassignment */
?>

<?php
$this->breadcrumbs=array(
	'Authassignments'=>array('index'),
	'Create',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2,'user'=>$user,'unit'=>$unit,'listdivisi'=>$listdivisi)); ?>