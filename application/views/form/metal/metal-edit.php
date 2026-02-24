<div class="container-fluid">
  <h1 class="h3 text-dark mb-4">Update Pemeriksaan Metal Detector</h1>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= base_url('metal') ?>">
          <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Metal Detector
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
  </nav>

  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <form method="post" action="<?= base_url('metal/edit/' . $metal->uuid); ?>">
        <!-- <?php
        $plant_uuid = $this->session->userdata('plant');
        $plant_map = [
          '651ac623-5e48-44cc-b2f6-5d622603f53c' => 'Cikande 2 Bread Crumb',
          '1eb341e0-1ec4-4484-ba8f-32d23352b84d' => 'Salatiga Bread Crumb'
        ];
        $plant_name = $plant_map[$plant_uuid] ?? 'unknown';
      ?> -->

      <table class="table table-bordered table-striped align-middle">
        <tbody>
          <tr>
            <td><strong>Tanggal</strong></td>
            <td colspan="3">
              <input type="date" name="date_metal" class="form-control <?= form_error('date_metal') ? 'is-invalid' : '' ?>" value="<?= $metal->date_metal ?>">
              <div class="invalid-feedback"><?= form_error('date_metal') ?></div>
            </td>
          </tr>
          <tr>
            <td><strong>Shift</strong></td>
            <td>
              <select name="shift" class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>">
                <option value="1" <?= $metal->shift == '1' ? 'selected' : '' ?>>Shift 1</option>
                <option value="2" <?= $metal->shift == '2' ? 'selected' : '' ?>>Shift 2</option>
                <option value="3" <?= $metal->shift == '3' ? 'selected' : '' ?>>Shift 3</option>
              </select>
              <div class="invalid-feedback"><?= form_error('shift') ?></div>
            </td>
            <td><strong>Pukul</strong></td>
            <td>
              <input type="time" name="time" class="form-control <?= form_error('time') ? 'is-invalid' : '' ?>" value="<?= $metal->time ?>">
              <div class="invalid-feedback"><?= form_error('time') ?></div>
            </td>
          </tr>
          <tr>
            <td><strong>Nama Produk</strong></td>
            <td>
              <input type="text" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'is-invalid' : '' ?>" value="<?= $metal->nama_produk ?>">
              <div class="invalid-feedback"><?= form_error('nama_produk') ?></div>
            </td>
            <td><strong>Kode Produksi</strong></td>
            <td>
              <input type="text" name="kode_produksi" class="form-control <?= form_error('kode_produksi') ? 'is-invalid' : '' ?>" value="<?= $metal->kode_produksi ?>">
              <div class="invalid-feedback"><?= form_error('kode_produksi') ?></div>
            </td>
          </tr>
          <tr>
            <td><strong>No. Program</strong></td>
            <td>
              <input type="text" name="no_program" class="form-control <?= form_error('no_program') ? 'is-invalid' : '' ?>" value="<?= $metal->no_program ?>">
              <div class="invalid-feedback"><?= form_error('no_program') ?></div>
            </td>
              <!-- <td><strong>Deteksi NG</strong></td>
              <td>
                <select name="deteksi_ng" class="form-control <?= form_error('deteksi_ng') ? 'is-invalid' : '' ?>">
                  <option value="-" <?= $metal->deteksi_ng == '-' ? 'selected' : '' ?>>Tidak Ada</option>
                  <option value="1" <?= $metal->deteksi_ng == '1' ? 'selected' : '' ?>>Belt Conveyor Berhenti</option>
                  <option value="2" <?= $metal->deteksi_ng == '2' ? 'selected' : '' ?>>Rejector</option>
                </select>
                <div class="invalid-feedback"><?= form_error('deteksi_ng') ?></div>
              </td> -->
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
                  <option value="1.5" <?= ($metal->std_fe == '1.5') ? 'selected' : '' ?>>1.5</option>
                  <option value="2.0" <?= ($metal->std_fe == '2.0') ? 'selected' : '' ?>>2.0</option>
                </select>
              </td>
              <td>
                <input type="text" readonly class="form-control text-center" name="std_nonfe"
                value="<?= $metal->std_nonfe ?>">
              </td>
              <td>
                <input type="text" readonly class="form-control text-center" name="std_sus316"
                value="<?= $metal->std_sus316 ?>">
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
              'sus' => 'Deteksi SUS 304'
            ];
            foreach ($deteksi as $key => $label):
              ?>
              <tr>
                <td><strong><?= $label ?></strong></td>
                <?php foreach (["d" => "Depan", "t" => "Tengah", "b" => "Belakang"] as $pos => $pos_label): ?>
                  <td class="text-center">
                    <input type="checkbox" style="width: 25px; height: 25px;" name="<?= $key . '_' . $pos ?>" value="terdeteksi"
                    <?= $metal->{$key . '_' . $pos} == 'terdeteksi' ? 'checked' : '' ?>>
                  </td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>

            <tr>
              <td><strong>Keterangan</strong></td>
              <td colspan="3"><textarea name="keterangan" class="form-control"><?= $metal->keterangan ?></textarea></td>
            </tr>
            <tr>
              <td><strong>Catatan</strong></td>
              <td colspan="3"><textarea name="catatan_metal" class="form-control"><?= $metal->catatan_metal ?></textarea></td>
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
