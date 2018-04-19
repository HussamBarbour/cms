<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="header">
            <h2><strong>Yorumlar</strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active">Yorumlar</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="panel">                    
                    <div class="panel-header">
                        <h3><strong>Yorumlar</strong></h3>
                    </div>
                    <div class="panel-content">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <?= lang('name') ?>
                                    </th>
                                    <th>
                                        <?= lang('email') ?>
                                    </th>
                                    <th>
                                        Yourum
                                    </th>
                                    <th>
                                        <?= lang('title') ?>
                                    </th>
                                    <th>
                                        <?= lang('date') ?>
                                    </th>
                                    <th>
                                        yayınla
                                    </th>
                                    <th>
                                        <?= lang('delete') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($comments as $comment) {
                                    $title = $this->ContentsTranslate->getByContentLang($comment->content_id, $lang);
                                    ?>
                                    <tr>
                                        <td><?= $comment->name; ?></td>
                                        <td><?= $comment->email; ?></td>
                                        <td><?= $comment->message; ?></td>
                                        <td><?= $title->title; ?></td>
                                        <td><?= date('Y-m-d  H:i:s', $comment->sent_at); ?></td>
                                        <td>
                                            <a href="admin/Comments/publish" class="btn btn-success">
                                                yayınla
                                            </a>
                                        </td>
                                        <td>
                                            <button data-toggle="modal" data-target="#delete<?= $comment->id; ?>" class="btn btn-danger">
                                                <?= lang('delete') ?>
                                            </button>
                                        </td>
                                    </tr>
                                <div class="modal fade" id="delete<?= $comment->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">
                                                        <?= lang('close') ?>
                                                    </span> </button>
                                                <h3 class="modal-title" id="lineModalLabel">
                                                    <?= lang('warning') ?>
                                                </h3> </div>
                                            <form action="admin/Comments/delete/<?= $comment->id ?>" method="POST">
                                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                <p>
                                                    <?= str_replace('*', $comment->name, lang('confirm_delete')) ?>
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
        </div>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>