<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<?php
/* @var $this MessageController */
/* @var $model Message */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#message-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Reject Message</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

							<?php $this->widget('bootstrap.widgets.TbGridView',array(
								'id'=>'message-grid',
								'dataProvider'=>$model->search(),
								// 'filter'=>$model,
								'columns'=>array(
									array(
                                        'type' => 'raw',
                                        'header' => 'No',
                                        'htmlOptions' => array(
                                            'style' => 'text-align:right',
                                        ),
                                        'headerHtmlOptions' => array(
                                            'style' => 'text-align:right',
                                        ),
                                        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                    ),
									array(
										'name'=>'created_by',
										'value'=>'User::model()->findByAttributes(array("N_NIK"=>$data->created_by))->V_NAMA_KARYAWAN." / ".$data->created_by',
										),
									array(
										'header' => 'Judul Content',
										'value' => 'Content::model()->findByAttributes(array("idcontent"=>$data->idcontent))->judul'
										),
									// array(
									// 	'name'=>'mess',
									// 	'filter'=>false,
									// 	),
									array(
										'name'=>'waktu',
										'filter'=>false,
										),
									array(
										'name'=>'jml_mess',
										'value'=>'$data->jml_mess > 0 ? "<span class=\'label label-danger\'>".$data->jml_mess." baru</span>" : ""',
										'type'=>'raw',
										'htmlOptions' => array(
                                            'style' => 'text-align:center;width:5%;',
                                        	),
										'filter'=>false,
										),
									/*
									'status',
									*/
									array(
	                                        'class' => 'MyButtonColumn',
	                                        'template' => '{view}',
	                                        'htmlOptions' => array(
	                                            'style' => 'width:10%',
	                                        ),
	                                        'buttons' => array(
	                                                    'view' => array(
	                                                        'url' => 'Yii::app()->createUrl("/message/view", array("id"=>$data["idcontent"],"nik_kirim"=>$data["created_by"]))',
	                                                        'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View'),
	                                                        'label'=>'<button class="btn btn-sm btn-outline btn-success"><i class="fa fa-eye"></i></button>',     
	                                                    ),
	                                        ),   
	                                    ),
								),
							)); ?>

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