<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang($content_type['name']); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active"><?= lang($content_type['name']) ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="panel">
                    <div class="panel-content">
                        <div class="m-b-20">
                            <div class="btn-group">
                                <a href="admin/Content/add/<?= $content_type['type'] ?>/0/category" class="btn btn-square btn-sm btn-dark"><i class="fa fa-plus"></i> <?= lang('add') ?></a>
                            </div>
                            <div class="btn-group pull-right">
                                <a href="admin/Content/recycleBin/<?= $content_type['type'] ?>" class="btn btn-square btn-sm btn-blue"><i class="fa fa-trash"></i> <?= lang('recycle_bin') ?></a>
                            </div>
                        </div>
                        <form action="admin/Content/rankUpdate/" method="POST">
                            <table class="table table-hover table-dynamic dataTable">
                                <thead>
                                    <tr>
                                        <th><?= lang('rank') ?></th>
                                        <?php if ($content_type['thumb_show'] == true) { ?><th>thumb</th><?php } ?>
                                        <th><?= lang('title') ?></th>
                                        <th><?= lang('edit') ?></th>
                                        <th><?= lang('delete') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    get_subs($content_type);
                                    ?>
                                </tbody>
                            </table>
                            <input type="submit" style="display:none" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<?php $this->load->view('admin/masterdown'); ?>
