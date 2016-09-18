<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
<?php
    /* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
?>

<section id="exp" class="wow animated fadeIn bg-custom" data-wow-duration="2s">
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
		            <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>#expert"><?php echo $kategori->nama; ?></a></li>
		            <li class="active">Our Experts</li>
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
	            <hr style="width:40%;height:2px;background-color:#000;color:#000;">
	            <h4 class="section-subheading text-muted"><?php echo $sub->deskripsi; ?></h4>
	        </div>
	    </div>
	    <?php
	       }
	    ?>

		<div class="row">
			<div class="col-sm-5">
                <div class="listJourney">
                    <div class="row">
                        <?php
                        if(isset($expertsub)){
                          foreach ($expertsub as $value) {
                        ?>
                        <div class="col-md-6">
                            <div id="gbr-exp" data-id="<?php echo $value['idcontent']; ?>" class="bg-know img-hover" style="cursor:pointer;border: 5px solid #fff;background:url(<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>) no-repeat top / 100%"></div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
			</div>
            <div class="col-sm-7">
                <div id="detail_exp"></div>
            </div>
		</div>
	</div>
</section>

<script type='text/javascript'>
$(document).ready(function() {
    $("#detail_exp").load("<?php echo Yii::app()->createAbsoluteUrl('Sub/detailexpsess'); ?>");
});
$(document).on("mouseover","#gbr-exp",function(){
    var id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url : "<?php echo Yii::app()->createAbsoluteUrl('Sub/detailexp'); ?>",
        data: "id="+id,
        success: function(msg) {
          $('#detail_exp').html(msg);
        }
    })
});
</script>