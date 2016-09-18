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

<body id="page-top" class="index">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-shrink navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-delay: 300ms; animation-iteration-count: infinite; animation-name: pulse;" href="<?php echo Yii::app()->createUrl("site/index"); ?>#page-top"><img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt="Culture"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo Yii::app()->createUrl("site/index"); ?>#ttway">The Telkom Way</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo Yii::app()->createUrl("site/index"); ?>#portfolio">Journey</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo Yii::app()->createUrl("site/index"); ?>#team">Activation</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo Yii::app()->createUrl("site/index"); ?>#expert">Expert & Knowledges</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo Yii::app()->createUrl("site/index"); ?>#gallery">Expression Corner</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo Yii::app()->createUrl("site/index"); ?>#contact">Contact</a>
                    </li>
                    <?php if(Yii::app()->user->isGuest){ ?>
                    <li>
                        <a class="page-scroll" style="cursor:pointer" href="<?php echo Yii::app()->createUrl("site/index"); ?>#login-culture">Login</a>
                    </li>
                    <?php }else{
                        $itemname = isset(Yii::app()->user->itemname) ? Yii::app()->user->itemname : null;
                        if($itemname == 'ldap'){
                    ?>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl("site/logout"); ?>" class="page-scroll" style="cursor:pointer">Logout</a>
                    </li>
                    <?php        
                        }else{
                    ?>
                    <li>
                        <a class="page-scroll" href="<?php echo Yii::app()->createUrl("content/index"); ?>">My Admin</a>
                    </li>
                    <?php
                        }
                    } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

	<?php echo $content; ?>	
	
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; PT. Telekomunikasi Indonesia, Tbk. 2014</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <?php if(Yii::app()->user->isGuest){ ?>
    <!-- Pencarian -->
    <div class="pencarian wow fadeInUpBig">
        <ul>
            <li class="cari-btn">
                <i class="fa fa-search fa-2x"></i>
                <ul style="width:370px">
                    <li>
                        <div class="boxcari">
                        <?php echo CHtml::beginForm(array('/site/view')); ?>
                            <?php echo CHtml::textField('cari','',array('style'=>'width:38%;display: unset;','placeholder'=>'Cari ...')); ?>
                            <?php echo CHtml::dropDownList('subkategori','',CHtml::listData(Subkategori::model()->findAll(), 'idsubkategori', 'nama'),array('empty'=>'All Sub Kategori','style'=>'width:50%;border: 1px solid #9d9c9c;border-radius: 3px;height: 36px;')); ?>
                            <?php echo TbHtml::submitButton("<i class='fa fa-arrow-circle-o-right'></i>",array("class"=>"btn-cari",'style'=>'margin-top: -3px;height: 36px;')); ?>
                        <?php echo CHtml::endForm(); ?>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Akhir dari sebuah Pencarian -->
    <?php }else{ ?>
       <!-- Pencarian -->
    <div class="pencarian wow fadeInUpBig">
        <ul>
            <li class="cari-btn">
                <i class="fa fa-search fa-2x"></i>
                <ul style="width:420px">
                    <li>
                        <div class="boxcari">
                        <?php echo CHtml::beginForm(array('/site/view')); ?>
                            <?php echo CHtml::textField('cari','',array('style'=>'width:38%;display: unset;','placeholder'=>'Cari ...')); ?>
                            <?php echo CHtml::dropDownList('subkategori','',CHtml::listData(Subkategori::model()->findAll(), 'idsubkategori', 'nama'),array('empty'=>'All Sub Kategori','style'=>'width:25%;border: 1px solid #9d9c9c;border-radius: 3px;height: 36px;')); ?>
                            <?php echo CHtml::dropDownList('unit','',CHtml::listData(Unit::model()->findAll(), 'id_unit', 'nama_unit'),array('empty'=>'All Unit','style'=>'width:25%;border: 1px solid #9d9c9c;border-radius: 3px;height: 36px;')); ?>
                            <?php echo TbHtml::submitButton("<i class='fa fa-arrow-circle-o-right'></i>",array("class"=>"btn-cari",'style'=>'margin-top: -3px;height: 36px;')); ?>
                        <?php echo CHtml::endForm(); ?>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <?php } ?>
    <!-- Akhir dari sebuah Pencarian -->
	
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

function logBtn() {
    window.location.hash = '#login-culture';
    window.open("<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>");
};

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
// document.onmousedown=disableclick;
// status="Right Click Disabled";
// function disableclick(event)
// {
//   if(event.button==2)
//    {
//      alert(status);
//      return false;    
//    }
// }
//document.onselectstart = new Function('return false');

// function dMDown(e) { return false; }

// function dOClick() { return true; }

// document.onmousedown = dMDown;

// document.onclick = dOClick;

$("#document").attr("unselectable", "on"); 

//disable mouse drag select end

//disable right click - context menu

// document.oncontextmenu = new Function("return false");


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
$(".cari-btn i").click(function(){
    $(".cari-btn i").toggleClass("clicked");
});
</script>