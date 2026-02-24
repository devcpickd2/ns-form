    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Daftar Verifikasi Proses Produksi</h1>
        </div>

        <?php if($this->session->flashdata('success_msg')): ?>
            <div class="alert alert-success text-center">
                <i class="fas fa-check"></i>
                <?= $this->session->flashdata('success_msg') ?>
            </div>
        <?php endif ?>

        <?php if($this->session->flashdata('error_msg')): ?>
            <div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-triangle"></i>
                <?= $this->session->flashdata('error_msg') ?>
            </div>
        <?php endif ?>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="20px" class="text-center">No</th>
                                <th>Date / Shift</th>
                                <th>Nama Produk</th>
                                <th>Kode Produksi</th>
                                <th>Packing Date</th>
                                <th>Last Updated</th>
                                <th>Last Verified</th>
                                <th>Status SPV</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($produksi as $val) {
                                $datetime = new DateTime($val->date);
                                $datetime = $datetime->format('d-m-Y');
                                $datetime_packing = new datetime($val->date_packing);
                                $datetime_packing = $datetime_packing->format('d-m-Y');
                                $time = new DateTime($val->pukul_packing);
                                $time = $time->format('H:i');
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $datetime . ' / '. $val->shift; ?></td>
                                    <td><?= $val->nama_produk; ?></td>
                                    <td><?= $val->kode_produksi; ?></td>
                                    <td>
                                        <?php if ($datetime_packing == '30-11--0001' || $val->date_packing == '0000-00-00' || empty($val->date_packing)): ?>
                                            <span style="color:red; font-weight:bold; font-size:16px;">Belum Dikemas</span>
                                        <?php else: ?>
                                            <?= $datetime_packing . " / " . $time; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('H:i - d/m/Y', strtotime($val->modified_at)); ?></td>
                                    <td><?= date('H:i - d/m/Y', strtotime($val->tgl_update)); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($val->status_spv == 0) {
                                            echo '<span style="color: #99a3a4; font-weight: bold;">Created</span>';
                                        } elseif ($val->status_spv == 1) {
                                            echo '<span style="color: #28b463; font-weight: bold;">Verified</span>';
                                        } elseif ($val->status_spv == 2) {
                                            echo '<span style="color: red; font-weight: bold;">Revision</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('produksi/status/'.$val->uuid);?>" class="btn btn-warning btn-icon-split">
                                            <span class="text">Verifikasi</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <form action="<?= base_url('produksi/cetak') ?>" method="post" id="form-produk">
                    <div class="mt-4">
                        <label class="font-weight-bold">Pilih Tanggal & Produk:</label>
                        <div class="form-inline">
                            <input type="date" name="tanggal" id="tanggal" class="form-control mr-2" required>

                            <select name="produk_uuid" id="nama_produk" class="form-control mr-2" required>
                                <option value="">-- Pilih Nama Produk --</option>
                            </select>

                            <button type="submit" class="btn btn-success mr-2">
                                <i class="fas fa-print"></i> Cetak PDF
                            </button>
                        </div>
                    </div>
                </form>

                <!-- FORM EXPORT EXCEL -->
                <!-- <form action="<?= base_url('produksi/export_excel') ?>" method="post" id="form-excel">
                    <input type="hidden" name="tanggal" id="excel_tanggal">
                    <input type="hidden" name="nama_produk" id="excel_nama_produk">
                    <button type="submit" class="btn btn-info mt-2">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </form> -->

            </div>
        </div>
    </div>
</div>

<!-- Script jQuery & AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        // Ambil nama produk berdasarkan tanggal
    $('#tanggal').on('change', function () {
        var tanggal = $(this).val();

        if (tanggal) {
            $.ajax({
                url: "<?= base_url('produksi/get_nama_produk_by_tanggal') ?>",
                method: "POST",
                data: { tanggal: tanggal },
                dataType: "json",
                success: function (data) {
                    $('#nama_produk').empty().append('<option value="">-- Pilih Nama Produk --</option>');
                    if (data.length > 0) {
                        $.each(data, function (i, item) {
                            $('#nama_produk').append('<option value="' + item.uuid + '">' + item.nama_produk + '</option>');
                        });
                    } else {
                        $('#nama_produk').append('<option value="">Tidak ada produk</option>');
                    }
                },
                error: function () {
                    alert('Gagal mengambil data produk');
                }
            });
        }
    });


        // Saat form excel diklik, ambil nilai dari form utama
    $('#form-excel').on('submit', function (e) {
        var tanggal = $('#tanggal').val();
        var namaProduk = $('#nama_produk').val();

        if (!tanggal || !namaProduk) {
            alert('Tanggal dan Nama Produk harus diisi terlebih dahulu.');
            e.preventDefault();
            return false;
        }

        $('#excel_tanggal').val(tanggal);
        $('#excel_nama_produk').val(namaProduk);
    });

</script>

<!-- Style tambahan -->
<style>
    th {
        background-color: #f8f9fc;
    }
</style>
