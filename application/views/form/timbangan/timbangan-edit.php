<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Pemeriksaan Timbangan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('timbangan')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Pemeriksaan Timbangan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('timbangan/edit/'.$timbangan->uuid);?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'invalid' : '' ?> " value="<?= $timbangan->date; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift') ? 'invalid' : '' ?>" name="shift">
                                <option value="1" <?= set_select('shift', '1'); ?> <?= $timbangan->shift == 1?'selected':'';?>>1</option>
                                <option value="2" <?= set_select('shift', '2'); ?> <?= $timbangan->shift == 2?'selected':'';?>>2</option>
                                <option value="3" <?= set_select('shift', '3'); ?> <?= $timbangan->shift == 3?'selected':'';?>>3</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ; ?> "><?= form_error('shift') ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kode Timbangan</label>
                            <input type="text" name="kode_timbangan" class="form-control <?= form_error('kode_timbangan') ? 'invalid' : '' ?> " value="<?= $timbangan->kode_timbangan; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kode_timbangan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kode_timbangan') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Kapasitas</label>
                            <input type="text" name="kapasitas" class="form-control <?= form_error('kapasitas') ? 'invalid' : '' ?> " value="<?= $timbangan->kapasitas; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('kapasitas')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('kapasitas') ?>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Model</label>
                            <input type="text" name="model" class="form-control <?= form_error('model') ? 'invalid' : '' ?> " value="<?= $timbangan->model; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('model')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('model') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control <?= form_error('lokasi') ? 'invalid' : '' ?> " value="<?= $timbangan->lokasi; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('lokasi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('lokasi') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Standar</label>
                            <input type="text" name="peneraan_standar" class="form-control <?= form_error('peneraan_standar') ? 'invalid' : '' ?> " value="<?= $timbangan->peneraan_standar; ?>">
                            <div class="invalid-feedback <?= !empty(form_error('peneraan_standar')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('peneraan_standar') ?>
                            </div>
                        </div> 
                    </div>
                    <div class="form-area" id="form-timbangan-wrapper">
                        <label class="form-label font-weight-bold">Hasil Pemeriksaan</label>
                        <?php
                        $timbangan_data = json_decode($timbangan->peneraan_hasil, true);

                        if (!is_array($timbangan_data)) {
                            echo "<div class='alert alert-danger'>Data LOADING tidak valid atau kosong.</div>";
                            $timbangan_data = [];
                        }

                        foreach ($timbangan_data as $i => $detail): 
                            $pukul = isset($detail['pukul']) ? $detail['pukul'] : '';
                            $hasil = isset($detail['hasil']) ? $detail['hasil'] : '';
                            ?>
                            <div class="timbangan-group border p-3 mb-3 rounded bg-light" data-index="<?= $i ?>">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label>Pukul</label>
                                        <input type="time" name="pukul[]" class="form-control" value="<?= $pukul ?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Hasil</label>
                                        <input type="text" name="hasil[]" class="form-control" value="<?= $hasil ?>">
                                    </div>
                                    <div class="col-sm-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-primary mt-2" id="add-timbangan">+ Tambah Pemeriksaan</button>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="keterangan"><?= $timbangan->keterangan; ?></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('keterangan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('keterangan') ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Catatan</label>
                            <textarea class="form-control" name="catatan"><?= $timbangan->catatan; ?></textarea>
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
                            <a href="<?= base_url('timbangan')?>" class="btn btn-md btn-danger">
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
    $(document).ready(function () {
    let index = $('.timbangan-group').length;  // Mulai dengan indeks sesuai jumlah grup yang ada

    $('#add-timbangan').click(function () {
        const newGroup = $('.timbangan-group').first().clone(); // Clone grup pertama
        newGroup.attr('data-index', index);  // Set data-index dengan index baru

        // Reset input fields (jumlah, keterangan, kondisi_awal)
        newGroup.find('input[type="text"], input[type="number"]').val('');  // Reset jumlah dan keterangan
        newGroup.find('input[type="radio"]').prop('checked', false);  // Reset kondisi_awal (tidak ada yang tercentang)

        // Reset select (nama alat)
        newGroup.find('select').val(''); // Set select ke nilai kosong

        // Update name dan id untuk radio buttons, select, dan inputs sesuai index
        newGroup.find('input[type="radio"]').each(function () {
            const baseName = $(this).attr('name').split('[')[0];  // Ambil bagian sebelum [
            $(this).attr('name', baseName + '[' + index + ']');  // Update name radio button

            const newId = $(this).attr('id').split('_')[0] + '_' + index;  // Update ID
            $(this).attr('id', newId);
            $(this).next('label').attr('for', newId);  // Update for label
        });

        // Update select name sesuai index
        newGroup.find('select').each(function() {
            const baseName = $(this).attr('name').split('[')[0];
            $(this).attr('name', baseName + '[' + index + ']');
        });

        // Tambahkan grup baru ke dalam form
        $('#form-timbangan-wrapper').append(newGroup);

        index++;  // Tingkatkan indeks untuk grup berikutnya
    });

    // Hapus grup timbangan yang sudah ada
    $(document).on('click', '.btn-remove', function () {
        if ($('.timbangan-group').length > 1) {
            $(this).closest('.timbangan-group').remove();
            // Update index setelah grup dihapus
            index = $('.timbangan-group').length;
        } else {
            alert("Minimal satu baris harus ada.");
        }
    });
});

</script>
