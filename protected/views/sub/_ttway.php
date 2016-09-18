<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
<?php
//var_dump($ourculture[0]['idcontent']);exit;
    /* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
?>

    <section id="ttway" class="wow animated fadeIn bg-custom" data-wow-duration="2s">
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
		            <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>#ttway">The Telkom Way</a></li>
		            <li class="active">The Telkom Way</li>
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
	        <!-- <div class="col-lg-12 text-center">
	            <h2 class="section-heading"><?php echo $sub->nama; ?></h2>
	            <hr style="width:40%;height:2px;background-color:#000;color:#000;">
	            <h4 class="section-subheading text-muted"><?php echo $sub->deskripsi; ?></h4>
	        </div> -->
            <div class="col-lg-2" style="margin-bottom:10px;">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $ind = 1;
                        foreach ($ourculture as $value) {
                        ?>
                        <button type="button" class="btn btn-primarys btn-arrow-right" id="list<?php echo $value['idcontent'];?>" onClick="pilihcontent('<?php echo $value['idcontent'];?>')"><?php if ($ind < 10) echo '0'.$ind.' '.ucfirst($value['judul']); else echo $ind;?> </button>
                        <?php $ind++; } ?>
                    </div>
                </div>
            </div>
            <?php 
            $color = array(
              0=>'#c0504d',
              1=>'#1f497d',
              2=>'#77933c',
              );
            $a = 0;
            $b = 1;
            foreach ($ourculture as $value) {
              if($a>2) $a=0;
              $effect = $a%2==0 ? 'effect7' : 'effect8';   
            ?>
            <div class="col-lg-10">
                <div class="box effect7" id="<?php echo $value['idcontent'];?>" style="background-color:<?php echo $color[$a];?>; color: #eaffff;">
                    <div class="row">
                        <div class="col-md-12">
                            <img style="margin-top: 5%; float: right; max-width: 50%" src="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" />
                            <hr style="float:left;width:40%;height:10px;background-color:#f7980f;border-top: 1px solid #f7980f;">
                            <div style="padding-top:12%"><p style="font-size: 20px"><i><?php echo $value['sinopsis'];?></i></p>
                                <p style="font-size: 25px"><?php echo $value['judul'];?></p>
                                <p>
                                    <?php echo $value['isi']?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $b++; $a++;} ?>
	    </div>
	    <?php
	       }
	    ?>
    <br>
    <hr>        
	</div>
</section>
<?php echo $this->renderPartial("_modal_ttw") ?>

<script type="text/javascript">
$(function(){
            $(document).on('click','#playvideo',function(e){
                e.preventDefault();
                
                $.post('<?php echo CHtml::normalizeUrl(array("sub/playVideoTestimoni")); ?>',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                ); $("#MyModalttw").modal('show');
            });
        });
$(document).ready(function() {
    <?php
    if(isset($_GET['list'])){
    	$e = '"'.$_GET['list'].'"';
    	foreach ($ourculture as $value) {
	    	if('"'.$value['idcontent'].'"' == $e){
	    		echo '$("#'.$value['idcontent'].'").show();';
	    	}else{
	    		echo '$("#'.$value['idcontent'].'").hide();';
	    	}
	    }
    }else{
    	$e = '"'.$ourculture[0]['idcontent'].'"';
    	foreach ($ourculture as $value) {
	    	if('"'.$value['idcontent'].'"' == $e){
	    		echo '$("#'.$value['idcontent'].'").show();';
	    	}else{
	    		echo '$("#'.$value['idcontent'].'").hide();';
	    	}
	    }
    }	
    ?>   
});


function pilihcontent(e){
    <?php
    $e = "<script>document.write(e)</script>";
    foreach ($ourculture as $value) {
    	if('"'.$value['idcontent'].'"' == $e){
    		echo '$("#'.$value['idcontent'].'").show();';
    	}else{
    		echo '$("#'.$value['idcontent'].'").hide();';
    	}
    }
    ?>
    $("#"+e).show();
}
var _validVideoExtensions = [".mp4", ".swf", ".3gp", ".avi", ".flv", ".mpg"];    
function videoValid(oInput) {
  //alert(oInput.files[0].size);
    if (oInput.files[0].size > 20000000) {
        alert('Maaf maksimal size lampiran adalah 20 mb');
        oInput.value = "";
        return false;
    }
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validVideoExtensions.length; j++) {
                var sCurExtension = _validVideoExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Maaf, " + sFileName + " tidak valid, ekstensi file yang diperbolehkan adalah: " + _validVideoExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
function formValidator(){
   // Make quick references to our fields
   var isi_testimoni = document.getElementById('isi_testimoni');
   // Check each input in the order that it appears in the form!
   
     if(notEmpty(isi_testimoni, "Please fill out testimonials field ")){
        return true;
     }
   
   return false;
}
// $("#content-form").on("submit", function(){
//   formValidator();
// })
function notEmpty(elem, helperMsg){
   if(elem.value.length == 0){
      alert(helperMsg);
      elem.focus(); // set the focus to this input
      return false;
   }
   return true;
}
$("#simpan").click(function(){
	var val = formValidator();
	if(val){
	    var r = confirm("Are you sure to submit the testimonials ? ");
	    if (r == true) {
	        $('#testimoni-form').submit();
	    } else {
	        return false;
	    }
	 }else{
	 	return false;
	 } 
});
</script>