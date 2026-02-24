<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Sanitasi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('sanitasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Sanitasi</a>
                </li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <?php 
                                $datetime = new datetime($sanitasi->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">PEMERIKSAAN SANITASI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;" colspan="2"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td style="text-align:left;" colspan="5"><b>Shift : <?= $sanitasi->shift;?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Pukul</td>
                                    <td colspan="5"><?= date('H:i', strtotime($sanitasi->waktu)); ?></td>
                                </tr>
                                <?php
                                $result = json_decode($sanitasi->area, true);
                                if (!is_array($result)) $result = [];
                                ?>
                                <tr>
                                    <th colspan="7" style="text-align:center;">Daftar Hasil Pemeriksaan</th>
                                </tr>
                                <tr>
                                    <th>Area</th>
                                    <th>Standar (ppm)</th>
                                    <th>Aktual</th>
                                    <th>Bukti</th>
                                    <th>Keterangan</th>
                                </tr>
                                <?php foreach ($result as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['sub_area']) ?></td>
                                        <td><?= htmlspecialchars($row['standar']) ?></td>
                                        <td><?= htmlspecialchars($row['aktual']) ?></td>
                                        <td>
                                            <?php if (!empty($row['gambar'])): ?>
                                                <img src="<?= base_url('uploads/sanitasi/' . $row['gambar']) ?>" alt="Bukti" style="width: 100px; height: auto;">
                                            <?php else: ?>
                                                <span class="text-muted">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td>Catatan</td>
                                    <td colspan="6"> <?= !empty($sanitasi->catatan) ? $sanitasi->catatan : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" colspan="7">VERIFIKASI</th>
                                </tr>
                                <tr>
                                    <td colspan="2">QC</td>
                                    <td colspan="5"><?= $sanitasi->username;?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Produksi</td>
                                    <td colspan="5"> <?= !empty($sanitasi->nama_produksi) ? $sanitasi->nama_produksi : 'Belum di koreksi'; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Diketahui Produksi</td>
                                    <td colspan="5">
                                        <?php
                                        if ($sanitasi->status_produksi == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($sanitasi->status_produksi == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                        } elseif ($sanitasi->status_produksi == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Catatan Produksi</td>
                                    <td colspan="5"><?= !empty($sanitasi->catatan_produksi) ? $sanitasi->catatan_produksi : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Disetujui Supervisor</td>
                                    <td colspan="5"><?php
                                    if ($sanitasi->status_spv == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($sanitasi->status_spv == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                    } elseif ($sanitasi->status_spv == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Catatan Supervisor</td>
                                <td colspan="5"><?= !empty($sanitasi->catatan_spv) ? $sanitasi->catatan_spv : 'Tidak ada'; ?></td>
                            </tr>
                        </tbody>
                    </table>    
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
        width: 50%; 
        font-size: 16px; 
        margin: 0 auto; 
    }
    .table, .table th, .table td {
        /*border: none;*/
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