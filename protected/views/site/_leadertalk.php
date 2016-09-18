<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/extensions/revolution.extension.video.min.js"></script>

<link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/css/settings.css" rel="stylesheet" type="text/css">
<style type="text/css">
.nama {
        font-size: 50px;
        font-weight: 400;
        text-shadow: 1px 1px 0 #eee, -1px -1px 0 #eee, 1px -1px 0 #eee, -1px 1px 0 #eee, 3px 3px 5px rgba(0,0,0,0.8);
    }
.pos{
    color:#000000;
    text-shadow: 1px 1px 0 #eee, -1px -1px 0 #eee, 1px -1px 0 #eee, -1px 1px 0 #eee, 3px 3px 5px rgba(0,0,0,0.8);
}
.pos p{
    font-weight: bold;
    color: white;
    text-shadow:
    -1px -1px 0 #000,
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000;
}
.tp-bgimg {
  position: fixed;
  left: 0;
  right: 0;
  z-index: 1;

  display: block;
  background-image: url('http://666a658c624a3c03a6b2-25cda059d975d2f318c03e90bcf17c40.r92.cf1.rackcdn.com/unsplash_527bf56961712_1.JPG');
  width: 1200px;
  height: 800px;

  /*-webkit-filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  filter: blur(5px);*/
}
#playvideoleader:hover { 
  -webkit-filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  filter: blur(5px);
}
</style>

