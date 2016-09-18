<!-- <link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet"> -->
<!-- form start -->
<?php
// var_dump(!$model->isNewRecord);exit;
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'authassignment-form',
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
          <h1 class="page-header"><?php echo !$model->isNewRecord ? "Add Admin Culture" : "Update Admin Culture"; ?></h1>
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
                            <label for="itemname" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'itemname'); ?></label>
                            <div class="col-sm-10">
                              <?php echo $form->dropdownlist($model, 'itemname', CHtml::listData(Authitem::model()->findAll(), 'name', 'name'), array('class' => 'form-control', 'empty' => 'Pilih', 'id' => 'itemname')); ?>
                            </div>
                        </div>
                        <div class="form-group" id="un">                    
                            <label for="unit" class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-10">
                              <div class="input-group">
                                <input maxlength="50" id="unit" readonly="readonly" class="form-control col-md-5" type="text" value="<?php echo !$model->isNewRecord ? Unit::model()->findByAttributes(array('id_unit'=>$model2->id_unit))->nama_unit : ''; ?>">
                                <input type="hidden" id="id_unit" name="Roleunit[id_unit]" value="<?php echo !$model->isNewRecord ? $model2->id_unit : ''; ?>">
                                <span class="input-group-btn">
                                  <button data-toggle="modal" data-target="#myModalUnit" id="btncari" class="btn btn-default" name="yt0" type="button"><i class="fa fa-search"></i>Cari</button>
                                </span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">                    
                            <label for="nik" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'nik'); ?></label>
                            <div class="col-sm-10">
                              <?php echo $form->textField($model,'nik',array('class' => 'form-control','maxlength'=>50, 'id' => 'nik')); ?>
                              <p><small><i>*Input NIK or Search</i></small></p>
                              <button class="btn btn-success" data-toggle="modal" data-target="#myModal" type="button" id="myBtn"><span class="glyphicon glyphicon-search"></span> Cari User</button>
                            </div>
                        </div>
                      <div class="box-footer">
                          <?php //echo CHtml::htmlButton(Yii::t('mds','{icon} Simpan',array('{icon}'=>'<i class="fa fa-save"></i>')), array('style'=>'float:right', 'class'=>'btn btn-success btn-lg', 'id'=>'simpan')); ?>
                          <?php echo CHtml::htmlButton(Yii::t('mds',$model->isNewRecord ? '{icon} Create' : '{icon} Save',array('{icon}'=>'<i class="fa fa-save"></i>')), array('style'=>'float:right','class'=>'btn btn-success btn-lg', 'onClick'=>$model->isNewRecord ? 'check();' : 'checkupdate("'.$model->nik.'");' )); ?>
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
echo $this->renderPartial("_formUser",array('user'=>$user));
echo $this->renderPartial("_formUnit",array('unit'=>$unit,'listdivisi'=>$listdivisi));
 ?>

<script type="text/javascript">

function cekUnique(){
    var id = $("#nik").val();
    // var hasil = false;
    $.ajax({
        type: "POST",
        url : "<?php echo Yii::app()->createAbsoluteUrl('Authassignment/cekUser'); ?>",
        data: "id="+id,
        dataType: 'json',
        success: function(msg) {
          if(msg==true){
            $('#authassignment-form').submit();
          }
          else{
            alert("Mohon maaf user sudah berstatus admin");
            return false;
          }
        }
    });
}


function check()
{
    var id = $("#nik").val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            id: id,
        },
        url: "<?php echo Yii::app()->createAbsoluteUrl('Authassignment/cekUser'); ?>",
        success: function(data)
        {
              if(data === 'USER_EXISTS')
              {
                  alert('Maaf, Data yang anda masukan telah terdaftar seabagai user, silakan pilih data lain.');
                  return false;
              }
              else if(data === 'USER_AVAILABLE')
              {
                  var r = confirm("Apakah Anda Yakin Akan Menambah Data User? ");
                  if (r == true) {
                    $('#authassignment-form').submit();    
                  } else {
                    return false;
                  }
              }
        }
    })              
}

function checkupdate(id_ori)
{
    var id = $("#nik").val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            id: id,
            id_ori: id_ori,
        },
        url: "<?php echo Yii::app()->createAbsoluteUrl('Authassignment/cekUserUpdate'); ?>",
        success: function(data)
        {
              if(data === 'USER_EXISTS')
              {
                  alert('Maaf, Data yang anda masukan telah terdaftar seabagai user, silakan pilih data lain.');
                  return false;
              }
              else if(data === 'USER_AVAILABLE')
              {
                  var r = confirm("Apakah Anda Yakin Akan Mengubah Data User tersebut? ");
                  if (r == true) {
                    $('#authassignment-form').submit();    
                  } else {
                    return false;
                  }
              }
        }
    })              
}

$("#itemname").change(function(){
  if(this.value == "adminunit"){
    // document.getElementById('un').style.display = "block";
  }else if(this.value == "adminhr"){
    // $('#unit').val('');
    // document.getElementById('btncari').style.display = "none";
  }
});

$("#simpan").click(function(){
    var r = confirm("Simpan Data Admin ? ");
    if (r == true) {
      if(formValidator()){
        // console.log(cekUnique());
        if(cekUnique()){
          $('#authassignment-form').submit();
        }
      }       
    } else {
        return false;
    } 
});
</script>
<script type='text/javascript'>
function formValidator(){
   // Make quick references to our fields
   var itemname = document.getElementById('itemname');
   var nik = document.getElementById('nik');
   // Check each input in the order that it appears in the form!
   if(madeSelection(itemname, "Mohon Pilih Salah Satu Pilihan Admin")){
     if(notEmpty(nik, "Mohon Isi NIK Admin")){
        if(isNumeric(nik, "Mohon Isi NIK Admin dengan angka")){
            return true;
        }
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