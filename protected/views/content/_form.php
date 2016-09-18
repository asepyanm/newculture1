<link href="<?php echo Yii::app()->theme->baseUrl; ?>/dist/css/filepdf.css" rel="stylesheet">
<!-- form start -->

<?php
// var_dump($boole);exit;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form-to',
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
                    <?php if($boole->judul==1){ ?>
                        <div class="form-group">
                            <label for="judul" class="col-sm-2 control-label"><?php if($boole->label_judul==null || !isset($boole->label_judul)) echo $form->labelEx($model, 'judul'); else echo $boole->label_judul; ?>*</label>
                            <div class="col-sm-10">                
                                <?php echo $form->hiddenField($model, 'idsubkategori', array()); ?>
                                <?php 
                                if($boole->label_judul=='NIK'){
                                    echo $form->textField($model, 'judul', array('class' => 'form-control', 'size' => 100, 'maxlength' => 100, 'id' => 'judul', 'readonly'=>'readonly','style'=>'cursor:pointer;', 'data-toggle'=>'modal', 'data-target'=>'#myModal'));
                                }else{
                                    echo $form->textField($model, 'judul', array('class' => 'form-control', 'size' => 100, 'maxlength' => 100, 'id' => 'judul'));
                                }
                                ?>
                                <?php echo $form->error($model, 'judul'); ?>
                                <p><i>*Max 100 Characters</i></p>              
                            </div>
                        </div>
                        <?php if($boole->label_judul=='NIK'){?>
                        <div class="form-group">
                        <label for="nama_karyawan" class="col-sm-2 control-label">NAMA KARYAWAN</label>
                            <div class="col-sm-10">                
                                <input type="text" class="form-control" readonly="readonly" id="nama"/>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="unit" class="col-sm-2 control-label">DIVISI</label>
                            <div class="col-sm-10">                
                                <input type="text" class="form-control" readonly="readonly" id="divisi"/>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="posisi" class="col-sm-2 control-label">POSISI</label>
                            <div class="col-sm-10">                
                                <input type="text" class="form-control" readonly="readonly" id="posisi"/>
                            </div>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($boole->sinopsis==1){ ?>
                        <div class="form-group">
                            <label for="sinopsis" class="col-sm-2 control-label"><?php if($boole->label_sinopsis==null || !isset($boole->label_sinopsis)) echo $form->labelEx($model, 'sinopsis'); else echo $boole->label_sinopsis; ?>*</label>
                            <div class="col-sm-10">                
                                <?php echo $form->textArea($model, 'sinopsis', array('rows' => 3, 'cols' => 50, 'size' => 300, 'maxlength' => 300, 'class' => 'form-control', 'id' => 'sinopsis')); ?>
                                <?php echo $form->error($model, 'sinopsis'); ?>
                                <p><i>*Max 300 Characters</i></p>                
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($boole->isi==1){ ?> 
                        <div class="form-group">
                            <label for="isi" class="col-sm-2 control-label"><?php if($boole->label_isi==null || !isset($boole->label_isi)) echo $form->labelEx($model, 'isi'); else echo $boole->label_isi; ?>*</label>
                            <div class="col-sm-10">
                                <?php echo $form->textArea($model, 'isi', array('class' => 'form-control', 'id'=>'isi')); ?>                
                                <?php echo $form->error($model, 'isi'); ?>
                                <p><i>*Text and Image Available</i></p>
                            </div>
                        </div>
                    <?php } else {
                    ?>
                    <input style="display:none;" id="isi">
                    <?php } ?>

                    <?php if($boole->gambar==1){ ?> 
                        <div class="form-group">
                            <label for="gambar" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'gambar'); ?></label>
                            <div class="col-sm-10">
                                <?php
                                $foto = $model->gambar;
                                if($foto!="")
                                { ?>
                                    <img id="gambarKonten" src="<?php echo Yii::app()->createUrl('/Subkategori/displayImage', array('id'=>$model->idcontent)); ?>" />
                                    <div><a style="float:left;" class="btn btn-danger btn-xs" id="hapus_gambar" data-id="<?php echo $model->idcontent; ?>"><i class="fa fa-times-circle"></i> Remove</a></div>
                                <?php }
                                ?>                                                              
                                <?php echo $form->fileField($model, 'gambar', array('class' => 'form-control', 'id'=>'gambar', 'onchange'=>'imageValid(this)')); ?>
                                <?php echo $form->error($model, 'gambar'); ?>
                                <p><i>*Only JPG, PNG, GIF, BMP Allowed (Max Size 5MB)</i></p>           
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($boole->video==1){ ?> 
                        <div class="form-group">
                            <label for="video" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'video'); ?></label>
                            <div class="col-sm-10">
                                <?php
                                $vid = $model->video;
                                if($vid!="")
                                { ?>
                                    <video id="videoKonten" src="<?php echo Yii::app()->createUrl('/Content/displayVideo', array('id'=>$model->idcontent)); ?>" controls /></video>
                                    <div><a style="float:left;" class="btn btn-danger btn-xs" id="hapus_video" data-id="<?php echo $model->idcontent; ?>"><i class="fa fa-times-circle"></i> Remove</a></div>
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
                    <?php } ?>
                    <?php if($boole->slide==1){ ?> 
                        <div class="form-group">
                            <label for="slide" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'slide'); ?></label>
                            <div class="col-sm-10">
                            <?php
                            if ($model->slide=='Y'){                
                                echo $form->checkBox($model, 'slide', array('value'=>'Y', 'uncheckValue'=>'N', 'checked'=>'checked', 'id'=>'slide'));
                            }else{
                                echo $form->checkBox($model, 'slide', array('value'=>'Y', 'uncheckValue'=>'N', 'id'=>'slide'));            
                            }
                            echo $form->error($model, 'slide'); ?>
                            <p><i>*Checked For Slide Image</i></p>
                            </div>
                        </div>
                        <div class="form-group" id="caption">
                            <label for="caption" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'caption'); ?></label>
                            <div class="col-sm-10">                
                                <?php echo $form->textField($model, 'caption', array('class' => 'form-control', 'size' => 100, 'maxlength' => 100, 'id' => 'caption')); ?>
                                <?php echo $form->error($model, 'caption'); ?>
                                <p><i>*Caption On Image Slide</i></p>                
                            </div>
                        </div>
                        <div class="form-group" id="narasi">
                            <label for="narasi" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'narasi'); ?></label>
                            <div class="col-sm-10">                
                                <?php echo $form->textArea($model, 'narasi', array('rows' => 3, 'cols' => 50, 'size' => 300, 'maxlength' => 300, 'class' => 'form-control', 'id' => 'narasi')); ?>
                                <?php echo $form->error($model, 'narasi'); ?>
                                <p><i>*Deskripsi of Caption</i></p>                
                            </div>
                        </div>
                        <?php if($boole->link==1){ ?> 
                            <div class="form-group" id="links">
                                <label for="link" class="col-sm-2 control-label"><?php echo $form->labelEx($model, 'link'); ?></label>
                                <div class="col-sm-10">                
                                <?php
                                if ($model->link=='Y'){                
                                    echo $form->checkBox($model, 'link', array('value'=>'Y', 'uncheckValue'=>'N', 'checked'=>'checked', 'id'=>'link'));
                                }else{
                                    echo $form->checkBox($model, 'link', array('value'=>'Y', 'uncheckValue'=>'N', 'id'=>'link'));            
                                }
                                echo $form->error($model, 'link'); ?>
                                <p><i>*Checked For Link Image</i></p>     
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php 
                        if (!isset($lampiran)) $lampiran=null;
                        $jml = (isset($lampiran) and $lampiran!=null and empty($lampiran))==false? count($lampiran) : 0;
                        $max = 1;
                        $x = 2;
                    ?>
                    <?php if($boole->lampiran==1){ ?>
                        <div class="form-group">         
                            <label for="fax" class="col-sm-2 control-label">FILE (PDF)</label>
                            <div class="col-sm-8">
                            <?php for ($i = 0; $i < $max; $i++) { ?>
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
                            <?php } ?>
                            <a style="float:left;" class="btn btn-primary btn-xs add_lampiran"><i class="fa fa-plus"></i> lampiran</a>
                            <p><i>*Max 3 File</i></p>
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" id="stats" name="tombol">
                    </div><!-- /.box-body -->

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
        $("#caption").hide();
        $("#narasi").hide();
        $("#links").hide();
        if(document.getElementById('isi').style.display != 'none'){
            CKEDITOR.replace( 'isi',
            {
              filebrowserBrowseUrl :'editor/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
              filebrowserImageBrowseUrl : 'editor/ckeditor/filemanager/browser/default/browser.html?Type=Image&amp;Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
              filebrowserFlashBrowseUrl :'editor/ckeditor/filemanager/browser/default/browser.html?Type=Flash&amp;Connector=<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/connector.php',
              filebrowserUploadUrl  :'<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=File',
              filebrowserImageUploadUrl : '<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
              filebrowserFlashUploadUrl : '<?php echo Yii::app()->request->baseUrl; ?>/editor/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
            })
        }
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

$("#slide").click(function(){
    if(document.getElementById("slide").checked == true){
        $("#caption").show();
        $("#narasi").show();
        $("#links").show();
    }
    else if(document.getElementById("slide").checked == false){
        $("#caption").hide();
        $("#narasi").hide();
        $("#links").hide();
    }
});

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
$(document).on('click', '#pilih', function (e) {
                document.getElementById("judul").value = $(this).attr('data-id');
                document.getElementById("nama").value = $(this).attr('data-nama');
                // document.getElementById("unit").value = $(this).attr('data-unit');
                document.getElementById("divisi").value = $(this).attr('data-divisi');
                document.getElementById("posisi").value = $(this).attr('data-posisi');
                $("#myModal").modal('hide');
                // $("[data-dismiss=modal]").trigger({ type: "click" });
            });
</script>