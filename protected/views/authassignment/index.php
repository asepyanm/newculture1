<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<?php
/* @var $this AuthassignmentController */
/* @var $model Authassignment */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#authassignment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage User</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a style="float:right;margin-bottom:10px;" class="btn btn-outline btn-primary" href="<?php echo Yii::app()->createUrl('Authassignment/create'); ?>"><i class="fa fa-plus"></i> Add Admin</a>
                    <div class="dataTable_wrapper">

						<?php $this->widget('bootstrap.widgets.TbGridView', array(
                            'id' => 'authassignment-grid',
                            'dataProvider' => $model->search(),
                            'filter' => $model,
                            'itemsCssClass' => 'table table-bordered table-striped',
                            'columns' => array(
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
								'itemname',
								array(
                                    'name'=>'nik',
                                    'sortable'=>'false',
                                    ),
								array(
                                    'header'=>'Nama',
                                    'name'=>'namakar',
                                    'type'=>'raw',
                                    'value'=>'$data["namakar"]',
                                ),
                                array(
                                    'header'=>'Jabatan',
                                    'name'=>'posisi',
                                    'type'=>'raw',
                                    'value'=>'$data["posisi"]',
                                ),
                                array(
                                    'header'=>'Divisi',
                                    'name'=>'kodedivisi',
                                    'type'=>'raw',
                                    // 'value'=>'$data["kodedivisi"]',
                                ),
                                array(
                                    'header'=>'Unit',
                                    // 'name'=>'kodedivisi',
                                    'type'=>'raw',
                                    'value'=>'Unit::model()->findByAttributes(array("id_unit"=>Roleunit::model()->findByAttributes(array("nik"=>$data["nik"]))->id_unit))->nama_unit',
                                ),
								array(
	                                'class' => 'MyButtonColumn',
                                    'headerHtmlOptions'=> array(
                                                    'style' => 'border-bottom:0;',
                                                ),
                                    'filterHtmlOptions'=>array('class'=>'nobordertop'),
	                                'template' => '{delete}{update}',
	                                'htmlOptions' => array(
	                                    'style' => 'width:10%',
	                                ),
	                                'buttons' => array(
	                                            // 'view' => array(
	                                            //     'url' => 'Yii::app()->createUrl("/Authassignment/View", array("id"=>$data["nik"]))',
	                                            //     'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View'),
	                                            //     'label'=>'<button class="btn btn-sm btn-outline btn-success"><i class="fa fa-eye"></i></button>',     
	                                            // ),
	                                            'delete' => array(
	                                                'url' => 'Yii::app()->createUrl("/Authassignment/deleter", array("id"=>$data["id"]))',
	                                                'visible'=>'Yii::app()->user->id != $data["nik"]',
	                                                'options' => array('rel' => 'tooltip','data-toggle' => 'tooltip','title' => 'Delete'),
	                                                'label'=>'<button class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i></button>',
	                                            ),
                                                'update' => array(
                                                    'url' => 'Yii::app()->createUrl("/Authassignment/update", array("id"=>$data["id"]))',
                                                    // 'visible'=>'Yii::app()->user->adminhr',
                                                    'options' => array('rel' => 'tooltip','data-toggle' => 'tooltip','title' => 'update'),
                                                    'label'=>'<button class="btn btn-sm btn-outline btn-warning"><i class="fa fa-pencil"></i></button>',
                                                ),

	                                ),   
	                            ),
							),
						)); ?>
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