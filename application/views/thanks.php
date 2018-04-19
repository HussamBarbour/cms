<?php $this->load->view('master'); ?>
<?php $this->load->view('elements/header'); ?>
<div class="block-title">
    <div class="block-title__inner section-bg section-bg_second">
        <div class="bg-inner">
            <h1 class="ui-title-page"><?= lang('contact') ?></h1>
            <div class="decor-1 center-block"></div>
            <ol class="breadcrumb">
                <li><a href="<?= $langlink; ?>"><?= lang('index') ?></a></li>
                <li class="active"><?= lang('contact') ?></li>
            </ol>
        </div><!-- end bg-inner -->
    </div><!-- end block-title__inner -->
</div><!-- end block-title -->
<div class="container">
<div class="alert alert-success text-center">
<?= lang('form_message')?>
</div>
</div><!-- end container -->


<?php $this->load->view('elements/footer'); ?>

<?php $this->load->view('masterdown'); ?>

</body>
</html>



