<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kebersihan Karyawan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kebersihankaryawan'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Karyawan</a>
                </li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <div class="table-responsive">
                        <div style="display: flex; gap: 20px; align-items: flex-start;">

                            <!-- KETERANGAN DI KIRI -->
                            <div style="flex: 1;">
                                <!-- Tabel Keterangan Pemeriksaan -->
                                <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 14px;">
                                    <thead style="background-color: #f2f2f2;">
                                        <tr>
                                            <th colspan="2" style="padding: 10px; background-color: #ADD8E6; color: gray;">Keterangan Pemeriksaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1. Seragam</td>
                                            <td>5. Perhiasan</td>
                                        </tr>
                                        <tr>
                                            <td>2. Apron</td>
                                            <td>6. Masker</td>
                                        </tr>
                                        <tr>
                                            <td>3. Tangan dan Kuku</td>
                                            <td>7. Topi / Hairnet</td>
                                        </tr>
                                        <tr>
                                            <td>4. Kosmetik</td>
                                            <td>8. Sepatu Kerja</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <br>

                                <!-- Tabel Simbol Keterangan -->
                                <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 14px; text-align: center;">
                                    <thead style="background-color: #f2f2f2;">
                                        <tr>
                                            <th colspan="2" style="padding: 10px; background-color: #ADD8E6; color: gray;">Simbol Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>✔️</td>
                                            <td>Ok</td>
                                        </tr>
                                        <tr>
                                            <td>❌</td>
                                            <td>Tidak Ok</td>
                                        </tr>
                                        <tr>
                                            <td>−</td>
                                            <td>Tidak Ada / Tidak Digunakan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- DETAIL PEMERIKSAAN DI KANAN -->
                            <div style="flex: 2;">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <?php 
                                        $datetime = new DateTime($kebersihankaryawan->date);
                                        $datetime = $datetime->format('d-m-Y');
                                        ?>
                                        <tr>
                                            <th style="text-align:center;" colspan="9">KEBERSIHAN KARYAWAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align:left;" colspan="4"><b>Tanggal: <?= $datetime; ?></b></td>
                                            <td colspan="5"><b>Shift: <?= $kebersihankaryawan->shift; ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><b>Nama Karyawan</b></td>
                                            <td colspan="6"><?= $kebersihankaryawan->nama; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><b>Bagian</b></td>
                                            <td colspan="6"><?= $kebersihankaryawan->bagian; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center;" colspan="9">KEBERSIHAN</th>
                                        </tr>
                                        <tr>
                                            <td><b>Keterangan</b></td>
                                            <td><b>1</b></td>
                                            <td><b>2</b></td>
                                            <td><b>3</b></td>
                                            <td><b>4</b></td>
                                            <td><b>5</b></td>
                                            <td><b>6</b></td>
                                            <td><b>7</b></td>
                                            <td><b>8</b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Hasil</b></td>
                                            <td><?= ($kebersihankaryawan->seragam == 'ok') ? '✔️' : (($kebersihankaryawan->seragam == 'tidak oke') ? '❌' : '−'); ?></td>
                                            <td><?= ($kebersihankaryawan->apron == 'ok') ? '✔️' : (($kebersihankaryawan->apron == 'tidak oke') ? '❌' : '−'); ?></td>
                                            <td><?= ($kebersihankaryawan->tangan_kuku == 'ok') ? '✔️' : (($kebersihankaryawan->tangan_kuku == 'tidak oke') ? '❌' : '−'); ?></td>
                                            <td><?= ($kebersihankaryawan->kosmetik == 'ok') ? '✔️' : (($kebersihankaryawan->kosmetik == 'tidak oke') ? '❌' : '−'); ?></td>
                                            <td><?= ($kebersihankaryawan->perhiasan == 'ok') ? '✔️' : (($kebersihankaryawan->perhiasan == 'tidak oke') ? '❌' : '−'); ?></td>
                                            <td><?= ($kebersihankaryawan->masker == 'ok') ? '✔️' : (($kebersihankaryawan->masker == 'tidak oke') ? '❌' : '−'); ?></td>
                                            <td><?= ($kebersihankaryawan->topi_hairnet == 'ok') ? '✔️' : (($kebersihankaryawan->topi_hairnet == 'tidak oke') ? '❌' : '−'); ?></td>
                                            <td><?= ($kebersihankaryawan->sepatu == 'ok') ? '✔️' : (($kebersihankaryawan->sepatu == 'tidak oke') ? '❌' : '−'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Tindakan Koreksi</td>
                                            <td colspan="6"><?= $kebersihankaryawan->tindakan;?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Catatan</td>
                                            <td colspan="6"> <?= !empty($kebersihankaryawan->catatan) ? $kebersihankaryawan->catatan : 'Tidak ada'; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center;" colspan="9">VERIFIKASI</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3">QC</td>
                                            <td colspan="6"><?= $kebersihankaryawan->username;?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align:left">Produksi</td>
                                            <td colspan="6"><?= $kebersihankaryawan->nama_produksi;?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align:left">Diketahui Produksi</td>
                                            <td colspan="6">
                                                <?php
                                                if ($kebersihankaryawan->status_produksi == 0) {
                                                    echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                                } elseif ($kebersihankaryawan->status_produksi == 1) {
                                                    echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                                } elseif ($kebersihankaryawan->status_produksi == 2) {
                                                    echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align:left">Catatan Produksi</td>
                                            <td colspan="6"><?= !empty($kebersihankaryawan->catatan_produksi) ? $kebersihankaryawan->catatan_produksi : 'Tidak ada'; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Disetujui Supervisor</td>
                                            <td colspan="6"><?php
                                            if ($kebersihankaryawan->status_spv == 0) {
                                                echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                            } elseif ($kebersihankaryawan->status_spv == 1) {
                                                echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                            } elseif ($kebersihankaryawan->status_spv == 2) {
                                                echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                            }
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Catatan Supervisor</td>
                                        <td colspan="6"><?= !empty($kebersihankaryawan->catatan_spv) ? $kebersihankaryawan->catatan_spv : 'Tidak ada'; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<style type="text/css">
    .breadcrumb {
        background-color: #2E86C1;
    }
    .no-border {
        border: none;
        box-shadow: none;
    }
    .table {
        width: 100%; 
        font-size: 16px; 
        margin: 0 auto; 
    }
    .table, .table th, .table td {
        border: none;
    }
    .table th, .table td {
        padding: 6px 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        word-wrap: break-word;
        white-space: normal !important;
    }
    .table td {
        white-space: nowrap;
    }
</style>


