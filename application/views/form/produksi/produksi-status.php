<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Detail Proses Produksi</h1>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-primary text-white">
      <li class="breadcrumb-item">
        <a class="text-white" href="<?= base_url('produksi'); ?>">
          <i class="fas fa-arrow-left"></i> Daftar Laporan Verifikasi Proses Produksi
        </a>
      </li>
      <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
    </ol>
  </nav>

<?php
// Pastikan raw_mat dan premix selalu array of objects
$rawmat = $produksi->raw_mat;
if (is_string($rawmat)) $rawmat = json_decode($rawmat) ?: [];
elseif (!is_array($rawmat)) $rawmat = [];

$premix = $produksi->premix;
if (is_string($premix)) $premix = json_decode($premix) ?: [];
elseif (!is_array($premix)) $premix = [];

// Fungsi sensori
function sens_icon($val) {
    if ($val == 'oke') return '<i class="fas fa-check-circle text-success"></i> Oke';
    if ($val == 'tidak') return '<i class="fas fa-times-circle text-danger"></i> Tidak';
    return '-';
}
?>

<!-- Info Umum -->
<div class="card shadow mb-4">
    <div class="card-body">
      <table class="table table-bordered">
        <tr><th width="30%">Tanggal</th><td><?= date('d-m-Y', strtotime($produksi->date)) ?></td></tr>
        <tr><th>Shift</th><td><?= $produksi->shift ?></td></tr>
        <tr><th>Nama Produk</th><td><?= $produksi->nama_produk_asli ?? $produksi->nama_produk ?></td></tr>
        <tr><th>Kode Produksi</th><td><?= $produksi->kode_produksi ?></td></tr>
      </table>
    </div>
</div>

<!-- Raw Material -->
<div class="card shadow mb-4">
    <div class="card-header bg-info text-white font-weight-bold">Raw Material</div>
    <div class="card-body">
      <table class="table table-bordered table-hover text-center">
        <thead class="table-primary">
          <tr><th>Nama Bahan</th><th>Kode Bahan</th><th>Berat</th><th>Sensori</th></tr>
        </thead>
        <tbody>
        <?php foreach ($rawmat as $r): ?>
          <tr>
            <td><?= $r->nama ?></td>
            <td><?= $r->kode ?></td>
            <td><?= $r->berat ?></td>
            <td><?= sens_icon($r->sens) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</div>

<!-- Premix -->
<div class="card shadow mb-4">
    <div class="card-header bg-success text-white font-weight-bold">Premix</div>
    <div class="card-body">
      <table class="table table-bordered table-hover text-center">
        <thead class="table-success">
          <tr><th>Nama Premix</th><th>Kode Premix</th><th>Berat</th><th>Sensori</th></tr>
        </thead>
        <tbody>
        <?php foreach ($premix as $p): ?>
          <tr>
            <td><?= $p->nama ?></td>
            <td><?= $p->kode ?></td>
            <td><?= $p->berat ?? '-' ?></td>
            <td><?= sens_icon($p->sens) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</div>

<!-- Hasil Mixing -->
<div class="card shadow mb-4">
    <div class="card-header bg-warning font-weight-bold text-dark">Hasil Mixing</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr><th>Hasil Mixing</th><td><?= $produksi->hasil_mixing ?></td></tr>
        <tr><th>Waktu Mixing Premix (Menit)</th><td><?= $produksi->waktu_mixing_premix ?> menit</td></tr>
      </table>
    </div>
</div>

<!-- Sensori -->
<div class="card shadow mb-4">
    <div class="card-header bg-secondary text-white font-weight-bold">Sensori</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr><th>Rasa</th><td><?= sens_icon($produksi->sens_rasa) ?></td></tr>
        <tr><th>Aroma</th><td><?= sens_icon($produksi->sens_aroma) ?></td></tr>
        <tr><th>Warna</th><td><?= sens_icon($produksi->sens_warna) ?></td></tr>
        <tr><th>Tekstur</th><td><?= sens_icon($produksi->sens_tekstur) ?></td></tr>
      </table>
    </div>
</div>

<!-- Catatan -->
<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white font-weight-bold">Catatan</div>
    <div class="card-body">
      <?= !empty($produksi->catatan) ? nl2br(htmlspecialchars($produksi->catatan)) : '<em>Tidak ada catatan</em>'; ?>
    </div>
</div>

<!-- Verifikasi -->
<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white">Verifikasi</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <tbody>
            <tr><td><strong>QC</strong></td><td><?= $produksi->username; ?></td></tr>
            <tr><td><strong>Produksi</strong></td><td><?= $produksi->nama_produksi; ?></td></tr>
            <tr><td><strong>Status Produksi</strong></td><td><?= $produksi->status_produksi == 1 ? 'Checked' : ($produksi->status_produksi == 2 ? 'Re-Check' : 'Created'); ?></td></tr>
            <tr><td><strong>Catatan Produksi</strong></td><td><?= !empty($produksi->catatan_produksi) ? $produksi->catatan_produksi : 'Tidak ada'; ?></td></tr>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Form Verifikasi SPV -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" method="post" action="<?= base_url('produksi/status/'.$produksi->uuid);?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Status</label>
                    <select class="form-control <?= form_error('status_spv') ? 'invalid' : '' ?>" name="status_spv">
                        <option value="1" <?= set_select('status_spv', '1', $produksi->status_spv==1); ?>>Verified</option>
                        <option value="2" <?= set_select('status_spv', '2', $produksi->status_spv==2); ?>>Revision</option>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('status_spv')) ? 'd-block' : '' ; ?>">
                        <?= form_error('status_spv') ?>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Catatan Revisi</label>
                    <textarea class="form-control" name="catatan_spv"><?= $produksi->catatan_spv; ?></textarea>
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
                    <a href="<?= base_url('produksi/verifikasi')?>" class="btn btn-md btn-danger">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
  .breadcrumb { background-color: #2E86C1; }
  .breadcrumb a { color: white !important; text-decoration: none; }
  .table { font-size: 16px; }
  th { background-color: #f8f9fc; }
  .table td, .table th { vertical-align: middle; }
</style>
