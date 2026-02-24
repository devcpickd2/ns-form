<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Pemeriksaan Proses Pengemasan</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('pengemasan-diketahui'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Proses Pengemasan</a>
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
                                $datetime = new datetime($pengemasan->date);
                                $datetime = $datetime->format('d-m-Y');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">PEMERIKSAAN PROSES PENGEMASAN</th>
                                </tr>
                            </thead>
                            <tbody>
                             <tr>
                                <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                <td style="text-align:left;"><b>Shift : <?= $pengemasan->shift;?></b></td>
                                <td style="text-align:left;" colspan="4"><b>Pukul : <?= date('H:i', strtotime($pengemasan->waktu)); ?></b></td>
                            </tr>
                            <tr>
                                <td>Nama Produk</td>
                                <td colspan="6"><?= $pengemasan->nama_produk;?></td>
                            </tr>
                            <tr>
                                <td>Kode Produksi</td>
                                <td colspan="6"><?= $pengemasan->kode_produksi;?></td>
                            </tr>
                            <tr>
                                <td>Best Before</td>
                                <td colspan="6"><?= $pengemasan->best_before;?></td>
                            </tr>
                            <tr>
                                <td>Kondisi Produk</td>
                                <td colspan="6"><?= $pengemasan->kondisi_produk;?></td>
                            </tr>
                            <tr>
                                <td>Kondisi Seal Kemasan</td>
                                <td colspan="6"><?= $pengemasan->kondisi_seal;?></td>
                            </tr>
                            <tr>
                                <td>Berat Kotor per pack (gram)</td>
                                <td colspan="6"><?= $pengemasan->berat_pack;?></td>
                            </tr>
                            <tr>
                                <td>Berat Kotor per renceng (gram)</td>
                                <td colspan="6"><?= $pengemasan->berat_renceng;?></td>
                            </tr>
                            <tr>
                                <td>Berat Kotor per inner (gram)</td>
                                <td colspan="6"><?= $pengemasan->berat_inner;?></td>
                            </tr>
                            <tr>
                                <td>Berat Kotor per binded (gram)</td>
                                <td colspan="6"><?= $pengemasan->berat_binded;?></td>
                            </tr>
                            <tr>
                                <td>Berat Kotor per carton (Kg)</td>
                                <td colspan="6"><?= $pengemasan->berat_carton;?></td>
                            </tr>
                            <tr>
                                <td>Labelisasi</td>
                                <td colspan="6"><?= $pengemasan->labelisasi;?></td>
                            </tr>
                            <tr>
                                <td>Kondisi Seal Karton Box</td>
                                <td colspan="6"><?= $pengemasan->kondisi_karton;?></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td colspan="6"><?= $pengemasan->keterangan;?></td>
                            </tr>
                            <tr>
                                <td>QC</td>
                                <td colspan="6"><?= $pengemasan->username;?></td>
                            </tr>
                            <tr>
                                <td>Produksi</td>
                                <td colspan="5"><?= $pengemasan->nama_produksi;?></td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="<?= base_url('pengemasan/statusprod/'.$pengemasan->uuid);?>">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Status</label>
                        <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                            <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $pengemasan->status_produksi == 1?'selected':'';?>>Checked</option>
                            <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $pengemasan->status_produksi == 2?'selected':'';?>>Re-Check</option>
                        </select>
                        <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                            <?= form_error('status_produksi') ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                        <textarea class="form-control" name="catatan_produksi" ><?= $pengemasan->catatan_produksi; ?></textarea>
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
                        <a href="<?= base_url('pengemasan/diketahui')?>" class="btn btn-md btn-danger">
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