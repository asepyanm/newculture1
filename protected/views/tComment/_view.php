<?php
/* @var $this TCommentController */
/* @var $data TComment */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id_comment')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_comment),array('view','id'=>$data->id_comment)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isi_comment')); ?>:</b>
	<?php echo CHtml::encode($data->isi_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nik_user')); ?>:</b>
	<?php echo CHtml::encode($data->nik_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_content')); ?>:</b>
	<?php echo CHtml::encode($data->id_content); ?>
	<br />


</div>