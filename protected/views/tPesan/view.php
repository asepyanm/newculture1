<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/jquery/dist/jQuery-2.1.4.min.js"></script>
<?php
/* @var $this TPesanController */
/* @var $model TPesan */
?>

<?php if(isset($pesan)){
?>

		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><?php echo $pesan['nama']; ?><small> <?php echo date("l jS \of F Y",strtotime($pesan['created_date'])); ?> <?php echo date("H:i:s",strtotime($pesan['created_date'])); ?></small></h2>
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
											<th style="width:15%">NAME</th>
											<td><?php echo $pesan['nama']; ?></td>
										</tr>
										<tr>
											<th>EMAIL</th>
											<td><?php echo $pesan['email']; ?></td>
										</tr>
										<tr>
											<th>PHONE NUMBER</th>
											<td><?php echo $pesan['hp']; ?></td>
										</tr>
										<tr>
											<th>MESSAGE</th>
											<td><?php echo $pesan['isipesan']; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<a class="btn btn-outline btn-primary" style="float:right" href="">Balas</a>
					<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
