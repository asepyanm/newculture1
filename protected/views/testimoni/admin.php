<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<?php
/* @var $this TestimoniController */
/* @var $model Testimoni */


$this->breadcrumbs=array(
	'Testimonis'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Testimoni', 'url'=>array('index')),
	array('label'=>'Create Testimoni', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#testimoni-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
<h1>Manage Testimonis</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'testimoni-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_testimoni',
		'isi_testimoni',
		'created_date',
		'nik_user',
		'video',
		'video_name',
		/*
		'video_size',
		'video_type',
		'stts_testimoni',
		'stts_notif',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</div>