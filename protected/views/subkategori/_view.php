<?php
/* @var $this SubkategoriController */
/* @var $data Subkategori */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('idsubkategori')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idsubkategori),array('view','id'=>$data->idsubkategori)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idkategori')); ?>:</b>
	<?php echo CHtml::encode($data->idkategori); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi); ?>
	<br />


</div>