<div id="tag_cloud-1" class="sidebar-widget widget_tag_cloud clr">
    <h4><span>Tags</span></h4>
    <div class="tagcloud">
        <?php
        $public_tags = $this->Contents->getById(26);
        if ($public_tags->tags) {
            $public_tags = explode(',', $public_tags->tags);
            ?>
            <?php
            foreach ($public_tags as $tag) {
                $tag = trim($tag);
                $url = str_replace(' ', '-', $tag);
                ?>
                <a href="<?= $langlink ?>tags/<?= $url ?>/" class="tag-cloud-link tag-link-8 tag-link-position-2" style="font-size: 8pt;" aria-label="<?= $tag ?>"><?= $tag ?></a>
                <?php
            }
            ?>
            <?php
        }
        ?>
    </div>
</div>