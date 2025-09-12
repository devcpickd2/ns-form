<div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800">Detail Retain Sample Report</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('retain-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Retain Sample Report
                </a>
            </li>
        </ol>
    </nav>

    <!-- Card Detail -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php 
            $datetime = (new DateTime($retain->date))->format('d-m-Y');
            $bb = (new DateTime($retain->best_before))->format('d-m-Y');
            $description_data = json_decode($retain->deskripsi, true);
            ?>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" colspan="6">RETAIN SAMPLE REPORT</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr>
                        <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                        <td colspan="5"><b>Plant : <?= $retain->plant;?><b></td>
                        </tr>
                        <tr>
                            <td>Sample Type</td>
                            <td colspan="5"><?= $retain->sample_type;?></td>
                        </tr>
                        <tr>
                            <td>Sample Storage</td>
                            <td colspan="5"><?= $retain->sample_storage;?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td colspan="5"><?= $retain->deskripsi;?></td>
                        </tr>
                        <tr>
                            <td>Production Code</td>
                            <td colspan="5"><?= $retain->kode_produksi;?></td>
                        </tr>
                        <tr>
                            <td>Best Before</td>
                            <td colspan="5"><?= $retain->best_before;?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td colspan="5"><?= $retain->quantity;?></td>
                        </tr>
                        <tr>
                            <td>Remarks</td>
                            <td colspan="5"><?= $retain->remark;?></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td colspan="5"> <?= !empty($retain->catatan) ? $retain->catatan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td>QC</td>
                            <td colspan="5"><?= $retain->username;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('retain/status/' . $retain->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select name="status_spv" class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>">
                            <option value="1" <?= set_select('status_spv', '1', $retain->status_spv == 1); ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2', $retain->status_spv == 2); ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback d-block">
                            <?= form_error('status_spv'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea name="catatan_spv" class="form-control <?= form_error('catatan_spv') ? 'is-invalid' : '' ?>"><?= $retain->catatan_spv; ?></textarea>
                        <div class="invalid-feedback d-block">
                            <?= form_error('catatan_spv'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('retain/verifikasi') ?>" class="btn btn-danger">
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
        color: white;
    }

    .breadcrumb a {
        color: white;
        text-decoration: none;
    }

    .table th, .table td {
        vertical-align: middle;
        white-space: normal !important;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .invalid-feedback {
        font-size: 0.875em;
    }
</style>
