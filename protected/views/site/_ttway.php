<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jQuery-2.1.4.min.js"></script>
<?php
    /* @var $this SiteController */
    $this->pageTitle=Yii::app()->name;
?>

<section id="ttway" class="bg-custom">
    <div class="container">
    <?php
    if(isset($isittway)){
    ?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-heading wow animated bounceIn"><?php echo $isittway->nama; ?></h2>
            <hr style="width:50%;height:2px;background-color:#000;color:#000;">
            <h4 class="section-subheading text-muted">&nbsp;</h4>
        </div>
        <?php
        }
        ?>
    </div>
		<!-- /.row -->
		
		<div class="row">
          <div class="col-sm-4 col-sm-offset-1">
              
                      <img class="listx" style="max-width:100%; vertical-align:top;" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ttw_overview.PNG" />

                  
          </div>
          <div class="col-sm-5 " style="margin-top:5%;">
              
                  <p style="text-align: left;font-size:18px; font-weight: bold;">The Telkom Way itu</p>
                  <p style="text-align: left;text-justify: inter-word; font-size:18px;">Keyakinan melakukan yang terbaik, yang didasari integritas, antusias dan totalitas dengan nilai-nilai Solid, Speed, Smart serta diimplementasikan melalui perilaku Imajinasi, Fokus dan Action untuk memberikan yang terbaik.</p>
                  <a class="btn btn-lg btn-primary" href="<?php echo Yii::app()->createUrl("sub/ttway",array('id'=>2)); ?>"><i class="fa fa-arrow-right"></i> See more</a>
          </div>
    </div>
    <br/>
      <div class="row">
                
            </div>
    <br>
	</div>
</section>

