<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Daftar Pemeriksaan Sanitasi Warehouse</h1>
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
            <form action="<?= base_url('sanitasiwarehouse/cetak') ?>" method="post" id="form_cetak_pdf">
                <div>
                    <label class="font-weight-bold">Pilih tanggal:</label>
                    <div class="form-inline">
                        <input type="date" name="tanggal" class="form-control mr-2" required>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-print"></i> Cetak PDF
                        </button>
                    </div>
                </div>
            </form>
            <hr>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Area</th>
                            <th>Kondisi Warehouse</th>
                            <th>Last Updated</th>
                            <th>Last Verified</th>
                            <th>SPV</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($sanitasiwarehouse as $val) {
                            $datetime = new DateTime($val->date);
                            $tanggalFormatted = $datetime->format('d-m-Y');

                            $details = json_decode($val->detail, true);

                            $kondisiMap = [
                                '0' => 'Bersih',
                                '1' => 'Berdebu',
                                '2' => 'Basah',
                                '3' => 'Sampah (sisa lakban, kertas, remah produk/bahan baku, plastik, kardus bekas)',
                                '4' => 'Pertumbuhan mikroorganisme (jamur dan bau busuk)',
                                '5' => 'Pallet rusak/pecah',
                                '6' => 'Terdapat aktifitas binatang (tikus, kecoa, lalat, ulat, belatung)',
                                '7' => 'Sarang laba-laba',
                            ];

                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $tanggalFormatted; ?></td>
                                <td><?= htmlspecialchars($val->area); ?></td>
                                <td colspan="1">
                                    <table class="table table-sm table-bordered" style="margin:0;">
                                        <thead style="background-color:#2E86C1; color:#black; text-align:center;">
                                            <tr>
                                                <th>No</th>
                                                <th colspan="2">Titik Pemeriksaan</th>
                                                <th>Kondisi</th>
                                                <th>Masalah</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($details) && is_array($details)) : ?>
                                            <?php 
                                            $kondisiMap = [
                                                '0' => 'Bersih',
                                                '1' => 'Berdebu',
                                                '2' => 'Basah',
                                                '3' => 'Sampah (sisa lakban, kertas, remah produk/bahan baku, plastik, kardus bekas)',
                                                '4' => 'Pertumbuhan mikroorganisme (jamur dan bau busuk)',
                                                '5' => 'Pallet rusak/pecah',
                                                '6' => 'Terdapat aktifitas binatang (tikus, kecoa, lalat, ulat, belatung)',
                                                '7' => 'Sarang laba-laba',
                                            ];
                                            foreach ($details as $i => $row) : 
                                                ?>
                                                <tr>
                                                    <td style="text-align:center;"><?= $i + 1; ?></td>
                                                    <td colspan="2"><?= htmlspecialchars($row['bagian']); ?></td>
                                                    <td style="text-align:left;"><?= isset($kondisiMap[$row['kondisi']]) ? $kondisiMap[$row['kondisi']] : htmlspecialchars($row['kondisi']); ?></td>
                                                    <td><?= !empty($row['problem']) ? htmlspecialchars($row['problem']) : '-'; ?></td>
                                                    <td><?= !empty($row['tindakan']) ? htmlspecialchars($row['tindakan']) : '-'; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" style="text-align:center;">Tidak ada data detail</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </td>
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
                                <a href="<?= base_url('sanitasiwarehouse/status/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
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
