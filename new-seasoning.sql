-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2025 at 11:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new-seasoning`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `uuid`, `user_uuid`, `departemen`, `created_at`, `modified_at`) VALUES
(1, '66c8b282-9c49-40d3-85a0-257edc2160b6', '000', 'Quality Control', '2024-02-28 09:48:40', '2025-09-09 14:51:38'),
(2, '73e68eee-2615-4557-9e1a-6b6371c35ccd', '000', 'Engineering', '2024-02-28 09:48:46', '2024-02-28 09:48:46'),
(3, 'e2c64036-b3c0-4121-b0bf-48910cf2cd98', '000', 'Finance', '2024-02-28 09:48:53', '2024-02-28 09:48:53'),
(4, 'ee68310c-ea16-4a7b-bde7-d38fe5c4c47d', '000', 'PGA', '2024-02-28 09:49:02', '2024-02-28 09:49:02'),
(5, 'c6d788ee-9bc4-4441-9722-5127eb3111d8', '000', 'PPIC', '2024-02-28 09:49:06', '2024-02-28 09:49:06'),
(6, '3622efc5-b2f8-4370-acb0-4833617fa0af', '000', 'Produksi', '2024-02-28 09:49:17', '2024-02-28 09:49:17'),
(7, 'a69f6469-8389-4d8b-806f-b6d5d4591560', '000', 'Warehouse', '2024-02-28 09:49:22', '2024-02-28 09:49:22'),
(9, '9e8419c2-7b20-4ba2-bed6-d94c8c9bd68b', 'admin', 'Premix', '2025-09-03 11:54:19', '2025-09-03 11:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `disposisi` varchar(255) NOT NULL,
  `dasar_disposisi` longtext NOT NULL,
  `uraian_disposisi` longtext NOT NULL,
  `catatan` longtext NOT NULL,
  `cc` varchar(255) NOT NULL,
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_mg_qc` varchar(255) NOT NULL,
  `status_mg_qc` varchar(255) NOT NULL,
  `catatan_mg_qc` varchar(255) NOT NULL,
  `tgl_update_mg_qc` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_mg_prod` varchar(255) NOT NULL,
  `status_mg_prod` varchar(255) NOT NULL,
  `catatan_mg_prod` varchar(255) NOT NULL,
  `tgl_update_mg_prod` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id`, `uuid`, `username`, `plant`, `date`, `nomor`, `kepada`, `disposisi`, `dasar_disposisi`, `uraian_disposisi`, `catatan`, `cc`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `nama_produksi`, `status_produksi`, `catatan_produksi`, `tgl_update_produksi`, `nama_mg_qc`, `status_mg_qc`, `catatan_mg_qc`, `tgl_update_mg_qc`, `nama_mg_prod`, `status_mg_prod`, `catatan_mg_prod`, `tgl_update_mg_prod`, `created_at`, `modified_at`) VALUES
