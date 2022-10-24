<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Management Cabang
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
                            <h3 class="card-title">Data Table Management Cabang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabelcabang" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Cabang</th>
                                            <th>Nama Cabang</th>
                                            <th>Alamat Cabang</th>
                                            <th>Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($cabang as $c) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $c->kode_cabang; ?></td>
                                                <td><?php echo $c->nama_cabang; ?></td>
                                                <td><?php echo $c->alamat_cabang; ?></td>
                                                <td><?php echo $c->telepon; ?></td>
                                                <td>
                                                    <a href="#" data-kodebarang="# " class="btn btn-sm btn-primary edit">
                                                        Edit
                                                    </a>
                                                    <a href="#" data-href="#" class="btn btn-sm btn-danger hapus">
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelcabang').DataTable();
    });
</script>