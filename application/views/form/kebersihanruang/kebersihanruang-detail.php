<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kebersihan Ruang Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kebersihanruang'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Ruang Produksi</a>
                </li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <div class="table-responsive">
                        <?php 
                        $datetime = new DateTime($kebersihanruang->date);
                        $datetime = $datetime->format('d-m-Y');
                        $details = json_decode($kebersihanruang->detail, true);
                        ?>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="text-align:center;" colspan="6">KEBERSIHAN RUANG PRODUKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" style="text-align:left;"><b>Tanggal: <?= $datetime; ?></b></td>
                                    <td colspan="4"><b>Shift: <?= $kebersihanruang->shift; ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:left"><b>Lokasi</b></td>
                                    <td colspan="4"><?= htmlspecialchars($kebersihanruang->lokasi); ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" colspan="6">DETAIL PEMERIKSAAN</th>
                                </tr>
                                <tr style="background-color:#2E86C1; color:#fff; text-align:center;">
                                    <th>No</th>
                                    <th colspan="2">Bagian</th>
                                    <th>Kondisi</th>
                                    <th>Problem</th>
                                    <th>Tindakan</th>
                                </tr>
                                <?php if (!empty($details) && is_array($details)) : ?>
                                <?php 
                                $kondisiMap = [
                                    '0' => 'Bersih',
                                    '1' => 'Berdebu',
                                    '2' => 'Basah',
                                    '3' => 'Pecah/Retak',
                                    '4' => 'Sisa produksi (terigu/produk)',
                                    '5' => 'Noda (tinta, karat)',
                                    '6' => 'Pertumbuhan mikroorganisme (jamur/bau busuk)',
                                ];
                                foreach ($details as $i => $row) : 
                                    ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $i + 1; ?></td>
                                        <td colspan="2"><?= htmlspecialchars($row['bagian']); ?></td>
                                        <td style="text-align:center;"><?= isset($kondisiMap[$row['kondisi']]) ? $kondisiMap[$row['kondisi']] : htmlspecialchars($row['kondisi']); ?></td>
                                        <td><?= !empty($row['problem']) ? htmlspecialchars($row['problem']) : '-'; ?></td>
                                        <td><?= !empty($row['tindakan']) ? htmlspecialchars($row['tindakan']) : '-'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">Tidak ada data detail</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <th style="text-align:center;" colspan="6">VERIFIKASI</th>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:left">QC</td>
                                <td colspan="4"><?= htmlspecialchars($kebersihanruang->username); ?></td>
                            </tr> 
                            <tr>
                                <td colspan="2" style="text-align:left">Produksi</td>
                                <td colspan="4"><?= $kebersihanruang->nama_produksi;?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:left">Diketahui Produksi</td>
                                <td colspan="4">
                                    <?php
                                    if ($kebersihanruang->status_produksi == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($kebersihanruang->status_produksi == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                    } elseif ($kebersihanruang->status_produksi == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:left">Catatan Produksi</td>
                                <td colspan="4"><?= !empty($kebersihanruang->catatan_produksi) ? $kebersihanruang->catatan_produksi : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:left">Disetujui Supervisor</td>
                                <td colspan="4">
                                    <?php
                                    if ($kebersihanruang->status_spv == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($kebersihanruang->status_spv == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                    } elseif ($kebersihanruang->status_spv == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:left">Catatan Supervisor</td>
                                <td colspan="4"><?= !empty($kebersihanruang->catatan_spv) ? htmlspecialchars($kebersihanruang->catatan_spv) : 'Tidak ada'; ?></td>
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
        width: 100%; 
        font-size: 16px; 
        margin: 0 auto; 
        border-collapse: collapse;
    }
    .table, .table th, .table td {
        border: 1px solid #ddd;
    }
    .table th, .table td {
        padding: 6px 8px;
        text-align: left;
        word-wrap: break-word;
        white-space: normal !important;
    }
    .table td {
        white-space: nowrap;
    }

/* Fix kolom pertama agar tidak terlalu lebar */
.table th:first-child,
.table td:first-child {
    width: 50px;
    max-width: 50px;
    text-align: center;
    white-space: nowrap;
}

</style>
