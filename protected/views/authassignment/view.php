<?php
/* @var $this AuthassignmentController */
/* @var $model Authassignment */
?>

<?php
$this->breadcrumbs=array(
	'Authassignments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Authassignment', 'url'=>array('index')),
	array('label'=>'Create Authassignment', 'url'=>array('create')),
	array('label'=>'Update Authassignment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Authassignment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Authassignment', 'url'=>array('admin')),
);
?>

		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $model->V_NAMA_KARYAWAN; ?> (<?php echo $model->nik; ?>)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                            	<table class="table table-striped table-condensed table-hover">
									<tbody>
										<tr>
											<th style="width:15%">FOTO</th>
											<td></td>
										</tr>
										<tr>
											<th>DIVISI</th>
											<td><?php echo $model->V_SHORT_DIVISI; ?></td>
										</tr>
										<tr>
											<th>JABATAN</th>
											<td><?php echo $model->V_SHORT_POSISI; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>