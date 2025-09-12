<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Pemeriksaan Sanitasi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('sanitasi') ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Sanitasi
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('sanitasi/tambah'); ?>" enctype="multipart/form-data">
                <?php 
                $produksi_input = $this->session->userdata('produksi_input');
                $tanggal = isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d");
                $shift = isset($produksi_input['shift']) ? $produksi_input['shift'] : set_value('shift');
                ?>

                <div class="form-group row">
                   <div class="col-sm-3">
                    <label class="form-label font-weight-bold">Tanggal</label>
                    <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                    value="<?= set_value('date', $tanggal) ?>">
                    <div class="invalid-feedback <?= !empty(form_error('date')) ? 'd-block' : '' ?>"><?= form_error('date') ?></div>
                </div>

                <div class="col-sm-3">
                    <label class="form-label font-weight-bold">Shift</label>
                    <select class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>" name="shift">
                        <option disabled <?= empty($shift) ? 'selected' : '' ?>>Pilih Shift</option>
                        <option value="1" <?= $shift == '1' ? 'selected' : '' ?>>Shift 1</option>
                        <option value="2" <?= $shift == '2' ? 'selected' : '' ?>>Shift 2</option>
                        <option value="3" <?= $shift == '3' ? 'selected' : '' ?>>Shift 3</option>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('shift')) ? 'd-block' : '' ?>"><?= form_error('shift') ?></div>
                </div>

                <div class="col-sm-3">
                    <label class="form-label font-weight-bold">Pukul</label>
                    <input type="time" name="waktu" class="form-control <?= form_error('waktu') ? 'invalid' : '' ?>" value="<?= date("H:i") ?>">
                    <div class="invalid-feedback <?= !empty(form_error('waktu')) ? 'd-block' : '' ?>"><?= form_error('waktu') ?></div>
                </div>
            </div>

            <hr>

            <label class="form-label font-weight-bold">Hasil Pemeriksaan</label>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Standar (50 ppm)</label>
                    <select name="std_handbasin" class="form-control <?= form_error('std_handbasin') ? 'is-invalid' : '' ?>">
                        <option value="Sesuai" <?= set_value('std_handbasin') == 'Sesuai' ? 'selected' : '' ?>>Sesuai</option>
                        <option value="Tidak Sesuai" <?= set_value('std_handbasin') == 'Tidak Sesuai' ? 'selected' : '' ?>>Tidak Sesuai</option>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('std_handbasin')) ? 'd-block' : '' ; ?>">
                        <?= form_error('std_handbasin') ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label class="form-label">Aktual Hand Basin</label><br>
                    <input type="file" name="hand_basin" class="form-control <?= form_error('hand_basin') ? 'is-invalid' : '' ?>" accept="image/*,application/pdf">
                    <div class="invalid-feedback"><?= form_error('hand_basin') ?></div>
                </div>
            </div>
            <hr>

            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Keterangan</label>
                    <textarea class="form-control" name="keterangan"></textarea>
                    <div class="invalid-feedback <?= !empty(form_error('keterangan')) ? 'd-block' : '' ?>"><?= form_error('keterangan') ?></div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Catatan</label>
                    <textarea class="form-control" name="catatan"></textarea>
                    <div class="invalid-feedback <?= !empty(form_error('catatan')) ? 'd-block' : '' ?>"><?= form_error('catatan') ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-md btn-success mr-2">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('sanitasi') ?>" class="btn btn-md btn-danger">
                        <i class="fa fa-times"></i> Batal
                    </a>
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
    }
</style>
