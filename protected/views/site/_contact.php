<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
<!-- Contact Section -->
<!-- form start -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'tpesan-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-inline',
        'role' => 'form',
        'enctype'=>'multipart/form-data'
    ),
  ));
?>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Please Contact Us if You Need Us</h3>
                </div>
            </div>
            <div class="row" style="color:#ffffff">
                <div class="col-lg-5" id="text-alamat">
                    <div class="row">
                        <div class="col-sm-12">
                          <h4 class="footer-toggle-title">PT Telekomunikasi Indonesia, Tbk</h4>
                          <h4 class="footer-toggle-title">Corporate Communication</h4>
                          <p class="footer-toggle-text">Graha Merah Putih, Jl. Japati No. 1, Bandung</p>
                          <p class="footer-toggle-text">Telp. (62-22) 452 7101</p>
                          <p class="footer-toggle-text">Bandung – 40133</p>
                          <p class="footer-toggle-link" href="#">Website: www.telkom.co.id</p>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
                <div class="col-lg-1"></div>
                <?php echo $form->errorSummary($kontak); ?>
                <div class="col-lg-6">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="width:100%">
                                    <?php echo $form->textField($kontak,'nama',array('style'=>'width:100%','class' => 'form-control','maxlength'=>100,'placeholder'=>'Your Name','id' => 'nama')); ?>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group" style="width:100%">
                                    <?php echo $form->textField($kontak,'email',array('style'=>'width:100%','class' => 'form-control','maxlength'=>100,'placeholder'=>'Your Email Address','id' => 'email')); ?>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group" style="width:100%">
                                    <?php echo $form->textField($kontak,'hp',array('style'=>'width:100%','class' => 'form-control','maxlength'=>20,'placeholder'=>'Your Phone','id' => 'hp')); ?>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="width:100%">
                                    <?php echo $form->textArea($kontak,'isipesan',array('style'=>'width:100%','class' => 'form-control','maxlength'=>255,'placeholder'=>'Your Message','id' => 'isipesan', 'rows'=>5)); ?>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <?php echo CHtml::htmlButton(Yii::t('mds','{icon} Send Message',array('{icon}'=>'<i class="fa fa-send"></i>')), array('class'=>'btn btn-xl', 'id'=>'kirim')); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $this->endWidget(); ?>

<script type='text/javascript'>
$("#kirim").click(function(){
    var r = confirm("Send Your Message ?");
    if (r == true) {
      if(formValidator()){
        $('#tpesan-form').submit();
      }       
    } else {
        return false;
    } 
});
</script>
<script type='text/javascript'>
function formValidator(){
   // Make quick references to our fields
   var nama = document.getElementById('nama');
   var email = document.getElementById('email');
   var hp = document.getElementById('hp');
   var isipesan = document.getElementById('isipesan');
   // Check each input in the order that it appears in the form!
   if(notEmpty(nama, "Please Enter Your Name")){
     if(notEmpty(email, "Please Enter Your Email Address")){
        if(notEmpty(nama, "Please Enter Your Phone Number")){
            if(notEmpty(email, "Please Enter Your Message")){
                if(isNumeric(hp, "Please Enter Only Format Number")){
                    return true;
                }
            }
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