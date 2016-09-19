<?php
	/* @var $this SiteController */
	$this->pageTitle=Yii::app()->name;
?>
<!-- Header -->
<style type="text/css">
	.carousel-caption .narasi h5{
		font-size: 15px;
		text-shadow: 1px 1px 0 #eee, -1px -1px 0 #eee, 1px -1px 0 #eee, -1px 1px 0 #eee, 3px 3px 5px rgba(0,0,0,0.8);
		color:#828282;
	}
	.outline {
	   	/*-webkit-text-fill-color: #fff;
	    -webkit-text-stroke-color: #d78965;
	    -webkit-text-stroke-width: 2px;
	    text-fill-color: #fff;
	    text-stroke-color: #d78965;
	    text-stroke-width: 2px;*/
	}
	.hvr-grow {
	    display: inline-block;
	    vertical-align: middle;
	    transform: translateZ(0);
	    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
	    backface-visibility: hidden;
	    -moz-osx-font-smoothing: grayscale;
	    transition-duration: 0.3s;
	    transition-property: transform;
	}

	.hvr-grow:hover,
	.hvr-grow:focus,
	.hvr-grow:active {
	    transform: scale(1.1);
	}
</style>
    <header>
        <!-- <div class="container">
            <div class="intro-text">
                <div class="row">
                    <div class="col-lg-12">
                    	<div class="intro-heading animated slideInLeft">
	                    	<hr style="width:65%;height:2px;background-color:#f3f6db;color:#f3f6db;">
	                    	<hr style="width:60%;height:1px;background-color:#f3f6db;color:#f3f6db;">
	                        The Telkom Way
	                        <hr style="width:60%;height:1px;background-color:#f3f6db;color:#f3f6db;">
	                        <hr style="width:65%;height:2px;background-color:#f3f6db;color:#f3f6db;">
                        </div>
                        <a href="#kategori" class="page-scroll btn btn-xl">Explore</a>
                    </div>
                </div>
            </div>
        </div> -->
        <div id="mycarousel" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <!-- <ol class="carousel-indicators">
		    <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#mycarousel" data-slide-to="1"></li>
		  </ol>  -->

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/header-bg.jpg" data-color="lightblue" alt="First Image">
		      <div class="carousel-caption">
		        <h3></h3>
		      </div>
		    </div>
		    <div class="item">
		      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/bali.jpg" data-color="firebrick" alt="Second Image">
		      <div class="carousel-caption">
		        <h3></h3>
		      </div>
		    </div>
		    <?php foreach ($slide as $value) {
		    ?>
		    <div class="item">
		      <img src="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" data-color="lightblue">
		      <div class="carousel-caption">
		        <div class="captions" >
		        	<a class="hvr-grow outline shadow" href="<?php echo Yii::app()->createUrl('/sub/ttway', array('id'=>2,'list'=>$value['idcontent'])); ?>"><h3><?php echo $value['judul']; ?></h3></a>
		        </div>
		        <div class="narasi"><h5><?php echo $value['sinopsis']; ?></h5></div>
		      </div>
		    </div>
		    <?php
		    }
		    ?>
		    <!-- <div class="item">
		      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/gasing.jpg" data-color="firebrick" alt="Second Image">
		      <div class="carousel-caption">
		        <h3></h3>
		      </div>
		    </div>
		    <div class="item">
		      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/wayang.jpg" data-color="firebrick" alt="Second Image">
		      <div class="carousel-caption">
		        <h3></h3>
		      </div>
		    </div> -->
		    <!-- more slides here -->
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
			<div class="intro-text" id="utama">
                <div class="row">
                    <div class="col-lg-8 col-centered">
                    	<div class="intro-heading wow animated slideInUp" data-wow-duration="2s">
	                    	<hr style="width:80%;height:2px;background-color:#f3f6db;color:#f3f6db;">
	                    	<hr style="width:75%;height:1px;background-color:#f3f6db;color:#f3f6db;">
	                        The Telkom Way
	                        <hr style="width:75%;height:1px;background-color:#f3f6db;color:#f3f6db;">
	                        <hr style="width:80%;height:2px;background-color:#f3f6db;color:#f3f6db;">
                        </div>
                        <!-- <a href="#kategori" id="explorer" class="page-scroll btn btn-xl wow animated zoomIn" data-wow-delay="1s">Explore</a> -->
                    </div>
                </div>
            </div>
            <div class="intro-text animated slideInDown" id="login-culture" style="display:none;">
                <div class="boxlog">
                    <div class="row"><div class="text-right"><img id="x-gambar" style="cursor:pointer" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/x-white.png" alt="X"></div><div class="col-lg-4"></div></div>
                    <div class="animated pulse bounceInRight bounceInLeft"><h1>Login</h1></div>
                    <div class="intro-lead-in"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/sharing.png" alt="Culture"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                'layout' => TbHtml::FORM_LAYOUT_VERTICAL,
                            )); ?>

                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 text-center">
                                        <?php echo $form->textFieldControlGroup($login, 'username', array('label' => false, 'placeholder' => 'Username', 'class'=>'text-center input-transparent input-lg', 'required'=>'required')); ?>
                                        <?php echo $form->passwordFieldControlGroup($login, 'password', array('label' => false, 'placeholder' => 'Password', 'class'=>'text-center input-transparent input-lg', 'required'=>'required')); ?>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-lg-10 text-center">
                                        <div id="success"></div>
                                        <?php echo TbHtml::formActions(array(
                                            TbHtml::submitButton(TbHtml::icon(TbHtml::ICON_LOG_IN).' Log in', array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'class'=>'btn-lg btn-block btn-x1 button-transparent'))
                                        )); ?>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
            </div>
    </header>

<?php
	$this->renderPartial("_ttway",array("isittway"=>$isittway));
	$this->renderPartial("_journey", array("journey"=>$journey, "isijourney"=>$isijourney));
	$this->renderPartial("_activation", array("activation"=>$activation, "isiactiv"=>$isiactiv));
	//$this->renderPartial("_leadertalk", array("leadertalk"=>$leadertalk,"judultalk"=>$judultalk));
	$this->renderPartial("_expert", array("expertknow"=>$expertknow, "isiexpertknow"=>$isiexpertknow));
	//$this->renderPartial("_testimoni2", array("testimoni"=>$testimoni));
	$this->renderPartial("_gallery4", array("galleri"=>$galleri, "isigalleri"=>$isigalleri));
	//if(!Yii::app()->user->isGuest){ 
	if(isset(Yii::app()->user->id)){ 
    $this->renderPartial("_dashboard", array("dashboard"=>$dashboard, "isidashboard"=>$isidashboard, 
						 "direktorat"=>$direktorat, "divisi"=>$divisi, "witel"=>$witel));
	}
	$this->renderPartial("_contact", array("kontak"=>$kontak));
?>
