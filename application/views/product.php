<?php $this->load->view('master'); ?>
<?php $this->load->view('elements/header'); ?>

<section class="vk-content">
    <div class="vk-banner vk-background-image-3">
        <div class="vk-background-overlay vk-background-black _60"></div>
        <div class="container ">
            <div class="vk-banner-wrapper">
                <div class="page-heading">
                    <?= $content->title; ?>
                </div>

                <div class="vk-breadcrumb">
                    <ul class="">
                        <li><a href="<?= $langlink ?>"><?= lang('index') ?></a></li>
                        <li><a href="<?= $langlink ?>/urunlerimiz">Ürünlerimiz</a></li>

                        <li class="active"><?= $content->title; ?></li>
                    </ul>
                </div><!--./vk-breadcrumb-->
            </div> <!--./vk-banner-wrapper-->
        </div>
    </div>

    <div class="vk-page shop">
        <div class="container">
            <div class="row">
                <div class="col-md-9 left-content">
                    <div class="vk-product-show">
                        <div class="vk-slider-shop">
                            <div class="slider-for">
                                <img src="<?= base_url('public/images/content/') . $content->image ?>" alt="" />
                                <?php foreach ($images as $image) { ?>
                                    <img src="<?= base_url('public/upload/images/') . $image->image ?>" alt="" />
                                <?php } ?>
                            </div><!--./slider-for-->

                            <div class="slider-nav">
                                <img src="<?= base_url('public/images/content/') . $content->image ?>" alt="" />
                                <?php foreach ($images as $image) { ?>
                                    <img src="<?= base_url('public/upload/images/') . $image->image ?>" alt="" />
                                <?php } ?>
                            </div><!--./slider-nav-->
                        </div><!--./vk-slider-shop-->

                        <div class="vk-product-info">
                            <h4 class="vk-title"><?= $content->title ?></h4>
                            <div class="vk-intro">
                                <?= $content->content ?>
                            </div> <!--./intro-->


                        </div><!--./vk-product-info-->

                    </div><!--./vk-product-show-->


                    <div class="vk-related-product">
                        <h4 class="vk-heading vk-heading-bottom-line-2 vk-heading-center">
                            Benzer ürünler
                            <span class="vk-line"></span>
                        </h4>
                        <div class="row">
                            <div class="vk-product-list">
                                <?php
                                $similars = $this->Contents->getByParent($this->data['content']->parent_id, 'product');
                                foreach ($similars as $similar) {
                                    ?>
                                    <div class="col-sm-4">
                                        <div class="vk-shop-item">
                                            <div class="vk-img-frame">
                                                <a class="vk-img" href="<?= $similar->shortcut; ?>">
                                                    <img src="<?= base_url('public/images/content/') . getThumb($similar->image, '270x152') ?>" alt="">
                                                </a>
                                            </div><!--./vk-img-frame-->

                                            <div class="vk-brief">
                                                <div class="vk-title"><a href="<?= $similar->shortcut; ?>"><?= $similar->title; ?></a></div>
                                                <div class="vk-divider"></div>
                                            </div>
                                        </div><!--./vk-shop-item-->
                                    </div><!--./col-sm-4-->

                                <?php } ?>
                            </div>
                        </div>
                    </div><!--./vk-related-product-->

                </div><!--./col-md-9-->
                <div class="col-md-3 right-content">
                    <div class="vk-sidebar vk-sidebar-shop">
                        <div class="vk-category vk-box">
                            <h5 class="vk-heading">Kategoriler</h5>
                            <ul class="vk-list-category">
                                <?php
                                $categories = $this->Contents->getByContentType('products_cat');
                                foreach ($categories as $category) {
                                    $total = $this->Contents->total($category->content_id);
                                    ?>
                                    <li><a href="<?= $langlink . $category->shortcut; ?>"><?= $category->title; ?> <span class="cate-count">(<?= $total; ?>)</span></a></li>

                                <?php } ?>
                            </ul>
                        </div><!--./vk-category-->
                    </div><!--./vk-siderbar-->
                </div><!--./col-md-3-->
            </div><!--./row-->
        </div><!--./container-->
    </div><!--./vk-page-->
</section>
<!--./content-->
<?php $this->load->view('elements/footer'); ?>
<?php $this->load->view('masterdown'); ?>