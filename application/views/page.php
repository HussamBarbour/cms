<?php $this->load->view('master'); ?>
<?php $this->load->view('elements/header'); ?>



<section class="vk-content">
    <div class="vk-home dark">
        
    <div class="vk-banner dark vk-background-image-3">
        <div class="vk-background-overlay vk-background-black _60"></div>
        <div class="container ">
            <div class="vk-banner-wrapper">
                <div class="page-heading">
                    <?= $content->title; ?>
                </div>

            </div> <!--./vk-banner-wrapper-->
        </div>
    </div>
    <!--./vk-banner-->

    <div class="vk-page page page-about">

        <div class="vk-funimal-welcome vk-section-distance-bottom">
            <div class="container">
                <div class="vk-grid-style-item even responsive-fix ">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 vk-content-right">
                            <div class="vk-inner-wrapper">
                                <div class="content">
                                    <?php $this->load->view('elements/content'); ?>
                                </div>
                            </div><!--./inner-wrapper-->
                        </div><!--./col-md-7-->

                    </div><!--./row-->
                </div><!--./vk-grid-style-->
            </div><!--./container-->
        </div><!--./vk-funimal-welcome-->
    </div><!--./vk-page-->
        </div>

</section>
<!--./content-->
<?php $this->load->view('elements/footer'); ?>
<?php $this->load->view('masterdown'); ?>

</body>
</html>