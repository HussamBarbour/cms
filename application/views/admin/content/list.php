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
                                <a href="admin/Content/add/<?= $content_type['type'].'/'.$parent_id ?>/" class="btn btn-square btn-sm btn-dark"><i class="fa fa-plus"></i> <?= lang('add') ?></a>
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
                                        <?php if ($content_type['sub'] != false) { ?>
                                            <th><?= lang('category') ?></th>
                                        <?php } ?>
                                            <?php if ($content_type['sub_content']) { ?><th><?= $sub_content_type['name']; ?></th><?php } ?>
                                        <?php if ($content_type['gallery'] == true) { ?><th><?= lang('gallery') ?></th><?php } ?>
                                        <th><?= lang('edit') ?></th>
                                        <th><?= lang('delete') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($contents as $content) {
                                        $parent = $this->Contents->getById($content->parent_id);
                                        ?>
                                        <tr>
                                            <td><input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" /><input class="form-control form-white"  name="rank[<?= $content->content_id ?>]" value="<?= $content->rank ?>"><span class="hidden"><?= $content->rank ?></span></td>
                                        <?php if ($content_type['thumb_show'] == true) { ?>
                                            <td><img width="50" src="public/images/content/<?= $content->image ?>" /></td>
                                        <?php } ?>
                                        <td><?= $content->title; ?></td>
                                        <?php if ($content_type['sub'] != false) { ?>
                                            <td><?= (isset($parent)) ? $parent->title : ''; ?></td>
                                        <?php } ?>

                                        <?php if ($content_type['sub_content']) { ?>
                                            <td><a href="admin/Content/typeList/<?= $content_type['sub_content'].'/'.$content->content_id ?>" class="btn btn-square btn-success"> <?= lang($sub_content_type['name']) ?></a></td>
                                        <?php } ?>
                                        <?php if ($content_type['gallery'] == true) { ?>
                                            <td><a href="admin/Content/gallery/<?= $content->content_id ?>" class="btn btn-square btn-success"><span class="glyphicon glyphicon-picture"></span> <?= lang('gallery') ?></a></td>
                                        <?php } ?>
                                        <td><a href="admin/Content/edit/<?= $content_type['type'] . '/' . $content->content_id ?>" class="btn btn-square btn-warning"><span class="glyphicon glyphicon-edit"></span> <?= lang('edit') ?></a></td>
                                        <td><button data-toggle="modal" data-target="#delete<?= $content->content_id ?>" class="btn btn-square btn-danger"><span class="glyphicon glyphicon-trash"></span> <?= lang('delete') ?></button>
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
                                                                <a class="btn btn-danger btn-hover-green" href="admin/Content/delete/<?= $content->content_id ?>">
                                                                    <?= lang('delete') ?>
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
