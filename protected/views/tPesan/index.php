<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<?php
/* @var $this TPesanController */
/* @var $model TPesan */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tpesan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php if($model->stts_pesan==0){ $a = "fa-star"; }else{ $a = "fa-star-o"; }  ?>
		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Message</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">

								<?php $this->widget('zii.widgets.grid.CGridView', array(
                                    'id' => 'tpesan-grid',
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
                                                'style' => 'text-align:right',
                                            ),
                                            'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                                        ),
										'nama',
										'email',
										'hp',
										array(
                                            'type'=>'raw',
                                            'name'=>'isipesan',
                                            'value'=>'(strlen($data[\'isipesan\']) > 50) ? substr($data[\'isipesan\'],0,strrpos(substr( $data[\'isipesan\'],0,80),\' \'))."..." : $data[\'isipesan\']', 
                                        ),
                                        /*
										'created_date',
										*/
										array(
	                                        'class' => 'MyButtonColumn',
	                                        'template' => '{view}{delete}',
	                                        'htmlOptions' => array(
	                                            'style' => 'width:10%',
	                                        ),
	                                        'buttons' => array(
	                                                    'view' => array(
	                                                        'url' => 'Yii::app()->createUrl("/TPesan/view", array("id"=>$data["idpesan"]))',
	                                                        'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View'),
	                                                        'label'=>'<button class="btn btn-sm btn-outline btn-success"><i class="fa fa-eye"></i></button>',     
	                                                    ),
	                                                    'delete' => array(
	                                                        'url' => 'Yii::app()->createUrl("/TPesan/delete", array("id"=>$data["idpesan"]))',
	                                                        'visible'=>'Yii::app()->user->adminhr',
	                                                        'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip','title' => 'Delete'),
	                                                        'label'=>'<button class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i></button>', 
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