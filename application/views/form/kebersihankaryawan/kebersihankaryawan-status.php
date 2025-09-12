<div class="container-fluid">
    <!-- Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Kebersihan Karyawan</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kebersihankaryawan'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Karyawan
                </a>
            </li>
        </ol>
    </nav>

    <!-- Kartu Detail -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Keterangan & Simbol -->
            <div class="row mb-4">
                <div class="col-md-6 col-12">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light text-center">
                            <tr><th colspan="2">Keterangan Pemeriksaan</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>1. Seragam</td><td>5. Perhiasan</td></tr>
                            <tr><td>2. Apron</td><td>6. Masker</td></tr>
                            <tr><td>3. Tangan dan Kuku</td><td>7. Topi / Hairnet</td></tr>
                            <tr><td>4. Kosmetik</td><td>8. Sepatu Kerja</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-12">
                    <table class="table table-bordered table-sm text-center">
                        <thead class="thead-light">
                            <tr><th colspan="2">Simbol Keterangan</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>✔️</td><td>Ok</td></tr>
                            <tr><td>❌</td><td>Tidak Ok</td></tr>
                            <tr><td>−</td><td>Tidak Ada / Tidak Digunakan</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Pemeriksaan -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center bg-light font-weight-bold">
                        <tr><th colspan="9">PEMERIKSAAN KEBERSIHAN KARYAWAN</th></tr>
                    </thead>
                    <tbody>
                        <?php $tanggal = (new DateTime($kebersihankaryawan->date))->format('d-m-Y'); ?>
                        <tr><td><strong>Tanggal</strong></td><td colspan="8"><?= $tanggal; ?></td></tr>
                        <tr><td><strong>Shift</strong></td><td colspan="8"><?= $kebersihankaryawan->shift; ?></td></tr>
                        <tr><td><strong>Nama Karyawan</strong></td><td colspan="8"><?= $kebersihankaryawan->nama; ?></td></tr>
                        <tr><td><strong>Bagian</strong></td><td colspan="8"><?= $kebersihankaryawan->bagian; ?></td></tr>
                        <tr class="text-center bg-light font-weight-bold">
                            <td>Keterangan</td>
                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                <td><?= $i ?></td>
                            <?php endfor; ?>
                        </tr>
                        <tr class="text-center">
                            <td><strong>Hasil</strong></td>
                            <td><?= simbol($kebersihankaryawan->seragam); ?></td>
                            <td><?= simbol($kebersihankaryawan->apron); ?></td>
                            <td><?= simbol($kebersihankaryawan->tangan_kuku); ?></td>
                            <td><?= simbol($kebersihankaryawan->kosmetik); ?></td>
                            <td><?= simbol($kebersihankaryawan->perhiasan); ?></td>
                            <td><?= simbol($kebersihankaryawan->masker); ?></td>
                            <td><?= simbol($kebersihankaryawan->topi_hairnet); ?></td>
                            <td><?= simbol($kebersihankaryawan->sepatu); ?></td>
                        </tr>
                        <tr><td><strong>Tindakan Koreksi</strong></td><td colspan="8"><?= $kebersihankaryawan->tindakan; ?></td></tr>
                        <tr><td><strong>Catatan</strong></td><td colspan="8"><?= !empty($kebersihankaryawan->catatan) ? $kebersihankaryawan->catatan : 'Tidak ada'; ?></td></tr>
                        <tr class="text-center table-primary font-weight-bold"><td colspan="9">VERIFIKASI</td></tr>
                        <tr><td><strong>QC</strong></td><td colspan="8"><?= $kebersihankaryawan->username; ?></td></tr>
                        <tr><td><strong>Produksi</strong></td><td colspan="8"><?= $kebersihankaryawan->nama_produksi ?? 'Belum dikoreksi'; ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-5">
        <div class="card-body">
            <form method="post" action="<?= base_url('kebersihankaryawan/status/'.$kebersihankaryawan->uuid);?>">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= $kebersihankaryawan->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= $kebersihankaryawan->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback"><?= form_error('status_spv') ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= $kebersihankaryawan->catatan_spv; ?></textarea>
                        <div class="invalid-feedback"><?= form_error('catatan_spv') ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Simpan</button>
                        <a href="<?= base_url('kebersihankaryawan/verifikasi') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    .breadcrumb {
        background-color: #2E86C1;
        padding: 8px 16px;
        border-radius: 0.25rem;
    }

    .breadcrumb a {
        color: white;
        font-weight: bold;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .table td, .table th {
        vertical-align: middle;
        font-size: 15px;
        padding: 10px;
        white-space: normal; /* penting agar tidak terlalu lebar */
    }

    @media (max-width: 768px) {
        .table td, .table th {
            font-size: 14px;
        }

        h1.h3 {
            font-size: 20px;
        }
    }

    body {
        overflow-x: hidden;
    }
</style>

<?php
function simbol($val) {
    return $val == 'ok' ? '✔️' : ($val == 'tidak oke' ? '❌' : '−');
}
?>
