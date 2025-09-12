<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Daftar Pemeriksaan Sn</h1>
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
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Waktu</th>
                            <th>Area</th>
                            <th>Aktual</th>
                            <th>Gambar</th>
                            <th>Last Updated</th>
                            <th>Last Checked</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($sanitasi as $val) {
                            $datetime = new datetime($val->date);
                            $datetime = $datetime->format('d-m-Y');

                            $timing = new DateTime($val->waktu);
                            $timing = $timing->format('H:i');
                            $result = json_decode($val->area, true);
                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $datetime; ?></td>
                                <td><?= $val->shift; ?></td>
                                <td><?= $timing; ?></td>
                                <td>
                                    <ul>
                                        <?php 
                                        if (!empty($result)) {
                                            foreach ($result as $theresult) {
                                                echo '<li>' . htmlspecialchars($theresult['sub_area']) . '</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <?php 
                                        if (!empty($result)) {
                                            foreach ($result as $theresult) {
                                                echo '<li>' . htmlspecialchars($theresult['aktual']) . '</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <?php 
                                        if (!empty($result)) {
                                            foreach ($result as $theresult) {
                                                if (!empty($theresult['gambar'])) {
                                                    $gambar_url = base_url('uploads/sanitasi/' . $theresult['gambar']);
                                                    echo '<li><a href="' . $gambar_url . '" target="_blank">Lihat Gambar</a></li>';
                                                } else {
                                                    echo '<li><span class="text-muted">Tidak ada</span></li>';
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </td>
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
                                    <a href="<?= base_url('sanitasi/statusprod/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
                                        <span class="text">Check</span>
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