<?php
    /* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
?>

<section id="leadertalk" class="bg-custom">
<div class="container">
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
            if(isset($judultalk)){
            ?>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo $judultalk->nama; ?></h2>
                <hr style="width:60%;height:2px;background-color:#000;color:#000;">
                <h4 class="section-subheading text-muted"></h4>
            </div>
        </div>
        <?php
           }
        ?>

    </div>
    
	<div id="rev_slider_285_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.1.4">
        <ul>
            <!-- SLIDE  -->
            <?php foreach ($leadertalk as $value) {
            	$idslide = 'rs-'.$value['idcontent'];
            	?>

            <li data-index="<?php echo $idslide;?>" data-transition="fade" data-slotamount="default"  data-easein="Power1.easeInOut" data-easeout="Power1.easeInOut" data-masterspeed="500"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="500" data-fsslotamount="7" data-saveperformance="off"  data-title="First" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                <!-- MAIN IMAGE -->
                <?php if($value['video']==null){?><img style="filter:blur(5px);" src="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina><?php } 
                ?>
               
                <!-- LAYERS -->
                <!-- LAYER NR. 1 -->
                <?php if($value['video']!=null){?>
                <div class="tp-caption   tp-resizeme fullscreenvideo tp-videolayer" 
                    id="slide-<?php echo $value['idcontent'];?>-layer-7" 
                    data-x="0" 
                    data-y="0" 
                    data-width="['auto']"
                    data-height="['auto']"
                    data-transform_idle="o:1;"
                    data-style_hover="cursor:pointer;"
                    data-transform_in="s:1000;e:Power1.easeInOut;" 
                    data-transform_out="s:1000;s:1000;" 
                    data-start="1000" 
                    data-responsive_offset="on" 
                    data-videocontrols="none" data-videowidth="100%" data-videoheight="100%" data-videomp4="<?php echo Yii::app()->createUrl('/Content/DisplayVideo', array('id'=>$value['idcontent'])); ?>" data-posterOnMObile="off" data-videopreload="auto" data-videoloop="none" data-forceCover="1" data-aspectratio="16:9"            data-autoplay="off" 
                    data-nextslideatend="true" 
                    data-forcerewind="on"> 
                </div>
                <?php } ?>
                <div class="tp-caption tp-shape tp-shapewrapper " 
                    id="slide-<?php echo $value['idcontent'];?>-layer-4" 
                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                    data-width="full"
                    data-height="full"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="opacity:0;s:500;e:Power1.easeInOut;" 
                    data-transform_out="opacity:0;s:1000;s:1000;" 
                    data-start="500" 
                    data-basealign="slide" 
                    data-responsive_offset="off" 
                    data-responsive="off"
                    style="z-index: 5;background-color:rgba(0, 0, 0, 0.25);border-color:rgba(0, 0, 0, 0.50);">
                </div>
                <!-- LAYER NR. 2 -->
                <div class="tp-caption Team-Name   tp-resizeme" 
                    id="slide-<?php echo $value['idcontent'];?>-layer-1" 
                    data-x="['left','left','left','left']" data-hoffset="['150','100','50','30']" 
                    data-y="['top','top','top','top']" data-voffset="['210','170','140','70']" 
                    data-fontsize="['70','70','50','50']"
                    data-lineheight="['70','70','50','50']"
                    data-width="none"
                    data-height="none"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="x:-50px;opacity:0;s:500;e:Power1.easeInOut;" 
                    data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;s:500;e:Power1.easeInOut;" 
                    data-start="0" 
                    data-splitin="none" 
                    data-splitout="none" 
                    data-responsive_offset="on" 
                    style="z-index: 6; white-space: nowrap;"><div class="nama"><?php echo User::model()->findByAttributes(array('N_NIK'=>$value['judul']))->V_NAMA_KARYAWAN; ?></div>
                </div>
                <!-- LAYER NR. 3 -->
                <div class="tp-caption Team-Position   tp-resizeme" 
                    id="slide-<?php echo $value['idcontent'];?>-layer-2" 
                    data-x="['left','left','left','left']" data-hoffset="['150','100','50','30']" 
                    data-y="['top','top','top','top']" data-voffset="['290','240','190','120']" 
                    data-fontsize="['30','30','20','20']"
                    data-lineheight="['30','30','20','20']"
                    data-width="none"
                    data-height="none"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="x:-50px;opacity:0;s:500;e:Power1.easeInOut;" 
                    data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;s:500;e:Power1.easeInOut;" 
                    data-start="250" 
                    data-splitin="none" 
                    data-splitout="none" 
                    data-responsive_offset="on" 
                    style="z-index: 7; white-space: nowrap;"><div class="pos"><?php echo User::model()->findByAttributes(array('N_NIK'=>$value['judul']))->V_SHORT_UNIT; ?> <br/> <p style="font-size:16px;"><?php echo User::model()->findByAttributes(array('N_NIK'=>$value['judul']))->V_SHORT_POSISI; ?></p></div>
                </div>
                <!-- LAYER NR. 4 -->
                <div class="tp-caption Team-Description   tp-resizeme" 
                    id="slide-<?php echo $value['idcontent'];?>-layer-3" 
                    data-x="['left','left','left','left']" data-hoffset="['150','100','50','30']" 
                    data-y="['top','top','top','top']" data-voffset="['370','320','240','170']" 
                    data-fontsize="['18','18','15','15']"
                    data-lineheight="['28','28','25','25']"
                    data-width="['640','640','640','360']"
                    data-height="none"
                    data-whitespace="normal"
                    data-transform_idle="o:1;rZ:360;"
                    data-transform_in="x:-50px;opacity:0;s:500;e:Power1.easeInOut;" 
                    data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;s:500;e:Power1.easeInOut;" 
                    data-start="500" 
                    data-splitin="none" 
                    data-splitout="none" 
                    data-responsive_offset="on" 
                    style="z-index: 8; min-width: 640px; max-width: 640px; white-space: normal;"><div style="font-size:20px;font-style:italic;color:#ffffff;font-weight:100px;text-shadow: 3px 3px 2px rgba(0, 0, 0, 1);"><?php echo $value['sinopsis'].'<br>';?></div>
                </div>         
                <div class="tp-caption Team-Description   tp-resizeme" 
                    id="slide-<?php echo $value['idcontent'];?>-layer-3" 
                    data-x="['left','left','left','left']" data-hoffset="['670','100','50','30']" 
                    data-y="['top','top','top','top']" data-voffset="['270','240','190','120']" 
                    data-fontsize="['18','18','15','15']"
                    data-lineheight="['28','28','25','25']"
                    data-width="['640','640','640','360']"
                    data-height="none"
                    data-whitespace="normal"
                    data-transform_idle="o:1;rZ:360;"
                    data-transform_in="x:-50px;opacity:0;s:500;" 
                    data-transform_out="x:50px;opacity:0;s:500;e:Power1.easeInOut;s:500;e:Power1.easeInOut;" 
                    data-start="500" 
                    data-splitin="none" 
                    data-splitout="none" 
                    data-responsive_offset="on" 
                    style="z-index: 9; min-width: 640px; max-width: 640px; white-space: normal;">
                    <div><?php if($value['video']!=null) echo '<a id="playvideoleader" style="text-decoration: underline; cursor:pointer;" data-toggle="modal" data-target="#MyModalvid" data-id="'.$value["idcontent"].'"><img style="width:70px;" src="'.Yii::app()->theme->baseUrl.'/img/play.png"></a>'; else echo ''; ?></div>
                    <!-- <div><?php if($value['video']!=null) echo '<a href="'.Yii::app()->createUrl('/Content/DisplayVideo', array('id'=>$value['idcontent'])).'" style="text-decoration: underline; cursor:pointer;" ><img style="width:70px;" src="'.Yii::app()->theme->baseUrl.'/img/play.png"></a>'; else echo ''; ?></div> -->
                </div>
            </li>
            <?php 
        		
            } ?>
        </ul>
        
        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
    </div>
    <!--========== END REVOLUTION SLIDER ==========-->
			
	<!--========== REVOLUTION SLIDER ==========-->
    

</section>
<?php 
$this->renderPartial("/site/_modal");
?>
<!-- REVOLUTION SCRIPT CODE -->
<script type="text/javascript">
    var tpj=jQuery;
    
    var revapi285;
    tpj(document).ready(function() {
        if(tpj("#rev_slider_285_1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider_285_1");
        }else{
            revapi285 = tpj("#rev_slider_285_1").show().revolution({
                sliderType:"standard",
                jsFileLocation: "<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/",
                sliderLayout:"auto",
                dottedOverlay:"none",
                delay:7000,
                navigation: {
                    // keyboardNavigation:"off",
                    // keyboard_direction: "horizontal",
                    // mouseScrollNavigation:"off",
                    // mouseScrollReverse:"default",
                    // onHoverStop:"off",
                    arrows: {
                        style:"uranus",
                        enable:true,
                        hide_onmobile:false,
                        hide_onleave:false,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        tmp:'',
                        left: {
                            h_align:"left",
                            v_align:"center",
                            h_offset:17,
                            v_offset:0
                        },
                        right: {
                            h_align:"right",
                            v_align:"center",
                            h_offset:17,
                            v_offset:0
                        }
                    },
                    tabs: {
                        style:"zeus",
                        // enable:true,
                        width:240,
                        height:80,
                        min_width:240,
                        wrapper_padding:20,
                        wrapper_color:"#000000",
                        wrapper_opacity:"0.5",
                        tmp:'<div class="tp-tab-content">  <span class="tp-tab-date">{{param1}}</span>  <span class="tp-tab-title">{{title}}</span></div><div class="tp-tab-image"></div>',
                        visibleAmount: 10,
                        hide_onmobile: true,
                        hide_under:768,
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        hide_delay:200,
                        direction:"horizontal",
                        span:true,
                        position:"inner",
                        space:0,
                        h_align:"left",
                        v_align:"top",
                        h_offset:0,
                        v_offset:0
                    }
                },
                responsiveLevels:[1240,1024,778,480],
                visibilityLevels:[1240,1024,778,480],
                parallax: {
                    type:"scroll",
                    origo:"enterpoint",
                    speed:400,
                    levels:[5,10,15,20,25,30,35,40,45,50],
                },
                gridwidth:[1400,1024,778,480],
                gridheight:[600,500,400,300],
                lazyType:"single",
                shadow:0,
                spinner:"off",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:2,
                shuffle:"off",
                autoHeight:"off",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    nextSlideOnWindowFocus:"off",
                    disableFocusListener:false,
                }
            });
        }
    }); /*ready*/
	$( document ).ready(function() {
		var current = "0";
		$(".tp-tab").find("[data-liindex='" + current +"']").addClass("selected");
	});
    $(function(){
            $(document).on('click','#playvideoleader',function(e){
                e.preventDefault();
                
                $.post('<?php echo CHtml::normalizeUrl(array("site/playVideoLeader")); ?>',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                ); 
            });
        });
</script>