<?php $this->load->view('master'); ?>
<body class="single single-portfolio postid-7826 fixed-header no-slider dark-header icons-style-light parallax-header">
<div id="main-container" >
    <div  class="page-wrapper" >
        <?php $this->load->view('header'); ?>
        <div id="content-container" class="content-boxed layout-full">
            <div id="full-width" class="content">
                <div class="content-box">
                    <?php
                    foreach ($tags as $result) {
                        if ($result->title != '') {
                            ?>
                            <div class="product-table">
                                <table>
                                    <tbody>
                                        <tr class="table_s">
                                            <td><?= $result->title ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= word_limiter($result->content, 20) ?> <a href="<?= $langlink ?><?= $result->shortcut ?>/"><?= lang('read_more') ?>..</a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php
                                                if ($result->tags) {
                                                    $tags = explode(',', $result->tags);
                                                    ?>
                                        <div class="margin-bottom-15">
                                            <?php
                                            foreach ($tags as $tag) {
                                                $tag = trim($tag);
                                                ?>
                                                <a href="<?= $langlink ?>tags/<?= $tag ?>/" title="<?= $tag ?>"><span type="span" class="label label-success"><?= $tag ?></span></a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    <?php }
                                    ?>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="clear"></div>
                </div>
            </div> <!-- end main content holder (#content/#full-width) -->
            <div class="clear"></div>
        </div> <!-- end #content-container -->
    </div>
    <?php $this->load->view('footer'); ?>
</div>

<?php $this->load->view('masterdown'); ?>