<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Update Kebersihan Ruang Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color:#2E86C1;">
            <li class="breadcrumb-item">
                <a href="<?= base_url('kebersihanruang') ?>" style="color:#fff;">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Ruang Produksi
                </a>
            </li>
            <li class="breadcrumb-item active text-white" aria-current="page">Edit</li>
        </ol>
    </nav> 

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('kebersihanruang/edit/'.$kebersihanruang->uuid);?>">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>"
                        value="<?= set_value('date', $kebersihanruang->date); ?>">
                        <div class="invalid-feedback"><?= form_error('date') ?></div>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">Shift</label>
                        <select name="shift" class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>">
                            <option value="1" <?= set_select('shift', '1', $kebersihanruang->shift == 1); ?>>1</option>
                            <option value="2" <?= set_select('shift', '2', $kebersihanruang->shift == 2); ?>>2</option>
                            <option value="3" <?= set_select('shift', '3', $kebersihanruang->shift == 3); ?>>3</option>
                        </select>
                        <div class="invalid-feedback"><?= form_error('shift') ?></div>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($kebersihanruang->lokasi); ?>" readonly>
                    </div>
                </div>

                <hr>
                <h5>Detail Kebersihan</h5>
                <div id="detail-section">
                 <?php
                 $max_rows = 100; 
                 $detail = json_decode($kebersihanruang->detail, true);

                 if (!is_array($detail)) {
                    echo "<div class='alert alert-danger'>Data detail kebersihan tidak valid.</div>";
                    $detail = [];
                }

                $detail = array_slice($detail, 0, $max_rows);

                $kondisiMap = [
                    '1' => 'Berdebu',
                    '2' => 'Basah',
                    '3' => 'Pecah/Retak',
                    '4' => 'Sisa produksi',
                    '5' => 'Noda (tinta/karat)',
                    '6' => 'Pertumbuhan mikroorganisme',
                ];

                foreach ($detail as $i => $row):
                    ?>
                    <div class="row mb-2 detail-row">
                        <div class="col-md-3">
                            <label>Bagian</label>
                            <input type="text" name="bagian[]" class="form-control" value="<?= htmlspecialchars($row['bagian']) ?>" readonly>
                        </div>
                        <div class="col-md-3">
                            <label>Kondisi</label>
                            <select name="kondisi[]" class="form-control" required>
                                <option value="0" <?= $row['kondisi'] === '0' || $row['kondisi'] === '' ? 'selected' : '' ?>>Bersih</option>
                                <?php foreach ($kondisiMap as $key => $label): ?>
                                    <option value="<?= $key ?>" <?= $row['kondisi'] == $key ? 'selected' : '' ?>>
                                        <?= $key . ' - ' . $label ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Problem</label>
                            <input type="text" name="problem[]" class="form-control" value="<?= htmlspecialchars($row['problem']) ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Tindakan</label>
                            <input type="text" name="tindakan[]" class="form-control" value="<?= htmlspecialchars($row['tindakan']) ?>">
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="<?= base_url('kebersihanruang') ?>" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
</div>
</div>
</div>