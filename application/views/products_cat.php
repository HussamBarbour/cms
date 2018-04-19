<?php $this->load->view('master'); ?>
<?php $this->load->view('elements/header'); ?>
<section class="vk-content">
    <div class="vk-home dark">
        <div class="vk-banner vk-background-image-3">
            <div class="vk-background-overlay vk-background-black _50"></div>
            <div class="container ">
                <div class="vk-banner-wrapper">
                    <div class="page-heading">
                        <?= $content->title; ?>
                    </div>

                </div> <!--./vk-banner-wrapper-->
            </div>
        </div>
        <!--./vk-banner-->

        <div class="vk-page shop">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 left-content">
                        <div class="vk-product-show">
                            <div class="row">
                                <div class="vk-product-list">
                                    <?php foreach ($subs as $sub) { ?>
                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                        <div class="col-sm-4">
                                            <div class="vk-shop-item">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?= $langlink . $sub->shortcut; ?>">
                                                        <img src="<?= base_url('public/images/content/') . getThumb($sub->image, '270x200') ?>" alt="">
                                                    </a>
                                                </div><!--./vk-img-frame-->

                                                <div class="vk-brief">
                                                    <div class="vk-title"><a href="<?= $langlink . $sub->shortcut; ?>"><?= $sub->title ?></a></div>
                                                    <div class="vk-divider"></div>
                                                </div>
                                            </div><!--./vk-shop-item-->
                                        </div><!--./col-sm-4-->

                                    <?php } ?>
                                </div><!--./vk-product-list-->
                            </div><!--./row-->
                        </div><!--./vk-product-show-->
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
    </div>
</section>
<!--./content-->

<?php $this->load->view('elements/footer'); ?>
<?php $this->load->view('masterdown'); ?>

</body>
</html>