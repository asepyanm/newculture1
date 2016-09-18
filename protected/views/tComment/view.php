<?php
/* @var $this TCommentController */
/* @var $model TComment */
?>

<?php
$this->breadcrumbs=array(
	'Tcomments'=>array('index'),
	$model->id_comment,
);

$this->menu=array(
	array('label'=>'List TComment', 'url'=>array('index')),
	array('label'=>'Create TComment', 'url'=>array('create')),
	array('label'=>'Update TComment', 'url'=>array('update', 'id'=>$model->id_comment)),
	array('label'=>'Delete TComment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_comment),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TComment', 'url'=>array('admin')),
);
?>

<h1>View TComment #<?php echo $model->id_comment; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id_comment',
		'isi_comment',
		'created_date',
		'nik_user',
		'id_content',
	),
)); ?>