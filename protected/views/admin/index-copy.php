<div class="row">
    <?php
    /*$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true,
    ));*/
    $this->widget('application.extensions.PNotify.PNotify',
        array(
            'flash_messages_only' => true,
        )
    );
    ?>
</div>