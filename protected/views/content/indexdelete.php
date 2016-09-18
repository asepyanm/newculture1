<?php
/* @var $this ContentController */
/* @var $model Content */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#content-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

        <div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Deleted Content</h1>
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
                                        'id' => 'content-grid',
                                        'dataProvider' => $model->searchDelete(),
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
                                            'judul',
                                            'sinopsis',
                                            array(
                                                'name' => 'statusinternal',
                                                'visible'=>'Yii::app()->user->checkAccess("adminhr")',
                                            ),
                                            array(
                                                'name' => 'idsubkategori',
                                                'value' => '$data[\'idsubkategori0\'][\'nama\']',
                                                'filter' => CHtml::listData(Subkategori::model()->findAll(), 'idsubkategori', 'nama')
                                            ),
                                            array(
                                                'class' => 'bootstrap.widgets.TbButtonColumn',
                                                'htmlOptions' => array('style' => 'text-align: center','width: 100px'),
                                                'template' => '{restore}{delete}',
                                                'buttons' => array(
                                                            'restore' => array(
                                                                'label' => '<i class="fa fa-undo"></i>',
                                                                'url' => 'Yii::app()->createUrl("/content/restore", array("action"=>"edit","id"=>$data["idcontent"]))',
                                                            ),
                                                            'delete' => array(
                                                                'url' => 'Yii::app()->createUrl("/content/deleted", array("id"=>$data["idcontent"]))',       
                                                            ),
                                                        ),   
                                            ),
                                        ),
                                    ));
                                    ?>
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