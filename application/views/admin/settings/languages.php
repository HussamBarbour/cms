<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang('languages'); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active"><?= lang('settings') ?></li>
                    <li class="active"><?= lang('languages') ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="admin/Languages/update" method="POST">
                    <div class="panel box-danger">
                        <div class="panel-header">
                            <h3><?= lang('languages_installed') ?></h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-xs-2">
                                    <span><?= lang('rank') ?></span>
                                </div>
                                <div class="col-xs-7">
                                    <span><?= lang('name') ?></span>
                                </div>
                                <div class="col-xs-3">
                                    <span><?= lang('shortcut') ?></span>
                                </div>
                            </div>
                            <?php
                            foreach ($languages as $language) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <input type="text" class="form-control form-white" name="<?= $language->id ?>[rank]" value="<?= $language->rank ?>" placeholder="<?= lang('rank') ?>">
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control form-white" name="<?= $language->id ?>[name]" value="<?= $language->name ?>" placeholder="<?= lang('rank') ?>">
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control form-white" name="<?= $language->id ?>[short]" value="<?= $language->short ?>" placeholder="<?= lang('shortcut') ?>">
                                        <input type="hidden" name="<?= $language->id ?>[old_short]" value="<?= $language->short ?>" />
                                    </div>
                                    <div class="col-xs-3">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $language->id ?>">
                                            <span class="glyphicon glyphicon-trash"></span> <?= lang('delete') ?>
                                        </button>
                                        <div class="modal fade" id="delete<?= $language->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel"><?= lang('warning') ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= str_replace('*', $language->name, lang('confirm_delete')) ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a href="admin/Languages/delete/<?= $language->id ?>" class="btn btn-danger"><?= lang('delete') ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                        <div class="panel-footer">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <button type="submit" class="btn btn-success"><?= lang('edit') ?></button>
                        </div>
                    </div> 
                </form>
            </div>
            <div class="col-md-6">
                <form action="admin/Languages/insert" method="POST">
                    <div class="panel box-danger">
                        <div class="panel-header">
                            <h3><?= lang('add') ?></h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-xs-2">
                                    <input type="text" class="form-control form-white" name="rank" placeholder="<?= lang('rank') ?>">
                                </div>
                                <div class="col-xs-7">
                                    <input type="text" class="form-control form-white" name="name" placeholder="<?= lang('name') ?>">
                                </div>
                                <div class="col-xs-3">
                                    <input type="text" class="form-control form-white" name="short" placeholder="<?= lang('shortcut') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <button type="submit" class="btn btn-success"><?= lang('save') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>