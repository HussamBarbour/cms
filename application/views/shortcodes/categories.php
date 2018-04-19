<div class="container-top"></div>

<section class="page-head">
    <h1>
        <span><?= $content->title; ?></span>
    </h1>
</section>

<div id="main-content">

</div><!-- End Main -->

<!-- Gallery Filter -->
<ul id="filter-by" class="clearfix">

    <li><a href="" data-filter="gallery-item" class="active">All</a></li>
    <?php
    $categories = $this->Contents->getByContentType('product_cat');
    foreach ($categories as $category) {
        ?>
        <li><a href="" data-filter="category-<?= $category->content_id; ?>" title="<?= $category->title; ?>"><?= $category->title; ?></a></li>   
    <?php } ?>
</ul>


<!-- Gallery Container -->
<div id="gallery-container" class="gallery-2-columns isotope clearfix">
    <?php
    $products = $this->Contents->getByContentType('product');
    foreach ($products as $product) {
        ?>
        <div class="gallery-item type-gallery-item status-publish hentry gallery-item isotope-item category-<?= $product->parent_id; ?> ">
            <figure>
                <div class="media_container">
                    <a class="pretty-photo zoom" href="<?= base_url('public/images/content/').$product->image;?>" title="<?= $product->title;?>"></a>
                </div>
                <img class="img-border" src="<?= base_url('public/images/content/').getThumb($product->image, '383x233');?>" alt="<?= $product->title;?>">
            </figure>
            <h5 class="item-title"><a href="" title="<?= $product->title;?>"><?= $product->title;?></a></h5>
        </div>
    <?php } ?>

    

</div>
<!-- end of gallery container -->

<div class="container-bottom"></div>
