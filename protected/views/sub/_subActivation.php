<?php
    /* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
?>

<?php
  if(isset($sub)){
?>
<div id="<?php echo $sub->idsubkategori; ?>">
<?php
    }
?>
<section id="legend" class="wow animated fadeIn bg-custom" data-wow-duration="2s">
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

		<div class="row">
			<div class="col-lg-12 col-md-12">
			<?php
			if(isset($artact)){
			 	$this->widget('zii.widgets.CListView', array(
					'dataProvider'=>$modelart,
					'itemView'=>'_view_item',
				));
			}
			?>
			</div>
		</div>
	</div>
</section>
</div>