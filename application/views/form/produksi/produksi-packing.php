<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Proses Verifikasi Pengemasan Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('produksi')?>" class="text-white">
                    <i class="fas fa-arrow-left"></i> Daftar Verifikasi Proses Pengemasan Produksi
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('produksi/packing/'.$produksi->uuid);?>" enctype="multipart/form-data">
                <?php
                $produksi_input = $this->session->userdata('produksi_input');

                $shift_default = !empty($produksi->shift_packing) 
                ? $produksi->shift_packing 
                : ($produksi_input['shift'] ?? '');
                ?>

                <label class="form-label font-weight-bold">Produk : <?= $produksi->nama_produk_asli ?? $produksi->nama_produk;?></label><br>
                <label class="form-label font-weight-bold">Kode Produksi : <?= $produksi->kode_produksi;?></label><br>
                <hr>

                <?php
                if (!empty($produksi->date_packing) && $produksi->date_packing != '0000-00-00' && $produksi->date_packing != '30-11-0000') {
                    $tanggal_default = date('Y-m-d', strtotime($produksi->date_packing));
                } else {
                    $tanggal_default = date('Y-m-d'); 
                }
                ?>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date_packing" 
                        class="form-control <?= form_error('date_packing') ? 'is-invalid' : '' ?>" 
                        value="<?= set_value('date_packing', $tanggal_default) ?>">
                        <div class="invalid-feedback <?= !empty(form_error('date_packing')) ? 'd-block' : '' ?>">
                            <?= form_error('date_packing') ?>
                        </div>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Shift</label>
                        <select name="shift_packing" class="form-control <?= form_error('shift_packing') ? 'is-invalid' : '' ?>">
                            <option value="1" <?= $shift_default == '1' ? 'selected' : '' ?>>Shift 1</option>
                            <option value="2" <?= $shift_default == '2' ? 'selected' : '' ?>>Shift 2</option>
                            <option value="3" <?= $shift_default == '3' ? 'selected' : '' ?>>Shift 3</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('shift_packing') ?>
                        </div>
                    </div>

                    <?php
                    $pukul_val = (!empty($produksi->pukul_packing) && $produksi->pukul_packing != "00:00:00")
                    ? date("H:i", strtotime($produksi->pukul_packing))
                    : date("H:i");
                    ?>
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Pukul</label>
                        <input type="time" name="pukul_packing" 
                        class="form-control <?= form_error('pukul_packing') ? 'is-invalid' : '' ?>" 
                        value="<?= set_value('pukul_packing', $pukul_val) ?>">
                        <div class="invalid-feedback">
                            <?= form_error('pukul_packing') ?>
                        </div>
                    </div>
                </div>

<!-- Kondisi Produk & Seal -->
<div class="form-group row">
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Kondisi Produk</label>
        <select name="kondisi_produk" class="form-control <?= form_error('kondisi_produk') ? 'is-invalid' : '' ?>">
            <option value="Oke" <?= ($produksi->kondisi_produk ?? '') == 'Oke' ? 'selected' : '' ?>>Oke</option>
            <option value="Tidak Oke" <?= ($produksi->kondisi_produk ?? '') == 'Tidak Oke' ? 'selected' : '' ?>>Tidak Oke</option>
        </select>
        <div class="invalid-feedback">
            <?= form_error('kondisi_produk') ?>
        </div>
    </div>
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Kondisi Seal</label>
        <select name="kondisi_seal" class="form-control <?= form_error('kondisi_seal') ? 'is-invalid' : '' ?>">
            <option value="Oke" <?= ($produksi->kondisi_seal ?? '') == 'Oke' ? 'selected' : '' ?>>Oke</option>
            <option value="Tidak Oke" <?= ($produksi->kondisi_seal ?? '') == 'Tidak Oke' ? 'selected' : '' ?>>Tidak Oke</option>
        </select>
        <div class="invalid-feedback">
            <?= form_error('kondisi_seal') ?>
        </div>
    </div>
