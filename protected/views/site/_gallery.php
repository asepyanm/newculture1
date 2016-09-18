<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
<!-- Gallery Section -->
    <section id="gallery" class="bg-custom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- <h1 class="page-header">Blog Post
                        <small>by <a href="#">Start Bootstrap</a>
                        </small>
                    </h1> -->
                    <ol class="breadcrumb">
                        <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>">Home</a></li>
                        <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>#gallery">Expression Corner</a></li>
                        <li class="active">Expression Corner</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Expression Corner</h2>
                    <hr style="width:30%;height:2px;background-color:#000;color:#000;">
                    <h4 class="section-subheading text-muted">&nbsp;</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="listJourney">
                        <div class="row">
                            <?php
                            if(isset($galleri)){
                                foreach ($galleri as $value) {
                            ?>
                                <div class="col-md-3">
                                    <a id="modGal" href="#MyModal" data-judul="<?php echo $value['judul']; ?>" data-sinopsis="<?php echo $value['sinopsis']; ?>" data-gambar="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" data-toogle="modal" class="page-scroll">
                                        <div id="hoverbg" style="position:relative; display:block;margin-bottom:15px;">
                                            <div class="bg-galleri" style="background:url(<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>) no-repeat center / 100%"></div>
                                            <div class="ket">
                                                <h5><?php echo $value['judul']; ?></h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php echo $this->renderPartial("/site/_modalGal") ?>

<script type="text/javascript">
$(document).on("click", "#modGal", function () {
    var judul = $(this).data('judul');
    var sinopsis = $(this).data('sinopsis');
    var gambar = $(this).data('gambar');
    $(".modal-body #judul").innerHTML = judul;
    $(".modal-body #sinopsis").innerHTML = sinopsis;
    $(".modal-body #gambar").attr('src', gambar);
    $('#MyModal').modal('show');
});
</script>
