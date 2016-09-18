<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */
?>

<?php
$this->breadcrumbs=array(
	'Subkategoris'=>array('index'),
	'Create',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model,'ceklis'=>$ceklis)); ?>