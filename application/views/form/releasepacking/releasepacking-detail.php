<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Data Release Packing</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('releasepacking'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Data Release Packing</a>
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
                                $datetime = new datetime($releasepacking->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">DATA RELEASE PACKING</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;" colspan="7"><b>Tanggal : <?= $datetime;?></b></td>
                                </tr>
                                <tr>
                                    <td>Nama Produk</td>
                                    <td colspan="6"><?= $releasepacking->nama_produk;?></td>
                                </tr>
                                <tr>
                                    <td>Kode Produksi</td>
                                    <td colspan="6"><?= $releasepacking->kode_produksi;?></td>
                                </tr>
                                <tr>
                                    <td>Best Before</td>
                                    <td colspan="6"><?= $releasepacking->best_before;?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td colspan="6"><?= $releasepacking->jumlah;?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td colspan="6"><?= $releasepacking->keterangan;?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                </tr>
                                <tr>
                                    <td>QC</td>
                                    <td colspan="6"><?= $releasepacking->username;?></td>
                                </tr>
                                <tr>
                                    <td>Disetujui Supervisor</td>
                                    <td colspan="4"><?php
                                    if ($releasepacking->status_spv == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($releasepacking->status_spv == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                    } elseif ($releasepacking->status_spv == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td>Catatan Supervisor</td>
                                <td colspan="4"><?= !empty($releasepacking->catatan_spv) ? $releasepacking->catatan_spv : 'Tidak ada'; ?></td>
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