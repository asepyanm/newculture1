<?php
/* @var $this MessageController */
/* @var $model Message */
?>

<?php
$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->idmessage=>array('view','id'=>$model->idmessage),
	'Update',
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'View Message', 'url'=>array('view', 'id'=>$model->idmessage)),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

    <h1>Update Message <?php echo $model->idmessage; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>