</div>

<!-- Jenis Packing & Berat -->
<div class="form-group row">
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Jenis Kemasan</label>
        <select name="jenis_packing" class="form-control <?= form_error('jenis_packing') ? 'is-invalid' : '' ?>">
            <?php $jenis_packing = $produksi->jenis_packing ?? ''; ?>
            <option value="" disabled <?= $jenis_packing == '' ? 'selected' : '' ?>>-- Pilih Jenis Kemasan --</option>
            <option value="Per Pack" <?= $jenis_packing == 'Per Pack' ? 'selected' : '' ?>>Per Pack</option>
            <option value="Per Renceng" <?= $jenis_packing == 'Per Renceng' ? 'selected' : '' ?>>Per Renceng</option>
            <option value="Per Inner Box" <?= $jenis_packing == 'Per Inner Box' ? 'selected' : '' ?>>Per Inner Box</option>
            <option value="Per Binded" <?= $jenis_packing == 'Per Binded' ? 'selected' : '' ?>>Per Binded</option>
        </select>
        <div class="invalid-feedback">
            <?= form_error('jenis_packing') ?>
        </div>
    </div>
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Berat Kemasan (Gram)</label>
        <input type="text" name="berat" class="form-control <?= form_error('berat') ? 'is-invalid' : '' ?>" 
        value="<?= set_value('berat', $produksi->berat ?? '') ?>">
        <div class="invalid-feedback">
            <?= form_error('berat') ?>
        </div>
    </div>
</div>

<!-- Berat Karton & Kondisi Seal Karton -->
<div class="form-group row">
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Berat Kotor Karton</label>
        <input type="text" name="berat_kotor_karton" class="form-control <?= form_error('berat_kotor_karton') ? 'is-invalid' : '' ?>" 
        value="<?= set_value('berat_kotor_karton', $produksi->berat_kotor_karton ?? '') ?>">
        <div class="invalid-feedback">
            <?= form_error('berat_kotor_karton') ?>
        </div>
    </div>
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Kondisi Seal Karton</label>
        <select name="kondisi_seal_karton" class="form-control <?= form_error('kondisi_seal_karton') ? 'is-invalid' : '' ?>">
            <option value="Oke" <?= ($produksi->kondisi_seal_karton ?? '') == 'Oke' ? 'selected' : '' ?>>Oke</option>
            <option value="Tidak Oke" <?= ($produksi->kondisi_seal_karton ?? '') == 'Tidak Oke' ? 'selected' : '' ?>>Tidak Oke</option>
        </select>
        <div class="invalid-feedback">
            <?= form_error('kondisi_seal_karton') ?>
        </div>
    </div>
</div>

<!-- Labelisasi Karton -->
<div class="form-group row">
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Labelisasi Karton</label>
        <input type="file" name="labelisasi_karton" id="labelisasi_karton" 
        class="form-control <?= form_error('labelisasi_karton') ? 'is-invalid' : '' ?>" 
        accept="image/*,application/pdf">
        <input type="hidden" name="bukti_lama" value="<?= $produksi->labelisasi_karton ?? '' ?>">
        <?php if (!empty($produksi->labelisasi_karton)): ?>
            <a href="<?= base_url('uploads/packing/' . $produksi->labelisasi_karton); ?>" target="_blank">Lihat File Sebelumnya</a>
        <?php endif; ?>
        <div class="invalid-feedback">
            <?= form_error('labelisasi_karton') ?>
        </div>
    </div>
</div>

<!-- Catatan -->
<div class="form-group row">
    <div class="col-sm-6">
        <label class="form-label font-weight-bold">Catatan</label>
        <textarea class="form-control" name="catatan"><?= set_value('catatan', $produksi->catatan ?? '') ?></textarea>
        <div class="invalid-feedback">
            <?= form_error('catatan') ?>
        </div>
    </div>
</div>

<!-- Tombol -->
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
<style>
    .breadcrumb{ background-color: #2E86C1; }
</style>
