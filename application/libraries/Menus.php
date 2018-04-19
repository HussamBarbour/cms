<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus {

    public $type;
    public $baselink;
    public $active_menu;
    public $active_class = 'active';
    public $li_class;
    public $ul_class;
    public $a_class;
    public $li_mega_class;
    public $is_mobile = false;
    public $parent_url = false;

    public function view() {
        $CI = & get_instance();
        foreach ($this->type as $key => $link) {
            $content = $CI->Contents->getById($link->m_page_id);
            $content_title = (empty($content->title)) ? '' : $content->title;
            if ($link->m_page_id == '0') {
                $title = $link->m_title;
                $url = $link->m_link;
            } elseif ($link->m_page_id == '-1') {
                $title = lang('index');
                $url = $this->baselink . 'index.php';
            } elseif ($link->m_page_id == '-2') {
                $title = lang('contact');
                $url = $this->baselink . 'contact';
            } else {
                $title = $content_title;
                $url = $this->baselink . $content->shortcut;
            }
            if ($link->m_type == 'mega' && $this->is_mobile == false) {
                ?>
                <li class="<?= $this->li_mega_class != '' ? $this->li_mega_class : 'mega-menu-item dropdown' ?> <?= ($link->m_page_id == $this->active_menu) ? $this->active_class : '' ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" target="<?= $link->m_target ?>" title="<?= $title ?>" href="<?= $this->parent_url ? $url : 'javascript:void(0)' ?>">
                        <?php
                        if ($link->m_icon != '') {
                            ?>
                            <i class="<?= $link->m_icon ?>"></i>
                            <?php
                        }
                        ?>
                        <?= $title ?>
                    </a>
                    <div class="sub-menu">
                        <div class="mega-menu">
                            <?php
                            $subs = $CI->Contents->getByParent($content->content_id);
                            $total = $CI->Contents->total($content->content_id);
                            $cols = ceil($total / 2);
                            $new_ul = true;
                            $end_ul = $cols;
                            foreach ($subs as $key => $sub) {
                                if ($new_ul) {
                                    echo '<ul>';
                                    $new_ul = false;
                                }
                                ?>
                                <li><a target="<?= $link->m_target ?>" title="<?= $sub->title ?>" href="<?= $this->baselink . $sub->shortcut ?>/"><i class="fa fa-check" aria-hidden="true"></i> <?= $sub->title ?></a></li>
                                <?php
                                if (($key + 1) == $end_ul) {
                                    echo '</ul>';
                                    $new_ul = true;
                                    $end_ul = $end_ul + $end_ul;
                                }
                            }
                            ?>
                            <img src="<?= base_url(); ?>public/style/images/menu-image.png" alt="menu image" class="mg-image">
                        </div><!-- mega menu -->
                    </div><!-- sub menu -->
                </li>
                <?php
            } elseif ($link->m_type == 'normal' || ($link->m_type == 'mega' && $this->is_mobile == true)) {
                ?>
                <li class="<?= $this->li_class ?>">
                    <a class="<?= ($link->m_page_id == $this->active_menu) ? $this->active_class : '' ?> <?= $this->a_class;?>" target="<?= $link->m_target ?>" title="<?= $title ?>" href="<?= $this->parent_url ? $url : 'javascript:void(0)' ?>">
                        <?php
                        if ($link->m_icon != '') {
                            ?>
                            <i class="<?= $link->m_icon ?>"></i>
                            <?php
                        }
                        ?>
                        <?= $title ?> <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="<?= $this->ul_class ?>">
                        <?php
                        $subs = $CI->Contents->getByParent($content->content_id);
                        foreach ($subs as $sub) {
                            ?>
                            <li>
                                <a target="<?= $link->m_target ?>" title="<?= $sub->title ?>" href="<?= $this->baselink . $sub->shortcut ?>/"><?= $sub->title ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
            } else {
                ?>
                <li class="<?= ($link->m_page_id == $this->active_menu) ? $this->active_class : '' ?> <?= $this->li_class ?>">
                    <a class="<?= ($link->m_page_id == $this->active_menu) ? $this->active_class  : '' ?> <?= $this->a_class;?>" target="<?= $link->m_target ?>" title="<?= $title ?>" href="<?= $url ?>">
                        <?php
                        if ($link->m_icon != '') {
                            ?>
                            <i class="<?= $link->m_icon ?>"></i>
                            <?php
                        }
                        ?><?= $title ?>
                    </a>
                </li>
                <?php
            }
        }
    }

}
