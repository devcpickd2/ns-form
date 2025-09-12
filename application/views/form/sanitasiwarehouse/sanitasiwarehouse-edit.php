<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Update Pemeriksaan Sanitasi Warehouse</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color:#2E86C1;">
            <li class="breadcrumb-item">
                <a href="<?= base_url('sanitasiwarehouse') ?>" style="color:#fff;">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Sanitasi Warehouse
                </a>
            </li>
            <li class="breadcrumb-item active text-white" aria-current="page">Edit</li>
        </ol>
    </nav> 

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('sanitasiwarehouse/edit/'.$sanitasiwarehouse->uuid);?>">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>"
                        value="<?= set_value('date', $sanitasiwarehouse->date); ?>">
                        <div class="invalid-feedback"><?= form_error('date') ?></div>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold">Area</label>
                        <input type="text" name="area" class="form-control" value="<?= htmlspecialchars($sanitasiwarehouse->area); ?>" readonly>
                    </div>
                </div>

                <hr>
                <h5>Detail Kebersihan</h5>
                <div id="detail-section">
                   <?php
                   $max_rows = 100; 
                   $detail = json_decode($sanitasiwarehouse->detail, true);

                   if (!is_array($detail)) {
                    echo "<div class='alert alert-danger'>Data detail kebersihan tidak valid.</div>";
                    $detail = [];
                }

                $detail = array_slice($detail, 0, $max_rows);

                $kondisiMap = [
                 '1' => 'Berdebu',
                 '2' => 'Basah',
                 '3' => 'Sampah (sisa lakban, kertas, remah produk/bahan baku, plastik, kardus bekas)',
                 '4' => 'Pertumbuhan mikroorganisme (jamur dan bau busuk)',
                 '5' => 'Pallet rusak/pecah',
                 '6' => 'Terdapat aktifitas binatang (tikus, kecoa, lalat, ulat, belatung)',
                 '7' => 'Sarang laba-laba',
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
        <a href="<?= base_url('sanitasiwarehouse') ?>" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</div>
</div>