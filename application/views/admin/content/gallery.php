<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang('content'); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active"><?= lang('upload') ?></li>
                    <li class="active"><?= lang('gallery') ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-9 portlets">
                <div class="panel">
                    <div class="panel-header">
                        <h3><strong><?= lang('gallery'); ?></strong></h3>
                    </div>
                    <div class="panel-content">
                        <table id="example2" class="table table-bordered table-hover">
                            <tbody>
                                <?php
                                foreach ($images as $image) {
                                    $parent = $this->Contents->getById($image->parent_id);
                                    ?>
                                    <tr>
                                        <td><img src="public/upload/images/<?= $image->image; ?>" style="max-width:150px;" alt="<?= $image->title; ?>"/></td>
                                <td><?= $image->title; ?></td>
                                <td><?= $parent->title; ?></td>
                                <td>
                                    <button data-toggle="modal" data-target="#delete<?= $image->id; ?>" class="btn btn-danger">
                                        <?= lang('delete') ?>
                                    </button>
                                </td>
                                </tr>
                                <div class="modal fade" id="delete<?= $image->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">
                                                        <?= lang('close') ?>
                                                    </span> </button>
                                                <h3 class="modal-title" id="lineModalLabel">
                                                    <?= lang('warning') ?>
                                                </h3> </div>
                                            <form action="admin/Gallery/delete" method="POST">
                                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                <input type="hidden" name="image" value="<?= $image->image ?>" />
                                                <input type="hidden" name="id" value="<?= $image->id ?>" />
                                                <p>
                                                    <?= str_replace('*', $image->title, lang('confirm_delete')) ?>
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
                            <?php ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-header">
                        <h3><strong><?= lang('add'); ?></strong></h3>
                    </div>
                    <div class="panel-content">
                        <form action="admin/Gallery/insert" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label><?= lang('image') ?></label>
                                <input type="file" name="images[]" multiple/>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="title" class="form-control form-white" placeholder="<?= lang('title') ?>"/>
                            </div>
                            <input type="hidden" name="parent_id" value="<?= $parent_id ?>" />
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <button type="submit" class="btn btn-success btn-hover-green" data-action="save" role="button"><?= lang('save') ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>