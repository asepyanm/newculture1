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
<?php echo $form->errorSummary($model); ?>

    
    <!-- /.row -->
    <div class="row" class="wow animated fadeIn" data-wow-duration="2s">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="box-body">
                        <div class="form-group">                    
                            <label for="idsubkategori" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'idsubkategori'); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->dropdownlist($model, 'idsubkategori', CHtml::listData(Subkategori::model()->findAll(), 'idsubkategori', 'nama'), array('class' => 'form-control', 'empty' => 'Pilih', 'id' => 'idsubkategori')); ?>
                                <?php echo $form->error($model, 'idsubkategori'); ?>                
                            </div>
                        </div>
                        <div class="form-group" id="x1">
                            <label for="judul" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'judul', array('id'=>'y1')); ?></label>
                            <div class="col-sm-10">                
                                <?php echo $form->textField($model, 'judul', array('class' => 'form-control', 'size' => 100, 'maxlength' => 100, 'id' => 'judul')); ?>
                                <?php echo $form->error($model, 'judul'); ?>                
                            </div>
                        </div>
                        <div class="form-group" id="x2">
                            <label for="sinopsis" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'sinopsis', array('id'=>'y2')); ?></label>
                            <div class="col-sm-10">                
                                <?php echo $form->textArea($model, 'sinopsis', array('rows' => 3, 'cols' => 50, 'size' => 300, 'maxlength' => 300, 'class' => 'form-control', 'id' => 'sinopsis')); ?>
                                <?php echo $form->error($model, 'sinopsis'); ?>                
                            </div>
                        </div> 
                        <div class="form-group" id="x3">
                            <label for="isi" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'isi', array('id'=>'y3')); ?></label>
                            <div class="col-sm-10">
                                <?php echo $form->textArea($model, 'isi', array('class' => 'form-control', 'id'=>'isi')); ?>                
                                <?php echo $form->error($model, 'isi'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="x4">
                            <label for="gambar" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'gambar', array('id'=>'y4')); ?></label>
                            <div class="col-sm-10">
                                <?php
                                $foto = $model->gambar;
                                if($foto!="")
                                { ?>
                                    <img id="gambarKonten" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/<?php echo $foto; ?>" />
                                    <div><a style="float:left;" class="btn btn-danger btn-xs" id="hapus_gambar" data-id="<?php echo $model->idcontent; ?>"><i class="fa fa-times-circle"></i> Remove</a></div>
                                <?php }
                                ?>                                                              
                                <?php echo $form->fileField($model, 'gambar', array('class' => 'form-control', 'id'=>'gambar', 'onchange'=>'imageValid(this)')); ?>
                                <?php echo $form->error($model, 'gambar'); ?>
                                <p><i>*Only JPG, PNG, GIF, BMP Allowed</i></p>           
                            </div>
                        </div>
                        <div class="form-group" id="x5">
                            <label for="video" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'video', array('id'=>'y5')); ?></label>
                            <div class="col-sm-10">
                                <?php
                                $vid = $model->video;
                                if($vid!="")
                                { ?>
                                    <video id="videoKonten" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/<?php echo $vid; ?>" controls /></video>
                                    <div><a style="float:left;" class="btn btn-danger btn-xs" id="hapus_video" data-id="<?php echo $model->idcontent; ?>"><i class="fa fa-times-circle"></i> Remove</a></div>
                                <?php }
                                ?>
                            </div>
                            <label for="video" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <?php echo $form->fileField($model, 'video', array('class' => 'form-control', 'id'=>'video', 'onchange'=>'videoValid(this)')); ?>
                                <?php echo $form->error($model, 'video'); ?>
                                <p><i>*Only SWF, FLV, 3GP, MP4, AVI, MPG Allowed</i></p>             
                            </div>
                        </div>
                        <div class="form-group" id="x6">
                            <label for="slide" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'slide', array('id'=>'y6')); ?></label>
                            <div class="col-sm-10">
                            <?php
                            if ($model->slide=='Y'){                
                                echo $form->checkBox($model, 'slide', array('value'=>'Y', 'uncheckValue'=>'N', 'checked'=>'checked', 'id'=>'slide'));
                            }else{
                                echo $form->checkBox($model, 'slide', array('value'=>'Y', 'uncheckValue'=>'N', 'id'=>'slide'));            
                            }
                            echo $form->error($model, 'slide'); ?>
                            </div>
                        </div>
                        <div class="form-group" id="x7">
                            <label for="link" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'link', array('id'=>'y7')); ?></label>
                            <div class="col-sm-10">                
                            <?php
                            if ($model->link=='Y'){                
                                echo $form->checkBox($model, 'link', array('value'=>'Y', 'uncheckValue'=>'N', 'checked'=>'checked', 'id'=>'link'));
                            }else{
                                echo $form->checkBox($model, 'link', array('value'=>'Y', 'uncheckValue'=>'N', 'id'=>'link'));            
                            }
                            echo $form->error($model, 'link'); ?>             
                            </div>
                        </div>
                        <div class="form-group" id="x8">         
                            <label for="fax" class="col-sm-2 control-label">FILE (PDF)</label>
                            <div class="col-sm-8">
                           <?php
                           if (!isset($lampiran)) $lampiran=null;
                           $jml = (isset($lampiran) and $lampiran!=null and empty($lampiran))==false? count($lampiran) : 0;
                           $max = 1;
                           $mix = 3;
                           if ($jml>0){
                            $x = 0;
                               foreach($lampiran as $data){
                               ?>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-group input-group-btn">
                                        <div class="form-control uneditable-input"><i class="icon-file fileupload-exists"></i>
                                            <span class="fileupload-preview">
                                                <a href="<?php echo Yii::app()->baseUrl ?>/upload/<?php echo $data->filename; ?>" target="_blank"><?php echo $data->filename; ?></a>
                                                
                                            </span>
                                        </div>            
                                        <a class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                                                <input type="file" name="lampiran[]" id="uploadBtn" class="upload" onchange="ValidateSingleInput(this);" />
                                                <input type="hidden" name="lampiran_exist_id[]" value="<?php echo $data->idlampiran;?>"/>
                                        </a>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <?php 
                                } 
                                if($jml<$mix){
                                    $x = $mix-$jml;
                                    for ($i = 0; $i < $x; $i++) { ?>
                                        <div style="text-align:left;display:none" id="div_lampiran" class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-group input-group-btn">
                                                <div class="form-control uneditable-input"><i class="icon-file fileupload-exists"></i>
                                                    <span class="fileupload-preview">
                                                    </span>
                                                </div>            
                                                <a class="btn btn-default btn-file">
                                                        <span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                                                        <input type="file" name="lampiran[]" id="uploadBtn" class="upload" onchange="ValidateSingleInput(this);" />
                                                </a>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }

                            }else{
                                $x = 2;
                                for ($i = 0; $i < $max; $i++)
                                        { ?>
                                <div style="text-align:left;display:none" id="div_lampiran" class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-group input-group-btn">
                                        <div class="form-control uneditable-input"><i class="icon-file fileupload-exists"></i>
                                            <span class="fileupload-preview">
                                            </span>
                                        </div>            
                                        <a class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                                                <input type="file" name="lampiran[]" id="uploadBtn" class="upload" onchange="ValidateSingleInput(this);" />
                                        </a>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <div style="text-align:left;" class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-group input-group-btn">
                                        <div class="form-control uneditable-input"><i class="icon-file fileupload-exists"></i>
                                            <span class="fileupload-preview">
                                            </span>
                                        </div>            
                                        <a class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                                                <input type="file" name="lampiran[]" id="uploadBtn" class="upload" onchange="ValidateSingleInput(this);" />
                                        </a>
                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <?php
                                    }   
                                } ?>
                          
                          <a style="float:left;" class="btn btn-primary btn-xs add_lampiran"><i class="fa fa-plus"></i> lampiran</a>

                            </div>
                        </div>

                                

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <input type="hidden" id="stats" name="tombol">
                        <?php echo CHtml::htmlButton(Yii::t('mds','{icon} Simpan',array('{icon}'=>'<i class="fa fa-save"></i>')), array('style'=>'float:right','class'=>'btn btn-success btn-lg', 'id'=>'simpan')); ?>            
                        <?php if($model->idstatus!=1){ echo CHtml::htmlButton(Yii::t('mds','{icon} Draft',array('{icon}'=>'<i class="fa fa-file"></i>')), array('style'=>'float:right','class'=>'btn btn-success btn-lg', 'id'=>'draft')); } ?>
                    </div><!-- /.box-footer -->

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
      $(document).ready(function(){
        $("#gambarKonten").show();
        $("#videoKonten").show();
        CKEDITOR.replace( 'isi',
        {
          filebrowserBrowseUrl :'editor/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
          filebrowserImageBrowseUrl : 'editor/ckeditor/filemanager/browser/default/browser.html?Type=Image&amp;Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
          filebrowserFlashBrowseUrl :'editor/ckeditor/filemanager/browser/default/browser.html?Type=Flash&amp;Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
          filebrowserUploadUrl  :'<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=File',
          filebrowserImageUploadUrl : '<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
          filebrowserFlashUploadUrl : '<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
        });
      });


var _validFileExtensions = [".pdf"];    
function ValidateSingleInput(oInput) {
  //alert(oInput.files[0].size);
    if (oInput.files[0].size > 10000000) {
        alert('Maaf maksimal size lampiran adalah 10 mb');
        oInput.value = "";
        return false;
    }
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Maaf, " + sFileName + " tidak valid, ekstensi file yang diperbolehkan adalah: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
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

    // function imageValid() {
    //     var files = document.getElementById("gambar").files;
    //     if(files.length==0){
    //         return true;
    //     }
    //     else{
    //       for (var i=0, len=files.length; i<len; i++){
    //           var n = files[i].name,
    //               s = files[i].size,
    //               t = files[i].type;
    //           console.log(files[i]);
          
    //           if (s > 1000000) {
    //               alert('Please deselect this file: "' + n + '," it\'s larger than the maximum filesize allowed. Sorry!');
    //               return false;
    //           }
    //           else if (t != 'image/jpeg') {
    //             if (t != 'image/png') {
    //               if (t != 'image/gif') {
    //                 if (t != 'image/bmp') {
    //                   alert('Please deselect this file: "' + n + '," it\'s not filetype allowed. Sorry!');
    //                   return false;
    //                 }
    //               }
    //             }
    //           }
    //           return true;
              
    //       }
    //     }
    // }

    // function videoValid() {
    //   var files = document.getElementById("video").files;
    //     if(files.length==0){
    //         return true;
    //     }
    //     else{
    //       for (var i=0, len=files.length; i<len; i++){
    //           var n = files[i].name,
    //               s = files[i].size,
    //               t = files[i].type;
    //           console.log(files[i]);
          
    //           if (s > 10000000) {
    //               alert('Please deselect this file: "' + n + '," it\'s larger than the maximum filesize allowed. Sorry!');
    //               return false;
    //           }
    //           else if (t != 'video/mp4') {
    //             if (t != 'video/3gp') {
    //               if (t != 'video/swf') {
    //                 if (t != 'video/flv') {
    //                   if (t != 'video/avi') {
    //                     if (t != 'video/mpg') {
    //                       alert('Please deselect this file: "' + n + '," it\'s not filetype allowed. Sorry!');
    //                       return false;
    //                     }
    //                   }
    //                 }
    //               }
    //             }
    //           }
    //           return true;  
    //       }
    //     }
    //   }

// $("#gambar").change(
//     function(e) {
//         var files = e.originalEvent.target.files;
//         for (var i=0, len=files.length; i<len; i++){
//             var n = files[i].name,
//                 s = files[i].size,
//                 t = files[i].type;
            
        
//             if (s > 1000000) {
//                 alert('Please deselect this file: "' + n + '," it\'s larger than the maximum filesize allowed. Sorry!');
//             }
//             else if (t != 'image/jpeg') {
//               if (t != 'image/png') {
//                 if (t != 'image/gif') {
//                   if (t != 'image/bmp') {
//                     alert('Please deselect this file: "' + n + '," it\'s not filetype allowed. Sorry!');
//                     console.log(files[i]);
//                   }
//                 }
//               }
//             }      
//         }
//     });

// $("#video").change(
//     function(e) {
//         var files = e.originalEvent.target.files;
//         for (var i=0, len=files.length; i<len; i++){
//             var n = files[i].name,
//                 s = files[i].size,
//                 t = files[i].type;
//             console.log(files[i]);
        
//             if (s > 10000000) {
//                 alert('Please deselect this file: "' + n + '," it\'s larger than the maximum filesize allowed. Sorry!');
//             }
//             else if (t != 'video/mp4') {
//               if (t != 'video/3gp') {
//                 if (t != 'video/swf') {
//                   if (t != 'video/flv') {
//                     if (t != 'video/avi') {
//                       if (t != 'video/mpg') {
//                         alert('Please deselect this file: "' + n + '," it\'s not filetype allowed. Sorry!');
//                         console.log(files[i]);
//                       }
//                     }
//                   }
//                 }
//               }
//             }  
//         }
//     });

// $("#idsubkategori").change(function(){
//     var id = $("#idsubkategori").val();
//     if(!id){
//       $("#x1").hide();
//       $("#x2").hide();
//       $("#x3").hide();
//       $("#x4").hide();
//       $("#x5").hide();
//       $("#x6").hide();
//       $("#x7").hide();
//       $("#x8").hide();
//     }
//     else if(id==1){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").show();
//         $("#x4").show();
//         $("#x5").show();
//         $("#x6").show();
//         $("#x7").show();
//         $("#x8").show();
//         document.getElementById('y1').innerHTML = 'TITLE';
//         document.getElementById('y2').innerHTML = 'DESCRIPTION';
//         document.getElementById('y3').innerHTML = 'CONTENT ARTICLE';
//         document.getElementById('y4').innerHTML = 'PICTURE';
//         document.getElementById('y5').innerHTML = 'VIDEO';
//         document.getElementById('y6').innerHTML = 'SLIDE';
//         document.getElementById('y7').innerHTML = 'LINK';
//         document.getElementById('y8').innerHTML = 'ATTACH FILE';
//     }
//     else if(id==2){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").hide();
//         $("#x4").show();
//         $("#x5").hide();
//         $("#x6").hide();
//         $("#x7").hide();
//         $("#x8").hide();
//         document.getElementById('y1').innerHTML = 'NAME';
//         document.getElementById('y2').innerHTML = 'QUOTE';
//         document.getElementById('y4').innerHTML = 'PICTURE';
//     }
//     else if(id==3){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").show();
//         $("#x4").show();
//         $("#x5").show();
//         $("#x6").show();
//         $("#x7").show();
//         $("#x8").show();
//         document.getElementById('y1').innerHTML = 'TITLE';
//         document.getElementById('y2').innerHTML = 'DESCRIPTION';
//         document.getElementById('y3').innerHTML = 'CONTENT ARTICLE';
//         document.getElementById('y4').innerHTML = 'PICTURE';
//         document.getElementById('y5').innerHTML = 'VIDEO';
//         document.getElementById('y6').innerHTML = 'SLIDE';
//         document.getElementById('y7').innerHTML = 'LINK';
//         document.getElementById('y8').innerHTML = 'ATTACH FILE';
//     }
//     else if(id==4){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").show();
//         $("#x4").show();
//         $("#x5").show();
//         $("#x6").show();
//         $("#x7").show();
//         $("#x8").show();
//         document.getElementById('y1').innerHTML = 'TITLE';
//         document.getElementById('y2').innerHTML = 'DESCRIPTION';
//         document.getElementById('y3').innerHTML = 'CONTENT ARTICLE';
//         document.getElementById('y4').innerHTML = 'PICTURE';
//         document.getElementById('y5').innerHTML = 'VIDEO';
//         document.getElementById('y6').innerHTML = 'SLIDE';
//         document.getElementById('y7').innerHTML = 'LINK';
//         document.getElementById('y8').innerHTML = 'ATTACH FILE';
//     }
//     else if(id==5){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").show();
//         $("#x4").show();
//         $("#x5").show();
//         $("#x6").hide();
//         $("#x7").hide();
//         $("#x8").show();
//         document.getElementById('y1').innerHTML = 'NAME/TITLE';
//         document.getElementById('y2').innerHTML = 'QUOTE';
//         document.getElementById('y3').innerHTML = 'CONTENT ARTICLE';
//         document.getElementById('y4').innerHTML = 'PICTURE';
//         document.getElementById('y5').innerHTML = 'VIDEO';
//         document.getElementById('y8').innerHTML = 'ATTACH FILE';
//     }
//     else if(id==6){
//         $("#x1").show();
//         $("#x2").hide();
//         $("#x3").show();
//         $("#x4").show();
//         $("#x5").hide();
//         $("#x6").hide();
//         $("#x7").hide();
//         $("#x8").show();
//         document.getElementById('y1').innerHTML = 'TITLE';
//         document.getElementById('y3').innerHTML = 'RIVIEW';
//         document.getElementById('y4').innerHTML = 'COVER BOOKS';
//         document.getElementById('y8').innerHTML = 'ATTACH FILE';
//     }
//     else if(id==7){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").show();
//         $("#x4").show();
//         $("#x5").show();
//         $("#x6").hide();
//         $("#x7").hide();
//         $("#x8").hide();
//         document.getElementById('y1').innerHTML = 'NAME';
//         document.getElementById('y2').innerHTML = 'SKILL/PORTOFOLIO';
//         document.getElementById('y3').innerHTML = 'BIODATA/PORTOFOLIO';
//         document.getElementById('y4').innerHTML = 'PICTURE';
//         document.getElementById('y5').innerHTML = 'VIDEO';
//     }
//     else if(id==8){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").hide();
//         $("#x4").show();
//         $("#x5").hide();
//         $("#x6").show();
//         $("#x7").show();
//         $("#x8").hide();
//         document.getElementById('y1').innerHTML = 'TITLE';
//         document.getElementById('y2').innerHTML = 'DESCRIPTION';
//         document.getElementById('y4').innerHTML = 'PICTURE';
//         document.getElementById('y6').innerHTML = 'SLIDE';
//         document.getElementById('y7').innerHTML = 'LINK';
//     }
//     else if(id==9){
//         $("#x1").show();
//         $("#x2").show();
//         $("#x3").hide();
//         $("#x4").hide();
//         $("#x5").show();
//         $("#x6").hide();
//         $("#x7").hide();
//         $("#x8").hide();
//         document.getElementById('y1').innerHTML = 'TITLE';
//         document.getElementById('y2').innerHTML = 'DESCRIPTION';
//         document.getElementById('y5').innerHTML = 'VIDEO';
//     }
// });

$("#hapus_gambar").click(function(){
    $("#gambarKonten").hide();
    $("#hapus_gambar").hide();
    var id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url : "<?php echo Yii::app()->createAbsoluteUrl('Content/deleteImage'); ?>",
        data: "id="+id,
        success: function(msg) {
        }
    })
});

