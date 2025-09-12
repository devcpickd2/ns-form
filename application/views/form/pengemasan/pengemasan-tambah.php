<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pemeriksaan Proses Pengemasan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('pengemasan')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Pemeriksaan Proses Pengemasan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('pengemasan/tambah');?>" enctype="multipart/form-data">
                   <?php
                   $produksi_input = $this->session->userdata('produksi_input');
                   $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                   $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                   ?>
                   <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                        value="<?= $tanggal ?>">
                        <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                            <?= form_error('date') ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Pukul</label>
                        <input type="time" name="waktu" class="form-control <?= form_error('waktu') ? 'invalid' : '' ?> " value="<?php echo date("H:i") ?>">
                        <div class="invalid-feedback <?= !empty(form_error('waktu')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('waktu') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'invalid' : '' ?> " value="<?= set_value('nama_produk'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('nama_produk')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('nama_produk') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Kode Produksi</label>
                        <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?> " value="<?= set_value('kode_produksi'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('kode_produksi') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Best Before</label>
                        <input type="date" name="best_before" class="form-control <?= form_error('best_before') ? 'invalid' : '' ?> " value="<?php echo date('Y-m-d', strtotime('+1 year')) ?>">
                        <div class="invalid-feedback <?= !empty(form_error('best_before')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('best_before') ?>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Kondisi Produk</label>
                        <input type="text" name="kondisi_produk" class="form-control <?= form_error('kondisi_produk') ? 'invalid' : '' ?> " value="<?= set_value('kondisi_produk'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('kondisi_produk')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('kondisi_produk') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Kondisi Seal Kemasan</label>
                        <input type="text" name="kondisi_seal" class="form-control <?= form_error('kondisi_seal') ? 'invalid' : '' ?> " value="<?= set_value('kondisi_seal'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('kondisi_seal')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('kondisi_seal') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Berat Kotor per pack (gr)</label>
                        <input type="text" name="berat_pack" class="form-control <?= form_error('berat_pack') ? 'invalid' : '' ?> " value="<?= set_value('berat_pack'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('berat_pack')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('berat_pack') ?>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Berat Kotor per Renceng (gr)</label>
                        <input type="text" name="berat_renceng" class="form-control <?= form_error('berat_renceng') ? 'invalid' : '' ?> " value="<?= set_value('berat_renceng'); ?>">
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Berat Kotor per Inner Box (gr)</label>
                        <input type="text" name="berat_inner" class="form-control <?= form_error('berat_inner') ? 'invalid' : '' ?> " value="<?= set_value('berat_inner'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('berat_inner')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('berat_inner') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Berat Kotor per Binded (gr)</label>
                        <input type="text" name="berat_binded" class="form-control <?= form_error('berat_binded') ? 'invalid' : '' ?> " value="<?= set_value('berat_binded'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('berat_binded')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('berat_binded') ?>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Berat Kotor per carton (Kg)</label>
                        <input type="text" name="berat_carton" class="form-control <?= form_error('berat_carton') ? 'invalid' : '' ?> " value="<?= set_value('berat_carton'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('berat_carton')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('berat_carton') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Labelisasi Karton Box</label>
                        <input type="text" name="labelisasi" class="form-control <?= form_error('labelisasi') ? 'invalid' : '' ?> " value="<?= set_value('labelisasi'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('labelisasi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('labelisasi') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Kondisi Seal Karton Box</label>
                        <input type="text" name="kondisi_karton" class="form-control <?= form_error('kondisi_karton') ? 'invalid' : '' ?> " value="<?= set_value('kondisi_karton'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('kondisi_karton')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('kondisi_karton') ?>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Keterangan</label>
                        <textarea class="form-control" name="keterangan"></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('keterangan')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('keterangan') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('pengemasan')?>" class="btn btn-md btn-danger">
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