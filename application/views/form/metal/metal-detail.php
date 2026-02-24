<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Metal</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('metal'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Metal Detector</a>
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
                                $datetime = new datetime($metal->date_metal);
                                $datetime = $datetime->format('d-m-Y');
                                $timing = new DateTime($metal->time);
                                $timing = $timing->format('H:i');
                                $timing2 = new DateTime($metal->update_time_t);
                                $timing2 = $timing2->format('H:i');
                                $timing3 = new DateTime($metal->update_time_b);
                                $timing3 = $timing3->format('H:i');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="5">PEMERIKSAAN METAL DETECTOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td colspan="4"><b>Shift : <?= $metal->shift;?><b></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Produk</td>
                                        <td colspan="4"><?= $metal->nama_produk;?></td>
                                    </tr>
                                    <tr>
                                        <td>Kode Produksi</td>
                                        <td colspan="4"><?= $metal->kode_produksi;?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Program</td>
                                        <td colspan="4"><?= $metal->no_program;?></td>
                                    </tr>
                                    <tr>
                                        <td>Deteksi NG</td>
                                        <td colspan="4">
                                            <?= $metal->deteksi_ng == '1' ? 'Belt Conveyor Berhenti' : ($metal->deteksi_ng == '2' ? 'Rejector' : '-') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>STD. Spesimen</b></td>  
                                        <td><b>Pukul</b></td>  
                                        <td class="text-center"><b>Fe <?= $metal->std_fe;?></b></td>
                                        <td class="text-center"><b>Non Fe <?= $metal->std_nonfe;?></b></td>
                                        <td class="text-center" colspan="2"><b>SUS 304 <?= $metal->std_sus304;?></b></td>
                                    </tr>
                                    <?php
                                    function tampilkanIkon($nilai) {
                                        if ($nilai === null || $nilai === '') {
                                            return '<span style="color: gray; font-weight: bold;">-</span>';
                                        } elseif ($nilai == 'terdeteksi') {
                                            return '<span style="color: green; font-weight: bold;">&#10004;</span>';
                                        } else {
                                            return '<span style="color: red; font-weight: bold;">&#10006;</span>';
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>Deteksi Pertama</td>
                                        <td><?= $timing; ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->fe_d); ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->nonfe_d); ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->sus_d); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Deteksi Kedua</td>
                                        <td><?= $timing2; ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->fe_t); ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->nonfe_t); ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->sus_t); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Deteksi Terakhir</td>
                                        <td><?= $timing3; ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->fe_b); ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->nonfe_b); ?></td>
                                        <td class="text-center"><?= tampilkanIkon($metal->sus_b); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan="4"><?= $metal->keterangan;?></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td colspan="4"><?= !empty($metal->catatan_metal) ? $metal->catatan_metal : 'Tidak ada'; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                    </tr>
                                    <tr>
                                        <td>QC</td>
                                        <td colspan="6"><?= $metal->username_1;?></td>
                                    </tr>
                                    <tr>
                                        <td>Produksi</td>
                                        <td colspan="5"><?= $metal->nama_produksi_metal;?></td>
                                    </tr>
                                    <tr>
                                        <td>Diketahui Produksi</td>
                                        <td colspan="4">
                                            <?php
                                            if ($metal->status_produksi == 0) {
                                                echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                            } elseif ($metal->status_produksi == 1) {
                                                echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                            } elseif ($metal->status_produksi == 2) {
                                                echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                            }
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan Produksi</td>
                                        <td colspan="4"><?= !empty($metal->catatan_produksi) ? $metal->catatan_produksi : 'Tidak ada'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Disetujui Supervisor</td>
                                        <td colspan="4"><?php
                                        if ($metal->status_spv == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($metal->status_spv == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                        } elseif ($metal->status_spv == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan SPV</td>
                                    <td colspan="4"><?= !empty($metal->catatan_spv) ? $metal->catatan_spv : 'Tidak ada'; ?></td>
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

