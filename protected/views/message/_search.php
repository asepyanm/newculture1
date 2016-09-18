<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'idmessage',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'idcontent',array()); ?>

                    <?php echo $form->textAreaControlGroup($model,'isi',array('rows'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'created_by',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'created_date',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'to',array()); ?>

                    <?php echo $form->textAreaControlGroup($model,'status',array('rows'=>6)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->