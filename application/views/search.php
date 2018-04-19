<?php $this->load->view('master'); ?>

<?php $this->load->view('elements/header'); ?>




<section class="vk-content">

    <div class="vk-element alert-box">
        <div class="container">
            <div class="row">
                <div class="vk-flat-alert-box-section vk-section vk-section-distance-top responsive-fix">
                    <div class="col-md-offset-3 col-md-6">
                        <?php foreach ($search as $value) { ?>
                        <div class="vk-wrapper vk-section-distance-top responsive-fix">
                           <h5 class="vk-heading vk-heading-bottom-line">
                               <a href="<?= $langlink.$value->shortcut;?>"><?= $value->title?></a>
                               <span class="vk-line"></span>
                           </h5>
                            <p><?= word_limiter(strip_tags($value->content),20)?> <b><a href="<?= $langlink.$value->shortcut;?>">devamı</a></b></p>
                       </div>
                            
                        <?php }?>
                    </div>
                </div>
                <!-- /.vk-alertbox-outline -->
            </div><!--./row-->
        </div><!--./container-->
    </div><!--./vk-alert-element-->
</section>
<?php $this->load->view('elements/footer'); ?>
<?php $this->load->view('masterdown'); ?>