<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Daftar Monitoring False Rejection</h1>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Tanggal Produksi</th>
                            <th>Tanggal Monitoring/Shift</th>
                            <th>Nama Produk</th>
                            <th>Kode Produksi</th>
                            <th>Jenis kontaminan</th>
                            <th>Supervisor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($falserejection as $val) {
                            $datetime = new datetime($val->date_metal);
                            $datetime = $datetime->format('d-m-Y');
                            $datetime2 = new datetime($val->date_false_rejection);
                            $datetime2 = $datetime2->format('d-m-Y');
                            $status_spv = [
                                0 => ['label' => 'Created', 'color' => '#99a3a4'],
                                1 => ['label' => 'Verified', 'color' => '#28b463'],
                                2 => ['label' => 'Revision', 'color' => 'red']
                            ];
                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $datetime; ?></td>
                                <td><?= $datetime2.' / '.$val->shift_monitoring; ?></td>
                                <td><?= $val->nama_produk; ?></td>
                                <td><?= $val->kode_produksi; ?></td>
                                <td><?= $val->jenis_kontaminasi; ?></td>
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
                                <a href="<?= base_url('falserejection/edit/'.$val->uuid);?>" class="btn btn-sm btn-warning mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                        <?php 
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- MODAL SPV REVISION -->
        <?php foreach($falserejection as $val): ?>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

<style> 
    th {
        background-color: #f8f9fc;
    }
</style>
