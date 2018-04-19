<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang('content'); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active"><a href="admin/Content/index/<?= isset($thiscontent->parent_id) ? $thiscontent->parent_id : '' ?>"><i class="fa fa-backward" aria-hidden="true"></i></a></li>
                    <li class="active"><?= lang('content'); ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-header"><h3><?= lang('bulletin') ?></h3> </div>
                            <div class="panel-content">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?= lang('email') ?>
                                            <th>
                                                <?= lang('date') ?>
                                            </th>
                                            <th>
                                                <?= lang('delete') ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bulletin as $message) { ?>
                                            <tr>
                                                <td><?= $message->email; ?></td>
                                                <td><?= $message->sent_at; ?></td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#delete<?= $message->id; ?>" class="btn btn-danger">
                                                        <?= lang('delete') ?>
                                                    </button>
                                                </td>
                                            </tr>
                                        <div class="modal fade" id="delete<?= $message->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">
                                                                <?= lang('close') ?>
                                                            </span> </button>
                                                        <h3 class="modal-title" id="lineModalLabel">
                                                            <?= lang('warning') ?>
                                                        </h3>
                                                    </div>
                                                    <form action="admin/Bulletin/delete" method="POST">
                                                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                        <input type="hidden" name="id" value="<?= $message->id ?>" />
                                                        <p>
                                                            <?= str_replace('*', $message->email, lang('confirm_delete')) ?>
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
                                                <?= lang('email') ?>
                                            </th>
                                            <th>
                                                <?= lang('date') ?>
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
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>