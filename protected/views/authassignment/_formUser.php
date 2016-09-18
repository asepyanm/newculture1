<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Search User</h3>
            </div>
            <div class="modal-body">
            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'id' => 'content-grid',
                'dataProvider' => $user->search(),
                'filter' => $user,
                'itemsCssClass' => 'table table-bordered table-striped',
                'columns' => array(
                    array(
                        'name'=>'N_NIK',
                        'header'=>'NIK',
                        'value'=>'$data->N_NIK',
                        'htmlOptions'=>array('width'=>'50'),
                    ),
                    array(
                        'name'=>'V_NAMA_KARYAWAN',
                        'header'=>'Nama Karyawan',
                    ),
                    //'C_KODE_DIVISI',
                    array(
                        'name'=>'V_SHORT_DIVISI',
                        'header'=>'Divisi',
                        'value'=>'$data->V_SHORT_DIVISI',
                        'htmlOptions'=>array('width'=>'50'),
                    ),
                    array(
                        'name'=>'V_SHORT_POSISI',
                        'header'=>'JABATAN',
                    ), 
                    // array
                    // (
                    //     'class'=>'CButtonColumn',
                    //     'header'=>'Action',
                    //     'template'=>'{add}',
                    //     'htmlOptions' => array('style'=>'text-align:center;vertical-align:middle;font-size:11px'),
                    //     'buttons'=>array
                    //     (
                    //         'add' => array
                    //         (
                    //             'label' => '<i class="icon-user"></i>',
                    //             // 'url' => '"javascript:LoadDataMenu(\''.$type.'\',$data->N_NIK,\'$data->N_NIK / $data->V_NAMA_KARYAWAN\');"',
                    //         ),
                    //     ),
                    // ),
                    array(
                        'class' => 'MyButtonColumn',
                        'template' => '{pilih}',
                        'htmlOptions' => array(
                            'style' => 'width:12%',
                        ),
                        'buttons' => array(
                                    'pilih' => array(
                                        // 'url' => 'Yii::app()->createUrl("/Content/view", array("id"=>$data["N_NIK"]))',
                                        'options' => array(
                                            'rel' => 'tooltip',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'Pilih',
                                            'class' => 'btnAdd',
                                            'id'=>'\'\'.$data->N_NIK',
                                        ),
                                        
                                        'label'=>'<button class="btn btn-sm btn-outline btn-success"><i class="fa fa-check"></i></button>',     
                                    ),

                        ),   
                    ),
                ),
            )); 
            ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).on('click', '.btnAdd', function () {
    document.getElementById("nik").value = $(this).attr('id');
    $("#myModal").modal('hide');
    //$("[data-dismiss=modal]").trigger({ type: "click" });
    return false;
});
</script>