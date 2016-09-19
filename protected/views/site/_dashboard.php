<!-- Dashboard Section -->

<div id="<?php echo $isidashboard->idkategori; ?>">
    <section id="dashboardx" class="bg-custom">
        <div class="container">
            <?php
            if(isset($isidashboard)){
            ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading wow animated bounceIn"><?php echo $isidashboard->nama; ?></h2>
                    <hr style="width:50%;height:2px;background-color:#000;color:#000;">
                    <h4 class="section-subheading text-muted">&nbsp;</h4>
                </div>
                <?php
                }
            ?>
            </div>
            <div class="row" align="center">                
                    <div class="team-member owl-carousel2" align="center">
                    <?php
                      /*
                        if(isset($dashboard)){
                            $arr_unit=array();
                            foreach($dashboard as $key=>$value){
                                if($val->idsubkategori==36){    ///direktorat
                                    $arr_unit[]=array('order'=>0, 'idsubkategori'=>36, 'nama'=>$value->nama);
                                }elseif($val->idsubkategori==35){   ///divisi
                                    $arr_unit[]=array('order'=>1, 'idsubkategori'=>35, 'nama'=>$value->nama);
                                }elseif($val->idsubkategori==37){   ///witel
                                    $arr_unit[]=array('order'=>2, 'idsubkategori'=>37, 'nama'=>$value->nama);
                                }
                            }
                        }
                        
                        echo "<pre>";
                        print_r($arr_unit);
                        echo "</pre>";
                        exit();
                        */       
                        if(isset($dashboard)){
                            foreach($dashboard as $key=>$val){
                        ?>
                        <div align="center">
                        	<a style="text-decoration:none;display:table;margin:auto;" href="<?php echo Yii::app()->createUrl("sub/subdashboard",array('id'=>$val->idsubkategori)); ?>">
                                <div style="background: url(<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori));?>) no-repeat top center / cover;" class="item-sub2 img-responsive">
                                    <div class="desk">
                                        <h4><?php echo $val->nama; ?></h4>
                                        <p class="text-muted"><?php //echo $val->deskripsi; ?>
										<?php
										 if($val->idsubkategori==36){  //direktorat
                      if(isset($direktorat)){
												$i=1;
												foreach($direktorat as $key1=>$val1){
													echo $i.'. '.$val1['nama_unit'].' : '.$val1['nilai'];
													echo "<br />";
													++$i;
												}
											}									 
										 }elseif($val->idsubkategori==35){   //divisi
												if(isset($divisi)){
												$i=1;
												foreach($divisi as $key1=>$val1){
													echo $i.'. '.$val1['nama_unit'].' : '.$val1['nilai'];
													echo "<br />";
													++$i;
												}
											}									 
										 }elseif($val->idsubkategori==37){  ///witel
											if(isset($witel)){
												$i=1;
												foreach($witel as $key1=>$val1){
													echo $i.'. '.$val1['nama_unit'].' : '.$val1['nilai'];
													echo "<br />";
													++$i;
												}
											}
										 
										 }
											
										?>
										</p>
                                    </div>
                                </div>
                            </a>
                            <!-- <img src="<?php //echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori)); ?>" class="img-responsive" alt=""> //-->
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                
            </div>
            <div class="row">
            <?php
                if(isset($isidashboard)){
                ?>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted"><?php echo $isidashboard->deskripsi; ?></p>
                </div>
                <?php
                }
            ?>
            </div>
        </div>
    </section>
</div>