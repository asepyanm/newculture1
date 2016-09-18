<section id="kategori" class="bg-light-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<hr style="width:30%;height:3px;background-color:#000;color:#000;">
				<h2 class="section-heading wow animated flip">Our Culture</h2>
				<hr style="width:30%;height:3px;background-color:#000;color:#000;">
				<h4 class="section-subheading text-muted">&nbsp;</h4>
			</div>
		</div>
		<div class="row text-center">
		<?php
		if(isset($model)){
			foreach($model as $key=>$val){
		?>
			<div class="col-md-3">
				<span class="fa-stack fa-4x">
					<i class="fa fa-circle fa-stack-2x wow bounceIn text-primary"></i>
					<!-- <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i> -->
					<?php 
					// echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$val->foto)); 
					?>
				</span>
				<h4 class="service-heading"><?php echo $val->nama; ?></h4>
				<p class="text-muted"><?php echo $val->deskripsi; ?></p>
			</div>
		<?php
			}
		}
		?>
		</div>
	</div>
</section>