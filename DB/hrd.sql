-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 08:45 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `jumlah_sakit` int(11) NOT NULL,
  `jumlah_izin` int(11) NOT NULL,
  `jumlah_cuti` int(11) NOT NULL,
  `jumlah_tk` int(11) NOT NULL,
  `jumlah_backup` int(11) NOT NULL,
  `jumlah_lembur_holiday` int(11) NOT NULL,
  `jumlah_lembur_reguler` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_karyawan`, `id_periode`, `jumlah_sakit`, `jumlah_izin`, `jumlah_cuti`, `jumlah_tk`, `jumlah_backup`, `jumlah_lembur_holiday`, `jumlah_lembur_reguler`) VALUES
(1, 5, 5, 3, 2, 4, 2, 3, 5, 5);

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
  `nik` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status` enum('TETAP','PKWT','PKWTT') NOT NULL,
  `gapok` float NOT NULL,
  `bpjs` float NOT NULL,
  `lembur` float NOT NULL,
  `norek` varchar(15) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `nama` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `status_kerja` enum('Tetap','Kontrak') NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `bpjs` int(11) NOT NULL,
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

INSERT INTO `karyawan_new` (`id_karyawan`, `nik`, `no_kk`, `no_karyawan`, `nama`, `jk`, `status_kerja`, `departemen`, `jabatan`, `tanggal_masuk`, `gaji_pokok`, `bpjs`, `foto`, `foto_ktp`, `foto_kk`, `foto_npwp`, `foto_buku_rekening`, `foto_bpjs_ks`, `foto_bpjs_kj`, `username`, `password`, `level`, `id_projek`, `id_role`, `id_ptkp`) VALUES
(5, '201381238', '0919388138', '0005', 'Edo Wahdana', 'L', 'Tetap', 'Accounting', 'Leader', '2021-03-03', 9000000, 3000000, 'd1a7b037cbcc1923fac0134287522b8e.jpg', 'eefccc9574c0f2e3e01e2d3bb3d9fe86.jpg', 'eefccc9574c0f2e3e01e2d3bb3d9fe86.jpg', 'd1a7b037cbcc1923fac0134287522b8e.jpg', 'eefccc9574c0f2e3e01e2d3bb3d9fe86.jpg', 'd1a7b037cbcc1923fac0134287522b8e.jpg', 'd1a7b037cbcc1923fac0134287522b8e.jpg', 'edo', '9da14ce833f5a7b709513cc8f6de983d5ea2bd91', 'Admin', 4, 2, 1);

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
-- Stand-in structure for view `v_absensi`
-- (See below for the actual view)
--
CREATE TABLE `v_absensi` (
`id_absensi` int(11)
,`nama` varchar(50)
,`bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12')
,`tahun` varchar(10)
,`jumlah_sakit` int(11)
,`jumlah_izin` int(11)
,`jumlah_cuti` int(11)
,`jumlah_tk` int(11)
,`jumlah_backup` int(11)
,`jumlah_lembur_holiday` int(11)
,`jumlah_lembur_reguler` int(11)
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
,`nama` varchar(50)
,`projek` varchar(255)
,`role` varchar(50)
,`departemen` varchar(50)
,`jabatan` varchar(50)
,`tanggal_masuk` date
,`gaji_pokok` int(11)
,`bpjs` int(11)
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_absensi`  AS  select `absensi`.`id_absensi` AS `id_absensi`,`karyawan_new`.`nama` AS `nama`,`periode`.`bulan` AS `bulan`,`periode`.`tahun` AS `tahun`,`absensi`.`jumlah_sakit` AS `jumlah_sakit`,`absensi`.`jumlah_izin` AS `jumlah_izin`,`absensi`.`jumlah_cuti` AS `jumlah_cuti`,`absensi`.`jumlah_tk` AS `jumlah_tk`,`absensi`.`jumlah_backup` AS `jumlah_backup`,`absensi`.`jumlah_lembur_holiday` AS `jumlah_lembur_holiday`,`absensi`.`jumlah_lembur_reguler` AS `jumlah_lembur_reguler` from ((`karyawan_new` join `periode`) join `absensi`) where `karyawan_new`.`id_karyawan` = `absensi`.`id_karyawan` and `periode`.`id_periode` = `absensi`.`id_periode` ;

-- --------------------------------------------------------

--
-- Structure for view `v_insentif`
--
DROP TABLE IF EXISTS `v_insentif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_insentif`  AS  select `i`.`id_insentif` AS `id_insentif`,`p`.`projek` AS `projek`,`r`.`role` AS `role`,`i`.`sakit` AS `sakit`,`i`.`izin` AS `izin`,`i`.`cuti` AS `cuti`,`i`.`tk` AS `tk`,`i`.`backup` AS `backup`,`i`.`lembur_holiday` AS `lembur_holiday` from ((`insentif` `i` join `projek` `p` on(`i`.`id_projek` = `p`.`id_projek`)) join `role` `r` on(`i`.`id_role` = `r`.`id_role`)) order by `i`.`id_insentif` ;

-- --------------------------------------------------------

--
-- Structure for view `v_karyawan`
--
DROP TABLE IF EXISTS `v_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_karyawan`  AS  select `k`.`id_karyawan` AS `id_karyawan`,`k`.`id_projek` AS `id_projek`,`k`.`id_role` AS `id_role`,`k`.`nik` AS `nik`,`k`.`no_kk` AS `no_kk`,`k`.`no_karyawan` AS `no_karyawan`,`k`.`nama` AS `nama`,`p`.`projek` AS `projek`,`r`.`role` AS `role`,`k`.`departemen` AS `departemen`,`k`.`jabatan` AS `jabatan`,`k`.`tanggal_masuk` AS `tanggal_masuk`,`k`.`gaji_pokok` AS `gaji_pokok`,`k`.`bpjs` AS `bpjs`,`k`.`foto` AS `foto`,`k`.`foto_ktp` AS `foto_ktp`,`k`.`foto_kk` AS `foto_kk`,`k`.`foto_npwp` AS `foto_npwp`,`k`.`foto_buku_rekening` AS `foto_buku_rekening`,`k`.`foto_bpjs_ks` AS `foto_bpjs_ks`,`k`.`foto_bpjs_kj` AS `foto_bpjs_kj`,`k`.`username` AS `username`,`k`.`password` AS `password`,`k`.`level` AS `level`,`pt`.`kode` AS `kode` from (((`karyawan_new` `k` join `projek` `p`) join `role` `r`) join `ptkp` `pt`) where `k`.`id_projek` = `p`.`id_projek` and `k`.`id_role` = `r`.`id_role` and `k`.`id_ptkp` = `pt`.`id_ptkp` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

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
  ADD UNIQUE KEY `nik_3` (`nik`),
  ADD KEY `nik` (`nik`);
ALTER TABLE `gaji` ADD FULLTEXT KEY `nik_2` (`nik`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `insentif`
--
ALTER TABLE `insentif`
  MODIFY `id_insentif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `karyawan_new`
--
ALTER TABLE `karyawan_new`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for dumped tables
--

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
