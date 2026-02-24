<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Disposisi Produk dan Prosedur</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('disposisi-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Disposisi Produk dan Prosedur</a>
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
                                $datetime = new datetime($disposisi->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="6">DISPOSISI PRODUK DAN PROSEDUR</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><b>Tanggal</b></td>
                                <td colspan=2 style="text-align:left;"><b><?= $datetime;?></b></td>
                            </tr>
                            <tr>
                                <td colspan="2">Nomor</td>
                                <td colspan="4"><?= $disposisi->nomor;?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Kepada</td>
                                <td colspan="4"><?= $disposisi->kepada;?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Disposisi</td>
                                <td colspan="4"><?= $disposisi->disposisi;?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Dasar Disposisi</td>
                                <td colspan="4"> <?= !empty($disposisi->dasar_disposisi) ? $disposisi->dasar_disposisi : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Uraian Disposisi</td>
                                <td colspan="4"> <?= !empty($disposisi->uraian_disposisi) ? $disposisi->uraian_disposisi : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Catatan</td>
                                <td colspan="4"> <?= !empty($disposisi->catatan) ? $disposisi->catatan : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">QC</td>
                                <td colspan="4"><?= $disposisi->username;?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Produksi</td>
                                <td colspan="4"><?= $disposisi->nama_produksi;?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Diketahui Produksi</td>
                                <td colspan="4">
                                    <?php
                                    if ($disposisi->status_produksi == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($disposisi->status_produksi == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                    } elseif ($disposisi->status_produksi == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Catatan Produksi</td>
                                <td colspan="4"><?= !empty($disposisi->catatan_produksi) ? $disposisi->catatan_produksi : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">Disetujui Supervisor</td>
                                <td colspan="4"><?php
                                if ($disposisi->status_spv == 0) {
                                    echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                } elseif ($disposisi->status_spv == 1) {
                                    echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                } elseif ($disposisi->status_spv == 2) {
                                    echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                }
                            ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Catatan Supervisor</td>
                            <td colspan="4"><?= !empty($disposisi->catatan_spv) ? $disposisi->catatan_spv : 'Tidak ada'; ?></td>
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