$("#hapus_video").click(function(){
    $("#videoKonten").hide();
    $("#hapus_video").hide();
    var id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url : "<?php echo Yii::app()->createAbsoluteUrl('Content/deleteVideo'); ?>",
        data: "id="+id,
        success: function(msg) {
        }
    })
});

$(".add_lampiran").click(function(){
    var jum = jQuery("div[id='clone']").length;
    if(jum<<?php echo $x; ?>){
      var add_div = $('#div_lampiran').clone();
      add_div.attr('id', 'clone');
      add_div.show();
      $(this).before(add_div);
    }else{
      alert("Batas Maksimal Attachment adalah 3 lampiran");
    }
  });

$("#draft").click(function(){
  var r = confirm("Apakah Anda Yakin Menyimpan sebagai Draft? ");
  if (r == true) {
    if(formValidator()){
      $('#stats').val('draft');
      $('#content-form').submit();
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
        $('#content-form').submit();
      }       
    } else {
        return false;
    } 
});

var control = $("#control");

$("#btn fileupload-exists").on("hide", function () {
    control.replaceWith( control = control.clone( true ) );
});


!function ($) {

  "use strict"; // jshint ;_

 /* FILEUPLOAD PUBLIC CLASS DEFINITION
  * ================================= */

  var Fileupload = function (element, options) {
    this.$element = $(element)
    this.type = this.$element.data('uploadtype') || (this.$element.find('.thumbnail').length > 0 ? "image" : "file")
      
    this.$input = this.$element.find(':file')
    if (this.$input.length === 0) return

    this.name = this.$input.attr('name') || options.name

    this.$hidden = this.$element.find('input[type=hidden][name="'+this.name+'"]')
    if (this.$hidden.length === 0) {
      this.$hidden = $('<input type="hidden" />')
      this.$element.prepend(this.$hidden)
    }

    this.$preview = this.$element.find('.fileupload-preview')
    var height = this.$preview.css('height')
    if (this.$preview.css('display') != 'inline' && height != '0px' && height != 'none') this.$preview.css('line-height', height)

    this.original = {
      'exists': this.$element.hasClass('fileupload-exists'),
      'preview': this.$preview.html(),
      'hiddenVal': this.$hidden.val()
    }
    
    this.$remove = this.$element.find('[data-dismiss="fileupload"]')

    this.$element.find('[data-trigger="fileupload"]').on('click.fileupload', $.proxy(this.trigger, this))

    this.listen()
  }
  
  Fileupload.prototype = {
    
    listen: function() {
      this.$input.on('change.fileupload', $.proxy(this.change, this))
      $(this.$input[0].form).on('reset.fileupload', $.proxy(this.reset, this))
      if (this.$remove) this.$remove.on('click.fileupload', $.proxy(this.clear, this))
    },
    
    change: function(e, invoked) {
      if (invoked === 'clear') return
      
      var file = e.target.files !== undefined ? e.target.files[0] : (e.target.value ? { name: e.target.value.replace(/^.+\\/, '') } : null)
      
      if (!file) {
        this.clear()
        return
      }
      
      this.$hidden.val('')
      this.$hidden.attr('name', '')
      this.$input.attr('name', this.name)

      if (this.type === "image" && this.$preview.length > 0 && (typeof file.type !== "undefined" ? file.type.match('image.*') : file.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader !== "undefined") {
        var reader = new FileReader()
        var preview = this.$preview
        var element = this.$element

        reader.onload = function(e) {
          preview.html('<img src="' + e.target.result + '" ' + (preview.css('max-height') != 'none' ? 'style="max-height: ' + preview.css('max-height') + ';"' : '') + ' />')
          element.addClass('fileupload-exists').removeClass('fileupload-new')
        }

        reader.readAsDataURL(file)
      } else {
        this.$preview.text(file.name)
        this.$element.addClass('fileupload-exists').removeClass('fileupload-new')
      }
    },

    clear: function(e) {
      this.$hidden.val('')
      this.$hidden.attr('name', this.name)
      this.$input.attr('name', '')

      //ie8+ doesn't support changing the value of input with type=file so clone instead
      if (navigator.userAgent.match(/msie/i)){ 
          var inputClone = this.$input.clone(true);
          this.$input.after(inputClone);
          this.$input.remove();
          this.$input = inputClone;
      }else{
          this.$input.val('')
      }

      this.$preview.html('')
      this.$element.addClass('fileupload-new').removeClass('fileupload-exists')

      if (e) {
        this.$input.trigger('change', [ 'clear' ])
        e.preventDefault()
      }
    },
    
    reset: function(e) {
      this.clear()
      
      this.$hidden.val(this.original.hiddenVal)
      this.$preview.html(this.original.preview)
      
      if (this.original.exists) this.$element.addClass('fileupload-exists').removeClass('fileupload-new')
       else this.$element.addClass('fileupload-new').removeClass('fileupload-exists')
    },
    
    trigger: function(e) {
      this.$input.trigger('click')
      e.preventDefault()
    }
  }

  
 /* FILEUPLOAD PLUGIN DEFINITION
  * =========================== */

  $.fn.fileupload = function (options) {
    return this.each(function () {
      var $this = $(this)
      , data = $this.data('fileupload')
      if (!data) $this.data('fileupload', (data = new Fileupload(this, options)))
      if (typeof options == 'string') data[options]()
    })
  }

  $.fn.fileupload.Constructor = Fileupload


 /* FILEUPLOAD DATA-API
  * ================== */

  $(document).on('click.fileupload.data-api', '[data-provides="fileupload"]', function (e) {
    var $this = $(this)
    if ($this.data('fileupload')) return
    $this.fileupload($this.data())
      
    var $target = $(e.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');
    if ($target.length > 0) {
      $target.trigger('click.fileupload')
      e.preventDefault()
    }
  })

}(window.jQuery);

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