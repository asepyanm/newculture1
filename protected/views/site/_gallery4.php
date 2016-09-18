<link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/css/settings.css" rel="stylesheet" type="text/css">
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/css/layers.css" rel="stylesheet" type="text/css">
<style type="text/css">
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
.tp-video-play-button{
    display: none;
}

</style>

<?php
    /* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
?>

<section id="gallery" class="bg-custom">
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-heading">Expression Corner</h2>
            <hr style="width:30%;height:2px;background-color:#000;color:#000;">
            <h4 class="section-subheading text-muted">&nbsp;</h4>
        </div>
    </div>
    
	

    <div id="rev_slider_108_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="food-carousel80" style="margin:0px auto;background-color:#eef0f1;padding:0px;margin-top:0px;margin-bottom:0px;background:#1F1F1F url(<?php echo Yii::app()->theme->baseUrl; ?>/img/pattern.png) repeat top left;color:#fff;">
        <!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
        <div id="rev_slider_108_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
            <ul>
                <!-- SLIDE  -->
                <?php
                    if(isset($galleri)){
                        foreach ($galleri as $value) {
                        $idslide = 'rs-'.$value['idcontent'];
                    ?>
                <!-- <div class="hover-cek"></div> -->
                <li data-index="<?php echo $idslide;?>" data-transition="fade" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="300"  <?php if($value['video']==null){?> data-thumb="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" <?php } ?> <?php if($value['video']!=null){?> data-thumb="<?php echo Yii::app()->createUrl('/Content/DisplayVideo', array('id'=>$value['idcontent'])); ?>" <?php } ?> data-rotate="0"  data-saveperformance="off"  data-description="">
                    <!-- MAIN IMAGE -->
                    <div class="tp-caption Photography-ImageHover   tp-resizeme" 
                        id="<?php echo $idslide;?>-layer-12" 
                        data-x="['left','left','center','center']" data-hoffset="['770','620','160','80']" 
                        data-y="['top','top','top','top']" data-voffset="['473','390','460','420']" 
                        data-width="none"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-transform_idle="o:1;"
                        data-transform_hover="o:0.5;sX:0.8;sY:0.8;rX:0;rY:0;rZ:0;z:0;s:1000;e:Power3.easeInOut;"
                        data-style_hover="c:rgba(255, 255, 255, 1.00);cursor:pointer;"
                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;" 
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                        data-mask_in="x:0px;y:0px;" 
                        data-mask_out="x:inherit;y:inherit;" 
                        data-start="1250" 
                        data-actions='[{"event":"click","action":"jumptoslide","slide":"rs-190","delay":""}]'
                        data-responsive_offset="on" 
                        style="z-index: 11; line-height: 22px;font-family:Arial;"><img src="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" alt="" width="300" height="200" data-ww="['200px','150px','150px','150px']" data-hh="['133px','100px','100px','100px']" data-no-retina> 
                    </div>
                <?php if($value['video']==null){?><img src="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>"  alt=""  data-bgposition="center center" data-bgfit="contain" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina><?php } ?>
                    <!-- LAYERS -->
                <?php if($value['video']!=null){?>
                    <div class="tp-caption tp-resizeme tp-videolayer" 
                        id="<?php echo $idslide;?>-layer-7" 
                        data-x="center" data-hoffset="" 
                        data-y="center" data-voffset="" 
                        data-width="['420']"
                        data-height="['420']"
                        data-transform_idle="o:1;"
                        data-transform_in="s:1000;e:Power1.easeInOut;" 
                        data-transform_out="s:1000;s:1000;" 
                        data-start="1000" 
                        data-responsive_offset="on" 
                        data-videocontrols="none" data-videowidth="620" data-videoheight="620" data-videomp4="<?php echo Yii::app()->createUrl('/Content/DisplayVideo', array('id'=>$value['idcontent'])); ?>" data-posterOnMObile="off" data-videopreload="auto" data-videoloop="none" data-forceCover="1" data-aspectratio="4:3" data-autoplay="off" 
                        data-nextslideatend="true" 
                        data-forcerewind="off"
                        style="z-index: -99999999; min-width: 420px; max-width: 420px; max-width: 420px; max-width: 420px; white-space: normal;"> 
                    </div>
                <?php } ?>
                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption FoodCarousel-Content   tp-resizeme" 
                        id="<?php echo $idslide;?>-layer-3" 
                        data-x="center" data-hoffset="" 
                        data-y="center" data-voffset="" 
                        data-width="['420']"
                        data-height="['420']"
                        data-transform_idle="o:1;"
                        data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:800;e:Power3.easeInOut;" 
                        data-transform_out="auto:auto;s:500;" 
                        data-start="bytrigger" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-responsive_offset="on" 
                        data-end="bytrigger"
                        data-lasttriggerstate="reset"
                        style="z-index: 5; min-width: 420px; max-width: 420px; max-width: 420px; max-width: 420px; white-space: normal;">
                        <span class="foodcarousel-headline"><?php echo $value['judul']; ?></span><br/>
                        
                        <hr  style="border-top: 1px solid #292e31;">
                        <?php echo '<p>'.$value['sinopsis'].'</p>'; ?>
                    </div>
                    <!-- LAYER NR. 2 -->
                    <!-- <div class="tp-caption FoodCarousel-Button rev-btn " 
                        id="<?php echo $idslide;?>-layer-1" 
                        data-x="center" data-hoffset="" 
                        data-y="bottom" data-voffset="50" 
                        data-width="['auto']"
                        data-height="['auto']"
                        data-transform_idle="o:1;"
                        data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;"
                        data-style_hover="c:rgba(255, 255, 255, 1.00);bg:rgba(41, 46, 49, 1.00);cursor:pointer;"
                        data-transform_in="opacity:0;s:300;e:Power3.easeInOut;" 
                        data-transform_out="opacity:0;s:300;s:300;" 
                        data-start="0" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-actions='[{"event":"click","action":"startlayer","layer":"<?php echo $idslide;?>-layer-3","delay":""},{"event":"click","action":"startlayer","layer":"<?php echo $idslide;?>-layer-5","delay":"200"},{"event":"click","action":"stoplayer","layer":"<?php echo $idslide;?>-layer-1","delay":""}]'
                        data-responsive_offset="on" 
                        data-responsive="off"
                        data-lasttriggerstate="reset"
                        style="z-index: 6;"> View 
                    </div> -->
                    <div class="tp-caption" 
                        id="<?php echo $idslide;?>-layer-1" 
                        data-x="center" data-hoffset="" 
                        data-y="center" data-voffset="" 
                        data-width="['auto']"
                        data-height="['auto']"
                        data-transform_idle="o:1;"
                        data-transform_in="opacity:0;s:300;e:Power3.easeInOut;" 
                        data-transform_out="opacity:0;s:300;s:300;" 
                        data-start="0" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-responsive_offset="on" 
                        data-responsive="off"
                        data-lasttriggerstate="reset"> <div><?php if($value['video']!=null) echo '<a id="playvideoleader" style="text-decoration: underline; cursor:pointer;" onclick="javascript:vid(this);" data-toggle="modal" data-target="#MyModalvid" data-id="'.$value["idcontent"].'"><img style="width:70px;" src="'.Yii::app()->theme->baseUrl.'/img/play.png"></a>'; else echo ''; ?></div> 
                    </div>
                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption FoodCarousel-CloseButton rev-btn  tp-resizeme" 
                        id="<?php echo $idslide;?>-layer-5" 
                        data-x="441" 
                        data-y="110" 
                        data-width="['auto']"
                        data-height="['auto']"
                        data-transform_idle="o:1;"
                        data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;"
                        data-style_hover="c:rgba(255, 255, 255, 1.00);bg:rgba(41, 46, 49, 1.00);cursor:pointer;"
                        data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:800;e:Power3.easeInOut;" 
                        data-transform_out="auto:auto;s:500;" 
                        data-start="bytrigger" 
                        data-splitin="none" 
                        data-splitout="none" 
                        data-actions='[{"event":"click","action":"stoplayer","layer":"<?php echo $idslide;?>-layer-3","delay":""},{"event":"click","action":"stoplayer","layer":"<?php echo $idslide;?>-layer-5","delay":""},{"event":"click","action":"startlayer","layer":"<?php echo $idslide;?>-layer-1","delay":""}]'
                        data-responsive_offset="on" 
                        data-end="bytrigger"
                        data-lasttriggerstate="reset"
                        style="z-index: 7; white-space: nowrap;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><i style="color:rgb(255, 0, 0);" class="fa fa-remove"></i>
                    </div>
                </li>
                <!-- SLIDE  -->
                <?php
                        }
                    }
                    ?>
                
            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
        </div>
    </div>
    <!--========== END REVOLUTION SLIDER ==========-->
			
	<!--========== REVOLUTION SLIDER ==========-->
    <center><a href="<?php echo Yii::app()->createUrl("sub/expression"); ?>" class="btn btn-lg btn-primary">Show All</a></center>
</div>
</section>
<?php 
$this->renderPartial("/site/_modal");
?>
<!-- REVOLUTION SCRIPT CODE -->
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
<script type="text/javascript">
    // var tpj=jQuery;
    
    // var revapi285;
    // tpj(document).ready(function() {
    //     if(tpj("#rev_slider_285_1").revolution == undefined){
    //         revslider_showDoubleJqueryError("#rev_slider_285_1");
    //     }else{
    //         revapi285 = tpj("#rev_slider_285_1").show().revolution({
    //             sliderType:"standard",
    //             jsFileLocation: "<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/",
    //             sliderLayout:"auto",
    //             dottedOverlay:"none",
    //             delay:7000,
    //             navigation: {
    //                 // keyboardNavigation:"off",
    //                 // keyboard_direction: "horizontal",
    //                 // mouseScrollNavigation:"off",
    //                 // mouseScrollReverse:"default",
    //                 // onHoverStop:"off",
    //                 arrows: {
    //                     style:"uranus",
    //                     enable:true,
    //                     hide_onmobile:false,
    //                     hide_onleave:false,
    //                     hide_delay:200,
    //                     hide_delay_mobile:1200,
    //                     tmp:'',
    //                     left: {
    //                         h_align:"left",
    //                         v_align:"center",
    //                         h_offset:17,
    //                         v_offset:0
    //                     },
    //                     right: {
    //                         h_align:"right",
    //                         v_align:"center",
    //                         h_offset:17,
    //                         v_offset:0
    //                     }
    //                 },
    //                 tabs: {
    //                     style:"zeus",
    //                     // enable:true,
    //                     width:240,
    //                     height:80,
    //                     min_width:240,
    //                     wrapper_padding:20,
    //                     wrapper_color:"#000000",
    //                     wrapper_opacity:"0.5",
    //                     tmp:'<div class="tp-tab-content">  <span class="tp-tab-date">{{param1}}</span>  <span class="tp-tab-title">{{title}}</span></div><div class="tp-tab-image"></div>',
    //                     visibleAmount: 10,
    //                     hide_onmobile: true,
    //                     hide_under:768,
    //                     hide_onleave:true,
    //                     hide_delay:200,
    //                     hide_delay_mobile:1200,
    //                     hide_delay:200,
    //                     direction:"horizontal",
    //                     span:true,
    //                     position:"inner",
    //                     space:0,
    //                     h_align:"left",
    //                     v_align:"top",
    //                     h_offset:0,
    //                     v_offset:0
    //                 }
    //             },
    //             responsiveLevels:[1240,1024,778,480],
    //             visibilityLevels:[1240,1024,778,480],
    //             parallax: {
    //                 type:"scroll",
    //                 origo:"enterpoint",
    //                 speed:400,
    //                 levels:[5,10,15,20,25,30,35,40,45,50],
    //             },
    //             gridwidth:[1400,1024,778,480],
    //             gridheight:[600,500,400,300],
    //             lazyType:"single",
    //             shadow:0,
    //             spinner:"off",
    //             stopLoop:"off",
    //             stopAfterLoops:-1,
    //             stopAtSlide:2,
    //             shuffle:"off",
    //             autoHeight:"off",
    //             hideThumbsOnMobile:"off",
    //             hideSliderAtLimit:0,
    //             hideCaptionAtLimit:0,
    //             hideAllCaptionAtLilmit:0,
    //             debugMode:false,
    //             fallbacks: {
    //                 simplifyAll:"off",
    //                 nextSlideOnWindowFocus:"off",
    //                 disableFocusListener:false,
    //             }
    //         });
    //     }
    // }); /*ready*/

    var tpj=jQuery;                     
    var revapi108;
    tpj(document).ready(function() {
        if(tpj("#rev_slider_108_1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider_108_1");
        }else{
            revapi108 = tpj("#rev_slider_108_1").show().revolution({
                sliderType:"carousel",
                jsFileLocation: "<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/rev-slider/js/",
                sliderLayout:"fullwidth",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                    defaults : "123",
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"off",
                    arrows: {
                        style:"metis",
                        enable:true,
                        hide_onmobile:true,
                        hide_under:768,
                        hide_onleave:false,
                        tmp:'',
                        left: {
                            h_align:"left",
                            v_align:"center",
                            h_offset:0,
                            v_offset:0
                        },
                        right: {
                            h_align:"right",
                            v_align:"center",
                            h_offset:0,
                            v_offset:0
                        }
                    }
                    ,
                    thumbnails: {
                        style:"erinyen",
                        enable:false,
                        width:100,
                        height:50,
                        min_width:150,
                        wrapper_padding:20,
                        wrapper_color:"#000000",
                        wrapper_opacity:"0.05",
                        tmp:'<span class="tp-thumb-over"></span><span class="tp-thumb-image"></span><span class="tp-thumb-title">{{title}}</span><span class="tp-thumb-more"></span>',
                        visibleAmount:10,
                        hide_onmobile:false,
                        hide_onleave:false,
                        direction:"horizontal",
                        span:true,
                        position:"outer-bottom",
                        space:10,
                        h_align:"center",
                        v_align:"bottom",
                        h_offset:0,
                        v_offset:0
                    }
                },
                carousel: {
                    maxRotation: 65,
                    vary_rotation: "on",
                    minScale: 55,
                    vary_scale: "off",
                    horizontal_align: "center",
                    vertical_align: "center",
                    fadeout: "on",
                    vary_fade: "on",
                    maxVisibleItems: 5,
                    infinity: "on",
                    space: -150,
                    stretch: "off"
                },
                gridwidth:600,
                gridheight:375,
                lazyType:"none",
                shadow:0,
                spinner:"off",
                stopLoop:"on",
                stopAfterLoops:0,
                stopAtSlide:1,
                shuffle:"off",
                autoHeight:"off",
                disableProgressBar:"on",
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

    document.getElementById("vidEle").style.display="none";

           function vid(e){
                $.post('<?php echo CHtml::normalizeUrl(array("site/playVideoLeader")); ?>',
                    {id:$(e).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                ); 
            }
        
</script>