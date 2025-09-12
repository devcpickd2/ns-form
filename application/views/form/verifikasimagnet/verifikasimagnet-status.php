<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Verifikasi Magnet Trap</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('verifikasimagnet-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Verifikasi Magnet Trap
                </a>
            </li>
        </ol>
    </nav>

    <!-- Tabel Detail -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php $datetime = new DateTime($verifikasimagnet->date); ?>
                <table class="table table-bordered" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th colspan="7" class="text-center font-weight-bold">VERIFIKASI MAGNET TRAP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Tanggal:</b> <?= $datetime->format('d-m-Y'); ?></td>
                            <td colspan="5"></td>
                        </tr>
                        <tr class="bg-light text-center">
                            <td colspan="7" class="font-weight-bold">Hasil Pemeriksaan</td>
                        </tr>
                        <tr>
                            <td><b>Shift</b></td>
                            <td colspan="6"><?= $verifikasimagnet->shift; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama Produk</b></td>
                            <td colspan="6"><?= $verifikasimagnet->nama_produk; ?></td>
                        </tr>
                        <tr>
                            <td><b>Kode Produksi</b></td>
                            <td colspan="6"><?= $verifikasimagnet->kode_produksi; ?></td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Temuan</b></td>
                            <td colspan="6"><?= $verifikasimagnet->jumlah_temuan; ?></td>
                        </tr>
                        <tr>
                            <td><b>Keterangan</b></td>
                            <td colspan="6"><?= $verifikasimagnet->keterangan; ?></td>
                        </tr>
                        <tr>
                            <td><b>Catatan</b></td>
                            <td colspan="6"><?= !empty($verifikasimagnet->catatan) ? $verifikasimagnet->catatan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td><b>QC</b></td>
                            <td colspan="6"><?= $verifikasimagnet->username; ?></td>
                        </tr>
                        <tr>
                            <td><b>Produksi</b></td>
                            <td colspan="6"><?= $verifikasimagnet->nama_produksi; ?></td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>

    <!-- Form Verifikasi Supervisor -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('verifikasimagnet/status/'.$verifikasimagnet->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Status</label>
                        <select name="status_spv" class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $verifikasimagnet->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $verifikasimagnet->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= form_error('status_spv') ? 'd-block' : '' ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= $verifikasimagnet->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= form_error('catatan_spv') ? 'd-block' : '' ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('verifikasimagnet/verifikasi'); ?>" class="btn btn-danger">
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

    .table td, .table th {
        padding: 10px 12px;
        vertical-align: middle;
        word-break: break-word;
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
