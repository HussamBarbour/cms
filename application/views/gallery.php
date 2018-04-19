<?php $this->load->view('master'); ?>
<?php $this->load->view('elements/header'); ?>
<section class="page-title">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
                <h1><?= $content->title ?></h1>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right path">
                <a href="<?= $langlink . $content->shortcut ?>">Anasayfa</a>&ensp;/&ensp;<a href="#"><?= $content->title ?></a>
            </div>
            <div class="overlay"></div>
        </div>
    </div>
</section>
<!--Page Title Ends-->

<!--Start know about area-->  
<section class="our-gallery">
    <div class="container">
        <div class="row">
            <?php
            foreach ($images as $image) {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-item">
                    <div class="img-holder">							
                        <img src="<?= base_url()?>public/upload/images/<?= $image->image?>" alt="<?= $image->title?>"/>
                        <div class="overlay">
                            <div class="inner">
                                <div class="social">
                                    <a href="<?= base_url()?>public/upload/images/<?= $image->image?>" data-fancybox-group="example-gallery" class="view lightbox-image"><i class="flaticon-add"></i></a>	
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            }
            ?>
        </div>					
    </div>
</section>

<?php $this->load->view('elements/footer'); ?>
<?php $this->load->view('masterdown'); ?>

</body>
</html>