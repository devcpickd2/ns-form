<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Daftar Pemeriksaan Kekuatan Magnet Trap</h1>
    </div>

    <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success text-center">
            <i class="fas fa-check"></i>
            <?= $this->session->flashdata('success_msg') ?>
        </div><br>
    <?php endif ?>

    <?php if($this->session->flashdata('error_msg')): ?>
        <div class="alert alert-danger text-center">
            <i class="fas fa-times"></i>
            <?= $this->session->flashdata('error_msg') ?>
        </div><br>
    <?php endif ?>

    <div class="card shadow mb-4">
        <div class="card-body">

          <form method="get" action="<?= base_url('kekuatanmagnet/cetak') ?>" class="form-inline mb-3">
            <label for="bulan" class="mr-2">Pilih Bulan:</label>
            <input type="month" name="bulan" id="bulan" class="form-control mr-2"
            value="<?= isset($_GET['bulan']) ? $_GET['bulan'] : date('Y-m') ?>">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="20px" class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Nama Alat</th>
                        <th>Nilai Pengukuran</th>
                        <th>Last Updated</th>
                        <th>Last Verified</th>
                        <th>SPV</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($kekuatanmagnet as $val): 
                        $datetime = new DateTime($val->date);
                        $tanggal = $datetime->format('d-m-Y');
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $tanggal ?></td>
                            <td><?= $val->nama_alat ?></td>
                            <td><?= $val->nilai ?></td>
                            <td><?= date('H:i - d m Y', strtotime($val->modified_at)); ?></td>
                            <td><?= date('H:i - d m Y', strtotime($val->tgl_update_spv)); ?></td>
                            <td class="text-center">
                                <?php
                                if ($val->status_spv == 0) {
                                    echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                } elseif ($val->status_spv == 1) {
                                    echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                } elseif ($val->status_spv == 2) {
                                    echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('kekuatanmagnet/status/'.$val->uuid); ?>" class="btn btn-warning btn-icon-split">
                                    <span class="text">Verifikasi</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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

<!-- Tambahkan CDN DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "pageLength": 10,
            "ordering": true
        });
    });
</script>
