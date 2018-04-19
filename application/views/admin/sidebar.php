<div class="sidebar">
    <div class="logopanel">
        <h1>
            <a href="admin/Home"></a>
        </h1>
    </div>
    <div class="sidebar-inner">
        <div class="menu-title">
            <?= lang('content_management') ?>
        </div>
        <ul class="nav nav-sidebar">
            <?php
            $content_types = $this->config->item('content_types');
            foreach ($content_types as $key => $type) {
                if ($type['primary'] == false) {
                    continue;
                }
                ?>
                <li class="nav-parent <?= ($parent_active == $key) ? 'active' : '' ?>">

                    <a href="#"><i class="icon-puzzle"></i><span><?= lang($type['name']); ?></span> <span class="fa arrow"></span></a>
                    <ul class="children collapse">
                        <li class="<?= ($sub_active == 'list' . $key) ? 'active' : '' ?>"><a href="admin/Content/typeList/<?= $key ?>"> <?= lang($type['name']) ?></a></li>
                        <li class="<?= ($sub_active == 'add' . $key) ? 'active' : '' ?>"><a href="admin/Content/add/<?= $key ?>"> <?= lang('add') ?></a></li>
                        <?php if ($type['sub']) { ?>
                            <li class="<?= ($sub_active == 'categories' . $key) ? 'active' : '' ?>"><a href="admin/Content/categories/<?= $key ?>"> <?= lang('categories') ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
            }
            ?>
            <li class="<?= ($sub_active == 'comments') ? 'active' : '' ?>"><a href="admin/Comments"><i class="fa fa-comment text-aqua"></i> <span><?= lang('comments') ?></span></a></li>
            <li class="<?= ($sub_active == 'menus') ? 'active' : '' ?>"><a href="admin/Menus"><i class="fa fa-navicon text-aqua"></i> <span><?= lang('menus') ?></span></a></li>
            <li class="<?= ($sub_active == 'plugins') ? 'active' : '' ?>"><a href="admin/PluginsController"><i class="fa fa-plug text-aqua"></i> <span>Eklentileri</span></a></li>
            <li class="nav-parent <?= ($parent_active == 'contact') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span><?= lang('contact') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="children collapse">
                    <?php
                    $forms = $this->config->item('forms');
                    foreach ($forms as $key => $form) {
                        ?>
                    <li class="<?= ($sub_active == $key) ? 'active' : '' ?>"><a href="admin/Messages/index/<?= $key;?>"><i class="fa fa-envelope-o"></i> <?= (lang($key) != '') ? lang($key) : $key; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
            <li class="nav-parent <?= ($parent_active == 'settings') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i> <span><?= lang('settings') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="children collapse">
                    <?php
                    $settings = $this->config->item('settings');
                    foreach ($settings as $key => $setting) {
                        ?>
                        <li class="<?= ($sub_active == $key) ? 'active' : '' ?>"><a href="admin/Options/index/<?= $key; ?>"><i class="fa fa-rss"></i> <?= lang($key) ?></a></li>
                        <?php
                    }
                    ?>
                    <li class="<?= ($sub_active == 'languages') ? 'active' : '' ?>"><a href="admin/Languages"><i class="fa fa-language"></i> <?= lang('languages') ?></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>