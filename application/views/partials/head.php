<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('assets\img\favicon.ico');?>" type="image/x-icon">
    <title>E-NS</title>
    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">
    <!-- Custom styles for this page -->
    <!-- Bootstrap 4 Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Tempus Dominus Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css');?>">
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home');?>">
                <div class="sidebar-brand-icon rotate-n-15">
                 <i class="fas fa-seedling"></i>
             </div>
             <div class="sidebar-brand-text mx-3">NEW SEASONING</div>
         </a>
         <hr class="sidebar-divider my-0">
         <li class="nav-item <?= $active_nav == 'home' ?'active':'';?>">
            <a class="nav-link" href="<?= base_url('home');?>">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php
        $tipe_user = $this->session->userdata('tipe_user');
        ?>
        <!-- MASTER DATA (hanya tipe_user 0 & 1) -->
        <?php if ($tipe_user == 0): ?>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">MASTER DATA</div>
            <li class="nav-item <?= $active_nav == 'data_master' | $active_nav == 'pegawai' | $active_nav == 'departemen' | $active_nav == 'plant'?'active':'';?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataMaster"
                aria-expanded="true" aria-controls="collapseDataMaster">
                <i class="fas fa-briefcase"></i>
                <span>Data Master</span>
            </a>

            <div id="collapseDataMaster" class="collapse <?= $active_nav == 'pegawai' | $active_nav == 'departemen' | $active_nav == 'plant' | $active_nav == 'peralatan' | $active_nav == 'produk' ?'show':'';?>" aria-labelledby="headingDataMaster" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $active_nav == 'pegawai' ?'active':'';?>" href="<?= base_url('pegawai')?>">Pegawai</a>
                    <a class="collapse-item <?= $active_nav == 'departemen' ?'active':'';?>" href="<?= base_url('departemen')?>">Departemen</a>
                    <a class="collapse-item <?= $active_nav == 'plant' ?'active':'';?>" href="<?= base_url('plant')?>">Plant</a>
                    <a class="collapse-item <?= $active_nav == 'produk' ?'active':'';?>" href="<?= base_url('produk')?>">List Produk</a>
                    <a class="collapse-item <?= $active_nav == 'peralatan' ?'active':'';?>" href="<?= base_url('peralatan')?>">Peralatan</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <!-- Awal Form QC -->

