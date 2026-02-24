<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Data Release Packing</h1>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('releasepacking-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Data Release Packing
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" cellspacing="0">
                    <?php 
                    $datetime = new DateTime($releasepacking->date);
                    $formattedDate = $datetime->format('d-m-Y');
                    ?>
                    <thead class="text-center">
                        <tr>
                            <th colspan="7" class="font-weight-bold">DATA RELEASE PACKING</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7"><b>Tanggal:</b> <?= $formattedDate; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Produk</td>
                            <td colspan="6"><?= $releasepacking->nama_produk; ?></td>
                        </tr>
                        <tr>
                            <td>Kode Produksi</td>
                            <td colspan="6"><?= $releasepacking->kode_produksi; ?></td>
                        </tr>
                        <tr>
                            <td>Best Before</td>
                            <td colspan="6"><?= $releasepacking->best_before; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td colspan="6"><?= $releasepacking->jumlah; ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td colspan="6"><?= $releasepacking->keterangan; ?></td>
                        </tr>
                        <tr>
                            <td>QC</td>
                            <td colspan="6"><?= $releasepacking->username; ?></td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('releasepacking/status/'.$releasepacking->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1', $releasepacking->status_spv == 1); ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2', $releasepacking->status_spv == 2); ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : '' ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>" name="catatan_spv"><?= $releasepacking->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv')) ? 'd-block' : '' ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('releasepacking/verifikasi') ?>" class="btn btn-md btn-danger">
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
