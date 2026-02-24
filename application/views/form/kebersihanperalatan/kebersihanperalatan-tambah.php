<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Kebersihan Peralatan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('kebersihanperalatan') ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Peralatan
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('kebersihanperalatan/tambah'); ?>" enctype="multipart/form-data">

                <?php
                $produksi_input = $this->session->userdata('produksi_input');
                $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                ?>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                        value="<?= $tanggal ?>">
                        <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                            <?= form_error('date') ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
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

                <hr>
                <h5 class="font-weight-bold mb-3">Detail Kebersihan Peralatan</h5>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light text-center">
                            <tr>
                                <th style="width: 20%;">Nama Peralatan</th>
                                <th style="width: 15%;">Kondisi</th>
                                <th style="width: 30%;">Problem</th>
                                <th style="width: 30%;">Tindakan Koreksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alat_list as $i => $alat): ?>
                                <tr>
                                    <td>
                                        <?= $alat->peralatan ?>
                                        <input type="hidden" name="peralatan[]" value="<?= $alat->peralatan ?>">
                                    </td>
                                    <td>
                                        <select name="kondisi[]" class="form-control <?= form_error("kondisi[$i]") ? 'is-invalid' : '' ?>">
                                            <option value="">-- Pilih --</option>
                                            <option value="Bersih" <?= set_value("kondisi[$i]") == 'Bersih' ? 'selected' : '' ?>>Bersih</option>
                                            <option value="Kotor" <?= set_value("kondisi[$i]") == 'Kotor' ? 'selected' : '' ?>>Kotor</option>
                                        </select>
                                        <div class="invalid-feedback text-left"><?= form_error("kondisi[$i]") ?></div>
                                    </td>
                                    <td>
                                        <textarea name="problem[]" class="form-control" rows="1"><?= set_value("problem[$i]") ?></textarea>
                                    </td>
                                    <td>
                                        <textarea name="tindakan[]" class="form-control" rows="1"><?= set_value("tindakan[$i]") ?></textarea>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label font-weight-bold">Catatan</label>
                    <textarea class="form-control <?= form_error('catatan') ? 'is-invalid' : '' ?>" name="catatan" rows="2"><?= set_value('catatan') ?></textarea>
                    <div class="invalid-feedback"><?= form_error('catatan') ?></div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('kebersihanperalatan') ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    .breadcrumb {
        background-color: #2E86C1;
    }
    .table td, .table th {
        vertical-align: middle !important;
    }
</style>
