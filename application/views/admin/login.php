<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    <title>CMS245</title>
    <base href="<?= base_url() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description" />
    <meta content="themes-lab" name="author" />
    <link rel="shortcut icon" href="public/assets/global/images/favicon.png"/>
    <link href="public/assets/global/css/style.css" rel="stylesheet"/>
    <link href="public/assets/global/css/ui.css" rel="stylesheet"/>
    <link href="public/assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet"/>
</head>
<body class="account separate-inputs" data-page="login">
    <!-- BEGIN LOGIN BOX -->
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <i class="user-img icons-faces-users-03"></i>
                <form class="form-signin" action="Auth/check" method="post" role="form">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                    <div class="append-icon">
                        <input type="text" name="username" id="username" class="form-control form-white username" placeholder="<?= lang('username') ?>" required>
                            <i class="icon-user"></i>
                    </div>
                    <div class="append-icon m-b-20">
                        <input type="password" name="password" class="form-control form-white password" placeholder="<?= lang('password') ?>" required>
                            <i class="icon-lock"></i>
                    </div>
                    <button type="submit" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left"><?= lang('sign_in') ?></button>
                </form>
            </div>
        </div>
    </div>
    <p class="account-copyright">
        <span>Copyright © 2017 </span><span> cms 2.4.5</span>.<span>All rights reserved.</span>
    </p>
</div>
<script src="public/assets/global/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="public/assets/global/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="public/assets/global/plugins/gsap/main-gsap.min.js"></script>
<script src="public/assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="public/assets/global/plugins/backstretch/backstretch.min.js"></script>
<script src="public/assets/global/plugins/bootstrap-loading/lada.min.js"></script>
<script src="public/assets/global/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="public/assets/global/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="public/assets/global/js/pages/login-v1.js"></script>
</body>
</html>