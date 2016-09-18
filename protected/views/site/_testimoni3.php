

	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css"> <!-- Resource style -->
	<script src="<?php echo Yii::app()->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/modernizr.js"></script> <!-- Modernizr -->
	<style type="text/css">
		#playvideotesti:hover { 
		  -webkit-filter: blur(5px);
		  -moz-filter: blur(5px);
		  -o-filter: blur(5px);
		  -ms-filter: blur(5px);
		  filter: blur(5px);
		}
	</style>

<section id="testimoni" class="bg-custom">
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
		            <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>#<?php echo $kategori->idkategori; ?>"><?php echo $kategori->nama; ?></a></li>
		            <li class="active"><?php echo $sub->nama; ?></li>
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
	            <hr style="width:60%;height:2px;background-color:#000;color:#000;">
	            <h4 class="section-subheading text-muted"><?php echo $sub->deskripsi; ?></h4>
	        </div>
	    </div>
	    <?php
	       }
	    ?>
<!-- <div class="row" style="margin-top:10px;">
    <div class="col-lg-12 text-center">
        <h2 class="section-heading wow animated bounceIn" style="color:#ffffff;">Employee Testimonials</h2>
        <hr style="width:50%;height:2px;background-color:#000;color:#000;">
        <h4 class="section-subheading text-muted">&nbsp;</h4>
    </div>
</div> -->
<div style="background: url('<?php echo Yii::app()->theme->baseUrl; ?>/img/head2.jpg') fixed no-repeat top center / cover;">
<div class="cd-testimonials-wrapper cd-container">
	<ul class="cd-testimonials">
		<?php
        if(isset($testimoni)){
            foreach($testimoni as $val){
        ?>
		<li>
			<div class="cd-author">
				<?php 
                    $fotoimg = base64_encode(file_get_contents('http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik='.$val['judul']));
                    echo "<div style=\"margin:0 auto 15px; background: url(http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik=".$val['judul'].") no-repeat top center / cover;\" class=\"img-circle img-responsive img-foto\"></div>";
                ?>
				<ul class="cd-author-info" style="text-align:center;">
					<li style="font-size:19px;"><?php echo User::model()->findByAttributes(array('N_NIK'=>$val['judul']))->V_NAMA_KARYAWAN; ?></li>
					<li style="font-size:14px;color:#a3a3a3;"><?php echo User::model()->findByAttributes(array('N_NIK'=>$val['judul']))->V_SHORT_POSISI; ?></li>
				</ul>
				<p style="font-size:20px;">"<?php echo $val['sinopsis'];?>"</p>
				<?php if($val->video!=null){?><a style="cursor:pointer;" id="playvideotesti" data-toggle="modal" data-target="#MyModalttw" data-id="<?php echo $val->id_testimoni;?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/play.png"></a><?php } ?>
			</div>
		</li>
		<?php
            }
        }
        ?>		
	</ul> <!-- cd-testimonials -->

	<!-- <a href="#0" class="cd-see-all" style="font-size:13px;">See all</a> -->
</div> <!-- cd-testimonials-wrapper -->
</div>
<div class="cd-testimonials-all">
	<div class="cd-testimonials-all-wrapper">
		<ul>
			<?php
	        if(isset($testimoni) || !empty($testimoni)){
	            foreach($testimoni as $key=>$val){
	        ?>
			<li class="cd-testimonials-item">
				<p>"<?php echo $val['sinopsis'];?>"</p>
				
				<div class="cd-author">
				<?php 
                    $fotoimg = base64_encode(file_get_contents('http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik='.$val['judul']));
                    echo "<div style=\"margin:0 auto 15px; width:50px; background: url(http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik=".$val['judul'].") no-repeat top center / cover;\" class=\"img-circle img-responsive img-foto\"></div>";
                ?>
					<ul class="cd-author-info" style="text-align:center;width:100%;">
						<li><?php echo User::model()->findByAttributes(array('N_NIK'=>$val->judul))->V_NAMA_KARYAWAN; ?></li>
						<li><?php echo User::model()->findByAttributes(array('N_NIK'=>$val->judul))->V_SHORT_POSISI; ?></li>
					</ul>
				</div> <!-- cd-author -->
			</li>
			<?php
	            }
	        }
	        ?>	
		</ul>
	</div>	<!-- cd-testimonials-all-wrapper -->

	<a href="#0" class="close-btn">Close</a>
</div> <!-- cd-testimonials-all -->
</div>
</section>
<?php echo $this->renderPartial("/sub/_modal_ttw") ?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/masonry.pkgd.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.flexslider-min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script> <!-- Resource jQuery -->
<script type="text/javascript">
$(function(){
            $(document).on('click','#playvideotesti',function(e){
                e.preventDefault();
                
                $.post('<?php echo CHtml::normalizeUrl(array("sub/playVideoTestimoni")); ?>',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                ); $("#MyModalttw").modal('show');
            });
        });
</script>
