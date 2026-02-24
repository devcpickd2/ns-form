<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Data Kondisi Kerja Selama Produksi</h1>
</div>

<?php if($this->session->flashdata('success_msg')): ?>
    <div class="alert alert-success text-center">
      <i class="fas fa-check"></i>
      <?= $this->session->flashdata('success_msg') ?>
  </div><br>
<?php endif; ?>

<?php if($this->session->flashdata('error_msg')): ?>
    <div class="alert alert-danger text-center">
      <i class="fas fa-check"></i>
      <?= $this->session->flashdata('error_msg') ?>
  </div><br>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
      <!-- FORM CETAK PDF -->
      <form action="<?= base_url('kondisikerja/cetak') ?>" method="post">

          <!-- Tabel utama -->
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="20px" class="text-center">No</th>
                  <th>Tanggal / Shift</th>
                  <th>Area</th>
                  <th>Item</th>
                  <th>Kondisi</th>
                  <th>Problem</th>
                  <th>Tindakan Koreksi</th>
                  <th>Supervisor</th>
                  <th class="text-center">Action</th>
              </tr>
          </thead>
          <tbody>
            <?php if (empty($kondisikerja)): ?>
              <tr>
                <td colspan="9" class="text-center">No data available</td>
            </tr>
        <?php else: 
          $no = 1;
          foreach ($kondisikerja as $val): 
            $dateRaw = !empty($val->date) ? $val->date : null;
            try { $formatted_date = $dateRaw ? (new DateTime($dateRaw))->format('d-m-Y') : '-'; }
            catch(Exception $e) { $formatted_date = '-'; }

            $status_spv = [
              0 => ['label'=>'Created','color'=>'#99a3a4'],
              1 => ['label'=>'Verified','color'=>'#28b463'],
              2 => ['label'=>'Revision','color'=>'red']
          ];
          $supervisorHtml = $val->status_spv == 2
          ? '<a href="#" class="text-danger font-weight-bold" data-toggle="modal" data-target="#modalSpv'.htmlspecialchars($val->uuid).'">'.$status_spv[2]['label'].'</a>'
          : '<span style="color:'.$status_spv[$val->status_spv]['color'].'; font-weight:bold;">'.$status_spv[$val->status_spv]['label'].'</span>';

          $actionHtml = '<a href="'.base_url('kondisikerja/status/'.htmlspecialchars($val->uuid)).'" class="btn btn-warning btn-sm">Verifikasi</a>';
          ?>
          <!-- Baris 1 Higiene -->
          <tr>
            <td class="text-center"><?= $no ?></td>
            <td><?= htmlspecialchars($formatted_date . ' / ' . $val->shift) ?></td>
            <td><?= htmlspecialchars($val->area) ?></td>
            <td>Higiene Karyawan</td>
            <td><?= htmlspecialchars($val->kondisi_higiene) ?></td>
            <td><?= htmlspecialchars($val->problem_higiene) ?></td>
            <td><?= htmlspecialchars($val->tindakan_higiene) ?></td>
            <td class="text-center"><?= $supervisorHtml ?></td>
            <td class="text-center"><?= $actionHtml ?></td>
        </tr>

        <!-- Baris 2 Kebersihan -->
        <tr>
            <td class="text-center"></td>
            <td></td>
            <td></td>
            <td>Kebersihan Area</td>
            <td><?= htmlspecialchars($val->kondisi_kebersihan) ?></td>
            <td><?= htmlspecialchars($val->problem_kebersihan) ?></td>
            <td><?= htmlspecialchars($val->tindakan_kebersihan) ?></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
        </tr>

        <?php 
        $no++;
    endforeach; 
endif; ?>
</tbody>
</table>
</div>
<hr>
<div class="mt-4">
  <label class="font-weight-bold">Pilih tanggal untuk mencetak PDF:</label>
  <div class="form-inline">
    <input type="date" name="tanggal" class="form-control mr-2" required>
    <button type="submit" class="btn btn-success">
      <i class="fas fa-print"></i> Cetak PDF
  </button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

<!-- MODAL Supervisor -->
<?php if (!empty($kondisikerja)): ?>
  <?php foreach ($kondisikerja as $val): ?>
    <?php if ($val->status_spv == 2): ?>
      <div class="modal fade" id="modalSpv<?= htmlspecialchars($val->uuid) ?>" tabindex="-1" role="dialog" aria-labelledby="modalSpvLabel<?= htmlspecialchars($val->uuid) ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="modalSpvLabel<?= htmlspecialchars($val->uuid) ?>">Detail Supervisor (Revision)</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <table class="table table-bordered">
                <tr><th style="width:40%;">Status</th><td><span class="text-danger font-weight-bold">Revision</span></td></tr>
                <tr><th>Catatan</th><td><?= !empty($val->catatan_spv) ? htmlspecialchars($val->catatan_spv) : 'Tidak ada' ?></td></tr>
            </table>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
    </div>
</div>
</div>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>

<style>
  th { background-color:#f8f9fc; }
  table.table { border-collapse: collapse !important; table-layout: fixed; width:100%; }
  table.table td, table.table th { border:1px solid #dee2e6 !important; vertical-align: middle; padding:10px; }
</style>

<script>
    $(document).ready(function(){
      if ($('#dataTable tbody tr').length) {
        $('#dataTable').DataTable({
          ordering: false,
          searching: true,
          autoWidth: false,
          columns: [null,null,null,null,null,null,null,null,null]
      });
    }
});
</script>
