
    <div class="container">
    <?php if(isset($art)){
        foreach ($art as $value) {
            
    ?>
        <!-- Page Heading/Breadcrumbs -->
        
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Blog Sidebar Widgets Column -->
            

            <!-- Blog Post Content Column -->
            <div class="col-lg-12 col-md-12 col-sm-12" id="mydiv">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <!-- Blog Post -->
                        <h1 class="page-header"><?php echo $value['judul']; ?></h1>
                        <!-- Date/Time -->
                        
                        <div style="margin-top:15px;margin-bottom:5px;">
                            <i class="fa fa-calendar"></i> <?php echo date("l jS \of F Y",strtotime($value['updated_date'])); ?>
                            <i class="fa fa-clock-o"></i> <?php echo date("H:i:s",strtotime($value['updated_date'])); ?>
                        </div>
                        <?php 
                        if($value['idsubkategori']!=1){?>
                        <div style="font-style:italic;margin-bottom:15px;"><i class="fa fa-user"></i> <?php echo $value['V_NAMA_KARYAWAN']; ?> - <?php echo ucwords(strtolower($value['V_SHORT_UNIT'])); ?></div>
                        <?php } ?>
                        <!-- <hr> -->

                        <!-- Preview Image -->
                        <!-- <img class="img-responsive" src="http://placehold.it/900x300" alt=""> -->

                        <!-- <hr> -->

                        <!-- Post Content -->
                        <?php 
                            $img = base64_encode($value['gambar']);
                            if(isset($img)){
                               echo "<img class='img-wrap-rev-jou' src=\"data:image/jpeg;charset=utf-8;base64,".$img."\" >";
                            }
                            ?>
                        <!-- <img class="img-wrap-rev" src="<?php// echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" alt=""> -->
                        <p><?php echo $value['isi']; ?></p>

                        <!-- Blog Comments -->
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <?php
                        // $vid = $value['video'];
                        // if($vid!="")
                        { ?>
                        <hr>
                        <div>
                            <div>
                                <video src="<?php //echo Yii::app()->createUrl('/Content/displayVideo', array('id'=>$value['idcontent'])); ?>" controls /></video>
                            </div>
                        </div>
                        
                        <?php }
                        ?>
                    </div>
                </div> -->
            <?php }
            }
            ?> 
                <!-- <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12"> 
                        <?php
                        //if($lampiran!=null){
                        ?>
                        <hr>
                        <div class="well">Lampiran : 
                        <?php
                           // foreach ($lampiran as $value) {
                        ?>
                            <div>
                                <?php// echo CHtml::link($value->filename, array('Content/displayFile', 'id'=>$value->idlampiran), array('target'=>'_blank','style'=>'text-decoration:none')); ?>
                            </div>
                        <?php //}
                        ?>
                        </div>
                        
                        <?php 
                        //} ?>
                    </div>
                </div> -->

            </div>

        </div>
    </div>
