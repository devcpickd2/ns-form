<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Data Kondisi Kerja Selama Produksi</h1>
    </div>

    <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success text-center">
            <i class="fas fa-check"></i>
            <?= $this->session->flashdata('success_msg') ?>
        </div>
        <br>
    <?php endif ?>

    <?php if($this->session->flashdata('error_msg')): ?>
        <div class="alert alert-danger text-center">
            <i class="fas fa-check"></i>
            <?= $this->session->flashdata('error_msg') ?>
        </div>
        <br>
    <?php endif ?> 

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('kondisikerja/cetak') ?>" method="post" id="form_cetak_pdf">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20px" class="text-center">No</th>
                                <th>Tanggal / Shift</th>
                                <th>Area</th>
                                <th>Item</th>
                                <th>Kondisi</th>
                                <th>Problem</th>
                                <th>Tindakan Koreksi</th>
                                <th>Last Updated</th>
                                <th>Last Verified</th>
                                <th>SPV</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (empty($kondisikerja)) {
                               echo ' <tr>
                               <td>-</td>
                               <td>-</td>
                               <td>-</td>
                               <td>-</td>
                               <td>-</td>
                               <td>-</td>
                               <td class="text-center">-</td>
                               <td class="text-center">-</td>
                               <td class="text-center">-</td>
                               <td class="text-center">-</td>
                               <td class="text-center">No data available</td>
                               </tr>';
                           } else {
                            $no = 1;
                            foreach ($kondisikerja as $val) {
                                try {
                                    $datetime = new DateTime($val->date);
                                    $formatted_date = $datetime->format('d-m-Y');
                                } catch (Exception $e) {
                                    $formatted_date = '-';
                                }
                                ?>
                                <tr>
                                    <td class="text-center" rowspan="3"><?= $no++; ?></td>
                                    <td rowspan="3"><?= $formatted_date . " / " . $val->shift; ?></td>
                                    <td rowspan="3"><?= $val->area; ?></td>
                                    <td>Higiene Karyawan</td>
                                    <td><?= $val->kondisi_higiene; ?></td>
                                    <td><?= $val->problem_higiene; ?></td>
                                    <td><?= $val->tindakan_higiene; ?></td>
                                    <td rowspan="3"><?= date('H:i - d m Y', strtotime($val->modified_at)); ?></td>
                                    <td rowspan="3"><?= date('H:i - d m Y', strtotime($val->tgl_update_spv)); ?></td>
                                    <td class="text-center" rowspan="3">
                                        <?php
                                        switch ($val->status_spv) {
                                            case 0: echo '<span class="text-muted font-weight-bold">Created</span>'; break;
                                            case 1: echo '<span class="text-success font-weight-bold">Verified</span>'; break;
                                            case 2: echo '<span class="text-danger font-weight-bold">Revision</span>'; break;
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center" rowspan="3">
                                        <a href="<?= base_url('kondisikerja/status/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
                                            <span class="text">Verifikasi</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kebersihan Area/Ruang</td>
                                    <td><?= $val->kondisi_kebersihan; ?></td>
                                    <td><?= $val->problem_kebersihan; ?></td>
                                    <td><?= $val->tindakan_kebersihan; ?></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td>
                                    <td class="empty"></td> 
                                    <td class="empty"></td> 
                                </tr>
                                <?php 
                            }
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                <label class="font-weight-bold">Pilih tanggal untuk mencetak PDF:</label>
                <div class="form-inline">
                    <input type="date" name="tanggal" class="form-control mr-2" required>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-print"></i> Cetak PDF
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<style> 
    th {
        background-color: #f8f9fc;
    }
    table.table {
        border-collapse: collapse !important;
    }
    table.table td, table.table th {
        border: 1px solid #dee2e6 !important;
        vertical-align: middle;
        padding: 10px; 
    }
    .empty {
        display: none;
    }

</style>

<script>
    $(document).ready(function() {
        let dataExists = <?= !empty($kondisikerja) ? 'true' : 'false' ?>;
        if (dataExists) {
            $('#dataTable').DataTable({
                "ordering": false,
                "searching": true
            });
        }
    });
</script>

