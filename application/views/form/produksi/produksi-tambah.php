<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Proses Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('produksi')?>">
                    <i class="fas fa-arrow-left"></i> Daftar Laporan Verifikasi Proses Produksi
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('produksi/tambah');?>">

                <?php
                $produksi_input = $this->session->userdata('produksi_input');
                $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                $shift   = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                ?>

                <div class="form-group row">
                    <!-- Tanggal -->
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" 
                        class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>"
                        value="<?= $tanggal ?>">
                        <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                            <?= form_error('date') ?>
                        </div>
                    </div>

                    <!-- Shift -->
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Shift</label>
                        <select class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>" name="shift">
                            <option disabled <?= empty($shift) ? 'selected' : '' ?>>Pilih Shift</option>
                            <option value="1" <?= $shift == '1' ? 'selected' : '' ?>>Shift 1</option>
                            <option value="2" <?= $shift == '2' ? 'selected' : '' ?>>Shift 2</option>
                            <option value="3" <?= $shift == '3' ? 'selected' : '' ?>>Shift 3</option>
                        </select>
                        <div class="invalid-feedback <?= form_error('shift') ? 'd-block' : '' ?>">
                            <?= form_error('shift') ?>
                        </div>
                    </div>
                </div>

                <!-- Nama Produk -->
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Nama Produk</label>
                        <select id="nama-produk" name="nama_produk" class="form-control <?= form_error('nama_produk') ? 'invalid' : '' ?>" >
                            <option disabled selected>Pilih Produk</option>
                            <?php foreach($produk as $val){ ?>
                                <option value="<?= $val->uuid; ?>" data-nama="<?= $val->nama_produk; ?>"
                                    <?= set_select('nama_produk', $val->uuid) ;?>>
                                    <?= $val->nama_produk; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('nama_produk')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('nama_produk') ?>
                        </div>
                    </div>

                    <!-- Kode Produksi -->
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Kode Produksi</label>
                        <input type="text" name="kode_produksi"
                        class="form-control <?= form_error('kode_produksi') ? 'invalid' : '' ?> "
                        value="<?= set_value('kode_produksi', $last_kode); ?>">

                        <div class="invalid-feedback <?= !empty(form_error('kode_produksi')) ? 'd-block' : '' ; ?>">
                            <?= form_error('kode_produksi') ?>
                        </div>

                        <?php if (!empty($last_kode)): ?>
                            <small class="text-muted fst-italic">
                                kode terakhir hari ini
                                (<span class="fw-bold text-danger"><?= $last_kode; ?></span>)
                            </small>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>
                <!-- RAW MATERIAL -->
                <label class="form-label font-weight-bold">Raw Material</label>
                <div class="form-area" id="form-rawmat-wrapper"></div>

                <hr>
                <!-- PREMIX -->
                <label class="form-label font-weight-bold">Premix</label>
                <div class="form-area" id="form-premix-wrapper"></div>

                <hr>
                <!-- HASIL MIXING -->
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Hasil Mixing</label>
                        <select name="hasil_mixing" class="form-control <?= form_error('hasil_mixing') ? 'is-invalid' : '' ?>">
                            <!-- <option value="">-- Pilih --</option> -->
                            <option value="Oke" <?= set_value('hasil_mixing') == 'Oke' ? 'selected' : '' ?>>Oke</option>
                            <option value="Tidak Oke" <?= set_value('hasil_mixing') == 'Tidak Oke' ? 'selected' : '' ?>>Tidak Oke</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('hasil_mixing')) ? 'd-block' : '' ?>">
                            <?= form_error('hasil_mixing') ?>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Waktu Mixing Premix (Menit)</label>
                        <input type="number" name="waktu_mixing_premix" 
                        class="form-control <?= form_error('waktu_mixing_premix') ? 'is-invalid' : '' ?>" 
                        value="<?= set_value('waktu_mixing_premix'); ?>" min="0">
                        <div class="invalid-feedback <?= !empty(form_error('waktu_mixing_premix')) ? 'd-block' : '' ?>">
                            <?= form_error('waktu_mixing_premix') ?>
                        </div>
                    </div>
                </div>

                <hr>
                <!-- SENSORI -->
                <label class="form-label font-weight-bold">SENSORI</label>
                <div class="form-group row">
                    <?php foreach(['rasa','aroma','warna','tekstur'] as $sens){ ?>
                        <div class="col-sm-2">
                            <label class="form-label font-weight-bold mb-2"><?= ucfirst($sens) ?></label>
                            <div class="d-flex gap-2">
                                <input type="radio" class="btn-check" name="sens_<?= $sens ?>" id="sens-oke-<?= $sens ?>" value="oke" <?= set_value('sens_'.$sens) == 'oke' ? 'checked' : '' ?>>
                                <label class="btn btn-outline-success" for="sens-oke-<?= $sens ?>">Oke</label>

                                <input type="radio" class="btn-check" name="sens_<?= $sens ?>" id="sens-tidak-<?= $sens ?>" value="tidak" <?= set_value('sens_'.$sens) == 'tidak' ? 'checked' : '' ?>>
                                <label class="btn btn-outline-danger" for="sens-tidak-<?= $sens ?>">Tidak</label>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Catatan</label>
                        <textarea class="form-control" name="catatan"><?= set_value('catatan'); ?></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('catatan')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('catatan') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('produksi')?>" class="btn btn-md btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>

<style>
    .breadcrumb{ background-color: #2E86C1; }

    /* Biar tombol sensori tetap nyala saat dipilih */
    .btn-check:checked + .btn-outline-success {
        background-color: #28a745;
        color: #fff;
        border-color: #28a745;
    }
    .btn-check:checked + .btn-outline-danger {
        background-color: #dc3545;
        color: #fff;
        border-color: #dc3545;
    }
</style>

<!-- load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- load produkSpec -->
<script src="<?= base_url('assets/js/produkSpec_full.js?v=<?=time()?>') ?>"></script>

<script>
    $(document).ready(function () {

        function renderRawmat(list) {
            let html = ""; 
            $.each(list, function (i, v) {
                html += `
            <div class="rawmat-group border p-3 mb-3 rounded bg-light">
                <div class="form-group row">
                    <div class="col-md-3">
                        <input type="text" name="raw_nama[]" class="form-control" value="${v.nama}" readonly>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="raw_kode[]" class="form-control" value="${v.kode}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="raw_berat[]" class="form-control" value="${v.berat}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sensori</label>
                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check" name="raw_sens[${i}]" id="raw-oke-${i}" value="oke">
                            <label class="btn btn-outline-success" for="raw-oke-${i}">Oke</label>
                            <input type="radio" class="btn-check" name="raw_sens[${i}]" id="raw-tidak-${i}" value="tidak">
                            <label class="btn btn-outline-danger" for="raw-tidak-${i}">Tidak</label>
                        </div>
                    </div>
                </div>
                </div>`;
            });
            $("#form-rawmat-wrapper").html(html);
        }

        function renderPremix(list) {
            let html = "";
            $.each(list, function (i, v) {
                html += `
            <div class="premix-group border p-3 mb-3 rounded bg-light">
                <div class="form-group row">
                    <div class="col-md-3">
                        <input type="text" name="premix_nama[]" class="form-control" value="${v.nama}" readonly>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="premix_kode[]" class="form-control" value="${v.kode}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="premix_berat[]" class="form-control" value="${v.berat}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sensori</label>
                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check" name="premix_sens[${i}]" id="premix-oke-${i}" value="oke">
                            <label class="btn btn-outline-success" for="premix-oke-${i}">Oke</label>
                            <input type="radio" class="btn-check" name="premix_sens[${i}]" id="premix-tidak-${i}" value="tidak">
                            <label class="btn btn-outline-danger" for="premix-tidak-${i}">Tidak</label>
                        </div>
                    </div>
                </div>
                </div>`;
            });
            $("#form-premix-wrapper").html(html);
        }

    // Event saat pilih produk
        $("#nama-produk").on("change", function(){
            const namaProduk = $(this).find(":selected").data("nama");

        // cek apakah ada di produkSpec
            if(produkSpec.hasOwnProperty(namaProduk)){
                renderRawmat(produkSpec[namaProduk].raw);
                renderPremix(produkSpec[namaProduk].premix);
            } else {
                $("#form-rawmat-wrapper").empty();
                $("#form-premix-wrapper").empty();
            }
        });

    // Trigger kalau sebelumnya ada value terpilih (misal saat edit)
        $("#nama-produk").trigger("change");
    });
</script>
