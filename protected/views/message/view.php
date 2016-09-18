<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bower_components/jquery/dist/jQuery-2.1.4.min.js"></script>

<?php
/* @var $this TPesanController */
/* @var $content TPesan */
?>

<?php if(isset($dataProvider)){
?>
<?php if(isset($content)){
	foreach ($content as $value) {
?>
		<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
			<div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Reject Message</h2><br/>

                </div>
                <!-- /.col-lg-12 -->
            </div>
      
            <!-- /.row -->
            <!-- <button type="button" class="btn btn-danger btn-xs btn-block" id="show" onclick="javascript:showkon();"><i class="fa fa-chevron-down "></i> Show Content</button>
			<button type="button" class="btn btn-danger btn-xs btn-block" id="hide" style="display:none;" onclick="javascript:hidekon();"><i class="fa fa-chevron-up "></i> Hide Content</button> -->
            <a href="#" id="show" onclick="javascript:showkon();"><i class="fa fa-chevron-down "></i> Show Content</a>
            <a href="#" id="hide" onclick="javascript:hidekon();" style="display:none;"><i class="fa fa-chevron-up "></i> Hide Content</a>
            <br/>
            <div class="row" id="not" style="display:none;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
								<table class="table table-striped table-condensed table-hover">
									<tbody>
										<tr>
											<th style="width:15%">JUDUL</th>
											<td><?php echo $value['judul']; ?></td>
										</tr>
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
											<th>SLIDE</th>
											<td><?php echo $value['slide']; ?></td>
										</tr>
										<tr>
											<th>LINK</th>
											<td><?php echo $value['link']; ?></td>
										</tr>
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
						</div>
					</div>
				</div>
			</div>
            <br/>
            <!-- /.row -->
            
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'message-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'enctype'=>'multipart/form-data'
                    ),
                  ));
                ?>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<?php echo $form->errorSummary($model); ?>
				            <div class="row">
				                <div class="col-lg-12 col-md-12 col-sm-12">
				                    <!-- Blog Comments -->
				                    <!-- Comments Form -->
				                    <div class="well">
				                        <h4>Reply Reject Message:</h4>
				                        <form role="form">
				                            <div class="form-group">
				                                <?php echo $form->textArea($model, 'isi', array('rows' => 3, 'cols' => 50, 'class' => 'form-control', 'id'=>'isi', 'onkeyup'=>'javascript:batas2(this);')); ?>
				                                <?php echo $form->error($model, 'isi'); ?>
				                                <br>
				                                Total character count: <span id="display_count">0</span> characters. Character left: <span id="word_left">200</span>
				                            </div>
				                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
				                        </form>
				                    </div>

				                    <hr>
				                </div>
				            </div>
				            <?php $this->endWidget(); ?>
                            <div class="dataTable_wrapper">
								<?php $this->widget('bootstrap.widgets.TbListView', array(
									'dataProvider'=>$dataProvider,
									'itemView'=>'_view',
								)); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
<script type="text/javascript">
function batas2(e) {

    var maxLength = 200;
	var chars = e.value.length;   
	// alert(chars);
    if (chars > maxLength) {
      // Split the string on first 200 words and rejoin on spaces
      // var trimmed = $(e).val().split(/\s+/, 200).join(" ");
      // // Add a space at the end to make sure more typing creates new words
      // $(e).val(trimmed + " ");
      e.value = e.value.substring(0, maxLength);
    }
    else {
      $('#display_count').text(chars);
      $('#word_left').text(200-chars);
    }
  }
function hidekon() {
    document.getElementById('show').style.display = "initial";
    document.getElementById('hide').style.display = "none";
    $("#not").slideToggle("slow");
}
function showkon() {
	document.getElementById('hide').style.display = "initial";
	document.getElementById('show').style.display = "none";
	$("#not").slideToggle("slow");
}
$("#submit").click(function(){
    var exec = formValidator();
    if(exec == true){
       $('#message-form').submit();
    }else{
        return false;
    }
});
function formValidator(){
   // Make quick references to our fields
   var isi = document.getElementById('isi');
   // Check each input in the order that it appears in the form!
   if(notEmpty(isi, "Please entry reject message")){
     if(lengthRestriction(isi, 0, 200)){
        
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