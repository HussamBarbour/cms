<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= lang('files') ?>
            <button data-toggle="modal" data-target="#addFile" class="btn btn-warning"><?= lang('add') ?></button>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?= lang('home') ?></a></li>
            <li class="active"><?= lang('upload') ?></li>
            <li class="active"><?= lang('files') ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header"><h3 class="box-title"><?= lang('files') ?></h3> </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <?= lang('files') ?>
                                    </th>
                                    <th>
                                        <?= lang('parent_name') ?>
                                    </th>
                                    <th>
                                        <?= lang('delete') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($files as $file) {
                                    $parent = $this->ContentsTranslate->getByContentLang($file->parent_id,$lang);
                                    ?>
                                    <tr>
                                        <td><?= $file->title; ?></td>
                                        <td><?= $parent->title; ?></td>
                                        <td>
                                            <button data-toggle="modal" data-target="#delete<?= $file->id; ?>" class="btn btn-danger">
                                                <?= lang('delete') ?>
                                            </button>
                                        </td>
                                    </tr>
                                <div class="modal fade" id="delete<?= $file->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">
                                                        <?= lang('close') ?>
                                                    </span> </button>
                                                <h3 class="modal-title" id="lineModalLabel">
                                                    <?= lang('warning') ?>
                                                </h3> </div>
                                            <form action="admin/Files/delete" method="POST">
                                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                <input type="hidden" name="file" value="<?= $file->file ?>" />
                                                <input type="hidden" name="id" value="<?= $file->id ?>" />
                                                <p>
                                                    <?= str_replace('*', $file->title, lang('confirm_delete')) ?>
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
                            <?php } ?>
                            <?php ?> </tbody>
                            <tfoot>
                                <tr>
                                    <th>
                                        <?= lang('files') ?>
                                    </th>
                                    <th>
                                        <?= lang('delete') ?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="addFile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span><span class="sr-only"><?= lang('close') ?></span></button>
                <h3 class="modal-title" id="lineModalLabel"><?= lang('add') ?></h3>
            </div>
            <form action="admin/Files/insert" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?= lang('file') ?></label>
                            <div class="col-sm-9">
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?= lang('title') ?></label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" placeholder="<?= lang('title') ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?= lang('parent_name') ?></label>
                            <div class="col-sm-9">
                                <select name="parent_id" class="form-control select2" style="width: 100%;">
                                    <?php
                                    foreach ($contents as $key => $parent) {
                                        $parent_trans = $this->ContentsTranslate->getByContentLang($parent->id, $lang);
                                        ?>
                                        <option value="<?= $parent->id ?>"><?= $parent_trans->title ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
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