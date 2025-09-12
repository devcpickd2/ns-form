<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kebersihan Ruang Produksi</h1>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kebersihanruang-diketahui'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Ruang Produksi
                </a>
            </li>
        </ol>
    </nav>

    <!-- Data Card -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php 
                $datetime = new DateTime($kebersihanruang->date);
                $formattedDate = $datetime->format('d-m-Y');
                $details = json_decode($kebersihanruang->detail, true);
                $kondisiMap = [
                    '0' => 'Bersih',
                    '1' => 'Berdebu',
                    '2' => 'Basah',
                    '3' => 'Pecah/Retak',
                    '4' => 'Sisa produksi (terigu/produk)',
                    '5' => 'Noda (tinta, karat)',
                    '6' => 'Pertumbuhan mikroorganisme (jamur/bau busuk)',
                ];
                ?>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="6" style="text-align:center;">KEBERSIHAN RUANG PRODUKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"><b>Tanggal:</b> <?= $formattedDate; ?></td>
                            <td colspan="4"><b>Shift:</b> <?= $kebersihanruang->shift; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Lokasi</b></td>
                            <td colspan="4"><?= htmlspecialchars($kebersihanruang->lokasi); ?></td>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align:center;">DETAIL PEMERIKSAAN</th>
                        </tr>
                        <tr style="background-color:#2E86C1; color:#fff; text-align:center;">
                            <th>No</th>
                            <th colspan="2">Bagian</th>
                            <th>Kondisi</th>
                            <th>Problem</th>
                            <th>Tindakan</th>
                        </tr>
                        <?php if (!empty($details) && is_array($details)): ?>
                        <?php foreach ($details as $i => $row): ?>
                            <tr>
                                <td style="text-align:center;"><?= $i + 1; ?></td>
                                <td colspan="2"><?= htmlspecialchars($row['bagian']); ?></td>
                                <td style="text-align:center;"><?= $kondisiMap[$row['kondisi']] ?? htmlspecialchars($row['kondisi']); ?></td>
                                <td><?= !empty($row['problem']) ? htmlspecialchars($row['problem']) : '-'; ?></td>
                                <td><?= !empty($row['tindakan']) ? htmlspecialchars($row['tindakan']) : '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">Tidak ada data detail</td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th colspan="6" style="text-align:center;">VERIFIKASI</th>
                    </tr>
                    <tr>
                        <td colspan="2">QC</td>
                        <td colspan="4"><?= htmlspecialchars($kebersihanruang->username); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" method="post" action="<?= base_url('kebersihanruang/statusprod/'.$kebersihanruang->uuid);?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Status</label>
                    <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                        <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $kebersihanruang->status_produksi == 1?'selected':'';?>>Checked</option>
                        <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $kebersihanruang->status_produksi == 2?'selected':'';?>>Re-Check</option>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                        <?= form_error('status_produksi') ?>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Catatan Revisi</label>
                    <textarea class="form-control" name="catatan_produksi" ><?= $kebersihanruang->catatan_produksi; ?></textarea>
                    <div class="invalid-feedback <?= !empty(form_error('catatan_produksi')) ? 'd-block' : '' ; ?> ">
                        <?= form_error('catatan_produksi') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-md btn-success mr-2">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('kebersihanruang/diketahui')?>" class="btn btn-md btn-danger">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<!-- Styles -->
<style type="text/css">
    .breadcrumb {
        background-color: #2E86C1;
    }
    .table {
        width: 100%;
        font-size: 16px;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 6px 8px;
        border: 1px solid #ddd;
        word-wrap: break-word;
    }
    .table th:first-child,
    .table td:first-child {
        width: 50px;
        max-width: 50px;
        text-align: center;
    }
</style>
