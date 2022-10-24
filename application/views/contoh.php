<!DOCTYPE html>
<html>

<head>
    <title>Select berhubungan dengan codeigniter dan ajax</title>
</head>

<body>
    <br />
    <div class="col-md-6 col-md-offset-3">
        <div class="thumbnail">
            <h4>
                <center>Membuat Select berhubungan dengan codeigiter</center>
            </h4>
            <hr />
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-3">Divisi</label>
                    <div class="col-md-8">
                        <select name="divisi" id="divisi" class="form-control">
                            <option value="0">-PILIH-</option>
                            <?php foreach ($data->result() as $row) : ?>
                                <option value="<?php echo $row->id_divisi; ?>"><?php echo $row->nama_divisi; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Produk</label>
                    <div class="col-md-8">
                        <select name="produk" class="produk form-control">
                            <option value="0">-PILIH-</option>
                        </select>
                    </div>

                </div>
            </form>
            <hr />
            <p style="text-align: center;">Powered by <a href="">mfikri.com</a></p>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#divisi').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "<?php echo base_url(); ?>contoh/get_produk",
                    method: "POST",
                    data: {
                        id: id
                    },
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option>' + data[i].nama_produk + '</option>';
                        }
                        $('.produk').html(html);

                    }
                });
            });
        });
    </script>
</body>

</html>