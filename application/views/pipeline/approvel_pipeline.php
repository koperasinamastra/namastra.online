<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Data Pipeline Marketing Namastra
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pipeline Marketing</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?= $this->session->flashdata('massage'); ?>
                            <div class="table-responsive">
                                <table id="tabelcabang" class="display table table-bordered" style="width:100%">
                                    <thead class="">
                                        <tr class="bg-primary ">
                                            <th>No</th>
                                            <th>Tanggal Prospek</thclass=>
                                            <th>TL Funding</th>
                                            <th>Funding Officer</th>
                                            <th>Pipeline</th>
                                            <th>Estimasi Closing</th>
                                            <th>Closing</th>
                                            <th>Status</th>
                                            <th>Note PC</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($userdata as $p) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($p->tgl_prospek)); ?></td>
                                                <td><?php echo $p->tl_funding; ?></td>
                                                <td><?php echo $p->funding_officer; ?></td>
                                                <td><?php echo $p->pipline ?></td>
                                                <td><?php echo number_format($p->estimasi_close, '0', '', '.'); ?></td>
                                                <td><?php echo number_format($p->closing, '0', '', '.'); ?></td>
                                                <td><?php
                                                    if ($p->id_status == 1) {
                                                        echo '<span class="badge badge-warning">On Progress</span>';
                                                    } else if ($p->id_status == 2) {
                                                        echo '<span class="badge badge-success">approve</span>';
                                                    } else if ($p->id_status == 3) {
                                                        echo '<span class="badge badge-primary">tolak</span>';
                                                    } else {
                                                        echo '<span class="badge badge-warning">Pending</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $p->NotePC; ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalapprovepipline<?php echo $p->id_pipline ?>">
                                                        Approve
                                                    </a>
                                                    <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalviewpipline<?php echo $p->id_pipline ?>">
                                                        <i class="nav-icon 	fa fa-eye"></i></a>
                                                    <a href="#" data-href="<?php echo base_url(); ?>pipeline/hapuspipeline/<?php echo $p->id_pipline ?>" class="btn btn-sm btn-danger hapus">
                                                        <i class="nav-icon fa fa-trash"></i>
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

<!-- Modal View Pipeline-->
<?php
$no = 0;
foreach ($userdata as $p) : $no++ ?>
    <div class="modal fade bd-example-modal-lg" id="modalviewpipline<?php echo $p->id_pipline; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Pipeline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-deck">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        Tanggal Prospek
                                    </div>
                                    <div class="col-7">
                                        : <?php echo date("d-m-Y", strtotime($p->tgl_prospek)); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        TL Funding
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->tl_funding; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Funding Officer
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->funding_officer; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Nama Prospek
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->nama_prospek; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Alamat
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->alamat; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        No Hp
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->nohp; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Status Pipeline
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->pipline; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Estimasi Closing
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->estimasi_close; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Closing
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->closing; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        Note PC
                                    </div>
                                    <div class="col-7">
                                        : <?php echo $p->NotePC; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Create <?php echo format_indo($p->tgl_input) ?></small>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="<?php echo base_url('./uploads/prospek/') . $p->upload_img; ?>" alt="Card image cap">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Print</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus Pipeline-->
<div class="modal modal-blur fade" id="modalhapususer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/simpanuser') ?>" method="POST">
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

<!-- Modal approve Pipeline-->
<?php
$no = 0;
foreach ($pipeline as $p) : $no++ ?>
    <div class="modal" id="modalapprovepipline<?php echo $p->id_pipline ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Pipeline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Pipeline/updateapprove') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" readonly name="id_pipline" id="id_pipline" value="<?php echo $p->id_pipline ?>" placeholder="Note Pc">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control" id="notepc" name="notepc" placeholder="Note Pc"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <select class="custom-select" id="status" name="status">
                                <option selected>Pilih status</option>
                                <?php foreach ($status as $s) : ?>
                                    <option value="<?php echo $s->id_status ?>"><?php echo $s->status ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Approve</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    $(function() {
        $(".edit").click(function() {
            var kodepipline = $(this).attr("data-kodepipline");
            $("#modaleditpipline").modal("show");
            $("#loadformeditpipline").load("<?php echo base_url() ?>pipline/editpipline/" + kodepipline);
        });

        $(".hapus").click(function() {
            var href = $(this).attr("data-href");
            $("#modalhapususer").modal("show");
            $("#hapususer").attr("href", href);
        });
    });

    $(document).ready(function() {
        $('#tabelcabang').DataTable(

        );
    });
</script>