<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-center text-gray-800 font-weight-bold border-bottom pb-2">Detail Kontaminasi Benda Asing</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kontaminasi-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kontaminasi Benda Asing
                </a>
            </li>
        </ol>
    </nav>

    <!-- Detail Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php 
                    $datetime = (new DateTime($kontaminasi->date))->format('d-m-Y');
                    $time = (new DateTime($kontaminasi->time))->format('H:i');
                ?>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th colspan="2" class="font-weight-bold text-center">KONTAMINASI BENDA ASING</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td><b><?= $datetime; ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Shift</b></td>
                            <td><b><?= $kontaminasi->shift; ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Pukul</b></td>
                            <td><b><?= $time; ?></b></td>
                        </tr>
                        <tr>
                            <td>Jenis Kontaminasi</td>
                            <td><?= $kontaminasi->jenis_kontaminasi; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Produk</td>
                            <td><?= $kontaminasi->nama_produk; ?></td>
                        </tr>
                        <tr>
                            <td>Kode Produksi</td>
                            <td><?= $kontaminasi->kode_produksi; ?></td>
                        </tr>
                        <tr>
                            <td>Tahapan</td>
                            <td><?= $kontaminasi->tahapan; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Temuan</td>
                            <td><?= $kontaminasi->jumlah_temuan; ?></td>
                        </tr>
                        <tr>
                            <td>Bukti Temuan</td>
                            <td>
                                <?php if (!empty($kontaminasi->bukti)): ?>
                                    <img src="<?= base_url('uploads/' . $kontaminasi->bukti); ?>" alt="Bukti Temuan" style="max-width: 200px; max-height: 150px;">
                                <?php else: ?>
                                    <p>Tidak ada gambar</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Analisis Temuan</td>
                            <td><?= $kontaminasi->analisis; ?></td>
                        </tr>
                        <tr>
                            <td>Tindakan Koreksi</td>
                            <td><?= $kontaminasi->tindakan; ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><?= !empty($kontaminasi->keterangan) ? $kontaminasi->keterangan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td>QC</td>
                            <td><?= $kontaminasi->username; ?></td>
                        </tr>
                        <tr>
                            <td>Produksi</td>
                            <td><?= $kontaminasi->nama_produksi; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('kontaminasi/status/'.$kontaminasi->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $kontaminasi->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $kontaminasi->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : '' ; ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= $kontaminasi->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv')) ? 'd-block' : '' ; ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-md mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('kontaminasi/verifikasi'); ?>" class="btn btn-danger btn-md">
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

    .breadcrumb .breadcrumb-item a {
        color: #fff;
        font-weight: 500;
    }

    .table {
        width: 100%;
        font-size: 15px;
    }

    .table th,
    .table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #dee2e6;
        white-space: normal !important;
    }

    .table td:first-child {
        font-weight: bold;
        width: 220px;
    }

    @media (max-width: 768px) {
        .table th,
        .table td {
            font-size: 14px;
        }

        h1.h3 {
            font-size: 20px;
        }
    }
</style>
