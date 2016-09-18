<?php
/* @var $this AuthassignmentController */
/* @var $model Authassignment */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'itemname',array('maxlength'=>64)); ?>

                    <?php echo $form->textFieldControlGroup($model,'nik',array()); ?>

                    <?php echo $form->textAreaControlGroup($model,'bizrule',array('rows'=>6)); ?>

                    <?php echo $form->textAreaControlGroup($model,'data',array('rows'=>6)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->