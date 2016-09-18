<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'idcontent',array()); ?>

            <?php echo $form->textAreaControlGroup($model,'isi',array('rows'=>6)); ?>

            <?php echo $form->textFieldControlGroup($model,'created_by',array()); ?>

            <?php echo $form->textFieldControlGroup($model,'created_date',array()); ?>

            <?php echo $form->textFieldControlGroup($model,'to',array()); ?>

            <?php echo $form->textAreaControlGroup($model,'status',array('rows'=>6)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,		    
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->