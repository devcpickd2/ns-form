<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Pemeriksaan Timbangan</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('timbangan-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Timbangan
                </a>
            </li>
        </ol>
    </nav>

    <!-- Card Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" cellspacing="0">
                    <?php 
                    $datetime = new DateTime($timbangan->date);
                    $formattedDate = $datetime->format('d-m-Y');
                    $result = json_decode($timbangan->peneraan_hasil, true);
                    if (!is_array($result)) $result = [];
                    ?>
                    <thead class="text-center">
                        <tr>
                            <th colspan="7" class="font-weight-bold">PEMERIKSAAN TIMBANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Tanggal:</b> <?= $formattedDate; ?></td>
                            <td colspan="5"></td>
                        </tr>
                        <tr><td><b>Shift</b></td><td colspan="6"><?= $timbangan->shift; ?></td></tr>
                        <tr><td><b>Kode Timbangan</b></td><td colspan="6"><?= $timbangan->kode_timbangan; ?></td></tr>
                        <tr><td><b>Kapasitas</b></td><td colspan="6"><?= $timbangan->kapasitas; ?></td></tr>
                        <tr><td><b>Model</b></td><td colspan="6"><?= $timbangan->model; ?></td></tr>
                        <tr><td><b>Lokasi</b></td><td colspan="6"><?= $timbangan->lokasi; ?></td></tr>
                        <tr><td><b>Standar</b></td><td colspan="6"><?= $timbangan->peneraan_standar; ?></td></tr>
                        <tr class="bg-light text-center"><td colspan="7" class="font-weight-bold">Daftar Hasil Pemeriksaan</td></tr>
                        <tr class="table-primary text-center">
                            <th>No</th>
                            <th colspan="3">Waktu</th>
                            <th colspan="3">Hasil</th>
                        </tr>
                        <?php $no = 1; foreach ($result as $row): ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td colspan="3"><?= htmlspecialchars($row['pukul']) ?></td>
                            <td colspan="3"><?= htmlspecialchars($row['hasil']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><b>QC</b></td>
                            <td colspan="6"><?= $timbangan->username; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('timbangan/status/'.$timbangan->uuid); ?>">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1', $timbangan->status_spv == 1); ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2', $timbangan->status_spv == 2); ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback d-block"><?= form_error('status_spv') ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= $timbangan->catatan_spv; ?></textarea>
                        <div class="invalid-feedback d-block"><?= form_error('catatan_spv') ?></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('timbangan/verifikasi') ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Style -->
<style>
    .breadcrumb {
        background-color: #2E86C1;
        padding: 8px 16px;
        border-radius: 0.25rem;
    }

    .breadcrumb .breadcrumb-item a {
        color: #fff;
        font-weight: 500;
    }

    .breadcrumb .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .table {
        width: 100%;
        font-size: 15px;
    }

    .table th, .table td {
        padding: 10px 12px;
        vertical-align: middle;
        word-break: break-word;
    }

    @media (max-width: 768px) {
        h1.h3 { font-size: 20px; }
        .table td, .table th { font-size: 14px; padding: 8px; }
    }
</style>
