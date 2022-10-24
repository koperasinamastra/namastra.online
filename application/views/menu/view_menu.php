<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Management Menu
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
                            <h3 class="card-title">Data Table Management Menu</h3>
                        </div>
                        <div class="card-body">
                            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= form_error('icon', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= $this->session->flashdata('massage'); ?>
                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahmenu">
                                Tambah Menu
                            </a>
                            <div class="table-responsive">
                                <table id="tableMenu" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>Nama Menu</th>
                                            <th>Icon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($menu as $m) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $m->menu; ?></td>
                                                <td><?php echo $m->icon; ?></td>
                                                <td>
                                                    <a href="#" data-kodebarang="# " class="btn btn-sm btn-primary edit">
                                                        Edit
                                                    </a>
                                                    <a href="#" data-href="<?php echo base_url(); ?>menu/hapusmenu/<?php echo $m->id ?>" class="btn btn-sm btn-danger hapus">
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

<!-- Modal Tambah Menu-->
<div class="modal fade" id="tambahmenu" tabindex="-1" role="dialog" aria-labelledby="tambahmenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahmenuLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Masukan Icon">
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

<!-- Modal Hapus menu-->
<div class="modal modal-blur fade" id="modalhapusmenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Apakah anda yakanin hapus data ini ?</div>
                <div>Jika di Hapus data akan hilang</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">Cancel</button>
                <a href="#" id="hapusmenu" class="btn btn-danger">Hapus Data</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $(".edit").click(function() {
            var kodemenu = $(this).attr("data-kodemenu");
            $("#modaleditmenu").modal("show");
            $("#loadformeditmenu").load("<?php echo base_url() ?>menu/editmenu/" + kodemenu);
        });
        $(".hapus").click(function() {
            var href = $(this).attr("data-href");
            $("#modalhapusmenu").modal("show");
            $("#hapusmenu").attr("href", href);
        });
        $(document).ready(function() {
            $('#tableMenu').DataTable();
        });
    });
</script>