<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Disposisi Produk dan Prosedur</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('disposisi')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Disposisi Produk dan Prosedur</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('disposisi/tambah');?>">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?php echo date("Y-m-d") ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label font-weight-bold">Nomor</label>
                            <input type="text" name="nomor" class="form-control <?= form_error('nomor') ? 'invalid' : '' ?> " value="<?= set_value('nomor'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('nomor')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('nomor') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Kepada</label>
                            <input type="text" name="kepada" class="form-control <?= form_error('kepada') ? 'invalid' : '' ?> " value="<?= set_value('kepada'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kepada')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kepada') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Disposisi</label><br>

                            <?php
                            $options = ['Produk', 'Prosedur', 'Material'];
                            $selected = set_value('disposisi');
                            ?>

                            <?php foreach ($options as $option): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input <?= form_error('disposisi') ? 'is-invalid' : '' ?>" 
                                    type="radio" 
                                    name="disposisi" 
                                    id="disposisi_<?= strtolower($option) ?>" 
                                    value="<?= $option ?>" 
                                    <?= $selected === $option ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="disposisi_<?= strtolower($option) ?>"><?= $option ?></label>
                                </div>
                            <?php endforeach; ?>

                            <div class="invalid-feedback d-block">
                                <?= form_error('disposisi') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Dasar Disposisi</label>
                            <textarea class="form-control" name="dasar_disposisi" style="width: 100%; height: 150px;"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('dasar_disposisi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('dasar_disposisi') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Uraian Disposisi</label>
                            <textarea class="form-control" name="uraian_disposisi" style="width: 100%; height: 150px;"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('uraian_disposisi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('uraian_disposisi') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Catatan</label>
                            <textarea class="form-control" name="catatan" style="width: 100%; height: 150px;"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('catatan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('catatan') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">CC</label>
                            <input type="text" name="cc" class="form-control <?= form_error('cc') ? 'invalid' : '' ?> " value="<?= set_value('cc'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('cc')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('cc') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-md btn-success mr-2">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="<?= base_url('disposisi')?>" class="btn btn-md btn-danger">
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