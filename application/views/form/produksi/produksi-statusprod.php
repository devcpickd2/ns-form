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
function sens_icon($val) {
    if ($val == 'oke') return '<i class="fas fa-check-circle text-success"></i> Oke';
    if ($val == 'tidak') return '<i class="fas fa-times-circle text-danger"></i> Tidak';
    return '-';
}
?>

<div class="card shadow mb-4">
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th width="30%">Tanggal</th>
          <td><?= date('d-m-Y', strtotime($produksi->date)) ?></td>
      </tr>
      <tr>
          <th>Shift</th>
          <td><?= $produksi->shift ?></td>
      </tr>
      <tr>
          <th>Nama Produk</th>
          <td><?= $produksi->nama_produk ?></td>
      </tr>
      <tr>
          <th>Kode Produksi</th>
          <td><?= $produksi->kode_produksi ?></td>
      </tr>
  </table>
</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header bg-info text-white font-weight-bold">Raw Material</div>
    <div class="card-body">
      <table class="table table-bordered table-hover text-center">
        <thead class="table-primary">
          <tr>
            <th>Nama Bahan</th>
            <th>Kode Bahan</th>
            <th>Berat</th>
            <th>Sensori</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $rawmat = json_decode($produksi->raw_mat, true) ?: [];
      foreach ($rawmat as $r) {
        echo "<tr>
        <td>{$r['nama']}</td>
        <td>{$r['kode']}</td>
        <td>{$r['berat']}</td>
        <td>" . sens_icon($r['sens']) . "</td>
        </tr>";
    }
    ?>
</tbody>
</table>
</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header bg-success text-white font-weight-bold">Premix</div>
    <div class="card-body">
      <table class="table table-bordered table-hover text-center">
        <thead class="table-success">
          <tr>
            <th>Nama Premix</th>
            <th>Kode Premix</th>
            <th>Sensori</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $premix = json_decode($produksi->premix, true) ?: [];
      foreach ($premix as $p) {
        echo "<tr>
        <td>{$p['nama']}</td>
        <td>{$p['kode']}</td>
        <td>" . sens_icon($p['sens']) . "</td>
        </tr>";
    }
    ?>
</tbody>
</table>
</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header bg-warning font-weight-bold text-dark">Hasil Mixing</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Hasil Mixing</th>
          <td><?= $produksi->hasil_mixing ?></td>
      </tr>
      <tr>
          <th>Waktu Mixing Premix (Menit)</th>
          <td><?= $produksi->waktu_mixing_premix ?> menit</td>
      </tr>
  </table>
</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header bg-secondary text-white font-weight-bold">Sensori</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Rasa</th>
          <td><?= sens_icon($produksi->sens_rasa) ?></td>
      </tr>
      <tr>
          <th>Aroma</th>
          <td><?= sens_icon($produksi->sens_aroma) ?></td>
      </tr>
      <tr>
          <th>Warna</th>
          <td><?= sens_icon($produksi->sens_warna) ?></td>
      </tr>
      <tr>
          <th>Tekstur</th>
          <td><?= sens_icon($produksi->sens_tekstur) ?></td>
      </tr>
  </table>
</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white font-weight-bold">Catatan</div>
    <div class="card-body">
      <?= !empty($produksi->catatan) ? nl2br(htmlspecialchars($produksi->catatan)) : '<em>Tidak ada catatan</em>'; ?>
  </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header bg-dark text-white font-weight-bold">Verifikasi</div>
    <div class="card-body">
       <table class="table table-bordered table-striped">
          <tbody>
            <tr><td><strong>QC</strong></td><td><?= $produksi->username; ?></td></tr>
        </tbody>
    </table>
</div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" method="post" action="<?= base_url('produksi/statusprod/'.$produksi->uuid);?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Status</label>
                    <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                        <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $produksi->status_produksi == 1?'selected':'';?>>Checked</option>
                        <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $produksi->status_produksi == 2?'selected':'';?>>Re-Check</option>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ; ?> ">
                        <?= form_error('shift') ?>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Catatan Revisi</label>
                    <textarea class="form-control" name="catatan_produksi" ><?= $produksi->catatan_produksi; ?></textarea>
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
                    <a href="<?= base_url('produksi/diketahui')?>" class="btn btn-md btn-danger">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<style>
  .breadcrumb {
    background-color: #2E86C1;
}
.breadcrumb a {
    color: white !important;
    text-decoration: none;
}
.table {
    font-size: 20px;
}
th {
    background-color: #f8f9fc;
}
.table td, .table th {
    vertical-align: middle;
}
</style>
