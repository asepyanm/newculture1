<!-- Activation Section -->

<div id="<?php echo $isiactiv->idkategori; ?>">
    <section id="team" class="bg-custom">
        <div class="container">
            <?php
            if(isset($isiactiv)){
            ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading wow animated bounceIn"><?php echo $isiactiv->nama; ?></h2>
                    <hr style="width:50%;height:2px;background-color:#000;color:#000;">
                    <h4 class="section-subheading text-muted">&nbsp;</h4>
                </div>
                <?php
                }
            ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="team-member owl-carousel">
                    <?php
                        if(isset($activation)){
                            foreach($activation as $key=>$val){
                        ?>
                        <div>
                        	<a style="text-decoration:none;display:table;margin:auto;" href="<?php echo Yii::app()->createUrl("sub/subactivation",array('id'=>$val->idsubkategori)); ?>">
                                <div style="background: url(<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori));?>) no-repeat top center / cover;" class="item-sub img-responsive">
                                    <div class="desk">
                                        <h4><?php echo $val->nama; ?></h4>
                                        <p class="text-muted"><?php echo $val->deskripsi; ?></p>
                                    </div>
                                </div>
                            </a>
                            <!-- <img src="<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$val->idsubkategori)); ?>" class="img-responsive" alt=""> -->
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
                if(isset($isiactiv)){
                ?>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted"><?php echo $isiactiv->deskripsi; ?></p>
                </div>
                <?php
                }
            ?>
            </div>
        </div>
    </section>
</div>