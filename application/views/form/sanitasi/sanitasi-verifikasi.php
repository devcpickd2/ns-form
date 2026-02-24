<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Daftar Pemeriksaan Sanitasi</h1>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item active"><i class="fas fa-clipboard-list"></i> Pemeriksaan Sanitasi</li>
		</ol>
	</nav>

	<?php if($this->session->flashdata('success_msg')): ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success_msg') ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	<?php endif ?>

	<?php if($this->session->flashdata('error_msg')): ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<i class="fas fa-times-circle"></i> <?= $this->session->flashdata('error_msg') ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
	<?php endif ?>

	<div class="card shadow mb-4">
		<div class="card-body">
			<form action="<?= base_url('sanitasi/cetak') ?>" method="post" id="form_cetak_pdf">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%">
						<thead class="thead-light">
							<tr>
								<th class="text-center">No</th>
								<th>Tanggal / Shift</th>
								<th>Pukul</th>
								<th>Standar (50 ppm)</th>
								<th>Aktual Hand Basin</th>
								<th>Keterangan</th>
								<th>Last Updated</th>
								<th>Last Verified</th>
								<th>SPV</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach($sanitasi as $val): 
							$tanggal = (new DateTime($val->date))->format('d-m-Y');
							$waktu   = (new DateTime($val->waktu))->format('H:i');
							?>
							<tr>
								<td class="text-center"><?= $no++; ?></td>
								<td><?= $tanggal . " / Shift " . $val->shift ?></td>
								<td class="text-center"><?= $waktu ?></td>
								<td class="text-center">
									<?php if ($val->std_handbasin == 'Sesuai'): ?>
										<i class="fas fa-check text-success"></i>
									<?php else: ?>
										<i class="fas fa-times text-danger"></i>
									<?php endif; ?>
								</td>

								<td>
									<?php if (!empty($val->hand_basin)): ?>
										<img src="<?= base_url('uploads/' . $val->hand_basin); ?>" alt="Bukti Temuan" style="max-width: 150px; max-height: 100px;">
									<?php else: ?>
										<p>No image available</p>
									<?php endif; ?>
								</td>
								<td class="text-center"><?= $val->keterangan ?></td>
								<td><?= date('H:i - d/m/Y', strtotime($val->modified_at)) ?></td>
								<td><?= date('H:i - d/m/Y', strtotime($val->tgl_update_spv)) ?></td>
								<td class="text-center">
									<?php
									$status = $val->status_spv;
									$text = $status == 1 ? "Verified" : ($status == 2 ? "Revision" : "Created");
									$color = $status == 1 ? "text-success" : ($status == 2 ? "text-danger" : "text-muted");
									echo "<span class='$color font-weight-bold'>$text</span>";
									?>
								</td>
								<td class="text-center">
									<a href="<?= base_url('sanitasi/status/'.$val->uuid);?>" class="btn btn-sm btn-warning">
										<i class="fas fa-edit"></i> Verifikasi
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<div class="mt-4">
				<label class="font-weight-bold">Pilih tanggal:</label>
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

<style>
	.breadcrumb {
		background-color: #2E86C1;
		color: white;
	}
	.breadcrumb .breadcrumb-item.active {
		color: white;
	}
	.table td ul {
		padding-left: 1rem;
	}
	th {
		background-color: #f8f9fc;
	}
</style>
