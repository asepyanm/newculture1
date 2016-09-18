<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<script type="text/javascript">
    /*$.backstretch([
        "<?php echo Yii::app()->baseUrl.'/images/wall/glare_of_autumn.jpg'; ?>",
        "<?php echo Yii::app()->baseUrl.'/images/wall/far_mountains.jpg'; ?>",
        "<?php echo Yii::app()->baseUrl.'/images/wall/colorful_seascape.jpg'; ?>",
        "<?php echo Yii::app()->baseUrl.'/images/wall/htc_one_m9.jpg'; ?>"
    ], {duration: 9000, fade: 1200});*/
    $('html').vide({
        // mp4: "<?php echo Yii::app()->baseUrl.'/video/ocean.mp4'; ?>",
        // webm: "<?php echo Yii::app()->baseUrl.'/video/ocean.webm'; ?>",
        // ogv: "<?php echo Yii::app()->baseUrl.'/video/ocean.ogv'; ?>",
        poster: "<?php echo Yii::app()->baseUrl.'/video/ocean.jpg'; ?>"
    },{
        resizing: true
    });
</script>

<style>
    .help-block{
        text-shadow: 1px 1px white;
    }
    h1{
        font-size: 50px;
        color: white;
        text-shadow: 1px 1px gray;
    }
</style>

<div id="boxlogin" class="row-fluid">
    <!-- <div class="col-sm-12 text-center"><img class="responsive-image" src="<?php echo Yii::app()->request->baseUrl; ?>/images/culture.png"></div> -->
    <div class="col-sm-12 text-center"><p><img class="responsive-image" src="<?php echo Yii::app()->request->baseUrl; ?>/images/sharing.png"></p></div>
    <div class="col-sm-4"></div>
    <div class="col-sm-4 text-center">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'layout' => TbHtml::FORM_LAYOUT_VERTICAL,
        )); ?>
        <?php echo $form->textFieldControlGroup($model, 'username', array('label' => false, 'placeholder' => 'Username', 'class'=>'text-center input-transparent input-lg')); ?>
        <?php echo $form->passwordFieldControlGroup($model, 'password', array('label' => false, 'placeholder' => 'Password', 'class'=>'text-center input-transparent input-lg')); ?>
        <?php echo TbHtml::formActions(array(
            TbHtml::submitButton(TbHtml::icon(TbHtml::ICON_LOG_IN).' Log in', array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'class'=>'btn-lg col-xs-12 button-transparent'))
        )); ?>
        <?php $this->endWidget(); ?>
    </div>
    <div class="col-sm-4"></div>
</div>

<div class="clear"></div>

<div class="row-fluid">
    <div class="col-sm-4">
        <div id="footerLogin">
            Copyright © 2015 - PT. Telekomunikasi Indonesia, Tbk.<br>
            Designed & Developed by : <strong class="orange">Orange Corner</strong> - ISC & HCC
        </div>
    </div>
</div>