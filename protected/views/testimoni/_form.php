<!-- <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet"> -->
<!-- form start -->
<?php
//var_dump(empty($lampiran));exit;
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'testimoni-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'enctype'=>'multipart/form-data'
    ),
  ));
?>    
<?php echo $form->errorSummary($model); ?>

<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><?php if($model->isNewRecord)  echo 'Add'; else echo 'Update';?> Testimonial</h1>
      </div>
      <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-default">
              <div class="panel-body">
                  <div class="dataTable_wrapper">
                      <div class="box-body">
                        <div class="form-group">                    
                            <label for="nik" class="col-sm-2 control-label">NIK<span class="required" style="color:#ff0000">*</span></label>
                            <div class="col-sm-10">
                              <?php echo $form->textField($model,'nik_user',array('class' => 'form-control','maxlength'=>50, 'id' => 'nik', 'readonly'=>'readonly', 'data-toggle'=>'modal', 'data-target'=>'#myModal', 'style'=>'cursor:pointer;')); ?>
                                <p><i>*Click to search</i></p>
                            </div>
                        </div>
                        <div class="form-group">                    
                            <label for="nama" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" id="nama" readonly="readonly" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">                    
                            <label for="nama" class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-10">
                                <input type="text" id="unit" readonly="readonly" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">                    
                            <label for="nama" class="col-sm-2 control-label">Posisi</label>
                            <div class="col-sm-10">
                                <input type="text" id="posisi" readonly="readonly" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="isi_testimoni" class="col-sm-2 control-label">Testimonial <span class="required" style="color:#ff0000">*</span></label>
                            <div class="col-sm-10">
                                <?php echo $form->textArea($model, 'isi_testimoni', array('rows' => 3, 'cols' => 50, 'class' => 'form-control', 'id'=>'isi_testimoni', 'required'=>'required')); ?>
                                <?php echo $form->error($model, 'isi_testimoni'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="video" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'video'); ?></label>
                            <div class="col-sm-10">
                                <?php
                                $vid = $model->video;
                                if($vid!="")
                                { ?>
                                    <video id="videoKonten" src="<?php echo Yii::app()->createUrl('/Testimoni/displayVideo', array('id'=>$model->id_testimoni)); ?>" controls /></video>
                                    <div><a style="float:left;" class="btn btn-danger btn-xs" id="hapus_video" data-id="<?php echo $model->id_testimoni; ?>"><i class="fa fa-times-circle"></i> Remove</a></div>
                                <?php }
                                ?>
                            </div>
                            <label for="video" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <?php echo $form->fileField($model, 'video', array('class' => 'form-control', 'id'=>'video', 'onchange'=>'videoValid(this)')); ?>
                                <?php echo $form->error($model, 'video'); ?>
                                <p><i>*Only SWF, FLV, 3GP, MP4, AVI, MPG Allowed (Max Size 20MB)</i></p>       
                            </div>      
                        </div>
                      <div class="box-footer">
                          <?php if($model->isNewRecord) echo CHtml::htmlButton(Yii::t('mds','{icon} Simpan',array('{icon}'=>'<i class="fa fa-save"></i>')), array('style'=>'float:right', 'class'=>'btn btn-success btn-lg', 'id'=>'simpan')); else echo CHtml::htmlButton(Yii::t('mds','{icon} Update',array('{icon}'=>'<i class="fa fa-save"></i>')), array('style'=>'float:right', 'class'=>'btn btn-success btn-lg', 'id'=>'update')); ?>
                      </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>    
    </div>
    <!-- /#page-wrapper -->
</div>
<?php $this->endWidget(); ?>

<?php 
echo $this->renderPartial("_formUser",array('user'=>$user,'unit'=>$unit));
 ?>

<script type="text/javascript">
$(document).ready(function() {
    <?php
    if(isset($_GET['id'])){
        $kar = User::model()->findByattributes(array('N_NIK'=>$model->nik_user));
        $nama = $kar->V_NAMA_KARYAWAN;
        $unit = $kar->V_SHORT_UNIT;
        $pos = $kar->V_SHORT_POSISI;
        echo 
        "document.getElementById('nama').value ='".$nama."';
        document.getElementById('unit').value = '".$unit."';
        document.getElementById('posisi').value = '".$pos."';";
    }
    ?>   
});
function cekUnique(){
    var id = $("#nik").val();
    // var hasil = false;
    $.ajax({
        type: "POST",
        url : "<?php echo Yii::app()->createAbsoluteUrl('Testimoni/cekUser'); ?>",
        data: "id="+id,
        dataType: 'json',
        success: function(msg) {
          if(msg==true){
                var r = confirm("Simpan Data Testimoni ? ");
                if (r == true) {
                      $('#testimoni-form').submit();
                } else {
                    return false;
                }
          }
          else{
            alert("Mohon maaf user sudah memberikan testimoni");
            return false;
          }
        }
    });
}

$("#simpan").click(function(){
    var exec = formValidator();
    if(exec == true){
       cekUnique();
    }else{
        return false;
    }
});
function cekUniqueupdate(){
    var id = $("#nik").val();
    var id_ori = <?php echo '"'.$model->nik_user.'"'; ?>;
    $.ajax({
        type: "POST",
        url : "<?php echo Yii::app()->createAbsoluteUrl('Testimoni/cekUserUpdate'); ?>",
        data: {
                    id: id,
                    id_ori: id_ori,
                },
        dataType: 'json',
        success: function(msg) {
          if(msg==true){
                var r = confirm("Update Data Testimoni ? ");
                if (r == true) {
                      $('#testimoni-form').submit();
                } else {
                    return false;
                }
          }
          else{
            alert("Mohon maaf user sudah memberikan testimoni");
            return false;
          }
        }
    });
}

$("#update").click(function(){
    var exec = formValidator();
    if(exec == true){
       cekUniqueupdate();
    }else{
        return false;
    }
});
</script>
<script type='text/javascript'>
function formValidator(){
   // Make quick references to our fields
   var testimoni = document.getElementById('isi_testimoni');
   var nik = document.getElementById('nik');
   // Check each input in the order that it appears in the form!
   if(notEmpty(nik, "Mohon Isi NIK")){
     if(notEmpty(testimoni, "Mohon Isi testimoni")){
        
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