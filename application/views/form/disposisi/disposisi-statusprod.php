<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Disposisi Produk dan Prosedur</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('disposisi-verifikasi'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Disposisi Produk dan Prosedur</a>
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
                                $datetime = new datetime($disposisi->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="4">DISPOSISI PRODUK DAN PROSEDUR</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><b>Tanggal</b></td>
                                <td colspan="3" style="text-align:left;"><b><?= $datetime;?></b></td>
                            </tr>
                            <tr>
                                <td>Nomor</td>
                                <td colspan="3"><?= $disposisi->nomor;?></td>
                            </tr>
                            <tr>
                                <td>Kepada</td>
                                <td colspan="3"><?= $disposisi->kepada;?></td>
                            </tr>
                            <tr>
                                <td>Disposisi</td>
                                <td colspan="3"><?= $disposisi->disposisi;?></td>
                            </tr>
                            <tr>
                                <td>Dasar Disposisi</td>
                                <td colspan="3"> <?= !empty($disposisi->dasar_disposisi) ? $disposisi->dasar_disposisi : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td>Uraian Disposisi</td>
                                <td colspan="3"> <?= !empty($disposisi->uraian_disposisi) ? $disposisi->uraian_disposisi : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td colspan="3"> <?= !empty($disposisi->catatan) ? $disposisi->catatan : 'Tidak ada'; ?></td>
                            </tr>
                            <tr>
                                <td>QC</td>
                                <td colspan="3"><?= $disposisi->username;?></td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('disposisi/statusprod/'.$disposisi->uuid);?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                            <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $disposisi->status_produksi == 1?'selected':'';?>>Checked</option>
                            <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $disposisi->status_produksi == 2?'selected':'';?>>Re-Check</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('status_produksi') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control" name="catatan_produksi" ><?= $disposisi->catatan_produksi; ?></textarea>
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
                        <a href="<?= base_url('disposisi/diketahui')?>" class="btn btn-md btn-danger">
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
        width: 100%; 
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