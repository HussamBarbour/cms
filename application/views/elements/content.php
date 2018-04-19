<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if (isset($page_editor)) {
    ?>
    <form action="<?= base_url() ?>admin/Content/updateFromEditor/<?= $content->content_id; ?>" method="POST">
        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
        <input type="hidden" name="lang" value="<?= $lang ?>" />
        <input type="hidden" name="parent_id" value="<?= $content->parent_id ?>" />
        <input type="hidden" name="content_type" value="<?= $content->content_type ?>" />
        <textarea id="page_editor" name="content" contenteditable="true"><?= $content->content ?></textarea>
        <input style=" position: fixed !important; top: 200px; right: 0; z-index: 99999; " type="submit" class="btn btn-success" value="Kaydet"/>
    </form>
    <script src="<?= base_url() ?>public/assets/global/plugins/ckeditor/ckeditor.js"></script>
    <script>
        // Turn off automatic editor creation first.
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.inline('page_editor');
        CKEDITOR.plugins.add('imageuploader', {
            init: function (editor) {
                editor.config.filebrowserBrowseUrl = '<?= base_url() ?>public/assets/global/plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
            }
        });

    </script>
    <?php
} else {

    $shortcodes = $this->config->item('shortcode');
    $content = $content->content;
    foreach ($shortcodes as $key => $value) {
        if (strpos($content, '[' . $key . ']')) {
            $content = str_replace('[' . $key . ']', $this->load->view('shortcodes/' . $value, '', TRUE), $content);
        }
    }
    echo $content;
}
?>
