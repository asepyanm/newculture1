<?php
/* @var $this TCommentController */
/* @var $model TComment */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'tcomment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'isi_comment',array('maxlength'=>255)); ?>

            <?php echo $form->textFieldControlGroup($model,'created_date',array()); ?>

            <?php echo $form->textFieldControlGroup($model,'nik_user',array()); ?>

            <?php echo $form->textFieldControlGroup($model,'id_content',array()); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,		    
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->