<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang('meta_tags'); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
            <li class="active"><?= lang('settings') ?></li>
            <li class="active"><?= lang('meta_tags') ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="panel">
                    <div class="panel-header"><h3><?= lang('meta_tags') ?></h3> </div>
                    <div class="panel-content">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><?= lang('shortcut') ?></th>
                                    <th><?= lang('page_title') ?></th>
                                    <th><?= lang('meta_description') ?></th>
                                    <th><?= lang('meta_keywords') ?></th>
                                    <th><?= lang('edit') ?></th>
                                    <th><?= lang('delete') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tags as $tag) {
                                    ?>
                                    <tr>
                                        <td><?= $tag->shortcut; ?></td>
                                        <td><?= $tag->title; ?></td>
                                        <td><?= $tag->description; ?></td>
                                        <td><?= $tag->keywords; ?></td>
                                        <td>
                                            <button data-toggle="modal" data-target="#edit<?= $tag->id; ?>" class="btn btn-warning">
                                                <?= lang('edit') ?>
                                            </button>
                                        </td>
                                        <td>
                                            <button data-toggle="modal" data-target="#delete<?= $tag->id; ?>" class="btn btn-danger">
                                                <?= lang('delete') ?>
                                            </button>
                                        </td>
                                    </tr>
                                <div class="modal fade" id="delete<?= $tag->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">
                                                        <?= lang('close') ?>
                                                    </span> </button>
                                                <h3 class="modal-title" id="lineModalLabel">
                                                    <?= lang('warning') ?>
                                                </h3> </div>
                                            <form action="admin/MetaTags/delete" method="POST">
                                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                <input type="hidden" name="id" value="<?= $tag->id ?>" />
                                                <p>
                                                    <?= str_replace('*', $tag->shortcut, lang('confirm_delete')) ?>
                                                </p>
                                                <div class="modal-footer">
                                                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" role="button">
                                                                <?= lang('close') ?>
                                                            </button>
                                                        </div>
                                                        <div class="btn-group" role="group">
                                                            <button type="submit" class="btn btn-danger btn-hover-green" data-action="save" role="button">
                                                                <?= lang('delete') ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="edit<?= $tag->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">×</span><span class="sr-only"><?= lang('close') ?></span></button>
                                                <h3 class="modal-title" id="lineModalLabel"><?= lang('add') ?></h3>
                                            </div>
                                            <form action="admin/MetaTags/update" method="POST" enctype="multipart/form-data">
                                                <div class="panel-content">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-3 control-label"><?= lang('shortcut') ?></label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="shortcut" class="form-control form-white" value="<?= $tag->shortcut?>" placeholder="<?= lang('shortcut') ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-3 control-label"><?= lang('page_title') ?></label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="title" class="form-control form-white" value="<?= $tag->title?>" placeholder="<?= lang('page_title') ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-3 control-label"><?= lang('meta_description') ?></label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="description" class="form-control form-white" value="<?= $tag->description?>" placeholder="<?= lang('meta_description') ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-3 control-label"><?= lang('meta_keywords') ?></label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="keywords" class="form-control form-white" value="<?= $tag->keywords?>" placeholder="<?= lang('meta_keywords') ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button"><?= lang('close') ?></button>
                                                        </div>
                                                        <div class="btn-group" role="group">
                                                            <input type="hidden" name="id" value="<?= $tag->id; ?>" />
                                                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                            <button type="submit" class="btn btn-success btn-hover-green" data-action="save" role="button"><?= lang('save') ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                            <?php ?> </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= lang('shortcut') ?></th>
                                    <th><?= lang('page_title') ?></th>
                                    <th><?= lang('meta_description') ?></th>
                                    <th><?= lang('meta_keywords') ?></th>
                                    <th><?= lang('edit') ?></th>
                                    <th><?= lang('delete') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addMeta" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span><span class="sr-only"><?= lang('close') ?></span></button>
                <h3 class="modal-title" id="lineModalLabel"><?= lang('add') ?></h3>
            </div>
            <form action="admin/MetaTags/insert" method="POST" enctype="multipart/form-data">
                <div class="panel-content">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?= lang('shortcut') ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="shortcut" class="form-control form-white" placeholder="<?= lang('shortcut') ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?= lang('page_title') ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control form-white" placeholder="<?= lang('page_title') ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?= lang('meta_description') ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="description" class="form-control form-white" placeholder="<?= lang('meta_description') ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?= lang('meta_keywords') ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="keywords" class="form-control form-white" placeholder="<?= lang('meta_keywords') ?>"/>
                            </div>
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

<?php $this->load->view('admin/masterdown'); ?>