<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelcabang').DataTable(

        );
        //Date picker
        $('#tglProspek').datetimepicker({
            format: 'L'
        });

        //set number adding row

        var set_number = function() {
            var table_len = $('#tabelpipeline tbody tr').length + 1;

            $('#no').val(table_len);
        }

        set_number();

        $('#tambahdata').click(function() {
            var no = $('#no').val();
            var tglProspek = $('#tglProspek').val();
            var cabang = $('#cabang').val();
            var tlfunding = $('#tlfunding').val();
            var fofunding = $('#fofunding').val();
            var alamat = $('#alamat').val();
            var nohp = $('#nohp').val();
            var estimasiclosing = $('#estimasiclosing').val();
            var closing = $('#closing').val();
            var prospek = $('#prospek').val();
            var image = $('#image').val();

            //append inputs to table

            $('#tabelpipeline tbody:last-child').append(

                '<tr>' +
                '<td>' + no + '</td>' +
                '<td>' + tglProspek + '</td>' +
                '<td>' + cabang + '</td>' +
                '<td>' + tlfunding + '</td>' +
                '<td>' + fofunding + '</td>' +
                '<td>' + alamat + '</td>' +
                '<td>' + nohp + '</td>' +
                '<td>' + estimasiclosing + '</td>' +
                '<td>' + closing + '</td>' +
                '<td>' + prospek + '</td>' +
                '<td>' + image + '</td>' +
                '</tr>'
            );

            //clear data input
            $('#no').val('');
            $('#tglProspek').val('');
            $('#cabang').val('');
            $('#tlfunding').val('');
            $('#fofunding').val('');
            $('#alamat').val('');
            $('#nohp').val('');
            $('#estimasiclosing').val('');
            $('#closing').val('');
            $('#prospek').val('');
            $('#image').val('');

            set_number();

        });

        $('#simpandata').click(function() {

            var tabelpipeline = [];

            $('#tabelpipeline tr').each(function(row, tr) {

                if ($(tr).find('td:eq(0)').text() == "") {

                } else {
                    var sub = {
                        'no': $(tr).find('td:eq(0)').text(),
                        'tglProspek': $(tr).find('td:eq(1)').text(),
                        'cabang': $(tr).find('td:eq(2)').text(),
                        'tlfunding': $(tr).find('td:eq(3)').text(),
                        'fofunding': $(tr).find('td:eq(4)').text(),
                        'alamat': $(tr).find('td:eq(5)').text(),
                        'nohp': $(tr).find('td:eq(6)').text(),
                        'estimasiclosing': $(tr).find('td:eq(7)').text(),
                        'closing': $(tr).find('td:eq(8)').text(),
                        'image': $(tr).find('td:eq(9)').text()
                    };

                    tabelpipeline.push(sub);
                }
            });

            swal({
                    title: 'Simpan Data kedalam database',
                    text: '',
                    type: '',
                    showloaderOnConfirm: true,
                    showCancelButton: true,
                    ConfirmButtonTex: 'yes',
                    closeOnConfirm: false
                },

                function() {
                    var data = {
                        'tabelpipeline': tabelpipeline
                    };
                    $.ajax({
                        data: data,
                        type: 'POST',
                        URL: '<?php echo base_url('pipeline/simpanpipeline'); ?>',
                        crossOrigin: false,
                        dataType: 'json',
                        success: function(result) {

                            console.log(result.check)
                        }
                    });

                });

        });
    });
</script>