<!-- FORM QC (hanya user_type 0,1,4) -->
<?php if (in_array($tipe_user, [0, 1, 4, 8])): ?>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">FORM QC</div>
    <li class="nav-item <?= $active_nav == 'form_qc' | $active_nav == 'pengayakan' | $active_nav == 'produksi' | $active_nav == 'metal' |  $active_nav == 'falserejection' |  $active_nav == 'kontaminasi' |  $active_nav == 'kekuatanmagnet' |  $active_nav == 'verifikasimagnet' | $active_nav == 'timbangan' |  $active_nav == 'releasepacking' |  $active_nav == 'pengemasan' | $active_nav == 'sanitasi' |  $active_nav == 'ketidaksesuaian' |  $active_nav == 'pemusnahan' |  $active_nav == 'kondisikerja' |  $active_nav == 'retain' |  $active_nav == 'kebersihankaryawan' |  $active_nav == 'kebersihanperalatan' | $active_nav == 'kebersihanruang' |  $active_nav == 'sanitasiwarehouse' | $active_nav == 'disposisi' | $active_nav == 'suhu' | $active_nav == 'lada' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC1"
        aria-expanded="true" aria-controls="collapseQC1">
        <i class="fas fa-broom"></i>
        <span>KEBERSIHAN & SUHU</span></a>
        <div id="collapseQC1" class="collapse <?=  $active_nav == 'suhu' | $active_nav == 'sanitasi' |  $active_nav == 'kondisikerja' |  $active_nav == 'kebersihankaryawan' |  $active_nav == 'kebersihanperalatan' | $active_nav == 'kebersihanruang' ?'show':'';?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $active_nav == 'suhu' ?'active':'';?>" href="<?= base_url('suhu')?>">Pemeriksaan Suhu Ruang</a>
                <a class="collapse-item <?= $active_nav == 'sanitasi' ?'active':'';?>" href="<?= base_url('sanitasi')?>">Pemeriksaan Sanitasi</a>
                <a class="collapse-item <?= $active_nav == 'kondisikerja' ?'active':'';?>" href="<?= base_url('kondisikerja')?>">Kondisi Kerja Selama Produksi</a>
                <a class="collapse-item <?= $active_nav == 'kebersihankaryawan' ?'active':'';?>" href="<?= base_url('kebersihankaryawan')?>">Kebersihan Karyawan</a>
                <a class="collapse-item <?= $active_nav == 'kebersihanperalatan' ?'active':'';?>" href="<?= base_url('kebersihanperalatan')?>">Kebersihan Peralatan</a>
                <a class="collapse-item <?= $active_nav == 'kebersihanruang' ?'active':'';?>" href="<?= base_url('kebersihanruang')?>">Kebersihan Ruang Produksi</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC2"
        aria-expanded="true" aria-controls="collapseQC2">
        <i class="fas fa-database"></i>
        <span>PRODUKSI</span></a>
        <div id="collapseQC2" class="collapse <?= $active_nav == 'pengayakan' | $active_nav == 'kekuatanmagnet' |  $active_nav == 'verifikasimagnet' | $active_nav == 'timbangan' | $active_nav == 'produksi' | $active_nav == 'ketidaksesuaian' | $active_nav == 'lada' | $active_nav == 'disposisi' |$active_nav == 'pemusnahan' | $active_nav == 'retain' ?'show':'';?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $active_nav == 'kekuatanmagnet' ?'active':'';?>" href="<?= base_url('kekuatanmagnet')?>">Pemeriksaan Kekuatan Magnet Trap</a>
                <a class="collapse-item <?= $active_nav == 'verifikasimagnet' ?'active':'';?>" href="<?= base_url('verifikasimagnet')?>">Verifikasi Magnet Trap</a>
                <a class="collapse-item <?= $active_nav == 'timbangan' ?'active':'';?>" href="<?= base_url('timbangan')?>">Pemeriksaan Timbangan</a>
                <a class="collapse-item <?= $active_nav == 'ketidaksesuaian' ?'active':'';?>" href="<?= base_url('ketidaksesuaian')?>">Ketidaksesuaian Produk</a>
                <a class="collapse-item <?= $active_nav == 'pengayakan' ?'active':'';?>" href="<?= base_url('pengayakan')?>">Pemeriksaan Pengayakan</a>
                <a class="collapse-item <?= $active_nav == 'lada' ?'active':'';?>" href="<?= base_url('lada')?>">Pemeriksaan Giling Lada</a>
                <a class="collapse-item <?= $active_nav == 'produksi' ?'active':'';?>" href="<?= base_url('produksi')?>">Verifikasi Proses Produksi</a>
                <a class="collapse-item <?= $active_nav == 'disposisi' ?'active':'';?>" href="<?= base_url('disposisi')?>">Disposisi Produk dan Prosedur</a>
                <a class="collapse-item <?= $active_nav == 'pemusnahan' ?'active':'';?>" href="<?= base_url('pemusnahan')?>">Pemusnahan Barang / Produk</a>
                <a class="collapse-item <?= $active_nav == 'retain' ?'active':'';?>" href="<?= base_url('retain')?>">Retain Sample Report</a>
            </div>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC3"
        aria-expanded="true" aria-controls="collapseQC3">
        <i class="fas fa-cube"></i>
        <span>PACKING</span></a>
        <div id="collapseQC3" class="collapse <?= $active_nav == 'metal' |  $active_nav == 'falserejection' | $active_nav == 'kontaminasi' |  $active_nav == 'releasepacking' |  $active_nav == 'pengemasan' ?'show':'';?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $active_nav == 'metal' ?'active':'';?>" href="<?= base_url('metal')?>">Pemeriksaan Metal Detector</a>
                <!-- <a class="collapse-item <?= $active_nav == 'falserejection' ?'active':'';?>" href="<?= base_url('falserejection')?>">Monitoring False Rejection</a> -->
                <a class="collapse-item <?= $active_nav == 'kontaminasi' ?'active':'';?>" href="<?= base_url('kontaminasi')?>">Kontaminasi Benda Asing</a>
                <a class="collapse-item <?= $active_nav == 'pengemasan' ?'active':'';?>" href="<?= base_url('pengemasan')?>">Pemeriksaan Proses Pengemasan</a>
                <a class="collapse-item <?= $active_nav == 'releasepacking' ?'active':'';?>" href="<?= base_url('releasepacking')?>">Release Packing</a>
            </div>
        </div>

        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC4"
        aria-expanded="true" aria-controls="collapseQC4">
        <i class="fas fa-cubes"></i>
        <span>WAREHOUSE</span></a>
        <div id="collapseQC4" class="collapse <?=  $active_nav == 'sanitasiwarehouse' ?'show':'';?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= $active_nav == 'sanitasiwarehouse' ?'active':'';?>" href="<?= base_url('sanitasiwarehouse')?>">Pemeriksaan Sanitasi Warehouse</a>
            </div>
        </div> -->
    </li>
