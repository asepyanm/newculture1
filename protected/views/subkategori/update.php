<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */
?>

<?php
$this->breadcrumbs=array(
	'Subkategoris'=>array('index'),
	$model->idsubkategori=>array('view','id'=>$model->idsubkategori),
	'Update',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model,'ceklis'=>$ceklis)); ?>