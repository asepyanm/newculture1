<!-- Modal -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'message-form',
    // 'action'=>Yii::app()->createUrl('Content/createmessage'),
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'enctype'=>'multipart/form-data'
    ),
  ));
?>
<?php echo $form->errorSummary($message); ?> 
  <div id="modal_message" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Keterangan Claim</h4>
        </div>
        <div class="modal-body">
          <?php echo $form->textArea($message,'isi',array('rows' => 3, 'cols' => 50,'class' => 'form-control','maxlength'=>255, 'id' => 'isi')); ?>
          <input type="hidden" id="ids" name="ids" value="">
        </div>
        
        <div class="modal-footer">
          <?php echo CHtml::htmlButton(Yii::t('mds','{icon} Kirim',array('{icon}'=>'<i class="fa fa-send"></i>')), array('style'=>'float:right', 'class'=>'btn btn-success btn-lg', 'id'=>'kirim')); ?>
        </div>
      </div>
      
    </div>
  </div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
$("#kirim").click(function(){
    var r = confirm("Kirim Claim ? ");
    if (r == true) {
      if(formValidator()){
          setTimeout(function(){
            $('#message-form').submit();
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
   var alasan = document.getElementById('isi');
   // Check each input in the order that it appears in the form!
   if(notEmpty(alasan, "Mohon isi Keterangan claim")){
      return true;
   }
   return false;
}
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