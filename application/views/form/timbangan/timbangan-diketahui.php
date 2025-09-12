<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Pemeriksaan Timbangan</h1>
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
                            <th>Tanggal / Shift</th>
                            <th>Kode Timbangan</th>
                            <th>Kapasitas / Model / Lokasi</th>
                            <th>Standar</th>
                            <th>Waktu</th>
                            <th>Hasil</th>
                            <th>Last Updated</th>
                            <th>Last Verified</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($timbangan as $val) {
                            $datetime = new datetime($val->date);
                            $datetime = $datetime->format('d-m-Y');

                            $result = json_decode($val->peneraan_hasil, true);
                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $datetime . " / " . $val->shift; ?></td>
                                <td><?= $val->kode_timbangan; ?></td>
                                <td><?= $val->kapasitas . " / ". $val->model . " / ". $val->lokasi ; ?></td>
                                <td><?= $val->peneraan_standar; ?></td>
                                <td>
                                    <ul>
                                        <?php 
                                        if (!empty($result)) {
                                            foreach ($result as $theresult) {
                                                echo '<li>' . htmlspecialchars($theresult['pukul']) . '</li>';
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
                                                echo '<li>' . htmlspecialchars($theresult['hasil']) . '</li>';
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
                                    <a href="<?= base_url('timbangan/statusprod/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
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
