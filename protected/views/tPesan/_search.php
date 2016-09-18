<?php
/* @var $this TPesanController */
/* @var $model TPesan */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'idpesan',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'nama',array('maxlength'=>100)); ?>

                    <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>100)); ?>

                    <?php echo $form->textFieldControlGroup($model,'hp',array('maxlength'=>20)); ?>

                    <?php echo $form->textFieldControlGroup($model,'isipesan',array('maxlength'=>255)); ?>

                    <?php echo $form->textFieldControlGroup($model,'stts_pesan',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'created_date',array()); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->