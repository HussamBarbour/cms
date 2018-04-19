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
                    <li class="active"><?= lang('edit'); ?></li>
                </ol>
            </div>
        </div>
        <form action="admin/Content/update/<?= $content->content_id; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="other" value="" />            
            <div class="row">
                <div class="col-lg-9 portlets">
                    <?php
                    foreach ($languages as $key => $language) {
                        $trans = $this->ContentsTranslate->getByContentLang($content->content_id, $language->short);
                        ?>
                        <div class="panel">
                            <div class="panel-header">
                                <h3>
                                    <i class="icon-check"></i> <strong><?= $language->name ?></strong>
                                    <?php if ($content_type['live_editor'] == true) { ?><a target="_blank" class="btn btn-info" href="<?= base_url() . $content->shortcut . '/1/editor' ?>">Canlı editor</a><?php } ?>
                                </h3>
                                <div class="control-btn"><a href="#" class="panel-toggle  <?= ($key == 0) ? '' : 'closed' ?>"><i class="fa fa-angle-down"></i></a></div>
                            </div>
                            <div class="panel-content" <?= ($key == 0) ? '' : 'style="display: none;"' ?>>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('title'); ?></label>
                                        <div class="col-sm-10">
                                            <input value="<?= (isset($trans->title)) ? htmlentities($trans->title, ENT_QUOTES, "UTF-8") : '' ?>" type="text" name="title[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('title'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('content'); ?></label>
                                        <div class="col-sm-10">
                                            <textarea name="content[<?= $language->short ?>]" class="ckeditor" placeholder="<?= lang('content'); ?>"><?= (isset($trans->content)) ? htmlspecialchars($trans->content) : '' ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('tags'); ?></label>
                                        <div class="col-sm-10">
                                            <input value="<?= (isset($trans->tags)) ? htmlentities($trans->tags) : '' ?>" type="text" name="tags[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('tags'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('shortcut'); ?></label>
                                        <div class="col-sm-10">
                                            <input value="<?= (isset($trans->shortcut)) ? htmlentities($trans->shortcut) : '' ?>" type="text" name="shortcut[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('shortcut'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('page_title'); ?></label>
                                        <div class="col-sm-10">
                                            <input maxlength="70" value="<?= (isset($trans->page_title)) ? htmlentities($trans->page_title) : '' ?>" type="text" name="page_title[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('page_title'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('meta_description'); ?></label>
                                        <div class="col-sm-10">
                                            <input maxlength="160" value="<?= (isset($trans->meta_description)) ? htmlentities($trans->meta_description) : '' ?>" type="text" name="meta_description[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('meta_description'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?= lang('meta_keywords'); ?></label>
                                        <div class="col-sm-10">
                                            <input maxlength="100" value="<?= (isset($trans->meta_keywords)) ? htmlentities($trans->meta_keywords) : '' ?>" type="text" name="meta_keywords[<?= $language->short ?>]" class="form-control form-white" placeholder="<?= lang('meta_keywords'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <?php
                                foreach ($custom_fields as $key => $fields) {
                                    if ($fields['trans'] == false)
                                        continue;
                                    $fields['placeholder'] = lang($fields['placeholder']) ? lang($fields['placeholder']) : $fields['placeholder'];
                                    $fields['value'] = getMeta($content->content_id, $fields['name'], $language->short);
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
                        $fields['placeholder'] = lang($fields['placeholder']) ? lang($fields['placeholder']) : $fields['placeholder'];
                        $fields['value'] = $this->ContentsMeta->getValue($content->content_id, $fields['name']);
                        $fields['name'] = 'other[' . $fields['name'] . ']';
                        if ($fields['trans'] == true)
                            continue;
                        ?>
                        <div class="other">
                            <div class="penel <?= $content_type['type'] ?>">
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
                                                    $options = array('0' => 'no', '1' => 'yes');
                                                    echo form_dropdown($fields['name'], $options,$fields['value']);
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
                    <?php
                    foreach ($comments as $key => $comment) {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading"><?= $comment->name ?> | <span><?= date('Y-m-d  H:i:s', $comment->sent_at) ?></span><a href="admin/Comments/delete/<?= $comment->id ?>" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a></div>
                            <div class="panel-body">
                                <?= $comment->email ?>
                                <hr/>
                                <?= $comment->message ?>
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
                                        <img data-src="" src="<?= ($content->image != '') ? 'public/images/content/' . $content->image : 'public/assets/global/images/gallery/content-image.png' ?>" class="img-responsive" alt="gallery 3">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <?php
                                        if ($content->image != '') {
                                            ?>
                                            <label>
                                                <input type="checkbox" name="delete_image" class="minimal-red"> <?= lang('delete_image') ?>
                                            </label>
                                            <?php
                                        }
                                        ?>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Resim seç...</span><span class="fileinput-exists">Change</span>

                                            <input type="hidden" name="old_image" value="<?= $content->image ?>" />
                                            <input type="file" name="image" />
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
                                                    if ($parent->content_id == $content->content_id || $parent->parent_id == $content->content_id) {
                                                        continue;
                                                    }
                                                    ?>
                                                    <option value="<?= $parent->content_id ?>" <?= ($content->parent_id == $parent->content_id ) ? 'selected="selected" ' : '' ?>><?= $parent->title ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?> <input name="parent_id" value="<?= $content->parent_id; ?>" type="hidden" /><?php } ?>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                <input type="hidden" name="content_type" value="<?= $content_type_value ?>" />
                                <input type="hidden" name="redirect_to" value="<?= $redirect_to ?>" />
                                <input type="submit" name="ok" class="btn btn-info pull-right" value="<?= lang('ok'); ?>" />
                                <input type="submit" name="save" class="btn btn-info pull-right" value="<?= lang('save'); ?>" /> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>