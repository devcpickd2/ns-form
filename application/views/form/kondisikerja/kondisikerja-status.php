<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kondisi Kerja Selama Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kondisikerja-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kondisi Kerja Selama Produksi
                </a>
            </li>
        </ol>
    </nav>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <?php 
            $tanggal = (new DateTime($kondisikerja->date))->format('d-m-Y');
            $waktu = (new DateTime($kondisikerja->waktu))->format('H:i');
            $nilai_keterangan = [
                '1' => 'Berdebu',
                '2' => 'Basah, ada genangan air',
                '3' => 'Sisa produksi (remah-remah roti, tepung, sisa adonan)',
                '4' => 'Kosmetik',
                '5' => 'Pertumbuhan Mikroorganisme (jamur, bau busuk, biofilm)',
                '6' => 'Kontak / kontaminasi material non halal',
                '7' => 'Higiene karyawan tidak sesuai GMP',
                '✓' => 'Ok, Sesuai SSOP, bersih, bebas najis / material non halal',
                'X' => 'Tidak Ok, tidak sesuai SSOP',
                '-' => 'Tidak ada / Tidak digunakan'
            ];
            function tampilkan_kondisi($nilai, $map) {
                return $map[$nilai] ?? $nilai;
            }
            ?>

            <table class="table table-bordered">
                <thead class="thead-light text-center">
                    <tr>
                        <th colspan="4">KONDISI KERJA SELAMA PRODUKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td><?= $tanggal ?></td>
                        <td><strong>Shift</strong></td>
                        <td><?= $kondisikerja->shift ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pukul</strong></td>
                        <td><?= $waktu ?></td>
                        <td><strong>Area</strong></td>
                        <td><?= $kondisikerja->area ?></td>
                    </tr>
                    <tr class="table-secondary text-center font-weight-bold">
                        <td>Item</td>
                        <td>Kondisi</td>
                        <td>Problem</td>
                        <td>Tindakan Koreksi</td>
                    </tr>
                    <tr>
                        <td>Higiene Karyawan</td>
                        <td><?= tampilkan_kondisi($kondisikerja->kondisi_higiene, $nilai_keterangan); ?></td>
                        <td><?= $kondisikerja->problem_higiene ?: '-' ?></td>
                        <td><?= $kondisikerja->tindakan_higiene ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td>Kebersihan Area</td>
                        <td><?= tampilkan_kondisi($kondisikerja->kondisi_kebersihan, $nilai_keterangan); ?></td>
                        <td><?= $kondisikerja->problem_kebersihan ?: '-' ?></td>
                        <td><?= $kondisikerja->tindakan_kebersihan ?: '-' ?></td>
                    </tr>
                    <tr class="table-info text-center font-weight-bold">
                        <td colspan="4">VERIFIKASI</td>
                    </tr>
                    <tr>
                        <td>QC</td>
                        <td colspan="3"><?= $kondisikerja->username ?></td>
                    </tr>
                    <tr>
                        <td>Produksi</td>
                        <td colspan="3"><?= $kondisikerja->nama_produksi ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- FORM VERIFIKASI (DIBIARKAN DI LUAR TABEL SEPERTI BIASA) -->
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form method="post" action="<?= base_url('kondisikerja/status/'.$kondisikerja->uuid); ?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Status</label>
                        <select name="status_spv" class="form-control <?= form_error('status_spv') ? 'is-invalid' : '' ?>">
                            <option value="1" <?= set_select('status_spv', '1'); ?> <?= $kondisikerja->status_spv == 1 ? 'selected' : ''; ?>>Verified</option>
                            <option value="2" <?= set_select('status_spv', '2'); ?> <?= $kondisikerja->status_spv == 2 ? 'selected' : ''; ?>>Revision</option>
                        </select>
                        <div class="invalid-feedback <?= form_error('status_spv') ? 'd-block' : ''; ?>">
                            <?= form_error('status_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="font-weight-bold">Catatan Revisi</label>
                        <textarea name="catatan_spv" class="form-control"><?= $kondisikerja->catatan_spv; ?></textarea>
                        <div class="invalid-feedback <?= form_error('catatan_spv') ? 'd-block' : ''; ?>">
                            <?= form_error('catatan_spv') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('kondisikerja/verifikasi') ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
    .breadcrumb {
        background-color: #2E86C1;
    }
</style>