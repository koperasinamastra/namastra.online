<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row lg">
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        Halaman Dasborad
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
                            <h3 class="card-title">Form Edit User</h3>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('user/edituser'); ?>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" value="<?= $user['email'] ?>" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Gambar</label>
                                <div class="input-group">
                                    <div class="row mb-5">
                                        <div class="col-3 mb-3">
                                            <div class="custom-file">
                                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid img-thumbnail" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>