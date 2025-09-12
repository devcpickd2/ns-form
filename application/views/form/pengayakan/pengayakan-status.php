<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold text-center">Detail Pemeriksaan Pengayakan</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-white" href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('pengayakan'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Pengayakan
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php $datetime = new DateTime($pengayakan->date); ?>
                <table class="table table-bordered" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th colspan="7" class="text-center font-weight-bold">PEMERIKSAAN PENGAYAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Tanggal:</b> <?= $datetime->format('d-m-Y'); ?></td>
                            <td><b>Shift:</b> <?= $pengayakan->shift; ?></td>
                            <td colspan="4"></td>
                        </tr>
                        <tr class="bg-light text-center">
                            <td colspan="7" class="font-weight-bold">Hasil Pemeriksaan</td>
                        </tr>
                        <tr>
                            <td><b>Nama Barang</b></td>
                            <td colspan="6"><?= $pengayakan->nama_barang; ?></td>
                        </tr>
                        <tr>
                            <td><b>Kode Produksi</b></td>
                            <td colspan="6"><?= $pengayakan->kode_produksi; ?></td>
                        </tr>
                        <tr>
                            <td><b>Expired Date</b></td>
                            <td colspan="6"><?= $pengayakan->expired_date; ?></td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Barang</b></td>
                            <td colspan="6"><?= $pengayakan->jumlah_barang; ?></td>
                        </tr>
                        <tr class="table-primary text-center">
                            <th><b>Kontaminasi Benda Asing</b></th>
                            <th>Screen Mess</th>
                            <th>Kerikil</th>
                            <th>Benang</th>
                            <th colspan="3"></th>
                        </tr>
                        <tr class="text-center">
                            <td>Jumlah</td>
                            <td><?= $pengayakan->kba_screenmess; ?></td>
                            <td><?= $pengayakan->kba_kerikil; ?></td>
                            <td><?= $pengayakan->kba_benang; ?></td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td><b>Kondisi Screen Ayakan</b></td>
                            <td colspan="6"><?= $pengayakan->kondisi; ?></td>
                        </tr>
                        <tr class="bg-light">
                            <td><b>Catatan</b></td>
                            <td colspan="6"><?= !empty($pengayakan->catatan) ? $pengayakan->catatan : 'Tidak ada'; ?></td>
                        </tr>
                        <tr class="table-primary text-center">
                            <th colspan="7">VERIFIKASI</th>
                        </tr>
                        <tr>
                            <td><b>QC</b></td>
                            <td colspan="6"><?= $pengayakan->username; ?></td>
                        </tr>
                        <tr>
                            <td><b>Produksi</b></td>
                            <td colspan="6"><?= !empty($pengayakan->nama_produksi) ? $pengayakan->nama_produksi : 'Belum dikoreksi'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Form Verifikasi -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('pengayakan/status/'.$pengayakan->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_spv') ? 'invalid' : '' ?>" name="status_spv">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $pengayakan->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $pengayakan->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : ''; ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control" name="catatan_spv"><?= $pengayakan->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan_spv')) ? 'd-block' : ''; ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('pengayakan/verifikasi') ?>" class="btn btn-danger">
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
