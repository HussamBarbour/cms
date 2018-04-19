<!DOCTYPE html>
<html lang="<?= $lang;?>">
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $page_title ?></title>
    <meta name="author" content="Nafeza.net">
    <meta name="description" content="<?= $meta_description ?>"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $page_title ?>" />
    <meta property="og:description" content="<?= $meta_description ?>" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:site_name" content="<?= $this->OptionsModel->getByName('site_name'); ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?= $meta_description ?>" />
    <meta name="twitter:title" content="<?= $page_title ?>" />

    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url('public/style'); ?>/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="shortcut icon" href="<?= base_url('public/style'); ?>/ico/favicon.ico" />

    <!-- CSS Global -->
    <link href="<?= base_url('public/style'); ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <?php if ($lang == 'ar') { ?>
        <link href="<?= base_url('public/style'); ?>/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" />
    <?php } ?>
    <link href="<?= base_url('public/style'); ?>/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?= base_url('public/style'); ?>/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url('public/style'); ?>/plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet" />
    <link href="<?= base_url('public/style'); ?>/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="<?= base_url('public/style'); ?>/plugins/owl-carousel2/assets/owl.theme.default.min.css" rel="stylesheet" />
    <link href="<?= base_url('public/style'); ?>/plugins/animate/animate.min.css" rel="stylesheet" />

    <!-- Theme CSS -->
    <?php if ($lang == 'ar') { ?>
        <link href="<?= base_url('public/style'); ?>/css/theme-rtl.css" rel="stylesheet" />
    <?php } else { ?>
        <link href="<?= base_url('public/style'); ?>/css/theme.css" rel="stylesheet" />
    <?php } ?>
    <link href="<?= base_url('public/style'); ?>/css/theme-green-1.css" rel="stylesheet" id="theme-config-link" />

    <!-- Head Libs -->
    <script src="<?= base_url('public/style'); ?>/plugins/modernizr.custom.js"></script>

    <!--[if lt IE 9]>
    <script src="<?= base_url('public/style'); ?>/plugins/iesupport/html5shiv.js"></script>
    <script src="<?= base_url('public/style'); ?>/plugins/iesupport/respond.min.js"></script>
    <![endif]-->
</head>
<body id="home" class="wide">
    <!-- PRELOADER -->
<div id="preloader">
    <div id="preloader-status">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
        <div id="preloader-title">Loading</div>
    </div>
</div>
<!-- /PRELOADER -->

<!-- WRAPPER -->
<div class="wrapper">