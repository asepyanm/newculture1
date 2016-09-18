<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/normalize.css" />
<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/demo.css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/component.css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/modernizr.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Give+You+Glory' rel='stylesheet' type='text/css'>
<style type="text/css">
.pgallery{
	font-family: "Give You Glory", cursive;
	color: #a7a0a2;
	text-align: left;
	font-size: 22px;
	line-height: 1.25;
}
</style>
<section id="gallery" class="photostack photostack-start">
				<div>
					<?php
                    if(isset($galleri)){
                        foreach ($galleri as $value) {
                    ?>
					<figure>
						<a href="#" style="background:url(<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>) no-repeat top center / cover;" class="photostack-img"></a>
						<figcaption>
							<h2 class="photostack-title"><?php echo $value['judul']; ?></h2>
							<div class="photostack-back">
								<p class="pgallery"><?php echo $value['sinopsis']; ?></p>
							</div>
						</figcaption>
					</figure>
					<?php
                        }
                    }
                    ?>
					<!-- <figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/7.jpg" alt="img07"/></a>
						<figcaption>
							<h2 class="photostack-title">Lovely Green</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/8.jpg" alt="img08"/></a>
						<figcaption>
							<h2 class="photostack-title">Wonderful</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/9.jpg" alt="img09"/></a>
						<figcaption>
							<h2 class="photostack-title">Love Addict</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/10.jpg" alt="img10"/></a>
						<figcaption>
							<h2 class="photostack-title">Friendship</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/11.jpg" alt="img11"/></a>
						<figcaption>
							<h2 class="photostack-title">White Nights</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/12.jpg" alt="img12"/></a>
						<figcaption>
							<h2 class="photostack-title">Serendipity</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/13.jpg" alt="img13"/></a>
						<figcaption>
							<h2 class="photostack-title">Pure Soul</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/14.jpg" alt="img14"/></a>
						<figcaption>
							<h2 class="photostack-title">Winds of Peace</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/15.jpg" alt="img15"/></a>
						<figcaption>
							<h2 class="photostack-title">Shades of blue</h2>
						</figcaption>
					</figure>
					<figure data-dummy>
						<a href="#" class="photostack-img"><img src="img/16.jpg" alt="img16"/></a>
						<figcaption>
							<h2 class="photostack-title">Lightness</h2>
						</figcaption>
					</figure> -->
				</div>
			</section>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/classie.js"></script>
		<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/photostack.js"></script>
		<script>
			// [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );
			
			
			new Photostack( document.getElementById( 'gallery' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
			
		</script>