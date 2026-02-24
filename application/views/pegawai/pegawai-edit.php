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
                <form class="user" method="post" action="<?= base_url('pegawai/edit/'.$pegawai->uuid);?>">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Nama Karyawan</label>
                            <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'invalid' : '' ?> " value="<?= $pegawai->nama;?>">
                            <div class="invalid-feedback <?= !empty(form_error('nama')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('nama') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">E-mail</label>
                            <input type="text" name="email" class="form-control <?= form_error('email') ? 'invalid' : '' ?> " value="<?= $pegawai->email;?>">
                            <div class="invalid-feedback <?= !empty(form_error('email')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('email') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Departemen</label>
                            <select name="departemen" class="form-control <?= form_error('departemen') ? 'invalid' : '' ?>" >
                                <option disabled selected>Pilih Departemen</option>
                                <?php 
                                foreach($departemen as $val){ ?>
                                    <option value="<?= $val->uuid; ?>" <?= set_select('departemen', $val->uuid) ;?> <?= $pegawai->departemen==$val->uuid?'selected':'';?>><?= $val->departemen; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('departemen')) ? 'd-block' : '' ; ?> "><?= form_error('departemen') ?></div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Plant</label>
                            <select name="plant" class="form-control <?= form_error('plant') ? 'invalid' : '' ?>" >
                                <option disabled selected>Pilih Plant</option>
                                <?php 
                                foreach($plant as $val){ ?>
                                   <option value="<?= $val->uuid; ?>" <?= set_select('plant', $val->uuid) ;?> <?= $pegawai->plant==$val->uuid?'selected':'';?>><?= $val->plant; ?></option>
                               <?php } ?>
                           </select>
                           <div class="invalid-feedback <?= !empty(form_error('plant')) ? 'd-block' : '' ; ?> "><?= form_error('plant') ?></div>
                       </div>
                   </div>
                   <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Tipe User</label>
                        <select class="form-control <?= form_error('tipe_user') ? 'invalid' : '' ?>" name="tipe_user">
                            <option value="0" <?= set_select('tipe_user', '0'); ?> <?= $pegawai->tipe_user == 0?'selected':'';?>>Admin</option>
                            <option value="1" <?= set_select('tipe_user', '1'); ?> <?= $pegawai->tipe_user == 1?'selected':'';?>>Manager</option>
                            <option value="2" <?= set_select('tipe_user', '2'); ?> <?= $pegawai->tipe_user == 2?'selected':'';?>>Supervisor</option>
                            <option value="3" <?= set_select('tipe_user', '3'); ?> <?= $pegawai->tipe_user == 3?'selected':'';?>>Foreman/Forelady Produksi</option>
                            <option value="8" <?= set_select('tipe_user', '8'); ?> <?= $pegawai->tipe_user == 8?'selected':'';?>>Foreman/Forelady QC</option>
                            <option value="4" <?= set_select('tipe_user', '4'); ?> <?= $pegawai->tipe_user == 4?'selected':'';?>>Inspector</option>
                            <option value="5" <?= set_select('tipe_user', '5'); ?> <?= $pegawai->tipe_user == 5?'selected':'';?>>Enginer</option>
                            <option value="6" <?= set_select('tipe_user', '6'); ?> <?= $pegawai->tipe_user == 6?'selected':'';?>>Warehouse</option>
                            <option value="7" <?= set_select('tipe_user', '7'); ?> <?= $pegawai->tipe_user == 7?'selected':'';?>>Lab</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('tipe_user')) ? 'd-block' : '' ; ?> "><?= form_error('tipe_user') ?></div>
                    </div>
                </div>
<!--                 <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Username</label>
                        <input type="text" name="username" class="form-control <?= form_error('username') ? 'invalid' : '' ?> " placeholder="Masukkan Username" value="<?= set_value('username'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('username')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('username') ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control <?= form_error('password') ? 'invalid' : '' ?> " placeholder="Masukkan Alamat E-mail" value="<?= set_value('password'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('password')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('password') ?>
                        </div>
                    </div>
                </div> -->
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