<?php
/* @var $this ContentController */
/* @var $model Content */
// var_dump(Yii::app()->user->logAdmin)
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
                    <h1 class="page-header">Drafted Content</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <?php $this->widget('bootstrap.widgets.TbGridView', array(
                                        'id' => 'content-grid',
                                        'dataProvider' => $model->searchDraft(),
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
                                            array(
                                                'name'=>'created_n_nik',
                                                'header'=>'Created By',
                                                'type' => 'raw',
                                                ),
                                            'judul',
                                            'sinopsis',
                                            array(
                                                'name' => 'idsubkategori',
                                                'value' => '$data[\'idsubkategori0\'][\'nama\']',
                                                'filter' => CHtml::listData(Subkategori::model()->findAll(), 'idsubkategori', 'nama')
                                            ),
                                            // array(
                                            //     'name' => 'divisi_create',
                                            //     'header' => 'Divisi',
                                            //     'value' => '$data[\'divisi_create\']',
                                            //     'filter' => CHtml::listData($list_divisi, 'divisi_create', 'divisi_create')
                                            // ),
                                            array(
                                                'name' => 'id_unit',
                                                'header' => 'Unit',
                                                'value' => '$data->nama_unit',
                                                'filter'=>CHtml::listData($list_unit, 'id_unit', 'nama_unit')
                                                ),
                                            array(
                                                //'class'=>'DataColumn',
                                                'type' => 'raw',
                                                'name' => 'idstatus',
                                                //'value' => '$data[\'idstatus0\'][\'status\']',
                                                'value' => 'CHtml::tag(\'p\', array(
                                                    \'data-toggle\'=>\'modal\',
                                                    \'data-target\'=> $data->idstatus == 4 ? \'#modal_alasan\' : \'\',
                                                    \'als\' => $data->alasan,
                                                    \'oleh\' => $data->namareject.\' (\'.$data->rejectoleh.\')\',
                                                    \'id\' => \'alasan\',
                                                    \'onclick\' => \'javascript:tampilmodal(this);\',
                                                    \'style\' => $data->idstatus == 4 ? \'cursor:pointer;\' : \'\',
                                                  ), $data[\'idstatus0\'][\'status\'])',
                                                'filter' => CHtml::listData(PStatus::model()->findAllByAttributes(array('idstatus'=>array('2','4'),)), 'idstatus', 'status'),
                                                'cssClassExpression' => '$data["idstatus"] == 2 ? "label-warning" : "label-danger"',
                                                // 'htmlOptions' => array(
                                                //     'data-toggle' => '"modal"',
                                                //     'data-target' => '"{$data->idstatus}" == 4 ? "#modal_alasan" : ""',
                                                //     'als' => '"{$data->alasan}"',
                                                //     'oleh' => '"{$data->namareject}"." ("."{$data->rejectoleh}".")"',
                                                //     'id'=>'"alasan"',
                                                //     'onclick'=>'"javascript:tampilmodal(this);"',
                                                //     'style' => '"cursor:pointer;text-decoration:none;text-align:center;vertical-align:middle"'
                                                // ),
                                            ),
                                            // array(
                                            //     'name' => 'idstatus',
                                            //     'value' => '"<span class="$data["idstatus"] == 2 ? "label label-warning" : "label label-danger"">"$data[\'idstatus0\'][\'status\'] "</span>"',
                                            //     'filter' => CHtml::listData(PStatus::model()->findAllByAttributes(array('idstatus'=>array('2','4'),)), 'idstatus', 'status'),
                                            //     // 'cssClassExpression' => '$data["idstatus"] == 2 ? "label label-warning" : "label label-danger"',
                                            //     'type' => 'raw',
                                            //     'htmlOptions' => array(
                                            //         // 'class' => 'reject',
                                            //         'style' => 'position:relative'
                                            //     ),
                                            // ),
                                            array(
                                                'class' => 'MyButtonColumn',
                                                'template' => '{view}{update}{delete}{message}',
                                                'headerHtmlOptions'=> array(
                                                    'style' => 'border-bottom:0;',
                                                ),
                                                'filterHtmlOptions'=>array('class'=>'nobordertop'),
                                                'htmlOptions' => array(
                                                    'style' => 'width:15%',
                                                ),
                                                'buttons' => array(
                                                            'view' => array(
                                                                'url' => 'Yii::app()->createUrl("/content/view", array("id"=>$data["idcontent"]))',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-success"><i class="fa fa-eye"></i></button>',     
                                                            ),
                                                            'publish' => array(
                                                                'url' => 'Yii::app()->createUrl("/content/publish", array("id"=>$data["idcontent"]))',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Publish'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-primary"><i class="fa fa-upload"></i></button>',      
                                                                'visible'=>'Yii::app()->user->adminhr', 
                                                            ),
                                                            'update' => array(
                                                                'url' => 'Yii::app()->createUrl("/content/update", array("id"=>$data["idcontent"]))',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Edit'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-info"><i class="fa fa-pencil"></i></button>',
                                                                'visible'=>'$data["divisi_create"]==User::model()->findByAttributes(array("N_NIK"=>Yii::app()->user->logAdmin))->C_KODE_DIVISI ? true : false',
                                                            ),
                                                            'delete' => array(
                                                                'url' => 'Yii::app()->createUrl("/content/deleter", array("id"=>$data["idcontent"]))',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Delete'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i></button>',  
                                                                'visible'=>'$data["divisi_create"]==User::model()->findByAttributes(array("N_NIK"=>Yii::app()->user->logAdmin))->C_KODE_DIVISI || Yii::app()->user->adminhr ? true : false',
                                                            ),
                                                            'message' => array(
                                                                // 'url' => 'Yii::app()->createUrl("/content/createmessage", array("id"=>$data["idcontent"]))',
                                                                'url' => '"#"',
                                                                'options' => array(
                                                                    'rel' => 'tooltip', 
                                                                    'data-toggle' => 'tooltip', 
                                                                    'title' => 'Claim Reject',
                                                                    'data-toggle' => 'modal',
                                                                    'id' => '\'\'.$data["idcontent"]',
                                                                    'data-target' => '#modal_message',
                                                                    'onclick' => 'show(this)',
                                                                ),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-warning"><i class="fa fa-pencil-square-o"></i></button>',     
                                                                // 'visible'=>'$data["idstatus"]==4 && $data["divisi_create"]==User::model()->findByAttributes(array("N_NIK"=>Yii::app()->user->logAdmin))->C_KODE_DIVISI && !Yii::app()->user->adminhr', 
                                                                'visible'=>'$data["idstatus"]==4 && ($data["created_by"]==Yii::app()->user->logAdmin) && !Yii::app()->user->adminhr', 
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

<?php echo $this->renderPartial('_malasan', array('model'=>$model)); ?>
<?php echo $this->renderPartial('_mmessage', array('message'=>$message)); ?>

<script type="text/javascript">
    function show(elem){
        var ids = $(elem).attr('id');
        // alert(ids);
        $(".modal-body #ids").val( ids );
    }

    function tampilmodal(e){
        var ids = $(e).attr('id');
        var als = $(e).attr('als');
        var oleh = $(e).attr('oleh');
        var nama = $(e).attr('nama');
        console.log(ids);
        $(".modal-body #ids").val( ids );
        $(".modal-body #alasan").val( als );
        $(".modal-body #rejectoleh").val( oleh );
        $(".modal-body #namareject").val( nama );
        // $('#modal_tolak').modal('show');
    }
</script>