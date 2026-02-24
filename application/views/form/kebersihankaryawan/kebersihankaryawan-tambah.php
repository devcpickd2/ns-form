<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Tambah Kebersihan Karyawan</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= base_url('kebersihankaryawan') ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Karyawan
                </a>
            </li>
            <li class="breadcrumb-item active text-white" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form method="post" action="<?= base_url('kebersihankaryawan/tambah'); ?>" enctype="multipart/form-data">
                <!-- Tanggal & Shift -->
                <?php
                $produksi_input = $this->session->userdata('produksi_input');
                $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                ?>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                        value="<?= $tanggal ?>">
                        <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                            <?= form_error('date') ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
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
                </div>

                <!-- Nama & Bagian -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Nama</label>
                        <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback"><?= form_error('nama') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">Bagian</label>
                        <input type="text" name="bagian" value="<?= set_value('bagian'); ?>" class="form-control <?= form_error('bagian') ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback"><?= form_error('bagian') ?></div>
                    </div>
                </div>

                <hr>
                <label class="font-weight-bold">Kebersihan</label>

                <!-- Looping untuk radio group -->
                <div class="form-group row">
                    <?php
                    $kebersihan_items = [
                        'seragam' => 'Seragam',
                        'apron' => 'Apron',
                        'tangan_kuku' => 'Tangan dan Kuku',
                        'kosmetik' => 'Kosmetik',
                        'perhiasan' => 'Perhiasan',
                        'masker' => 'Masker',
                        'topi_hairnet' => 'Topi / Hairnet',
                        'sepatu' => 'Sepatu Kerja'
                    ];
                    $opsi = ['ok' => 'Ok', 'tidak oke' => 'Tidak Oke', 'tidak dipakai' => 'Tidak Dipakai'];
                    foreach ($kebersihan_items as $name => $label): ?>
                        <div class="col-md-3 mb-3">
                            <label class="font-weight-bold"><?= $label ?></label><br>
                            <?php foreach ($opsi as $val => $text): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="<?= $name ?>" value="<?= $val ?>" <?= set_value($name) == $val ? 'checked' : '' ?>>
                                    <label class="form-check-label"><?= $text ?></label>
                                </div>
                            <?php endforeach; ?>
                            <div class="invalid-feedback d-block"><?= form_error($name) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Tindakan & Catatan -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Tindakan Koreksi</label>
                        <textarea name="tindakan" class="form-control <?= form_error('tindakan') ? 'is-invalid' : '' ?>"><?= set_value('tindakan'); ?></textarea>
                        <div class="invalid-feedback"><?= form_error('tindakan') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold">Catatan</label>
                        <textarea name="catatan" class="form-control <?= form_error('catatan') ? 'is-invalid' : '' ?>"><?= set_value('catatan'); ?></textarea>
                        <div class="invalid-feedback"><?= form_error('catatan') ?></div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('kebersihankaryawan') ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .breadcrumb {
        background-color: #2E86C1;
    }

    .form-check-inline {
        margin-right: 10px;
    }

    textarea.form-control {
        height: 100px;
    }
</style>
