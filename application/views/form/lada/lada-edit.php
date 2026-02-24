<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Pemeriksaan Giling Lada</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('lada')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Laporan Pemeriksaan Giling Lada</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('lada/edit/'.$lada->uuid);?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?= $lada->date; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift') ? 'invalid' : '' ?>" name="shift">
                                <option value="1" <?= set_select('shift', '1'); ?> <?= $lada->shift == 1?'selected':'';?>>1</option>
                                <option value="2" <?= set_select('shift', '2'); ?> <?= $lada->shift == 2?'selected':'';?>>2</option>
                                <option value="3" <?= set_select('shift', '3'); ?> <?= $lada->shift == 3?'selected':'';?>>3</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ; ?> "><?= form_error('shift') ?></div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Pukul</label>
                            <input type="time" name="pukul" class="form-control <?= form_error('pukul') ? 'invalid' : '' ?> " value="<?= $lada->pukul; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('pukul')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('pukul') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kode Produksi</label>
                            <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?> " value="<?= $lada->kode_produksi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kode_produksi') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Suhu Produk (STD Min 35°C)</label>
                            <input type="text" name="suhu_produk" class="form-control <?= form_error('suhu_produk') ? 'invalid' : '' ?> " value="<?= $lada->suhu_produk; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('suhu_produk')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('suhu_produk') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Hasil Giling</label>
                            <input type="text" name="hasil_giling" class="form-control <?= form_error('hasil_giling') ? 'invalid' : '' ?> " value="<?= $lada->hasil_giling; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('hasil_giling')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('hasil_giling') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kadar Air (STD 9 - 12 %)</label>
                            <input type="text" name="kadar_air" class="form-control <?= form_error('kadar_air') ? 'invalid' : '' ?> " value="<?= $lada->kadar_air; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kadar_air')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kadar_air') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="keterangan"><?= $lada->keterangan; ?></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('keterangan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('keterangan') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Catatan</label>
                            <textarea class="form-control" name="catatan"><?= $lada->catatan; ?></textarea>
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
                            <a href="<?= base_url('lada')?>" class="btn btn-md btn-danger">
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