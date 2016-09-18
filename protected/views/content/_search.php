<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'idcontent',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'idsubkategori',array('maxlength'=>10)); ?>

                    <?php echo $form->textFieldControlGroup($model,'judul',array('maxlength'=>100)); ?>

                    <?php echo $form->textFieldControlGroup($model,'sinopsis',array('maxlength'=>300)); ?>

                    <?php echo $form->textFieldControlGroup($model,'isi',array('maxlength'=>4000)); ?>

                    <?php echo $form->textFieldControlGroup($model,'file',array('maxlength'=>1500)); ?>

                    <?php echo $form->textFieldControlGroup($model,'video',array('maxlength'=>1500)); ?>

                    <?php echo $form->textFieldControlGroup($model,'gambar',array('maxlength'=>1500)); ?>

                    <?php echo $form->textFieldControlGroup($model,'idstatus',array('maxlength'=>11)); ?>

                    <?php echo $form->textFieldControlGroup($model,'slide',array('maxlength'=>1)); ?>

                    <?php echo $form->textFieldControlGroup($model,'link',array('maxlength'=>1)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->