<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800 font-weight-bold">Daftar Pemeriksaan Sanitasi</h1>
    </div>

    <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success text-center">
            <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success_msg') ?>
        </div>
    <?php endif ?>

    <?php if($this->session->flashdata('error_msg')): ?>
        <div class="alert alert-danger text-center"> 
            <i class="fas fa-times-circle"></i> <?= $this->session->flashdata('error_msg') ?>
        </div>
    <?php endif ?> 

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="mb-3 text-right">
                <a href="<?= base_url('sanitasi/tambah') ?>" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus text-white-50"></i> Tambah
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal / Shift</th>
                            <th>Pukul</th>
                            <th>Standar (50 ppm)</th>
                            <th>Aktual Hand Basin</th>
                            <th>Keterangan</th>
                            <th>Supervisor</th>
                            <th>Aksi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($sanitasi as $val):
                            $tanggal = (new DateTime($val->date))->format('d-m-Y');
                            $waktu   = (new DateTime($val->waktu))->format('H:i');
                            $result  = json_decode($val->area, true);
                            $status_spv = [
                                0 => ['label' => 'Created', 'color' => '#99a3a4'],
                                1 => ['label' => 'Verified', 'color' => '#28b463'],
                                2 => ['label' => 'Revision', 'color' => 'red']
                            ];
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $tanggal . " / Shift " . $val->shift ?></td>
                                <td class="text-center"><?= $waktu ?></td>
                                <td class="text-center">
                                    <?php if ($val->std_handbasin == 'Sesuai'): ?>
                                        <i class="fas fa-check text-success"></i>
                                    <?php else: ?>
                                        <i class="fas fa-times text-danger"></i>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if (!empty($val->hand_basin)): ?>
                                        <img src="<?= base_url('uploads/' . $val->hand_basin); ?>" alt="Bukti Temuan" style="max-width: 150px; max-height: 100px;">
                                    <?php else: ?>
                                        <p>No image available</p>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?= $val->keterangan ?></td>
                                <td class="text-center">
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
                            <td class="text-center">
                                <a href="<?= base_url('sanitasi/edit/'.$val->uuid);?>" class="btn btn-sm btn-warning mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('sanitasi/delete/'.$val->uuid);?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <!-- MODAL SPV REVISION -->
        <?php foreach($sanitasi as $val): ?>
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
</div>
</div>

<!-- Tambahan style -->
<style>
    th {
        background-color: #f8f9fc;
    }
    ul {
        list-style: disc;
    }
</style>

<!-- Tambahkan script jika belum ada -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
