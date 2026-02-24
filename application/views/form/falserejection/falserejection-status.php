<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-3 text-center text-gray-800 font-weight-bold border-bottom pb-2">Detail Monitoring False Rejection</h1> -->

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('falserejection-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Monitoring False Rejection
                </a>
            </li>
        </ol>
    </nav>

    <!-- Detail Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php 
                $datetime = (new DateTime($falserejection->date_false_rejection))->format('d-m-Y');
                ?>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th colspan="2" class="font-weight-bold text-center">MONITORING FALSE REJECTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td><b><?= $datetime; ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Shift</b></td>
                            <td><b><?= $falserejection->shift_monitoring; ?></b></td>
                        </tr>
                        <tr>
                            <td>Mesin</td>
                            <td><?= $falserejection->no_mesin; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Produk</td>
                            <td><?= $falserejection->nama_produk; ?></td>
                        </tr>
                        <tr>
                            <td>Kode Produksi</td>
                            <td><?= $falserejection->kode_produksi; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Pack/Bag Tidak Lolos</td>
                            <td><?= !empty($falserejection->jumlah_tidak_lolos) ? $falserejection->jumlah_tidak_lolos : '0'; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Pack/Bag Terdapat Kontaminasi</td>
                            <td><?= !empty($falserejection->jumlah_kontaminasi) ? $falserejection->jumlah_kontaminasi : '0'; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kontaminasi</td>
                            <td><?= $falserejection->jenis_kontaminasi; ?></td>
                        </tr>
                        <tr>
                            <td>Posisi Kontaminasi</td>
                            <td><?= $falserejection->posisi_kontaminasi; ?></td>
                        </tr>
                        <tr>
                            <td>False Rejection</td>
                            <td><?= !empty($falserejection->falserejection) ? $falserejection->falserejection : '0'; ?></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><?= !empty($falserejection->catatan) ? $falserejection->catatan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td>QC</td>
                            <td><?= !empty($falserejection->username_2) ? $falserejection->username_2 : 'Tidak ada'; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Produksi</td>
                            <td><?= !empty($falserejection->nama_produksi_false) ? $falserejection->nama_produksi_false : 'Tidak ada'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('falserejection/status/'.$falserejection->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv_false') ? 'is-invalid' : '' ?>" name="status_spv_false">
                            <option value="1" <?= set_select('status_spv_false', '1'); ?> <?= $falserejection->status_spv_false == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv_false', '2'); ?> <?= $falserejection->status_spv_false == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv_false')) ? 'd-block' : '' ; ?>">
                            <?= form_error('status_spv_false') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control <?= form_error('catatan_spv_false') ? 'is-invalid' : '' ?>" name="catatan_spv_false"><?= $falserejection->catatan_spv_false; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv_false')) ? 'd-block' : '' ; ?>">
                            <?= form_error('catatan_spv_false') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-md mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('falserejection/verifikasi'); ?>" class="btn btn-danger btn-md">
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
