<div class="container-fluid">
    <!-- Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Giling Lada</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('lada'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Giling Lada
                </a>
            </li>
        </ol>
    </nav>

    <!-- Detail Card -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th colspan="7">PEMERIKSAAN GILING LADA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $datetime = (new DateTime($lada->date))->format('d-m-Y'); ?>
                        <tr>
                            <td><b>Tanggal:</b> <?= $datetime; ?></td>
                            <td colspan="3"><b>Shift:</b> <?= $lada->shift; ?></td>
                            <td colspan="3"><b>Pukul:</b> <?= date('H:i', strtotime($lada->pukul)); ?></td>
                        </tr>
                        <tr>
                            <td><b>Kode Produksi</b></td>
                            <td colspan="6"><?= $lada->kode_produksi; ?></td>
                        </tr>
                        <tr>
                            <td><b>Suhu Produk (STD Min 35°C)</b></td>
                            <td colspan="6"><?= $lada->suhu_produk; ?> °C</td>
                        </tr>
                        <tr>
                            <td><b>Hasil Giling</b></td>
                            <td colspan="6"><?= $lada->hasil_giling; ?></td>
                        </tr>
                        <tr>
                            <td><b>Kadar Air (STD 9 - 12 %)</b></td>
                            <td colspan="6"><?= $lada->kadar_air; ?> %</td>
                        </tr>
                        <tr>
                            <td><b>Keterangan</b></td>
                            <td colspan="6"><?= !empty($lada->keterangan) ? $lada->keterangan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td><b>Catatan</b></td>
                            <td colspan="6"><?= !empty($lada->catatan) ? $lada->catatan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td><b>QC</b></td>
                            <td colspan="6"><?= $lada->username; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('lada/status/' . $lada->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1', $lada->status_spv == 1); ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2', $lada->status_spv == 2); ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= form_error('status_spv'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= $lada->catatan_spv; ?></textarea>
                        <div class="invalid-feedback">
                            <?= form_error('catatan_spv'); ?>
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('lada/verifikasi'); ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- CSS -->
<style>
    .breadcrumb {
        background-color: #2E86C1;
    }

    .breadcrumb a {
        color: #fff;
        text-decoration: none;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
        font-size: 15px;
    }

    .table td {
        white-space: normal;
    }
</style>
