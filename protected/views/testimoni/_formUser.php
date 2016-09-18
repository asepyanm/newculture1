<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Search Karyawan</h3>
            </div>
            <div class="modal-body">
            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'id' => 'content-grid',
                'dataProvider' => Yii::app()->user->itemname == 'adminhr' ? $user->search() : $user->search_by_divisi(array($divisi)),
                'filter' => $user,
                'itemsCssClass' => 'table table-bordered table-striped',
                'columns' => array(
                    array(
                        'header'=>'NIK',
                        'name'=>'N_NIK',
                        'value'=>'$data->N_NIK',
                        'htmlOptions'=>array('width'=>'50'),
                    ),
                    array(
                        'header'=>'NAMA',
                        'name'=>'V_NAMA_KARYAWAN',
                    ),
                    //'C_KODE_DIVISI',
                    array(
                        'name'=>'V_SHORT_UNIT',
                        'header'=>'UNIT',
                        'value'=>'$data->V_SHORT_UNIT',
                        'htmlOptions'=>array('width'=>'50'),
                    ),
                    array(
                        'name'=>'V_SHORT_POSISI',
                        'header'=>'POSISI',
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
                            'header'=>'Pilih',
                            'type'=> 'raw',
                            //'value'=> '<i data-id="$data->telkomnik" data-nama="$data->nama_karyawan" data-posisi="$data->short_posisi" id=\'pilih\' class=\'fa fa-check\' style="cursor:pointer;"></i>',
                            'value'=> 'CHtml::tag("i", array("class"=>"fa fa-check", "data-id"=>$data->N_NIK,"data-nama"=>$data->V_NAMA_KARYAWAN,"data-unit"=>$data->V_SHORT_UNIT,"data-posisi"=>$data->V_SHORT_POSISI, "id"=>"pilih", "style"=>"cursor:pointer;", "data-dismiss"=>"modal"))',
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
$(document).on('click', '#pilih', function () {
    document.getElementById("nik").value = $(this).attr('data-id');
    document.getElementById("nama").value = $(this).attr('data-nama');
    document.getElementById("unit").value = $(this).attr('data-unit');
    document.getElementById("posisi").value = $(this).attr('data-posisi');
    $("#myModal").modal('hide');
    //$("[data-dismiss=modal]").trigger({ type: "click" });
    return false;
});
</script>
