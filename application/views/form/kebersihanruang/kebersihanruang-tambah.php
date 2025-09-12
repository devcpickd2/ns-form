<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Kebersihan Ruang Produksi</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('kebersihanruang')?>">
                    <i class="fas fa-arrow-left">
                    </i> Daftar Kebersihan Ruang Produksi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav> 
        <div class="card shadow mb-4">
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('kebersihanruang/tambah');?>" enctype="multipart/form-data">
                 <div style="display: flex; gap: 20px;">
                    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 30%; text-align: left; font-family: Arial, sans-serif; font-size: 12px;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th colspan="2" style="padding: 5px; background-color: #ADD8E6; color: gray;">Keterangan Pemeriksaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Berdebu</td>
                            </tr>
                            <tr>
                                <td>2. Basah</td>
                            </tr>
                            <tr>
                                <td>3. Pecah & Retak</td>
                            </tr>
                            <tr>
                                <td>4. Sisa produksi seperti sisa terigu/produk</td>
                            </tr>
                            <tr>
                                <td>5. Noda seperti tinta, karat</td>
                            </tr>
                            <tr>
                                <td>6. Pertumbuhan mikroorganisme, seperti jamur dan bau busuk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <?php
                $produksi_input = $this->session->userdata('produksi_input');
                $tanggal = set_value('date', isset($produksi_input['tanggal']) ? $produksi_input['tanggal'] : date("Y-m-d"));
                $shift = set_value('shift', isset($produksi_input['shift']) ? $produksi_input['shift'] : '');
                ?>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="form-label font-weight-bold">Tanggal</label>
                        <input type="date" name="date" class="form-control <?= form_error('date') ? 'is-invalid' : '' ?>" 
                        value="<?= $tanggal ?>">
                        <div class="invalid-feedback <?= form_error('date') ? 'd-block' : '' ?>">
                            <?= form_error('date') ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
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
                    <div class="col-sm-6">
                        <label class="form-label font-weight-bold">Lokasi</label>
                        <select name="lokasi" id="lokasiDropdown" class="form-control <?= form_error('lokasi') ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Lokasi --</option>
                        </select>
                        <div class="invalid-feedback <?= form_error('lokasi') ? 'd-block' : '' ?>">
                            <?= form_error('lokasi') ?>
                        </div>
                    </div>
                </div>

