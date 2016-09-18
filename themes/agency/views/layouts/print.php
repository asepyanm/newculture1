<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo Yii::app()->name; ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/favicon.ico">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/agency.css" rel="stylesheet">

    <!-- animate -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <!-- Salvattore -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/salvattore.css" rel="stylesheet">

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body onload="window.print()">

	<?php echo $content; ?>	
	
    <!-- jQuery -->
    <?php
        // $cs = Yii::app()->clientScript;
        // $cs->registerCoreScript('jquery');
    ?>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/classie.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/cbpAnimatedHeader.js"></script>
    <!-- Contact Form JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/contact_me.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/agency.js"></script>
    <!-- Wow -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/wow.min.js"></script>
    <!-- Salvattore Mansory -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/salvattore.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/salvattore.min.js"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>


<script type="text/javascript">
$(document).ready(function(){
    $("#utama").show();
    $("#login-culture").hide();
});

$("#logBtn-culture").click(function(){
    e.preventDefault();
    $.ajax({
        method: 'POST',
        url: "<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>#login-culture" ,
    });
});

$("#x-gambar").click(function(){
    $("#utama").addClass("animated slideInUp");
    $("#utama").show();
    $("#login-culture").hide();
});

// $(document).on("click", "#nama-journey", function (){
//     $("#isi1").show();
//     $("#1").hide();
//     var id = $(this).attr('data-id');
//     $.ajax({
//         type: "POST",
//         url : "<?php echo Yii::app()->createAbsoluteUrl('Site/konjour'); ?>",
//         data: "id="+id,
//         success: function(data) {
//          $('#isi1').html(data);
//         }
//     })
// });

$('.carousel').carousel({
  interval: 6000,
  pause: "false"
});

var $item = $('.carousel .item');
var $wHeight = $(window).height();

$item.height($wHeight); 
$item.addClass('full-screen');

$('.carousel img').each(function() {
  var $src = $(this).attr('src');
  var $color = $(this).attr('data-color');
  $(this).parent().css({
    'background-image' : 'url(' + $src + ')',
    'background-color' : $color
  });
  $(this).remove();
});

$(window).on('resize', function (){
  $wHeight = $(window).height();
  $item.height($wHeight);
});
document.onmousedown=disableclick;
status="Right Click Disabled";
function disableclick(event)
{
  if(event.button==2)
   {
     alert(status);
     return false;    
   }
}
document.onselectstart = new Function('return false');

function dMDown(e) { return false; }

function dOClick() { return true; }

document.onmousedown = dMDown;

document.onclick = dOClick;

$("#document").attr("unselectable", "on"); 

//disable mouse drag select end

//disable right click - context menu

document.oncontextmenu = new Function("return false");


//disable CTRL+A/CTRL+C through key board start

//use this function


function disableSelectCopy(e) {

// current pressed key

    var pressedKey = String.fromCharCode(e.keyCode).toLowerCase();

    if (e.ctrlKey && (pressedKey == "c" || pressedKey == "x" || pressedKey == "v" || pressedKey == "a")) {

        return false;

    }

}

document.onkeydown = disableSelectCopy;


//or use this function

$(function () {

    $(document).keydown(function (objEvent) {

        if (objEvent.ctrlKey || objEvent.metaKey) {

            if (objEvent.keyCode == 65 || objEvent.keyCode == 97) {

                return false;

            }

        //}

        }

    });

});
</script>