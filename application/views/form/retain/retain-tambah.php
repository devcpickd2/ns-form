<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Retain Sample Report</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('retain')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Retain Sample Report</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('retain/tambah');?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?php echo date("Y-m-d") ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Plant</label>
                            <select name="plant" class="form-control <?= form_error('plant') ? 'invalid' : '' ?>" >
                                <option disabled selected>Pilih Plant</option>
                                <?php 
                                foreach($plant as $val){ ?>
                                   <option value="<?= $val->uuid; ?>" <?= set_select('plant', $val->uuid) ;?>><?= $val->plant; ?></option>
                               <?php } ?>
                           </select>
                           <div class="invalid-feedback <?= !empty(form_error('plant')) ? 'd-block' : '' ; ?> "><?= form_error('plant') ?></div>
                       </div>
                   </div>
                   <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Sample Type</label>
                        <input type="text" name="sample_type" class="form-control <?= form_error('sample_type') ? 'invalid' : '' ?> " value="<?= set_value('sample_type'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('sample_type')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('sample_type') ?>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Sample Storage</label>
                        <select name="sample_storage" class="form-control <?= form_error('sample_storage') ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="Dry" <?= set_value('sample_storage') == 'Dry' ? 'selected' : '' ?>>Dry</option>
                            <option value="Other" <?= set_value('sample_storage') == 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                        <div class="invalid-feedback <?= form_error('sample_storage') ? 'd-block' : '' ?>">
                            <?= form_error('sample_storage') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Description</label>
                        <input type="text" name="deskripsi" class="form-control <?= form_error('deskripsi') ? 'invalid' : '' ?> " value="<?= set_value('deskripsi'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('deskripsi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('deskripsi') ?>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Production Code</label>
                        <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?> " value="<?= set_value('kode_produksi'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('kode_produksi') ?>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Best Before</label>
                        <input type="date" name="best_before" class="form-control <?= form_error('best_before') ? 'invalid' : '' ?> " value="<?php echo date("Y-m-d") ?>">
                        <div class="invalid-feedback <?= !empty(form_error('best_before')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('best_before') ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Quantity</label>
                        <input type="text" name="quantity" class="form-control <?= form_error('quantity') ? 'invalid' : '' ?> " value="<?= set_value('quantity'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('quantity')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('quantity') ?>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Remarks</label>
                        <textarea class="form-control" name="remark"></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('remark')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('remark') ?>
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
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('retain')?>" class="btn btn-md btn-danger">
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