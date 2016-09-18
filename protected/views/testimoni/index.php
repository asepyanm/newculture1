<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<style type="text/css">
	.portfolio-modal .close-modal{position:absolute;width:75px;height:75px;background-color:transparent;top:25px;right:25px;cursor:pointer}.portfolio-modal .close-modal:hover{opacity:.3}.portfolio-modal .close-modal .lr{height:75px;width:1px;margin-left:35px;background-color:#e41b13;transform:rotate(45deg);-ms-transform:rotate(45deg);-webkit-transform:rotate(45deg);z-index:1051}.portfolio-modal .close-modal .lr .rl{height:75px;width:1px;background-color:#e41b13;transform:rotate(90deg);-ms-transform:rotate(90deg);-webkit-transform:rotate(90deg);z-index:1052}
</style>
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
                    <h1 class="page-header">Manage Testimoni</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <a style="float:right;" class="btn btn-outline btn-primary" href="<?php echo Yii::app()->createUrl('Testimoni/create'); ?>"><i class="fa fa-plus"></i> Add Testimoni</a></div>
                            <div class="dataTable_wrapper">
                                <?php $this->widget('bootstrap.widgets.TbGridView', array(
                                        'id' => 'content-grid',
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
                                            // array(
                                            //     'name' => 'idcontent',
                                            //     // 'value' => '$data[\'historyLogs\'][\'created_by\']',
                                            //     'value' => 'empty($data[\'historyLogs\'][\'created_by\']) ? null : $data[\'historyLogs\'][\'created_by\']',
                                            //     'filter' => CHtml::listData(HistoryLog::model()->findAll(), 'idcontent', 'created_by'),
                                            // ),
                                            array(
                                                'header'=>'CREATED BY',
                                                'name'=>'nik_user',
                                                'type'=>'raw',
                                                'value'=>'$data["nik_user"] . "<br/>" . User::model()->findByAttributes(array("N_NIK"=>$data->nik_user))->V_NAMA_KARYAWAN',
                                            ),
                                            'isi_testimoni',
                                            array(
                                                'header'=>'VIDEO',
                                                'name'=>'video_name',
                                                'type'=>'raw',
                                                'value'=>'$data->video!=null ? "<a id=\'playvideo\' style=\'text-decoration: underline; cursor:pointer;\' data-toggle=\'modal\' data-target=\'#MyModalttw\' data-id=\'$data->id_testimoni\'>Play video <i class=\'fa fa-play-circle\'></i></a>" : "Tidak Ada Video"',
                                            ),
											'created_date',
                                            // array(
                                            //     'class'=>'JToggleColumn',
                                            //     'header'=>'STATUS TESTIMONI',
                                            //     'name'=>'stts_testimoni', // boolean model attribute (tinyint(1) with values 0 or 1)
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
                                                'header'=>'STATUS TESTIMONI',
                                                'name'=>'stts_testimoni',
                                                'type'=>'raw',
                                                'value'=>'$data["stts_testimoni"] == 1 ? CHtml::link("<center><span class=\'label label-success\'><i class=\'fa fa-check\'></i></span></center>",array(\'/Testimoni/switch\',\'id\'=>$data->id_testimoni),array(\'rel\' => \'tooltip\', \'data-toggle\' => \'tooltip\', \'title\' => \'Yes, Click to No\')) : CHtml::link("<center><span class=\'label label-danger\'><i class=\'fa fa-remove\'></i></span></center>",array(\'/Testimoni/switch\',\'id\'=>$data->id_testimoni),array(\'rel\' => \'tooltip\', \'data-toggle\' => \'tooltip\', \'title\' => \'No, Click to Yes\'))',
                                                'filter' => array('0' => 'No', '1' => 'Yes'),
                                                'visible'=>Yii::app()->user->adminhr,
                                            ),
                                            array(
                                                'class' => 'bootstrap.widgets.TbButtonColumn',
                                                'template' => '{lihat}{edit}{hapus}',
                                                'htmlOptions' => array(
                                                    'style' => 'width:12%',
                                                ),
                                                'buttons' => array(
                                                			'lihat' => array(
                                                                'url' => 'Yii::app()->createUrl("/Testimoni/view", array("id"=>$data["id_testimoni"]))',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'View'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-success"><i class="fa fa-eye"></i></button>',     
                                                            ),
                                                            'edit' => array(
                                                                'url' => 'Yii::app()->createUrl("/Testimoni/update", array("id"=>$data["id_testimoni"]))',
                                                                'visible'=>'Yii::app()->user->adminhr || User::model()->findByAttributes(array("N_NIK"=>Yii::app()->user->id))->V_SHORT_UNIT == User::model()->findByAttributes(array("N_NIK"=>$data["nik_user"]))->V_SHORT_UNIT',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Edit'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-info"><i class="fa fa-pencil"></i></button>',
                                                            ),
                                                            'hapus' => array(
                                                                'url' => 'Yii::app()->createUrl("/Testimoni/deleter", array("id"=>$data["id_testimoni"]))',
                                                                'visible'=>'Yii::app()->user->adminhr || User::model()->findByAttributes(array("N_NIK"=>Yii::app()->user->id))->V_SHORT_UNIT == User::model()->findByAttributes(array("N_NIK"=>$data["nik_user"]))->V_SHORT_UNIT',
                                                                'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => 'Hapus', 'onClick'=>'return confirmasi();'),
                                                                'label'=>'<button class="btn btn-sm btn-outline btn-danger"><i class="fa fa-trash"></i></button>',
                                                            ),
            
                                                ),   
                                            ),
                                            // array(
                                            //     'class' => 'bootstrap.widgets.TbButtonColumn',
                                            //     'htmlOptions' => array('style' => 'text-align: center','width: 100px'),
                                            //     'template' => '{view}{update}{delete}',
                                            //     'buttons' => array(
                                            //                 'view' => array(
                                            //                     'url' => 'Yii::app()->createUrl("/Testimoni/view", array("action"=>"view","id"=>$data["id_testimoni"]))',      
                                            //                 ),
                                            //                 'update' => array(
                                            //                     'url' => 'Yii::app()->createUrl("/Testimoni/update", array("action"=>"edit","id"=>$data["id_testimoni"]))',
                                            //                     'visible'=>'Yii::app()->user->adminhr',
                                            //                 ),
                                            //                 'delete' => array(
                                            //                     'url' => 'Yii::app()->createUrl("/Testimoni/deleter", array("action"=>"delete","id"=>$data["id_testimoni"]))',
                                            //                     'visible'=>'Yii::app()->user->adminhr',      
                                            //                 ),
            
                                            //             ),   
                                            // ),
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


<?php echo $this->renderPartial("/sub/_modal_ttw") ?>

<script type="text/javascript">
    $(function(){
            $(document).on('click','#playvideo',function(e){
                e.preventDefault();
                
                $.post('<?php echo CHtml::normalizeUrl(array("sub/playVideoTestimoni")); ?>',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                ); $("#MyModalttw").modal('show');
            });
        });
    function confirmasi(){
        var r = confirm("Are you sure want to delete this data ? ");
            if (r == false) {
                return false;
            }
    }
</script>