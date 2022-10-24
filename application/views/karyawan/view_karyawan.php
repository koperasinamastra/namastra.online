<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Data Karyawan
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
                            <h3 class="card-title">Data Table Karyawan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabelcabang" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>No HP</th>
                                            <th>Tgl Masuk</th>
                                            <th>Tgl Keluar</th>
                                            <th>Jabatan</th>
                                            <th>Cabang</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($karyawan as $k) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $k->nik; ?></td>
                                                <td><?php echo $k->nama_lengkap; ?></td>
                                                <td><?php echo $k->tgl_lahir; ?></td>
                                                <td><?php echo $k->alamat; ?></td>
                                                <td><?php echo $k->no_hp; ?></td>
                                                <td><?php echo $k->tgl_masuk; ?></td>
                                                <td><?php echo $k->tgl_keluar; ?></td>
                                                <td><?php echo $k->jabatan; ?></td>
                                                <td><?php echo $k->kode_cabang; ?></td>
                                                <td><?php echo $k->is_active; ?></td>
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