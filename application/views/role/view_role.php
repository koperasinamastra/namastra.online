<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Management Role Akses
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?= $this->session->flashdata('massage'); ?>
                            <A href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahrole">
                                Tambah Role Akses
                            </a>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($roledata as $r) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $r->role; ?></td>
                                                <td>
                                                    <a href="#" data-kodebarang="# " class="btn btn-sm btn-primary edit">
                                                        Edit
                                                    </a>
                                                    <a href="#" data-href="" class="btn btn-sm btn-danger hapus">
                                                        Hapus
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>roleakses/aksesrole/<?php echo $r->id ?>" data-href="" class="btn btn-sm btn-warning hapus">
                                                        akses
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

<div class="modal fade" id="tambahrole" tabindex="-1" role="dialog" aria-labelledby="tambahroleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahroleLabel">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('roleakses') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="role" id="role" class="form-control" aria-describedby="role" placeholder="Role">
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



<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();

    });
</script>