<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pemeriksaan Timbangan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('timbangan')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Pemeriksaan Timbangan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('timbangan/tambah');?>" enctype="multipart/form-data">
                   <?php
                   $produksi_input = $this->session->userdata('produksi_input');
                   $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                   $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                   ?>
                   <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                        value="<?= $tanggal ?>">
                        <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                            <?= form_error('date') ?>
                        </div>
                    </div>
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
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Kode Timbangan</label>
                        <input type="text" name="kode_timbangan" class="form-control <?= form_error('kode_timbangan') ? 'invalid' : '' ?> " value="<?= set_value('kode_timbangan'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('kode_timbangan')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('kode_timbangan') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Kapasitas</label>
                        <input type="text" name="kapasitas" class="form-control <?= form_error('kapasitas') ? 'invalid' : '' ?> " value="<?= set_value('kapasitas'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('kapasitas')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('kapasitas') ?>
                        </div>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Model</label>
                        <input type="text" name="model" class="form-control <?= form_error('model') ? 'invalid' : '' ?> " value="<?= set_value('model'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('model')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('model') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control <?= form_error('lokasi') ? 'invalid' : '' ?> " value="<?= set_value('lokasi'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('lokasi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('lokasi') ?>
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <label class="form-label font-weight-bold">Standar Berat (g)</label>
                        <input type="text" name="peneraan_standar" class="form-control <?= form_error('peneraan_standar') ? 'invalid' : '' ?> " value="<?= set_value('peneraan_standar'); ?>">
                        <div class="invalid-feedback <?= !empty(form_error('peneraan_standar')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('peneraan_standar') ?>
                        </div>
                    </div> 
                </div>
                <hr>
                <div class="form-area" id="form-timbangan-wrapper">
                    <label class="form-label font-weight-bold">Hasil Pemeriksaan</label>
                    <div class="timbangan-group border p-3 mb-3 rounded bg-light" data-index="0">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label>Pukul</label>
                                <input type="time" name="pukul[]" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>Hasil</label>
                                <input type="text" name="hasil[]" class="form-control">
                            </div>
                            <div class="col-sm-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-remove">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mt-2" id="add-timbangan">+ Tambah Pemeriksaan</button>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Keterangan</label>
                        <textarea class="form-control" name="keterangan"></textarea>
                        <div class="invalid-feedback <?= !empty(form_error('keterangan')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('keterangan') ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan</label>
                        <textarea class="form-control" name="catatan"></textarea>
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
        let index = 1;

        $('#add-timbangan').click(function () {
            const newGroup = $('.timbangan-group').first().clone();
            newGroup.attr('data-index', index);

        // Reset input
            newGroup.find('input[type="text"], input[type="number"]').val('');
            newGroup.find('input[type="radio"]').prop('checked', false);

        // Reset select native (tanpa Select2)
            newGroup.find('select').val('');

        // Update name radio button berdasarkan index
            newGroup.find('input[type="radio"]').each(function () {
                const baseName = $(this).attr('name').split('[')[0];
                $(this).attr('name', baseName + '[' + index + ']');
            });

            $('#form-timbangan-wrapper').append(newGroup);
            index++;
        });

        $(document).on('click', '.btn-remove', function () {
            if ($('.timbangan-group').length > 1) {
                $(this).closest('.timbangan-group').remove();
            } else {
                alert("Minimal satu baris harus ada.");
            }
        });
    });
</script>
