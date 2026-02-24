<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 font-weight-bold">Detail Pemeriksaan Suhu Ruang</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('suhu'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Suhu Ruang
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php 
            $datetime = date('d-m-Y', strtotime($suhu->date));
            $lokasi_data = json_decode($suhu->lokasi, true);
            ?>
            <table class="table table-bordered table-striped">
                <thead class="bg-primary text-white text-center">
                    <tr><th colspan="2">PEMERIKSAAN SUHU RUANG</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $datetime ?></td>
                    </tr>
                    <tr>
                        <th>Shift</th>
                        <td>Shift <?= $suhu->shift ?></td>
                    </tr>
                    <tr>
                        <th>Pukul</th>
                        <td><?= date('H:i', strtotime($suhu->pukul)) ?></td>
                    </tr>
                    <?php if (is_array($lokasi_data)): ?>
                        <?php foreach ($lokasi_data as $lok): ?>
                            <tr>
                                <th>Lokasi</th>
                                <td><?= $lok['nama'] ?></td>
                            </tr>
                            <tr>
                                <th>Suhu</th>
                                <td><?= $lok['suhu'] ?> °C</td>
                            </tr>
                            <tr>
                                <th>RH</th>
                                <td><?= $lok['rh'] ?> %</td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <th>Lokasi</th>
                            <td><em>Format tidak valid</em></td>
                        </tr>
                    <?php endif ?>
                    <tr>
                        <th>Keterangan</th>
                        <td><?= !empty($suhu->keterangan) ? $suhu->keterangan : 'Tidak ada' ?></td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td><?= !empty($suhu->catatan) ? $suhu->catatan : 'Tidak ada' ?></td>
                    </tr>
                </tbody>

                <thead class="bg-secondary text-white text-center">
                    <tr><th colspan="2">VERIFIKASI</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <th>QC</th>
                        <td><?= $suhu->username ?></td>
                    </tr>
                    <tr>
                        <th>Produksi</th>
                        <td><?= !empty($suhu->nama_produksi) ? $suhu->nama_produksi : 'Belum dikoreksi' ?></td>
                    </tr>
                    <tr>
                        <th>Status Supervisor</th>
                        <td>
                            <?php
                            $status_spv = [
                                0 => ['label' => 'Created', 'color' => '#99a3a4'],
                                1 => ['label' => 'Verified', 'color' => '#28b463'],
                                2 => ['label' => 'Revision', 'color' => 'red']
                            ];
                            $ss = $suhu->status_spv;
                            echo "<span style='color: {$status_spv[$ss]['color']}; font-weight: bold;'>{$status_spv[$ss]['label']}</span>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Catatan Supervisor</th>
                        <td><?= !empty($suhu->catatan_spv) ? $suhu->catatan_spv : 'Tidak ada' ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('suhu/status/'.$suhu->uuid);?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $suhu->status_spv == 1?'selected':'';?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $suhu->status_spv == 2?'selected':'';?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control" name="catatan_spv" ><?= $suhu->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('suhu/verifikasi')?>" class="btn btn-md btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<style>
    .breadcrumb {
        background-color: #2E86C1;
    }
    th {
        width: 30%;
    }
    table {
        font-size: 16px;
    }
</style>
