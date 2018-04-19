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
                    <li class="active"><?= lang('content'); ?></li>
                    <li class="active"><?= lang('add'); ?></li>
                </ol>
            </div>
        </div>
        <form action="admin/Content/insert" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9 portlets">
                    <?php
                    foreach ($languages as $key => $language) {
                        ?>
                        <div class="panel">
                            <div class="panel-header">
                                <h3><i class="icon-check"></i> <strong><?= $language->name ?></strong></h3>
                                <div class="control-btn"><a href="#" class="panel-toggle  <?= ($key == 0) ? '' : 'closed' ?>"><i class="fa fa-angle-down"></i></a></div>
                            </div>
                            <div class="panel-content" <?= ($key == 0) ? '' : 'style="display: none;"' ?>>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('title'); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('title'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('content'); ?></label>
                                        <div class="col-sm-10">
                                            <textarea name="content[<?= $language->short ?>]" class="ckeditor" placeholder="<?= lang('content'); ?>"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('tags'); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="tags[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('tags'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('shortcut'); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="shortcut[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('shortcut'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('page_title'); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="70" name="page_title[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('page_title'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('meta_description'); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text"  maxlength="160" name="meta_description[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('meta_description'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('meta_keywords'); ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="100" name="meta_keywords[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('meta_keywords'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <?php
                                foreach ($custom_fields as $key => $fields) {
                                    if ($fields['trans'] == false)
                                        continue;
                                    $fields['placeholder'] = lang($fields['placeholder']) ? lang($fields['placeholder']) : $fields['placeholder'];
                                    $fields['name'] = 'trans_other[' . $language->short . '][' . $fields['name'] . ']';
                                    ?>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $fields['placeholder'] ?></label>
                                            <div class="col-sm-10">
                                                <?php
                                                if ($fields['type'] == 'input') {
                                                    echo form_input($fields);
                                                } elseif ($fields['type'] == 'textarea') {
                                                    echo form_textarea($fields);
                                                } elseif ($fields['type'] == 'yes_no') {
                                                    $name = 'trans_other[' . $language->short . '][' . $fields['name'] . ']';
                                                    $options = array('0' => 'no', '1' => 'yes');
                                                    echo form_dropdown($name, $options);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    foreach ($custom_fields as $key => $fields) {
                        if ($fields['trans'] == true)
                            continue;
                        $fields['placeholder'] = lang($fields['placeholder']) ? lang($fields['placeholder']) : $fields['placeholder'];
                        $fields['name'] = 'other[' . $fields['name'] . ']';
                        ?>
                        <div class="other">
                            <div class="penel">
                                <div class="panel-header">
                                    <h3><strong><?= $fields['placeholder'] ?></strong></h3>
                                </div>
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <?php
                                                if ($fields['type'] == 'input') {
                                                    echo form_input($fields);
                                                } elseif ($fields['type'] == 'textarea') {
                                                    echo form_textarea($fields);
                                                } elseif ($fields['type'] == 'yes_no') {
                                                    $name = 'other[' . $fields['name'] . ']';
                                                    $options = array('0' => 'no', '1' => 'yes');
                                                    echo form_dropdown($name, $options);
                                                }
                                                ?>
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
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-header">
                            <h3><strong><?= lang('image'); ?></strong></h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img data-src="" src="public/assets/global/images/gallery/content-image.png" class="img-responsive" alt="gallery 3">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Resim seç...</span><span class="fileinput-exists">Change</span>
                                            <input type="file" name="image">
                                        </span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($content_type['sub'] != false) { ?>
                        <div class="panel">
                            <div class="panel-header">
                                <h3><?= lang('parent_name'); ?></h3>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control form-white" data-search="true" name="parent_id">
                                                <option value="0"><?= lang('parent_page'); ?></option>
                                                <?php
                                                foreach ($contents as $key => $parent) {
                                                    ?>
                                                    <option value="<?= $parent->content_id ?>" ><?= $parent->title ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?> <input name="parent_id" value="<?= $parent_id;?>" type="hidden" /><?php } ?>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <input type="hidden" name="content_type" value="<?= $content_type_value ?>" />
                                <input type="hidden" name="redirect_to" value="<?= $redirect_to ?>" />
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                <button type="submit" class="btn btn-info pull-right"><span class="glyphicon glyphicon-floppy-disk"></span> <?= lang('save'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>