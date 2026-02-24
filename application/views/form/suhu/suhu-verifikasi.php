<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-2 text-gray-800">Daftar Pemeriksaan Suhu Ruang</h1>
	</div>

	<?php if($this->session->flashdata('success_msg')): ?>
		<div class="alert alert-success text-center">
			<i class="fas fa-check"></i> <?= $this->session->flashdata('success_msg') ?>
		</div>
	<?php endif ?>

	<?php if($this->session->flashdata('error_msg')): ?>
		<div class="alert alert-danger text-center">
			<i class="fas fa-times"></i> <?= $this->session->flashdata('error_msg') ?>
		</div>
	<?php endif ?> 

	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead class="thead-light">
						<tr class="text-center">
							<th>No</th>
							<th>Tanggal / Shift</th>
							<th>Pukul</th>
							<th>Lokasi</th>
							<th>Suhu (°C) / RH (%)</th>
							<th>Last Updated</th>
							<th>Last Verified</th>
							<th>SPV</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						foreach($suhu as $val): 
							$datetime = date('d-m-Y', strtotime($val->date));
							$lokasi_data = json_decode($val->lokasi, true);
							$suhu_data = json_decode($val->suhu, true);
							$rh_data = json_decode($val->rh, true);
							?>
							<tr>
								<td class="text-center"><?= $no++; ?></td>
								<td><?= $datetime . " / Shift " . $val->shift; ?></td>
								<td><?= date('H:i', strtotime($val->pukul)); ?></td>
								<td>
									<?php 
									if (is_array($lokasi_data)) {
										foreach($lokasi_data as $lok) {
											echo '<div>' . $lok['nama'] . '</div>';
										}
									} else {
										echo '<em>Format salah</em>';
									}
									?>
								</td>
								<td>
									<?php 
									if (is_array($lokasi_data)) {
										foreach ($lokasi_data as $i => $lok) {
											$s = isset($lok['suhu']) ? $lok['suhu'] : '-';
											$r = isset($lok['rh']) ? $lok['rh'] : '-';
											echo '<div>' . $s . ' / ' . $r . '</div>';
										}
									} else {
										echo '-';
									}
									?>
								</td>
								<td><?= !empty($val->modified_at) ? date('H:i - d/m/Y', strtotime($val->modified_at)) : '-' ?></td>
								<td><?= !empty($val->tgl_update_spv) ? date('H:i - d/m/Y', strtotime($val->tgl_update_spv)) : '-' ?></td>
								<td class="text-center">
									<?php
									$status_spv = [
										0 => ['label' => 'Created', 'color' => '#99a3a4'],
										1 => ['label' => 'Verified', 'color' => '#28b463'],
										2 => ['label' => 'Revision', 'color' => 'red']
									];
									$ss = $val->status_spv;
									echo "<span style='color: {$status_spv[$ss]['color']}; font-weight: bold;'>{$status_spv[$ss]['label']}</span>";
									?>
								</td>
								<td class="text-center">
									<a href="<?= base_url('suhu/status/'.$val->uuid);?>" class="btn btn-warning btn-sm">
										<i class="fas fa-edit"></i> Verifikasi
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>

			<hr>

			<form action="<?= base_url('suhu/cetak') ?>" method="post" target="_blank" class="form-inline mb-3">
				<div class="form-group mr-3">
					<label for="tanggal" class="mr-2 font-weight-bold">Pilih Tanggal:</label>
					<input type="date" name="tanggal" id="tanggal" class="form-control" required>
				</div>

				<button type="submit" class="btn btn-success mr-2">
					<i class="fas fa-print"></i> Cetak PDF
				</button>

				<button type="submit" formaction="<?= base_url('suhu/export-excel') ?>" class="btn btn-primary">
					<i class="fas fa-file-excel"></i> Export Excel
				</button>
			</form>
		</div>
	</div>
</div>
</div>

<style> 
	th {
		background-color: #f8f9fc;
	}
</style>
