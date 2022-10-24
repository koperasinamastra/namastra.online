<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Role Akses
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
                            <?= $this->session->flashdata('massage'); ?>
                            <h5>Role : <?php echo $role['role']; ?></h5>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>menu</th>
                                            <th>akses</th>
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
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" <?= check_access($role['id'], $m->id); ?> data-role="<?= ($role['id']); ?>" data-menu="<?= ($m->id); ?>">
                                                    </div>
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
        $('#example').DataTable();


    });
</script>