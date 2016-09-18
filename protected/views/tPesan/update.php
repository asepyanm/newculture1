<?php
/* @var $this TPesanController */
/* @var $model TPesan */
?>

<?php
$this->breadcrumbs=array(
	'Tpesans'=>array('index'),
	$model->idpesan=>array('view','id'=>$model->idpesan),
	'Update',
);

$this->menu=array(
	array('label'=>'List TPesan', 'url'=>array('index')),
	array('label'=>'Create TPesan', 'url'=>array('create')),
	array('label'=>'View TPesan', 'url'=>array('view', 'id'=>$model->idpesan)),
	array('label'=>'Manage TPesan', 'url'=>array('admin')),
);
?>

    <h1>Update TPesan <?php echo $model->idpesan; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>