<?php
    /* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
?>
    <section id="about" class="wow animated fadeIn bg-custom" data-wow-duration="2s">
        <div class="container">
            <?php
                if(isset($kategori)){
                ?>
            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- <h1 class="page-header">Blog Post
                        <small>by <a href="#">Start Bootstrap</a>
                        </small>
                    </h1> -->
                    <ol class="breadcrumb">
                        <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>">Home</a></li>
                        <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>#portfolio"><?php echo $kategori->nama; ?></a></li>
                        <li class="active">Culture Journey</li>
                    </ol>
                </div>
            </div>
            <?php
                }
            ?>
            <!-- /.row -->
            <?php
                if(isset($sub)){
                ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo $sub->nama; ?></h2>
                    <hr style="width:30%;height:2px;background-color:#000;color:#000;">
                    <h3 class="section-subheading text-muted"><?php echo $sub->deskripsi; ?></h3>
                </div>
            </div>
                <?php
                }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                    <?php
                    if(isset($ourstory)){
                        $no=1;
                        foreach($ourstory as $key=>$val){
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
                                    <p class="text-muted"><?php echo $val->sinopsis; ?>.. <a style="text-decoration:underline;font-weight:bold" href="<?php echo Yii::app()->createUrl("artikel/story",array('id'=>$val->idcontent)); ?>">Read More</a></p>
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
        </div>
    </section>