<!-- Batas Form QC -->
<?php endif; ?>

<!-- Verifikasi SPV -->
<!-- VERIFIKASI SPV (hanya tipe_user 0,1,2) -->
<?php if (in_array($tipe_user, [0, 1, 2])): ?>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">VERIFIKASI SUPERVISOR</div>
    <li class="nav-item <?= ($active_nav == 'verifikasi' || $active_nav == 'verifikasi-pengayakan' || $active_nav == 'verifikasi-produksi' || $active_nav == 'verifikasi-metal' || $active_nav == 'verifikasi-falserejection' || $active_nav == 'verifikasi-kontaminasi' || $active_nav == 'verifikasi-kekuatanmagnet' || $active_nav == 'verifikasi-verifikasimagnet' || $active_nav == 'verifikasi-timbangan' || $active_nav == 'verifikasi-releasepacking' || $active_nav == 'verifikasi-pengemasan' || $active_nav == 'verifikasi-sanitasi' || $active_nav == 'verifikasi-ketidaksesuaian' || $active_nav == 'verifikasi-pemusnahan' || $active_nav == 'verifikasi-kondisikerja' || $active_nav == 'verifikasi-retain' || $active_nav == 'verifikasi-kebersihankaryawan' || $active_nav == 'verifikasi-kebersihanperalatan' || $active_nav == 'verifikasi-kebersihanruang' || $active_nav == 'verifikasi-sanitasiwarehouse' || $active_nav == 'verifikasi-disposisi' || $active_nav == 'verifikasi-lada' || $active_nav == 'verifikasi-suhu' ) ? 'active' : ''; ?>">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC21" aria-expanded="true" aria-controls="collapseQC21">
            <i class="fas fa-broom"></i>
            <span>KEBERSIHAN & SUHU</span></a>
            <div id="collapseQC21" class="collapse <?= ( $active_nav == 'verifikasi-suhu' || $active_nav == 'verifikasi-sanitasi' || $active_nav == 'verifikasi-kondisikerja' || $active_nav == 'verifikasi-kebersihankaryawan' || $active_nav == 'verifikasi-kebersihanperalatan' || $active_nav == 'verifikasi-kebersihanruang'  ) ? 'show' : ''; ?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= $active_nav == 'verifikasi-suhu' ? 'active' : ''; ?>" href="<?= base_url('suhu/verifikasi')?>">Pemeriksaan Suhu Ruang</a>
                    <a class="collapse-item <?= $active_nav == 'verifikasi-sanitasi' ? 'active' : ''; ?>" href="<?= base_url('sanitasi/verifikasi')?>">Pemeriksaan Sanitasi</a>
                    <a class="collapse-item <?= $active_nav == 'verifikasi-kondisikerja' ? 'active' : ''; ?>" href="<?= base_url('kondisikerja/verifikasi')?>">Kondisi Kerja Selama Produksi</a>
                    <a class="collapse-item <?= $active_nav == 'verifikasi-kebersihankaryawan' ? 'active' : ''; ?>" href="<?= base_url('kebersihankaryawan/verifikasi')?>">Kebersihan Karyawan</a>
                    <a class="collapse-item <?= $active_nav == 'verifikasi-kebersihanperalatan' ? 'active' : ''; ?>" href="<?= base_url('kebersihanperalatan/verifikasi')?>">Kebersihan Peralatan</a>
                    <a class="collapse-item <?= $active_nav == 'verifikasi-kebersihanruang' ? 'active' : ''; ?>" href="<?= base_url('kebersihanruang/verifikasi')?>">Kebersihan Ruang Produksi</a>
                </div>
            </div>

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC22" aria-expanded="true" aria-controls="collapseQC22">
                <i class="fas fa-database"></i>
                <span>PRODUKSI</span></a>
                <div id="collapseQC22" class="collapse <?= ($active_nav == 'verifikasi-pengayakan' || $active_nav == 'verifikasi-produksi' || $active_nav == 'verifikasi-kekuatanmagnet' || $active_nav == 'verifikasi-verifikasimagnet' || $active_nav == 'verifikasi-timbangan' || $active_nav == 'verifikasi-ketidaksesuaian' || $active_nav == 'verifikasi-lada' || $active_nav == 'verifikasi-disposisi' || $active_nav == 'verifikasi-pemusnahan' || $active_nav == 'verifikasi-retain'  ) ? 'show' : ''; ?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= $active_nav == 'verifikasi-kekuatanmagnet' ? 'active' : ''; ?>" href="<?= base_url('kekuatanmagnet/verifikasi')?>">Pemeriksaan Kekuatan Magnet Trap</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-verifikasimagnet' ? 'active' : ''; ?>" href="<?= base_url('verifikasimagnet/verifikasi')?>">Verifikasi Magnet Trap</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-timbangan' ? 'active' : ''; ?>" href="<?= base_url('timbangan/verifikasi')?>">Pemeriksaan Timbangan</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-ketidaksesuaian' ? 'active' : ''; ?>" href="<?= base_url('ketidaksesuaian/verifikasi')?>">Ketidaksesuaian Produk</a>                        
                        <a class="collapse-item <?= $active_nav == 'verifikasi-pengayakan' ? 'active' : ''; ?>" href="<?= base_url('pengayakan/verifikasi')?>">Pemeriksaan Pengayakan</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-lada' ? 'active' : ''; ?>" href="<?= base_url('lada/verifikasi')?>">Pemeriksaan Giling Lada</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-produksi' ? 'active' : ''; ?>" href="<?= base_url('produksi/verifikasi')?>">Verifikasi Proses Produksi</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-disposisi' ? 'active' : ''; ?>" href="<?= base_url('disposisi/verifikasi')?>">Disposisi Produk dan Prosedur</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-pemusnahan' ? 'active' : ''; ?>" href="<?= base_url('pemusnahan/verifikasi')?>">Pemusnahan Barang / Produk</a>
                        <a class="collapse-item <?= $active_nav == 'verifikasi-retain' ? 'active' : ''; ?>" href="<?= base_url('retain/verifikasi')?>">Retain Sample Report</a>
                    </div>
                </div>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC23" aria-expanded="true" aria-controls="collapseQC23">
                    <i class="fas fa-cube"></i>
                    <span>PACKING</span></a>
                    <div id="collapseQC23" class="collapse <?= ( $active_nav == 'verifikasi-metal' || $active_nav == 'verifikasi-falserejection' || $active_nav == 'verifikasi-kontaminasi' || $active_nav == 'verifikasi-releasepacking' || $active_nav == 'verifikasi-pengemasan' ) ? 'show' : ''; ?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= $active_nav == 'verifikasi-metal' ? 'active' : ''; ?>" href="<?= base_url('metal/verifikasi')?>">Pemeriksaan Metal Detector</a>
                            <!-- <a class="collapse-item <?= $active_nav == 'verifikasi-falserejection' ? 'active' : ''; ?>" href="<?= base_url('falserejection/verifikasi')?>">Monitoring False Rejection</a> -->
                            <a class="collapse-item <?= $active_nav == 'verifikasi-kontaminasi' ? 'active' : ''; ?>" href="<?= base_url('kontaminasi/verifikasi')?>">Kontaminasi Benda Asing</a>
                            <a class="collapse-item <?= $active_nav == 'verifikasi-pengemasan' ? 'active' : ''; ?>" href="<?= base_url('pengemasan/verifikasi')?>">Pemeriksaan Proses Pengemasan</a>
                            <a class="collapse-item <?= $active_nav == 'verifikasi-releasepacking' ? 'active' : ''; ?>" href="<?= base_url('releasepacking/verifikasi')?>">Release Packing</a>
                        </div>
                    </div>

                    <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseQC24" aria-expanded="true" aria-controls="collapseQC24">
                        <i class="fas fa-cubes"></i>
                        <span>WAREHOUSE</span></a>
                        <div id="collapseQC24" class="collapse <?= ( $active_nav == 'verifikasi-sanitasiwarehouse') ? 'show' : ''; ?>" aria-labelledby="headingQC" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item <?= $active_nav == 'verifikasi-sanitasiwarehouse' ? 'active' : ''; ?>" href="<?= base_url('sanitasiwarehouse/verifikasi')?>">Pemeriksaan Sanitasi Warehouse</a>
                            </div>
                        </div> -->
                    </li>
                <?php endif; ?>

                <hr class="sidebar-divider">
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>
            <!-- Batas SPV -->

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Nama Perusahaan -->
                    <div class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 nama-pt">
                        <strong>PT. CHAROEN POKPHAND INDONESIA - FOOD DIVISION</strong>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <?php
                        $foto = $this->session->userdata('foto') ?? 'profil.png';
                        $foto_url = base_url('uploads/foto/' . $foto);
                        ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Nama User -->
                                <span class="mr-2 d-none d-lg-inline text-dark small font-weight-bold">
                                    Hallo, <?= $this->session->userdata('nama'); ?>
                                </span>
                                <!-- Foto Profil -->
                                <img class="img-profile rounded-circle" 
                                src="<?= $foto_url ?>" 
                                width="40" height="40" 
                                onerror="this.onerror=null;this.src='<?= base_url('uploads/foto/profil.png') ?>';" 
                                alt="Foto Profil">
                            </a>

                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                               <!--  <a class="dropdown-item" href="<?= base_url('profil'); ?>">
                                    <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-primary"></i> 
                                    <span class="text-dark">Profil</span>
                                </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="<?= base_url('logout'); ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                    <span class="text-dark">Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>


                <style type="text/css">
                    #wrapper {
                        background-color: #2E86C1;
                    }
                    .mr-2 {
                        font-size: 18px;
                        font-weight: bold;
                    } 
                    .navbar .dropdown-menu .dropdown-item:hover {
                        background-color: #f8f9fc;
                        color: #4e73df;
                        font-weight: 500;
                    }

                    .navbar .fa-user-circle {
                        transition: transform 0.3s ease;
                    }

                    .navbar .fa-user-circle:hover {
                        transform: scale(1.1);
                        color: #4e73df;
                    }

                    .dropdown-menu .dropdown-item i {
                        width: 20px;
                        text-align: center;
                    }

                </style>
