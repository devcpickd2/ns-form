<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Monitoring False Rejection</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('falserejection'); ?>">
                    <i class="fas fa-arrow-left"></i> Monitoring False Rejection</a>
                </li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <div class="table-responsive">
                        <table class="table table-bordered" cellspacing="0">
                         <thead>
                            <?php 
                            $datetime = new datetime($falserejection->date_false_rejection);
                            $datetime = $datetime->format('d-m-Y');
                            ?>
                            <tr>
                                <th style="text-align:center;" colspan="2" >MONITORING FALSE REJECTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <tr>
                                    <td>Mesin</td>
                                    <td><?= $falserejection->no_mesin;?></td>
                                </tr>
                                <td ><b>Tanggal : <?= $datetime;?></b></td>
                                <td><b>Shift : <?= $falserejection->shift_monitoring;?><b></td>
                                </tr>
                                <tr>
                                    <td>Nama Produk</td>
                                    <td><?= $falserejection->nama_produk;?></td>
                                </tr>
                                <tr>
                                    <td>Kode Produksi</td>
                                    <td><?= $falserejection->kode_produksi;?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pack/Bag yang Tidak Lolos</td>
                                    <td colspan="4"><?= !empty($falserejection->jumlah_tidak_lolos) ? $falserejection->jumlah_tidak_lolos : '0'; ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pack/Bag yang Terdapat Kontaminasi</td>
                                    <td colspan="4"><?= !empty($falserejection->jumlah_kontaminasi) ? $falserejection->jumlah_kontaminasi : '0'; ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kontaminasi</td>
                                    <td><?= $falserejection->jenis_kontaminasi;?></td>
                                </tr>
                                <tr>
                                    <td>Posisi Kontaminasi</td>
                                    <td><?= $falserejection->posisi_kontaminasi;?></td>
                                </tr>
                                <tr>
                                    <td>False Rejection</td>
                                    <td colspan="4"><?= !empty($falserejection->falserejection) ? $falserejection->falserejection : '0'; ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan Monitoring</td>
                                    <td colspan="4"><?= !empty($falserejection->catatan) ? $falserejection->catatan : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                </tr>
                                <tr>
                                    <tr>
                                        <td>QC</td>
                                        <td colspan="6"><?= $falserejection->username_2;?></td>
                                    </tr>
                                    <tr>
                                        <td>Produksi</td>
                                        <td colspan="6"> <?= !empty($falserejection->nama_produksi_false) ? $falserejection->nama_produksi_false : 'Belum di koreksi'; ?></td>
                                    </tr>
                                    <td>Diketahui Produksi</td>
                                    <td colspan="4">
                                        <?php
                                        if ($falserejection->status_produksi_false == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($falserejection->status_produksi_false == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                        } elseif ($falserejection->status_produksi_false == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan Produksi</td>
                                    <td colspan="4"><?= !empty($falserejection->catatan_produksi) ? $falserejection->catatan_produksi : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <td>Disetujui Supervisor</td>
                                    <td colspan="4"><?php
                                    if ($falserejection->status_spv_false == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($falserejection->status_spv_false == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                    } elseif ($falserejection->status_spv_false == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td>Catatan SPV</td>
                                <td colspan="4"><?= !empty($falserejection->catatan_spv) ? $falserejection->catatan_spv : 'Tidak ada'; ?></td>
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


