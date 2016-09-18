<?php
/* @var $this MessageController */
/* @var $data Message */
?>
<style type="text/css">
	/* LEFT */
.callouts--left:before {
	content: "";
	position: absolute;
	width: 0;
	height: 0;
	left: -42px;
	top: 17px;
  border: 10px solid transparent;
  border-right: 32px solid rgb(193,193,193); /* IE8 Fallback */
  border-right: 32px solid rgba(193,193,193,0.5);
  z-index: 2;
}
.callouts--left:after {
  content: "";
	position: absolute;
	width: 0;
	height: 0;
	left: -31px;
	top: 20px;
  border: 8px solid transparent;
  border-right: 24px solid #fff;
  z-index: 3;
}
/* RIGHT */
.callouts--right:before {
	content: "";
	position: absolute;
	width: 0;
	height: 0;
	right: -42px;
	top: 17px;
  border: 10px solid transparent;
  border-left: 32px solid rgb(193,193,193); /* IE8 Fallback */
  border-left: 32px solid rgba(193,193,193,0.5);
  z-index: 2;
}
.callouts--right:after {
  content: "";
	position: absolute;
	width: 0;
	height: 0;
	right: -31px;
	top: 20px;
  border: 8px solid transparent;
  border-left: 24px solid #fff;
  z-index: 3;
}
.callouts {
  display: inline-block;
  /* Real styles */
  position: relative;
	width: 90%;
  padding: 10px;
	background-color: #fff;
  border: 1px solid #c1c1c1;
	border-radius: 4px;
	box-shadow: 0 0 10px #c1c1c1;
}

</style>

<div class="view">
	<div class="row">
		<!-- <div class="col-lg-6">
			
		</div> -->
		<div class="<?php if(CHtml::encode($data->created_by)==Yii::app()->user->id) echo 'col-lg-offset-6 ';?>col-lg-6">
			<div class="content">
				<div class="row">
					<?php if(CHtml::encode($data->created_by)!=Yii::app()->user->id){?>
					<div class="col-lg-3">
						<div style="text-align:right;border-radius: 50%;width:70px;height:70px;background: url(http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik=<?php echo CHtml::encode($data->created_by); ?>) no-repeat top center / cover;"></div>
					</div>
					<?php } ?>
					<div class="col-lg-9">
						<div class="callouts <?php if(CHtml::encode($data->created_by)==Yii::app()->user->id) echo 'callouts--right'; else echo 'callouts--left';?>">
							
							<b><?php echo CHtml::encode(User::model()->findByAttributes(array('N_NIK'=>$data->created_by))->V_NAMA_KARYAWAN.' / '.$data->created_by); ?></b>
							<hr style="margin:2px;" />

							<i class="fa fa-commenting"></i>
							<?php echo CHtml::encode($data->isi); ?>
								
							<br />

							<hr style="margin:2px;" />
							<i class="fa fa-calendar"></i>
							<small><i><?php echo date('d-M-y H:i',strtotime(CHtml::encode($data->created_date))); ?></i></small>
							<br />

						
						</div>

						
					</div>
					<?php if(CHtml::encode($data->created_by)==Yii::app()->user->id){?>
					<div class="col-lg-3">
						<div style="margin-right:10px;border-radius: 50%;width:70px;height:70px;background: url(http://pwb-esshr.aon.telkom.co.id/index.php?r=pwbPhoto/profilePhoto&nik=<?php echo CHtml::encode($data->created_by); ?>) no-repeat top center / cover;"></div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<br/>
