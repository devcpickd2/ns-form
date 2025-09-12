<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pengayakan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('pengayakan')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Laporan Pemeriksaan Pengayakan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('pengayakan/tambah');?>">
                    <?php
                    $produksi_input = $this->session->userdata('produksi_input');
                    $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                    $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                    ?>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                            value="<?= $tanggal ?>">
                            <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>" name="shift">
                                <option disabled <?= empty($shift) ? 'selected' : '' ?>>Pilih Shift</option>
                                <option value="1" <?= $shift == '1' ? 'selected' : '' ?>>Shift 1</option>
                                <option value="2" <?= $shift == '2' ? 'selected' : '' ?>>Shift 2</option>
                                <option value="3" <?= $shift == '3' ? 'selected' : '' ?>>Shift 3</option>
                            </select>
                            <div class="invalid-feedback <?= form_error('shift') ? 'd-block' : '' ?>">
                                <?= form_error('shift') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control <?= form_error('nama_barang') ? 'invalid' : '' ?> " placeholder="Masukkan Nama Barang" value="<?= set_value('nama_barang'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('nama_barang')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('nama_barang') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Kode Produksi</label>
                            <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?> " placeholder="Masukkan Kode Produksi" value="<?= set_value('kode_produksi'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kode_produksi') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Expired Date</label>
                            <input type="date" name="expired_date" class="form-control <?= form_error('expired_date') ? 'invalid' : '' ?> " value="<?php echo date('Y-m-d', strtotime('+1 year')) ?>">
                            <div class="invalid-feedback <?= !empty(form_error('expired_date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('expired_date') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Jumlah Barang</label>
                            <input type="text" name="jumlah_barang" class="form-control <?= form_error('jumlah_barang') ? 'invalid' : '' ?> " placeholder="Masukkan Jumlah Barang" value="<?= set_value('jumlah_barang'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('jumlah_barang')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('jumlah_barang') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="form-label font-weight-bold">Kontaminasi Benda Asing</label>
                    <div class="form-group row">
                        <br>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Screen Mess</label>
                            <input type="text" name="kba_screenmess" class="form-control <?= form_error('kba_screenmess') ? 'invalid' : '' ?> " value="<?= set_value('kba_screenmess'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kba_screenmess')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kba_screenmess') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kerikil</label>
                            <input type="text" name="kba_kerikil" class="form-control <?= form_error('kba_kerikil') ? 'invalid' : '' ?> " value="<?= set_value('kba_kerikil'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kba_kerikil')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kba_kerikil') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Benang</label>
                            <input type="text" name="kba_benang" class="form-control <?= form_error('kba_benang') ? 'invalid' : '' ?> " value="<?= set_value('kba_benang'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kba_benang')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kba_benang') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Kondisi Screen Ayakan</label>
                            <textarea class="form-control" name="kondisi" placeholder=""></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('kondisi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kondisi') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Catatan</label>
                            <textarea class="form-control" name="catatan"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('catatan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('catatan') ?>
                            </div>
                        </div>
                    </div>
                   <!--  <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Nama Produksi</label>
                            <select class="form-control <?= form_error('nama_produksi') ? 'invalid' : '' ?>" name="nama_produksi">
                                <option disabled selected>Pilih Nama Produksi</option>
                                <option value="Tia" <?= set_select('nama_produksi'); ?>>Tia</option>
                                <option value="Bagus" <?= set_select('nama_produksi'); ?>>Bagus</option>
                                <option value="Eman" <?= set_select('nama_produksi'); ?>>Eman</option>
                                <option value="Achmad" <?= set_select('nama_produksi'); ?>>Achmad</option>
                                <option value="Fikri" <?= set_select('nama_produksi'); ?>>Fikri</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('nama_produksi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('nama_produksi') ?>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-md btn-success mr-2">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="<?= base_url('pengayakan')?>" class="btn btn-md btn-danger">
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