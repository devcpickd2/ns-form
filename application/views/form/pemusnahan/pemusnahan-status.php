<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Data Pemusnahan Barang / Produk</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('pemusnahan-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Data Pemusnahan Barang / Produk
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php 
                $datetime = new DateTime($pemusnahan->date);
                $formattedDate = $datetime->format('d-m-Y');

                $bb = new DateTime($pemusnahan->best_before);
                $bestBefore = $bb->format('d-m-Y');
                ?>
                <table class="table table-bordered" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th colspan="7" class="font-weight-bold">DATA PEMUSNAHAN BARANG / PRODUK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7"><b>Tanggal:</b> <?= $formattedDate; ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama Produk</b></td>
                            <td colspan="6"><?= $pemusnahan->nama_produk; ?></td>
                        </tr>
                        <tr>
                            <td><b>Kode Produksi</b></td>
                            <td colspan="6"><?= $pemusnahan->kode_produksi; ?></td>
                        </tr>
                        <tr>
                            <td><b>Best Before</b></td>
                            <td colspan="6"><?= $bestBefore; ?></td>
                        </tr>
                        <tr>
                            <td><b>Analisa Masalah</b></td>
                            <td colspan="6"><?= $pemusnahan->analisa; ?></td>
                        </tr>
                        <tr>
                            <td><b>Jumlah</b></td>
                            <td colspan="6"><?= $pemusnahan->analisa; ?></td>
                        </tr>
                        <tr>
                            <td><b>Keterangan</b></td>
                            <td colspan="6"><?= $pemusnahan->keterangan; ?></td>
                        </tr>
                        <tr>
                            <td><b>QC</b></td>
                            <td colspan="6"><?= $pemusnahan->username; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('pemusnahan/status/'.$pemusnahan->uuid);?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $pemusnahan->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $pemusnahan->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : '' ; ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control" name="catatan_spv"><?= $pemusnahan->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv')) ? 'd-block' : '' ; ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('pemusnahan/verifikasi') ?>" class="btn btn-md btn-danger">
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
