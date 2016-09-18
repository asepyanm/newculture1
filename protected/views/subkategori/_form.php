<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/jquery/dist/jQuery-2.1.4.min.js"></script>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<!-- form start -->
<?php
//var_dump(empty($lampiran));exit;
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'subkategori-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'enctype'=>'multipart/form-data'
    ),
  ));
?>    
<?php echo $form->errorSummary($model); ?> 

<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Sub Kategori</h1>
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
                            <label for="idkategori" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'idkategori'); ?></label>
                            <div class="col-sm-10">
                              <?php echo $form->dropdownlist($model, 'idkategori', CHtml::listData(Kategori::model()->findAll(), 'idkategori', 'nama'), array('class' => 'form-control', 'empty' => 'Pilih', 'id' => 'idkategori')); ?>
                            </div>
                        </div>
                        <div class="form-group">                    
                            <label for="nama" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'nama'); ?></label>
                            <div class="col-sm-10">
                              <?php echo $form->textField($model,'nama',array('class' => 'form-control','maxlength'=>50, 'id' => 'nama')); ?>
                            </div>
                        </div>
                        <div class="form-group">                    
                            <label for="deskripsi" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'deskripsi'); ?></label>
                            <div class="col-sm-10">
                              <?php echo $form->textArea($model,'deskripsi',array('rows' => 3, 'cols' => 50,'class' => 'form-control','maxlength'=>300, 'id' => 'deskripsi')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambar" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'gambar'); ?></label>
                            <div class="col-sm-10">
                                <?php
                                $foto = $model->gambar;
                                if($foto!="")
                                { ?>
                                    <img src="<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$model->idsubkategori)); ?>" /><div>&nbsp;</div>
                                <?php }
                                ?>                                                              
                                <?php echo $form->fileField($model, 'gambar', array('class' => 'form-control', 'id'=>'gambar', 'onchange'=>'imageValid(this)')); ?>
                                <?php echo $form->error($model, 'gambar'); ?>
                                <p><i>*Only JPG, PNG, GIF, BMP Allowed</i></p>           
                            </div>
                        </div>
                        

                        

                        <!-- <div class="form-group">
                            <label for="judul" class="col-sm-2 control-label"><?php //echo $form->labelEx($ceklis, 'judul'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->judul==1){                
                              //     echo $form->checkBox($ceklis, 'judul', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'judul' , 'onChange'=>'javascript:cekjudul(this);'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'judul', array('value'=>1, 'uncheckValue'=>0, 'id'=>'judul', 'onChange'=>'javascript:cekjudul(this);'));            
                              // }
                              // echo $form->error($ceklis, 'judul'); ?>
                            </div>
                            
                            <label for="sinopsis" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'sinopsis'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->sinopsis==1){                
                              //     echo $form->checkBox($ceklis, 'sinopsis', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'sinopsis', 'onChange'=>'javascript:ceksinopsis(this);'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'sinopsis', array('value'=>1, 'uncheckValue'=>0, 'id'=>'sinopsis', 'onChange'=>'javascript:ceksinopsis(this);'));            
                              // }
                              // echo $form->error($ceklis, 'sinopsis'); ?>
                            </div>
                            <label for="isi" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'isi'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->isi==1){                
                              //     echo $form->checkBox($ceklis, 'isi', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'isi', 'onChange'=>'javascript:cekisi(this);'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'isi', array('value'=>1, 'uncheckValue'=>0, 'id'=>'isi', 'onChange'=>'javascript:cekisi(this);'));            
                              // }
                              // echo $form->error($ceklis, 'isi'); ?>
                            </div>
                            <label for="gambar" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'gambar'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->gambar==1){                
                              //     echo $form->checkBox($ceklis, 'gambar', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'gambar'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'gambar', array('value'=>1, 'uncheckValue'=>0, 'id'=>'gambar'));            
                              // }
                              // echo $form->error($ceklis, 'gambar'); ?>
                            </div>
                            <label for="video" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'video'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->video==1){                
                              //     echo $form->checkBox($ceklis, 'video', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'video'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'video', array('value'=>1, 'uncheckValue'=>0, 'id'=>'video'));            
                              // }
                              // echo $form->error($ceklis, 'video'); ?>
                            </div> -->
                            <!-- <label for="slide" class="col-sm-2 control-label"><?php //echo $form->labelEx($ceklis, 'slide'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->slide==1){                
                              //     echo $form->checkBox($ceklis, 'slide', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'slide'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'slide', array('value'=>1, 'uncheckValue'=>0, 'id'=>'slide'));            
                              // }
                              // echo $form->error($ceklis, 'slide'); ?>
                            </div> -->
                            <!-- <label for="link" class="col-sm-2 control-label"><?php //echo $form->labelEx($ceklis, 'link'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->link==1){                
                              //     echo $form->checkBox($ceklis, 'link', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'link'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'link', array('value'=>1, 'uncheckValue'=>0, 'id'=>'link'));            
                              // }
                              // echo $form->error($ceklis, 'link'); ?>
                            </div> -->
                            <!-- <label for="lampiran" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'lampiran'); ?></label>
                            <div class="col-sm-1">
                              <?php
                              // if ($ceklis->lampiran==1){                
                              //     echo $form->checkBox($ceklis, 'lampiran', array('value'=>1, 'uncheckValue'=>0, 'checked'=>'checked', 'id'=>'lampiran'));
                              // }else{
                              //     echo $form->checkBox($ceklis, 'lampiran', array('value'=>1, 'uncheckValue'=>0, 'id'=>'lampiran'));            
                              // }
                              // echo $form->error($ceklis, 'lampiran'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="form_judul">                    
                            <label for="link" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'label_judul'); ?></label>
                            <div class="col-sm-10">
                              <?php // echo $form->textField($ceklis,'label_judul',array('class' => 'form-control','maxlength'=>50, 'id' => 'label_judul')); ?>
                            </div>
                        </div>
                        <div class="form-group" id="form_sinopsis">                    
                            <label for="link" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'label_sinopsis'); ?></label>
                            <div class="col-sm-10">
                              <?php //echo $form->textField($ceklis,'label_sinopsis',array('class' => 'form-control','maxlength'=>50, 'id' => 'label_sinopsis')); ?>
                            </div>
                        </div>
                        <div class="form-group" id="form_isi">                    
                            <label for="link" class="col-sm-2 control-label"><?php // echo $form->labelEx($ceklis, 'label_isi'); ?></label>
                            <div class="col-sm-10">
                              <?php // echo $form->textField($ceklis,'label_isi',array('class' => 'form-control','maxlength'=>50, 'id' => 'label_isi')); ?>
                            </div>
                        </div> -->
                      <input type="hidden" name="Booleancontent[judul]" value="1">
                      <input type="hidden" name="Booleancontent[sinopsis]" value="1">
                      <input type="hidden" name="Booleancontent[isi]" value="1">
                      <input type="hidden" name="Booleancontent[gambar]" value="1">
                      <input type="hidden" name="Booleancontent[video]" value="1">
                      <input type="hidden" name="Booleancontent[lampiran]" value="1">
                      
                      <div class="box-footer">
                          <?php echo CHtml::htmlButton(Yii::t('mds','{icon} Simpan',array('{icon}'=>'<i class="fa fa-save"></i>')), array('style'=>'float:right', 'class'=>'btn btn-success btn-lg', 'id'=>'simpan')); ?>
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
<!-- /#wrapper -->
<?php $this->endWidget(); ?>

