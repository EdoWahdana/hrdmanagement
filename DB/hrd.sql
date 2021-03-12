-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 01 Jan 2021 pada 04.07
-- Versi Server: 5.6.14
-- Versi PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `hrd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE IF NOT EXISTS `cuti` (
  `kode` varchar(10) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `jenis_cuti` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `status` enum('Approved','Rejected','Pending') NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`kode`, `nik`, `tanggal_awal`, `tanggal_akhir`, `jumlah`, `jenis_cuti`, `ket`, `status`) VALUES
('CT5185', '12132', '2018-06-29', '2018-06-29', '1', 'Cuti Khitan Anak', 'test', 'Approved'),
('CT5628', '10161', '2018-07-06', '2018-07-07', '2', 'Cuti Mendadak', 'test', 'Approved'),
('CT5647', '202020', '2020-12-01', '2020-12-02', '2', 'Cuti Khitan Anak', 'wefre', 'Approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE IF NOT EXISTS `departemen` (
  `id_dept` varchar(10) NOT NULL,
  `nama_dept` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `departemen`
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
-- Struktur dari tabel `gaji`
--

CREATE TABLE IF NOT EXISTS `gaji` (
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
  `gambar` text NOT NULL,
  UNIQUE KEY `nik_3` (`nik`),
  KEY `nik` (`nik`),
  FULLTEXT KEY `nik_2` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`nik`, `nama`, `tanggal`, `departemen`, `jabatan`, `status`, `gapok`, `bpjs`, `lembur`, `norek`, `gambar`) VALUES
('012021', 'Ahmad Arfan', '2021-01-01', 'HRGA', 'Manager', 'TETAP', 8000000, 450000, 300000, '06532156787', 'gambar_admin/5.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` varchar(10) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tunjangan` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `tunjangan`) VALUES
('JGMGR', 'General Manager', '450000'),
('JLDR', 'Leader', '200000'),
('JMGR', 'Manager', '400000'),
('JSPV', 'Supervisor', '350000'),
('JSTF', 'Staf', '150000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_cuti`
--

CREATE TABLE IF NOT EXISTS `jenis_cuti` (
  `id_cuti` varchar(10) NOT NULL,
  `nama_cuti` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cuti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_cuti`
--

INSERT INTO `jenis_cuti` (`id_cuti`, `nama_cuti`) VALUES
('VC3007', 'Cuti Khitan Anak'),
('VC3132', 'Cuti Mendadak'),
('VC6503', 'Cuti Melahirkan'),
('VC7268', 'Cuti Hamil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
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
  `gambar` text NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama`, `tanggal_masuk`, `departemen`, `jabatan`, `status`, `jumlah_cuti`, `username`, `password`, `level`, `gambar`) VALUES
('012021', 'Ahmad Arfan', '2018-04-21', 'HRGA', 'Manager', 'TETAP', '12', 'arfan', 'fa5fd7da128b62d24348eb73bf600bf5aeb937dc', 'Superuser', 'gambar_admin/5.jpg'),
('022021', 'Suryadi', '2021-01-01', 'Accounting', 'Manager', 'TETAP', '12', 'suryadi', 'ce9917dd92f615e6a45c98eee8988828895da306', 'Superuser', 'gambar_admin/5.jpg'),
('032021', 'yandi ahmad', '2021-01-01', 'IT', 'Staf', 'PKWTT', '12', 'yandi', 'a96340acc8f9161a6d42554e414660200ad21a89', 'Admin', 'gambar_admin/5.jpg'),
('042021', 'Beny Guritno', '2021-01-01', 'Accounting', 'Supervisor', 'TETAP', '12', 'beny', '555e3e3d52a1c9e9063cc3843da01d8c8954bf7e', 'Superuser', 'gambar_admin/5.jpg'),
('052021', 'Pandu Putro', '2021-01-01', 'Enginnering', 'Staf', 'PKWT', '12', 'pandu', '290f138c376f2a1e018b36d470e07586ed9c4bb4', 'Admin', 'gambar_admin/5.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
