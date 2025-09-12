<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Metal</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('metal-diketahui'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Pemeriksaan Metal Detector</a>
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
                                $datetime = new datetime($metal->date_metal);
                                $datetime = $datetime->format('d-m-Y');
                                $timing = new DateTime($metal->time);
                                $timing = $timing->format('H:i');
                                $timing2 = new DateTime($metal->update_time_t);
                                $timing2 = $timing2->format('H:i');
                                $timing3 = new DateTime($metal->update_time_b);
                                $timing3 = $timing3->format('H:i');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="5">PEMERIKSAAN METAL DETECTOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td ><b>Shift : <?= $metal->shift;?><b></td>
                                        <td colspan="3"><b>Pukul : <?= $timing;?><b></td>
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
                                        <tr>
                                            <td>No. Program</td>
                                            <td colspan="4"><?= $metal->no_program;?></td>
                                        </tr>
                                        <tr>
                                            <td>Deteksi NG</td>
                                            <td colspan="4">
                                                <?= $metal->deteksi_ng == '1' ? 'Belt Conveyor Berhenti' : ($metal->deteksi_ng == '2' ? 'Rejector' : '-') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>STD. Spesimen</b></td>  
                                            <td><b>Pukul</b></td>  
                                            <td class="text-center"><b>Fe <?= $metal->std_fe;?></b></td>
                                            <td class="text-center"><b>Non Fe <?= $metal->std_nonfe;?></b></td>
                                            <td class="text-center" colspan="2"><b>SUS 304 <?= $metal->std_sus304;?></b></td>
                                        </tr>
                                        <?php
                                        function tampilkanIkon($nilai) {
                                            if ($nilai === null || $nilai === '') {
                                                return '<span style="color: gray; font-weight: bold;">-</span>';
                                            } elseif ($nilai == 'terdeteksi') {
                                                return '<span style="color: green; font-weight: bold;">&#10004;</span>';
                                            } else {
                                                return '<span style="color: red; font-weight: bold;">&#10006;</span>';
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td>Deteksi Pertama</td>
                                            <td><?= $timing; ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->fe_d); ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->nonfe_d); ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->sus_d); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Deteksi Kedua</td>
                                            <td><?= $timing2; ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->fe_t); ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->nonfe_t); ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->sus_t); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Deteksi Terakhir</td>
                                            <td><?= $timing3; ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->fe_b); ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->nonfe_b); ?></td>
                                            <td class="text-center"><?= tampilkanIkon($metal->sus_b); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td colspan="4"><?= $metal->keterangan;?></td>
                                        </tr>
                                        <tr>
                                            <td>Catatan</td>
                                            <td colspan="4"><?= !empty($metal->catatan_metal) ? $metal->catatan_metal : 'Tidak ada'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>QC</td>
                                            <td colspan="4"><?= $metal->username_1;?></td>
                                        </tr>
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form class="user" method="post" action="<?= base_url('metal/statusprod/'.$metal->uuid);?>">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label class="form-label font-weight-bold">Status</label>
                                    <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                                        <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $metal->status_produksi == 1?'selected':'';?>>Checked</option>
                                        <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $metal->status_produksi == 2?'selected':'';?>>Re-Check</option>
                                    </select>
                                    <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                                        <?= form_error('status_produksi') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label class="form-label font-weight-bold">Catatan Revisi</label>
                                    <textarea class="form-control" name="catatan_produksi" ><?= $metal->catatan_produksi; ?></textarea>
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
                                    <a href="<?= base_url('metal/diketahui')?>" class="btn btn-md btn-danger">
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

