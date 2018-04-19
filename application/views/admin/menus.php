<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang('menus'); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active"><?= lang('menus'); ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel">
                            <?= form_open('admin/Menus/insert', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                            <div class="panel-header">
                                <a href="menus.php"></a>
                                <h3><?= lang('add'); ?></h3>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= lang('title'); ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="m_title" class="form-control form-white" placeholder="<?= lang('title'); ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= lang('page'); ?></label>
                                    <div class="col-sm-9">
                                        <select id="select-type" data-search="true" class="form-control form-white" name="m_page_id">
                                            <option value="-1">(<?= lang('index') ?>)</option>
                                            <option value="-2">(<?= lang('contact') ?>)</option>
                                            <option value="0"><?= lang('custom') ?></option>
                                            <?php
                                            foreach ($contents as $key => $parent) {
                                                $content_type = str_replace('_cat', '', $parent->content_type);
                                                if ($this->config->item('content_types')[$content_type]['menu']) {
                                                    ?>
                                                    <option value="<?= $parent->content_id ?>"><?= $parent->title ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= lang('rank'); ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="m_rank" class="form-control form-white" placeholder="<?= lang('rank'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= lang('link'); ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="m_link" class="form-control form-white" placeholder="<?= lang('link'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= lang('place'); ?></label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-white select2" name="m_place">
                                            <option value="top">Top</option>
                                            <option value="header">Header</option>
                                            <option value="footer">Footer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?= lang('where_open_linked') ?></label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-white select2" name="m_target">
                                            <option value="_self"><?= lang('normal') ?></option>
                                            <option value="_blank"><?= lang('new_page') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Türü</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-white select2" name="m_type">
                                            <option value="link">link</option>
                                            <option value="normal">normal</option>
                                            <option value="mega">mega</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Icon</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="m_icon" class="form-control form-white" placeholder="Icon">
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                    <button type="submit" class="btn btn-info pull-right"><?= lang('add'); ?></button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">

                            <div class="col-md-4">
                                <form action="admin/Menus/updateRank" method="POST">
                                    <table class="table table-bordred table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Top</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($t_links as $key => $link) {
                                                $content = $this->Contents->getById($link->m_page_id, $lang);
                                                $content_title = (empty($content->title)) ? '' : $content->title;
                                                if ($link->m_page_id == '0') {
                                                    $title = $link->m_title;
                                                } elseif ($link->m_page_id == '-1') {
                                                    $title = lang('index');
                                                } elseif ($link->m_page_id == '-2') {
                                                    $title = lang('contact');
                                                } else {
                                                    $title = $content_title;
                                                }
                                                ?>
                                                <tr>
                                                    <td><input size="2" name="m_rank[<?= $link->m_id ?>]" value="<?= $link->m_rank ?>" /></td>
                                            <td><?= $title ?></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#edit<?= $link->m_id; ?>" class="btn btn-warning btn-xs">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </button>
                                            </td>
                                            <td><a class="btn btn-danger btn-xs" href="admin/Menus/delete/<?= $link->m_id ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                        <input class="btn btn-success" type="submit" value="<?= lang('save') ?>" />
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form action="admin/Menus/updateRank" method="POST">
                                    <table class="table table-bordred table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Header</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($h_links as $key => $link) {
                                                $content = $this->Contents->getById($link->m_page_id, $lang);
                                                $content_title = (empty($content->title)) ? '' : $content->title;
                                                if ($link->m_page_id == '0') {
                                                    $title = $link->m_title;
                                                } elseif ($link->m_page_id == '-1') {
                                                    $title = lang('index');
                                                } elseif ($link->m_page_id == '-2') {
                                                    $title = lang('contact');
                                                } else {
                                                    $title = $content_title;
                                                }
                                                ?>
                                                <tr>
                                                    <td><input size="2" name="m_rank[<?= $link->m_id ?>]" value="<?= $link->m_rank ?>" /></td>
                                            <td><?= $title ?></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#edit<?= $link->m_id; ?>" class="btn btn-warning btn-xs">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </button>
                                            </td>
                                            <td><a class="btn btn-danger btn-xs" href="admin/Menus/delete/<?= $link->m_id ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                        <input class="btn btn-success" type="submit" value="<?= lang('save') ?>" />
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <form action="admin/Menus/updateRank" method="POST">
                                    <table class="table table-bordred table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Footer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($f_links as $key => $link) {
                                                $content = $this->Contents->getById($link->m_page_id, $lang);
                                                $content_title = (empty($content->title)) ? '' : $content->title;
                                                if ($link->m_page_id == '0') {
                                                    $title = $link->m_title;
                                                } elseif ($link->m_page_id == '-1') {
                                                    $title = lang('index');
                                                } elseif ($link->m_page_id == '-2') {
                                                    $title = lang('contact');
                                                } else {
                                                    $title = $content_title;
                                                }
                                                ?>
                                                <tr>
                                                    <td><input size="2" name="m_rank[<?= $link->m_id ?>]" value="<?= $link->m_rank ?>" /></td>
                                            <td><?= $title ?></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#edit<?= $link->m_id; ?>" class="btn btn-warning btn-xs">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </button>
                                            </td>
                                            <td><a class="btn btn-danger btn-xs" href="admin/Menus/delete/<?= $link->m_id ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                        <input class="btn btn-success" type="submit" value="<?= lang('save') ?>" />
                                        </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
foreach ($all_links as $key => $link) {
    ?>
    <div class="modal fade" id="edit<?= $link->m_id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span><span class="sr-only"><?= lang('close') ?></span></button>
                    <h3 class="modal-title" id="lineModalLabel"><?= lang('add') ?></h3>
                </div>
                <form action="admin/Menus/update/<?= $link->m_id; ?>" method="POST">
                    <div class="panel-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?= lang('title'); ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="m_title" value="<?= $link->m_title ?>" class="form-control form-white" placeholder="<?= lang('title'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?= lang('page'); ?></label>
                            <div class="col-sm-9">
                                <select id="select-type" data-search="true" class="form-control form-white select2" name="m_page_id">
                                    <option <?= $link->m_page_id == '-1' ? 'selected' : '' ?> value="-1">(<?= lang('index') ?>)</option>
                                    <option <?= $link->m_page_id == '-2' ? 'selected' : '' ?>  value="-2">(<?= lang('contact') ?>)</option>
                                    <option <?= $link->m_page_id == '0' ? 'selected' : '' ?>  value="0"><?= lang('custom') ?></option>
                                    <?php
                                    foreach ($contents as $key => $parent) {
                                        ?>
                                        <option <?= $link->m_page_id == $parent->content_id ? 'selected' : '' ?>  value="<?= $parent->content_id ?>"><?= $parent->title ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?= lang('link'); ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="m_link" value="<?= $link->m_link ?>" class="form-control form-white" placeholder="<?= lang('link'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?= lang('place'); ?></label>
                            <div class="col-sm-9">
                                <select class="form-control form-white select2" name="m_place">
                                    <option <?= $link->m_place == 'top' ? 'selected ' : '' ?>value="top">Top</option>
                                    <option <?= $link->m_place == 'header' ? 'selected ' : '' ?>value="header">Header</option>
                                    <option <?= $link->m_place == 'footer' ? 'selected ' : '' ?>value="footer">Footer</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">target</label>
                            <div class="col-sm-9">
                                <select class="form-control form-white select2" name="m_target">
                                    <option <?= $link->m_target == '_self' ? 'selected ' : '' ?>value="_self"><?= lang('normal') ?></option>
                                    <option <?= $link->m_target == '_blank' ? 'selected ' : '' ?>value="_blank"><?= lang('new_page') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Türü</label>
                            <div class="col-sm-9">
                                <select class="form-control form-white select2" name="m_type">
                                    <option <?= $link->m_type == 'link' ? 'selected ' : '' ?>value="link">link</option>
                                    <option <?= $link->m_type == 'normal' ? 'selected ' : '' ?>value="normal">normal</option>
                                    <option <?= $link->m_type == 'mega' ? 'selected ' : '' ?>value="mega">mega</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Icon</label>
                            <div class="col-sm-9">
                                <input type="text" name="m_icon" value="<?= $link->m_icon ?>" class="form-control form-white" placeholder="Icon">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" data-dismiss="modal"  role="button"><?= lang('close') ?></button>
                            </div>
                            <div class="btn-group" role="group">
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                <button type="submit" class="btn btn-success btn-hover-green" data-action="save" role="button"><?= lang('save') ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php $this->load->view('admin/masterdown'); ?>