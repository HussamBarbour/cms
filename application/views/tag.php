<?php
if ($content->tags) {
    $tags = explode(',', $content->tags);
    ?>
    <div>
        <?php
        foreach ($tags as $tag) {
            $tag = trim($tag);
            $url = str_replace(' ','-',$tag);
            ?>
            <a href="<?= $langlink ?>tags/<?= $url ?>/" title="<?= $tag ?>"><span type="span" class="label label-default"><?= $tag ?></span></a>
                <?php
            }
            ?>
    </div>
    <?php
}
?>