-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 03:09 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrd`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_kategori_absensi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_karyawan`, `id_periode`, `id_kategori_absensi`, `jumlah`, `tanggal`) VALUES
(7, 15, 1, 4, 1, '2021-03-30'),
(8, 15, 1, 6, 3, '2021-03-31'),
(9, 16, 3, 3, 1, '2021-03-31'),
(10, 16, 3, 6, 5, '2021-03-31'),
(11, 17, 4, 5, 1, '2021-04-14'),
(12, 17, 4, 5, 1, '2021-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `kode` varchar(10) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `jenis_cuti` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `status` enum('Approved','Rejected','Pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`kode`, `nik`, `tanggal_awal`, `tanggal_akhir`, `jumlah`, `jenis_cuti`, `ket`, `status`) VALUES
('CT5185', '12132', '2018-06-29', '2018-06-29', '1', 'Cuti Khitan Anak', 'test', 'Approved'),
('CT5628', '10161', '2018-07-06', '2018-07-07', '2', 'Cuti Mendadak', 'test', 'Approved'),
('CT5647', '202020', '2020-12-01', '2020-12-02', '2', 'Cuti Khitan Anak', 'wefre', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id_dept` varchar(10) NOT NULL,
  `nama_dept` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id_dept`, `nama_dept`) VALUES
('DACC', 'Accounting'),
('DCS', 'Customer Service'),
('DENG', 'Enginnering'),
('DHRGA', 'HRGA'),
('DIT', 'IT'),
('DSEC', 'Security');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `bonus` int(11) NOT NULL,
  `lembur_backup` int(11) NOT NULL,
  `lembur_holiday` int(11) NOT NULL,
  `lembur_reguler` int(11) NOT NULL,
  `lembur_lain` int(11) NOT NULL,
  `potongan_sakit` int(11) NOT NULL,
  `potongan_izin` int(11) NOT NULL,
  `potongan_cuti` int(11) NOT NULL,
  `potongan_tk` int(11) NOT NULL,
  `potongan_lain` int(11) NOT NULL,
  `potongan_diksar` int(11) NOT NULL,
  `potongan_sp` int(11) NOT NULL,
  `sebulan` int(11) NOT NULL,
  `setahun` bigint(20) NOT NULL,
  `bruto` bigint(20) NOT NULL,
  `biaya_jabatan` int(11) NOT NULL,
  `neto` bigint(20) NOT NULL,
  `pph` int(11) DEFAULT NULL,
  `thp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `id_karyawan`, `id_periode`, `bonus`, `lembur_backup`, `lembur_holiday`, `lembur_reguler`, `lembur_lain`, `potongan_sakit`, `potongan_izin`, `potongan_cuti`, `potongan_tk`, `potongan_lain`, `potongan_diksar`, `potongan_sp`, `sebulan`, `setahun`, `bruto`, `biaya_jabatan`, `neto`, `pph`, `thp`) VALUES
(4, 15, 1, 90000, 0, 0, 0, 300000, 0, 0, 0, 0, 80000, 100000, 75000, 10408314, 124899768, 124989768, 0, 124989768, 2874488, 10176273),
(5, 16, 3, 0, 0, 851570, 0, 900000, 0, 0, 100000, 0, 400000, 200000, 100000, 6693070, 80316840, 80316840, 4015842, 76300998, 0, 6358417);

-- --------------------------------------------------------

--
-- Table structure for table `insentif`
--

CREATE TABLE `insentif` (
  `id_insentif` int(11) NOT NULL,
  `id_projek` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `cuti` int(11) NOT NULL,
  `tk` int(11) NOT NULL,
  `backup` int(11) NOT NULL,
  `lembur_holiday` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insentif`
--

