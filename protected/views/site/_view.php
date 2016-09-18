<div  class="bg-custom">
<div style="padding:15px;overflow-y:auto;margin:65px 10% 0 15%;">
	<div class="row">
	<div class="col-lg-12">
	    <ol class="breadcrumb">
	        <li><a style="text-decoration:none" href="<?php echo Yii::app()->createUrl("site/index"); ?>">Home</a></li>
	        <li class="active">Search Result</li>
	    </ol>
	</div>
	</div>
	<div class="row">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$model,
			'viewData' => array( 'key' => $key ),
			'itemView'=>'_view_result',
		)); ?>
	</div>
</div>
</div>