<div id="alithemes-theme-widget-last-post-1" class="sidebar-widget widget_alith_recent_posts_thumb_widget clr"><h4><span>SON GÖNDERİLER</span></h4>	
    <div class="recent-post-big-thumb">
        <ul>
            <?php
            $lasts = $this->Contents->getLast('makale', 4);
            foreach ($lasts as $key => $last) {
                ?>
                <li>
                    <?php
                    if ($key == 0) {
                        ?>
                        <div class="post-thumb">								
                            <a class="post-title" href="<?= base_url() . $last->shortcut ?>" title="<?= $last->title ?>">
                                <img class="mini-widget-thumb" src="<?= base_url() . 'public/images/content/' . $last->image ?>" alt="<?= $last->title ?>"/>
                            </a>			
                        </div>
                        <?php
                    }
                    ?>
                    <div class="post-data">				
                        <h5><span class="number"><?= $key + 1 ?></span><a class="post-title" href="<?= base_url() . $last->shortcut ?>" title="<?= $last->title ?>"><?= $last->title ?></a></h5>				
                    </div>
                </li>	
                <?php
            }
            ?>

        </ul>
    </div>


</div>