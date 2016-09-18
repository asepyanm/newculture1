<?php
/* @var $this TCommentController */
/* @var $model TComment */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_comment',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'isi_comment',array('maxlength'=>255)); ?>

                    <?php echo $form->textFieldControlGroup($model,'created_date',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'nik_user',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_content',array()); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->