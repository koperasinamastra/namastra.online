<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-user"></i>
                        Input Pipeline Marketing
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
                            <h3 class="card-title">Input Pipeline</h3>
                        </div>
                        <div class="card-body">
                            <?php echo form_open_multipart('pipeline/simpanpipeline', '', 'formpipeline'); ?>
                            <div class="pesan" style="display: none;"></div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" value="<?php echo  $user['email']; ?>" readonly name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="cabang">Kode Cabang</label>
                                <input type="text" class="form-control" value="<?php echo  $user['kode_cabang']; ?>" readonly name="kode_cabang" id="kode_cabang">
                            </div>
                            <div class="form-group">
                                <label>Tanggal prospek</label>
                                <div class="input-group date" id="tglProspek" data-target-input="nearest">
                                    <input type="text" name="tgl_prospek" class="form-control datetimepicker-input" data-target="#tglProspek" />
                                    <div class="input-group-append" data-target="#tglProspek" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <?= form_error('tgl_prospek', '<small class="text-danger" pl-3>', '</small>'); ?>
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
                                <input type="text" class="form-control" name="tlfunding" id="tlfunding">
                                <?= form_error('tlfunding', '<small class="text-danger" pl-3>', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="fofunding">Funding Officer</label>
                                <input type="text" class="form-control" value="<?php echo $user['name']; ?>" readonly name="fofunding" id="fofunding">
                            </div>
                            <div class="form-group">
                                <label for="namaprospek">Nama Prospek</label>
                                <input type="text" class="form-control" name="namaprospek" id="namaprospek">
                                <?= form_error('namaprospek', '<small class="text-danger" pl-3>', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                                <?= form_error('alamat', '<small class="text-danger" pl-3>', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="nohp">No hp</label>
                                <input type="text" class="form-control" name="nohp" id="nohp">
                                <?= form_error('nohp', '<small class="text-danger" pl-3>', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="prospek">Status prospek</label>
                                <select class="form-control" id="prospek" name="prospek">
                                    <option value="">--Pilih Perkembangan Prospek--</option>
                                    <option value="P1">P1 - penawaran Produk</option>
                                    <option value="P2">P2 - Follow up</option>
                                    <option value="P3">P3 - Solusi prospek fix angka penempatan deoposito</option>
                                    <option value="P4">P4 - Closing Penempatan deposito</option>
                                </select>
                                <?= form_error('prospek', '<small class="text-danger" pl-3>', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="estimasiclosing">Estimasi closing</label>
                                <input type="text" class="form-control" name="estimasiclosing" id="estimasiclosing">
                            </div>
                            <div class="form-group">
                                <label for="closing">Closing</label>
                                <input type="text" class="form-control" name="closing" id="closing">
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Foto Prospek</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" accept=".jpg,.jpeg,.png">
                                        <label class=" custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url('pipeline') ?>" type="text" class="btn btn-warning">Kembali</a>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary" id="simpandata">Simpan</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
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
            $("#estimasiclosing").hide();
            $("#closing").hide();
            $('select[name="prospek"]').change(function() {
                if ($('select[name="prospek"] option:selected').val() == 'P4') {
                    $('#closing').show();
                    $("#estimasiclosing").val('0');
                    $("#estimasiclosing").prop("disabled", true);
                } else {
                    $('#closing').hide();
                    $("#estimasiclosing").removeProp("disabled", true);
                    $("#estimasiclosing").show();
                }
            });

        });

    });
</script>