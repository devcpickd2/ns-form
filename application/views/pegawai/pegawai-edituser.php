<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Pegawai</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('pegawai')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Pegawai</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('pegawai/edituser/'.$pegawai->uuid);?>">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Username</label>
                            <input type="text" name="username" class="form-control <?= form_error('username') ? 'invalid' : '' ?> " value="<?= $pegawai->username;?>">
                            <div class="invalid-feedback <?= !empty(form_error('username')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('username') ?>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Password</label>
                            <input type="password" name="password" class="form-control <?= form_error('password') ? 'invalid' : '' ?> " placeholder="Masukkan Alamat E-mail" value="<?= $pegawai->password;?>">
                            <div class="invalid-feedback <?= !empty(form_error('password')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('password') ?>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-md btn-success mr-2">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="<?= base_url('pegawai')?>" class="btn btn-md btn-danger">
                                <i class="fa fa-times"></i> Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .breadcrumb{
        background-color: #2E86C1;
    }
</style>