<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Monitoring False Rejection</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('falserejection')?>">
                    <i class="fas fa-arrow-left">
                    </i> Monitoring False Rejection</a>
                </li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('falserejection/edit/'.$falserejection->uuid);?>">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Nama Produk</label>
                            <div class="form-control-plaintext"><?= $falserejection->nama_produk; ?></div>
                            <div class="invalid-feedback <?= !empty(form_error('nama_produk')) ? 'd-block' : ''; ?>">
                                <?= form_error('nama_produk') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kode Produksi</label>
                            <div class="form-control-plaintext"><?= $falserejection->kode_produksi; ?></div>
                            <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : ''; ?>">
                                <?= form_error('kode_produksi') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date_false_rejection" class="form-control <?= form_error('date_false_rejection') ? 'invalid' : '' ?> " value="<?= $falserejection->date_false_rejection; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date_false_rejection')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date_false_rejection') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift_monitoring') ? 'invalid' : '' ?>" name="shift_monitoring">
                                <option value="1" <?= set_select('shift_monitoring', '1'); ?> <?= $falserejection->shift_monitoring == 1?'selected':'';?>>1</option>
                                <option value="2" <?= set_select('shift_monitoring', '2'); ?> <?= $falserejection->shift_monitoring == 2?'selected':'';?>>2</option>
                                <option value="3" <?= set_select('shift_monitoring', '3'); ?> <?= $falserejection->shift_monitoring == 3?'selected':'';?>>3</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('shift_monitoring')) ? 'd-block' : '' ; ?> "><?= form_error('shift') ?></div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Mesin</label>
                            <input type="text" name="no_mesin" class="form-control <?= form_error('no_mesin') ? 'invalid' : '' ?> " value="<?= $falserejection->no_mesin; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('no_mesin')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('no_mesin') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Jumlah Pack/Bag yang Tidak Lolos</label>
                            <input type="number" name="jumlah_tidak_lolos" class="form-control <?= form_error('jumlah_tidak_lolos') ? 'invalid' : '' ?> " value="<?= $falserejection->jumlah_tidak_lolos; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('jumlah_tidak_lolos')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('jumlah_tidak_lolos') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Jumlah Pack/Bag yang Terdapat Kontaminan</label>
                            <input type="number" name="jumlah_kontaminasi" class="form-control <?= form_error('jumlah_kontaminasi') ? 'invalid' : '' ?> " value="<?= $falserejection->jumlah_kontaminasi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('jumlah_kontaminasi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('jumlah_kontaminasi') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Jenis Kontaminan</label>
                            <input type="text" name="jenis_kontaminasi" class="form-control <?= form_error('jenis_kontaminasi') ? 'invalid' : '' ?> "value="<?= $falserejection->jenis_kontaminasi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('jenis_kontaminasi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('jenis_kontaminasi') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Posisi Kontaminasi</label>
                            <input type="text" name="posisi_kontaminasi" class="form-control <?= form_error('posisi_kontaminasi') ? 'invalid' : '' ?> " value="<?= $falserejection->posisi_kontaminasi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('posisi_kontaminasi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('posisi_kontaminasi') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">False Rejection</label>
                            <input type="text" name="false_rejection" class="form-control <?= form_error('false_rejection') ? 'invalid' : '' ?> " value="<?= $falserejection->false_rejection; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('false_rejection')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('false_rejection') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Catatan</label>
                            <input type="text" name="catatan" class="form-control <?= form_error('catatan') ? 'invalid' : '' ?> " value="<?= $falserejection->catatan; ?>">
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
                            <a href="<?= base_url('falserejection')?>" class="btn btn-md btn-danger">
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