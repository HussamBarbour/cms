<?php $this->load->view('admin/master'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="main-content">
    <?php $this->load->view('admin/header'); ?>
    <div class="page-content">
        <div class="header">
            <h2><strong>Eklentileri</strong></h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li><a href="admin"> <?= lang('home') ?></a></li>
                    <li class="active">Eklentileri</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 portlets">
                <div class="panel">
                    <div class="panel-content">
                        <form action="admin/Content/rankUpdate/" method="POST">
                            <table class="table table-hover table-dynamic dataTable">
                                <thead>
                                    <tr>
                                        <th><?= lang('title') ?></th>
                                        <th>Uri</th>
                                        <th>Sürüm </th>
                                        <th>Açıklama </th>
                                        <th>Yazar </th>
                                        <th>Yazar Uri</th>
                                        <th>Durum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($plugins != false) {
                                        foreach ($plugins AS $key => $name) {
                                            if (empty($name['plugin_info'])) {
                                                $name = $this->plugins->get_plugin_info($key);
                                            }
                                            ?>
                                            <tr>
                                                <td><?= isset($name['plugin_info']['plugin_name']) ? $name['plugin_info']['plugin_name'] : '' ?></td>
                                                <td><?= isset($name['plugin_info']['plugin_uri']) ? $name['plugin_info']['plugin_uri'] : '' ?></td>
                                                <td><?= isset($name['plugin_info']['plugin_version']) ? $name['plugin_info']['plugin_version'] : '' ?></td>
                                                <td><?= isset($name['plugin_info']['plugin_description']) ? $name['plugin_info']['plugin_description'] : '' ?></td>
                                                <td><?= isset($name['plugin_info']['plugin_author']) ? $name['plugin_info']['plugin_author'] : '' ?></td>
                                                <td><?= isset($name['plugin_info']['plugin_author_uri']) ? $name['plugin_info']['plugin_author_uri'] : '' ?></td>
                                                <th><?php
                                                    if (isset(Plugins::$plugins_active[$key])) {
                                                        ?>
                                                        <a href="<?= base_url('admin/PluginsController/deactivate/' . $key) ?>" class="btn btn-danger">Etkisizleştir</a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="<?= base_url('admin/PluginsController/activate/' . $key) ?>" class="btn btn-success">Etkinleştir</a>
                                                        <?php
                                                    }
                                                    ?></th>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<?php $this->load->view('admin/masterdown'); ?>
