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
                <span class="property__english_title"><span class="item-grid__start-from"><?= getMeta($content->content_id, 'english_name') ?></span></span>

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
                <div class="col-md-6"><div class="top-text"><?= lang('stage') ?> : <?= getMeta($content->content_id, 'stage', $lang) ?></div></div>
                <div class="col-md-6"><div class="top-text"><?= lang('type_apartment') ?> : <?= getMeta($content->content_id, 'type_apartment', $lang) ?></div></div>
            </div>
            <div class="row">
                <div class="col-md-6"><div class="top-text"><?= lang('delivery_date') ?> : <?= getMeta($content->content_id, 'delivery_date') ?></div></div>
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
                        <li class="image-navigation__next">
                            <span class="ion-ios-arrow-right"></span>
                        </li>
                        <li class="image-navigation__prev">
                            <span class="ion-ios-arrow-left"></span>
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
                <aside class="col-md-3">
                    <div class="widget__container">
                        <section class="widget">
                            <form class="contact-form contact-form--white">
                                <div class="contact-form__header">
                                    <div class="contact-form__header-container">
                                        <img src="<?= base_url('public/style/') ?>images/pamosidebar.png" alt="Pamo" />
                                    </div><!-- .contact-form__header-container -->
                                </div><!-- .contact-form__header -->

                                <div class="contact-form__body">
                                    <input type="text" class="contact-form__field" placeholder="<?= lang('name') ?>" name="name" required />
                                    <input type="email" class="contact-form__field" placeholder="<?= lang('email') ?>" name="email" required />
                                    <input type="tel" class="contact-form__field" placeholder="<?= lang('phone') ?>" name="phone number" />
                                    <textarea class="contact-form__field contact-form__comment" cols="30" rows="5" placeholder="<?= lang('message') ?>" name="comment" required></textarea>
                                </div><!-- .contact-form__body -->
                                <div class="contact-form__footer">
                                    <input type="submit" class="contact-form__submit" name="submit" value="<?= lang('send_message') ?>">
                                </div><!-- .contact-form__footer -->
                            </form><!-- .contact-form -->
                        </section><!-- .widget -->

                        <section class="widget widget--white widget--padding-20">

                            <div class="contact-form__header-container">
                                <img src="<?= base_url('public/style/') ?>images/similar_projects.png" alt="Pamo" />
                            </div>
                            <div class="clearfix"></div>
                            <?php
                            $similars = $this->Contents->getByContentType('projects', 4);
                            foreach ($similars as $key => $similar) {
                                if ($similar->content_id == $content->content_id || $key == 3) {
                                    continue;
                                }
                                ?>
                                <div class="similar-home">
                                    <a href="<?= $langlink . $similar->shortcut; ?>">
                                        <div class="similar-home__image">
                                            <div class="similar-home__overlay"></div><!-- .similar-home__overlay -->
                                            <img src="<?= base_url('public') ?>/images/content/<?= $similar->image ?>" alt="<?= $similar->title ?>">
                                        </div><!-- .similar-home__image -->
                                        <div class="similar-home__content">
                                            <h3 class="similar-home__title"><?= $similar->title ?></h3>
                                            <span class="similar-home__price"><?= sprintf(lang('price_start_turkish_lire'), number_format(getMeta($similar->content_id, 'price_start'))) ?></span>
                                        </div><!-- .similar-home__content -->
                                    </a>
                                </div><!-- .similar-home -->
                                <?php
                            }
                            ?>
                        </section><!-- .widget -->
                    </div><!-- .widget__container -->
                </aside>
                <main class="col-md-9">
                    <div class="property__feature-container">
                        <?php
                        $get_top_lines = getMeta($content->content_id, 'top_lines', $lang);
                        $top_lines = explode(',', $get_top_lines);
                        if ($get_top_lines != '') {
                            ?>
                            <div class="property__feature" style=" background: #ccc; ">
                                <ul class="property__top-lines">
                                    <?php
                                    foreach ($top_lines as $top_line) {
                                        ?>
                                        <li><span><?= $top_line; ?></span></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div><!-- .property__feature -->
                            <?php
                        }
                        ?>
                        <div class="property__feature">
                            <h3 class="property__feature-title property__feature-title--b-spacing">شرح عن المشروع</h3>
                            <?= $content->content; ?>
                        </div><!-- .property__feature -->

                        <div class="property__feature">
                            <div class="property__top-lines">
                                <li><span>الموقع على الخريطة</span></li>
                                <div id="submit-property-map" data-latitude="41.033143" data-longitude="28.661007"></div>
                            </div>
                            <div class="row">
                                <?php
                                if (getMeta($content->content_id, 'taksim_away', $lang) != '') {
                                    ?>
                                    <div class="away-from">
                                        <div class="away-from-title">ميدان تقسيم</div>
                                        <img src="<?= base_url('public/style/images/away/taksim_away.png') ?>" />
                                        <div class="away-from-text"><?= getMeta($content->content_id, 'taksim_away', $lang) ?></div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if (getMeta($content->content_id, 'ataturk_airport_away', $lang) != '') {
                                    ?>
                                    <div class="away-from">
                                        <div class="away-from-title">مطار أتاتورك الدولي</div>
                                        <img src="<?= base_url('public/style/images/away/ataturk_airport_away.png') ?>" />
                                        <div class="away-from-text"><?= getMeta($content->content_id, 'ataturk_airport_away', $lang) ?></div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if (getMeta($content->content_id, 'tem_away', $lang) != '') {
                                    ?>
                                    <div class="away-from">
                                        <div class="away-from-title">خط اتوستراد TEM</div>
                                        <img src="<?= base_url('public/style/images/away/tem_away.png') ?>" />
                                        <div class="away-from-text"><?= getMeta($content->content_id, 'tem_away', $lang) ?></div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if (getMeta($content->content_id, 'metro_away', $lang) != '') {
                                    ?>
                                    <div class="away-from">
                                        <div class="away-from-title">مترو الأنفاق الجديد</div>
                                        <img src="<?= base_url('public/style/images/away/metro_away.png') ?>" />
                                        <div class="away-from-text"><?= getMeta($content->content_id, 'metro_away', $lang) ?></div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div><!-- .property__feature -->
                        <?php
                        if (getMeta($content->content_id, 'metro_away', $lang) != '') {
                            ?>
                            <div class="property__feature advantages">
                                <h3 class="property__feature-title property__feature-title--b-spacing"></h3>
                                <?= getMeta($content->content_id, 'advantages', $lang); ?>
                            </div><!-- .property__feature -->
                            <?php
                        }
                        ?>
                        <?php
                        if (getMeta($content->content_id, 'facilities', $lang) != '') {
                            ?>
                            <div class="property__feature">
                                <h3 class="property__feature-title property__feature-title--b-spacing">المرفقات</h3>
                                <ul class="property__features-list">
                                    <?php
                                    $facilities = explode(',', getMeta($content->content_id, 'facilities', $lang));
                                    foreach ($facilities as $key => $facilitie) {
                                        ?>
                                        <li class="property__features-item"><span class="property__features-icon ion-checkmark-round"></span><?= $facilitie; ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul><!-- .property__features-list -->
                            </div>
                            <?php
                        }
                        ?>
                        <div class="property__feature">
                            <h3 class="property__feature-title property__feature-title--b-spacing">مخططات الشقق</h3>
                            <?php
                            $floors = $this->Contents->getByContentParentType('floors',$content->content_id);
                            foreach ($floors as $key=>$floor) {
                            ?>
                            <div class="property__accordion">
                                <div class="property__accordion-header">
                                    <div class="property__accordion-textcontent">
                                        <span class="property__accordion-title"><?= $floor->title?></span>
                                        <ul class="property__accordion-stats">
                                            <li class="property__accordion-figure"><span class="property__accordion-figure--cat">المساحة الإجمالية:</span> <?= getMeta($floor->content_id, 'total_area');?></li>
                                            <li class="property__accordion-figure"><span class="property__accordion-figure--cat">المساحة الصافية:</span> <?= getMeta($floor->content_id, 'net_area');?></li>
                                            <li class="property__accordion-figure"><span class="property__accordion-figure--cat">مطبخ:</span> <?= getMeta($floor->content_id, 'kitchen',$lang);?></li>
                                            <li class="property__accordion-figure"><span class="property__accordion-figure--cat">حمام:</span> <?= getMeta($floor->content_id, 'bathroom');?></li>
                                        </ul><!-- .property__accordion-stats -->
                                    </div><!-- .property__accordion-textcontent -->
                                    <i class="fa fa-caret-up property__accordion-expand" aria-hidden="true"></i> 
                                </div><!-- .property__accordion-header -->

                                <div class="property__accordion-content <?= $key == 0 ? 'property__accordion-content--active' : ''?>">
                                    <img src="<?= base_url('public') ?>/images/content/<?= $floor->image ?>" alt="<?= $floor->title?>" />
                                </div><!-- .property__accordion-content -->
                            </div><!-- .property__accordion -->
                            
                            <?php
                            }
                            ?>
                        </div><!-- .property__feature -->


                        <div class="property__feature">
                            <h3 class="property__feature-title property__feature-title--b-spacing"></h3>
                            <form class="property__form">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" name="name" class="property__form-field" placeholder="<?= lang('name');?>" required>
                                    </div><!-- col -->
                                    <div class="col-sm-6">
                                        <input type="email" name="contact" class="property__form-field" placeholder="<?= lang('email');?>" required>
                                    </div><!-- col -->
                                    <div class="col-sm-12">
                                        <input type="text" name="contact" class="property__form-field" placeholder="<?= lang('phone');?>" required>
                                    </div><!-- col -->
                                    <div class="col-sm-12">
                                        <textarea rows="4" name="message" class="property__form-field" placeholder="<?= lang('message');?>" required></textarea>
                                    </div><!-- col -->
                                    <div class="col-sm-12">
                                        <input name="submit" type="submit" class="property__form-submit" value="<?= lang('send');?>"></input>
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </form>
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