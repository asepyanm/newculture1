<?php
/* @var $this ContentController */
/* @var $data Content */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('idcontent')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcontent),array('view','id'=>$data->idcontent)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idsubkategori')); ?>:</b>
	<?php echo CHtml::encode($data->idsubkategori); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judul')); ?>:</b>
	<?php echo CHtml::encode($data->judul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sinopsis')); ?>:</b>
	<?php echo CHtml::encode($data->sinopsis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isi')); ?>:</b>
	<?php echo CHtml::encode($data->isi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file')); ?>:</b>
	<?php echo CHtml::encode($data->file); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video')); ?>:</b>
	<?php echo CHtml::encode($data->video); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gambar')); ?>:</b>
	<?php echo CHtml::encode($data->gambar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idstatus')); ?>:</b>
	<?php echo CHtml::encode($data->idstatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slide')); ?>:</b>
	<?php echo CHtml::encode($data->slide); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	*/ ?>

</div>