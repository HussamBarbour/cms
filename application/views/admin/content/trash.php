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
                    <li class="active"><?= lang('recycle_bin'); ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="panel">
                    <div class="panel-header">
                        <h3><strong><?= lang('recycle_bin'); ?></strong></h3>
                    </div>
                    <div class="panel-content">
                        <table class="table table-hover table-dynamic dataTable">
                            <thead>
                                <tr>
                                    <th><?= lang('title') ?></th>
                                    <th><?= lang('restoration') ?></th>
                                    <th><?= lang('delete_for_ever') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($contents as $content) {
                                    ?>
                                    <tr>
                                        <td><?= $content->title ?></td>
                                        <td><a href="admin/Content/restoration/<?= $content->content_id ?>" class="btn btn-warning"><span class="glyphicon glyphicon-repeat"></span> <?= lang('restoration') ?></a></td>
                                        <td><button data-toggle="modal" data-target="#delete<?= $content->content_id ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> <?= lang('delete_for_ever') ?></button>
                                            <!-- delete model -->
                                <div class="modal fade" id="delete<?= $content->content_id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="lineModalLabel"><?= lang('warning') ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <?= str_replace('*', $content->title, lang('confirm_delete')) ?>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" role="button">
                                                            <?= lang('close') ?>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                        <a class="btn btn-danger btn-hover-green" href="admin/Content/deleteForEver/<?= $content->content_id ?>">
                                                            <?= lang('delete_for_ever') ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= lang('title') ?></th>
                                    <th><?= lang('restoration') ?></th>
                                    <th><?= lang('delete_for_ever') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>