<script type="text/javascript">
function cekjudul(e){
  var changeableTags=document.getElementById('form_judul');
  if (e.checked == true){
            changeableTags.style.display="block";
  }
  else{
            changeableTags.style.display="none";
  }
}
function ceksinopsis(e){
  var changeableTags=document.getElementById('form_sinopsis');
  if (e.checked == true){
            changeableTags.style.display="block";
  }
  else{
            changeableTags.style.display="none";
  }
}
function cekisi(e){
  var changeableTags=document.getElementById('form_isi');
  if (e.checked == true){
            changeableTags.style.display="block";
  }
  else{
            changeableTags.style.display="none";
  }
}
$(document).ready(function(){
  <?php
  if($ceklis->judul==1){
    echo 'document.getElementById("form_judul").style.display="block";';
  }else{
    echo 'document.getElementById("form_judul").style.display="none";';
  }

  if($ceklis->sinopsis==1){
    echo 'document.getElementById("form_sinopsis").style.display="block";';
  }else{
    echo 'document.getElementById("form_sinopsis").style.display="none";';
  }

  if($ceklis->isi==1){
    echo 'document.getElementById("form_isi").style.display="block";';
  }else{
    echo 'document.getElementById("form_isi").style.display="none";';
  }
  ?>
  
  CKEDITOR.replace( 'deskripsi',
  {
    filebrowserBrowseUrl :'editor/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
    filebrowserImageBrowseUrl : 'editor/ckeditor/filemanager/browser/default/browser.html?Type=Image&amp;Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
    filebrowserFlashBrowseUrl :'editor/ckeditor/filemanager/browser/default/browser.html?Type=Flash&amp;Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
    filebrowserUploadUrl  :'<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=File',
    filebrowserImageUploadUrl : '<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
    filebrowserFlashUploadUrl : '<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
  });
});

$("#simpan").click(function(){
    var r = confirm("Simpan Sub Kategori ? ");
    if (r == true) {
      if(formValidator()){
        $('#subkategori-form').submit();
      }       
    } else {
        return false;
    } 
});

var _validImageExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function imageValid(oInput) {
  //alert(oInput.files[0].size);
    if (oInput.files[0].size > 5000000) {
        alert('Maaf maksimal size lampiran adalah 5 mb');
        oInput.value = "";
        return false;
    }
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validImageExtensions.length; j++) {
                var sCurExtension = _validImageExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Maaf, " + sFileName + " tidak valid, ekstensi file yang diperbolehkan adalah: " + _validImageExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>
<script type='text/javascript'>
function formValidator(){
   // Make quick references to our fields
   var idkategori = document.getElementById('idkategori');
   var nama = document.getElementById('nama');
   // Check each input in the order that it appears in the form!
   if(madeSelection(idkategori, "Mohon Pilih Salah Satu Kategori")){
     if(notEmpty(nama, "Mohon Isi Nama Sub Kategori")){
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