(3, '295fc9bf-c9bd-4824-9a7a-7f0b775cb9c8', 'admin', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-08', '43', 'putri harnis', 'Produk', 'ddddddddd', 'sssssssssssssss', 'aaaaaaaaaaaaaaa', 'aassssssssss', 'admin', '1', '', '2025-07-08 15:24:26', 'admin', '1', '', '2025-07-08 15:24:21', '', '', '', '2025-07-08 15:24:02', '', '', '', '2025-07-08 15:24:02', '2025-07-08 15:24:02', '2025-07-08 15:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `kebersihan_karyawan`
--

CREATE TABLE `kebersihan_karyawan` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bagian` varchar(255) NOT NULL,
  `seragam` varchar(255) NOT NULL,
  `apron` varchar(255) NOT NULL,
  `tangan_kuku` varchar(255) NOT NULL,
  `kosmetik` varchar(255) NOT NULL,
  `perhiasan` varchar(255) NOT NULL,
  `masker` varchar(255) NOT NULL,
  `topi_hairnet` varchar(255) NOT NULL,
  `sepatu` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kebersihan_karyawan`
--

INSERT INTO `kebersihan_karyawan` (`id`, `uuid`, `username`, `plant`, `date`, `shift`, `nama`, `bagian`, `seragam`, `apron`, `tangan_kuku`, `kosmetik`, `perhiasan`, `masker`, `topi_hairnet`, `sepatu`, `tindakan`, `catatan`, `nama_produksi`, `status_produksi`, `catatan_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(5, '2213573d-345e-436e-9d75-0ba54d6fd4d9', 'qc_ckd', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-07', '1', 'Yuli', 'Packing', 'tidak oke', 'tidak dipakai', 'tidak oke', 'ok', 'ok', 'ok', 'ok', 'ok', '1. Seragam sobek diganti \r\n2. Kuku panjang dipotong ', '', '', '0', '', '2025-07-07 14:14:23', '', '0', '', '2025-07-07 14:14:23', '2025-07-07 14:14:23', '2025-07-07 14:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `kebersihan_peralatan`
--

CREATE TABLE `kebersihan_peralatan` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `peralatan` longtext NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kebersihan_ruang`
--

CREATE TABLE `kebersihan_ruang` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) NOT NULL,
  `bagian` varchar(255) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` varchar(255) NOT NULL,
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `detail` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kekuatan_mt`
--

CREATE TABLE `kekuatan_mt` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `nama_alat` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kekuatan_mt`
--

INSERT INTO `kekuatan_mt` (`id`, `uuid`, `username`, `plant`, `date`, `nama_alat`, `nilai`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `catatan_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(5, 'a086cbc0-c70c-4e44-943a-3faa10fee92e', 'admin', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-08', 'Magnet', '0.5', 'www', 'www', 'admin', '1', '', '2025-07-08 15:20:13', 'admin', '1', '', '2025-07-08 15:20:03', '2025-07-08 15:19:21', '2025-07-08 15:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `ketidaksesuaian`
--

CREATE TABLE `ketidaksesuaian` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `ketidaksesuaian` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `penyebab` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `verifikasi` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_kerja`
--

CREATE TABLE `kondisi_kerja` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `kondisi_higiene` varchar(255) NOT NULL,
  `problem_higiene` varchar(255) NOT NULL,
  `tindakan_higiene` varchar(255) NOT NULL,
  `verifikasi_higiene` varchar(255) NOT NULL,
  `kondisi_kebersihan` varchar(255) NOT NULL,
  `problem_kebersihan` varchar(255) NOT NULL,
  `tindakan_kebersihan` varchar(255) NOT NULL,
  `verifikasi_kebersihan` varchar(255) NOT NULL,
  `kondisi_peralatan` varchar(255) NOT NULL,
  `problem_peralatan` varchar(255) NOT NULL,
  `tindakan_peralatan` varchar(255) NOT NULL,
  `verifikasi_peralatan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kondisi_kerja`
--

INSERT INTO `kondisi_kerja` (`id`, `uuid`, `username`, `plant`, `date`, `shift`, `area`, `waktu`, `kondisi_higiene`, `problem_higiene`, `tindakan_higiene`, `verifikasi_higiene`, `kondisi_kebersihan`, `problem_kebersihan`, `tindakan_kebersihan`, `verifikasi_kebersihan`, `kondisi_peralatan`, `problem_peralatan`, `tindakan_peralatan`, `verifikasi_peralatan`, `catatan`, `nama_produksi`, `status_produksi`, `catatan_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(9, '5b956caf-188a-4362-ae05-62256568880b', 'qc_ckd', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-07', '1', 'Produksi', '08:03:00', '7', 'Tidak menggunakan ciput dengan benar', 'Koordinasi dengan karyawan bersangkutan untun menggunakan ciput dengan benar', 'Karyawan sudah menggunakan ciput dengan benar', '2', 'Terdapat genang air pada lantai ruang Proofing ', 'Koordinasi dengan tim sanitasi dan produksi untuk mengeringkan lantai sebelum digunakan untuk proses produksi', 'Lantai proofing sudah kering', '✓', '', '', '', '', '', '0', '', '2025-07-07 14:09:53', '', '0', '', '2025-07-07 14:09:53', '2025-07-07 14:09:53', '2025-07-07 14:09:53');

-- --------------------------------------------------------

--
-- Table structure for table `kontaminasi`
--

CREATE TABLE `kontaminasi` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `jenis_kontaminasi` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `jumlah_temuan` int(11) NOT NULL,
  `tahapan` varchar(255) NOT NULL,
  `analisis` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lada`
--

CREATE TABLE `lada` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `suhu_produk` varchar(255) NOT NULL,
  `hasil_giling` varchar(255) NOT NULL,
  `kadar_air` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metal`
--

CREATE TABLE `metal` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username_1` varchar(255) NOT NULL,
  `username_2` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date_metal` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `no_program` varchar(255) NOT NULL,
  `deteksi_ng` varchar(255) NOT NULL,
  `std_fe` varchar(255) NOT NULL,
  `std_nonfe` varchar(255) NOT NULL,
  `std_sus316` varchar(255) NOT NULL,
  `fe_d` varchar(255) NOT NULL,
  `fe_t` varchar(255) NOT NULL,
  `fe_b` varchar(255) NOT NULL,
  `nonfe_d` varchar(255) NOT NULL,
  `nonfe_t` varchar(255) NOT NULL,
  `nonfe_b` varchar(255) NOT NULL,
  `sus_d` varchar(255) NOT NULL,
  `sus_t` varchar(255) NOT NULL,
  `sus_b` varchar(255) NOT NULL,
  `update_time_t` time NOT NULL,
  `update_time_b` time NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan_metal` varchar(255) NOT NULL,
  `nama_produksi_metal` varchar(255) NOT NULL,
  `no_mesin` varchar(255) NOT NULL,
  `date_false_rejection` date NOT NULL,
  `shift_monitoring` varchar(255) NOT NULL,
  `jumlah_tidak_lolos` varchar(255) NOT NULL,
  `jumlah_kontaminasi` varchar(255) NOT NULL,
  `jenis_kontaminasi` varchar(255) NOT NULL,
  `posisi_kontaminasi` varchar(255) NOT NULL,
  `false_rejection` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi_false` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `status_produksi_false` varchar(255) NOT NULL,
  `catatan_produksi_false` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `status_spv_false` varchar(255) NOT NULL,
  `catatan_spv_false` varchar(255) NOT NULL,
  `tgl_update_spv_metal` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update_produksi_metal` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update_spv_false` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update_produksi_false` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv_metal` varchar(255) NOT NULL,
  `nama_spv_false` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at_false` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mixing`
--

CREATE TABLE `mixing` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `raw_mat` longtext DEFAULT NULL,
  `premix` longtext NOT NULL,
  `hasil_mixing` varchar(255) NOT NULL,
  `waktu_mixing_premix` varchar(255) NOT NULL,
  `sens_rasa` varchar(255) NOT NULL,
  `sens_aroma` varchar(255) NOT NULL,
  `sens_tekstur` varchar(255) NOT NULL,
  `sens_warna` varchar(255) NOT NULL,
  `date_packing` date NOT NULL,
  `shift_packing` varchar(255) NOT NULL,
  `pukul_packing` time NOT NULL,
  `exp_date` date NOT NULL,
  `kondisi_produk` varchar(255) NOT NULL,
  `kondisi_seal` varchar(255) NOT NULL,
  `jenis_packing` varchar(255) NOT NULL,
  `berat` float NOT NULL,
  `berat_kotor_karton` float NOT NULL,
  `labelisasi_karton` varchar(255) DEFAULT NULL,
  `kondisi_seal_karton` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `nama_spv` varchar(255) NOT NULL,
  `tgl_update` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update_prod` datetime NOT NULL DEFAULT current_timestamp(),
  `catatan_spv` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mixing`
--

INSERT INTO `mixing` (`id`, `uuid`, `username`, `plant`, `date`, `shift`, `nama_produk`, `kode_produksi`, `raw_mat`, `premix`, `hasil_mixing`, `waktu_mixing_premix`, `sens_rasa`, `sens_aroma`, `sens_tekstur`, `sens_warna`, `date_packing`, `shift_packing`, `pukul_packing`, `exp_date`, `kondisi_produk`, `kondisi_seal`, `jenis_packing`, `berat`, `berat_kotor_karton`, `labelisasi_karton`, `kondisi_seal_karton`, `nama_produksi`, `catatan_produksi`, `status_produksi`, `catatan`, `status_spv`, `nama_spv`, `tgl_update`, `tgl_update_prod`, `catatan_spv`, `created_at`, `modified_at`) VALUES
(42, '9a3d6b4b-bbc2-4561-b8e8-0007df093b6f', 'admin', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-25', '2', '9017f3c9-96f0-4a78-b148-b2ebecb0f154', 'SRG PH 25 101 AA0', '[{\"nama\":\"TER A (LONCENG)\",\"kode\":\"10 05 2025\",\"berat\":\"61.41\",\"sens\":\"oke\"},{\"nama\":\"MWC B (Battercrips)\",\"kode\":\"10 05 2025\",\"berat\":\"20.47\",\"sens\":\"oke\"},{\"nama\":\"TSN (TAPIOKA)\",\"kode\":\"06 07 2025\",\"berat\":\"3.07\",\"sens\":\"oke\"},{\"nama\":\"COS (CORN STRACH)\",\"kode\":\"10 05 2025\",\"berat\":\"7.164\",\"sens\":\"oke\"},{\"nama\":\"PAO B (Paprika Oil)\",\"kode\":\"10 05 2025\",\"berat\":\"0.105\",\"sens\":\"oke\"}]', '[{\"nama\":\"PRORI\",\"kode\":\"OL 12 101 BB0\",\"berat\":\"7.776\",\"sens\":\"oke\"}]', 'Oke', '4', 'oke', 'oke', 'oke', 'oke', '0000-00-00', '', '00:00:00', '0000-00-00', '', '', '', 0, 0, NULL, '', 'Udi Wahyudi', '', '1', '', '0', '', '2025-08-25 11:09:28', '2025-08-25 11:09:28', '', '2025-08-25 11:09:28', '2025-08-25 11:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `departemen` varchar(255) NOT NULL,
  `tipe_user` varchar(255) NOT NULL,
  `activation` tinyint(1) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `updater` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `uuid`, `nama`, `username`, `password`, `email`, `plant`, `departemen`, `tipe_user`, `activation`, `foto`, `updater`, `created_at`, `modified_at`) VALUES
(11, '0bd19b0f-d62c-444f-9862-cd3381dfef80', 'Admin', 'admin', '$2y$10$DWxZDzzIAFhzhQ3nWMPMyuVjbcIj.3BziDdZBjCo6qhMforiRDDpy', 'putri.harnis@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '0', 0, 'foto_1751446086.jpg', 'admin', '2025-06-05 11:05:01', '2025-07-08 15:28:16'),
(26, '0dd49baa-c44a-4898-b9f4-06f936b52e4e', 'Udi Wahyudi', 'foreman_ckd', '$2y$10$w7U9rcFJnxyS9Rku4OOX/eXex3FiTCk1aiZi7xB/.ib07U56D3frO', '', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '3622efc5-b2f8-4370-acb0-4833617fa0af', '3', 0, '', 'admin', '2025-08-04 14:41:06', '2025-08-25 10:13:15'),
(29, '56231898-7ec2-4d8d-bf44-f8a2322c79c4', 'Halla Lambert', 'jebovaruso', '$2y$12$9MozFu6BZaIr.aljDUOzf.aAtURZkrRVo4WJPezXFfsINtsNGg3Ru', 'zamecudino@mailinator.com', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '0', 0, '', '', '2025-09-09 15:22:55', '2025-09-09 15:22:55'),
(32, '97d8fadb-3520-4528-9ebf-a6b5c23bfee6', 'PUTRI HARNIS', 'putri', '$2y$12$vA58m0QkxmNK3YMwFPoEDOFIlfIUxZxIn68/JeieyH3J3lOFKXeoq', 'formqcplant2@gmail.com', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '0', 1, '', '', '2025-09-11 09:12:13', '2025-09-11 09:12:13'),
(33, '9accb24f-4335-4d72-9847-e07ab89c6dca', 'Farah Melia Nugraheni', 'farah.melia', '$2y$12$dufTibLrxHrmIIT/70/MhOAaf9cGG3xZEjsfDAU8U1Pke/30tVXne', 'farah.nugraheni@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '0', 1, '', '', '2025-09-11 14:13:58', '2025-09-11 14:13:58'),
(34, 'f7908b09-7636-4535-8549-22a07c168da8', 'Muhammad Naufal Arisyi', 'naufal.arisyi', '$2y$12$vGrRvLGl9QVkB2.tEXP1Y.Rl7dw2DrKpQBUKX5ONOBdA7gOgTokXe', 'muhammad.arisyi@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '0', 1, '', '', '2025-09-11 14:34:52', '2025-09-11 14:34:52'),
(35, '4134ef54-b21e-49d6-bdbb-793bd30ac4d5', 'Muh Fani Sirojul Munir', 'fani.sirojul', '$2y$12$jtIiV/TH.iJ4n1wyoZneK.C/vBTUKkyH/vhpiK533kTAPgZLhfyfi', 'fani.munir@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '0', 1, '', '', '2025-09-11 14:35:56', '2025-09-11 14:35:56'),
(36, '22cca6a1-220e-4512-bf92-9c414a2bfd1e', 'Yonada Khairunnisa', 'yonada.khairunnisa', '$2y$12$uZydZkRStlxs/tayqo4d8.rSh/e2m4Jxv0a4WacgnIIOQbzws4ozO', 'yonada.khairunnisa@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '2', 1, '', '', '2025-09-11 15:11:45', '2025-09-11 15:11:45'),
(38, '2d8b2c4c-3274-45e5-b1a0-1c027ff60120', 'Feri Agus Setiawan', 'feri.agus', '$2y$12$mkW/0VUxccNbhW7vvlNJ4evG2/eyDQxt9bouCrXI1viE24mRZaQaK', 'feri.agus@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '8', 1, '', '', '2025-09-11 15:27:17', '2025-09-11 15:27:17'),
(39, 'ce14fbb7-92a1-4acc-b836-cf370ef4e66c', 'Arif Sholikin', 'arif.sholikin', '$2y$12$x1.p31BNYbmc9HcMyZOu/ekdZT3pV0/mVOhZKpQSTpLAqPCrsyfba', 'arif.sholikin@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '8', 1, '', '', '2025-09-11 15:32:14', '2025-09-11 15:32:14'),
(40, 'c932edf5-c839-4c40-ae94-9f4275c74ac8', 'Hermawan Istiyanto', 'hermawan.istiyanto', '$2y$12$ffpoHbTBI.tszjNJ1lB35.axdn.hTZBUfdkPNFrV7moOyQstIwgn6', 'hermawan.istiyanto@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '4', 1, '', '', '2025-09-11 15:36:11', '2025-09-11 15:36:11'),
(41, 'd9b3d03f-0968-4c78-a351-6b9ca6e2b8d0', 'Purkoni', 'purkoni', '$2y$12$k7ZEuIObFzvYoHtitLZcOOeBBe94DN/rWPI/zjqYENnfAU20UC./G', 'purkoni@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '4', 1, '', '', '2025-09-11 15:37:04', '2025-09-11 15:37:04'),
(42, '4afafdb1-5a74-47c9-89d8-26cb1019bc3a', 'Widia Astuti', 'widia.astuti', '$2y$12$R2.sVp1WurzeOi/UNdcvOO3k9HTreR28Lqz31FfESX7r.w4BHWLbG', 'widia.astuti@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '4', 1, '', '', '2025-09-11 15:41:27', '2025-09-11 15:41:27'),
(43, 'de301927-7f68-4528-be63-0a915b2a082b', 'Tegar Mega Pratama', 'tegar.mega', '$2y$12$LofbMjJ7NPR.H2Eg5b8e4e2uiZT.B1tMD/HQHk7Hlueys5679ERU6', 'tegarmegapratamacrs@gmail.com', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '4', 1, '', '', '2025-09-11 15:52:25', '2025-09-11 15:52:25'),
(44, '8b8e1d0a-c748-429a-873e-b8abdaf4a3fe', 'Nurchanifa', 'nurchanifa', '$2y$12$roMxSjDMhjkONjwPOoEoluOkAD.5u4/G3nVVKWZpG4hZr/aLkcf0e', 'nurchanifa27@gmail.com', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '4', 1, '', '', '2025-09-11 15:55:34', '2025-09-11 15:55:34'),
(45, '46d84839-aaa4-4c98-82f6-c61ed55d1b72', 'Anifta Leli Nur Zahufi', 'anifta.leli', '$2y$12$V0s3qIlZCc790zE6EP7r7OWkvSmtDXhyGbTtUGACmIbsM.CYUSF.q', 'aniftalely@gmail.com', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '4', 1, '', '', '2025-09-11 15:58:15', '2025-09-11 15:58:15'),
(46, '5912f679-0a57-4704-a3c8-f5e49b1e073e', 'Firda Aulia Nuraini', 'firda.aulia', '$2y$12$2mkJMvuDvkreO.fGLhH0OeQ9r.2viIQjeJ6iXUoU5bj90ZSwdj3Ny', 'firda.nuraini@cp.co.id', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '66c8b282-9c49-40d3-85a0-257edc2160b6', '0', 1, '', '', '2025-09-11 16:02:01', '2025-09-11 16:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahan`
--

CREATE TABLE `pemusnahan` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `best_before` varchar(255) NOT NULL,
  `analisa` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL,
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengayakan`
--

CREATE TABLE `pengayakan` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `kba_screenmess` int(11) NOT NULL,
  `kba_kerikil` int(11) NOT NULL,
  `kba_benang` int(11) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `nama_spv` varchar(255) NOT NULL,
  `tgl_update` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_update_prod` datetime NOT NULL DEFAULT current_timestamp(),
  `catatan_spv` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengayakan`
--

INSERT INTO `pengayakan` (`id`, `uuid`, `username`, `plant`, `date`, `shift`, `nama_barang`, `kode_produksi`, `expired_date`, `jumlah_barang`, `kba_screenmess`, `kba_kerikil`, `kba_benang`, `nama_produksi`, `catatan_produksi`, `status_produksi`, `kondisi`, `catatan`, `status_spv`, `nama_spv`, `tgl_update`, `tgl_update_prod`, `catatan_spv`, `created_at`, `modified_at`) VALUES
(17, 'e3fe18bc-43b4-4f48-9534-b13e18453220', 'admin', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-09-03', '1', 'A', 'A', '2026-09-03', 1, 0, 0, 0, 'Udi Wahyudi', '', '1', 'Baik', '-', '1', 'admin', '2025-09-03 11:49:52', '2025-09-03 11:48:24', '', '2025-09-03 11:48:24', '2025-09-03 11:48:55'),
(18, 'a9d32693-a357-4183-bfcb-5ebdbbcc2587', 'admin', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-09-03', '1', 'B', 'B', '2026-09-03', 2, 12, 12, 12, 'Udi Wahyudi', '', '1', 'Baik', 'Baik', '1', 'admin', '2025-09-03 11:52:57', '2025-09-03 11:51:54', '', '2025-09-03 11:51:54', '2025-09-03 11:51:54'),
(19, '04952fb7-ff91-4847-a64c-22db94ff5597', 'admin', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-09-03', '1', 'C', 'C', '2026-09-03', 3, 13, 13, 13, 'Udi Wahyudi', '', '1', 'Baik', 'Baik', '1', 'admin', '2025-09-03 11:52:51', '2025-09-03 11:52:14', '', '2025-09-03 11:52:14', '2025-09-03 11:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `pengemasan`
--

CREATE TABLE `pengemasan` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `best_before` date NOT NULL,
  `kondisi_produk` varchar(255) NOT NULL,
  `kondisi_seal` varchar(255) NOT NULL,
  `berat_pack` varchar(255) NOT NULL,
  `berat_renceng` varchar(255) NOT NULL,
  `berat_inner` varchar(255) NOT NULL,
  `berat_binded` varchar(255) NOT NULL,
  `berat_carton` varchar(255) NOT NULL,
  `labelisasi` varchar(255) NOT NULL,
  `kondisi_karton` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peralatan`
--

CREATE TABLE `peralatan` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `peralatan` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peralatan`
--

INSERT INTO `peralatan` (`id`, `uuid`, `username`, `peralatan`, `plant`, `created_at`, `modified_at`) VALUES
(5, '71bab01d-b108-435e-8491-35f3ee406f44', 'admin', 'Vacuum Cleaner', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:25:56', '2025-08-01 14:47:00'),
(6, 'fb923a1e-43a7-4214-a26f-049abe419921', 'admin', 'Sekop Stainless', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:26:04', '2025-08-01 14:46:47'),
(7, 'a4d1b85d-2b24-4ec8-9d0e-25a82b941c77', 'admin', 'Palet', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:26:25', '2025-08-01 14:46:37'),
(8, 'ea353a1e-6e49-4e32-a278-a83e15e50f7c', 'admin', 'Box Tepung', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:26:34', '2025-08-01 14:46:31'),
(9, 'ce18cf22-421b-48fa-b095-28e4cab06cfb', 'admin', 'Ember Ayakan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:26:45', '2025-08-01 14:46:22'),
(10, '0b5e21c3-eb58-4106-9776-c6aae63e49c4', 'admin', 'Serokan Tepung', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:26:55', '2025-08-01 14:46:11'),
(11, '403dd932-b402-4f10-9f56-08f4dc6f222c', 'admin', 'Pisau', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:27:09', '2025-08-01 14:46:01'),
(12, 'e97412f2-ce68-41d7-ac98-842f9756d52a', 'admin', 'Timbangan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-07-21 14:27:16', '2025-08-01 14:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `plant`
--

CREATE TABLE `plant` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `user_uuid` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plant`
--

INSERT INTO `plant` (`id`, `uuid`, `user_uuid`, `plant`, `created_at`, `modified_at`) VALUES
(5, '651ac623-5e48-44cc-b2f6-5d622603f53c', 'harnis', 'CPI Cikande', '2024-11-13 15:34:48', '2025-07-30 09:44:21'),
(9, '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', 'admin', 'Cikande 2', '2025-07-08 15:27:32', '2025-07-08 15:27:32'),
(11, '764da0f1-cdbe-47a2-bf3d-94f7125b64e6', 'admin', 'CPI Cikande 1', '2025-09-03 11:54:38', '2025-09-03 11:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `uuid`, `username`, `nama_produk`, `plant`, `modified_at`, `created_at`) VALUES
(1, 'e40a95e6-b17a-4d4f-9368-add8b94e1a34', 'admin', 'Chicken Seasoning', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:10:48', '2025-08-22 16:09:09'),
(2, '1ad74b8a-eac1-4abc-bae4-3d2606de4c7e', 'admin', 'Racik Ayam Goreng', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:23:46', '2025-08-22 16:23:46'),
(3, '98d51d02-cb19-41c9-a491-9e434020910b', 'admin', 'Racik Nasi Goreng', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:23:59', '2025-08-22 16:23:59'),
(4, '9504be1e-38dd-4357-821d-781acd45a009', 'admin', 'HSC Marinated', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:24:14', '2025-08-22 16:24:14'),
(5, '8e660b40-4037-4886-ab17-9e3ea5d352e8', 'admin', 'KURU Chick BBQ', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:24:48', '2025-08-22 16:24:48'),
(6, '31c22bda-a89f-489e-81a8-61a0be9d414b', 'admin', 'KURU Chick Seaweed BBQ', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:25:00', '2025-08-22 16:25:00'),
(7, '469a58e4-7fc9-4500-8f20-2c8ffac02b72', 'admin', 'KURU Chick Spicy', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:25:20', '2025-08-22 16:25:13'),
(8, 'b6ca26d0-86b1-4500-bff4-50ab4d1736e8', 'admin', 'Bumbu Powder Ayam Bawang', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:25:39', '2025-08-22 16:25:39'),
(9, '35a16891-64a5-4116-9163-60d34311523c', 'admin', 'Bumbu Powder Baso Ayam Spesial', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:25:54', '2025-08-22 16:25:54'),
(10, '72ae8c1e-8b17-4777-9592-952248e0457c', 'admin', 'Hot Fried Chicken', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:32:26', '2025-08-22 16:32:26'),
(11, '073777a8-6e55-4aed-853a-ed0e9e1dce5d', 'admin', 'Fried Chicken', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:32:35', '2025-08-22 16:32:35'),
(12, '3988487b-2949-454d-80c6-708d11dd7e65', 'admin', 'Bakwan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:32:45', '2025-08-22 16:32:45'),
(13, 'ceb2dfcc-cfe0-4997-80a4-2e2aa154a789', 'admin', 'Tempe Renyah', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:32:55', '2025-08-22 16:32:55'),
(14, 'd680aa1e-493c-479a-b011-6089709a5d69', 'admin', 'Serbaguna', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:33:03', '2025-08-22 16:33:03'),
(15, 'f2e7815b-8cbf-449a-b8af-7fb762ae0d9d', 'admin', 'Ayam Kremes', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:33:12', '2025-08-22 16:33:12'),
(16, 'a1805b22-7d3a-4d69-8699-535b3208e5cc', 'admin', 'CPI HSC Breader Japan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:33:40', '2025-08-22 16:33:40'),
(17, 'e1999cb2-0302-4aca-acfc-d562745449e7', 'admin', 'CPI BM37 Japan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:33:51', '2025-08-22 16:33:51'),
(18, '16e31729-93e1-432f-9329-1d5befbda89d', 'admin', 'CPI BM38 Japan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:34:03', '2025-08-22 16:34:03'),
(19, '4cbb0c35-5691-40c9-8bda-f73a54092001', 'admin', 'CPI Battermix Japan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:34:14', '2025-08-22 16:34:14'),
(20, 'a7cc7527-bf60-4c26-81d6-b64230fdb99b', 'admin', 'CPI BM 1329 Japan', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:34:30', '2025-08-22 16:34:30'),
(21, '84e96055-967f-4d38-9787-ab719d31a438', 'admin', 'Yang Ayam Fried Chicken', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:34:53', '2025-08-22 16:34:53'),
(22, 'a163bd72-e14d-42e1-856c-9396c9d665d8', 'admin', 'PFM Batter Breader New', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:35:04', '2025-08-22 16:35:04'),
(23, 'b98e5b61-e989-4c6e-b5dd-cb1fe09feb90', 'admin', 'Breader Spicy Jepang', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:35:13', '2025-08-22 16:35:13'),
(24, '9017f3c9-96f0-4a78-b148-b2ebecb0f154', 'admin', 'Breader Original Jepang', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:35:26', '2025-08-22 16:35:26'),
(25, 'cb04c85a-30d7-48d2-a427-7f1a32f8bddd', 'admin', 'BM 1329 Delistripe', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:35:47', '2025-08-22 16:35:47'),
(26, '5d2a3721-7807-414f-92f8-ffc9d2711dc7', 'admin', 'CPI Sajiku', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:35:53', '2025-08-22 16:35:53'),
(27, '2698f725-2642-4ffd-99a2-474d1d452f20', 'admin', 'Crispy Breader', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:36:00', '2025-08-22 16:36:00'),
(28, 'e2e81ad5-fb79-4f7a-aad4-1b3a3eb96c06', 'admin', 'FP HSC Breader', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:36:14', '2025-08-22 16:36:14'),
(29, '7af6cb30-7b7b-4bb8-9d70-4270989aa58e', 'admin', 'FP FDT1 Breader', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:36:26', '2025-08-22 16:36:26'),
(30, '04e8c09b-807d-413c-828e-44fe35f60ad7', 'admin', 'FP BM37', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:36:35', '2025-08-22 16:36:35'),
(31, 'c13e42fb-53e4-47b0-bc1c-4753ea3e137d', 'admin', 'FP BM38', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:36:43', '2025-08-22 16:36:43'),
(32, 'e23c3bd7-58c7-4adb-8863-6090a084921f', 'admin', 'Battermix', '2dadf061-fb44-4998-bcb2-1d6f6cb8f972', '2025-08-22 16:36:49', '2025-08-22 16:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `release_packing`
--

CREATE TABLE `release_packing` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `best_before` date NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `release_packing`
--

INSERT INTO `release_packing` (`id`, `uuid`, `username`, `plant`, `date`, `nama_produk`, `kode_produksi`, `best_before`, `jumlah`, `keterangan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(3, '2d11ce5a-55df-4b3f-b8b5-dd665f355171', 'admin', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-08', 'BC MIX', 'PF 23 101 BB0', '2025-07-08', '1', 'eee', 'admin', '1', '', '2025-07-08 15:23:17', '2025-07-08 15:23:06', '2025-07-08 15:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `retain`
--

CREATE TABLE `retain` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `sample_type` varchar(255) NOT NULL,
  `sample_storage` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `best_before` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanitasi`
--

CREATE TABLE `sanitasi` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `std_handbasin` varchar(255) NOT NULL,
  `hand_basin` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `area` longtext DEFAULT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanitasi`
--

INSERT INTO `sanitasi` (`id`, `uuid`, `username`, `plant`, `date`, `shift`, `waktu`, `std_handbasin`, `hand_basin`, `keterangan`, `area`, `catatan`, `nama_produksi`, `status_produksi`, `catatan_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(7, 'cd45ea04-d42b-4717-bb57-9c8aa0966c81', 'admin', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-08', '1', '15:02:00', '', '', '', '[{\"sub_area\":\"Foot Basin\",\"standar\":\"200\",\"aktual\":\"200\",\"keterangan\":\"oke\",\"gambar\":\"gambar_1751961740_0.jpg\"},{\"sub_area\":\"Hand Basin\",\"standar\":\"50\",\"aktual\":\"50\",\"keterangan\":\"gass\",\"gambar\":\"gambar_1751961876_1.jpeg\"}]', '', 'admin', '1', '', '2025-07-08 15:06:34', 'admin', '1', '', '2025-07-08 15:06:55', '2025-07-08 15:02:20', '2025-07-08 15:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `sanitasi_wh`
--

CREATE TABLE `sanitasi_wh` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `area` varchar(255) NOT NULL,
  `detail` longtext DEFAULT NULL,
  `nama_wh` varchar(255) NOT NULL,
  `status_wh` varchar(255) NOT NULL,
  `catatan_wh` varchar(255) NOT NULL,
  `tgl_update_wh` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanitasi_wh`
--

INSERT INTO `sanitasi_wh` (`id`, `uuid`, `username`, `plant`, `date`, `area`, `detail`, `nama_wh`, `status_wh`, `catatan_wh`, `tgl_update_wh`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(6, 'd8bd677e-a90d-4a6a-bfff-f86c4d7c08c2', 'admin', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-15', 'RM', '[{\"bagian\":\"Kondisi Produk\",\"kondisi\":\"bersih\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Penempatan Produk\",\"kondisi\":\"1\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Lantai\",\"kondisi\":\"1\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Pintu\",\"kondisi\":\"1\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Rak\",\"kondisi\":\"bersih\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Palet\",\"kondisi\":\"1\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Langit-langit\",\"kondisi\":\"bersih\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Lampu\",\"kondisi\":\"bersih\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Tirai Plastik\",\"kondisi\":\"bersih\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Dinding\",\"kondisi\":\"1\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Aktivitas Hama\",\"kondisi\":\"1\",\"problem\":\"\",\"tindakan\":\"\"},{\"bagian\":\"Halaman Luar\",\"kondisi\":\"1\",\"problem\":\"\",\"tindakan\":\"\"}]', '', '0', '', '2025-07-15 15:09:13', '', '0', '', '2025-07-15 15:09:13', '2025-07-15 15:09:13', '2025-07-15 15:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `suhu`
--

CREATE TABLE `suhu` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `lokasi` longtext NOT NULL,
  `suhu` varchar(255) NOT NULL,
  `rh` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timbangan`
--

CREATE TABLE `timbangan` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `kode_timbangan` varchar(255) NOT NULL,
  `kapasitas` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `peneraan_standar` varchar(255) NOT NULL,
  `peneraan_hasil` longtext DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timbangan`
--

INSERT INTO `timbangan` (`id`, `uuid`, `username`, `plant`, `date`, `shift`, `kode_timbangan`, `kapasitas`, `model`, `lokasi`, `peneraan_standar`, `peneraan_hasil`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `catatan_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(5, '202dd50c-00fa-4b84-ac3b-4be74e161a42', 'qc_ckd', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-07', '1', '213546', '3 kg', 'jadever', 'area mixing', '1000', '[{\"pukul\":\"07:15\",\"hasil\":\"1002\"}]', '', '', '', '0', '', '2025-07-07 13:36:49', '', '0', '', '2025-07-07 13:36:49', '2025-07-07 13:36:49', '2025-07-07 13:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_mt`
--

CREATE TABLE `verifikasi_mt` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `jumlah_temuan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `nama_produksi` varchar(255) NOT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `catatan_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_spv` varchar(255) NOT NULL,
  `status_spv` varchar(255) NOT NULL,
  `catatan_spv` varchar(255) NOT NULL,
  `tgl_update_spv` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verifikasi_mt`
--

INSERT INTO `verifikasi_mt` (`id`, `uuid`, `username`, `plant`, `date`, `shift`, `nama_produk`, `kode_produksi`, `jumlah_temuan`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `catatan_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `modified_at`) VALUES
(4, '2be7fd38-e897-4976-8b21-abe21ccf1cdd', 'admin', '651ac623-5e48-44cc-b2f6-5d622603f53c', '2025-07-08', '1', 'BC MIX', 'OL 19 101 AA0', '3', 'saaaaa', '', '', '0', '', '2025-07-08 15:21:56', 'admin', '1', '', '2025-07-08 15:22:12', '2025-07-08 15:21:56', '2025-07-08 15:21:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kebersihan_karyawan`
--
ALTER TABLE `kebersihan_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kebersihan_peralatan`
--
ALTER TABLE `kebersihan_peralatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kebersihan_ruang`
--
ALTER TABLE `kebersihan_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kekuatan_mt`
--
ALTER TABLE `kekuatan_mt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ketidaksesuaian`
--
ALTER TABLE `ketidaksesuaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kondisi_kerja`
--
ALTER TABLE `kondisi_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontaminasi`
--
ALTER TABLE `kontaminasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lada`
--
ALTER TABLE `lada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal`
--
ALTER TABLE `metal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mixing`
--
ALTER TABLE `mixing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengayakan`
--
ALTER TABLE `pengayakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengemasan`
--
ALTER TABLE `pengemasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peralatan`
--
ALTER TABLE `peralatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plant`
--
ALTER TABLE `plant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `release_packing`
--
ALTER TABLE `release_packing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retain`
--
ALTER TABLE `retain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanitasi`
--
ALTER TABLE `sanitasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanitasi_wh`
--
ALTER TABLE `sanitasi_wh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suhu`
--
ALTER TABLE `suhu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timbangan`
--
ALTER TABLE `timbangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifikasi_mt`
--
ALTER TABLE `verifikasi_mt`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kebersihan_karyawan`
--
ALTER TABLE `kebersihan_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kebersihan_peralatan`
--
ALTER TABLE `kebersihan_peralatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kebersihan_ruang`
--
ALTER TABLE `kebersihan_ruang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `kekuatan_mt`
--
ALTER TABLE `kekuatan_mt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ketidaksesuaian`
--
ALTER TABLE `ketidaksesuaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kondisi_kerja`
--
ALTER TABLE `kondisi_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kontaminasi`
--
ALTER TABLE `kontaminasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lada`
--
ALTER TABLE `lada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metal`
--
ALTER TABLE `metal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mixing`
--
ALTER TABLE `mixing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengayakan`
--
ALTER TABLE `pengayakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengemasan`
--
ALTER TABLE `pengemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peralatan`
--
ALTER TABLE `peralatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `plant`
--
ALTER TABLE `plant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `release_packing`
--
ALTER TABLE `release_packing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `retain`
--
ALTER TABLE `retain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sanitasi`
--
ALTER TABLE `sanitasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sanitasi_wh`
--
ALTER TABLE `sanitasi_wh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suhu`
--
ALTER TABLE `suhu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `timbangan`
--
ALTER TABLE `timbangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `verifikasi_mt`
--
ALTER TABLE `verifikasi_mt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
