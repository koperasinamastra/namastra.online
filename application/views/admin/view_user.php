<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Manage User
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahuser">
                                Tambah User
                            </a>
                            <?= form_error('Name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= form_error('password1', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= form_error('password2', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= $this->session->flashdata('massage'); ?>
                            <div class="table-responsive">
                                <table id="tableuser" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>role_id</th>
                                            <th>Status</th>
                                            <th>Create by</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($datauser as $su) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $su->name; ?></td>
                                                <td><?php echo $su->email; ?></td>
                                                <td><?php echo $su->image; ?></td>
                                                <td><?php echo $su->role; ?></td>
                                                <td><?php
                                                    if ($su->is_active == 1) {
                                                        echo '<span class="badge badge-success">Aktif</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                                    }
                                                    ?></td>
                                                <td><?php echo date('d-m-Y', $su->date);  ?></td>
                                                <td>
                                                    <a href="" data-kodeuser="<?php echo $su->id; ?>" class=" btn btn-sm btn-primary edit">
                                                        Edit
                                                    </a>
                                                    <a href="#" data-href="<?php echo base_url(); ?>admin/hapususer/<?php echo $su->id ?>" class="btn btn-sm btn-danger hapus">
                                                        Hapus
                                                    </a>
                                                    <a href="#" data-href="<?php echo base_url(); ?>admin/aktivasi/<?php echo $su->id ?>" class="btn btn-sm btn-success aktivasi">
                                                        Aktivasi
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <div class="row">
        </div>
</div>
</section>
<!-- Modal Hapus user-->
<div class="modal modal-blur fade" id="modalhapususer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apakah anda yakanin hapus data ini ?</div>
                <div>Jika di Hapus data akan hilang</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Cancel</button>
                <a href="#" id="hapususer" class="btn btn-danger">Hapus Data</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal aktiavasi user-->
<div class="modal modal-blur fade" id="modalaktivasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div>Aktifkan email user login</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Cancel</button>
                <a href="#" id="aktivasiuser" class="btn btn-primary">Aktivasi user</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit user-->
<div class="modal modal-blur fade" id="modaledituser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit user</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadformedituser"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $(".edit").click(function() {
            var kodeuser = $(this).attr("data-kodeuser");
            $("#modaledituser").modal("show");
            $("#loadformedituser").load("<?php echo base_url() ?>user/edituser/" + kodeuser);
        });
        $(".hapus").click(function() {
            var href = $(this).attr("data-href");
            $("#modalhapususer").modal("show");
            $("#hapususer").attr("href", href);
        });
        $(".aktivasi").click(function() {
            var href = $(this).attr("data-href");
            $("#modalaktivasi").modal("show");
            $("#aktivasiuser").attr("href", href);
        });
        $(document).ready(function() {
            $('#tableuser').DataTable();
        });
    });
</script>