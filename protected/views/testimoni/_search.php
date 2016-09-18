<?php
/* @var $this TestimoniController */
/* @var $model Testimoni */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_testimoni',array()); ?>

                    <?php echo $form->textAreaControlGroup($model,'isi_testimoni',array('rows'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'created_date',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'nik_user',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'video',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'video_name',array('maxlength'=>200)); ?>

                    <?php echo $form->textFieldControlGroup($model,'video_size',array('maxlength'=>20)); ?>

                    <?php echo $form->textFieldControlGroup($model,'video_type',array('maxlength'=>200)); ?>

                    <?php echo $form->textFieldControlGroup($model,'stts_testimoni',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'stts_notif',array()); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->