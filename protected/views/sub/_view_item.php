<div class="listJourney">
    <div class="row">
        <div class="col-md-3">
            <div class="bg-galleri" style="background:url(<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$data['idcontent'])); ?>) no-repeat center / 100%"></div>
        </div>
        <div class="col-md-9">
            <h4><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("artikel/subactivation",array('id'=>$data['idcontent'])); ?>"><?php echo $data['judul']; ?></a></h4>
            <div class="ket">
                <ul>
                  <li><i class="fa fa-user"></i> <?php echo $data['V_NAMA_KARYAWAN']; ?></li>
                  <li><i class="fa fa-calendar"></i> <?php echo date("l jS \of F Y",strtotime($data['updated_date'])); ?></li>
                  <li><i class="fa fa-clock-o"></i> <?php echo date("H:i:s",strtotime($data['updated_date'])); ?></li>
                </ul>
            </div>
            <p><?php echo $data['sinopsis']; ?>.. <a style="text-decoration:underline;font-weight:bold" href="<?php echo Yii::app()->createUrl("artikel/subactivation",array('id'=>$data['idcontent'])); ?>">Read More</a></p>
        </div>
    </div>
</div>