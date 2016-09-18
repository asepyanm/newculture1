<style>
	.contact-box {
	    border: medium none;
	    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
	    background-color: #ffffff;
	    margin-bottom: 20px;
	    padding: 20px;
	    /*overflow-y:auto;
	    overflow-x:hidden;*/
	    height:185px;
	}
	.col-md-5{
		width:50%;
	}
	.img-circle{
		max-height:120px;
	}
	mark{
		background-color: yellow;
	}
</style>
<?php
	$crit=new CDbCriteria;
	$crit->select='t.V_NAMA_KARYAWAN,a.updated_date';
	$crit->join='JOIN history_log a ON (a.created_by=t.N_NIK)';
	$crit->condition='a.idcontent= :idcontent';
	$crit->params=array(':idcontent'=>$data->idcontent);
	$modUser = User::model()->find($crit);
?>
<!-- <div class="col-md-3">
	<div class="contact-box same-font">
		<div class="row" style="height:55px;">
			<div class="col-sm-3" style='height:55px;'>
				<?php //echo CHtml::image(Yii::app()->request->baseUrl."/index.php?r=site/gambarContent&id=$data->idcontent", '', array("width"=>"50px")); ?>
			</div>
			<div class="col-sm-9">
				<strong><?php //echo CHtml::encode($data->judul); ?></strong>
			</div>
		</div>
		<div>
			<?php //echo CHtml::encode($data->sinopsis); ?>
		</div>
	</div>
</div> -->
<div class="listJourney">
    <div class="row">
        <div class="col-md-3">
            <div class="bg-galleri" style="background:url(<?php echo Yii::app()->createUrl('/site/gambarContent', array('id'=>$data->idcontent)); ?>) no-repeat center / 100%"></div>
        </div>
        <div class="col-md-9">
            <h4><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("artikel/subactivation",array('id'=>$data->idcontent)); ?>"><?php echo $data->judul; ?></a></h4>
            <div class="ket">
                <ul>
                  <li><i class="fa fa-user"></i> <?php echo $modUser->V_NAMA_KARYAWAN; ?></li>
                  <li><i class="fa fa-calendar"></i> <?php echo date("l jS \of F Y",strtotime($modUser->updated_date)); ?></li>
                  <li><i class="fa fa-clock-o"></i> <?php echo date("H:i:s",strtotime($modUser->updated_date)); ?></li>
                </ul>
            </div>
            <p><?php echo $data->sinopsis; ?>.. <a style="text-decoration:underline;font-weight:bold" href="<?php echo Yii::app()->createUrl("artikel/subactivation",array('id'=>$data->idcontent)); ?>">Read More</a></p>
        </div>
    </div>
</div>