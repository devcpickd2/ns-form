<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Pegawai</h1>
        <a href="<?= base_url('pegawai/tambah')?>" class="btn btn-md btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah</a>
    </div>

    <?php if($this->session->flashdata('success_msg')): ?>
        <div class="alert alert-success text-center">
            <i class="fas fa-check"></i>
            <?= $this->session->flashdata('success_msg') ?>
        </div>
        <br>
    <?php endif ?>

    <?php if($this->session->flashdata('error_msg')): ?>
        <div class="alert alert-danger text-center">
            <i class="fas fa-check"></i>
            <?= $this->session->flashdata('error_msg') ?>
        </div>
        <br>
    <?php endif ?> 

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="form-group" id="cpi">
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Plant</th>
                            <th>Departemen</th>
                            <!-- <th>Tipe User</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($pegawai as $val) {
                            ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $val->nama; ?></td>
                                <td><?= $val->email; ?></td>
                                <td><?= $val->username; ?></td>
                                <td><?= $val->plant; ?></td>
                                <td><?= $val->departemen; ?></td>
                                <!-- <td>
                                    <?php
                                    if ($val->tipe_user == 0) {
                                        echo "Admin";
                                    } elseif ($val->tipe_user == 1) {
                                        echo "Manager";
                                    } elseif ($val->tipe_user == 2) {
                                        echo "Supervisor";
                                    } elseif ($val->tipe_user == 3) {
                                        echo "Foreman/Forelady";
                                    } elseif ($val->tipe_user == 4) {
                                        echo "Staff";
                                    }
                                    ?>
                                </td> -->
                                <td class="text-center">
                                    <!-- <a href="<?= base_url('pegawai/edit/'.$val->uuid);?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit">Edit</i>
                                    </a>  -->
                                    <a href="<?= base_url('pegawai/edit/'.$val->uuid);?>" class="btn btn-primary btn-icon-split">
                                        <span class="text">Edit</span>
                                    </a>
                                    <!-- <a href="<?= base_url('pegawai/edituser/'.$val->uuid);?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-info-circle">Uname</i>
                                    </a>
                                    <a href="<?= base_url('pegawai/editpass/'.$val->uuid);?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-info-circle">Pass</i>
                                    </a> -->
                                    <a href="<?= base_url('pegawai/delete/'.$val->uuid);?>" class="btn btn-danger btn-icon-split" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <span class="text">Delete</span>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</div>

</div>
</div>