<!-- area preparasi -->
<div id="form-preparasi" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA PREPARASI</label>
    <?php
    $bagianpreparasi = ['Lantai', 'Dinding', 'Pintu & Plastic Curtain', 'Langit-langit dan Lampu', 'Planetary Mixer', 'Mesin Ayakan', 'Conveyor Transport I', 'Ducting', 'Fly Catcher', 'Tempat Sampah'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>

    <?php foreach ($bagianpreparasi as $indexpreparasi => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexpreparasi;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form preparasi -->

<!-- area mixing -->
<div id="form-mixing" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA MIXING</label>
    <?php
    $bagianmixing = ['Lantai', 'Dinding', 'Pintu & Tirai Plastic', 'Langit-langit dan Lampu', 'Ember Ayakan', 'Ribbon Mixer', 'Sillo', 'Ducting', 'Mesin Ayakan', 'Exhaust Fan', 'APAR', 'Selang Air', 'Tempat Sampah'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagianmixing as $indexmixing => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexmixing;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form mixing -->

<!-- area timbang -->
<div id="form-timbang" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA TIMBANG</label>
    <?php
    $bagiantimbang = ['Lantai', 'Dinding', 'Pintu & Tirai Plastic', 'Langit-langit dan Lampu', 'Ducting', 'Conveyor Transport I', 'Bagging Gross', 'Conveyor Transport II', 'Metal Detector', 'Conveyor Transport III', 'Mesin Print Coding', 'Meja Timbang', 'Exhaust Fan', 'Mesin Foot Sealer', 'RGS', 'Selang Angin', 'Selang Air', 'Tempat Sampah'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagiantimbang as $indextimbang => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indextimbang;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form timbang -->

<!-- area bumbu -->
<div id="form-bumbu" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA BUMBU BAKSO</label>
    <?php
    $bagianbumbu = ['Lantai', 'Dinding', 'Pintu & Tirai Plastic', 'Langit-langit dan Lampu', 'Mixer Bumbu Bakso', 'Mesin Packing Bumbu Bakso', 'Meja', 'Selang Angin', 'Tempat Sampah'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagianbumbu as $indexbumbu => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexbumbu;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form bumbu -->

<!-- area packing-dalam -->
<div id="form-packing-dalam" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA PACKING DALAM</label>
    <?php
    $bagianpacking_dalam = ['Lantai', 'Dinding', 'Pintu & Tirai Plastik', 'Langit-langit dan Lampu', 'Ducting', 'Sillo', 'Mesin Sachet', 'Tabung Nitrogen', 'Mesin Janasi', 'Selang Air', 'Selang Angin', 'Tempat Sampah'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagianpacking_dalam as $indexpacking_dalam => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexpacking_dalam;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form packing-dalam -->

<!-- area packing-luar -->
<div id="form-packing-luar" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA PACKING LUAR</label>
    <?php
    $bagianpacking_luar = ['Lantai', 'Dinding', 'Pintu & Tirai Plastik', 'Langit-langit dan Lampu', 'Ducting', 'Conveyor Transport I', 'Metal Detector', 'Meja Packing', 'Mesin Sealer Box', 'Check Weigher', 'Conveyor Transport II', 'Selang Air', 'Tempat Sampah'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagianpacking_luar as $indexpacking_luar => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexpacking_luar;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form packing-luar -->

<!-- area drystore -->
<div id="form-drystore" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA DRY STORE</label>
    <?php
    $bagiandrystore = ['Lantai', 'Dinding', 'Pintu & Tirai Plastic', 'Langit-langit dan Lampu', 'Rak Plastik', 'Meja'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagiandrystore as $indexdrystore => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexdrystore;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form drystore -->

<!-- area sanitasi -->
<div id="form-sanitasi" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA SANITASI</label>
    <?php
    $bagiansanitasi = ['Lantai', 'Dinding', 'Pintu & Tirai Plastic', 'Langit-langit dan Lampu', 'Mixer Bumbu Bakso', 'Selang Air'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagiansanitasi as $indexsanitasi => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexsanitasi;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form sanitasi -->

<!-- area giling -->
<div id="form-giling" class="form-area d-none">
    <label class="form-label font-weight-bold">AREA GILING LADA</label>
    <?php
    $bagiangiling = ['Lantai', 'Dinding', 'Pintu & Tirai Plastic', 'Langit-langit dan Lampu', 'Mesin Ayakan', 'Mesin Giling Lada', 'Ducting', 'Exhaust Fan', 'Tempat Sampah'];
    $kondisi_options = array_merge(['bersih'], range(1, 6));
    ?>
    <?php foreach ($bagiangiling as $indexgiling => $bagian): ?>
        <div class="form-group row">
            <div class="col-sm-2">
                <label class="form-label font-weight-bold">Bagian</label>
                <input type="text" name="bagian[]" class="form-control <?= form_error('bagian[]') ? 'invalid' : '' ?>" value="<?= $bagian ?>" readonly>
                <div class="invalid-feedback <?= !empty(form_error('bagian[]')) ? 'd-block' : '' ?>">
                    <?= form_error('bagian[]') ?>
                </div>
            </div>
            <div class="col-sm-4">
                <label class="form-label font-weight-bold d-block">Kondisi</label>
                <?php foreach ($kondisi_options as $opt): ?>
                    <?php
                    $value = (string) $opt;
                    $id = 'kondisi-' . $value . '-' . $indexgiling;
                    $checked = in_array($value, set_value('kondisi', [])) ? 'checked' : '';
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input kondisi-checkbox" 
                        type="checkbox" 
                        name="kondisi[]" 
                        value="<?= $value ?>" 
                        id="<?= $id ?>" 
                        <?= $checked ?>>
                        <label class="form-check-label" for="<?= $id ?>"><?= ucfirst($value) ?></label>
                    </div>
                <?php endforeach; ?>
                <div class="invalid-feedback d-block">
                    <?= form_error('kondisi[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Problem</label>
                <input type="text" name="problem[]" class="form-control <?= form_error('problem[]') ? 'invalid' : '' ?>" value="<?= set_value('problem[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('problem[]')) ? 'd-block' : '' ?>">
                    <?= form_error('problem[]') ?>
                </div>
            </div>
            <div class="col-sm-3">
                <label class="form-label font-weight-bold">Tindakan</label>
                <input type="text" name="tindakan[]" class="form-control <?= form_error('tindakan[]') ? 'invalid' : '' ?>" value="<?= set_value('tindakan[]'); ?>">
                <div class="invalid-feedback <?= !empty(form_error('tindakan[]')) ? 'd-block' : '' ?>">
                    <?= form_error('tindakan[]') ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- batas form giling -->

<div class="row">
    <div class="col">
        <button type="submit" class="btn btn-md btn-success mr-2">
            <i class="fa fa-save"></i> Simpan
        </button>
        <a href="<?= base_url('kebersihanruang')?>" class="btn btn-md btn-danger">
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

<script>
    const lokasiOptions = {
        Cikande: [
            "Area Preparasi", "Area Mixing", "Area Timbang", "Area Bumbu Bakso",
            "Area Packing Dalam", "Area Packing Luar", "Area Dry Store",
            "Area Sanitasi", "Area Giling Lada"
        ]
    };

    const lokasiDropdown = document.getElementById('lokasiDropdown');

    function updateLokasiOptions() {
        const lokasiList = lokasiOptions["Cikande"];
        lokasiDropdown.innerHTML = '<option value="">-- Pilih Lokasi --</option>';

        lokasiList.forEach(lokasi => {
            const option = document.createElement('option');
            option.value = lokasi;
            option.textContent = lokasi;
            if ("<?= set_value('lokasi') ?>" === lokasi) {
                option.selected = true;
            }
            lokasiDropdown.appendChild(option);
        });
    }

    window.addEventListener('DOMContentLoaded', updateLokasiOptions);
</script>

<!-- Menampilkan form berdasarkan lokasi -->
<script>
    $(document).ready(function(){
        $('#lokasiDropdown').change(function(){
            $('.form-area').addClass('d-none'); 
            var selected = $(this).val();

            if(selected === 'Area Preparasi'){
                $('#form-preparasi').removeClass('d-none');
            } else if(selected === 'Area Mixing'){
                $('#form-mixing').removeClass('d-none');
            } else if(selected === 'Area Timbang'){
                $('#form-timbang').removeClass('d-none');
            } else if(selected === 'Area Bumbu Bakso'){
                $('#form-bumbu').removeClass('d-none');
            } else if(selected === 'Area Packing Dalam'){
                $('#form-packing-dalam').removeClass('d-none');
            } else if(selected === 'Area Packing Luar'){
                $('#form-packing-luar').removeClass('d-none');
            } else if(selected === 'Area Dry Store'){
                $('#form-drystore').removeClass('d-none');
            } else if(selected === 'Area Sanitasi'){
                $('#form-sanitasi').removeClass('d-none');
            } else if(selected === 'Area Giling Lada'){
                $('#form-giling').removeClass('d-none');
            }
        });
    });
</script>

<!-- Nonaktifkan semua form yang tidak sesuai -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const lokasiDropdown = document.getElementById("lokasiDropdown");

        const forms = {
            "Area Preparasi": document.getElementById("form-preparasi"),
            "Area Mixing": document.getElementById("form-mixing"),
            "Area Timbang": document.getElementById("form-timbang"),
            "Area Bumbu Bakso": document.getElementById("form-bumbu"),
            "Area Packing Dalam": document.getElementById("form-packing-dalam"),
            "Area Packing Luar": document.getElementById("form-packing-luar"),
            "Area Dry Store": document.getElementById("form-drystore"),
            "Area Sanitasi": document.getElementById("form-sanitasi"),
            "Area Giling Lada": document.getElementById("form-giling"),
        };

        function toggleForms() {
            const selected = lokasiDropdown.value;

            Object.values(forms).forEach(form => {
                if (form) {
                    form.classList.add("d-none");
                    const elements = form.querySelectorAll("input, select, textarea");
                    elements.forEach(el => el.disabled = true);
                }
            });

            const targetForm = forms[selected];
            if (targetForm) {
                targetForm.classList.remove("d-none");
                const elements = targetForm.querySelectorAll("input, select, textarea");
                elements.forEach(el => el.disabled = false);
            }
        }

        lokasiDropdown.addEventListener("change", toggleForms);
        toggleForms(); // inisialisasi saat halaman dimuat
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Seleksi semua bagian form area
        document.querySelectorAll('.form-group.row').forEach(function (row) {
            const checkboxes = row.querySelectorAll('.kondisi-checkbox');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const value = checkbox.value.toLowerCase();

                    if (value === 'bersih' && checkbox.checked) {
                    // Jika "bersih" dicentang, disable yang lain
                        checkboxes.forEach(function (cb) {
                            if (cb.value !== 'bersih') {
                                cb.checked = false;
                                cb.disabled = true;
                            }
                        });
                    } else if (value === 'bersih' && !checkbox.checked) {
                    // Jika "bersih" tidak dicentang, aktifkan kembali semua
                        checkboxes.forEach(function (cb) {
                            cb.disabled = false;
                        });
                    } else if (value !== 'bersih') {
                    // Jika checkbox selain "bersih" dicentang, uncheck dan disable "bersih"
                        const bersihCheckbox = Array.from(checkboxes).find(cb => cb.value === 'bersih');
                        if (checkbox.checked) {
                            bersihCheckbox.checked = false;
                            bersihCheckbox.disabled = true;
                        }

                    // Jika semua checkbox selain "bersih" tidak dipilih, aktifkan kembali "bersih"
                        const otherChecked = Array.from(checkboxes).some(cb => cb.value !== 'bersih' && cb.checked);
                        if (!otherChecked) {
                            bersihCheckbox.disabled = false;
                        }
                    }
                });
            });
        });
    });
</script>

