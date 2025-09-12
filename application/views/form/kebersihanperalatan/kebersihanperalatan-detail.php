<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kebersihan Peralatan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kebersihanperalatan'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Peralatan</a>
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
                                $datetime = new datetime($kebersihanperalatan->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">KEBERSIHAN PERALATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;" ><b>Tanggal : <?= $datetime;?></b></td>
                                    <td style="text-align:left;" colspan="6"><b>Shift : <?= $kebersihanperalatan->shift;?></b></td>
                                </tr>
                                <tr>
                                    <td>Peralatan</td>
                                    <td colspan="6"><?= $kebersihanperalatan->peralatan;?></td>
                                </tr>
                                <tr>
                                    <td>Kondisi</td>
                                    <td colspan="6"><?= $kebersihanperalatan->kondisi;?></td>
                                </tr>
                                <tr>
                                    <td>Problem</td>
                                    <td colspan="6"><?= $kebersihanperalatan->problem;?></td>
                                </tr>
                                <tr>
                                    <td>Tindakan Koreksi</td>
                                    <td colspan="6"><?= $kebersihanperalatan->tindakan;?></td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td colspan="6"> <?= !empty($kebersihanperalatan->catatan) ? $kebersihanperalatan->catatan : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                </tr>
                                <tr>
                                    <td>QC</td>
                                    <td colspan="6"><?= $kebersihanperalatan->username;?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Produksi</td>
                                    <td colspan="6"><?= $kebersihanperalatan->nama_produksi;?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Diketahui Produksi</td>
                                    <td colspan="6">
                                        <?php
                                        if ($kebersihanperalatan->status_produksi == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($kebersihanperalatan->status_produksi == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                        } elseif ($kebersihanperalatan->status_produksi == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left">Catatan Produksi</td>
                                    <td colspan="6"><?= !empty($kebersihanperalatan->catatan_produksi) ? $kebersihanperalatan->catatan_produksi : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <td>Disetujui Supervisor</td>
                                    <td colspan="4"><?php
                                    if ($kebersihanperalatan->status_spv == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($kebersihanperalatan->status_spv == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                    } elseif ($kebersihanperalatan->status_spv == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td>Catatan Supervisor</td>
                                <td colspan="4"><?= !empty($kebersihanperalatan->catatan_spv) ? $kebersihanperalatan->catatan_spv : 'Tidak ada'; ?></td>
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