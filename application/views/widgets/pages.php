<div class="service-sidebar">
    <ul class="service-catergory">
        <?php
        $left_pages = $content->parent_id == 0 ? $subs : $list_pages;
        foreach ($left_pages as $page) {
            ?>
            <li class="<?= $active_menu == $page->content_id ? 'active' : '' ?>"><a href="<?= $langlink.$page->shortcut?>"><span class="icon-left fa fa-chevron-right"></span><?= $page->title?></a></li>
            <?php
        }
        ?>

    </ul>                                                 
</div>