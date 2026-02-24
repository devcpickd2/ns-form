<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Proses Pengemasan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('pengemasan'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Proses Pengemasan</a>
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
                                $datetime = new datetime($pengemasan->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">DATA PEMERIKSAAN PROSES PENGEMASAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td style="text-align:left;"><b>Shift : <?= $pengemasan->shift;?></b></td>
                                    <td style="text-align:left;" colspan="4"><b>Pukul : <?= date('H:i', strtotime($pengemasan->waktu)); ?></b></td>
                                </tr>
                                <tr>
                                    <td>Nama Produk</td>
                                    <td colspan="6"><?= $pengemasan->nama_produk;?></td>
                                </tr>
                                <tr>
                                    <td>Kode Produksi</td>
                                    <td colspan="6"><?= $pengemasan->kode_produksi;?></td>
                                </tr>
                                <tr>
                                    <td>Best Before</td>
                                    <td colspan="6"><?= $pengemasan->best_before;?></td>
                                </tr>
                                <tr>
                                    <td>Kondisi Produk</td>
                                    <td colspan="6"><?= $pengemasan->kondisi_produk;?></td>
                                </tr>
                                <tr>
                                    <td>Kondisi Seal Kemasan</td>
                                    <td colspan="6"><?= $pengemasan->kondisi_seal;?></td>
                                </tr>
                                <tr>
                                    <td>Berat Kotor per pack (gram)</td>
                                    <td colspan="6"><?= $pengemasan->berat_pack;?></td>
                                </tr>
                                <tr>
                                    <td>Berat Kotor per renceng (gram)</td>
                                    <td colspan="6"><?= $pengemasan->berat_renceng;?></td>
                                </tr>
                                <tr>
                                    <td>Berat Kotor per inner (gram)</td>
                                    <td colspan="6"><?= $pengemasan->berat_inner;?></td>
                                </tr>
                                <tr>
                                    <td>Berat Kotor per binded (gram)</td>
                                    <td colspan="6"><?= $pengemasan->berat_binded;?></td>
                                </tr>
                                <tr>
                                    <td>Berat Kotor per carton (Kg)</td>
                                    <td colspan="6"><?= $pengemasan->berat_carton;?></td>
                                </tr>
                                <tr>
                                    <td>Labelisasi</td>
                                    <td colspan="6"><?= $pengemasan->labelisasi;?></td>
                                </tr>
                                <tr>
                                    <td>Kondisi Seal Karton Box</td>
                                    <td colspan="6"><?= $pengemasan->kondisi_karton;?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td colspan="6"><?= $pengemasan->keterangan;?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                </tr>
                                <tr>
                                    <td>QC</td>
                                    <td colspan="6"><?= $pengemasan->username;?></td>
                                </tr>
                                <tr>
                                    <td>Produksi</td>
                                    <td colspan="5"><?= $pengemasan->nama_produksi;?></td>
                                </tr>
                                <tr>
                                    <td>Diketahui Produksi</td>
                                    <td colspan="4">
                                        <?php
                                        if ($pengemasan->status_produksi == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($pengemasan->status_produksi == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                        } elseif ($pengemasan->status_produksi == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan Produksi</td>
                                    <td colspan="4"><?= !empty($pengemasan->catatan_produksi) ? $pengemasan->catatan_produksi : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <td>Disetujui Supervisor</td>
                                    <td colspan="4"><?php
                                    if ($pengemasan->status_spv == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($pengemasan->status_spv == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                    } elseif ($pengemasan->status_spv == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td>Catatan Supervisor</td>
                                <td colspan="4"><?= !empty($pengemasan->catatan_spv) ? $pengemasan->catatan_spv : 'Tidak ada'; ?></td>
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