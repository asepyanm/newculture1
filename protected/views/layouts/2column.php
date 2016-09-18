<?php $this->beginContent('//layouts/main'); ?>

<div id="cover"></div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'brandLabel' => 'Personal Workbook',
            'collapse' => true,
            //'userPhoto' => Yii::app()->photo->getPhoto(Yii::app()->user->id),
            'userPhoto' => Yii::app()->createUrl('pwbPhoto/profilePhoto', array('nik'=>Yii::app()->user->id)),
            'display' => null, // default is static to top
            //'htmlOptions' => array('style'=>'border-bottom: 3px solid #E42313'),
            'items' => array(
                /*array(
                    'class' => 'bootstrap.widgets.TbNav',
                    'items' => array(
                        array('label' => 'Home', 'icon' => TbHtml::icon(TbHtml::ICON_TH), 'url' => array('home/index')),
                    ),
                ),*/
                array(
                    'class' => 'bootstrap.widgets.TbNav',
                    'htmlOptions'=>array('class'=>'navbar-right'),
                    'items' => array(
                        array('label' => Yii::app()->user->id,
                            //'photo' => Yii::app()->photo->getPhoto(Yii::app()->user->id),
                            'photo' => Yii::app()->createUrl('pwbPhoto/profilePhoto', array('nik'=>Yii::app()->user->id)),
                            'visible' => !Yii::app()->user->isGuest,
                            'items' => array(
                                array('label' => 'Setting', 'icon'=>TbHtml::icon(TbHtml::ICON_PENCIL), 'url' => '#'),
                                TbHtml::menuDivider(),
                                array('label' => 'Logout', 'icon'=>TbHtml::icon(TbHtml::ICON_LOG_OUT), 'url' => array('site/logout')),
                            )
                        ),
                    ),
                ),
                $this->menuNavBar,
            ),
        )); ?>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="row row-offcanvas row-offcanvas-left">
    <div class="col-md-2">
        <div id="menuLeft" class="sidebar-offcanvas">
            <?php
            $this->widget('bootstrap.widgets.TbNav', array(
                'type' => TbHtml::NAV_TYPE_PILLS,
                'stacked' => true,
                'items' => $this->menuLeft
            ));
            ?>
        </div>
    </div><!--/row-->
    <div class="col-md-8">
        <div class="row-fluid">
            <p class="pull-left visible-xs">
                <?php echo TbHtml::button('Menu', array('icon' => TbHtml::ICON_TH_LIST, 'color' => TbHtml::BUTTON_COLOR_INVERSE, 'data-toggle'=>'offcanvas')); ?>
            </p>
        </div>

        <div class="clear"></div>

        <div class="row-fluid">
            <div class="col-md-12">
                <?php echo $content; ?>
            </div>
        </div>

        <div class="clear"></div>

        <div class="row-fluid">
            <div id="footer">
                Copyright © 2015 - PT. Telekomunikasi Indonesia, Tbk.
                &nbsp;&nbsp; Designed & Developed by : <strong class="orange">Orange Corner</strong> - ISC & HCC
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<?php $this->endContent(); ?>