<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Kebersihan Peralatan</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kebersihanperalatan-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Peralatan
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php $tanggal = (new DateTime($kebersihanperalatan->date))->format('d-m-Y'); ?>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th colspan="3" class="font-weight-bold">PEMERIKSAAN KEBERSIHAN PERALATAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Tanggal</strong></td>
                            <td colspan="2"><?= $tanggal; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Shift</strong></td>
                            <td colspan="2"><?= $kebersihanperalatan->shift; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Catatan</strong></td>
                            <td colspan="2"><?= !empty($kebersihanperalatan->catatan) ? $kebersihanperalatan->catatan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td><strong>QC</strong></td>
                            <td colspan="2"><?= $kebersihanperalatan->username; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Produksi</strong></td>
                            <td colspan="2"><?= $kebersihanperalatan->nama_produksi ?? 'Belum dikoreksi'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h5 class="font-weight-bold mt-4">Detail Pemeriksaan Peralatan</h5>
            <div class="table-responsive mt-2">
                <table class="table table-bordered">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Peralatan</th>
                            <th>Kondisi</th>
                            <th>Problem</th>
                            <th>Tindakan Koreksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $peralatan = json_decode($kebersihanperalatan->peralatan);
                        if ($peralatan):
                            foreach ($peralatan as $i => $item): ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1 ?></td>
                                    <td><?= $item->nama ?></td>
                                    <td><?= $item->kondisi ?></td>
                                    <td><?= $item->problem ?></td>
                                    <td><?= $item->tindakan ?></td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data peralatan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- FORM VERIFIKASI SUPERVISOR -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('kebersihanperalatan/status/' . $kebersihanperalatan->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1', $kebersihanperalatan->status_spv == 1); ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2', $kebersihanperalatan->status_spv == 2); ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback"><?= form_error('status_spv') ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= set_value('catatan_spv', $kebersihanperalatan->catatan_spv); ?></textarea>
                        <div class="invalid-feedback"><?= form_error('catatan_spv') ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('kebersihanperalatan-verifikasi') ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- STYLE -->
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

    .table td, .table th {
        vertical-align: middle !important;
        word-wrap: break-word;
        white-space: normal !important;
        font-size: 15px;
        padding: 10px 12px;
    }

    @media (max-width: 768px) {
        .table td, .table th {
            font-size: 14px;
            padding: 8px;
        }

        h1.h3 {
            font-size: 20px;
        }
    }
</style>
