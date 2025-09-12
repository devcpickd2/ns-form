<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Monitoring False Rejection</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('falserejection-diketahui'); ?>">
                    <i class="fas fa-arrow-left"></i> Monitoring False Rejection</a>
                </li>
            </ol>
        </nav>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group row">
                    <div class="table-responsive">
                        <table class="table table-bordered" cellspacing="0">
                         <thead>
                            <?php 
                            $datetime = new datetime($falserejection->date_false_rejection);
                            $datetime = $datetime->format('d-m-Y');
                            ?>
                            <tr>
                                <th style="text-align:center;" colspan="2" >MONITORING FALSE REJECTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <tr>
                                    <td>Mesin</td>
                                    <td><?= $falserejection->no_mesin;?></td>
                                </tr>
                                <td ><b>Tanggal : <?= $datetime;?></b></td>
                                <td><b>Shift : <?= $falserejection->shift_monitoring;?><b></td>
                                </tr>
                                <tr>
                                    <td>Nama Produk</td>
                                    <td><?= $falserejection->nama_produk;?></td>
                                </tr>
                                <tr>
                                    <td>Kode Produksi</td>
                                    <td><?= $falserejection->kode_produksi;?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pack/Bag yang Tidak Lolos</td>
                                    <td colspan="4"><?= !empty($falserejection->jumlah_tidak_lolos) ? $falserejection->jumlah_tidak_lolos : '0'; ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pack/Bag yang Terdapat Kontaminasi</td>
                                    <td colspan="4"><?= !empty($falserejection->jumlah_kontaminasi) ? $falserejection->jumlah_kontaminasi : '0'; ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kontaminasi</td>
                                    <td><?= $falserejection->jenis_kontaminasi;?></td>
                                </tr>
                                <tr>
                                    <td>Posisi Kontaminasi</td>
                                    <td><?= $falserejection->posisi_kontaminasi;?></td>
                                </tr>
                                <tr>
                                    <td>False Rejection</td>
                                    <td colspan="4"><?= !empty($falserejection->falserejection) ? $falserejection->falserejection : '0'; ?></td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td colspan="4"><?= !empty($falserejection->catatan) ? $falserejection->catatan : 'Tidak ada'; ?></td>
                                </tr>
                                <tr>
                                    <td>QC</td>
                                    <td colspan="4"><?= !empty($falserejection->username_2) ? $falserejection->username_2 : 'Tidak ada'; ?></td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('falserejection/statusprod/'.$falserejection->uuid);?>">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Status</label>
                            <select class="form-control <?= form_error('status_produksi_false') ? 'invalid' : '' ?>" name="status_produksi_false">
                                <option value="1" <?= set_select('status_produksi_false', '1'); ?> <?= $falserejection->status_produksi_false == 1?'selected':'';?>>Checked</option>
                                <option value="2" <?= set_select('status_produksi_false', '2'); ?> <?= $falserejection->status_produksi_false == 2?'selected':'';?>>Re-Check</option>
                            </select>
                            <div class="invalid-feedback <?= !empty(form_error('status_produksi_false')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('status_produksi_false') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label class="form-label font-weight-bold">Catatan Revisi</label>
                            <textarea class="form-control" name="catatan_produksi_false" ><?= $falserejection->catatan_produksi_false; ?></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('catatan_produksi_false')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('catatan_produksi_false') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-md btn-success mr-2">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="<?= base_url('falserejection/diketahui')?>" class="btn btn-md btn-danger">
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


