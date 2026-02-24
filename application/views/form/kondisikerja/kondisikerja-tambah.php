<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Kondisi Kerja Selama Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('kondisikerja')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Kondisi Kerja Selama Produksi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('kondisikerja/tambah');?>" enctype="multipart/form-data">
                    <?php
                    $produksi_input = $this->session->userdata('produksi_input');
                    $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                    $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                    ?>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tanggal</label>
                            <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                            value="<?= $tanggal ?>">
                            <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                                <?= form_error('date') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Shift</label>
                            <select class="form-control <?= form_error('shift') ? 'is-invalid' : '' ?>" name="shift">
                                <option disabled <?= empty($shift) ? 'selected' : '' ?>>Pilih Shift</option>
                                <option value="1" <?= $shift == '1' ? 'selected' : '' ?>>Shift 1</option>
                                <option value="2" <?= $shift == '2' ? 'selected' : '' ?>>Shift 2</option>
                                <option value="3" <?= $shift == '3' ? 'selected' : '' ?>>Shift 3</option>
                            </select>
                            <div class="invalid-feedback <?= form_error('shift') ? 'd-block' : '' ?>">
                                <?= form_error('shift') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Area</label>
                            <input type="text" name="area" class="form-control <?= form_error('area') ? 'invalid' : '' ?> " value="<?= set_value('area'); ?>">
                            <div class="invalid-feedback <?= !empty(form_error('area')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('area') ?>
                            </div>
                        </div> 
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Pukul</label>
                            <input type="time" name="waktu" class="form-control <?= form_error('waktu') ? 'invalid' : '' ?> " value="<?php echo date("H:i") ?>">
                            <div class="invalid-feedback <?= !empty(form_error('waktu')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('waktu') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="form-label font-weight-bold">HIGIENE KARYAWAN</label>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label class="form-label font-weight-bold">Kondisi</label>
                            <select name="kondisi_higiene" class="form-control <?= form_error('kondisi_higiene') ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih Kondisi --</option>
                                <?php 
                                $options = [
                                    '1' => '1. Berdebu',
                                    '2' => '2. Basah, ada genangan air',
                                    '3' => '3. Sisa produksi (remah-remah roti, tepung, sisa adonan)',
                                    '4' => '4. Noda (karat, cat, tinta)',
                                    '5' => '5. Pertumbuhan Mikroorganisme (jamur, bau busuk, biofilm)',
                                    '6' => '6. Kontak / kontaminasi material non halal',
                                    '7' => '7. Higiene karyawan tidak sesuai GMP',
                                    '✓' => '✓ Ok, Sesuai SSOP, bersih, bebas najis / material non halal',
                                    'X' => 'X Tidak Ok, tidak sesuai SSOP',
                                    '-' => '- Tidak ada / Tidak digunakan'
                                ];

                                $selected_value = set_value('kondisi_higiene');
                                foreach ($options as $value => $label): 
                                    ?>
                                    <option value="<?= $value ?>" <?= $selected_value == $value ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback <?= form_error('kondisi_higiene') ? 'd-block' : '' ?>">
                                <?= form_error('kondisi_higiene') ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Problem</label>
                            <textarea class="form-control" name="problem_higiene"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('problem_higiene')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('problem_higiene') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tindakan Koreksi</label>
                            <textarea class="form-control" name="tindakan_higiene"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('tindakan_higiene')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('tindakan_higiene') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label class="form-label font-weight-bold">KEBERSIHAN AREA</label>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <label class="form-label font-weight-bold">Kondisi</label>
                            <select name="kondisi_kebersihan" class="form-control <?= form_error('kondisi_kebersihan') ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih Kondisi --</option>
                                <?php 
                                $options = [
                                    '1' => '1. Berdebu',
                                    '2' => '2. Basah, ada genangan air',
                                    '3' => '3. Sisa produksi (remah-remah roti, tepung, sisa adonan)',
                                    '4' => '4. Noda (karat, cat, tinta)',
                                    '5' => '5. Pertumbuhan Mikroorganisme (jamur, bau busuk, biofilm)',
                                    '6' => '6. Kontak / kontaminasi material non halal',
                                    '7' => '7. Higiene karyawan tidak sesuai GMP',
                                    '✓' => '✓ Ok, Sesuai SSOP, bersih, bebas najis / material non halal',
                                    'X' => 'X Tidak Ok, tidak sesuai SSOP',
                                    '-' => '- Tidak ada / Tidak digunakan'
                                ];

                                $selected_value = set_value('kondisi_kebersihan');
                                foreach ($options as $value => $label): 
                                    ?>
                                    <option value="<?= $value ?>" <?= $selected_value == $value ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback <?= form_error('kondisi_kebersihan') ? 'd-block' : '' ?>">
                                <?= form_error('kondisi_kebersihan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Problem</label>
                            <textarea class="form-control" name="problem_kebersihan"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('problem_kebersihan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('problem_kebersihan') ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Tindakan Koreksi</label>
                            <textarea class="form-control" name="tindakan_kebersihan"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('tindakan_kebersihan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('tindakan_kebersihan') ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label class="form-label font-weight-bold">Catatan</label>
                            <textarea class="form-control" name="catatan"></textarea>
                            <div class="invalid-feedback <?= !empty(form_error('catatan')) ? 'd-block' : '' ; ?> ">
                                <?= form_error('catatan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-md btn-success mr-2">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="<?= base_url('kondisikerja')?>" class="btn btn-md btn-danger">
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