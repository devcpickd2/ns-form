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
            <div class="form-group text-right">
                <a href="<?= base_url('kondisikerja/tambah') ?>" class="btn btn-md btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
                </a>
            </div>
            <hr>
            <div style="display: flex; gap: 20px;">
                <table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 50%; text-align: left; font-family: Times, sans-serif; font-size: 14px;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th colspan="2" style="padding: 6px; background-color: #ADD8E6; color: gray;">Keterangan Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. Berdebu</td>
                            <td>5. Pertumbuhan Mikroorganisme (jamur, bau busuk, biofilm)</td>
                        </tr>
                        <tr>
                            <td>2. Basah, ada genangan air</td>
                            <td>6. Kontak / kontaminasi material non halal</td>
                        </tr>
                        <tr>
                            <td>3. Sisa produksi (remah-remah roti, tepung, sisa adonan)</td>
                            <td>7. Higiene karyawan tidak sesuai GMP</td>
                        </tr>
                        <tr>
                            <td>4. Noda (karat, cat, tinta)</td> 
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 50%; text-align: center; font-family: Times, sans-serif; font-size: 14px;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th colspan="2" style="padding: 6px; background-color: #ADD8E6; color: gray;">Simbol Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>✔️</td>
                            <td>Ok, Sesuai SSOP, bersih, bebas najis / material non halal</td>
                        </tr>
                        <tr>
                            <td>❌</td>
                            <td>Tidak Ok, tidak sesuai SSOP</td>
                        </tr>
                        <tr>
                            <td>−</td>
                            <td>Tidak ada / Tidak digunakan</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
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
                            <th>Supervisor</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (empty($kondisikerja)) {
                            echo ' <tr>
                            <td class="text-center">-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
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

                                $status_spv = [
                                    0 => ['label' => 'Created', 'color' => '#99a3a4'],
                                    1 => ['label' => 'Verified', 'color' => '#28b463'],
                                    2 => ['label' => 'Revision', 'color' => 'red']
                                ];
                                ?>
                                <tr>
                                    <td class="text-center" rowspan="3"><?= $no++; ?></td>
                                    <td rowspan="3"><?= $formatted_date . " / " . $val->shift; ?></td>
                                    <td rowspan="3"><?= $val->area; ?></td>

                                    <td>Higiene Karyawan</td>
                                    <td><?= $val->kondisi_higiene; ?></td>
                                    <td><?= $val->problem_higiene; ?></td>
                                    <td><?= $val->tindakan_higiene; ?></td>
                                    <td class="text-center" rowspan="2">
                                        <?php if ($val->status_spv == 2): ?>
                                            <a href="#" 
                                            class="text-danger font-weight-bold" 
                                            data-toggle="modal" 
                                            data-target="#modalSpv<?= $val->uuid ?>">
                                            <?= $status_spv[2]['label'] ?>
                                        </a>
                                    <?php else: ?>
                                        <span style="color: <?= $status_spv[$val->status_spv]['color'] ?>; font-weight: bold;">
                                            <?= $status_spv[$val->status_spv]['label'] ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center" rowspan="3">
                                    <a href="<?= base_url('kondisikerja/edit/'.$val->uuid); ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <!-- <a href="<?= base_url('kondisikerja/detail/'.$val->uuid); ?>" class="btn btn-success btn-sm">
                                        Detail
                                    </a> -->
                                    <a href="<?= base_url('kondisikerja/delete/'.$val->uuid);?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <span class="text">Delete</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Kebersihan Area</td>
                                <td><?= $val->kondisi_kebersihan; ?></td>
                                <td><?= $val->problem_kebersihan; ?></td>
                                <td><?= $val->tindakan_kebersihan; ?></td>
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
    </div>
</div>

<!-- MODALS DI LUAR TABEL -->
<?php foreach($kondisikerja as $val): ?>
    <?php if ($val->status_spv == 2): ?>
        <div class="modal fade" id="modalSpv<?= $val->uuid ?>" tabindex="-1" role="dialog" aria-labelledby="modalSpvLabel<?= $val->uuid ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalSpvLabel<?= $val->uuid ?>">Detail Supervisor (Revision)</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 40%;">Status</th>
                    <td><span class="text-danger font-weight-bold">Revision</span></td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td><?= !empty($val->catatan_spv) ? $val->catatan_spv : 'Tidak ada' ?></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
<?php endforeach; ?>

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

