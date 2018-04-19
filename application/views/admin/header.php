<div class="topbar">
    <div class="header-left">
        <div class="topnav">
            <a class="menutoggle" href="#" data-toggle="sidebar-collapsed"><span class="menu__handle"><span>Menu</span></span></a>
        </div>
    </div>
    <div class="header-right">
        <ul class="header-menu nav navbar-nav">
            <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img src="public/assets/global/images/avatars/user1.png" alt="user image">
                        <span class="username"><?= $this->session->userdata('username') ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= base_url() ?>" target="_blank"><i class="icon-home"></i><span>Web site</span></a>
                    </li>
                    <li>
                        <a data-toggle="modal"  data-target="#profile"><i class="icon-user"></i><span>My Profile</span></a>
                    </li>
                    <li>
                        <a href="Auth/logout"><i class="icon-logout"></i><span><?= lang('sign_out') ?></span></a>
                    </li>
                </ul>
            </li>
            <!-- END USER DROPDOWN -->
        </ul>
    </div>
    <!-- header-right -->
</div>
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="Auth/updateprofile/" method="POST" class="form-horizontal">
                <div class="modal-header bg-dark">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>Profile</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="panel-content">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= lang('username') ?></label>
                            <div class="col-sm-10">
                                <input type="text" name="username" value="<?= $this->session->userdata('username') ?>" class="form-control form-white" placeholder="<?= lang('username') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= lang('old_password') ?></label>
                            <div class="col-sm-10">
                                <input type="password" name="old_password" value="" class="form-control form-white" placeholder="<?= lang('old_password') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= lang('new_password') ?></label>
                            <div class="col-sm-10">
                                <input type="password" name="new_password" value="" class="form-control form-white" placeholder="<?= lang('new_password') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= lang('re_password') ?></label>
                            <div class="col-sm-10">
                                <input type="password" name="re_password" value="" class="form-control form-white" placeholder="<?= lang('re_password') ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal"><?= lang('close') ?></button>
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                    <button type="submit" class="btn btn-info pull-right"><?= lang('edit') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

