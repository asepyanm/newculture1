<?php foreach ($expgbr as $value) {
?>
<h3><?php echo $value['judul']; ?></h3>
<div class="row">
	<div class="col-md-12">
		<img class="img-wrap-revox" src="<?php echo Yii::app()->createUrl('/Content/displayImage', array('id'=>$value['idcontent'])); ?>" alt="">
		<p><?php $isi = (strlen($value['isi']) > 300) ? substr($value['isi'],0,strrpos(substr( $value['isi'],0,330),' ')) : $value['isi'];
        echo $isi; ?><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("Artikel/Expert",array('id'=>$value['idcontent'])); ?>"> Read More</a></p>
    </div>
</div>
<?php } ?>