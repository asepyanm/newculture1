<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */


$this->breadcrumbs=array(
	'Subkategoris'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Subkategori', 'url'=>array('index')),
	array('label'=>'Create Subkategori', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#subkategori-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sub Kategori</h1>
                    <?php if(Yii::app()->user->hasFlash('danger')):?>
                        <?php echo Yii::app()->user->getFlash('danger'); ?>
                    <?php endif; ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<a style="float:right;margin-bottom:10px;" class="btn btn-outline btn-primary" href="<?php echo Yii::app()->createUrl('subkategori/create'); ?>"><i class="fa fa-plus"></i> Add Sub Kategori</a>
                            <div class="dataTable_wrapper">

							<?php $this->widget('bootstrap.widgets.TbGridView', array(
								'id'=>'subkategori-grid',
								'dataProvider'=>$model->search(),
								'filter'=>$model,
                                'itemsCssClass' => 'table table-bordered table-striped',
								'columns'=>array(
									array(
                                        'type' => 'raw',
                                        'header' => 'No',
                                        'htmlOptions' => array(
                                            'style' => 'text-align:right',
                                        ),
                                        'headerHtmlOptions' => array(
                                            'style' => 'text-align:right'
                                        ),
                                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                    ),
									'nama',
									'deskripsi',
									array(
                                        'name' => 'idkategori',
                                        'value' => '$data[\'idkategori0\'][\'nama\']',
                                        'filter' => CHtml::listData(Kategori::model()->findAll(), 'idkategori', 'nama')
                                    ),
									array(
                                        'class' => 'MyButtonColumn',
                                        'headerHtmlOptions'=> array(
                                                    'style' => 'border-bottom:0;',
                                                ),
                                        'filterHtmlOptions'=>array('class'=>'nobordertop'),
                                        'template' => '{view}{update}{delete}',
                                        'htmlOptions' => array(
                                            'style' => 'width:12%',
                                        ),
                                        'buttons' => array(
                                                    'view' => array(
                                                        'url' => 'Yii::app()->createUrl("/subkategori/view", array("id"=>$data["idsubkategori"]))',
                                                        'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View'),
                                                        'label'=>'<button class="btn btn-sm btn-outline btn-success"><i class="fa fa-eye"></i></button>',     
                                                    ),
                                                    'update' => array(
                                                        'url' => 'Yii::app()->createUrl("/subkategori/update", array("id"=>$data["idsubkategori"]))',
                                                        'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Edit'),
                                                        'label'=>'<button class="btn btn-sm btn-outline btn-info"><i class="fa fa-pencil"></i></button>',
                                                    ),
                                                    'delete' => array(
                                                        'url' => 'Yii::app()->createUrl("/subkategori/deleted", array("id"=>$data["idsubkategori"]))',
                                                        'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Delete'),
                                                        'label'=>'<button class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i></button>',  
                                                    ),

                                        ),   
                                    ),
								),
							)); ?>
							</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
                
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->