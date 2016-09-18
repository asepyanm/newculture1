<?php
/* @var $this TPesanController */
/* @var $model TPesan */
?>

<?php
$this->breadcrumbs=array(
	'Tpesans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TPesan', 'url'=>array('index')),
	array('label'=>'Manage TPesan', 'url'=>array('admin')),
);
?>

<h1>Create TPesan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>