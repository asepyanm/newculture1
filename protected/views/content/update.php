<?php
/* @var $this ContentController */
/* @var $model Content */
?>

<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->idcontent=>array('view','id'=>$model->idcontent),
	'Update',
);

?>
<div id="page-wrapper" class="wow animated fadeIn" data-wow-duration="2s">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Content</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

<?php $this->renderPartial('_formupdate', array('model'=>$model,'lampiran'=>$lampiran,'boole'=>$boole,'user'=>$user)); ?>