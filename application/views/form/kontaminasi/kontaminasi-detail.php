<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Detail Kontaminasi Benda Asing</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"> 
            <li class="breadcrumb-item">
                <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] . '?search=' . urlencode($this->input->get('search')) : base_url('kontaminasi'); ?>">
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
                                                    <img src="<?= base_url('uploads/' . $kontaminasi->bukti); ?>" alt="Bukti Temuan" style="max-width: 200px; max-height: 180px;">
                                                <?php else: ?>
                                                    <p>No image available</p>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td colspan="6"> <?= !empty($kontaminasi->keterangan) ? $kontaminasi->keterangan : 'Tidak ada'; ?></td>
                                        </tr>
                                        <tr>
                                            <th style="text-align:center;" colspan="5">VERIFIKASI</th>
                                        </tr>
                                        <tr>
                                            <td>QC</td>
                                            <td colspan="6"><?= $kontaminasi->username;?></td>
                                        </tr>
                                        <tr>
                                            <td>Produksi</td>
                                            <td colspan="5"><?= $kontaminasi->nama_produksi;?></td>
                                        </tr>
                                        <tr>
                                            <td>Diketahui Produksi</td>
                                            <td colspan="4">
                                                <?php
                                                if ($kontaminasi->status_produksi == 0) {
                                                    echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                                } elseif ($kontaminasi->status_produksi == 1) {
                                                    echo '<span style="color: #28b463; font-weight: bold;">Checked</span>';
                                                } elseif ($kontaminasi->status_produksi == 2) {
                                                    echo '<span style="color: red; font-weight: bold;">Re-Check</span>';
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td>Catatan Produksi</td>
                                            <td colspan="4"><?= !empty($kontaminasi->catatan_produksi) ? $kontaminasi->catatan_produksi : 'Tidak ada'; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Disetujui Supervisor</td>
                                            <td colspan="4"><?php
                                            if ($kontaminasi->status_spv == 0) {
                                                echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                            } elseif ($kontaminasi->status_spv == 1) {
                                                echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                            } elseif ($kontaminasi->status_spv == 2) {
                                                echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                            }
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan Supervisor</td>
                                        <td colspan="4"><?= !empty($kontaminasi->catatan_spv) ? $kontaminasi->catatan_spv : 'Tidak ada'; ?></td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>
                    </div>
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