<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Pengayakan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('pengayakan')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Laporan Pemeriksaan Pengayakan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('pengayakan/edit/'.$pengayakan->uuid);?>">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?= $pengayakan->date; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift') ? 'invalid' : '' ?>" name="shift">
                                <option value="1" <?= set_select('shift', '1'); ?> <?= $pengayakan->shift == 1?'selected':'';?>>1</option>
                                <option value="2" <?= set_select('shift', '2'); ?> <?= $pengayakan->shift == 2?'selected':'';?>>2</option>
                                <option value="3" <?= set_select('shift', '3'); ?> <?= $pengayakan->shift == 3?'selected':'';?>>3</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('shift') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control <?= form_error('nama_barang') ? 'invalid' : '' ?> " value="<?= $pengayakan->nama_barang; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('nama_barang')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('nama_barang') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Kode Produksi</label>
                            <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?> " value="<?= $pengayakan->kode_produksi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kode_produksi') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Expired Date</label>
                            <input type="date" name="expired_date" class="form-control <?= form_error('expired_date') ? 'invalid' : '' ?> " value="<?= $pengayakan->expired_date; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('expired_date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('expired_date') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Jumlah Barang</label>
                            <input type="text" name="jumlah_barang" class="form-control <?= form_error('jumlah_barang') ? 'invalid' : '' ?> " value="<?= $pengayakan->jumlah_barang; ?>">
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
                            <input type="text" name="kba_screenmess" class="form-control <?= form_error('kba_screenmess') ? 'invalid' : '' ?> " value="<?= $pengayakan->kba_screenmess; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kba_screenmess')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kba_screenmess') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kerikil</label>
                            <input type="text" name="kba_kerikil" class="form-control <?= form_error('kba_kerikil') ? 'invalid' : '' ?> " value="<?= $pengayakan->kba_kerikil; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kba_kerikil')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kba_kerikil') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Benang</label>
                            <input type="text" name="kba_benang" class="form-control <?= form_error('kba_benang') ? 'invalid' : '' ?> " value="<?= $pengayakan->kba_benang; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kba_benang')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kba_benang') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Kondisi Screen Ayakan</label>
                            <textarea class="form-control" name="kondisi" ><?= $pengayakan->kondisi; ?></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('kondisi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kondisi') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">  
                            <label class="form-label font-weight-bold">Catatan</label>
                            <textarea class="form-control" name="catatan" ><?= $pengayakan->catatan; ?></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('catatan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('catatan') ?>
                            </div>
                        </div>
                    </div>
                   <!--  <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Nama Produksi</label>
                            <select class="form-control <?= form_error('nama_produksi') ? 'invalid' : '' ?>" name="nama_produksi">
                                <option value="Tia" <?= $pengayakan->nama_produksi=="Tia"?'selected':'';?>>Tia</option>
                                <option value="Bagus" <?= $pengayakan->nama_produksi=="Bagus"?'selected':'';?>>Bagus</option>
                                <option value="Eman" <?= $pengayakan->nama_produksi=="Eman"?'selected':'';?>>Eman</option>
                                <option value="Achmad" <?= $pengayakan->nama_produksi=="Achmad"?'selected':'';?>>Achmad</option>
                                <option value="Fikri" <?= $pengayakan->nama_produksi=="Fikri"?'selected':'';?>>Fikri</option>
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