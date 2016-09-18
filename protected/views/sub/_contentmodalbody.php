                        <h1>Testimonials about The Telkom Way</h1>
                        <div class="row" style="text-align:left;">
                            <div class="col-md-2">
                                <?php 
                                    echo "<div style=\"margin:0 auto 15px; width:50px; background: url(http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik=".$model->nik_user.") no-repeat top center / cover;\" class=\"img-circle img-responsive img-komen\"></div>";
                                ?>
                            </div>
                            <div class="col-md-10">
                                <h4><?php echo User::model()->findByAttributes(array("N_NIK"=>$model->nik_user))->V_NAMA_KARYAWAN; ?><br></h4>
                                <small>
                                    <i class="fa fa-calendar"></i> <?php echo date("l jS \of F Y",strtotime($model->created_date)); ?>
                                    <i class="fa fa-clock-o"></i> <?php echo date("H:i:s",strtotime($model->created_date)); ?>
                                </small>
                                <p><?php echo $model->isi_testimoni; ?></p>
                                <?php if($model['video']!=null){?>
		                        <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <video width="100%" id="videoKonten" src="<?php echo Yii::app()->createUrl('/sub/displayVideoTestimoni', array('id'=>$model->id_testimoni)); ?>" controls /></video>
                            </div>
                        </div>