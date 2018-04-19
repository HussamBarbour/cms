<div id="alithemes-theme-widget-last-post-2" class="sidebar-widget widget_alith_recent_posts_thumb_widget clr">
    <h4><span>EN POPÜLER</span></h4>
    <div class="recent-post">
        <ul>
            <?php
            $pops = $this->Contents->getPop('makale', 3);
            foreach ($pops as $pop) {
                ?>
                <li>
                    <div class="post-thumb">
                        <a class="post-title" href="<?= base_url() . $pop->shortcut ?>" title="<?= $pop->title ?>">
                            <img class="mini-widget-thumb" width="75" height="75" src="<?= base_url() . 'public/images/content/' . $pop->image ?>" alt="<?= $pop->title ?>"/>
                        </a>
                    </div>
                    <div class="post-data">
                        <h5><a class="post-title" href="<?= base_url() . $pop->shortcut ?>" title="<?= $pop->title ?>"><?= $pop->title ?></a></h5>							
                        <small><?= word_limiter($pop->content, 7) ?></small>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>

    </div>


</div>