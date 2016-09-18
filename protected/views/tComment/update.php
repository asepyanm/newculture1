<?php
/* @var $this TCommentController */
/* @var $model TComment */
?>

<?php
$this->breadcrumbs=array(
	'Tcomments'=>array('index'),
	$model->id_comment=>array('view','id'=>$model->id_comment),
	'Update',
);

$this->menu=array(
	array('label'=>'List TComment', 'url'=>array('index')),
	array('label'=>'Create TComment', 'url'=>array('create')),
	array('label'=>'View TComment', 'url'=>array('view', 'id'=>$model->id_comment)),
	array('label'=>'Manage TComment', 'url'=>array('admin')),
);
?>

    <h1>Update TComment <?php echo $model->id_comment; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>