<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
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
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Published Content</h1>
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
                                        'dataProvider' => $model->search(),
                                        'filter' => $model,
                                        'afterAjaxUpdate' => 'reinstallDatePicker',
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
                                            // array(
                                            //     'name' => 'idcontent',
                                            //     // 'value' => '$data[\'historyLogs\'][\'created_by\']',
                                            //     'value' => 'empty($data[\'historyLogs\'][\'created_by\']) ? null : $data[\'historyLogs\'][\'created_by\']',
                                            //     'filter' => CHtml::listData(HistoryLog::model()->findAll(), 'idcontent', 'created_by'),
                                            // ),

                                            array(
                                                'header'=>'Created By',
                                                'name'=>'created_n_nik',
                                                'type'=>'raw',
                                                'htmlOptions' => array(
                                                    'style' => 'width:10%;',
                                                ),
                                            ),                                            
                                            array(
                                                'name'=>'created_date',
                                                'value'=>'date("d-M-y", strtotime($data["created_date"]))',
                                                // 'value'=>'$data["created_date"]',
                                                'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                    'model'=>$model,
                                                    'attribute'=>'created_date',
                                                    'htmlOptions' => array(
                                                        'id' => 'created_date',
                                                        'class' => 'form-control input-sm',
                                                    ), 
                                                    'options' => array(
                                                        'dateFormat' => 'yy-mm-dd'
                                                    )
                                                ), true),

                                            ),
                                            array(
                                                'header'=>'Update By',
                                                'name'=>'updated_n_nik',
                                                'type'=>'raw',
                                                'htmlOptions' => array(
                                                    'style' => 'width:10%;',
                                                ),                                               
                                            ),
                                            array(
                                                'name'=>'updated_date',
                                                'value'=>'date("d-M-y", strtotime($data["updated_date"]))',
                                                // 'value'=>'$data["created_date"]',
                                                 'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
                                                    'model'=>$model,
                                                    'attribute'=>'updated_date',
                                                    'htmlOptions' => array(
                                                        'id' => 'updated_date',
                                                        'class' => 'form-control input-sm',
                                                    ), 
                                                    'options' => array(
                                                        'dateFormat' => 'yy-mm-dd'
                                                    )
                                                ), true),
                                                 // 'filter'=>$this->widget('ext.dateRangePicker.JDateRangePicker',array(
                                                 //                'name'=>CHtml::activeName($model,'created_start_date'),
                                                 //                'value'=>$model->created_start_date,
                                                 //                'name2'=>CHtml::activeName($model,'created_end_date'),
                                                 //                'value2'=>$model->created_end_date,
                                                 //            )),
                                            ),
                                            'judul',
                                            'sinopsis',
                                            // array(
                                            //     'header'=>'Status Eksternal',
                                            //     'name'=>'statusinternal',
                                            //     'type'=>'raw',
                                            //     'value'=>'$data["statusinternal"] == 1 ? CHtml::link("<center><span class=\'label label-success\'><i class=\'fa fa-check\'></i></span></center>",array(\'/Content/switch\',\'id\'=>$data->idcontent),array(\'rel\' => \'tooltip\', \'data-toggle\' => \'tooltip\', \'title\' => \'Yes, Click to No\')) : CHtml::link("<center><span class=\'label label-danger\'><i class=\'fa fa-remove\'></i></span></center>",array(\'/Content/switch\',\'id\'=>$data->idcontent),array(\'rel\' => \'tooltip\', \'data-toggle\' => \'tooltip\', \'title\' => \'No, Click to Yes\'))',
                                            //     'filter' => array('0' => 'No', '1' => 'Yes'),
                                            //     'visible'=>Yii::app()->user->adminhr,
                                            // ),
                                            // array(
                                            //     'class'=>'JToggleColumn',
                                            //     'name'=>'statusinternal', // boolean model attribute (tinyint(1) with values 0 or 1)
                                            //     'filter' => array('0' => 'No', '1' => 'Yes'), // filter
                                            //     'action'=>'switch', // other action, default is 'toggle' action
                                            //     // 'checkedButtonLabel'=>'/images/yes.png',  // Image,text-label or Html
                                            //     // 'uncheckedButtonLabel'=>'/images/no.png', // Image,text-label or Html
                                            //     'checkedButtonTitle'=>'Yes.Click to No', // tooltip
                                            //     'uncheckedButtonTitle'=>'No. Click to Yes', // tooltip
                                            //     'labeltype'=>'image',// New Option - may be 'image','html' or 'text'
                                            //     'htmlOptions'=>array('style'=>'text-align:center;min-width:60px;'),
                                            //     'visible'=>Yii::app()->user->adminhr,
                                            // ),
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
                                                'name'=>'id_unit',
                                                'header'=>'Unit',
                                                'value'=>'Unit::model()->findByAttributes(array("id_unit"=>$data["id_unit"]))->nama_unit',
                                                'filter'=>CHtml::listData($list_unit, 'id_unit', 'nama_unit')
                                                ),
                                            array(
                                                'class' => 'MyButtonColumn',
                                                'template' => '{view}{update}',
                                                'htmlOptions' => array(
                                                    'style' => 'width:9%;text-align:center;',
                                                ),
                                                'filterHtmlOptions'=>array('class'=>'nobordertop'),
                                                'headerHtmlOptions'=> array(
                                                    'style' => 'border-bottom:0;',
                                                ),
                                                'buttons' => array(
                                                            'view' => array(
                                                                'url' => 'Yii::app()->createUrl("/Content/view", array("id"=>$data["idcontent"]))',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View'),
                                                                'label'=>'<button class="btn btn-sm ,btn-outline btn-success"><i class="fa fa-eye"></i></button>',     
                                                            ),
                                                            'update' => array(
                                                                'url' => 'Yii::app()->createUrl("/Content/update", array("id"=>$data["idcontent"]))',
                                                                // 'visible'=>'$data["divisi_create"]==User::model()->findByAttributes(array("N_NIK"=>Yii::app()->user->logAdmin))->C_KODE_DIVISI?true:false',
                                                                'visible'=>'$data["id_unit"]==Roleunit::model()->findByAttributes(array("nik"=>Yii::app()->user->id))->id_unit',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Edit'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-info"><i class="fa fa-pencil"></i></button>',
                                                            ),
                                                            'reject' => array(
                                                                'url' => '#',
                                                                'visible'=>'Yii::app()->user->adminhr',
                                                                // 'options' => array('rel' => 'tooltip','data-toggle' => 'tooltip','title' => 'Reject'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-danger"><i class="fa fa-remove"></i></button>',
                                                                'options' => array(
                                                                    'class' => 'tolak',
                                                                    'data-toggle' => 'modal',
                                                                    'id' => '\'\'.$data["idcontent"]',
                                                                    'data-target' => '#modal_tolak',
                                                                    'onclick' => 'show(this)',
                                                                    'title' => 'Reject',
                                                                ),  
                                                            ),
            
                                                ),   
                                            ),
                                            // array(
                                            //     'class' => 'bootstrap.widgets.TbButtonColumn',
                                            //     'htmlOptions' => array('style' => 'text-align: center','width: 100px'),
                                            //     'template' => '{view}{update}{delete}',
                                            //     'buttons' => array(
                                            //                 'view' => array(
                                            //                     'url' => 'Yii::app()->createUrl("/content/view", array("action"=>"view","id"=>$data["idcontent"]))',      
                                            //                 ),
                                            //                 'update' => array(
                                            //                     'url' => 'Yii::app()->createUrl("/content/update", array("action"=>"edit","id"=>$data["idcontent"]))',
                                            //                     'visible'=>'$data["divisi_create"]==User::model()->findByAttributes(array("N_NIK"=>Yii::app()->user->logAdmin))->V_SHORT_DIVISI?true:false',
                                            //                 ),
                                            //                 'delete' => array(
                                            //                     'url' => 'Yii::app()->createUrl("/content/deletes", array("action"=>"delete","id"=>$data["idcontent"]))',
                                            //                     'visible'=>'Yii::app()->user->adminhr',      
                                            //                 ),
            
                                            //             ),   
                                            // ),
                                        ),
                                    ));
                                    Yii::app()->clientScript->registerScript('re-install-date-picker', "
                                    function reinstallDatePicker(id, data) {
                                            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
                                        $('#created_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy/mm/dd'}));
                                        $('#updated_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy/mm/dd'}));
                                    }
                                    ");                    
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


<?php echo $this->renderPartial('_mtolak', array('model'=>$model)); ?>

<script type="text/javascript">
    // $("#tolak").click(function(){
    //     var ids = $(this).attr('data-id');
    //     alert(ids);
    //     $(".modal-body #ids").val( ids );
    //     // $('#modal_tolak').modal('show');
    // });
    function show(elem){
        var ids = $(elem).attr('id');
        // alert(ids);
        $(".modal-body #ids").val( ids );
        // $('#modal_tolak').modal('show');
    }
</script>