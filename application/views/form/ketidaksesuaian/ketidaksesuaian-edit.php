<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Ketidaksesuaian Produk</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('ketidaksesuaian')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Ketidaksesuaian Produk</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('ketidaksesuaian/edit/'.$ketidaksesuaian->uuid);?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?= $ketidaksesuaian->date; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift') ? 'invalid' : '' ?>" name="shift">
                                <option value="1" <?= set_select('shift', '1'); ?> <?= $ketidaksesuaian->shift == 1?'selected':'';?>>1</option>
                                <option value="2" <?= set_select('shift', '2'); ?> <?= $ketidaksesuaian->shift == 2?'selected':'';?>>2</option>
                                <option value="3" <?= set_select('shift', '3'); ?> <?= $ketidaksesuaian->shift == 3?'selected':'';?>>3</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ; ?> "><?= form_error('shift') ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Pukul</label>
                        <input type="time" name="waktu" class="form-control <?= form_error('waktu') ? 'invalid' : '' ?> " value="<?= $ketidaksesuaian->waktu; ?>">
                        <div class="invalid-feedback <?= !empty(form_error('waktu')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('waktu') ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'invalid' : '' ?> " value="<?= $ketidaksesuaian->nama_produk; ?>">
                        <div class="invalid-feedback <?= !empty(form_error('nama_produk')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('nama_produk') ?>
                        </div>
                    </div> 
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Uraian Ketidaksesuaian</label>
                        <textarea class="form-control" name="ketidaksesuaian"><?= $ketidaksesuaian->ketidaksesuaian; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('ketidaksesuaian')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('ketidaksesuaian') ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Analisis Penyebab / Kategori Bahaya</label>
                        <textarea class="form-control" name="penyebab"><?= $ketidaksesuaian->penyebab; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('penyebab')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('penyebab') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Tindakan / Disposisi</label>
                        <textarea class="form-control" name="tindakan"><?= $ketidaksesuaian->tindakan; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('tindakan')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('tindakan') ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Verifikasi</label>
                        <textarea class="form-control" name="verifikasi"><?= $ketidaksesuaian->verifikasi; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('verifikasi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('verifikasi') ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan</label>
                        <textarea class="form-control" name="catatan"><?= $ketidaksesuaian->catatan; ?></textarea>
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
                        <a href="<?= base_url('ketidaksesuaian')?>" class="btn btn-md btn-danger">
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