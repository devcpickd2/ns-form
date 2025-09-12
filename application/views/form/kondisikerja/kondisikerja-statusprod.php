<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Detail Kondisi Kerja Selama Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kondisikerja'); ?>">
                    <i class="fas fa-arrow-left"></i> Daftar Kondisi Kerja Selama Produksi</a>
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
                                $datetime = new datetime($kondisikerja->date);
                                $datetime = $datetime->format('d-m-Y');

                                $time = new datetime($kondisikerja->waktu);
                                $time = $time->format('H:i');
                                ?>
                                <tr>
                                    <th style="text-align:center;" colspan="7">KONDISI KERJA SELAMA PRODUKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:left;"><b>Tanggal : <?= $datetime;?></b></td>
                                    <td><b>Shift : <?= $kondisikerja->shift;?><b></td>
                                        <td colspan="4"><b>Pukul : <?= $time;?><b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Area</b></td>
                                            <td colspan="5"><b><?= $kondisikerja->area;?><b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Item</b></td>
                                                <td><b>Kondisi</b></td>
                                                <td><b>Problem</b></td>
                                                <td colspan="4"><b>Tindakan Koreksi</b></td>
                                            </tr>
                                            <?php
                                            $nilai_keterangan = [
                                                '1' => 'Berdebu',
                                                '2' => 'Basah, ada genangan air',
                                                '3' => 'Sisa produksi (remah-remah roti, tepung, sisa adonan)',
                                                '4' => 'Kosmetik',
                                                '5' => 'Pertumbuhan Mikroorganisme (jamur, bau busuk, biofilm)',
                                                '6' => 'Kontak / kontaminasi material non halal',
                                                '7' => 'Higiene karyawan tidak sesuai GMP',
                                                '✓' => 'Ok, Sesuai SSOP, bersih, bebas najis / material non halal',
                                                'X' => 'Tidak Ok, tidak sesuai SSOP',
                                                '-' => 'Tidak ada / Tidak digunakan'
                                            ];

                                            function tampilkan_kondisi($nilai, $map) {
                                                return isset($map[$nilai]) ? $map[$nilai] : $nilai;
                                            }
                                            ?>
                                            <tr>
                                                <td>Higiene Karyawan</td>
                                                <td><?= tampilkan_kondisi($kondisikerja->kondisi_higiene, $nilai_keterangan); ?></td>
                                                <td><?= $kondisikerja->problem_higiene; ?></td>
                                                <td colspan="4"><?= $kondisikerja->tindakan_higiene; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kebersihan Area</td>
                                                <td><?= tampilkan_kondisi($kondisikerja->kondisi_kebersihan, $nilai_keterangan); ?></td>
                                                <td><?= $kondisikerja->problem_kebersihan; ?></td>
                                                <td colspan="4"><?= $kondisikerja->tindakan_kebersihan; ?></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align:center;" colspan="7">VERIFIKASI</th>
                                            </tr>
                                            <tr>
                                                <td>QC</td>
                                                <td colspan="6"><?= $kondisikerja->username;?></td>
                                            </tr>
                                            <tr>
                                                <td>Produksi</td>
                                                <td colspan="6"><?= $kondisikerja->nama_produksi;?></td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form class="user" method="post" action="<?= base_url('kondisikerja/statusprod/'.$kondisikerja->uuid);?>">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="form-label font-weight-bold">Status</label>
                                        <select class="form-control <?= form_error('status_produksi') ? 'invalid' : '' ?>" name="status_produksi">
                                            <option value="1" <?= set_select('status_produksi', '1'); ?> <?= $kondisikerja->status_produksi == 1?'selected':'';?>>Checked</option>
                                            <option value="2" <?= set_select('status_produksi', '2'); ?> <?= $kondisikerja->status_produksi == 2?'selected':'';?>>Re-Check</option>
                                        </select>
                                        <div class="invalid-feedback <?= !empty(form_error('status_produksi')) ? 'd-block' : '' ; ?> ">
                                            <?= form_error('status_produksi') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label class="form-label font-weight-bold">Catatan Revisi</label>
                                        <textarea class="form-control" name="catatan_produksi" ><?= $kondisikerja->catatan_produksi; ?></textarea>
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
                                        <a href="<?= base_url('kondisikerja/diketahui')?>" class="btn btn-md btn-danger">
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