<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong><?= lang($sub_active); ?></strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active"><?= lang('settings') ?></li>
                    <li class="active"><?= lang($sub_active) ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="panel">
                    <div class="panel-header">
                        <h3><?= lang('settings') ?></h3>
                    </div>

                    <form action="admin/Options/update" method="POST" class="form-horizontal">
                        <div class="panel-content">
                            <?php
                            foreach ($contact_options as $key => $option_name) {
                                $option_name['value'] = $this->OptionsModel->getByName($option_name['name']);
                                $option_name['class'] = 'form-control form-white';
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?= lang($option_name['placeholder']) == '' ? $option_name['placeholder'] : lang($option_name['placeholder']) ?></label>
                                    <div class="col-sm-10">
                                        <?php
                                        switch ($option_name['input_type']) {
                                            case 'input' :
                                                echo form_input($option_name);
                                                break;
                                            case 'textarea' :
                                                echo form_textarea($option_name);
                                                break;
                                            default :
                                                echo form_input($option_name);
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                <button type="submit" class="btn btn-info pull-right"><?= lang('save') ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/masterdown'); ?>