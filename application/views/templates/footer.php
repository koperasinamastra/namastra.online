</div>
<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y') ?> <a href="https://namastra.co.id">Koperasi Namastra</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.2.0
    </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="<?= base_url('assets'); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/sparklines/sparkline.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url('assets'); ?>/dist/js/adminlte.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js">
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
</body>

</html>

<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });


    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('roleakses/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('roleakses/aksesrole/'); ?>" + roleId;
            },
        });
    });
</script>