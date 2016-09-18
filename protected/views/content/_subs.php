<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<!-- form start -->
<?php
//var_dump(empty($lampiran));exit;
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'enctype'=>'multipart/form-data'
    ),
  ));
?>    
<?php echo $form->errorSummary($subs); ?>

    
    <!-- /.row -->
    <div class="row" class="wow animated fadeIn" data-wow-duration="2s">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="box-body">
                        <div class="form-group">                    
                            <label for="idsubkategori" class="col-sm-2 control-label">SUB KATEGORI*</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="idsubkategori" id="idsubkategori" data-placeholder="Pilih No Transaksi Masuk">
                                    <option value="">Pilih</option>
                                    <?php
                                        foreach($subs as $db)
                                        {
                                        ?>
                                        <option value="<?php echo $db['idsubkategori']; ?>"><?php echo $db['nama']; ?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="detail_input" name="detail_input"></div>

                                

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <?php echo CHtml::htmlButton(Yii::t('mds','{icon} Submit',array('{icon}'=>'<i class="fa fa-save"></i>')), array('style'=>'float:right;margin-left:5px;','class'=>'btn btn-success btn-lg', 'id'=>'simpan')); ?>            
                        <?php echo CHtml::htmlButton(Yii::t('mds','{icon} Draft',array('{icon}'=>'<i class="fa fa-file"></i>')), array('style'=>'float:right','class'=>'btn btn-success btn-lg', 'id'=>'draft')); ?>
                    </div><!-- /.box-footer -->

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php $this->renderPartial('_popkaryawan',array('user'=>$user,'divisi'=>$divisi));?>
<script type="text/javascript">
$(document).ready(function(){
    $("#gambarKonten").show();
    $("#videoKonten").show();
});

$("#idsubkategori").change(function(){
    var id = $("#idsubkategori").val();
    console.log(id);
    $.ajax({
        type: "POST",
        url : "<?php echo Yii::app()->createAbsoluteUrl('Content/ChangeSub'); ?>",
        data: "id="+id,
        cache:false,
        success: function(msg){
            $('#detail_input').html(msg);
            $('#content-form').find('input[name*="[idsubkategori]"]').val(id);
        }
    });
});


$("#draft").click(function(){
  var r = confirm("Apakah Anda Yakin Menyimpan sebagai Draft? ");
  if (r == true) {
    if(formValidator()){
        $('#stats').val('draft');
          setTimeout(function(){
            $('#content-form-to').submit();
          }, 100);        
      }      
  } else {
    return false;
  }
});

$("#simpan").click(function(){
    var r = confirm("Apakah Anda Yakin Akan Mempublish Konten ? ");
    if (r == true) {
      if(formValidator()){
        $('#stats').val('simpan');
          setTimeout(function(){
            $('#content-form-to').submit();
          }, 100);        
      }       
    } else {
        return false;
    } 
});

</script>

<script type='text/javascript'>
function formValidator(){
   // Make quick references to our fields
   var idsubkategori = document.getElementById('idsubkategori');
   var judul = document.getElementById('judul');
   // Check each input in the order that it appears in the form!
   if(madeSelection(idsubkategori, "Mohon Pilih Salah Satu Sub-Kategori")){
     if(notEmpty(judul, "Mohon isi judul konten")){
        return true;
     }
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
function isNumeric(elem, helperMsg){
   var numericExpression = /^[0-9]+$/;
   if(elem.value.match(numericExpression)){
      return true;
   }else{
      alert(helperMsg);
      elem.focus();
      return false;
   }
}
function isAlphabet(elem, helperMsg){
   var alphaExp = /^[a-zA-Z]+$/;
   if(elem.value.match(alphaExp)){
      return true;
   }else{
      alert(helperMsg);
      elem.focus();
      return false;
   }
}
function isAlphanumeric(elem, helperMsg){
   var alphaExp = /^[0-9a-zA-Z]+$/;
   if(elem.value.match(alphaExp)){
      return true;
   }else{
      alert(helperMsg);
      elem.focus();
      return false;
   }
}
function lengthRestriction(elem, min, max){
   var uInput = elem.value;
   if(uInput.length < min || uInput.length > max){
      alert("Please enter between " +min+ " and " +max+ " characters");
      elem.focus();
      return false;
   }else{
      return true;
   }
}
function madeSelection(elem, helperMsg){
   if(elem.value == ""){
      alert(helperMsg);
      elem.focus();
      return false;
   }else{
      return true;
   }
}
function emailValidator(elem, helperMsg){
   var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
   if(elem.value.match(emailExp)){
      return true;
   }else{
      alert(helperMsg);
      elem.focus();
      return false;
   }
}
</script>