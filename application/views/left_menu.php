<div class="panel-group" id="menuu" role="tablist" aria-multiselectable="true">
    <?php
    foreach ($parents as $right_list) {
        $sub_list = $this->Contents->getByParent($right_list->content_id, $lang);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <span class="panel-title">
                    <a class="<?= ($right_list->content_id == $content->content_id) ? 'active' : '' ?>" href="<?= $langlink ?><?= $right_list->shortcut ?>/">
                        <?= $right_list->title ?>
                    </a>
                    <?php
                    if ($sub_list) {
                        ?>
                        <a class="pull-right <?= ($right_list->content_id == $content->content_id) ? 'active' : '' ?>" role="button" data-toggle="collapse" data-parent="#<?= $right_list->shortcut ?>" href="#collapse<?= $right_list->content_id ?>" aria-expanded="true" aria-controls="collapse<?= $right_list->content_id ?>">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <?php
                    }
                    ?>
                </span>
            </div>
            <?php
            if ($sub_list) {
                ?>
                <div id="collapse<?= $right_list->content_id ?>" class="panel-collapse collapse <?= ($right_list->content_id == $active_menu || $right_list->content_id == $content->content_id) ? 'in' : '' ?>" role="tabpanel" aria-labelledby="heading<?= $right_list->content_id ?>">
                    <div class="panel-body">

                        <ul style=" list-style: none; padding: 0; " id="<?= $right_list->shortcut ?>" class="collapse<?= $right_list->content_id ?> <?= ($right_list->content_id == $active_menu || $right_list->content_id == $content->content_id) ? 'in' : '' ?>">
                            <?php
                            foreach ($sub_list as $sub) {
                                ?>
                                <li><a <?= ($sub->content_id == $content->content_id) ? 'class="active"' : '' ?> href="<?= $langlink ?><?= $sub->shortcut ?>/"><i class="fa fa-chevron-circle-right"></i><?= $sub->title ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</div>