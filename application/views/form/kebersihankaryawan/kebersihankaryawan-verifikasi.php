<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Daftar Kebersihan Karyawan</h1>
    </div>

    <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success text-center">
            <i class="fas fa-check"></i> <?= $this->session->flashdata('success_msg') ?>
        </div>
    <?php endif ?>

    <?php if($this->session->flashdata('error_msg')): ?>
        <div class="alert alert-danger text-center">
            <i class="fas fa-times"></i> <?= $this->session->flashdata('error_msg') ?>
        </div>
    <?php endif ?> 

    <div class="card shadow mb-4">
        <div class="card-body">

            <!-- Keterangan Pemeriksaan -->
            <div class="d-flex flex-wrap gap-3 mb-4">
                <table class="table table-bordered table-sm" style="flex: 1 1 300px; max-width: 400px;">
                    <thead class="thead-light text-center">
                        <tr>
                            <th colspan="2" style="background-color: #ADD8E6; color: gray;">Keterangan Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>1. Seragam</td><td>5. Perhiasan</td></tr>
                        <tr><td>2. Apron</td><td>6. Masker</td></tr>
                        <tr><td>3. Tangan dan Kuku</td><td>7. Topi / Hairnet</td></tr>
                        <tr><td>4. Kosmetik</td><td>8. Sepatu Kerja</td></tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-sm text-center" style="flex: 1 1 200px;">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="2" style="background-color: #ADD8E6; color: gray;">Simbol Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>✔️</td><td>Ok</td></tr>
                        <tr><td>❌</td><td>Tidak Ok</td></tr>
                        <tr><td>−</td><td>Tidak Ada / Tidak Digunakan</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Filter Tanggal Cetak -->
            <form action="<?= base_url('kebersihankaryawan/cetak') ?>" method="post" class="form-inline mb-4">
                <label class="mr-2">Pilih Tanggal:</label>
                <input type="date" name="tanggal" class="form-control mr-2" required>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-print"></i> Cetak PDF
                </button>
            </form>

            <!-- Data Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2">No</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Bagian</th>
                            <th colspan="8" class="text-center">Kebersihan</th>
                            <th rowspan="2">Tindakan Koreksi</th>
                            <th rowspan="2">Last Updated</th>
                            <th rowspan="2">Last Verified</th>
                            <th rowspan="2">SPV</th>
                            <th rowspan="2" class="text-center">Action</th>
                        </tr>
                        <tr>
                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                <th><?= $i ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($kebersihankaryawan as $val): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= (new DateTime($val->date))->format('d-m-Y'); ?></td>
                            <td><?= $val->nama; ?></td>
                            <td><?= $val->bagian; ?></td>
                            <td class="text-center"><?= simbol($val->seragam); ?></td>
                            <td class="text-center"><?= simbol($val->apron); ?></td>
                            <td class="text-center"><?= simbol($val->tangan_kuku); ?></td>
                            <td class="text-center"><?= simbol($val->kosmetik); ?></td>
                            <td class="text-center"><?= simbol($val->perhiasan); ?></td>
                            <td class="text-center"><?= simbol($val->masker); ?></td>
                            <td class="text-center"><?= simbol($val->topi_hairnet); ?></td>
                            <td class="text-center"><?= simbol($val->sepatu); ?></td>
                            <td><?= $val->tindakan; ?></td>
                            <td><?= date('H:i - d m Y', strtotime($val->modified_at)); ?></td>
                            <td><?= date('H:i - d m Y', strtotime($val->tgl_update_spv)); ?></td>
                            <td class="text-center">
                                <?php
                                echo match ((int) $val->status_spv) {
                                    0 => '<span style="color: #99a3a4; font-weight: bold;">Created</span>',
                                    1 => '<span style="color: #28b463; font-weight: bold;">Verified</span>',
                                    2 => '<span style="color: red; font-weight: bold;">Revision</span>',
                                };
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('kebersihankaryawan/status/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
                                    <span class="text">Verifikasi</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<style> 
    th {
        background-color: #f8f9fc;
    }
    .form-inline label {
        font-weight: bold;
    }
    .form-inline input[type="date"] {
        width: auto;
    }
</style>

<?php
function simbol($val) {
    return $val == 'ok' ? '✔️' : ($val == 'tidak oke' ? '❌' : '−');
}
?>
