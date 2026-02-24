<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Proses Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('produksi')?>">
                    <i class="fas fa-arrow-left"></i> Daftar Laporan Verifikasi Proses Produksi
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('produksi/edit/'.$produksi->uuid);?>">

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?>" 
                        value="<?= $produksi->date; ?>">
                        <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?>">
                            <?= form_error('date') ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Shift</label>
                        <select class="form-control <?= form_error('shift') ? 'invalid' : '' ?>" name="shift">
                            <option value="1" <?= $produksi->shift == 1?'selected':'';?>>1</option>
                            <option value="2" <?= $produksi->shift == 2?'selected':'';?>>2</option>
                            <option value="3" <?= $produksi->shift == 3?'selected':'';?>>3</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ; ?>">
                            <?= form_error('shift') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Nama Produk</label>
                        <select id="nama-produk" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'invalid' : '' ?>" readonly>
                            <option disabled>Pilih Produk</option>
                            <?php foreach($produk as $p): ?>
                                <option
                                value="<?= $p->uuid ?>"
                                <?= ($produksi->nama_produk == $p->uuid) ? 'selected' : '' ?>>
                                <?= $p->nama_produk ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('nama_produk')) ? 'd-block' : '' ; ?>">
                        <?= form_error('nama_produk') ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="form-label font-weight-bold">Kode Produksi</label>
                    <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?>" 
                    value="<?= $produksi->kode_produksi; ?>">
                    <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?>">
                        <?= form_error('kode_produksi') ?>
                    </div>
                </div>
            </div>

            <label class="form-label font-weight-bold">RAW MATERIAL</label>
            <div id="form-rawmat-wrapper">
                <?php if(!empty($produksi->raw_mat)): ?>
                    <?php foreach($produksi->raw_mat as $i => $rm): ?>
                        <div class="rawmat-group border p-3 mb-3 rounded bg-light">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Nama Bahan</label>
                                    <input type="text" name="raw_nama[]" class="form-control" value="<?= $rm->nama ?>" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Kode Bahan</label>
                                    <input type="text" name="raw_kode[]" class="form-control" value="<?= $rm->kode ?>">
                                </div>
                                <div class="col-md-2">
                                    <label>Berat</label>
                                    <input type="text" name="raw_berat[]" class="form-control" value="<?= $rm->berat ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Sensori</label><br>
                                    <div class="d-flex gap-2">
                                        <input type="radio" class="btn-check" name="raw_sens[<?= $i ?>]" id="raw-oke-<?= $i ?>" value="oke" <?= $rm->sens == 'oke' ? 'checked' : '' ?>>
                                        <label class="btn btn-outline-success" for="raw-oke-<?= $i ?>">Oke</label>

                                        <input type="radio" class="btn-check" name="raw_sens[<?= $i ?>]" id="raw-tidak-<?= $i ?>" value="tidak" <?= $rm->sens == 'tidak' ? 'checked' : '' ?>>
                                        <label class="btn btn-outline-danger" for="raw-tidak-<?= $i ?>">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <label class="form-label font-weight-bold">PREMIX</label>
            <div id="form-premix-wrapper">
                <?php if(!empty($produksi->premix)): ?>
                    <?php foreach($produksi->premix as $i => $pm): ?>
                        <div class="premix-group border p-3 mb-3 rounded bg-light">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Nama Premix</label>
                                    <input type="text" name="premix_nama[]" class="form-control" value="<?= $pm->nama ?>" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Kode Premix</label>
                                    <input type="text" name="premix_kode[]" class="form-control" value="<?= $pm->kode ?>">
                                </div>
                                <div class="col-md-2">
                                    <label>Berat</label>
                                    <input type="text" name="premix_berat[]" class="form-control" value="<?= $pm->berat ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Sensori</label><br>
                                    <div class="d-flex gap-2">
                                        <input type="radio" class="btn-check" name="premix_sens[<?= $i ?>]" id="premix-oke-<?= $i ?>" value="oke" <?= $pm->sens == 'oke' ? 'checked' : '' ?>>
                                        <label class="btn btn-outline-success" for="premix-oke-<?= $i ?>">Oke</label>

                                        <input type="radio" class="btn-check" name="premix_sens[<?= $i ?>]" id="premix-tidak-<?= $i ?>" value="tidak" <?= $pm->sens == 'tidak' ? 'checked' : '' ?>>
                                        <label class="btn btn-outline-danger" for="premix-tidak-<?= $i ?>">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group row">
                <div class="col-sm-4">
                    <label class="form-label font-weight-bold">Hasil Mixing</label>
                    <select name="hasil_mixing" class="form-control <?= form_error('hasil_mixing') ? 'is-invalid' : '' ?>">
                        <option value="">-- Pilih --</option>
                        <option value="Oke" <?= $produksi->hasil_mixing == 'Oke' ? 'selected' : '' ?>>Oke</option>
                        <option value="Tidak Oke" <?= $produksi->hasil_mixing == 'Tidak Oke' ? 'selected' : '' ?>>Tidak Oke</option>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('hasil_mixing')) ? 'd-block' : '' ?>">
                        <?= form_error('hasil_mixing') ?>
                    </div>
                </div>

                <div class="col-sm-4">
                    <label class="form-label font-weight-bold">Waktu Mulai Mixing</label>
                    <input type="time" name="waktu_mulai_mixing" 
                    class="form-control <?= form_error('waktu_mulai_mixing') ? 'is-invalid' : '' ?>" 
                    value="<?= $produksi->waktu_mulai_mixing; ?>">
                    <div class="invalid-feedback <?= !empty(form_error('waktu_mulai_mixing')) ? 'd-block' : '' ?>">
                        <?= form_error('waktu_mulai_mixing') ?>
                    </div>
                </div>

                <div class="col-sm-4">
                    <label class="form-label font-weight-bold">Waktu Selesai Mixing</label>
                    <input type="time" name="waktu_selesai_mixing" 
                    class="form-control <?= form_error('waktu_selesai_mixing') ? 'is-invalid' : '' ?>" 
                    value="<?= $produksi->waktu_selesai_mixing; ?>">
                    <div class="invalid-feedback <?= !empty(form_error('waktu_selesai_mixing')) ? 'd-block' : '' ?>">
                        <?= form_error('waktu_selesai_mixing') ?>
                    </div>
                </div>
            </div>
            <hr>

            <label class="form-label font-weight-bold">SENSORI PRODUK</label>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label class="form-label font-weight-bold mb-2">Rasa</label>
                    <div class="form-check">
                        <input type="radio" name="sens_rasa" value="oke" <?= ($produksi->sens_rasa == 'oke') ? 'checked' : ''; ?>>
                        <label>Oke</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="sens_rasa" value="tidak" <?= ($produksi->sens_rasa == 'tidak') ? 'checked' : ''; ?>>
                        <label>Tidak</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label class="form-label font-weight-bold mb-2">Aroma</label>
                    <div class="form-check">
                        <input type="radio" name="sens_aroma" value="oke" <?= ($produksi->sens_aroma == 'oke') ? 'checked' : ''; ?>>
                        <label>Oke</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="sens_aroma" value="tidak" <?= ($produksi->sens_aroma == 'tidak') ? 'checked' : ''; ?>>
                        <label>Tidak</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label class="form-label font-weight-bold mb-2">Warna</label>
                    <div class="form-check">
                        <input type="radio" name="sens_warna" value="oke" <?= ($produksi->sens_warna == 'oke') ? 'checked' : ''; ?>>
                        <label>Oke</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="sens_warna" value="tidak" <?= ($produksi->sens_warna == 'tidak') ? 'checked' : ''; ?>>
                        <label>Tidak</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label class="form-label font-weight-bold mb-2">Tekstur</label>
                    <div class="form-check">
                        <input type="radio" name="sens_tekstur" value="oke" <?= ($produksi->sens_tekstur == 'oke') ? 'checked' : ''; ?>>
                        <label>Oke</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="sens_tekstur" value="tidak" <?= ($produksi->sens_tekstur == 'tidak') ? 'checked' : ''; ?>>
                        <label>Tidak</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Catatan</label>
                    <textarea class="form-control" name="catatan"><?= $produksi->catatan; ?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-md btn-success mr-2">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('produksi')?>" class="btn btn-md btn-danger">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<style>
    .breadcrumb{ background-color: #2E86C1; }
    /* Saat dipilih, warnanya solid */
    .btn-check:checked + .btn-outline-success {
        background-color: #198754;
        color: white;
        border-color: #198754;
    }

    .btn-check:checked + .btn-outline-danger {
        background-color: #dc3545;
        color: white;
        border-color: #dc3545;
    }
</style>
