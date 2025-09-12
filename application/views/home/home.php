<!DOCTYPE html>
<html>
<head> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Chart.js & SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php if ($this->session->flashdata('success_msg')): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '<?= $this->session->flashdata('success_msg'); ?>',
        showConfirmButton: false,
        timer: 2000
      });
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error_msg')): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '<?= $this->session->flashdata('error_msg'); ?>'
      });
    </script>
  <?php endif; ?>
</head>

<body>
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <?php
      date_default_timezone_set('Asia/Jakarta');
      $days = [
        'Sunday' => 'Minggu','Monday' => 'Senin','Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu','Thursday' => 'Kamis','Friday' => 'Jumat','Saturday' => 'Sabtu'
      ];
      $months = [
        'January' => 'Januari','February' => 'Februari','March' => 'Maret','April' => 'April',
        'May' => 'Mei','June' => 'Juni','July' => 'Juli','August' => 'Agustus',
        'September' => 'September','October' => 'Oktober','November' => 'November','December' => 'Desember'
      ];
      $today = $days[date("l")];
      $now_month = $months[date("F")];
      ?>
      <h3 class="mb-0">Update Hari Ini <?= $today ?>, <?= date("j") ?> <?= $now_month ?> <?= date("Y") ?></h3>
    </div>

    <!-- Ringkasan Produksi -->
    <div class="row">
      <div class="col-md-3">
        <div class="card border-left-primary shadow py-2">
          <div class="card-body">
            <div class="card-title"><b>CURRENT PRODUCT</b></div>
            <?php if (!empty($latest_today)): ?>
              <h4 class="text-primary"><?= is_array($latest_today) ? $latest_today['nama_produk'] : $latest_today->nama_produk; ?></h4>
            <?php else: ?>
              <p>No Process Today</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-left-success shadow py-2">
          <div class="card-body">
            <div class="card-title"><b>LAST PRODUCT CODE</b></div>
            <?php if (!empty($latest_today)): ?>
              <h4 class="text-success"><?= is_array($latest_today) ? $latest_today['kode_produksi'] : $latest_today->kode_produksi; ?></h4>
            <?php else: ?>
              <p>No Process Today</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-left-warning shadow py-2">
          <div class="card-body">
            <div class="card-title"><b>TOTAL BATCH TODAY</b></div>
            <?php if (!empty($latest_today)): ?>
              <h4 class="text-warning"><?= $count_batch; ?></h4>
            <?php else: ?>
              <p>No Process Today</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card border-left-danger shadow py-2">
          <div class="card-body">
            <div class="card-title"><b>PRODUCTION TIME PROCESS</b></div>
            <?php if (!empty($latest_today)): ?>
              <h4 class="text-danger">
                <?= date('H:i', strtotime(is_array($latest_today) ? $latest_today['created_at'] : $latest_today->created_at)) ?>
                -
                <?= date('H:i', strtotime(is_array($latest_today) ? $latest_today['modified_at'] : $latest_today->modified_at)) ?>
              </h4>
            <?php else: ?>
              <p>No Process Today</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <br>
    <div class="card mb-4">
      <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
        GRAFIK SUHU & RH
        <div class="d-flex gap-2">
          <input type="date" id="filterTanggal" class="form-control" style="width:300px;">
          <button id="btnTampilkan" class="btn btn-primary btn-sm">Tampilkan</button>
        </div>
      </div>
      <div class="card-body">
        <canvas id="chartSuhuRH" height="100"></canvas>
      </div>
    </div>

    <br>
    <div class="card mb-4">
      <?php
      $bulanIndo = [
        '01' => 'JANUARI','02' => 'FEBRUARI','03' => 'MARET','04' => 'APRIL',
        '05' => 'MEI','06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
        '09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER','12' => 'DESEMBER'
      ];
      $bulanSekarang = $bulanIndo[date('m')] . ' ' . date('Y');
      ?>
      <div class="card-header font-weight-bold">TEMUAN KONTAMINASI BENDA ASING – <?= $bulanSekarang; ?></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <canvas id="kontaminasiChart" height="120"></canvas>
          </div>
          <div class="col-md-6">
            <table class="table table-bordered table-sm">
              <thead class="thead-light">
                <tr>
                  <th>Jenis Kontaminasi</th>
                  <th>Nama Produk</th>
                  <th>Kode Produksi</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($temuan as $row): ?>
                  <tr>
                    <td><?= $row['jenis_kontaminasi']; ?></td>
                    <td><?= $row['nama_produk']; ?></td>
                    <td><?= $row['kode_produksi']; ?></td>
                    <td><?= $row['jumlah_temuan']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS Chart Kontaminasi -->
<script>
  const rawData = <?= json_encode($jumlah_temuan) ?> || [];
  const tanggalLabels = Array.from({ length: 31 }, (_, i) => (i + 1).toString());
  const data = [];
  const detailMap = {};

  rawData.forEach(item => {
    const tgl = parseInt(item.tanggal.split('-')[2]);
    data[tgl - 1] = parseInt(item.jumlah_temuan);
    detailMap[tgl] = { jumlah: item.jumlah_temuan, produk: item.nama_produk, kontaminasi: item.jenis_kontaminasi };
  });

  for (let i = 0; i < 31; i++) {
    if (!data[i]) data[i] = 0;
    if (!detailMap[i + 1]) detailMap[i + 1] = { jumlah: 0, produk: '-', kontaminasi: '-' };
  }

  new Chart(document.getElementById('kontaminasiChart'), {
    type: 'line',
    data: {
      labels: tanggalLabels,
      datasets: [{
        label: 'Jumlah Temuan',
        data: data,
        fill: true,
        borderColor: '#e74a3b',
        backgroundColor: 'rgba(231, 74, 59, 0.1)',
        tension: 0.3,
        pointRadius: 5,
        pointHoverRadius: 6,
        pointBackgroundColor: '#e74a3b',
        pointBorderColor: '#fff',
      }]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true, min: 0, max: 10, ticks: { stepSize: 1 } } },
      plugins: {
        tooltip: {
          callbacks: {
            label: function(context) {
              const day = parseInt(context.label);
              const d = detailMap[day];
              return [`Jumlah: ${d.jumlah}`, `Produk: ${d.produk}`, `Kontaminasi: ${d.kontaminasi}`];
            }
          }
        }
      }
    }
  });
