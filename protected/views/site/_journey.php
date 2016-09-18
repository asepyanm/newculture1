<!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray bg-custom2">
        <div class="container">
            <div class="row">
            <?php
                if(isset($isijourney)){
                ?>
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading wow animated wobble"><?php echo $isijourney->nama; ?></h2>
                    <hr style="width:40%;height:2px;background-color:#000;color:#000;">
                    <h4 class="section-subheading text-muted">&nbsp;</h4>
                </div>
                <?php
                }
            ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                    <?php
                    if(isset($journey)){
                        $no=1;
                        foreach($journey as $key=>$val){
                        if(($no%2)!=0){
                            $a="";
                        }else{$a="timeline-inverted";}
                    ?>
                        <li class="<?php echo $a; ?>">
                            <div style="background:#fe7474 url(<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$val->idcontent)); ?>)no-repeat center / cover;" class="timeline-image"></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="subheading"><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("artikel/story",array('id'=>$val->idcontent)); ?>"><?php echo $val->judul; ?></a></h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted"><?php echo $val->sinopsis; ?><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("artikel/story",array('id'=>$val->idcontent)); ?>"> Read More</a></p>
                                </div>
                            </div>
                        </li>
                    <?php
                        $no++;
                        }
                    }
                    ?>    
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div id="success"></div>
                    <a class="btn btn-lg btn-primary" href="<?php echo Yii::app()->createUrl("sub/story",array('id'=>1)); ?>"><i class="fa fa-arrow-right"></i> See more</a>
                </div>
            </div>
                
            </div>
        </div>
    </section>