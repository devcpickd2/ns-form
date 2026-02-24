<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Disposisi Produk dan Prosedur</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('disposisi-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Disposisi Produk dan Prosedur
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" cellspacing="0">
                    <?php 
                    $datetime = new DateTime($disposisi->date);
                    $formattedDate = $datetime->format('d-m-Y');
                    ?>
                    <thead class="text-center">
                        <tr>
                            <th colspan="4" class="font-weight-bold">DISPOSISI PRODUK DAN PROSEDUR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td colspan="3"><b><?= $formattedDate; ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Nomor</b></td>
                            <td colspan="3"><?= $disposisi->nomor; ?></td>
                        </tr>
                        <tr>
                            <td><b>Kepada</b></td>
                            <td colspan="3"><?= $disposisi->kepada; ?></td>
                        </tr>
                        <tr>
                            <td><b>Disposisi</b></td>
                            <td colspan="3"><?= $disposisi->disposisi; ?></td>
                        </tr>
                        <tr>
                            <td><b>Dasar Disposisi</b></td>
                            <td colspan="3"><?= !empty($disposisi->dasar_disposisi) ? $disposisi->dasar_disposisi : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td><b>Uraian Disposisi</b></td>
                            <td colspan="3"><?= !empty($disposisi->uraian_disposisi) ? $disposisi->uraian_disposisi : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td><b>Catatan</b></td>
                            <td colspan="3"><?= !empty($disposisi->catatan) ? $disposisi->catatan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td><b>QC</b></td>
                            <td colspan="3"><?= $disposisi->username; ?></td>
                        </tr>
                        <tr>
                            <td><b>Produksi</b></td>
                            <td colspan="3"><?= $disposisi->nama_produksi; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('disposisi/status/' . $disposisi->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $disposisi->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $disposisi->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : ''; ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= $disposisi->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv')) ? 'd-block' : ''; ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('disposisi/verifikasi') ?>" class="btn btn-danger">
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
