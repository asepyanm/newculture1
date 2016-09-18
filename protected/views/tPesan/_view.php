<?php
/* @var $this TPesanController */
/* @var $data TPesan */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('idpesan')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idpesan),array('view','id'=>$data->idpesan)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hp')); ?>:</b>
	<?php echo CHtml::encode($data->hp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isipesan')); ?>:</b>
	<?php echo CHtml::encode($data->isipesan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stts_pesan')); ?>:</b>
	<?php echo CHtml::encode($data->stts_pesan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />


</div>