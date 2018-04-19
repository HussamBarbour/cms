
<section class="item-grid">
    <div class="container">
        <div class="row">
            <?php
            $projects = $this->Contents->getByContentType('projects');
            foreach ($projects as $project) {
                $parent_projects = $this->Contents->getById($project->parent_id);
                ?>
                <div class="col-md-6 item-grid__container">
                    <div class="listing">
                        <div class="item-grid__image-container">
                            <a href="<?= $langlink . $project->shortcut; ?>">
                                <div class="item-grid__image-overlay"></div><!-- .item-grid__image-overlay -->
                                <img src="<?= base_url('public') ?>/images/content/<?= $project->image ?>" alt="<?= $project->title ?>" class="listing__img" />

                                <span class="item-grid__start-from-bg"><span class="item-grid__start-from"><?= sprintf(lang('price_start_turkish_lire'), number_format(getMeta($project->content_id, 'price_start'))) ?></span></span>
                            </a>
                        </div><!-- .item-grid__image-container -->

                        <div class="item-grid__content-container">
                            <div class="listing__content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6 listing__header-primary">
                                            <h3 class="listing__title"><a href="<?= $langlink . $project->shortcut; ?>"><?= $project->title ?></a></h3>
                                        </div><!-- .listing__header-primary -->
                                        <div class="col-md-6 delivery-date">
                                            <?= lang('delivery_date') ?> : <?= getMeta($project->content_id, 'delivery_date') ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <p class="listing__location"><span class="ion-ios-location-outline listing__location-icon"></span> <?= isset($parent_projects->title) ? $parent_projects->title : ''; ?></p>
                                        </div><!-- .listing__details -->
                                        <div class="col-md-12 type-apartment">
                                            <a href="<?= $langlink . $project->shortcut; ?>" class="listing__btn">المزيد </a>
                                            <p><?= getMeta($project->content_id, 'type_apartment', $lang) ?></p>
                                        </div>


                                    </div>
                                </div>

                            </div><!-- .listing-content -->
                        </div><!-- .item-grid__content-container -->
                    </div><!-- .listing -->
                </div><!-- .col -->

            <?php } ?>
        </div><!-- .row -->
    </div><!-- .container -->
</section><!-- .item-grid-2 -->