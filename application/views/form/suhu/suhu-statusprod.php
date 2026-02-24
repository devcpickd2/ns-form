<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Suhu Ruang</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('suhu'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Suhu Ruang</a>
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
                                $datetime = new datetime($suhu->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">PEMERIKSAAN SUHU RUANG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;" colspan="2"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td style="text-align:left;"><b>Shift : <?= $suhu->shift;?></b></td>
                                    <td style="text-align:left;" colspan="4"><b>Pukul : <?= date('H:i', strtotime($suhu->pukul)); ?></b></td>
                                </tr>
                                <tr>
                                    <td>Lokasi</td>
                                    <td colspan="6"><?= $suhu->lokasi;?> °C</td>
                                </tr>
                                <tr>
                                    <td>Hasil Pemeriksaan</td>
                                    <td colspan="3">Suhu (°C)</td>
                                    <td colspan="3">RH (%)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3"><?= $suhu->suhu;?></td>
                                    <td colspan="3"><?= $suhu->rh;?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td colspan="6"> <?= !empty($suhu->keterangan) ? $suhu->keterangan : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td colspan="6"> <?= !empty($suhu->catatan) ? $suhu->catatan : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                </tr>
                                <tr>
                                    <td>QC</td>
                                    <td colspan="6"><?= $suhu->username;?></td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('suhu/statusprod/'.$suhu->uuid);?>">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Status</label>
                            <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                                <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $suhu->status_produksi == 1?'selected':'';?>>Checked</option>
                                <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $suhu->status_produksi == 2?'selected':'';?>>Re-Check</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('status_produksi') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Catatan Revisi</label>
                            <textarea class="form-control" name="catatan_produksi" ><?= $suhu->catatan_produksi; ?></textarea>
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
                            <a href="<?= base_url('suhu/diketahui')?>" class="btn btn-md btn-danger">
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