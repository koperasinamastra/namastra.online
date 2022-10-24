    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url('auth'); ?>"><b>KOPERASI NAMASTRA</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h3 class="text-center">
                    <a href="index.html" class="logo logo-admin"><img src="<?php echo base_url(); ?>assets/images/logo.png" height="35" alt="logo"></a>
                </h3>
                <p class="login-box-msg">Sign in to start your session</p>
                <?= $this->session->flashdata('massage'); ?>
                <form action="<?= base_url(); ?>auth" method="post">
                    <?= form_error('email', '<small class="text-danger" pl-3>', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Email" <?= set_value('email'); ?>>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password', '<small class="text-danger" pl-3>', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="<?= base_url('auth/registration'); ?>" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->