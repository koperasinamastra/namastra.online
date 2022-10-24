<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Halaman Submenu
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
                            <h3 class="card-title">Data Table Management Submenu</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?= form_error('title', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= form_error('role_id', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= form_error('url', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= form_error('is_active', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= $this->session->flashdata('massage'); ?>
                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahsubmenu">
                                Tambah Submenu
                            </a>
                            <div class="table-responsive">
                                <table id="tablesubmenu" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>Menu</th>
                                            <th>Submenu</th>
                                            <th>Url</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($subMenu as $sm) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $sm->menu; ?></td>
                                                <td><?php echo $sm->title; ?></td>
                                                <td><?php echo $sm->url; ?></td>
                                                <td><?php
                                                    if ($sm->is_active == 1) {
                                                        echo '<span class="badge badge-success">Aktif</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                                    }
                                                    ?>

                                                </td>
                                                <td>
                                                    <a href="#" data-kodebarang="# " class="btn btn-sm btn-primary edit">
                                                        Edit
                                                    </a>
                                                    <a href="#" data-href="<?php echo base_url(); ?>submenu/hapusSubmenu/<?php echo $sm->id ?>" class="btn btn-sm btn-danger hapus">
                                                        Hapus
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


<!-- Modal Tambah Submenu-->
<div class="modal fade" id="tambahsubmenu" tabindex="-1" role="dialog" aria-labelledby="tambahsubmenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahsubmenuLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('submenu') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nama Submenu">
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select" name="role_id" id="role_id">
                            <option selected>--Pilih Menu--</option>
                            <?php foreach ($menudata as $md) { ?>
                                <option value="<?php echo $md->id; ?>"><?php echo $md->menu ?> <?php } ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url">
                    </div>
                    <div class="input-group">
                        <select class="custom-select" name="is_active" id="is_active">
                            <option selected>--Pilih Status--</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus submenu-->
<div class="modal modal-blur fade" id="modalhapussubmenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apakah anda yakanin hapus data ini ?</div>
                <div>Jika di Hapus data akan hilang</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Cancel</button>
                <a href="#" id="hapussubmenu" class="btn btn-danger">Hapus Data</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $(".edit").click(function() {
            var kodesubmenu = $(this).attr("data-kodesubmenu");
            $("#modaleditsubmenu").modal("show");
            $("#loadformeditsubmenu").load("<?php echo base_url() ?>submenu/editsubmenu/" + kodesubmenu);
        });
        $(".hapus").click(function() {
            var href = $(this).attr("data-href");
            $("#modalhapussubmenu").modal("show");
            $("#hapussubmenu").attr("href", href);
        });
        $(document).ready(function() {
            $('#tablesubmenu').DataTable();
        });
    });
</script>