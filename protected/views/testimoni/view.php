<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/jquery/dist/jQuery-2.1.4.min.js"></script>
<?php
/* @var $this ContentController */
/* @var $model Content */
?>
		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Detail Testimoni</h2>
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
											<th style="width:15%">CREATED BY</th>
											<td> (<?php echo $model->nik_user; ?>)</td>
										</tr>
										<tr>
											<th>CREATED DATE</th>
											<td><?php echo $model->created_date; ?></td>
										</tr>
											<th>ISI TESTIMONI</th>
											<td><?php echo $model->isi_testimoni; ?></td>
										</tr>
										<tr>
											<th>STATUS</th>
											<td><?php echo $model->stts_testimoni==0 ? 'Draft' : 'Publish'; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<?php if(!empty($model['video'])){ ?>
							<div class="well">
								<video src="<?php echo Yii::app()->createUrl('/Testimoni/displayVideo', array('id'=>$model->id_testimoni)); ?>" controls /></video>
							</div>
							<?php } ?>
						
						</div>
					</div>
				</div>
			</div>
		</div>
