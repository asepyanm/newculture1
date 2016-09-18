<!-- Modal -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'content-form',
    // 'action'=>Yii::app()->createUrl('Content/deletes'),
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'enctype'=>'multipart/form-data'
    ),
  ));
?>
<?php echo $form->errorSummary($model); ?> 
  <div id="modal_alasan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Keterangan Penolakan</h4>
        </div>
        <div class="modal-body">
          <label>REJECT OLEH</label>
          <?php echo $form->textField($model,'rejectoleh',array('class' => 'form-control', 'id' => 'rejectoleh', 'readonly'=>'readonly')); ?>
          <br>
          <label>ALASAN</label>
          <?php echo $form->textArea($model,'alasan',array('rows' => 5, 'cols' => 50,'class' => 'form-control','maxlength'=>255, 'id' => 'alasan', 'readonly'=>'readonly')); ?>
          <input type="hidden" id="ids" name="ids" value="">
        </div>
        
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
  </div>
<?php $this->endWidget(); ?>