</script>

<!-- JS Chart Suhu & RH -->
<script>
  let chartSuhu;
  function renderChart(labels, suhuProduksi, suhuFG, rhProduksi, rhFG) {
    if (chartSuhu) chartSuhu.destroy();
    chartSuhu = new Chart(document.getElementById('chartSuhuRH'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [
          { label: 'Suhu Produksi (°C)', data: suhuProduksi, borderColor: '#4e73df', backgroundColor: 'rgba(78,115,223,0.1)', pointBackgroundColor: '#4e73df', yAxisID: 'ySuhu', tension: 0.3 },
          { label: 'Suhu Gudang FG (°C)', data: suhuFG, borderColor: '#1cc88a', backgroundColor: 'rgba(28,200,138,0.1)', pointBackgroundColor: '#1cc88a', yAxisID: 'ySuhu', tension: 0.3 },
          { label: 'RH Produksi (%)', data: rhProduksi, borderColor: '#f6c23e', backgroundColor: 'rgba(246,194,62,0.1)', pointBackgroundColor: '#f6c23e', yAxisID: 'yRH', borderDash: [5,5], tension: 0.3 },
          { label: 'RH Gudang FG (%)', data: rhFG, borderColor: '#e74a3b', backgroundColor: 'rgba(231,74,59,0.1)', pointBackgroundColor: '#e74a3b', yAxisID: 'yRH', borderDash: [5,5], tension: 0.3 }
        ]
      },
      options: {
        responsive: true,
        interaction: { mode: 'nearest', intersect: true },
        plugins: {
          tooltip: {
            callbacks: { label: (ctx) => ctx.dataset.label + ': ' + ctx.formattedValue }
          }
        },
        scales: {
          x: { title: { display: true, text: 'Waktu Pemeriksaan' } },
          ySuhu: { type: 'linear', position: 'left', title: { display: true, text: 'Suhu (°C)' } },
          yRH: { type: 'linear', position: 'right', title: { display: true, text: 'RH (%)' }, beginAtZero: true, suggestedMax: 100, grid: { drawOnChartArea: false } }
        }
      }
    });
  }

  // Default hari ini
  renderChart(
    <?= json_encode($chart_labels) ?>,
    <?= json_encode($chart_suhu_produksi) ?>,
    <?= json_encode($chart_suhu_fg) ?>,
    <?= json_encode($chart_rh_produksi) ?>,
    <?= json_encode($chart_rh_fg) ?>
    );

  // Event klik tombol tampilkan
  $("#btnTampilkan").on("click", function() {
    const tanggal = $("#filterTanggal").val();
    if (!tanggal) {
      Swal.fire('Pilih tanggal dulu!', '', 'warning');
      return;
    }
    $.ajax({
      url: "<?= site_url('home/get_suhu_by_date') ?>",
      type: "POST",
      data: { tanggal: tanggal },
      dataType: "json",
      success: function(res) {
        renderChart(res.labels, res.suhu_produksi, res.suhu_fg, res.rh_produksi, res.rh_fg);
      }
    });
  });
</script>

<?php if ($show_modal): ?>
<!-- Modal Input Produksi -->
<div class="modal fade" id="produksiModal" tabindex="-1" role="dialog" aria-labelledby="produksiModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <form action="<?= site_url('home/set_produksi_data') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Input Data Produksi</h5>
        </div> 
        <div class="modal-body">
          <div class="form-group">
            <label for="tanggal">Tanggal Produksi</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required value="<?= date('Y-m-d') ?>">
          </div>
          <div class="form-group">
            <label for="shift">Shift</label>
            <select name="shift" id="shift" class="form-control" required>
              <option value="">-- Pilih Shift --</option>
              <option value="1">Shift 1</option>
              <option value="2">Shift 2</option>
              <option value="3">Shift 3</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nama_produksi">Nama Produksi</label>
            <select name="nama_produksi" id="nama_produksi" class="form-control" required>
              <option value="">-- Pilih Nama Produksi --</option>
              <?php foreach ($pegawai_produksi as $pegawai): ?>
                <option value="<?= $pegawai->nama ?>"><?= $pegawai->nama ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script> $(document).ready(() => { $('#produksiModal').modal('show'); }); </script>
<?php endif; ?>
</body>
</html>

<style>
  table { border-collapse: collapse; width: 100%; }
  .text-xs, p, li { font-size: 17px; }
  .h3 { font-size: 23px; font-weight: bold; font-style: italic; }
  canvas { cursor: pointer; }
  .table-limited { max-height: 185px; overflow-y: auto; display: block; }
  .table-limited table { width: 100%; border-collapse: collapse; }
  .table-limited th, .table-limited td { padding: 2px 10px; text-align: left; }
</style>

