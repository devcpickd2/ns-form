<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Sanitasi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('sanitasi-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Sanitasi
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Tabel Informasi Umum -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="4" class="text-center">Informasi Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= (new DateTime($sanitasi->date))->format('d-m-Y'); ?></td>
                            <th>Shift</th>
                            <td><?= $sanitasi->shift; ?></td>
                        </tr>
                        <tr>
                            <th>Pukul</th>
                            <td><?= date('H:i', strtotime($sanitasi->waktu)); ?></td>
                            <th>Catatan</th>
                            <td><?= !empty($sanitasi->catatan) ? $sanitasi->catatan : '<span class="text-muted">Tidak ada</span>'; ?></td>
                        </tr>
                        <tr>
                            <th>Produksi</th>
                            <td><?= !empty($sanitasi->nama_produksi) ? $sanitasi->nama_produksi : '<span class="text-muted">Belum dikoreksi</span>'; ?></td>
                            <th>QC</th>
                            <td><?= $sanitasi->username; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Detail Pemeriksaan -->
            <div class="table-responsive">
                <h6 class="font-weight-bold text-primary mb-3">Detail Hasil Pemeriksaan</h6>
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th style="width: 20%">Standar (50 ppm)</th>
                            <th style="width: 15%">Aktual</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <?php if ($sanitasi->std_handbasin == 'Sesuai'): ?>
                                    <i class="fas fa-check text-success"></i>
                                <?php else: ?>
                                    <i class="fas fa-times text-danger"></i>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($sanitasi->hand_basin)): ?>
                                    <img src="<?= base_url('uploads/' . $sanitasi->hand_basin); ?>" alt="Bukti Temuan" style="max-width: 150px; max-height: 100px;">
                                <?php else: ?>
                                    <p>No image available</p>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?= $sanitasi->keterangan; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Verifikasi Section (Tetap) -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('sanitasi/status/' . $sanitasi->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $sanitasi->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $sanitasi->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : ''; ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control" name="catatan_spv"><?= $sanitasi->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv')) ? 'd-block' : ''; ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('sanitasi/verifikasi') ?>" class="btn btn-md btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Style -->
<style type="text/css">
    .breadcrumb {
        background-color: #2E86C1;
    }

    .table th, .table td {
        font-size: 14px;
        vertical-align: middle;
        word-wrap: break-word;
    }

    .table-borderless td {
        padding: 6px 12px;
    }

    .img-thumbnail {
        border: 1px solid #ddd;
        padding: 2px;
        background-color: #fff;
        max-height: 80px;
        width: auto;
    }
</style>
