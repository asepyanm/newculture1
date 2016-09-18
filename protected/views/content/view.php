<?php
/* @var $this ContentController */
/* @var $model Content */
?>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
<?php if(isset($model)){
	foreach ($model as $value) {
?>
		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><?php echo $value['judul']; ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
								<table class="table table-striped table-condensed table-hover">
									<tbody>
										<tr>
											<th style="width:15%">CREATED BY</th>
											<td><?php echo $value['V_NAMA_KARYAWAN']; ?> (<?php echo $value['created_by']; ?>)</td>
										</tr>
										<tr>
											<th>CREATED DATE</th>
											<td><?php echo $value['created_date']; ?></td>
										</tr>
										<tr>
											<th>UPDATED DATE</th>
											<td><?php echo $value['updated_date']; ?></td>
										</tr>
										<tr>
											<th>KATEGORI</th>
											<td><?php echo $value['namakat']; ?></td>
										</tr>
										<tr>
											<th>SUB KATEGORI</th>
											<td><?php echo $value['namasub']; ?></td>
										</tr>
										<tr>
											<th>JUDUL</th>
											<td><?php echo $value['judul']; ?></td>
										</tr>
										<?php if(!empty($value['sinopsis'])){ ?>
										<tr>
											<th>SINOPSIS</th>
											<td><?php echo $value['sinopsis']; ?></td>
										</tr>
										<?php } ?>
										<?php if(!empty($value['isi'])){ ?>
										<tr>
											<th>DESKIPSI</th>
											<td><?php echo $value['isi']; ?></td>
										</tr>
										<?php } ?>
										<?php if(!empty($value['gambar'])){ ?>
										<tr>
											<th>GAMBAR</th>
											<td><img style="max-width:100%;" src="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>"/></td>
										</tr>
										<?php } ?>
										 <tr>
											<th>STATUS</th>
											<td><?php echo $value['status']; ?></td>
										</tr>
										<tr>
											<th>STATUS EKSTERNAL</th>
											<td><?php echo $value['statusinternal']==1 ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ; ?></td>
										</tr>
										<!--<tr>
											<th>SLIDE</th>
											<td><?php //echo $value['slide']; ?></td>
										</tr>
										<tr>
											<th>LINK</th>
											<td><?php //echo $value['link']; ?></td>
										</tr> -->
									</tbody>
								</table>
							</div>
							<?php if(!empty($value['video'])){ ?>
							<div class="well">
								<video src="<?php echo Yii::app()->createUrl('/Content/displayVideo', array('id'=>$value['idcontent'])); ?>" controls /></video>
							</div>
							<?php } ?>

<?php } } ?>
						<?php if(!empty($lampiran)){ ?>
							<hr>
							Lampiran:
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No.</th>
										<th>Pelampir</th>
										<th>Nama File</th>
									</tr>
								</thead>
								<tbody>
								<?php  $a=1;
									foreach ($lampiran as $lamp){
								?>
										<tr>
											<td><?php echo $a; ?></td>
											<td><?php echo $lamp['created_by']; ?></td>
											<td><?php echo CHtml::link($lamp['filename'], array('Content/displayFile', 'id'=>$lamp['idlampiran']), array('target'=>'_blank')); ?></td>
										</tr>
								<?php
									$a++;
								}
								?>
								</tbody>
							</table>
							<?php } ?>
							<?php if(Yii::app()->user->itemname == 'adminhr'){?>
							<table class="table table-bordered table-striped">
								<tr>
									<td colspan="2" align="center">
									<?php if($value['status']=="Publish" && $value['statusinternal']==0){?>
										<a href="<?php echo Yii::app()->createUrl('content/switch', array('id'=>$value['idcontent'])); ?>" class="btn btn-success btn-lg" onclick="return confirm('Are you sure ?');"><i class="fa fa-check"></i> Publish Eksternal</a>
									<?php } if($value['status']=="Publish" && $value['statusinternal']==1){?>
										<a href="<?php echo Yii::app()->createUrl('content/switch', array('id'=>$value['idcontent'])); ?>" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure ?');"><i class="fa fa-remove"></i> Remove Eksternal</a>
									<?php } if($value['status']=="Draft" || $value['status']=="Reject"){ ?>
										<a href="<?php echo Yii::app()->createUrl('content/publish', array('id'=>$value['idcontent'])); ?>" class="btn btn-success btn-lg" onclick="return confirm('Are you sure ?');"><i class="fa fa-upload"></i> <?php echo $value['status']=="Reject" ? 'Restore' : 'Publish'; ?></a>
									<?php } if($value['status']=="Publish"){?>
										<a href="#" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modal_tolak"><i class="fa fa-remove"></i> Reject</a>
									<?php } ?>				
									</td>
								</tr>
							</table>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- Modal -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form',
    'action'=>Yii::app()->createUrl('Content/deletes'),
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'enctype'=>'multipart/form-data'
    ),
  ));
?>
<?php echo $form->errorSummary($mod); ?> 
  <div id="modal_tolak" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Keterangan Penolakan</h4>
        </div>
        <div class="modal-body">
          <?php echo $form->textArea($mod,'alasan',array('rows' => 3, 'cols' => 50,'class' => 'form-control','maxlength'=>255, 'id' => 'alasan')); ?>
          <input type="hidden" id="ids" name="ids" value="<?php echo $value['idcontent'];?>">
        </div>
        
        <div class="modal-footer">
          <?php echo CHtml::htmlButton(Yii::t('mds','{icon} Reject',array('{icon}'=>'<i class="fa fa-send"></i>')), array('style'=>'float:right', 'class'=>'btn btn-success btn-lg', 'id'=>'reject')); ?>
        </div>
      </div>
      
    </div>
  </div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
$("#reject").click(function(){
    var r = confirm("Reject Content ? ");
    if (r == true) {
      if(formValidator()){
          setTimeout(function(){
            $('#content-form').submit();
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
   var alasan = document.getElementById('alasan');
   // Check each input in the order that it appears in the form!
   if(notEmpty(alasan, "Mohon isi alasan reject content")){
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
