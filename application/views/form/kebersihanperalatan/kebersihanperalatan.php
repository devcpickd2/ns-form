<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Kebersihan Peralatan</h1>
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
                <a href="<?= base_url('kebersihanperalatan/tambah') ?>" class="btn btn-md btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Supervisor</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($kebersihanperalatan as $val) {
                            $datetime = new datetime($val->date);
                            $datetime = $datetime->format('d-m-Y');
                            $status_spv = [
                                0 => ['label' => 'Created', 'color' => '#99a3a4'],
                                1 => ['label' => 'Verified', 'color' => '#28b463'],
                                2 => ['label' => 'Revision', 'color' => 'red']
                            ];
                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $datetime; ?></td>
                                <td><?= $val->shift; ?></td>
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
                                <a href="<?= base_url('kebersihanperalatan/edit/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
                                    <span class="text">Edit</span>
                                </a>
                                <a href="<?= base_url('kebersihanperalatan/delete/'.$val->uuid);?>" class="btn btn-danger btn-icon-split" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <span class="text">Delete</span>
                                </a>
                            </td>
                        </tr>
                        <?php 
                        $no++;
                    }
                    ?>
                </tbody>
            </table>

            <!-- MODAL SPV REVISION -->
            <?php foreach($kebersihanperalatan as $val): ?>
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
</div>
<style> 
    th {
        background-color: #f8f9fc;
    }
</style>
