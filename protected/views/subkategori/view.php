<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */
?>

<?php
// $this->breadcrumbs=array(
// 	'Subkategoris'=>array('index'),
// 	$model->idsubkategori,
// );

// $this->menu=array(
// 	array('label'=>'List Subkategori', 'url'=>array('index')),
// 	array('label'=>'Create Subkategori', 'url'=>array('create')),
// 	array('label'=>'Update Subkategori', 'url'=>array('update', 'id'=>$model->idsubkategori)),
// 	array('label'=>'Delete Subkategori', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idsubkategori),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage Subkategori', 'url'=>array('admin')),
// );
?>

<?php if(isset($model)){
?>
		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $model->nama; ?></h1>
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
											<th style="width:15%">KATEGORI</th>
											<td><?php echo Kategori::model()->findByAttributes(array('idkategori'=>$model->idkategori))->nama; ?></td>
										</tr>
										<tr>
											<th>DESKRIPSI</th>
											<td><?php echo $model->deskripsi; ?></td>
										</tr>
										<?php if(!empty($model->gambar)){ ?>
										<tr>
											<th>GAMBAR</th>
											<td><img src="<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$model->idsubkategori)); ?>" /></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<?php } ?>
							<?php if(isset($ceklis)){ ?>
							<div class="well">
								<table class="table table-striped table-condensed table-hover">
									<thead>
										<tr>
											<th>JUDUL</th>
											<th>SINOPSIS</th>
											<th>DESKRIPSI</th>
											<th>GAMAR</th>
											<th>VIDEO</th>
											<th>SLIDE</th>
											<th>LINK</th>
											<th>LAMPIRAN</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $ceklis->judul==1?'Yes':'No'; ?></td>
											<td><?php echo $ceklis->sinopsis==1?'Yes':'No'; ?></td>
											<td><?php echo $ceklis->isi==1?'Yes':'No'; ?></td>
											<td><?php echo $ceklis->gambar==1?'Yes':'No'; ?></td>
											<td><?php echo $ceklis->video==1?'Yes':'No'; ?></td>
											<td><?php echo $ceklis->slide==1?'Yes':'No'; ?></td>
											<td><?php echo $ceklis->link==1?'Yes':'No'; ?></td>
											<td><?php echo $ceklis->lampiran==1?'Yes':'No'; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

