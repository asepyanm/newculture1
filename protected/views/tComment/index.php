<?php
/* @var $this TCommentController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Tcomments',
);

$this->menu=array(
	array('label'=>'Create TComment','url'=>array('create')),
	array('label'=>'Manage TComment','url'=>array('admin')),
);
?>

<h1>Tcomments</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>