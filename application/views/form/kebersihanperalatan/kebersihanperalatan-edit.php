<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Update Kebersihan Peralatan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('kebersihanperalatan') ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kebersihan Peralatan
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="<?= base_url('kebersihanperalatan/edit/' . $kebersihanperalatan->uuid); ?>" enctype="multipart/form-data">

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" value="<?= set_value('date', $kebersihanperalatan->date) ?>">
                        <div class="invalid-feedback"><?= form_error('date') ?></div>
                    </div>

                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Shift</label>
                        <select name="shift" class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>">
                            <option disabled value="">Pilih Shift</option>
                            <option value="1" <?= set_select('shift', '1', $kebersihanperalatan->shift == 1); ?>>Shift 1</option>
                            <option value="2" <?= set_select('shift', '2', $kebersihanperalatan->shift == 2); ?>>Shift 2</option>
                            <option value="3" <?= set_select('shift', '3', $kebersihanperalatan->shift == 3); ?>>Shift 3</option>
                        </select>
                        <div class="invalid-feedback"><?= form_error('shift') ?></div>
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
                            <?php
                            $peralatan = json_decode($kebersihanperalatan->peralatan);
                            if (is_array($peralatan)):
                                foreach ($peralatan as $i => $item): ?>
                                    <tr>
                                        <td>
                                            <?= $item->nama ?>
                                            <input type="hidden" name="peralatan[]" value="<?= $item->nama ?>">
                                        </td>
                                        <td>
                                            <select name="kondisi[]" class="form-control <?= form_error("kondisi[$i]") ? 'is-invalid' : '' ?>">
                                                <option value="">-- Pilih --</option>
                                                <option value="Bersih" <?= $item->kondisi == 'Bersih' ? 'selected' : '' ?>>Bersih</option>
                                                <option value="Kotor" <?= $item->kondisi == 'Kotor' ? 'selected' : '' ?>>Kotor</option>
                                            </select>
                                            <div class="invalid-feedback text-left"><?= form_error("kondisi[$i]") ?></div>
                                        </td>
                                        <td>
                                            <textarea name="problem[]" class="form-control" rows="1"><?= $item->problem ?></textarea>
                                        </td>
                                        <td>
                                            <textarea name="tindakan[]" class="form-control" rows="1"><?= $item->tindakan ?></textarea>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-danger">Data peralatan tidak ditemukan atau format tidak valid.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <label class="form-label font-weight-bold">Catatan</label>
                    <textarea class="form-control <?= form_error('catatan') ? 'is-invalid' : '' ?>" name="catatan" rows="2"><?= set_value('catatan', $kebersihanperalatan->catatan) ?></textarea>
                    <div class="invalid-feedback"><?= form_error('catatan') ?></div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Perbarui
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
