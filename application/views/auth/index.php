<div class="auth-page bg">
    <div class="login">
        <div class="container p-md-5 col-sm">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto ">
                <?= $this->session->flashdata('message'); ?>

                <div class="container">

                    <form action="<?php base_url('user'); ?>" method="POST">
                        <div class="form-group">
                            <input id="id-input" class="rounded-pill form-control border-top-0 border-right-0 border-left-0 border-bottom" type="text" name="id" value="<?php set_value('id'); ?>" autofocus placeholder="Login ID">
                            <small class="text-danger text-left"><?= form_error('id'); ?></small>
                        </div>
                        <div class="form-group">
                            <input id="password-input" class="rounded-pill form-control border-top-0 border-right-0 border-left-0 border-bottom" type="password" name="password" placeholder="Password">
                            <small class="text-danger text-left"><?= form_error('password'); ?></small>
                        </div>
                        <input type=submit value="Login to my account" class="rounded-pill form-control">
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>