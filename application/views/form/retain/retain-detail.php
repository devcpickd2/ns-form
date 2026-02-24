<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Detail Retain Sample Report</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('retain'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Retain Sample Report</a>
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
                                $datetime = new datetime($retain->date);
                                $datetime = $datetime->format('d-m-Y');
                                $bb = new datetime($retain->best_before);
                                $bb = $bb->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">RETAIN SAMPLE REPORT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td colspan="5"><b>Plant : <?= $retain->plant;?><b></td>
                                    </tr>
                                    <tr>
                                        <td>Sample Type</td>
                                        <td colspan="5"><?= $retain->sample_type;?></td>
                                    </tr>
                                    <tr>
                                        <td>Sample Storage</td>
                                        <td colspan="5"><?= $retain->sample_storage;?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td colspan="5"><?= $retain->deskripsi;?></td>
                                    </tr>
                                    <tr>
                                        <td>Production Code</td>
                                        <td colspan="5"><?= $retain->kode_produksi;?></td>
                                    </tr>
                                    <tr>
                                        <td>Best Before</td>
                                        <td colspan="5"><?= $retain->best_before;?></td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td colspan="5"><?= $retain->quantity;?></td>
                                    </tr>
                                    <tr>
                                        <td>Remarks</td>
                                        <td colspan="5"><?= $retain->remark;?></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td colspan="5"> <?= !empty($retain->catatan) ? $retain->catatan : 'Tidak ada'; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;" colspan="7">VERIFIKASI</th>
                                    </tr>
                                    <tr>
                                        <td>QC</td>
                                        <td colspan="6"><?= $retain->username;?></td>
                                    </tr>
                                    <tr>
                                        <td>Disetujui Supervisor</td>
                                        <td colspan="6"><?php
                                        if ($retain->status_spv == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($retain->status_spv == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                        } elseif ($retain->status_spv == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan Supervisor</td>
                                    <td colspan="6"><?= !empty($retain->catatan_spv) ? $retain->catatan_spv : 'Tidak ada'; ?></td>
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