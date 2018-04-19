<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang('messages'); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active"><?= lang('messages'); ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="panel">
                    <div class="panel-header"><h3><?= lang('messages') ?></h3> </div>
                    <div class="panel-content">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <?php
                                    $fileds = $this->config->item('forms')[$type];
                                    foreach ($fileds as $filed) {
                                        ?>
                                        <th><?= lang($filed) ?></th>
                                        <?php
                                    }
                                    ?>
                                    <th>
                                        Tarih
                                    </th>
                                    <th>
                                        <?= lang('delete') ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $message) {
                                    ?>
                                    <tr>
                                        <?php
                                        foreach ($fileds as $filed) {
                                            $data = $this->FormsModel->getValue($message->id, $filed);
                                            if ($filed == 'cv') {
                                                ?>
                                                <td><a target="_blank" href="<?= base_url('public/upload/cv/' . $data) ?>" class="btn btn-success"> CV </a></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><?= $data ?></td>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                        <td><?= $message->sent_at ?></td>
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
                                                </h3> </div>
                                            <form action="admin/Messages/delete" method="POST">
                                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                <input type="hidden" name="id" value="<?= $message->id ?>" />
                                                <p>
                                                    <?= lang('confirm_delete') ?>
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
                                    <?php
                                    foreach ($fileds as $filed) {
                                        ?>
                                        <th><?= lang($filed) ?></th>
                                        <?php
                                    }
                                    ?>
                                    <th>
                                        Tarih
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
<?php $this->load->view('admin/masterdown'); ?>