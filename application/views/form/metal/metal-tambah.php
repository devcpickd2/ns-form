<div class="container-fluid">
  <h1 class="h3 text-dark mb-4">Tambah Pemeriksaan Metal Detector</h1>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= base_url('metal') ?>">
          <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Metal Detector
      </a>
  </li>
  <li class="breadcrumb-item active" aria-current="page">Tambah</li>
</ol>
</nav>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <form method="post" action="<?= base_url('metal/tambah'); ?>">
        <?php
        $produksi_input = $this->session->userdata('produksi_input');
        $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
        $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
        ?>

        <table class="table table-bordered table-striped align-middle">
          <tbody>
            <tr>
              <td><strong>Tanggal</strong></td>
              <td colspan="3">
                <input type="date" name="date_metal" class="form-control <?= form_error('date_metal') ? 'is-invalid' : '' ?>" value="<?= set_value('date', $tanggal) ?>">
                <div class="invalid-feedback"><?= form_error('date_metal') ?></div>
            </td>
        </tr>
        <tr>
          <td><strong>Shift</strong></td> 
          <td>
            <select name="shift" class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>">
              <option disabled <?= empty($shift) ? 'selected' : '' ?>>Pilih Shift</option>
              <option value="1" <?= set_select('shift', '1', $shift == '1') ?>>Shift 1</option>
              <option value="2" <?= set_select('shift', '2', $shift == '2') ?>>Shift 2</option>
              <option value="3" <?= set_select('shift', '3', $shift == '3') ?>>Shift 3</option>
          </select>
          <div class="invalid-feedback"><?= form_error('shift') ?></div>
      </td>
      <td><strong>Pukul</strong></td>
      <td>
        <input type="time" name="time" class="form-control <?= form_error('time') ? 'is-invalid' : '' ?>" value="<?= date('H:i') ?>">
        <div class="invalid-feedback"><?= form_error('time') ?></div>
    </td>
</tr>
<tr>
  <td><strong>Nama Produk</strong></td>
  <td>
    <input type="text" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'is-invalid' : '' ?>" value="<?= set_value('nama_produk') ?>">
    <div class="invalid-feedback"><?= form_error('nama_produk') ?></div>
</td>
<td><strong>Kode Produksi</strong></td>
<td>
    <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'is-invalid' : '' ?>" value="<?= set_value('kode_produksi') ?>">
    <div class="invalid-feedback"><?= form_error('kode_produksi') ?></div>
</td>
</tr>
<tr>
  <td><strong>No. Program</strong></td>
  <td>
    <input type="text" name="no_program" class="form-control <?= form_error('no_program') ? 'is-invalid' : '' ?>" value="<?= set_value('no_program') ?>">
    <div class="invalid-feedback"><?= form_error('no_program') ?></div>
</td>
</tr>
<tr class="text-center">
  <th></th>
  <th>Fe</th>
  <th>Non Fe</th>
  <th>SUS 316</th>
</tr>
<tr>
  <td><strong>Standar</strong></td>
  <td>
    <select name="std_fe" class="form-control text-center">
        <option value="1.5">1.5</option>
        <option value="2.0">2.0</option>
    </select>
</td>
<td>
    <input type="text" readonly class="form-control text-center" name="std_nonfe"
    value="2.0">
</td>
<td>
    <input type="text" readonly class="form-control text-center" name="std_sus316"
    value="2.5">
</td>
</tr>

<tr class="bg-light text-center">
  <th></th>
  <th>Depan</th>
  <th>Tengah</th>
  <th>Belakang</th>
</tr>
<?php
$deteksi = [
  'fe' => 'Deteksi FE',
  'nonfe' => 'Deteksi Non-FE',
  'sus' => 'Deteksi SUS 316'
];
foreach ($deteksi as $key => $label):
  ?>
  <tr>
    <td><strong><?= $label ?></strong></td>
    <?php foreach (["d" => "Depan", "t" => "Tengah", "b" => "Belakang"] as $pos => $pos_label): ?>
      <td class="text-center">
        <input type="checkbox" style="width: 25px; height: 25px;" name="<?= $key . '_' . $pos ?>" value="terdeteksi" <?= set_value($key . '_' . $pos) == 'terdeteksi' ? 'checked' : '' ?>>
    </td>
<?php endforeach; ?>
</tr>
<?php endforeach; ?>
<tr>
  <td><strong>Keterangan</strong></td>
  <td colspan="3"><textarea name="keterangan" class="form-control"><?= set_value('keterangan') ?></textarea></td>
</tr>
<tr>
  <td><strong>Catatan</strong></td>
  <td colspan="3"><textarea name="catatan_metal" class="form-control"><?= set_value('catatan_metal') ?></textarea></td>
</tr>
</tbody>
</table>

<div class="mt-3">
  <button type="submit" class="btn btn-success me-2"><i class="fa fa-save"></i> Simpan</button>
  <a href="<?= base_url('metal') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
</div>
</form>
</div>
</div>
</div>

<style>
  .breadcrumb {
    background-color: #2E86C1;
}
.table td, .table th {
    vertical-align: middle;
}
</style>