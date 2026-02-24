<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Pemeriksaan Proses Pengemasan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('pengemasan')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Pemeriksaan Proses Pengemasan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('pengemasan/edit/'.$pengemasan->uuid);?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?= $pengemasan->date; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift') ? 'invalid' : '' ?>" name="shift">
                                <option value="1" <?= set_select('shift', '1'); ?> <?= $pengemasan->shift == 1?'selected':'';?>>1</option>
                                <option value="2" <?= set_select('shift', '2'); ?> <?= $pengemasan->shift == 2?'selected':'';?>>2</option>
                                <option value="3" <?= set_select('shift', '3'); ?> <?= $pengemasan->shift == 3?'selected':'';?>>3</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ; ?> "><?= form_error('shift') ?></div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Pukul</label>
                            <input type="time" name="waktu" class="form-control <?= form_error('waktu') ? 'invalid' : '' ?> " value="<?= $pengemasan->waktu; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('waktu')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('waktu') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'invalid' : '' ?> " value="<?= $pengemasan->nama_produk; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('nama_produk')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('nama_produk') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kode Produksi</label>
                            <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?> " value="<?= $pengemasan->kode_produksi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kode_produksi') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Best Before</label>
                            <input type="date" name="best_before" class="form-control <?= form_error('best_before') ? 'invalid' : '' ?> " value="<?= $pengemasan->best_before; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('best_before')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('best_before') ?>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kondisi Produk</label>
                            <input type="text" name="kondisi_produk" class="form-control <?= form_error('kondisi_produk') ? 'invalid' : '' ?> " value="<?= $pengemasan->kondisi_produk; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kondisi_produk')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kondisi_produk') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kondisi Seal Kemasan</label>
                            <input type="text" name="kondisi_seal" class="form-control <?= form_error('kondisi_seal') ? 'invalid' : '' ?> " value="<?= $pengemasan->kondisi_seal; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kondisi_seal')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kondisi_seal') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Berat Kotor per pack (gram)</label>
                            <input type="text" name="berat_pack" class="form-control <?= form_error('berat_pack') ? 'invalid' : '' ?> " value="<?= $pengemasan->berat_pack; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('berat_pack')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('berat_pack') ?>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Berat Kotor per Renceng (gr)</label>
                            <input type="text" name="berat_renceng" class="form-control <?= form_error('berat_renceng') ? 'invalid' : '' ?> " value="<?= $pengemasan->berat_renceng; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('berat_renceng')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('berat_renceng') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Berat Kotor per Inner Box (gr)</label>
                            <input type="text" name="berat_inner" class="form-control <?= form_error('berat_inner') ? 'invalid' : '' ?> " value="<?= $pengemasan->berat_inner; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('berat_inner')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('berat_inner') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Berat Kotor per Binded (gr)</label>
                            <input type="text" name="berat_binded" class="form-control <?= form_error('berat_binded') ? 'invalid' : '' ?> " value="<?= $pengemasan->berat_binded; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('berat_binded')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('berat_binded') ?>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Berat Kotor per carton (Kg)</label>
                            <input type="text" name="berat_carton" class="form-control <?= form_error('berat_carton') ? 'invalid' : '' ?> " value="<?= $pengemasan->berat_carton; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('berat_carton')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('berat_carton') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Labelisasi Karton Box</label>
                            <input type="text" name="labelisasi" class="form-control <?= form_error('labelisasi') ? 'invalid' : '' ?> " value="<?= $pengemasan->labelisasi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('labelisasi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('labelisasi') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kondisi Seal Karton Box</label>
                            <input type="text" name="kondisi_karton" class="form-control <?= form_error('kondisi_karton') ? 'invalid' : '' ?> " value="<?= $pengemasan->kondisi_karton; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kondisi_karton')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kondisi_karton') ?>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="keterangan"><?= $pengemasan->keterangan; ?></textarea>
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