INSERT INTO `insentif` (`id_insentif`, `id_projek`, `id_role`, `sakit`, `izin`, `cuti`, `tk`, `backup`, `lembur_holiday`) VALUES
(1, 1, 1, 50000, 75000, 50000, 100000, 160000, 156917),
(2, 1, 2, 0, 0, 0, 0, 0, 0),
(3, 1, 3, 0, 0, 0, 0, 0, 0),
(4, 2, 1, 100000, 100000, 100000, 150000, 160000, 156917),
(5, 2, 2, 100000, 100000, 100000, 150000, 160000, 188910),
(6, 2, 3, 0, 0, 0, 0, 0, 0),
(7, 3, 1, 75000, 75000, 75000, 75000, 160000, 157555),
(8, 3, 2, 0, 0, 0, 0, 0, 0),
(9, 3, 3, 0, 0, 0, 0, 0, 0),
(10, 4, 1, 150000, 150000, 75000, 150000, 160000, 163669),
(11, 4, 2, 0, 0, 0, 0, 0, 0),
(12, 4, 3, 0, 0, 0, 0, 0, 0),
(13, 5, 1, 75000, 75000, 75000, 75000, 160000, 165086),
(14, 5, 2, 0, 0, 0, 0, 0, 0),
(15, 5, 3, 0, 0, 0, 0, 0, 0),
(16, 6, 1, 0, 0, 0, 0, 160000, 171514),
(17, 6, 2, 0, 0, 0, 0, 0, 0),
(18, 6, 3, 0, 0, 0, 0, 0, 0),
(19, 7, 1, 150000, 150000, 150000, 150000, 160000, 145804),
(20, 7, 2, 0, 0, 0, 0, 0, 0),
(21, 7, 3, 0, 0, 0, 0, 0, 0),
(22, 8, 1, 150000, 150000, 150000, 150000, 160000, 0),
(23, 8, 2, 0, 0, 0, 0, 0, 0),
(24, 8, 3, 0, 0, 0, 0, 0, 0),
(25, 9, 1, 100000, 100000, 100000, 100000, 160000, 128529),
(26, 9, 2, 0, 0, 0, 0, 0, 0),
(27, 9, 3, 0, 0, 0, 0, 0, 0),
(28, 10, 1, 150000, 150000, 150000, 150000, 160000, 0),
(29, 10, 2, 0, 0, 0, 0, 0, 0),
(30, 10, 3, 0, 0, 0, 0, 0, 0),
(31, 11, 1, 100000, 100000, 100000, 100000, 160000, 170314),
(32, 11, 2, 0, 0, 0, 0, 0, 0),
(33, 11, 3, 0, 0, 0, 0, 0, 0),
(34, 12, 1, 77000, 77000, 77000, 115000, 115000, 116268),
(35, 12, 2, 0, 0, 0, 0, 0, 0),
(36, 12, 3, 77000, 77000, 77000, 115000, 115000, 172712),
(37, 13, 1, 100000, 100000, 100000, 150000, 160000, 145162),
(38, 13, 2, 0, 0, 0, 0, 0, 0),
(39, 13, 3, 0, 0, 0, 0, 0, 0),
(40, 14, 1, 100000, 100000, 100000, 150000, 160000, 145162),
(41, 14, 2, 0, 0, 0, 0, 0, 0),
(42, 14, 3, 0, 0, 0, 0, 0, 0),
(43, 15, 1, 80000, 130000, 80000, 200000, 160000, 291410),
(44, 15, 2, 0, 0, 0, 0, 0, 0),
(45, 15, 3, 0, 0, 0, 0, 0, 0),
(46, 16, 1, 0, 0, 0, 0, 160000, 144852),
(47, 16, 2, 0, 0, 0, 0, 0, 0),
(48, 16, 3, 0, 0, 0, 0, 0, 0),
(49, 17, 1, 100000, 100000, 100000, 100000, 160000, 0),
(50, 17, 2, 0, 0, 0, 0, 0, 0),
(51, 17, 3, 0, 0, 0, 0, 0, 0),
(52, 18, 1, 80000, 100000, 80000, 150000, 160000, 0),
(53, 18, 2, 0, 0, 0, 0, 0, 0),
(54, 18, 3, 0, 0, 0, 0, 0, 0),
(55, 19, 1, 75000, 75000, 75000, 75000, 160000, 165086),
(56, 19, 2, 75000, 75000, 75000, 75000, 160000, 184133),
(57, 19, 3, 0, 0, 0, 0, 0, 0),
(58, 20, 1, 80000, 100000, 80000, 120000, 160000, 167415),
(59, 20, 2, 0, 0, 0, 0, 0, 0),
(60, 20, 3, 0, 0, 0, 0, 0, 0),
(61, 21, 1, 80000, 100000, 100000, 150000, 160000, 157642),
(62, 21, 2, 0, 0, 0, 0, 0, 0),
(63, 21, 3, 0, 0, 0, 0, 0, 0),
(64, 22, 1, 100000, 100000, 100000, 500000, 160000, 172166),
(65, 22, 2, 0, 0, 0, 0, 0, 0),
(66, 22, 3, 0, 0, 0, 0, 0, 0),
(67, 23, 1, 80000, 100000, 80000, 200000, 160000, 143251),
(68, 23, 2, 0, 0, 0, 0, 0, 0),
(69, 23, 3, 0, 0, 0, 0, 0, 0),
(70, 24, 1, 194409, 194409, 194409, 194409, 194409, 125000),
(71, 24, 2, 0, 0, 0, 0, 0, 0),
(72, 24, 3, 0, 0, 0, 0, 0, 0),
(73, 25, 1, 50000, 80000, 50000, 100000, 160000, 167514),
(74, 25, 2, 0, 0, 0, 0, 0, 0),
(75, 25, 3, 0, 0, 0, 0, 0, 0),
(76, 26, 1, 150000, 150000, 150000, 150000, 160000, 128529),
(77, 26, 2, 0, 0, 0, 0, 0, 0),
(78, 26, 3, 0, 0, 0, 0, 0, 0),
(79, 27, 1, 50000, 80000, 50000, 100000, 160000, 167514),
(80, 27, 2, 0, 0, 0, 0, 0, 0),
(81, 27, 3, 0, 0, 0, 0, 0, 0),
(82, 28, 1, 50000, 50000, 50000, 50000, 160000, 160750),
(83, 28, 2, 0, 0, 0, 0, 0, 0),
(84, 28, 3, 0, 0, 0, 0, 0, 0),
(85, 29, 1, 50000, 50000, 50000, 100000, 160000, 160750),
(86, 29, 2, 0, 0, 0, 0, 0, 0),
(87, 29, 3, 0, 0, 0, 0, 0, 0),
(88, 30, 1, 50000, 80000, 50000, 100000, 160000, 150887),
(89, 30, 2, 80000, 100000, 50000, 150000, 160000, 199079),
(90, 30, 3, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(10) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tunjangan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `tunjangan`) VALUES
('JGMGR', 'General Manager', '450000'),
('JLDR', 'Leader', '200000'),
('JMGR', 'Manager', '400000'),
('JSPV', 'Supervisor', '350000'),
('JSTF', 'Staf', '150000');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_cuti`
--

CREATE TABLE `jenis_cuti` (
  `id_cuti` varchar(10) NOT NULL,
  `nama_cuti` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_cuti`
