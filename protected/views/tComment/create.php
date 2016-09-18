<?php
/* @var $this TCommentController */
/* @var $model TComment */
?>

<?php
$this->breadcrumbs=array(
	'Tcomments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TComment', 'url'=>array('index')),
	array('label'=>'Manage TComment', 'url'=>array('admin')),
);
?>

<h1>Create TComment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>