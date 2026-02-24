<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kontaminasi Benda Asing</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kontaminasi-diketahui'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kontaminasi Benda Asing</a>
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
                                $datetime = new datetime($kontaminasi->date);
                                $datetime = $datetime->format('d-m-Y');

                                $time = new datetime($kontaminasi->time);
                                $time = $time->format('H:i');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">KONTAMINASI BENDA ASING</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td><b>Shift : <?= $kontaminasi->shift;?><b></td>
                                        <td colspan="5"><b>Pukul : <?= $time;?><b></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kontaminasi</td>
                                            <td colspan="6"><?= $kontaminasi->jenis_kontaminasi;?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Produk</td>
                                            <td colspan="6"><?= $kontaminasi->nama_produk;?></td>
                                        </tr>
                                        <tr>
                                            <td>Kode Produksi</td>
                                            <td colspan="6"><?= $kontaminasi->kode_produksi;?></td>
                                        </tr>
                                        <tr>
                                            <td>Tahapan</td>
                                            <td colspan="6"><?= $kontaminasi->tahapan;?></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Temuan</td>
                                            <td colspan="6"><?= $kontaminasi->jumlah_temuan;?></td>
                                        </tr>
                                        <tr>
                                            <td>Bukti Temuan</td>
                                            <td colspan="6">
                                                <?php if (!empty($kontaminasi->bukti)): ?>
                                                    <img src="<?= base_url('uploads/' . $kontaminasi->bukti); ?>" alt="Bukti Temuan" style="max-width: 200px; max-height: 150px;">
                                                <?php else: ?>
                                                    <p>No image available</p>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Analisis Temuan</td>
                                            <td colspan="6"><?= $kontaminasi->analisis;?></td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan Koreksi</td>
                                            <td colspan="6"><?= $kontaminasi->tindakan;?></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td colspan="6"> <?= !empty($kontaminasi->keterangan) ? $kontaminasi->keterangan : 'Tidak ada'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>QC</td>
                                            <td colspan="6"><?= $kontaminasi->username;?></td>
                                        </tr>
                                        <tr>
                                            <td>Produksi</td>
                                            <td colspan="5"><?= $kontaminasi->nama_produksi;?></td>
                                        </tr>
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form class="user" method="post" action="<?= base_url('kontaminasi/statusprod/'.$kontaminasi->uuid);?>">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="form-label font-weight-bold">Status</label>
                                    <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                                        <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $kontaminasi->status_produksi == 1?'selected':'';?>>Checked</option>
                                        <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $kontaminasi->status_produksi == 2?'selected':'';?>>Re-Check</option>
                                    </select>
                                    <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                                        <?= form_error('status_produksi') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label class="form-label font-weight-bold">Catatan Revisi</label>
                                    <textarea class="form-control" name="catatan_produksi" ><?= $kontaminasi->catatan_produksi; ?></textarea>
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
                                    <a href="<?= base_url('kontaminasi/diketahui')?>" class="btn btn-md btn-danger">
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