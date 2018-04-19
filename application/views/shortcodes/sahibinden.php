<div class="row">
    <div class="col-md-12">
        <main class="main-content">
            <?php
            $this->load->helper('dom_html');
            $html = file_get_html('https://cakiroglu.sahibinden.com/vasita?sorting=storeShowcase');
            $html2 = file_get_html('https://cakiroglu.sahibinden.com/vasita?pagingOffset=20&sorting=storeShowcase&userId=1547501');
            $table = $html->find('div[class=classified-list]', 0)->children(0);
            $table2 = $html2->find('div[class=classified-list]', 0)->children(0);
            $trs1 = $table->find('tr');
            $trs2 = $table2->find('tr');
            $trs = array_merge($trs1, $trs2);
            foreach ($trs as $key => $tr) {
                if ($tr->find('td', 0) == '') {
                    continue;
                }
                $image = $tr->find('td a img', 0);
                
                
                $link = $tr->find('td a', 0)->href;
                $marka = $tr->find('td', 1);
                $model = $tr->find('td', 2);
                $yil = $tr->find('td', 3);
                $km = $tr->find('td', 4);
                $renk = $tr->find('td', 5);
                $fiyat = $tr->find('td', 6);
                ?>



                <article class="card clearfix">
                    <div class="card__img">
                        <a href="<?= $link; ?>" target="_blank"><?php echo $image; ?></a>
                    </div>
                    <div class="card__inner">
                        <h2 class="card__title ui-title-inner"><a href="<?= $link; ?>" target="_blank"><?= $model; ?></a></h2>
                        <div class="decor-1"></div>
                        <ul class="card__list list-unstyled">
                            <li class="card-list__row">
                                <span class="card-list__title">Marka:</span>
                                <span class="card-list__info"><?= $marka; ?></span>
                            </li>
                            <li class="card-list__row">
                                <span class="card-list__title">Yıl:</span>
                                <span class="card-list__info"><?= $yil; ?></span>
                            </li>
                            <li class="card-list__row">
                                <span class="card-list__title">Km:</span>
                                <span class="card-list__info"><?= $km; ?></span>
                            </li>
                            <li class="card-list__row">
                                <span class="card-list__title">Renk</span>
                                <span class="card-list__info"><?= $renk; ?></span>
                            </li>
                        </ul>
                        <div class="card__price">Fiyat:<span class="card__price-number"><?= $fiyat; ?></span></div>
                    </div>
                </article>

                <?php
            }
            ?>


        </main><!-- end main-content -->
    </div><!-- end col -->



</div><!-- end row -->
