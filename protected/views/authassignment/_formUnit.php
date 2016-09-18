<div class="modal fade" id="myModalUnit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Search User</h3>
            </div>
            <div class="modal-body">
            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'id' => 'unit-grid',
                'dataProvider' => $unit->search(),
                'filter' => $unit,
                'itemsCssClass' => 'table table-bordered table-striped',
                'columns' => array(
                    array(
                        'name'=>'id_divisi',
                        'header'=>'Divisi',
                        'value'=>'Divisi::model()->findByAttributes(array("id_divisi"=>$data->id_divisi))->nama_divisi',
                        'htmlOptions'=>array('width'=>'50'),
                        'filter'=>CHtml::listData($listdivisi, 'id_divisi', 'nama_divisi')
                    ),
                    array(
                        'name'=>'nama_unit',
                        'header'=>'Nama Unit',
                    ),
                   array(
                            'header'=>'Pilih',
                            'type'=> 'raw',
                            //'value'=> '<i data-id="$data->telkomnik" data-nama="$data->nama_karyawan" data-posisi="$data->short_posisi" id=\'pilih\' class=\'fa fa-check\' style="cursor:pointer;"></i>',
                            'value'=> 'CHtml::tag("i", array("class"=>"fa fa-check","id"=>"pilih", "data-id"=>$data->id_unit,"data-nama"=>$data->nama_unit, "style"=>"cursor:pointer;text-align:center;"))',
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
    document.getElementById("unit").value = $(this).attr('data-nama');
    document.getElementById("id_unit").value = $(this).attr('data-id');
    $("#myModalUnit").modal('hide');
    //$("[data-dismiss=modal]").trigger({ type: "click" });
    return false;
});
</script>