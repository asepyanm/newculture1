<?php
/* @var $this SubkategoriController */
/* @var $model Subkategori */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'idsubkategori',array('maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'idkategori',array('maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'nama',array('maxlength'=>50)); ?>

                    <?php echo $form->textFieldControlGroup($model,'deskripsi',array('maxlength'=>300)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->