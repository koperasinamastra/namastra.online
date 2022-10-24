<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Edit Pipeline
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Pipeline</h3>
                        </div>
                        <div class="card-body">
                            <?php echo form_open_multipart('pipeline/updatepipeline'); ?>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $pipeline['id_pipline']; ?>" hidden name="id_pipline" id="id_pipline">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo $pipeline['kode_cabang']; ?>" hidden name="kode_cabang" id="kode_cabang">
                            </div>
                            <div class="form-group">
                                <label>Tanggal prospek</label>
                                <div class="input-group date" id="tglProspek" data-target-input="nearest">
                                    <input type="text" name="tgl_prospek" value="<?php echo $pipeline['tgl_prospek']; ?>" class="form-control datetimepicker-input" data-target="#tglProspek" />
                                    <div class="input-group-append" data-target="#tglProspek" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Produk">produk</label>
                                <select name="produk" id="produk" class="form-control">
                                    <option value="0">--PILIH Produk--</option>
                                    <?php foreach ($produk as $row) : ?>
                                        <option value="<?php echo $row->id_produk; ?>"><?php echo $row->nama_produk; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= form_error('produk', '<small class="text-danger" pl-3>', '</small>'); ?>
                            <div class="form-group">
                                <label for="tlfunding">TL Funding</label>
                                <input type="text" class="form-control" value="<?php echo $pipeline['tl_funding']; ?>" name="tlfunding" id="tlfunding">
                            </div>
                            <div class="form-group">
                                <label for="fofunding">Funding Officer</label>
                                <input type="text" class="form-control" value="<?php echo $pipeline['funding_officer']; ?>" readonly name="fofunding" id="fofunding">
                            </div>
                            <div class="form-group">
                                <label for="namaprospek">Nama Prospek</label>
                                <input type="text" class="form-control" name="namaprospek" value="<?php echo $pipeline['nama_prospek']; ?>" id="namaprospek">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input class="form-control" id="alamat" rows="3" value="<?php echo $pipeline['alamat']; ?>" name="alamat"></input>
                            </div>
                            <div class="form-group">
                                <label for="nohp">No hp</label>
                                <input type="text" class="form-control" name="nohp" value="<?php echo $pipeline['nohp']; ?>" id="nohp">
                            </div>
                            <div class="form-group">
                                <label for="prospek">Status prospek</label>
                                <select class="form-control" id="prospek" name="prospek">
                                    <option <?php if ($pipeline['pipline'] == 0) {
                                                echo 'selected';
                                            } ?> value="P1">P1 - penawaran Produk</option>
                                    <option <?php if ($pipeline['pipline']  == 1) {
                                                echo 'selected';
                                            } ?> value="P2">P2 - Follow up</option>
                                    <option <?php if ($pipeline['pipline']  == 2) {
                                                echo 'selected';
                                            } ?> value="P3">P3 - Solusi prospek fix angka penempatan deoposito</option>
                                    <option <?php if ($pipeline['pipline']  == 3) {
                                                echo 'selected';
                                            } ?> value="P4">P4 - Closing Penempatan deposito</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estimasiclosing">Estimasi closing</label>
                                <input type="text" class="form-control" readonly name="estimasiclosing" value="<?php echo $pipeline['estimasi_close'] ?>" id="estimasiclosing">
                            </div>
                            <div class="form-group">
                                <label for="closing">Closing</label>
                                <input type="text" class="form-control" name="closing" value="<?php echo $pipeline['closing'] ?>" id="closing">
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Gambar</label>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <img class="img-fluid img-thumbnail" src="<?php echo base_url('./uploads/prospek/') . $pipeline['upload_img']; ?>" alt="Card image cap">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url('pipeline') ?>" type="text" class="btn btn-warning">Kembali</a>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary" id="simpandata">Update</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelcabang').DataTable(

        );
        //Date picker
        $('#tglProspek').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD'
        });

        $(document).ready(function() {
            $("#closing").hide();
            $('select[name="prospek"]').change(function() {
                if ($('select[name="prospek"] option:selected').val() == 'P4') {
                    $('#closing').show();
                    $("#estimasiclosing").val('0');
                } else {
                    $('#closing').hide();
                    $("#estimasiclosing").show();
                    $(this).removeAttr('readonly');

                }
            });

        });

    });
</script>