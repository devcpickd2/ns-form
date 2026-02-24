<div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold">Tambah Pemeriksaan Suhu Ruang</h1>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('suhu') ?>" class="text-white"><i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Suhu Ruang</a>
            </li>
            <li class="breadcrumb-item active text-white" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="card shadow-lg border-0 mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('suhu/tambah'); ?>" id="formSuhu">
                <?php
                $produksi_input = $this->session->userdata('produksi_input');
                ?>

                <div class="form-row mb-3">
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control" 
                        value="<?= isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Shift</label>
                        <select class="form-control" name="shift" required>
                            <option value="" disabled <?= !isset($produksi_input['shift']) ? 'selected' : '' ?>>-- Pilih Shift --</option>
                            <option value="1" <?= (isset($produksi_input['shift']) && $produksi_input['shift'] == '1') ? 'selected' : '' ?>>Shift 1</option>
                            <option value="2" <?= (isset($produksi_input['shift']) && $produksi_input['shift'] == '2') ? 'selected' : '' ?>>Shift 2</option>
                            <option value="3" <?= (isset($produksi_input['shift']) && $produksi_input['shift'] == '3') ? 'selected' : '' ?>>Shift 3</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Pukul</label>
                        <input type="time" name="pukul" class="form-control" step="3600" required>
                    </div>
                </div>

                <hr>
                <h5 class="font-weight-bold text-primary mb-3">Input Suhu & RH</h5>

                <!-- Ruang Produksi -->
                <div class="border rounded p-3 mb-4 bg-light">
                    <h6 class="font-weight-bold text-dark mb-3">Ruang Produksi</h6>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Suhu (20 - 30 °C)</label>
                            <input type="text" class="form-control" id="suhu_produksi" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">RH (40 - 70 %)</label>
                            <input type="text" class="form-control" id="rh_produksi" required>
                        </div>
                    </div>
                    <input type="hidden" name="lokasi[]" id="lokasi_produksi" value="">
                </div>

                <!-- Gudang Finish Good -->
                <div class="border rounded p-3 mb-4 bg-light">
                    <h6 class="font-weight-bold text-dark mb-3">Gudang Finish Good</h6>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Suhu (28 - 36 °C)</label>
                            <input type="text" class="form-control" id="suhu_gudang" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">RH (40 - 80 %)</label>
                            <input type="text" class="form-control" id="rh_gudang" required>
                        </div>
                    </div>
                    <input type="hidden" name="lokasi[]" id="lokasi_gudang" value="">
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Opsional..."></textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Opsional..."></textarea>
                </div>

                <div class="text-left">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('suhu') ?>" class="btn btn-danger px-4">
                        <i class="fa fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('formSuhu').addEventListener('submit', function (e) {
        const suhu_produksi = document.getElementById('suhu_produksi').value.trim();
        const rh_produksi = document.getElementById('rh_produksi').value.trim();
        document.getElementById('lokasi_produksi').value = `Ruang Produksi|${suhu_produksi}|${rh_produksi}`;

        const suhu_gudang = document.getElementById('suhu_gudang').value.trim();
        const rh_gudang = document.getElementById('rh_gudang').value.trim();
        document.getElementById('lokasi_gudang').value = `Gudang Finish Good|${suhu_gudang}|${rh_gudang}`;
    });
</script>

<style>
    .breadcrumb {
        background-color: #2E86C1;
    }
    .breadcrumb a {
        color: #ffffff !important;
        text-decoration: none;
    }
</style>
