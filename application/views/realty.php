<?php $this->load->view('master'); ?>
<?php $this->load->view('elements/header'); ?>

<section class="property">
    <div class="property__header">
        <div class="container">
            <div class="property__header-container">
                <ul class="property__main">
                    <li class="property__title property__main-item">
                        <h2 class="property__name"><?= $content->title; ?></h2>
                    </li>
                </ul><!-- .property__main -->
            </div><!-- .property__header-container -->
        </div><!-- .container -->
    </div><!-- .property__header -->
    <div class="property__container property__top">
        <div class="container">
            <div class="row">
                <div class="col-md-6"><div class="top-text"><?= lang('region') ?> : <?= getMeta($content->content_id, 'region', $lang) ?></div></div>
                <div class="col-md-6"><div class="top-text"><?= lang('area') ?> : <?= getMeta($content->content_id, 'area') ?> متر مربع</div></div>
            </div>
            <div class="row">
                <div class="col-md-6"><div class="top-text"><?= lang('bathroom_number') ?> : <?= getMeta($content->content_id, 'bathroom') ?></div></div>
                <div class="col-md-6"><div class="top-text"><?= lang('room_number') ?> : <?= getMeta($content->content_id, 'room_number') ?></div></div>
            </div>
        </div>
    </div>
    <div class="property__slider">
        <div class="container">
            <div class="property__slider-container property__slider-container--vertical">
                <ul class="property__slider-nav property__slider-nav--vertical">
                    <?php
                    foreach ($images as $key => $image) {
                        ?>
                        <li class="property__slider-item">
                            <img src="<?= base_url('public/upload/images/' . getThumb($image->image, 'thumb')) ?>" alt="" />
                        </li>
                        <?php
                    }
                    ?>
                </ul><!-- .property__slider-nav -->

                <div class="property__slider-main property__slider-main--vertical">
                    <div class="property__slider-images">
                        <?php
                        foreach ($images as $key => $image) {
                            ?>
                            <li class="property__slider-image">
                                <img src="<?= base_url('public/upload/images/' . $image->image) ?>" alt="" />
                            </li>
                            <?php
                        }
                        ?>
                    </div><!-- .property__slider-images -->

                    <ul class="image-navigation">
                        <li class="image-navigation__prev">
                            <span class="ion-ios-arrow-left"></span>
                        </li>
                        <li class="image-navigation__next">
                            <span class="ion-ios-arrow-right"></span>
                        </li>
                    </ul>

                    <span class="property__slider-info"><i class="ion-android-camera"></i><span class="sliderInfo"></span></span>
                </div><!-- .property__slider-main -->
            </div><!-- .property__slider-container -->
        </div><!-- .container -->
    </div><!-- .property__slider -->

    <div class="property__container">
        <div class="container">
            <div class="row">


                <main class="col-md-12">
                    <div class="property__feature-container">

                        <div class="property__feature">
                            <?= $content->content;?>
                        </div><!-- .property__feature -->
                    </div><!-- .property__feature -->


            </div><!-- .property__feature-container -->
            </main>
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .property__container -->
</section><!-- .property -->

<?php $this->load->view('elements/footer'); ?>

<?php $this->load->view('masterdown'); ?>
</body>
</html>