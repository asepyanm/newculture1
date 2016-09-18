    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pilih Karyawan</h4>
                    </div>
                    <div class="modal-body">
                    <div class="isi">
                          <?php $this->widget('bootstrap.widgets.TbGridView',array(
                                'id'=>'user-grid',
                                'dataProvider'=>Yii::app()->user->itemname == 'adminhr' ? $user->search() : $user->search_by_divisi(array($divisi)),
                                'filter'=>$user,
                                'columns'=>array(
                                    array(
                                        'header'=>'NIK',
                                        'name'=>'N_NIK',
                                        ),
                                    array(
                                        'header'=>'NAMA KARYAWAN',
                                        'name'=>'V_NAMA_KARYAWAN',
                                        ),
                                    
                                    // 'V_SHORT_UNIT',
                                    // 'V_SHORT_POSISI',
                                    array(
                                        'header'=>'DIVISI',
                                        'name'=>'V_SHORT_DIVISI',
                                        ),
                                    array(
                                        'header'=>'POSISI',
                                        'name'=>'V_SHORT_POSISI',
                                        ),
                                    array(
                                        'header'=>'Pilih',
                                        'type'=> 'raw',
                                        //'value'=> '<i data-id="$data->telkomnik" data-nama="$data->nama_karyawan" data-posisi="$data->short_posisi" id=\'pilih\' class=\'fa fa-check\' style="cursor:pointer;"></i>',
                                        'value'=> 'CHtml::tag("i", array("class"=>"fa fa-check", "data-id"=>$data->N_NIK,"data-nama"=>$data->V_NAMA_KARYAWAN,"data-posisi"=>$data->V_SHORT_POSISI,"data-unit"=>$data->V_SHORT_UNIT,"data-divisi"=>$data->V_SHORT_DIVISI, "id"=>"pilih", "style"=>"cursor:pointer;", "data-dismiss"=>"modal"))',
                                    ),
                                ),
                            )); ?>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>