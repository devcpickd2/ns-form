<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Giling Lada</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('lada'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Giling Lada</a>
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
                                $datetime = new datetime($lada->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">PEMERIKSAAN GILING LADA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td colspan="3"><b>Shift : <?= $lada->shift;?><b></td>
                                        <td colspan="3"><b>Pukul : <?= date('H:i', strtotime($lada->pukul)); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Produksi</td>
                                        <td colspan="6"><?= $lada->kode_produksi;?></td>
                                    </tr>
                                    <tr>
                                        <td>Suhu Produk (STD Min 35°C)</td>
                                        <td colspan="6"><?= $lada->suhu_produk;?> °C</td>
                                    </tr>
                                    <tr>
                                        <td>Hasil Giling</td>
                                        <td colspan="6"><?= $lada->hasil_giling;?></td>
                                    </tr>
                                    <tr>
                                        <td>Kadar Air (STD 9 - 12 %)</td>
                                        <td colspan="6"><?= $lada->kadar_air;?> %</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan="6"> <?= !empty($lada->keterangan) ? $lada->keterangan : 'Tidak ada'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td colspan="6"> <?= !empty($lada->catatan) ? $lada->catatan : 'Tidak ada'; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                    </tr>
                                    <tr>
                                        <td>QC</td>
                                        <td colspan="6"><?= $lada->username;?></td>
                                    </tr>
                                    <tr>
                                        <td>Produksi</td>
                                        <td colspan="5"><?= $lada->nama_produksi;?></td>
                                    </tr>
                                    <tr>
                                        <td>Diketahui Produksi</td>
                                        <td colspan="4">
                                            <?php
                                            if ($lada->status_produksi == 0) {
                                                echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                            } elseif ($lada->status_produksi == 1) {
                                                echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                            } elseif ($lada->status_produksi == 2) {
                                                echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                            }
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan Produksi</td>
                                        <td colspan="4"><?= !empty($lada->catatan_produksi) ? $lada->catatan_produksi : 'Tidak ada'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Disetujui Supervisor</td>
                                        <td colspan="4"><?php
                                        if ($lada->status_spv == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($lada->status_spv == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                        } elseif ($lada->status_spv == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan Supervisor</td>
                                    <td colspan="4"><?= !empty($lada->catatan_spv) ? $lada->catatan_spv : 'Tidak ada'; ?></td>
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