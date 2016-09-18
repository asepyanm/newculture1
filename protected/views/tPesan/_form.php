<?php
/* @var $this TPesanController */
/* @var $model TPesan */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'tpesan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'idpesan',array()); ?>

            <?php echo $form->textFieldControlGroup($model,'nama',array('maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'hp',array('maxlength'=>20)); ?>

            <?php echo $form->textFieldControlGroup($model,'isipesan',array('maxlength'=>255)); ?>

            <?php echo $form->textFieldControlGroup($model,'stts_pesan',array()); ?>

            <?php echo $form->textFieldControlGroup($model,'created_date',array()); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,		    
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->