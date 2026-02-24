<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pemeriksaan Sanitasi Warehouse</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('sanitasiwarehouse')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Pemeriksaan Sanitasi Warehouse</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('sanitasiwarehouse/tambah');?>" enctype="multipart/form-data">
                 <div style="display: flex; gap: 20px;">
                    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 30%; text-align: left; font-family: Arial, sans-serif; font-size: 12px;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th colspan="2" style="padding: 5px; background-color: #ADD8E6; color: gray;">Keterangan Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Berdebu</td>
                            </tr>
                            <tr>
                                <td>2. Basah</td>
                            </tr>
                            <tr>
                                <td>3. Sampah (sisa lakban, kertas, remah produk/bahan baku, plastik, kardus bekas)</td>
                            </tr>
                            <tr>
                                <td>4. Pertumbuhan mikroorganisme (jamur dan bau busuk)</td>
                            </tr>
                            <tr>
                                <td>5. Pallet rusak/pecah</td>
                            </tr>
                            <tr>
                                <td>6. Terdapat aktifitas binatang (tikus, kecoa, lalat, ulat, belatung)</td>
                            </tr>
                            <tr>
                                <td>7. Sarang Laba-laba</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?php echo date("Y-m-d") ?>">
                        <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('date') ?>
                        </div>
                    </div>  
                    <div class="col-sm-3">
                        <label class="form-label font-weight-bold">Area</label>
                        <select name="area"  id="areaDropdown" class="form-control <?= form_error('area') ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Area --</option>
                            <option value="RM" <?= set_select('area', 'RM') ?>>RM</option>
                            <option value="DS" <?= set_select('area', 'DS') ?>>DS</option>
                            <option value="FG" <?= set_select('area', 'FG') ?>>FG</option>
                        </select>
                        <div class="invalid-feedback <?= form_error('area') ? 'd-block' : '' ?>">
                            <?= form_error('area') ?>
                        </div>
                    </div>
                </div>
                <hr>

                <!-- area rm -->
                <div id="form-rm" class="form-area d-none">
                    <label class="form-label font-weight-bold">RM</label>
                    <?php
                    $arearm = ['Kondisi Produk','Penempatan Produk','Lantai', 'Pintu', 'Rak', 'Palet', 'Langit-langit', 'Lampu', 'Tirai Plastik', 'Dinding', 'Aktivitas Hama', 'Halaman Luar'];
                    $kondisi_options = array_merge(['bersih'], range(1, 7));
                    ?>

                    <?php foreach ($arearm as $indexrm => $bagian): ?>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label class="form-label font-weight-bold">Titik Pemeriksaan</label>
                                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('bagian[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label font-weight-bold d-block">Kondisi</label>
                                <?php foreach ($kondisi_options as $opt): ?>
                                    <?php
                                    $value = (string) $opt;
                                    $id = 'kondisi-' . $value . '-' . $indexrm;
                                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                                    ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input kondisi-checkbox" 
                                        type="checkbox" 
                                        name="kondisi[]" 
                                        value="<?= $value ?>" 
                                        id="<?= $id ?>" 
                                        <?= $checked ?>>
                                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <div class="invalid-feedback d-block">
                                    <?= form_error('kondisi[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label font-weight-bold">Problem</label>
                                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('problem[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label font-weight-bold">Tindakan</label>
                                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('tindakan[]') ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- batas form rm -->

                <!-- area ds -->
                <div id="form-ds" class="form-area d-none">
                    <label class="form-label font-weight-bold">DS</label>
                    <?php
                    $areads = ['Kondisi Produk','Penempatan Produk','Lantai', 'Pintu', 'Rak', 'Palet', 'Langit-langit', 'Lampu', 'Tirai Plastik', 'Dinding', 'Aktivitas Hama', 'Halaman Luar'];
                    $kondisi_options = array_merge(['bersih'], range(1, 7));
                    ?>

                    <?php foreach ($areads as $indexds => $bagian): ?>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label class="form-label font-weight-bold">Titik Pemeriksaan</label>
                                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('bagian[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label font-weight-bold d-block">Kondisi</label>
                                <?php foreach ($kondisi_options as $opt): ?>
                                    <?php
                                    $value = (string) $opt;
                                    $id = 'kondisi-' . $value . '-' . $indexds;
                                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                                    ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input kondisi-checkbox" 
                                        type="checkbox" 
                                        name="kondisi[]" 
                                        value="<?= $value ?>" 
                                        id="<?= $id ?>" 
                                        <?= $checked ?>>
                                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <div class="invalid-feedback d-block">
                                    <?= form_error('kondisi[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label font-weight-bold">Problem</label>
                                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('problem[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label font-weight-bold">Tindakan</label>
                                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('tindakan[]') ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- batas form ds -->

                <!-- area fg -->
                <div id="form-fg" class="form-area d-none">
                    <label class="form-label font-weight-bold">FG</label>
                    <?php
                    $areafg = ['Kondisi Produk','Penempatan Produk','Lantai', 'Pintu', 'Rak', 'Palet', 'Langit-langit', 'Lampu', 'Tirai Plastik', 'Dinding', 'Aktivitas Hama', 'Halaman Luar'];
                    $kondisi_options = array_merge(['bersih'], range(1, 7));
                    ?>

                    <?php foreach ($areafg as $indexfg => $bagian): ?>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label class="form-label font-weight-bold">Titik Pemeriksaan</label>
                                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('bagian[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label font-weight-bold d-block">Kondisi</label>
                                <?php foreach ($kondisi_options as $opt): ?>
                                    <?php
                                    $value = (string) $opt;
                                    $id = 'kondisi-' . $value . '-' . $indexfg;
                                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                                    ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input kondisi-checkbox" 
                                        type="checkbox" 
                                        name="kondisi[]" 
                                        value="<?= $value ?>" 
                                        id="<?= $id ?>" 
                                        <?= $checked ?>>
                                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <div class="invalid-feedback d-block">
                                    <?= form_error('kondisi[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label font-weight-bold">Problem</label>
                                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('problem[]') ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label font-weight-bold">Tindakan</label>
                                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                                    <?= form_error('tindakan[]') ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- batas form fg -->

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('sanitasiwarehouse')?>" class="btn btn-md btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<style type="text/css">
    .breadcrumb{
        background-color: #2E86C1;
    }
</style>
<script>
    $(document).ready(function(){
      $('#areaDropdown').change(function(){
        $('.form-area').addClass('d-none'); 
        var selected = $(this).val();

        if(selected === 'RM'){
          $('#form-rm').removeClass('d-none');
      } else if(selected === 'DS'){
        $('#form-ds').removeClass('d-none');
    } else if(selected === 'FG'){
      $('#form-fg').removeClass('d-none');
  }
});
  });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const areaDropdown = document.getElementById("areaDropdown");
        const formrm = document.getElementById("form-rm");
        const formds = document.getElementById("form-ds");
        const formfg = document.getElementById("form-fg");

        function toggleForms() {
            const selected = areaDropdown.value;

        // Semua form disembunyikan dan disabled dulu
            [formrm, formds, formfg].forEach(form => {
                form.classList.add("d-none");
                [...form.querySelectorAll("input, select, textarea")].forEach(el => {
                    el.disabled = true;
                });
            });

        // Tampilkan dan enable form yang dipilih
            if (selected === "RM") {
                formrm.classList.remove("d-none");
                [...formrm.querySelectorAll("input, select, textarea")].forEach(el => {
                    el.disabled = false;
                });
            } else if (selected === "DS") {
                formds.classList.remove("d-none");
                [...formds.querySelectorAll("input, select, textarea")].forEach(el => {
                    el.disabled = false;
                });
            } else if (selected === "FG") {
                formfg.classList.remove("d-none");
                [...formfg.querySelectorAll("input, select, textarea")].forEach(el => {
                    el.disabled = false;
                });
            }
        }

        areaDropdown.addEventListener("change", toggleForms);
        toggleForms(); 
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Seleksi semua bagian form area
        document.querySelectorAll('.form-group.row').forEach(function (row) {
            const checkboxes = row.querySelectorAll('.kondisi-checkbox');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const value = checkbox.value.toLowerCase();

                    if (value === 'bersih' && checkbox.checked) {
                    // Jika "bersih" dicentang, disable yang lain
                        checkboxes.forEach(function (cb) {
                            if (cb.value !== 'bersih') {
                                cb.checked = false;
                                cb.disabled = true;
                            }
                        });
                    } else if (value === 'bersih' && !checkbox.checked) {
                    // Jika "bersih" tidak dicentang, aktifkan kembali semua
                        checkboxes.forEach(function (cb) {
                            cb.disabled = false;
                        });
                    } else if (value !== 'bersih') {
                    // Jika checkbox selain "bersih" dicentang, uncheck dan disable "bersih"
                        const bersihCheckbox = Array.from(checkboxes).find(cb => cb.value === 'bersih');
                        if (checkbox.checked) {
                            bersihCheckbox.checked = false;
                            bersihCheckbox.disabled = true;
                        }

                    // Jika semua checkbox selain "bersih" tidak dipilih, aktifkan kembali "bersih"
                        const otherChecked = Array.from(checkboxes).some(cb => cb.value !== 'bersih' && cb.checked);
                        if (!otherChecked) {
                            bersihCheckbox.disabled = false;
                        }
                    }
                });
            });
        });
    });
</script>

