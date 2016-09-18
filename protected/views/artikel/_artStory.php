<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>'+window.location.href+'</title>');
        mywindow.document.write('<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">');
        mywindow.document.write('<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/agency.css" rel="stylesheet">');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
<!-- Page Content -->
<section class="wow animated fadeIn" data-wow-duration="2s">
    <div class="container">
    <?php if(isset($artstory)){
        foreach ($artstory as $value) {
            
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
                    <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>#portfolio"><?php echo $value['namakat']; ?></a></li>
                    <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("Sub/Story", array('id'=>$value['idsubkategori'])); ?>#about"><?php echo $value['namasub']; ?></a></li>
                    <li class="active"><?php echo $value['judul']; ?></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-9 col-md-9 col-sm-9" id="mydiv">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <!-- Blog Post -->
                        <h1 class="page-header"><?php echo $value['judul']; ?></h1>
                        <!-- Date/Time -->
                        <div style="margin-bottom:15px;margin-top:15px;">
                            <i class="fa fa-calendar"></i> <?php echo date("l jS \of F Y",strtotime($value['updated_date'])); ?>
                            <i class="fa fa-clock-o"></i> <?php echo date("H:i:s",strtotime($value['updated_date'])); ?>
                            <?php if(isset($artstory)) { ?>
                                <a style="margin-left:10px;cursor:pointer;float:right;border:1px solid #1FBBA8;padding:5px 10px 6px;" onclick='window.open("<?php echo Yii::app()->createUrl('/artikel/print',array('id'=>$id)); ?>", "myWin", "scrollbars=yes, menubar=no, width=480, height=600")'><i style="color:#1FBBA8;" class="fa fa-print fa-2x"></i></a>
                            <?php } ?>
                        </div>

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
                        <!-- <img class="img-wrap-rev" src="<?php //echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" alt=""> -->
                        
                        <p><?php echo $value['isi']; ?></p>

                        <!-- Blog Comments -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php
                        $vid = $value['video'];
                        if($vid!="")
                        { ?>
                        <hr>
                        <div>
                            <div>
                                <video src="<?php echo Yii::app()->createUrl('/Content/displayVideo', array('id'=>$value['idcontent'])); ?>" controls /></video>
                            </div>
                        </div>
                        
                        <?php }
                        ?>
                    </div>
                </div>
        <?php }
        }
        ?>  
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php
                        if($lampiran!=null){
                        ?>
                        <hr>
                        <div class="well">Lampiran : 
                        <?php
                            foreach ($lampiran as $value) {
                        ?>
                            <div>
                                <?php echo CHtml::link($value->filename, array('Content/displayFile', 'id'=>$value->idlampiran), array('target'=>'_blank','style'=>'text-decoration:none')); ?>
                            </div>
                        <?php }
                        ?>
                        </div>
                        
                        <?php 
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php
                            $this->widget('application.extensions.SocialShareButton.SocialShareButton', array(
                                    'style'=>'horizontal',
                                    'networks' => array('facebook','googleplus','linkedin','twitter'),
                                    // 'data_via'=>'rohisuthar', //twitter username (for twitter only, if exists else leave empty)
                            ));
                        ?>
                    </div>
                </div>
                <?php if(!Yii::app()->user->isGuest){ ?>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'tcomment-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'onsubmit'=>"return formValidator()",
                            'enctype'=>'multipart/form-data'
                    ),
                  ));
                ?>
                <?php echo $form->errorSummary($komen); ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <!-- Blog Comments -->
                        <!-- Comments Form -->
                        <div class="well">
                            <h4>Leave a Comment:</h4>
                            <form role="form">
                                <div class="form-group">
                                    <?php echo $form->textArea($komen, 'isi_comment', array('rows' => 3, 'cols' => 50, 'class' => 'form-control', 'id'=>'isi_comment', 'onkeyup'=>'javascript:batas2(this);')); ?>
                                    <?php echo $form->error($komen, 'isi_comment'); ?>
                                    <br>
                                    Total character count: <span id="display_count">0</span> characters. Characters left: <span id="word_left">200</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                        <hr>
                    </div>
                </div>
                <?php $this->endWidget(); ?>

                <?php
                    if($komentar!=null){
                ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <!-- Posted Comments -->
                        <?php foreach ($komentar as $value) {
                        ?>
                        <!-- Comment -->
                        <div class="row">
                            <div class="col-md-2">
                                <?php 
                                $fotoimg = base64_encode(file_get_contents('http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik='.$value->nik_user));
                                if(isset($fotoimg)){
                                    //echo "<img src=\"data:image/jpeg;charset=utf-8;base64,".$fotoimg."\" class=\"media-object img-circle img-responsive img-komen\">";
                                    echo "<img style=\"background: url(http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik=".$value->nik_user.") no-repeat top center / cover;\" class=\"media-object img-circle img-responsive img-komen\">";
                                }
                                ?>
                            </div>
                            <div class="col-md-10">
                                <h4><?php echo User::model()->findByAttributes(array("N_NIK"=>$value->nik_user))->V_NAMA_KARYAWAN; ?><br></h4>
                                <small>
                                    <i class="fa fa-calendar"></i> <?php echo date("l jS \of F Y",strtotime($value->created_date)); ?>
                                    <i class="fa fa-clock-o"></i> <?php echo date("H:i:s",strtotime($value->created_date)); ?>
                                </small>
                                <p><?php echo $value->isi_comment; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">

                <!-- Blog Search Well -->
                

                <!-- Blog Categories Well -->
                <?php if(isset($storyLain)){
                ?>
                <!-- <div class="text-center"> -->
                    <h4>Another Story</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            foreach ($storyLain as $stoL) {
                            ?>
                            <div class="row">
                                <div class="col-lg-5 col-sm-5 col-md-5">
                                    <div style="background: url(<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$stoL['idcontent'])); ?>) no-repeat top center / cover;width:100px;height:100px;margin-right:10px;"></div>
                                </div>
                                <div class="col-lg-7 col-sm-7 col-md-7">
                                    <a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("artikel/story",array('id'=>$stoL->idcontent)); ?>">
                                        <?php echo $stoL->judul; ?>
                                    </a><br>
                                    <div style="font-size:12px;font-family:'Conv_GothamRnd-Light';"><i class="fa fa-calendar"></i> <?php echo date("d M y",strtotime($stoL->created_date)); ?></div>
                                    <div style="font-size:12px;font-family:'Conv_GothamRnd-Light';"><i class="fa fa-clock-o"></i> <?php echo date("H:i",strtotime($stoL->created_date)); ?></div>
                                </div>
                            </div>
                            <hr>
                            <?php }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                <!-- </div> -->
                <?php
                } ?>

            </div>
        </div>
    </div>
    <!-- /.container -->
</section>
<script type="text/javascript">
function batas(e) {
    var words = e.value.match(/\S+/g).length;

    if (words > 200) {
      // Split the string on first 200 words and rejoin on spaces
      var trimmed = $(e).val().split(/\s+/, 200).join(" ");
      // Add a space at the end to make sure more typing creates new words
      $(e).val(trimmed + " ");
    }
    else {
      $('#display_count').text(words);
      $('#word_left').text(200-words);
    }
  }
function batas2(e) {

    var maxLength = 200;
    var chars = e.value.length;   
    // alert(chars);
    if (chars > maxLength) {
      // Split the string on first 200 words and rejoin on spaces
      // var trimmed = $(e).val().split(/\s+/, 200).join(" ");
      // // Add a space at the end to make sure more typing creates new words
      // $(e).val(trimmed + " ");
      e.value = e.value.substring(0, maxLength);
    }
    else {
      $('#display_count').text(chars);
      $('#word_left').text(200-chars);
    }
  }
</script>