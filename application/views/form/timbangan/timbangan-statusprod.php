<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Timbangan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('timbangan-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Timbangan</a>
                </li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <?php 
                                $datetime = new datetime($timbangan->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">PEMERIKSAAN TIMBANGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="text-align:left;" colspan="7"><b>Tanggal : <?= $datetime;?></b></td>
                            </tr>
                            <tr>
                                <td>Shift</td>
                                <td colspan="6"><?= $timbangan->shift;?></td>
                            </tr>
                            <tr>
                                <td>Kode timbangan</td>
                                <td colspan="6"><?= $timbangan->kode_timbangan;?></td>
                            </tr>
                            <tr>
                                <td>Kapasitas</td>
                                <td colspan="6"><?= $timbangan->kapasitas;?></td>
                            </tr>
                            <tr>
                                <td>Model</td>
                                <td colspan="6"><?= $timbangan->model;?></td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td colspan="6"><?= $timbangan->lokasi;?></td>
                            </tr>
                            <tr>
                                <td>Standar</td>
                                <td colspan="6"><?= $timbangan->peneraan_standar;?></td>
                            </tr>
                            <?php
                            $result = json_decode($timbangan->peneraan_hasil, true);
                            if (!is_array($result)) $result = [];
                            ?>
                            <tr>
                                <th colspan="7" style="text-align:center;">Daftar Hasil Pemeriksaan</th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th colspan="3">Waktu</th>
                                <th colspan="3">Hasil</th>
                            </tr>
                            <?php $no = 1; foreach ($result as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td colspan="3"><?= htmlspecialchars($row['pukul']) ?></td>
                                <td colspan="3"><?= htmlspecialchars($row['hasil']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>QC</td>
                            <td colspan="6"><?= $timbangan->username;?></td>
                        </tr>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form class="user" method="post" action="<?= base_url('timbangan/statusprod/'.$timbangan->uuid);?>">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Status</label>
                    <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                        <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $timbangan->status_produksi == 1?'selected':'';?>>Checked</option>
                        <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $timbangan->status_produksi == 2?'selected':'';?>>Re-Check</option>
                    </select>
                    <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                        <?= form_error('status_produksi') ?>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <label class="form-label font-weight-bold">Catatan Revisi</label>
                    <textarea class="form-control" name="catatan_produksi" ><?= $timbangan->catatan_produksi; ?></textarea>
                    <div class="invalid-feedback <?= !empty(form_error('catatan_produksi')) ? 'd-block' : '' ; ?> ">
                        <?= form_error('catatan_produksi') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-md btn-success mr-2">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('timbangan/diketahui')?>" class="btn btn-md btn-danger">
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
    .breadcrumb {
        background-color: #2E86C1;
    }
    .no-border {
        border: none;
        box-shadow: none;
    }
    .table {
        width: 50%; 
        font-size: 16px; 
        margin: 0 auto; 
    }
    .table, .table th, .table td {
        border: none;
    }
    .table th, .table td {
        padding: 6px 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        word-wrap: break-word;
        white-space: normal !important;
    }
    .table td {
        white-space: nowrap;
    }
</style>