<?php
/* @var $this TestimoniController */
/* @var $data Testimoni */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id_testimoni')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_testimoni),array('view','id'=>$data->id_testimoni)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isi_testimoni')); ?>:</b>
	<?php echo CHtml::encode($data->isi_testimoni); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nik_user')); ?>:</b>
	<?php echo CHtml::encode($data->nik_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video')); ?>:</b>
	<?php echo CHtml::encode($data->video); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video_name')); ?>:</b>
	<?php echo CHtml::encode($data->video_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video_size')); ?>:</b>
	<?php echo CHtml::encode($data->video_size); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('video_type')); ?>:</b>
	<?php echo CHtml::encode($data->video_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stts_testimoni')); ?>:</b>
	<?php echo CHtml::encode($data->stts_testimoni); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stts_notif')); ?>:</b>
	<?php echo CHtml::encode($data->stts_notif); ?>
	<br />

	*/ ?>

</div>