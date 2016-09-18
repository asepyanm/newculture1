<!-- Activation Section -->
    <section id="expert" class="bg-light-gray bg-custom2">
        <div class="container">
            <div class="row">
            <?php
                if(isset($isiexpertknow)){
                ?>
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading wow animated flipInY"><?php echo $isiexpertknow->nama; ?></h2>
                    <hr style="width:50%;height:2px;background-color:#000;color:#000;">
                    <h4 class="section-subheading text-muted">&nbsp;</h4>
                </div>
                <?php
                }
            ?>
            </div>
            <div class="row">
                <?php
                if(isset($expertknow)){
                    foreach($expertknow as $key=>$val){
                        if($val->idsubkategori==6){
                ?>
                <div class="col-sm-6">
                    <div class="team-member">
                        <div style="background: url(<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori));?>) no-repeat top center / cover;width:350px;height:350px;margin:auto;" class="img-bordered img-responsive"></div>
                        <!-- <img style="width:65% !important;" src="<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori)); ?>" class="img-responsive" alt=""> -->
                        <h3><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("Sub/Knowledge",array('id'=>$val->idsubkategori)); ?>#knowing"><?php echo $val->nama; ?></a></h3>
                        <p class="text-muted"><?php echo $val->deskripsi; ?></p>
                    </div>
                </div>
                <?php
                        }else if($val->idsubkategori==7){
                ?>
                <div class="col-sm-6">
                    <div class="team-member">
                        <div style="background: url(<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori));?>) no-repeat top center / cover;width:350px;height:350px;margin:auto;" class="img-bordered img-responsive"></div>
                        <!-- <img style="width:65% !important;" src="<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori)); ?>" class="img-responsive" alt=""> -->
                        <h3><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("Sub/Expert",array('id'=>$val->idsubkategori)); ?>#exp"><?php echo $val->nama; ?></a></h3>
                        <p class="text-muted"><?php echo $val->deskripsi; ?></p>
                    </div>
                </div>
                <?php 
                        }
                    }
                }
                ?>
            </div>
            <div class="row">
            <?php
                if(isset($isiexpertknow)){
                ?>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted"><?php echo $isiexpertknow->deskripsi; ?></p>
                </div>
                <?php
                }
            ?>
            </div>
        </div>
    </section>