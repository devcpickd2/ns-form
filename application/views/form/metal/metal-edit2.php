<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Update Pemeriksaan Metal Detector</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('metal')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Pemeriksaan Metal Detector</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Check ke-2</li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('metal/edit2/'.$metal->uuid);?>">
                  <table>
                    <tbody>
                      <tr>
                        <?php 
                        $datetime = new datetime($metal->date_metal);
                        $datetime = $datetime->format('d-m-Y');
                        ?>
                        <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                        <td colspan="4"><b>Shift : <?= $metal->shift;?><b></td>
                        </tr>
                        <tr>
                            <td>Jenis Produk</td>
                            <td colspan="4"><?= $metal->nama_produk;?></td>
                        </tr>
                        <tr>
                            <td>Kode Produksi</td>
                            <td colspan="4"><?= $metal->kode_produksi;?></td>
                        </tr>
                        <tr>
                            <td>No. Program</td>
                            <td colspan="4"><?= $metal->no_program;?></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="form-label font-weight-bold">Deteksi NG</label>
                        <select name="deteksi_ng" class="form-control <?= form_error('deteksi_ng') ? 'is-invalid' : '' ?>">
                            <option value="1" <?= $metal->deteksi_ng == '1' ? 'selected' : '' ?>>Belt Conveyor Berhenti</option>
                            <option value="2" <?= $metal->deteksi_ng == '2' ? 'selected' : '' ?>>Rejector</option>
                            <option value="-" <?= $metal->deteksi_ng == '-' ? 'selected' : '' ?>>-</option>
                        </select>
                        <div class="invalid-feedback <?= form_error('deteksi_ng') ? 'd-block' : '' ?>">
                            <?= form_error('deteksi_ng') ?>
                        </div>
                    </div>
                </div>
                <hr>
                <label class="form-label font-weight-bold">Check Metal Detector ke-2</label>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="form-label font-weight-bold">Standar Fe : <?= $metal->std_fe; ?></label>
                        <div>
                            <input type="radio" id="fe_terdeteksi" name="fe_t" value="terdeteksi" class="<?= form_error('fe_t') ? 'invalid' : '' ?>" <?= ($metal->fe_t == 'terdeteksi') ? 'checked' : '' ?>>
                            <label for="fe_terdeteksi">Terdeteksi</label>
                        </div>
                        <div>
                            <input type="radio" id="fe_tidak_terdeteksi" name="fe_t" value="tidak_terdeteksi" class="<?= form_error('fe_t') ? 'invalid' : '' ?>" <?= ($metal->fe_t == 'tidak_terdeteksi') ? 'checked' : '' ?>>
                            <label for="fe_tidak_terdeteksi">Tidak Terdeteksi</label>
                        </div>
                        <div class="invalid-feedback <?= !empty(form_error('fe_t')) ? 'd-block' : '' ; ?>">
                            <?= form_error('fe_t') ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label font-weight-bold">Standar Non Fe : <?= $metal->std_nonfe; ?></label>
                        <div>
                            <input type="radio" id="nonfe_terdeteksi" name="nonfe_t" value="terdeteksi" class="<?= form_error('nonfe_t') ? 'invalid' : '' ?>" <?= ($metal->nonfe_t == 'terdeteksi') ? 'checked' : '' ?>>
                            <label for="nonfe_terdeteksi">Terdeteksi</label>
                        </div>
                        <div>
                            <input type="radio" id="nonfe_tidak_terdeteksi" name="nonfe_t" value="tidak_terdeteksi" class="<?= form_error('nonfe_t') ? 'invalid' : '' ?>" <?= ($metal->nonfe_t == 'tidak_terdeteksi') ? 'checked' : '' ?>>
                            <label for="nonfe_tidak_terdeteksi">Tidak Terdeteksi</label>
                        </div>
                        <div class="invalid-feedback <?= !empty(form_error('nonfe_t')) ? 'd-block' : '' ; ?>">
                            <?= form_error('nonfe_t') ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label font-weight-bold">Standar SUS 304 : <?= $metal->std_sus304; ?></label>
                        <div>
                            <input type="radio" id="sus_terdeteksi" name="sus_t" value="terdeteksi" class="<?= form_error('sus_t') ? 'invalid' : '' ?>" <?= ($metal->sus_t == 'terdeteksi') ? 'checked' : '' ?>>
                            <label for="sus_terdeteksi">Terdeteksi</label>
                        </div>
                        <div>
                            <input type="radio" id="sus_tidak_terdeteksi" name="sus_t" value="tidak_terdeteksi" class="<?= form_error('sus_t') ? 'invalid' : '' ?>" <?= ($metal->sus_t == 'tidak_terdeteksi') ? 'checked' : '' ?>>
                            <label for="sus_tidak_terdeteksi">Tidak Terdeteksi</label>
                        </div>
                        <div class="invalid-feedback <?= !empty(form_error('sus_t')) ? 'd-block' : '' ; ?>">
                            <?= form_error('sus_t') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-md btn-success mr-2">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="<?= base_url('metal')?>" class="btn btn-md btn-danger">
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