--

INSERT INTO `jenis_cuti` (`id_cuti`, `nama_cuti`) VALUES
('VC3007', 'Cuti Khitan Anak'),
('VC3132', 'Cuti Mendadak'),
('VC6503', 'Cuti Melahirkan'),
('VC7268', 'Cuti Hamil');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status` enum('TETAP','PKWT','PKWTT') NOT NULL,
  `jumlah_cuti` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Superuser','User') NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama`, `tanggal_masuk`, `departemen`, `jabatan`, `status`, `jumlah_cuti`, `username`, `password`, `level`, `gambar`) VALUES
('012021', 'Ahmad Arfan', '2018-04-21', 'HRGA', 'Manager', 'TETAP', '12', 'arfan', 'fa5fd7da128b62d24348eb73bf600bf5aeb937dc', 'Admin', 'gambar_admin/5.jpg'),
('022021', 'Suryadi', '2021-01-01', 'Accounting', 'Manager', 'TETAP', '12', 'suryadi', 'ce9917dd92f615e6a45c98eee8988828895da306', 'Superuser', 'gambar_admin/5.jpg'),
('032021', 'yandi ahmad', '2021-01-01', 'IT', 'Staf', 'PKWTT', '12', 'yandi', 'a96340acc8f9161a6d42554e414660200ad21a89', 'Admin', 'gambar_admin/5.jpg'),
('042021', 'Beny Guritno', '2021-01-01', 'Accounting', 'Supervisor', 'TETAP', '12', 'beny', '555e3e3d52a1c9e9063cc3843da01d8c8954bf7e', 'Superuser', 'gambar_admin/5.jpg'),
('052021', 'Pandu Putro', '2021-01-01', 'Enginnering', 'Staf', 'PKWT', '12', 'pandu', '290f138c376f2a1e018b36d470e07586ed9c4bb4', 'Admin', 'gambar_admin/5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_new`
--

CREATE TABLE `karyawan_new` (
  `id_karyawan` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `no_karyawan` varchar(50) NOT NULL,
  `no_npwp` varchar(50) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `status_kerja` enum('Tetap','Kontrak') NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_habis` varchar(20) DEFAULT NULL,
  `metode` enum('Tunai','Transfer') NOT NULL,
  `foto` text NOT NULL,
  `foto_ktp` text NOT NULL,
  `foto_kk` text NOT NULL,
  `foto_npwp` text NOT NULL,
  `foto_buku_rekening` text NOT NULL,
  `foto_bpjs_ks` text NOT NULL,
  `foto_bpjs_kj` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Superuser','User','') NOT NULL,
  `id_projek` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_ptkp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan_new`
--

INSERT INTO `karyawan_new` (`id_karyawan`, `nik`, `no_kk`, `no_karyawan`, `no_npwp`, `no_rekening`, `nama`, `jk`, `status_kerja`, `departemen`, `jabatan`, `tanggal_masuk`, `tanggal_habis`, `metode`, `foto`, `foto_ktp`, `foto_kk`, `foto_npwp`, `foto_buku_rekening`, `foto_bpjs_ks`, `foto_bpjs_kj`, `username`, `password`, `level`, `id_projek`, `id_role`, `id_ptkp`) VALUES
(16, '3208193818', '3293822388', '0011', '82.82848.928-119', '1826661721331', 'Udin', 'L', 'Tetap', 'Enginnering', 'Supervisor', '2021-01-01', '', 'Transfer', 'e10db0fbab68ddd44e8221a97c15564f.jpg', '8e59b7195e428d5328be2cdf326a43f9.jpg', 'ffb9aa3719102f5a3d54d061163c5552.jpg', '7625b2d27058fbc7a18663d9f2a44e2c.png', '8e59b7195e428d5328be2cdf326a43f9.jpg', '8e59b7195e428d5328be2cdf326a43f9.jpg', '7625b2d27058fbc7a18663d9f2a44e2c.png', 'udin', '0ff6f2c78c3f785fd15525e78e1fe9a223479ed1', 'User', 11, 1, 9),
(17, '328001993818', '32818380001818', '0012', '89.12282.1984481-1224', '', 'Syarif', 'L', 'Kontrak', 'Customer Service', 'Staf', '2021-04-15', '2021-07-15', 'Tunai', 'e984f3e5ed282af347e506bb74cd4db8.jpeg', 'e984f3e5ed282af347e506bb74cd4db8.jpeg', 'e984f3e5ed282af347e506bb74cd4db8.jpeg', 'e984f3e5ed282af347e506bb74cd4db8.jpeg', 'e984f3e5ed282af347e506bb74cd4db8.jpeg', 'e984f3e5ed282af347e506bb74cd4db8.jpeg', 'e984f3e5ed282af347e506bb74cd4db8.jpeg', 'syarif', '4de51732b2ce17e4a2401e66805b3208e8b3952b', 'Admin', 15, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_absensi`
--

CREATE TABLE `kategori_absensi` (
  `id_kategori_absensi` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis` enum('potongan','lembur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_absensi`
--

INSERT INTO `kategori_absensi` (`id_kategori_absensi`, `kategori`, `jenis`) VALUES
(1, 'Sakit', 'potongan'),
(2, 'Izin', 'potongan'),
(3, 'Cuti', 'potongan'),
(4, 'Tanpa Keterangan', 'potongan'),
(5, 'Backup Kekosongan', 'lembur'),
(6, 'Lembur Holiday', 'lembur'),
(7, 'Lembur Reguler', 'lembur');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `bulan`, `tahun`) VALUES
(1, '1', '2020'),
(2, '2', '2020'),
(3, '3', '2020'),
(4, '4', '2020'),
(5, '5', '2020'),
(6, '6', '2020'),
(7, '7', '2020'),
(8, '8', '2020'),
(9, '9', '2020'),
(10, '10', '2020'),
(11, '11', '2020'),
(12, '12', '2020'),
(13, '1', '2021'),
(14, '2', '2021'),
(15, '3', '2021'),
(16, '4', '2021'),
(17, '5', '2021'),
(18, '6', '2021'),
(19, '7', '2021'),
(20, '8', '2021'),
(21, '9', '2021'),
(22, '10', '2021'),
(23, '11', '2021'),
(24, '12', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `projek`
--

CREATE TABLE `projek` (
  `id_projek` int(11) NOT NULL,
  `projek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projek`
--

INSERT INTO `projek` (`id_projek`, `projek`) VALUES
(1, 'ARTHINDO GOLF MANSION'),
(2, 'ARTHINDO UTAMA'),
(3, 'ARUTMIN'),
(4, 'PT. ENERGY TRANSPORTER INDONESIA (ETI)'),
(5, 'PT. KALTIM PRIMA COAL'),
(6, 'KANTOR BP. ARI S HUDAYA'),
(7, 'KEDIAMAN IBU NADIA NUYORKA'),
(8, 'CLINIC MAHARIS MALABAR'),
(9, 'CLINIC MAHARIS BARITO'),
(10, 'PT. FINFLEET INDONESIA'),
(11, 'PT. BAKRIE BROTHER'),
(12, 'PT. BAKRIE DARMAKARYA ENERGY'),
(13, 'KEDIAMAN KEMANGGISAN'),
(14, 'PT. BETA MEGA PRATAMA'),
(15, 'PT. BRAJA MUKTI CAKRA'),
(16, 'PT. BAKRIE CAPITAL INDONESIA'),
(17, 'PT. BAKRIE SUMATERA PLANTATION'),
(18, 'KEDIAMAN BP. SRI HASCARYO'),
(19, 'PT. BUMI RESOURCES'),
(20, 'PT. BUMI RESOURCES MINERAL'),
(21, 'CASA JATI PADANG'),
(22, 'PT. DELTA MULTIARA AMARTA'),
(23, 'PT. KARYA TANGGUH PERSADA'),
(24, 'PT. LATIVI MEDIA KARYA'),
(25, 'PT. RINJANI MARITIM TRANSPORTASI '),
(26, 'RESTO SENYUM'),
(27, 'KEDIAMAN ALM.IBU BAKRIE'),
(28, 'VILLA BOGOR'),
(29, 'VILLA CIBULAN'),
(30, 'UNIVERSITAS BAKRIE');

-- --------------------------------------------------------

--
-- Table structure for table `ptkp`
--

CREATE TABLE `ptkp` (
  `id_ptkp` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `ptkp` int(11) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ptkp`
--

INSERT INTO `ptkp` (`id_ptkp`, `kode`, `ptkp`, `ket`) VALUES
(1, 'TK/0', 54000000, 'Tidak kawin dan tidak ada tanggungan'),
(2, 'TK/1', 58500000, 'Tidak kawin dan 1 tanggungan'),
(3, 'TK/2', 63000000, 'Tidak kawin dan 2 tanggungan'),
(4, 'TK/3', 67500000, 'Tidak kawin dan 3 atau lebih tanggungan'),
(5, 'K/0', 58500000, 'Kawin dan tidak ada tanggungan'),
(6, 'K/1', 63000000, 'Kawin dan 1 tanggungan'),
(7, 'K/2', 67500000, 'Kawin dan 2 tanggungan'),
(8, 'K/3', 72000000, 'Kawin dan 3 atau lebih tanggungan'),
(9, 'K/I/0', 112500000, 'Penghasilan suami dan istri digabung dan tidak ada tanggungan'),
(10, 'K/I/1', 117000000, 'Penghasilan suami dan istri digabung dan 1 tanggungan'),
(11, 'K/I/2', 121500000, 'Penghasilan suami dan istri digabung dan 2 tanggungan'),
(12, 'K/I/3', 126000000, 'Penghasilan suami dan istri digabung dan 3 atau lebih tanggungan');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Anggota'),
(2, 'Danru'),
(3, 'Korlap');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan`
--

CREATE TABLE `tunjangan` (
  `id_tunjangan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL,
  `tunjangan_dht` int(11) NOT NULL,
  `tunjangan_bpjs_ks` int(11) NOT NULL,
  `tunjangan_bpjs_kj` int(11) NOT NULL,
  `tunjangan_shift` int(11) NOT NULL,
  `tunjangan_transport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tunjangan`
--

INSERT INTO `tunjangan` (`id_tunjangan`, `id_karyawan`, `gaji_pokok`, `tunjangan_dht`, `tunjangan_bpjs_ks`, `tunjangan_bpjs_kj`, `tunjangan_shift`, `tunjangan_transport`) VALUES
(1, 12, 9000000, 2000000, 200000, 200000, 0, 0),
(2, 13, 9000000, 900000, 200000, 200000, 0, 0),
(3, 14, 9000000, 900000, 100000, 100000, 0, 0),
(5, 16, 5000000, 300000, 250000, 200000, 0, 0),
(6, 17, 10000000, 1000000, 100000, 200000, 100000, 100000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_absensi`
-- (See below for the actual view)
--
CREATE TABLE `v_absensi` (
`id_karyawan` int(11)
,`no_karyawan` varchar(50)
,`nama` varchar(50)
,`projek` varchar(255)
,`id_periode` int(11)
,`bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12')
,`tahun` varchar(10)
,`jumlah_sakit` decimal(32,0)
,`jumlah_izin` decimal(32,0)
,`jumlah_cuti` decimal(32,0)
,`jumlah_tk` decimal(32,0)
,`jumlah_backup` decimal(32,0)
,`jumlah_lembur_holiday` decimal(32,0)
,`jumlah_lembur_reguler` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_gaji`
-- (See below for the actual view)
--
CREATE TABLE `v_gaji` (
`id_gaji` int(11)
,`id_karyawan` int(11)
,`id_periode` int(11)
,`no_karyawan` varchar(50)
,`nama` varchar(50)
,`nik` varchar(50)
,`no_npwp` varchar(50)
,`projek` varchar(255)
,`role` varchar(50)
,`status_kerja` enum('Tetap','Kontrak')
,`jk` enum('L','P')
,`kode` varchar(10)
,`bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12')
,`tahun` varchar(10)
,`gaji_pokok` bigint(20)
,`tunjangan_dht` int(11)
,`tunjangan_bpjs_ks` int(11)
,`tunjangan_bpjs_kj` int(11)
,`tunjangan_shift` int(11)
,`tunjangan_transport` int(11)
,`sebulan` int(11)
,`setahun` bigint(20)
,`bonus` int(11)
,`lembur_backup` int(11)
,`lembur_holiday` int(11)
,`lembur_reguler` int(11)
,`lembur_lain` int(11)
,`potongan_sakit` int(11)
,`potongan_izin` int(11)
,`potongan_cuti` int(11)
,`potongan_tk` int(11)
,`potongan_diksar` int(11)
,`potongan_lain` int(11)
,`potongan_sp` int(11)
,`bruto` bigint(20)
,`biaya_jabatan` int(11)
,`neto` bigint(20)
,`pph` int(11)
,`ptkp` int(11)
,`thp` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_insentif`
-- (See below for the actual view)
--
CREATE TABLE `v_insentif` (
`id_insentif` int(11)
,`projek` varchar(255)
,`role` varchar(50)
,`sakit` int(11)
,`izin` int(11)
,`cuti` int(11)
,`tk` int(11)
,`backup` int(11)
,`lembur_holiday` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_karyawan`
-- (See below for the actual view)
--
CREATE TABLE `v_karyawan` (
`id_karyawan` int(11)
,`id_projek` int(11)
,`id_role` int(11)
,`nik` varchar(50)
,`no_kk` varchar(50)
,`no_karyawan` varchar(50)
,`no_npwp` varchar(50)
,`no_rekening` varchar(50)
,`nama` varchar(50)
,`jk` enum('L','P')
,`status_kerja` enum('Tetap','Kontrak')
,`projek` varchar(255)
,`role` varchar(50)
,`departemen` varchar(50)
,`jabatan` varchar(50)
,`tanggal_masuk` date
,`tanggal_habis` varchar(20)
,`metode` enum('Tunai','Transfer')
,`gaji_pokok` bigint(20)
,`tunjangan_dht` int(11)
,`tunjangan_bpjs_ks` int(11)
,`tunjangan_bpjs_kj` int(11)
,`foto` text
,`foto_ktp` text
,`foto_kk` text
,`foto_npwp` text
,`foto_buku_rekening` text
,`foto_bpjs_ks` text
,`foto_bpjs_kj` text
,`username` varchar(50)
,`password` text
,`level` enum('Admin','Superuser','User','')
,`kode` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `v_absensi`
--
DROP TABLE IF EXISTS `v_absensi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_absensi`  AS SELECT `k`.`id_karyawan` AS `id_karyawan`, `k`.`no_karyawan` AS `no_karyawan`, `k`.`nama` AS `nama`, `pr`.`projek` AS `projek`, `p`.`id_periode` AS `id_periode`, `p`.`bulan` AS `bulan`, `p`.`tahun` AS `tahun`, (select ifnull(sum(`a`.`jumlah`),0) from `absensi` `a` where `a`.`id_kategori_absensi` = 1 and `a`.`id_karyawan` = `k`.`id_karyawan` and `a`.`id_periode` = `p`.`id_periode`) AS `jumlah_sakit`, (select ifnull(sum(`a`.`jumlah`),0) from `absensi` `a` where `a`.`id_kategori_absensi` = 2 and `a`.`id_karyawan` = `k`.`id_karyawan` and `a`.`id_periode` = `p`.`id_periode`) AS `jumlah_izin`, (select ifnull(sum(`a`.`jumlah`),0) from `absensi` `a` where `a`.`id_kategori_absensi` = 3 and `a`.`id_karyawan` = `k`.`id_karyawan` and `a`.`id_periode` = `p`.`id_periode`) AS `jumlah_cuti`, (select ifnull(sum(`a`.`jumlah`),0) from `absensi` `a` where `a`.`id_kategori_absensi` = 4 and `a`.`id_karyawan` = `k`.`id_karyawan` and `a`.`id_periode` = `p`.`id_periode`) AS `jumlah_tk`, (select ifnull(sum(`a`.`jumlah`),0) from `absensi` `a` where `a`.`id_kategori_absensi` = 5 and `a`.`id_karyawan` = `k`.`id_karyawan` and `a`.`id_periode` = `p`.`id_periode`) AS `jumlah_backup`, (select ifnull(sum(`a`.`jumlah`),0) from `absensi` `a` where `a`.`id_kategori_absensi` = 6 and `a`.`id_karyawan` = `k`.`id_karyawan` and `a`.`id_periode` = `p`.`id_periode`) AS `jumlah_lembur_holiday`, (select ifnull(sum(`a`.`jumlah`),0) from `absensi` `a` where `a`.`id_kategori_absensi` = 7 and `a`.`id_karyawan` = `k`.`id_karyawan` and `a`.`id_periode` = `p`.`id_periode`) AS `jumlah_lembur_reguler` FROM (((`karyawan_new` `k` join `periode` `p`) join `absensi` `a`) join `projek` `pr`) WHERE `k`.`id_karyawan` = `a`.`id_karyawan` AND `p`.`id_periode` = `a`.`id_periode` AND `k`.`id_projek` = `pr`.`id_projek` GROUP BY `k`.`id_karyawan`, `p`.`id_periode` ;

-- --------------------------------------------------------

--
-- Structure for view `v_gaji`
--
DROP TABLE IF EXISTS `v_gaji`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_gaji`  AS SELECT `g`.`id_gaji` AS `id_gaji`, `k`.`id_karyawan` AS `id_karyawan`, `p`.`id_periode` AS `id_periode`, `k`.`no_karyawan` AS `no_karyawan`, `k`.`nama` AS `nama`, `k`.`nik` AS `nik`, `k`.`no_npwp` AS `no_npwp`, `pr`.`projek` AS `projek`, `r`.`role` AS `role`, `k`.`status_kerja` AS `status_kerja`, `k`.`jk` AS `jk`, `pt`.`kode` AS `kode`, `p`.`bulan` AS `bulan`, `p`.`tahun` AS `tahun`, `t`.`gaji_pokok` AS `gaji_pokok`, `t`.`tunjangan_dht` AS `tunjangan_dht`, `t`.`tunjangan_bpjs_ks` AS `tunjangan_bpjs_ks`, `t`.`tunjangan_bpjs_kj` AS `tunjangan_bpjs_kj`, `t`.`tunjangan_shift` AS `tunjangan_shift`, `t`.`tunjangan_transport` AS `tunjangan_transport`, `g`.`sebulan` AS `sebulan`, `g`.`setahun` AS `setahun`, `g`.`bonus` AS `bonus`, `g`.`lembur_backup` AS `lembur_backup`, `g`.`lembur_holiday` AS `lembur_holiday`, `g`.`lembur_reguler` AS `lembur_reguler`, `g`.`lembur_lain` AS `lembur_lain`, `g`.`potongan_sakit` AS `potongan_sakit`, `g`.`potongan_izin` AS `potongan_izin`, `g`.`potongan_cuti` AS `potongan_cuti`, `g`.`potongan_tk` AS `potongan_tk`, `g`.`potongan_diksar` AS `potongan_diksar`, `g`.`potongan_lain` AS `potongan_lain`, `g`.`potongan_sp` AS `potongan_sp`, `g`.`bruto` AS `bruto`, `g`.`biaya_jabatan` AS `biaya_jabatan`, `g`.`neto` AS `neto`, `g`.`pph` AS `pph`, `pt`.`ptkp` AS `ptkp`, `g`.`thp` AS `thp` FROM (((((`gaji` `g` join (`karyawan_new` `k` join `ptkp` `pt` on(`k`.`id_ptkp` = `pt`.`id_ptkp`)) on(`g`.`id_karyawan` = `k`.`id_karyawan`)) join `periode` `p` on(`g`.`id_periode` = `p`.`id_periode`)) join `tunjangan` `t` on(`k`.`id_karyawan` = `t`.`id_karyawan`)) join `projek` `pr` on(`k`.`id_projek` = `pr`.`id_projek`)) join `role` `r` on(`k`.`id_role` = `r`.`id_role`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_insentif`
--
DROP TABLE IF EXISTS `v_insentif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_insentif`  AS SELECT `i`.`id_insentif` AS `id_insentif`, `p`.`projek` AS `projek`, `r`.`role` AS `role`, `i`.`sakit` AS `sakit`, `i`.`izin` AS `izin`, `i`.`cuti` AS `cuti`, `i`.`tk` AS `tk`, `i`.`backup` AS `backup`, `i`.`lembur_holiday` AS `lembur_holiday` FROM ((`insentif` `i` join `projek` `p` on(`i`.`id_projek` = `p`.`id_projek`)) join `role` `r` on(`i`.`id_role` = `r`.`id_role`)) ORDER BY `i`.`id_insentif` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_karyawan`
--
DROP TABLE IF EXISTS `v_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_karyawan`  AS SELECT `k`.`id_karyawan` AS `id_karyawan`, `k`.`id_projek` AS `id_projek`, `k`.`id_role` AS `id_role`, `k`.`nik` AS `nik`, `k`.`no_kk` AS `no_kk`, `k`.`no_karyawan` AS `no_karyawan`, `k`.`no_npwp` AS `no_npwp`, `k`.`no_rekening` AS `no_rekening`, `k`.`nama` AS `nama`, `k`.`jk` AS `jk`, `k`.`status_kerja` AS `status_kerja`, `p`.`projek` AS `projek`, `r`.`role` AS `role`, `k`.`departemen` AS `departemen`, `k`.`jabatan` AS `jabatan`, `k`.`tanggal_masuk` AS `tanggal_masuk`, `k`.`tanggal_habis` AS `tanggal_habis`, `k`.`metode` AS `metode`, `t`.`gaji_pokok` AS `gaji_pokok`, `t`.`tunjangan_dht` AS `tunjangan_dht`, `t`.`tunjangan_bpjs_ks` AS `tunjangan_bpjs_ks`, `t`.`tunjangan_bpjs_kj` AS `tunjangan_bpjs_kj`, `k`.`foto` AS `foto`, `k`.`foto_ktp` AS `foto_ktp`, `k`.`foto_kk` AS `foto_kk`, `k`.`foto_npwp` AS `foto_npwp`, `k`.`foto_buku_rekening` AS `foto_buku_rekening`, `k`.`foto_bpjs_ks` AS `foto_bpjs_ks`, `k`.`foto_bpjs_kj` AS `foto_bpjs_kj`, `k`.`username` AS `username`, `k`.`password` AS `password`, `k`.`level` AS `level`, `pt`.`kode` AS `kode` FROM ((((`karyawan_new` `k` join `tunjangan` `t`) join `projek` `p`) join `role` `r`) join `ptkp` `pt`) WHERE `k`.`id_projek` = `p`.`id_projek` AND `k`.`id_role` = `r`.`id_role` AND `k`.`id_ptkp` = `pt`.`id_ptkp` AND `k`.`id_karyawan` = `t`.`id_karyawan` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `kategori` (`id_kategori_absensi`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `insentif`
--
ALTER TABLE `insentif`
  ADD PRIMARY KEY (`id_insentif`),
  ADD KEY `id_projek` (`id_projek`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenis_cuti`
--
ALTER TABLE `jenis_cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `karyawan_new`
--
ALTER TABLE `karyawan_new`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kategori_absensi`
--
ALTER TABLE `kategori_absensi`
  ADD PRIMARY KEY (`id_kategori_absensi`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `projek`
--
ALTER TABLE `projek`
  ADD PRIMARY KEY (`id_projek`);

--
-- Indexes for table `ptkp`
--
ALTER TABLE `ptkp`
  ADD PRIMARY KEY (`id_ptkp`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tunjangan`
--
ALTER TABLE `tunjangan`
  ADD PRIMARY KEY (`id_tunjangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `insentif`
--
ALTER TABLE `insentif`
  MODIFY `id_insentif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `karyawan_new`
--
ALTER TABLE `karyawan_new`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori_absensi`
--
ALTER TABLE `kategori_absensi`
  MODIFY `id_kategori_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `projek`
--
ALTER TABLE `projek`
  MODIFY `id_projek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ptkp`
--
ALTER TABLE `ptkp`
  MODIFY `id_ptkp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tunjangan`
--
ALTER TABLE `tunjangan`
  MODIFY `id_tunjangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `kategori` FOREIGN KEY (`id_kategori_absensi`) REFERENCES `kategori_absensi` (`id_kategori_absensi`);

--
-- Constraints for table `insentif`
--
ALTER TABLE `insentif`
  ADD CONSTRAINT `id_projek` FOREIGN KEY (`id_projek`) REFERENCES `projek` (`id_projek`),
  ADD CONSTRAINT `id_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
