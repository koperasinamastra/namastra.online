<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html"><b>Koperasi</b>Namastra</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <h3 class="text-center">
                <a href="index.html" class="logo logo-admin"><img src="<?php echo base_url(); ?>assets/images/logo.png" height="35" alt="logo"></a>
            </h3>
            <p class="login-box-msg">Register a new membership</p>
            <form action="<?= base_url('auth/registration') ?>" method="post">
                <?= form_error('name', '<small class="text-danger" pl-3>', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="<?php set_value('name'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('email', '<small class="text-danger" pl-3>', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php set_value('email'); ?>">
                    <div class=" input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password1', '<small class="text-danger" pl-3>', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="password" name="password1" id="password1" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password2', '<small class="text-danger" pl-3>', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('jabatan', '<small class="text-danger" pl-3>', '</small>'); ?>
                <div class="form-group">
                    <select class="form-control" id="jabatan" name="id_jabatan">
                        <option value="">--Pilih Jabatan--</option>
                        <?php foreach ($jabatan as $j) { ?>
                            <option value="<?php echo $j->id_jabatan ?>"><?php echo $j->nama_jabatan ?> <?php } ?></option>
                    </select>
                </div>
                <?= form_error('kode_cabang', '<small class="text-danger" pl-3>', '</small>'); ?>
                <div class="form-group">
                    <select class="form-control" id="kode_cabang" name="kode_cabang">
                        <option value="">--Pilih cabang--</option>
                        <?php foreach ($cabang as $c) { ?>
                            <option value="<?php echo $c->kode_cabang ?>"><?php echo $c->nama_cabang ?> <?php } ?></option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a href="<?= base_url('auth'); ?>" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->