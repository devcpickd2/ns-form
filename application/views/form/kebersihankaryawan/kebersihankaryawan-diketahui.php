<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Kebersihan Karyawan</h1>
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
                <a href="<?= base_url('kebersihankaryawan/tambah') ?>" class="btn btn-md btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
                </a>
            </div>
            <hr>
            <div style="display: flex; gap: 20px;">
                <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 40%; text-align: left; font-family: Arial, sans-serif; font-size: 14px;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th colspan="2" style="padding: 10px; background-color: #ADD8E6; color: gray;">Keterangan Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. Seragam</td>
                            <td>5. Perhiasan</td>
                        </tr>
                        <tr>
                            <td>2. Apron</td>
                            <td>6. Masker</td>
                        </tr>
                        <tr>
                            <td>3. Tangan dan Kuku</td>
                            <td>7. Topi / Hairnet</td>
                        </tr>
                        <tr>
                            <td>4. Kosmetik</td>
                            <td>8. Sepatu Kerja</td>
                        </tr>
                    </tbody>
                </table>
                <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 30%; text-align: center; font-family: Arial, sans-serif; font-size: 14px;">
                    <thead style="background-color: #f2f2f2;">
                        <tr>
                            <th colspan="2" style="padding: 10px; background-color: #ADD8E6; color: gray;">Simbol Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>✔️</td>
                            <td>Ok</td>
                        </tr>
                        <tr>
                            <td>❌</td>
                            <td>Tidak Ok</td>
                        </tr>
                        <tr>
                            <td>−</td>
                            <td>Tidak ada / Tidak digunakan</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br>    
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center" rowspan="2">No</th>
                            <th rowspan="2">Tanggal</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Bagian</th>
                            <th colspan="8" class="text-center">Kebersihan</th>
                            <th rowspan="2">Tindakan Koreksi</th>
                            <th rowspan="2">Last Updated</th>
                            <th rowspan="2">Last Verified</th>
                            <th rowspan="2">Status</th>
                            <th rowspan="2" class="text-center">Action</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($kebersihankaryawan as $val) {
                            $datetime = new datetime($val->date);
                            $datetime = $datetime->format('d-m-Y');
                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $datetime; ?></td>
                                <td><?= $val->nama; ?></td>
                                <td><?= $val->bagian; ?></td>
                                <td class="text-center">
                                    <?= ($val->seragam == 'ok') ? '✔️' : (($val->seragam == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($val->apron == 'ok') ? '✔️' : (($val->apron == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($val->tangan_kuku == 'ok') ? '✔️' : (($val->tangan_kuku == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($val->kosmetik == 'ok') ? '✔️' : (($val->kosmetik == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($val->perhiasan == 'ok') ? '✔️' : (($val->perhiasan == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($val->masker == 'ok') ? '✔️' : (($val->masker == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($val->topi_hairnet == 'ok') ? '✔️' : (($val->topi_hairnet == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td class="text-center">
                                    <?= ($val->sepatu == 'ok') ? '✔️' : (($val->sepatu == 'tidak oke') ? '❌' : '−'); ?>
                                </td>
                                <td><?= $val->tindakan; ?></td>
                                <td><?= date('H:i - d m Y', strtotime($val->modified_at)); ?></td>
                                <td><?= date('H:i - d m Y', strtotime($val->tgl_update_produksi)); ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($val->status_produksi == 0) {
                                        echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                    } elseif ($val->status_produksi == 1) {
                                        echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                    } elseif ($val->status_produksi == 2) {
                                        echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('kebersihankaryawan/statusprod/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
                                        <span class="text">Verifikasi</span>
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
        </div>
    </div>
</div>
</div>
<style> 
    th {
        background-color: #f8f9fc;
    }
</style>
