<form class="form-contact" method="POST" action="<?= base_url('Requests/sentMessage/kariyer') ?>" enctype="multipart/form-data">
    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>"  />

    <div class="row">
        <div class="col-sm-6">
            <input class="form-control" type="text" name="firstname" placeholder="<?= lang('firstname') ?>" required>
        </div>
        <!-- end col -->
        <div class="col-sm-6">
            <input class="form-control" type="text" name="lastname" placeholder="<?= lang('lastname') ?>" required>
        </div>
        <!-- end col --> 
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-sm-6">
            <input class="form-control" type="text" name="phone" placeholder="<?= lang('phone') ?>" required>
        </div>
        <!-- end col -->
        <div class="col-sm-6">
            <input class="form-control" type="text" name="email" placeholder="<?= lang('email') ?>" required>
        </div>
        <!-- end col --> 
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-xs-12">
            CV (PDF)<input class="form-control" type="file" name="cv">
                <div class="btn">
                    <div class="wrap__btn-skew-r">
                        <button class="btn-skew-r btn-effect "><span class="btn-skew-r__inner"><?= lang('send') ?></span></button>
                    </div>
                </div>
        </div>
    </div>
    <!-- end row -->
</form>