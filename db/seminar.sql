-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2025 at 09:04 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

DROP TABLE IF EXISTS `akses`;
CREATE TABLE IF NOT EXISTS `akses` (
  `id_akses` int(10) NOT NULL AUTO_INCREMENT,
  `nama_akses` text NOT NULL,
  `kontak_akses` varchar(20) DEFAULT NULL,
  `email_akses` text NOT NULL,
  `password` text NOT NULL,
  `image_akses` text,
  `akses` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetime_daftar` text NOT NULL,
  `datetime_update` text NOT NULL,
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama_akses`, `kontak_akses`, `email_akses`, `password`, `image_akses`, `akses`, `status`, `datetime_daftar`, `datetime_update`) VALUES
(1, 'Solihul Hadi', '62896011547265', 'dhiforester@gmail.com', 'f4a3229c9c5f1bdd9c6a6791080791b7', '285a4eaa52ae671fbe091ee9a55a2f.jpg', 'Admin', 'Active', '2022-08-29 11:10:06', '2025-03-28 20:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi_api`
--

DROP TABLE IF EXISTS `dokumentasi_api`;
CREATE TABLE IF NOT EXISTS `dokumentasi_api` (
  `id_dokumentasi_api` int(10) NOT NULL AUTO_INCREMENT,
  `updatetime_api` varchar(25) NOT NULL,
  `judul_api` text NOT NULL,
  `kategori_api` varchar(20) NOT NULL,
  `metode_api` varchar(20) NOT NULL,
  `url_api` text NOT NULL,
  `request_api` text NOT NULL,
  `response_api` text NOT NULL,
  PRIMARY KEY (`id_dokumentasi_api`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_absen`
--

DROP TABLE IF EXISTS `event_absen`;
CREATE TABLE IF NOT EXISTS `event_absen` (
  `id_event_absen` int(15) NOT NULL AUTO_INCREMENT,
  `id_event_sesi_absen` int(20) NOT NULL,
  `id_event_setting` int(20) NOT NULL,
  `id_event_kategori` int(20) NOT NULL,
  `id_peserta` int(15) NOT NULL,
  `tanggal` varchar(30) NOT NULL COMMENT 'waktu melakukan absen\r\nY-m-d H:i',
  `metode` text COMMENT 'Metode absensi yang digunakan\r\n1. On-site\r\n2. Online',
  PRIMARY KEY (`id_event_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_absen`
--

INSERT INTO `event_absen` (`id_event_absen`, `id_event_sesi_absen`, `id_event_setting`, `id_event_kategori`, `id_peserta`, `tanggal`, `metode`) VALUES
(2, 3, 12, 1, 8, '2023-10-04 23:28', 'On-Site');

-- --------------------------------------------------------

--
-- Table structure for table `event_file`
--

DROP TABLE IF EXISTS `event_file`;
CREATE TABLE IF NOT EXISTS `event_file` (
  `id_event_file` int(15) NOT NULL AUTO_INCREMENT,
  `id_event` int(15) DEFAULT NULL,
  `id_akses` int(15) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `title_file` varchar(25) NOT NULL,
  `deskripsi` text,
  `file_type` text,
  `file_size` varchar(25) DEFAULT NULL,
  `file_name` text,
  `tanggal` varchar(30) NOT NULL,
  PRIMARY KEY (`id_event_file`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_file`
--

INSERT INTO `event_file` (`id_event_file`, `id_event`, `id_akses`, `kategori`, `title_file`, `deskripsi`, `file_type`, `file_size`, `file_name`, `tanggal`) VALUES
(5, 6, 1, 'URL/Link', 'Dokumentasi Kegiatan', 'Dokumentasi Kegiatan Rapat', '', '', 'https://www.youtube.com/watch?v=PYiZl6FUrTE', '2022-11-27 20:54:03'),
(6, 6, 1, 'Dokumen', 'Perancangan', 'Perancangan', 'application/pdf', '350747', 'cdd6d8d614e64a39a97ad4b6f19eb2.pdf', '2022-11-27 20:58:51'),
(7, 6, 1, 'URL/Link', 'Bootstrap', 'Bootstrap', '', '', 'https://getbootstrap.com/docs/5.0/forms/checks-radios/', '2022-11-27 22:36:03'),
(10, 6, 1, 'URL/Link', 'Niaga Hoster', 'Niaga Hoster', '', '', 'https://panel.niagahoster.co.id/service/manage/1612098', '2022-11-27 22:38:50'),
(11, 6, 1, 'URL/Link', 'PHP Myadmin', 'PHP Myadmin', '', '', 'http://localhost:81/phpmyadmin/sql.php?db=echojob&table=event_file&pos=0', '2022-11-27 22:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `event_jadwal`
--

DROP TABLE IF EXISTS `event_jadwal`;
CREATE TABLE IF NOT EXISTS `event_jadwal` (
  `id_event_jadwal` int(15) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `waktu1` varchar(25) NOT NULL,
  `waktu2` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `pengisi_acara` text,
  PRIMARY KEY (`id_event_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_jadwal`
--

INSERT INTO `event_jadwal` (`id_event_jadwal`, `id_event_setting`, `tanggal`, `waktu1`, `waktu2`, `keterangan`, `pengisi_acara`) VALUES
(9, 6, '2022-11-21', '08:00', '08:15', 'Pembukaan oleh Direktur RS', NULL),
(10, 6, '2022-11-21', '08:15', '08:30', 'Pembacaan ayat suci Al-Quran', NULL),
(11, 5, '2022-11-20', '08:00', '00:00', 'Pembkaan', NULL),
(12, 12, '2023-11-01', '08:00', '09:00', 'Pembukaan dengan membacakan alkuran', 'Nia Rahmadani'),
(13, 12, '2023-11-01', '09:00', '10:00', 'Sambutan2', 'test'),
(14, 12, '2023-11-01', '10:00', '11:00', 'Sambutan2', 'test'),
(15, 12, '2023-11-01', '11:00', '12:00', 'Sambutan2', 'test'),
(16, 12, '2023-11-02', '08:00', '09:00', 'Pembukaan hari ke 3', 'Hadi3');

-- --------------------------------------------------------

--
-- Table structure for table `event_kategori`
--

DROP TABLE IF EXISTS `event_kategori`;
CREATE TABLE IF NOT EXISTS `event_kategori` (
  `id_event_kategori` int(20) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `kategori` text NOT NULL COMMENT 'keterangan nama kategori',
  `keterangan` text,
  `harga_tiket` int(20) NOT NULL,
  `biaya_adm` int(30) DEFAULT NULL,
  `kuota` int(20) NOT NULL,
  PRIMARY KEY (`id_event_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_kategori`
--

INSERT INTO `event_kategori` (`id_event_kategori`, `id_event_setting`, `kategori`, `keterangan`, `harga_tiket`, `biaya_adm`, `kuota`) VALUES
(1, 12, 'Offline Symposium Early Bird (Medical Student)', '(Medical Student) ', 700000, 5000, 5),
(2, 12, 'Offline Symposium Early Bird (Medical Specialist)', 'Khusus untuk mahasiswa kedokteran spesialis', 1250000, 5000, 300),
(5, 12, 'Offline Symposium On Site (Medical Student)', 'Including good things:', 1000000, 5000, 130);

-- --------------------------------------------------------

--
-- Table structure for table `event_kupon`
--

DROP TABLE IF EXISTS `event_kupon`;
CREATE TABLE IF NOT EXISTS `event_kupon` (
  `id_kupon` int(20) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `id_event_kategori` int(20) NOT NULL,
  `kode_kupon` varchar(30) NOT NULL COMMENT 'Kode Acak Unik',
  `diskon` int(20) NOT NULL COMMENT 'Persen Potongan Harga',
  `status` varchar(30) NOT NULL COMMENT '1.Belum Digunakan\r\n2.Sudah Digunakan',
  PRIMARY KEY (`id_kupon`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_kupon`
--

INSERT INTO `event_kupon` (`id_kupon`, `id_event_setting`, `id_event_kategori`, `kode_kupon`, `diskon`, `status`) VALUES
(1, 12, 1, 'PV2XLVMRmIW9f10X', 10, 'Belum Digunakan'),
(2, 12, 1, 'jL3f3cYxUfQJLBMv', 10, 'Belum Digunakan'),
(3, 12, 1, 'Q5kigmVgC7mhnIvh', 10, 'Belum Digunakan'),
(4, 12, 1, 'NGvuQMS5GodZ0dOa', 10, 'Belum Digunakan'),
(5, 12, 1, 'RIIEM1htotVn7dlx', 10, 'Belum Digunakan'),
(6, 12, 1, 'UQLFSdv3YJZUChFo', 10, 'Belum Digunakan'),
(7, 12, 1, 'mCp0migsfZtELws0', 10, 'Belum Digunakan'),
(8, 12, 1, 'HAMBrcr90pv5BQkB', 10, 'Belum Digunakan'),
(9, 12, 1, 'WEkW3tAq90Vbpv5z', 10, 'Belum Digunakan'),
(10, 12, 1, 'Dap1ajeOm1inY1Sy', 10, 'Sudah Digunakan'),
(13, 12, 1, 'SmLBKjeXZBgyEmEE', 10, 'Belum Digunakan'),
(14, 12, 1, 'EZmcxdH9YSm7KW6c', 10, 'Belum Digunakan'),
(15, 12, 1, '9BmJ4LXJ0hk3bGz2', 10, 'Sudah Digunakan'),
(16, 12, 1, 'yfrR1m3My7R4U0js', 10, 'Sudah Digunakan'),
(17, 12, 1, 'SBLmBxTH8dxJib9D', 10, 'Sudah Digunakan'),
(18, 12, 1, 'nZxtpd0Epu4mGruZ', 10, 'Belum Digunakan'),
(19, 12, 1, 'deUvymrtSZmiBWAn', 10, 'Belum Digunakan'),
(20, 12, 1, 'LpU2GsiZZvKv5xM7', 10, 'Belum Digunakan'),
(21, 12, 1, 'MYgNVPLwWGL0Hn5j', 10, 'Belum Digunakan'),
(22, 12, 1, 'pxz0SXabJsU1EyMW', 10, 'Belum Digunakan'),
(23, 12, 1, 'svMTJF3CPD7a3Akd', 10, 'Belum Digunakan'),
(24, 12, 1, 'tJVY0UPtDezKZncx', 10, 'Belum Digunakan'),
(25, 12, 2, 'NyDLQZJQnWVN70dy', 10, 'Belum Digunakan'),
(26, 12, 2, '9fj4KcKMvm2ThhEB', 10, 'Belum Digunakan'),
(27, 12, 2, 'HrCFrCgFdpgTadgT', 10, 'Belum Digunakan'),
(28, 12, 2, '3GrBVP6NGFPVh5nu', 10, 'Belum Digunakan'),
(29, 12, 2, 'GG1TwZZcSszuf9GM', 10, 'Sudah Digunakan'),
(30, 12, 1, 'jc5eFquYZfiw9Q7G', 15, 'Belum Digunakan'),
(31, 12, 1, '4Se9bp1yXN59rHNB', 15, 'Sudah Digunakan'),
(32, 12, 1, '6Jh8907XJitcgtZ8', 15, 'Sudah Digunakan'),
(33, 12, 1, 'P9v2TkB9p4DEUwKR', 15, 'Sudah Digunakan'),
(34, 12, 1, 'Fw2bW1GKBKGtpfy5', 15, 'Sudah Digunakan'),
(35, 12, 1, 'DGBePYspPPSTFUnd', 15, 'Sudah Digunakan'),
(36, 12, 1, 'eYfXvShs8MRZfHeU', 15, 'Sudah Digunakan'),
(37, 12, 1, 'zyeMs0WbNFr99Pcc', 15, 'Sudah Digunakan'),
(38, 12, 1, 'fGHhgtQwRBXF6L2U', 15, 'Sudah Digunakan'),
(39, 12, 1, 'umKmFK9gT5DZ3z7M', 15, 'Sudah Digunakan'),
(40, 12, 2, 'mfACXC1e0FR7XTuY', 10, 'Belum Digunakan'),
(41, 12, 2, 'BKwKdwpc78TXR5W1', 10, 'Belum Digunakan'),
(42, 12, 2, 'xwP7q080wVQbmJwm', 10, 'Belum Digunakan'),
(43, 12, 2, 'JLdtzPzTbd7rjdR4', 10, 'Belum Digunakan'),
(44, 12, 2, '4s12ctHhEwmEsiwL', 10, 'Belum Digunakan'),
(45, 12, 2, 'M10uDgVjXqSMxUtn', 10, 'Belum Digunakan'),
(46, 12, 2, 'a6Rxt2SA0HSExtdX', 10, 'Belum Digunakan'),
(47, 12, 2, 'XfsdPrZcH0VPCEaP', 10, 'Belum Digunakan'),
(48, 12, 2, 'C1KTG1CqD1afvbMC', 10, 'Belum Digunakan'),
(49, 12, 2, 'wA236cbYeYt4v0vY', 10, 'Belum Digunakan');

-- --------------------------------------------------------

--
-- Table structure for table `event_panitia`
--

DROP TABLE IF EXISTS `event_panitia`;
CREATE TABLE IF NOT EXISTS `event_panitia` (
  `id_event_panitia` int(15) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `id_event_kategori` int(20) DEFAULT NULL,
  `kategori` text NOT NULL,
  `nama_panitia` text NOT NULL,
  `email` text NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `foto` text,
  PRIMARY KEY (`id_event_panitia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_panitia`
--

INSERT INTO `event_panitia` (`id_event_panitia`, `id_event_setting`, `id_event_kategori`, `kategori`, `nama_panitia`, `email`, `kontak`, `foto`) VALUES
(1, 12, 1, 'Sie Acara', 'Siti Zubaedah', 'sitizubaedah@gmail.com', '08978879788', '57b19192aba0ac72f49ec1a8a420e4.jpg'),
(2, 12, 1, 'Sie Acara', 'Intan Purnama Alam', 'intanpurnama@gmail.com', '08956565656', '0080b049fa1d50400fc9037b4be815.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_pembayaran`
--

DROP TABLE IF EXISTS `event_pembayaran`;
CREATE TABLE IF NOT EXISTS `event_pembayaran` (
  `id_event_pembayaran` int(20) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `id_event_kategori` int(20) NOT NULL,
  `id_peserta` int(20) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `kode_kupon` varchar(30) DEFAULT NULL,
  `metode_pembayaran` varchar(30) NOT NULL COMMENT '1.Online\r\n2.Offline',
  `harga` varchar(30) NOT NULL,
  `biaya_adm` int(20) DEFAULT NULL,
  `diskon` varchar(30) DEFAULT NULL,
  `tagihan` int(20) NOT NULL,
  `status` varchar(30) NOT NULL COMMENT 'Pending,\r\nLunas,\r\nBatal,\r\nExpired',
  `kode_transaksi` text NOT NULL COMMENT 'Kode unik untuk konek ke midtrans',
  PRIMARY KEY (`id_event_pembayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_pembayaran`
--

INSERT INTO `event_pembayaran` (`id_event_pembayaran`, `id_event_setting`, `id_event_kategori`, `id_peserta`, `tanggal`, `kode_kupon`, `metode_pembayaran`, `harga`, `biaya_adm`, `diskon`, `tagihan`, `status`, `kode_transaksi`) VALUES
(1, 12, 1, 7, '2023-10-01 23:30', 'Dap1ajeOm1inY1Sy', 'Online', '700000', NULL, '10', 630000, 'Lunas', ''),
(4, 12, 1, 8, '2023-10-07 03:40', 'Dap1ajeOm1inY1Sy', 'Online', '700000', NULL, '0', 700000, 'Lunas', 'KDT-8-12-1'),
(7, 12, 1, 13, '2023-10-03 11:11', '', 'Online', '700000', NULL, '', 700000, 'Lunas', 'KDT-13-12-1'),
(8, 12, 2, 23, '2023-10-04 21:22', '', 'Online', '1250000', NULL, '0', 1250000, 'Pending', 'KDT-23-12-2'),
(9, 12, 2, 22, '2023-10-06 00:51', '', 'Online', '1250000', NULL, '0', 1250000, 'Pending', 'KDT-22-12-2'),
(10, 12, 1, 25, '2023-10-07 03:43', '', 'Online', '700000', NULL, '0', 700000, 'Lunas', 'KDT-25-12-1'),
(16, 12, 1, 27, '2023-10-07 06:03', 'Fw2bW1GKBKGtpfy5', 'Online', '700000', NULL, '15', 595000, 'Lunas', 'KDT-27-12-1'),
(17, 12, 1, 28, '2023-10-07 06:10', 'P9v2TkB9p4DEUwKR', 'Online', '700000', NULL, '15', 595000, 'Pending', 'KDT-28-12-1'),
(19, 12, 1, 9, '2023-10-07 21:36', '6Jh8907XJitcgtZ8', 'Online', '700000', 5000, '15', 600000, 'Pending', 'KDT-9-12-1'),
(20, 12, 1, 29, '2023-10-07 21:39', '4Se9bp1yXN59rHNB', 'Online', '700000', 5000, '15', 600000, 'Pending', 'KDT-29-12-1'),
(21, 12, 2, 30, '2023-10-07 21:48', '', 'Online', '1250000', 5000, '0', 1255000, 'Lunas', 'KDT-30-12-2'),
(24, 12, 1, 31, '2023-10-07 22:22', 'SBLmBxTH8dxJib9D', 'Online', '700000', 5000, '10', 635000, 'Pending', 'KDT-31-12-1'),
(26, 12, 1, 10, '2023-10-08 01:15', 'LpU2GsiZZvKv5xM7', 'Online', '700000', 5000, '10', 635000, 'Pending', 'KDT-10-12-1');

-- --------------------------------------------------------

--
-- Table structure for table `event_pengisi_acara`
--

DROP TABLE IF EXISTS `event_pengisi_acara`;
CREATE TABLE IF NOT EXISTS `event_pengisi_acara` (
  `id_event_pengisi_acara` int(10) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(10) NOT NULL,
  `nama` text NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `kategori` text NOT NULL COMMENT 'Pemateri, Moderator',
  `organization` text NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY (`id_event_pengisi_acara`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_pengisi_acara`
--

INSERT INTO `event_pengisi_acara` (`id_event_pengisi_acara`, `id_event_setting`, `nama`, `kontak`, `email`, `kategori`, `organization`, `foto`) VALUES
(1, 12, 'dr Laudry', '0895465646', 'laudry@gmail.com', 'Moderator', 'Penyakit Dalam', ''),
(2, 12, 'dr H. Elly Nursyam', '0895565454343', 'elly1234@gmail.com', 'Pemateri', 'PDP', ''),
(3, 12, 'Windy Yanuariska', '08955675656', 'windygiga@gmail.com', 'Moderator', 'El-Syifa', '9ff2eb1dc9dd5ddee67d1a85307880.jpg'),
(5, 12, 'Rezha Alacahayu', '089677685778', 'rezha@gmail.com', 'Moderator', 'SIMRS', '5a8ad08ce0f38fa9f9d6213e2ebdc8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_peserta`
--

DROP TABLE IF EXISTS `event_peserta`;
CREATE TABLE IF NOT EXISTS `event_peserta` (
  `id_peserta` int(20) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `id_event_kategori` int(20) NOT NULL,
  `tanggal_daftar` varchar(30) NOT NULL,
  `nama` text NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `organization` text NOT NULL,
  `password` text NOT NULL,
  `status_validasi` varchar(30) NOT NULL COMMENT '1.Pending\r\n2.Valid',
  `status_pembayaran` varchar(30) NOT NULL COMMENT '1.Pending\r\n2.Lunas\r\n3.Expired',
  `alamat` text,
  `kota` text,
  `kode_pos` varchar(20) DEFAULT NULL,
  `link_validasi` text,
  `link_payment` text,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_peserta`
--

INSERT INTO `event_peserta` (`id_peserta`, `id_event_setting`, `id_event_kategori`, `tanggal_daftar`, `nama`, `kontak`, `email`, `organization`, `password`, `status_validasi`, `status_pembayaran`, `alamat`, `kota`, `kode_pos`, `link_validasi`, `link_payment`) VALUES
(6, 12, 2, '2023-10-01 07:10', 'Santi Nursari', '088927627283', 'santinursari@gmail.com', 'RSU El-Syifa', 'f4a3229c9c5f1bdd9c6a6791080791b7', 'Pending', 'Pending', '', '', '', '', ''),
(8, 12, 1, '2023-10-01 23:36', 'Bayu Anugerah', '089566575678', 'bayuanugerah@gmail.com', 'RSU El-Syifa', 'cfd111106dc95e430bf5eff5f2d71b87', 'Valid', 'Lunas', '', '', '', '', ''),
(9, 12, 1, '2023-10-02 00:34', 'Andi Rahmat', '089346474748', 'andi@gmail.com', 'Uniku', 'fd7dcc187bdf3546e8375ed6bc398f87', 'Pending', 'Pending', '', '', '', '', ''),
(10, 12, 1, '2023-10-02 05:12', 'Aruna Parasilva Nursari', '0896686748847', 'animaryani@gmail.com', 'Uniku', '1ebc7a02439687420f4f18ebe6bd03ac', 'Valid', 'Pending', '', '', '', '', ''),
(13, 12, 1, '2023-10-02 22:01:', 'Syamsul Maarif', '089667768578', 'syamsul@gmail.com', 'RSU El-Syifa', '564d5ea829ce8977fb848c0a654c7888', 'Pending', 'Pending', '', '', '', '', ''),
(22, 12, 2, '2023-10-03 00:22:', 'Solihul Hadin', '089601154726', 'dhiforester@gmail.com', 'RSU El-Syifa', 'f4a3229c9c5f1bdd9c6a6791080791b7', 'Valid', 'Pending', 'jalan anggrek 4 nomo 15 Ciporang', 'Kuningan', '45514', 'https://google.com', 'https://google.com'),
(23, 12, 2, '2023-10-04 20:48', 'Endang', '09238393', 'animaryani2@gmail.com', 'El-syifa', '1ebc7a02439687420f4f18ebe6bd03ac', 'Pending', 'Pending', 'jalan re martadinata', 'Kuningan', '45514', '', ''),
(30, 12, 2, '2023-10-07 21:42', 'Bconcept Abc', '0896775857', 'bconceptproject88@gmail.com', 'Kuningan', 'bc97a03702fc793c9a8c9d117ece2f2d', 'Pending', 'Lunas', 'Kuningan', 'Kuningan', '45514', '', ''),
(31, 12, 1, '2023-10-07 21:51', 'Windy Yanuariska', '089601154726', 'solihulhadi141213@gmail.com', 'RSU El-Syifa', 'a2cc01a152da09c1ad15b345e430ed7d', 'Valid', 'Pending', 'jalan anggrek 4 nomo 15 Ciporang', 'Kuningan', '45514', 'https://google.com', 'https://google.com');

-- --------------------------------------------------------

--
-- Table structure for table `event_sertifikat`
--

DROP TABLE IF EXISTS `event_sertifikat`;
CREATE TABLE IF NOT EXISTS `event_sertifikat` (
  `id_event_sertifikat` int(20) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `id_setting_sertifikat` int(20) NOT NULL,
  `id_person` int(20) DEFAULT NULL COMMENT 'id_peserta, id_panitia, id_pengisi_acara',
  `nama` text NOT NULL COMMENT 'nama peserta, panitia, moderator, pemateri',
  `kategori_sertifikat` text NOT NULL COMMENT 'Peserta, Moderator, Panitia',
  `group_name` text NOT NULL COMMENT 'Sesuai setting sertifikat',
  `kode_idi` text NOT NULL COMMENT 'hanya apabila ada',
  `token` text NOT NULL,
  PRIMARY KEY (`id_event_sertifikat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_sesi_absen`
--

DROP TABLE IF EXISTS `event_sesi_absen`;
CREATE TABLE IF NOT EXISTS `event_sesi_absen` (
  `id_event_sesi_absen` int(20) NOT NULL AUTO_INCREMENT,
  `id_event_setting` int(20) NOT NULL,
  `label_sesi` text NOT NULL,
  `tanggal_mulai` varchar(30) NOT NULL COMMENT 'strtotime',
  `tanggal_selesai` varchar(30) NOT NULL COMMENT 'strtotime',
  PRIMARY KEY (`id_event_sesi_absen`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_sesi_absen`
--

INSERT INTO `event_sesi_absen` (`id_event_sesi_absen`, `id_event_setting`, `label_sesi`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(3, 12, 'Absensi Pagi', '2023-10-04 13:00', '2023-10-04 23:30'),
(4, 12, 'Absensi Siang', '2023-10-02 04:30', '2023-10-02 05:00');

-- --------------------------------------------------------

--
-- Table structure for table `event_setting`
--

DROP TABLE IF EXISTS `event_setting`;
CREATE TABLE IF NOT EXISTS `event_setting` (
  `id_event_setting` int(15) NOT NULL AUTO_INCREMENT,
  `tanggal_mulai` varchar(30) NOT NULL COMMENT 'Y-m-d H:i',
  `tanggal_selesai` varchar(30) NOT NULL COMMENT 'Y-m-d H:i',
  `mulai_pendaftaran` varchar(30) NOT NULL COMMENT 'Y-m-d H:i',
  `selesai_pendaftaran` varchar(30) NOT NULL COMMENT 'Y-m-d H:i',
  `nama_event` text NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(20) NOT NULL COMMENT '1. Active\r\n2. Non-Active',
  PRIMARY KEY (`id_event_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_setting`
--

INSERT INTO `event_setting` (`id_event_setting`, `tanggal_mulai`, `tanggal_selesai`, `mulai_pendaftaran`, `selesai_pendaftaran`, `nama_event`, `keterangan`, `status`) VALUES
(9, '2023-11-01 08:00', '2023-11-03 08:00', '2023-10-01 08:00', '2023-10-31 08:00', 'Seminar Covid', 'Kegiatan ini dihadiri oleh dokter spesialis penyakit dalam, dan dokter umum, di Wilayah Kabupaten Kuningan dan Cirebon, yang menghadirkan tenaga ahli Internist. ', 'Rencana'),
(10, '2023-11-01 08:00', '2023-11-02 08:00', '2023-10-01 08:00', '2023-10-31 08:00', 'Lomba Slot', 'Kegiatan ini dihadiri oleh dokter spesialis penyakit dalam, dan dokter umum, di Wilayah Kabupaten Kuningan dan Cirebon, yang menghadirkan tenaga ahli Internist. ', 'Berlangsung'),
(11, '2023-11-01 08:00', '2023-11-02 12:00', '2023-10-01 08:00', '2023-10-31 12:00', 'Lomba Gapleh', 'Kegiatan ini dihadiri oleh dokter spesialis penyakit dalam, dan dokter umum, di Wilayah Kabupaten Kuningan dan Cirebon, yang menghadirkan tenaga ahli Internist. ', 'Berlangsung'),
(12, '2023-11-01 08:00', '2023-11-02 08:00', '2023-09-01 08:00', '2023-10-31 08:00', 'Comprehensive Care in Internal Medicine Toward Post Pandemic Era', 'Kegiatan ini dihadiri oleh dokter spesialis penyakit dalam, dan dokter umum, di Wilayah Kabupaten Kuningan dan Cirebon, yang menghadirkan tenaga ahli Internist. ', 'Rencana');

-- --------------------------------------------------------

--
-- Table structure for table `event_tamplate`
--

DROP TABLE IF EXISTS `event_tamplate`;
CREATE TABLE IF NOT EXISTS `event_tamplate` (
  `id_event_tamplate` int(15) NOT NULL AUTO_INCREMENT,
  `id_event` int(15) NOT NULL,
  `id_tamplate` int(15) DEFAULT NULL,
  `undangan` longtext NOT NULL,
  PRIMARY KEY (`id_event_tamplate`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_tamplate`
--

INSERT INTO `event_tamplate` (`id_event_tamplate`, `id_event`, `id_tamplate`, `undangan`) VALUES
(1, 6, 4, '<p>Dengan hormat,</p>\n<p>Dalam rangka pelaksanaan proses penyusunan kebijakan tentang Manajemen Talenta Nasional, diperlukan perspektif bersama lintas sektoral, khususnya pada sektor pemerintahan daerah. Oleh karena itu, bersama ini dengan hormat kami mengundang Saudara atau pejabat yang ditunjuk yang menangani bidang pembinaan kepegawaian sebanyak 3 (dua) orang untuk hadir pada Rapat Koordinasi Penyusunan Kebijakan Manajemen Talenta Nasional dengan tema &ldquo;ASN Berkelas Dunia: Indonesia Membangun Manajemen Talenta Nasional&rdquo;, yang akan dilaksanakan pada:</p>\n<p>Hari, tanggal &nbsp; &nbsp;: Senin, 29 Maret 2021<br />Waktu &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: Pukul 10.00 WIB &ndash; selesai (dimohon untuk hadir sesuai jadwal yang tertera)<br />Tempat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: Hotel Mulia Senayan, Jalan Asia Afrika Senayan, Jakarta Pusat, DKI Jakarta 10270</p>\n<p>Untuk konfirmasi kehadiran, dapat menghubungi Alif Gibran (082145823649). Kami mengharapkan kehadiran Saudara tepat pada waktunya mengingat pentingnya kehadiran Saudara untuk rapat ini.</p>\n<p>Atas perhatian dan kehadiran Saudara, kami ucapkan terima kasih</p>\n<p><input id=\"ext\" type=\"hidden\" value=\"1\" /></p>'),
(2, 7, 3, '<p>aaa</p>\n<p><input id=\"ext\" type=\"hidden\" value=\"1\" /></p>\n<p>&nbsp;</p>\n<p><input id=\"ext\" type=\"hidden\" value=\"1\" /></p>\n<p>&nbsp;</p>\n<p><input id=\"ext\" type=\"hidden\" value=\"1\" /></p>');

-- --------------------------------------------------------

--
-- Table structure for table `event_undangan`
--

DROP TABLE IF EXISTS `event_undangan`;
CREATE TABLE IF NOT EXISTS `event_undangan` (
  `id_event_undangan` int(15) NOT NULL AUTO_INCREMENT,
  `id_event` int(15) NOT NULL,
  `id_akses` int(15) DEFAULT NULL,
  `id_unit_kerja` int(15) DEFAULT NULL,
  `in_ex` varchar(25) NOT NULL,
  `nama` text NOT NULL,
  `unit_instansi` text,
  `kontak` varchar(20) DEFAULT NULL,
  `email` text,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_event_undangan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_undangan`
--

INSERT INTO `event_undangan` (`id_event_undangan`, `id_event`, `id_akses`, `id_unit_kerja`, `in_ex`, `nama`, `unit_instansi`, `kontak`, `email`, `status`) VALUES
(3, 6, 0, 0, 'Eksternal', 'Syamsul Maarif', 'BPJS', '1223123', 'syamsul@gmail.com', 'None'),
(4, 6, 0, 0, 'Eksternal', 'Didi Muhadi', 'BPJS', '12444444', 'didi123@gmail.com', 'None'),
(6, 6, 39, 0, 'Internal', 'animaryani', 'None', '123123111', 'animaryani123@gmail.com', 'None'),
(9, 6, 36, 2, 'Internal', 'windy yanuariska', 'HRD', '341234324', 'windygiga123@gmail.com', 'None'),
(11, 6, 37, 0, 'Internal', 'Aruna Parasilva', 'None', '089454673783', 'aruna@gmail.com', 'None'),
(12, 6, 38, 0, 'Internal', 'fsfdsfsdf', 'None', '123123', 'animaryani@gmail.com', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `event_validasi`
--

DROP TABLE IF EXISTS `event_validasi`;
CREATE TABLE IF NOT EXISTS `event_validasi` (
  `id_event_validasi` int(10) NOT NULL AUTO_INCREMENT,
  `id_peserta` int(10) NOT NULL,
  `token` text NOT NULL,
  `datetime` text NOT NULL,
  `status` varchar(30) NOT NULL COMMENT '1.Belum Digunakan\r\n2.Digunakan',
  PRIMARY KEY (`id_event_validasi`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_validasi`
--

INSERT INTO `event_validasi` (`id_event_validasi`, `id_peserta`, `token`, `datetime`, `status`) VALUES
(5, 22, '1A4pBn', '2023-10-03 00:24', 'Digunakan'),
(6, 24, 'S5L1lu', '2023-10-04 21:10', 'Belum Digunakan'),
(7, 22, 'J4cQyh', '2023-10-06 00:34', 'Belum Digunakan'),
(8, 22, 'NnCCeH', '2023-10-06 00:35', 'Belum Digunakan'),
(9, 25, 'IdWGCi', '2023-10-06 21:40', 'Belum Digunakan'),
(10, 26, '85LmUN', '2023-10-07 04:25', 'Belum Digunakan'),
(11, 27, 'fsJSfN', '2023-10-07 04:34', 'Belum Digunakan'),
(12, 28, 'U6bM5p', '2023-10-07 06:08', 'Belum Digunakan'),
(13, 29, 'aYkoSL', '2023-10-07 06:30', 'Belum Digunakan'),
(14, 31, '1vLa9O', '2023-10-07 21:51', 'Belum Digunakan');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

DROP TABLE IF EXISTS `help`;
CREATE TABLE IF NOT EXISTS `help` (
  `id_help` int(10) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `category` text NOT NULL,
  `description` longtext NOT NULL,
  `datetime` varchar(25) NOT NULL,
  PRIMARY KEY (`id_help`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(10) NOT NULL AUTO_INCREMENT,
  `id_akses` int(10) NOT NULL,
  `datetime_log` varchar(25) NOT NULL,
  `kategori_log` varchar(20) NOT NULL,
  `deskripsi_log` text NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=420 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_akses`, `datetime_log`, `kategori_log`, `deskripsi_log`) VALUES
(1, 1, '2022-09-11 01:24:20', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(2, 1, '2022-09-11 01:24:20', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(3, 1, '2022-09-11 21:58:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(4, 1, '2022-09-11 21:58:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(5, 1, '2022-09-11 22:15:18', 'Input Transaksi', 'Input Transaksi  17 Berhasil'),
(6, 1, '2022-09-17 16:40:56', 'Input Transaksi', 'Input Transaksi  17 Berhasil'),
(7, 1, '2022-09-21 23:05:16', 'Input Form Setting', 'Input Form Setting Berhasil'),
(8, 1, '2022-09-21 23:27:53', 'Update Form Setting', 'Update Form Setting Berhasil'),
(9, 1, '2022-09-21 23:29:00', 'Update Form Setting', 'Update Form Setting Berhasil'),
(10, 1, '2022-09-21 23:53:28', 'Input Form Setting', 'Input Form Setting Berhasil'),
(11, 1, '2022-09-21 23:54:20', 'Input Form Setting', 'Input Form Setting Berhasil'),
(12, 1, '2022-09-25 05:17:18', 'Input Akses Baru', 'Input Akses Baru Berhasil'),
(13, 1, '2022-09-25 05:24:44', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(14, 1, '2022-09-25 05:24:44', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(15, 1, '2022-09-25 05:24:44', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(16, 1, '2022-09-25 05:25:14', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(17, 1, '2022-09-25 05:25:14', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(18, 1, '2022-09-25 05:25:14', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(19, 1, '2022-09-25 05:25:14', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(20, 1, '2022-09-25 05:27:01', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(21, 1, '2022-09-25 05:30:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(22, 1, '2022-09-25 05:30:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(23, 1, '2022-09-25 06:16:25', 'Input Akses Baru', 'Input Akses Baru Berhasil'),
(24, 1, '2022-09-25 20:53:20', 'Input Mitra Baru', 'Input Mitra Baru Berhasil'),
(25, 1, '2022-09-25 20:54:44', 'Input Mitra Baru', 'Input Mitra Baru Berhasil'),
(26, 1, '2022-09-25 20:59:17', 'Input Mitra Baru', 'Input Mitra Baru Berhasil'),
(27, 1, '2022-09-25 21:00:23', 'Input Mitra Baru', 'Input Mitra Baru Berhasil'),
(28, 1, '2022-09-25 22:00:44', 'Input Akses Baru', 'Input Akses Baru Berhasil'),
(29, 1, '2022-09-26 00:22:12', 'Input API Key', 'Input API Key Berhasil'),
(30, 1, '2022-09-26 00:22:23', 'Input API Key', 'Input API Key Berhasil'),
(31, 1, '2022-09-26 00:23:55', 'Input API Key', 'Input API Key Berhasil'),
(32, 1, '2022-09-26 00:24:05', 'Input API Key', 'Input API Key Berhasil'),
(33, 1, '2022-09-26 00:32:38', 'Update API Key', 'Update API Key Berhasil'),
(34, 1, '2022-09-26 00:33:46', 'Update API Key', 'Update API Key Berhasil'),
(35, 1, '2022-09-26 00:33:46', 'Update API Key', 'Update API Key Berhasil'),
(36, 1, '2022-09-26 00:34:14', 'Update API Key', 'Update API Key Berhasil'),
(37, 1, '2022-09-26 00:34:14', 'Update API Key', 'Update API Key Berhasil'),
(38, 1, '2022-09-26 00:34:14', 'Update API Key', 'Update API Key Berhasil'),
(39, 1, '2022-09-26 00:37:26', 'Update API Key', 'Update API Key Berhasil'),
(40, 1, '2022-09-26 00:37:26', 'Update API Key', 'Update API Key Berhasil'),
(41, 1, '2022-09-26 00:37:31', 'Update API Key', 'Update API Key Berhasil'),
(42, 1, '2022-09-26 00:37:31', 'Update API Key', 'Update API Key Berhasil'),
(43, 1, '2022-09-26 00:37:31', 'Update API Key', 'Update API Key Berhasil'),
(44, 1, '2022-09-26 00:37:36', 'Update API Key', 'Update API Key Berhasil'),
(45, 1, '2022-09-26 00:37:36', 'Update API Key', 'Update API Key Berhasil'),
(46, 1, '2022-09-26 00:37:36', 'Update API Key', 'Update API Key Berhasil'),
(47, 1, '2022-09-26 00:37:36', 'Update API Key', 'Update API Key Berhasil'),
(48, 1, '2022-09-26 23:14:15', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(49, 1, '2022-09-26 23:14:41', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(50, 1, '2022-09-26 23:15:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(51, 1, '2022-09-26 23:15:22', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(52, 1, '2022-09-26 23:15:44', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(53, 1, '2022-09-27 00:59:55', 'Input Supplier Baru', 'Input Supplier Baru Berhasil'),
(54, 1, '2022-09-27 01:00:19', 'Input Supplier Baru', 'Input Supplier Baru Berhasil'),
(55, 1, '2022-09-27 01:01:02', 'Input Supplier Baru', 'Input Supplier Baru Berhasil'),
(56, 1, '2022-09-27 01:01:26', 'Input Supplier Baru', 'Input Supplier Baru Berhasil'),
(57, 1, '2022-09-27 01:03:48', 'Input Supplier Baru', 'Input Supplier Baru Berhasil'),
(58, 1, '2022-09-27 01:17:49', 'Input Barang Baru', 'Input Barang Berhasil'),
(59, 1, '2022-09-27 01:18:56', 'Input Barang Baru', 'Input Barang Berhasil'),
(60, 1, '2022-09-29 00:13:09', 'Input Transaksi', 'Input Transaksi  19 Berhasil'),
(61, 1, '2022-09-29 00:14:23', 'Input Transaksi', 'Input Transaksi  20 Berhasil'),
(62, 1, '2022-09-29 22:47:21', 'Input Transaksi', 'Input Transaksi  21 Berhasil'),
(63, 1, '2022-09-29 22:59:33', 'Input Transaksi', 'Input Transaksi  22 Berhasil'),
(64, 1, '2022-09-29 23:05:31', 'Input Transaksi', 'Input Transaksi  23 Berhasil'),
(65, 1, '2022-09-29 23:20:31', 'Input Transaksi', 'Input Transaksi  24 Berhasil'),
(66, 1, '2022-09-29 23:26:46', 'Input Transaksi', 'Input Transaksi  25 Berhasil'),
(67, 1, '2022-09-30 22:29:44', 'Input Transaksi', 'Input Transaksi  26 Berhasil'),
(68, 1, '2022-09-30 23:39:14', 'Input Transaksi', 'Input Transaksi  27 Berhasil'),
(69, 1, '2022-10-01 16:48:24', 'Input Transaksi', 'Input Transaksi  28 Berhasil'),
(70, 1, '2022-10-01 19:19:57', 'Edit Transaksi', 'Edit Transaksi  28 Berhasil'),
(71, 1, '2022-10-01 19:20:46', 'Edit Transaksi', 'Edit Transaksi  28 Berhasil'),
(72, 1, '2022-10-01 19:20:56', 'Edit Transaksi', 'Edit Transaksi  28 Berhasil'),
(73, 6, '2022-10-15 15:30:10', 'Input Transaksi', 'Input Transaksi  29 Berhasil'),
(74, 1, '2022-10-15 16:22:21', 'Input Transaksi', 'Input Transaksi  30 Berhasil'),
(75, 1, '2022-10-15 16:24:10', 'Input Transaksi', 'Input Transaksi  31 Berhasil'),
(76, 1, '2022-10-15 16:33:07', 'Input Transaksi', 'Input Transaksi  32 Berhasil'),
(77, 1, '2022-10-15 16:44:36', 'Input Form Setting', 'Input Form Setting Berhasil'),
(78, 1, '2022-11-10 22:26:37', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(79, 1, '2022-11-10 22:26:52', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(80, 1, '2022-11-10 22:26:52', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(81, 1, '2022-11-11 18:47:54', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(82, 1, '2022-11-11 18:47:54', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(83, 1, '2022-11-11 18:48:58', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(84, 1, '2022-11-11 18:49:17', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(85, 1, '2022-11-11 18:49:34', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(86, 1, '2022-11-11 18:49:38', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(87, 1, '2022-11-11 18:49:38', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(88, 1, '2022-11-11 18:49:44', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(89, 1, '2022-11-11 18:49:44', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(90, 1, '2022-11-11 18:49:44', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(91, 1, '2022-11-14 14:39:03', 'Input Form Setting', 'Input Form Setting Berhasil'),
(92, 1, '2022-11-14 14:39:14', 'Input Form Setting', 'Input Form Setting Berhasil'),
(93, 1, '2022-11-14 14:54:42', 'Update Form Setting', 'Update Form Setting Berhasil'),
(94, 1, '2022-11-14 14:54:55', 'Update Form Setting', 'Update Form Setting Berhasil'),
(95, 1, '2022-11-17 22:51:08', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(96, 1, '2022-11-17 22:56:02', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(97, 1, '2022-11-17 22:56:02', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(98, 1, '2022-11-17 22:59:45', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(99, 1, '2022-11-17 23:06:46', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(100, 1, '2022-11-18 22:42:48', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(101, 1, '2022-11-18 22:47:37', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(102, 1, '2022-11-19 18:04:01', 'Edit Data Dukungan', 'Edit Data Dukungan Berhasil'),
(103, 1, '2022-11-20 02:42:17', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(104, 1, '2022-11-20 04:32:36', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(105, 1, '2022-11-20 16:32:43', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(106, 1, '2022-11-20 16:43:28', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(107, 1, '2022-11-20 21:00:57', 'Tambah Event', 'Tambah Event Berhasil'),
(108, 1, '2022-11-20 21:17:12', 'Tambah Event', 'Tambah Event Berhasil'),
(109, 1, '2022-11-20 22:07:27', 'Tambah Event', 'Tambah Event Berhasil'),
(110, 1, '2022-11-20 22:07:52', 'Tambah Event', 'Tambah Event Berhasil'),
(111, 1, '2022-11-20 22:07:52', 'Tambah Event', 'Tambah Event Berhasil'),
(112, 1, '2022-11-20 22:09:58', 'Tambah Event', 'Tambah Event Berhasil'),
(113, 1, '2022-11-20 22:29:49', 'Edit Event', 'Edit Event Berhasil'),
(114, 1, '2022-11-20 22:30:01', 'Edit Event', 'Edit Event Berhasil'),
(115, 1, '2022-11-20 22:30:23', 'Edit Event', 'Edit Event Berhasil'),
(116, 1, '2022-11-20 22:30:23', 'Edit Event', 'Edit Event Berhasil'),
(117, 1, '2022-11-20 22:30:29', 'Edit Event', 'Edit Event Berhasil'),
(118, 1, '2022-11-20 22:30:29', 'Edit Event', 'Edit Event Berhasil'),
(119, 1, '2022-11-20 22:30:42', 'Edit Event', 'Edit Event Berhasil'),
(120, 1, '2022-11-26 19:40:41', 'Edit Undangan Event', 'Edit Undangan Event Berhasil'),
(121, 1, '2022-11-27 01:43:13', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(122, 1, '2022-11-27 01:43:14', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(123, 1, '2022-11-27 01:47:26', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(124, 1, '2022-11-27 01:47:58', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(125, 1, '2022-11-27 01:47:58', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(126, 1, '2022-11-27 01:50:20', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(127, 1, '2022-11-27 01:50:47', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(128, 1, '2022-11-27 01:50:47', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(129, 1, '2022-11-27 01:51:48', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(130, 1, '2022-11-27 01:51:48', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(131, 1, '2022-11-27 01:51:48', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(132, 1, '2022-11-27 01:51:48', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(133, 1, '2022-11-27 02:02:31', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(134, 1, '2022-11-27 02:02:55', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(135, 1, '2022-11-27 03:02:34', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(136, 1, '2022-11-27 03:02:56', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(137, 1, '2022-11-27 03:11:17', 'Input Absen Baru', 'Input Absen Baru Berhasil'),
(138, 1, '2022-11-27 18:40:33', 'Input File Baru', 'Input File Baru Berhasil'),
(139, 1, '2022-11-27 18:41:55', 'Input File Baru', 'Input File Baru Berhasil'),
(140, 1, '2022-11-27 18:49:47', 'Input File Baru', 'Input File Baru Berhasil'),
(141, 1, '2022-11-27 18:49:47', 'Input File Baru', 'Input File Baru Berhasil'),
(142, 1, '2022-11-27 18:54:44', 'Input File Baru', 'Input File Baru Berhasil'),
(143, 1, '2022-11-27 19:27:49', 'Hapus File Event', 'Hapus File Event Berhasil'),
(144, 1, '2022-11-27 19:27:52', 'Hapus File Event', 'Hapus File Event Berhasil'),
(145, 1, '2022-11-27 19:27:52', 'Hapus File Event', 'Hapus File Event Berhasil'),
(146, 1, '2022-11-27 19:27:56', 'Hapus File Event', 'Hapus File Event Berhasil'),
(147, 1, '2022-11-27 19:27:56', 'Hapus File Event', 'Hapus File Event Berhasil'),
(148, 1, '2022-11-27 19:27:56', 'Hapus File Event', 'Hapus File Event Berhasil'),
(149, 1, '2022-11-27 19:27:58', 'Hapus File Event', 'Hapus File Event Berhasil'),
(150, 1, '2022-11-27 19:27:58', 'Hapus File Event', 'Hapus File Event Berhasil'),
(151, 1, '2022-11-27 19:27:58', 'Hapus File Event', 'Hapus File Event Berhasil'),
(152, 1, '2022-11-27 19:27:58', 'Hapus File Event', 'Hapus File Event Berhasil'),
(153, 1, '2022-11-27 20:54:03', 'Input File Baru', 'Input File Baru Berhasil'),
(154, 1, '2022-11-27 20:58:51', 'Input File Baru', 'Input File Baru Berhasil'),
(155, 1, '2022-11-27 22:34:11', 'Edit File Event', 'Edit File Event Berhasil'),
(156, 1, '2022-11-27 22:34:11', 'Edit File Event', 'Edit File Event Berhasil'),
(157, 1, '2022-11-27 22:34:16', 'Edit File Event', 'Edit File Event Berhasil'),
(158, 1, '2022-11-27 22:34:16', 'Edit File Event', 'Edit File Event Berhasil'),
(159, 1, '2022-11-27 22:34:16', 'Edit File Event', 'Edit File Event Berhasil'),
(160, 1, '2022-11-27 22:34:25', 'Edit File Event', 'Edit File Event Berhasil'),
(161, 1, '2022-11-27 22:34:30', 'Edit File Event', 'Edit File Event Berhasil'),
(162, 1, '2022-11-27 22:34:30', 'Edit File Event', 'Edit File Event Berhasil'),
(163, 1, '2022-11-27 22:36:03', 'Input File Baru', 'Input File Baru Berhasil'),
(164, 1, '2022-11-27 22:36:17', 'Input File Baru', 'Input File Baru Berhasil'),
(165, 1, '2022-11-27 22:36:17', 'Input File Baru', 'Input File Baru Berhasil'),
(166, 1, '2022-11-27 22:38:23', 'Hapus File Event', 'Hapus File Event Berhasil'),
(167, 1, '2022-11-27 22:38:26', 'Hapus File Event', 'Hapus File Event Berhasil'),
(168, 1, '2022-11-27 22:38:26', 'Hapus File Event', 'Hapus File Event Berhasil'),
(169, 1, '2022-11-27 22:38:30', 'Edit File Event', 'Edit File Event Berhasil'),
(170, 1, '2022-11-27 22:38:35', 'Edit File Event', 'Edit File Event Berhasil'),
(171, 1, '2022-11-27 22:38:35', 'Edit File Event', 'Edit File Event Berhasil'),
(172, 1, '2022-11-27 22:38:50', 'Input File Baru', 'Input File Baru Berhasil'),
(173, 1, '2022-11-27 22:39:08', 'Input File Baru', 'Input File Baru Berhasil'),
(174, 1, '2022-11-28 18:50:53', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(175, 1, '2022-11-28 19:00:04', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(176, 1, '2022-11-28 19:01:31', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(177, 1, '2022-11-28 19:07:19', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(178, 1, '2022-11-28 19:07:43', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(179, 1, '2022-11-29 22:33:52', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(180, 1, '2022-11-29 22:34:30', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(181, 1, '2022-11-29 22:50:38', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(182, 1, '2022-11-29 22:50:58', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(183, 1, '2022-11-29 22:53:52', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(184, 1, '2022-11-29 22:54:16', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(185, 1, '2022-11-29 23:06:26', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(186, 1, '2022-11-30 19:31:57', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(187, 1, '2022-11-30 19:31:57', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(188, 1, '2022-12-02 20:51:25', 'Waktu Henti', 'Input Waktu Henti'),
(189, 1, '2022-12-02 20:52:35', 'Waktu Henti', 'Input Waktu Henti'),
(190, 1, '2022-12-02 21:03:32', 'Waktu Henti', 'Input Waktu Henti'),
(191, 1, '2022-12-02 21:31:34', 'Waktu Henti', 'Input Waktu Henti'),
(192, 1, '2022-12-02 21:36:27', 'Waktu Henti', 'Input Waktu Henti'),
(193, 1, '2022-12-02 21:38:13', 'Waktu Henti', 'Input Waktu Henti'),
(194, 1, '2022-12-02 21:42:14', 'Waktu Henti', 'Input Waktu Henti'),
(195, 1, '2022-12-02 22:05:46', 'Waktu Henti', 'Edit Waktu Henti Berhasil'),
(196, 1, '2022-12-02 22:07:42', 'Waktu Henti', 'Edit Waktu Henti Berhasil'),
(197, 1, '2022-12-02 22:07:50', 'Waktu Henti', 'Edit Waktu Henti Berhasil'),
(198, 1, '2022-12-02 22:07:50', 'Waktu Henti', 'Edit Waktu Henti Berhasil'),
(199, 1, '2022-12-02 22:08:10', 'Waktu Henti', 'Edit Waktu Henti Berhasil'),
(200, 1, '2022-12-02 22:08:10', 'Waktu Henti', 'Edit Waktu Henti Berhasil'),
(201, 1, '2022-12-02 22:08:10', 'Waktu Henti', 'Edit Waktu Henti Berhasil'),
(202, 1, '2022-12-02 23:55:46', 'Waktu Henti', 'Input Waktu Henti'),
(203, 1, '2022-12-08 21:03:34', 'Inventaris', 'Input Inventaris Baru Berhasil'),
(204, 1, '2022-12-08 21:18:26', 'Inventaris', 'Input Inventaris Baru Berhasil'),
(205, 1, '2022-12-08 21:37:35', 'Inventaris', 'Input Inventaris Baru Berhasil'),
(206, 1, '2022-12-08 21:46:15', 'Inventaris', 'Input Inventaris Baru Berhasil'),
(207, 1, '2022-12-08 21:47:14', 'Inventaris', 'Input Inventaris Baru Berhasil'),
(208, 1, '2022-12-08 22:26:30', 'Inventaris', 'Edit Inventaris Berhasil'),
(209, 1, '2022-12-08 22:27:09', 'Inventaris', 'Edit Inventaris Berhasil'),
(210, 1, '2022-12-08 22:27:17', 'Inventaris', 'Edit Inventaris Berhasil'),
(211, 1, '2022-12-08 22:28:03', 'Inventaris', 'Edit Inventaris Berhasil'),
(212, 1, '2022-12-08 22:28:03', 'Inventaris', 'Edit Inventaris Berhasil'),
(213, 1, '2022-12-08 22:28:03', 'Inventaris', 'Edit Inventaris Berhasil'),
(214, 1, '2022-12-09 23:53:35', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(215, 1, '2022-12-10 17:42:20', 'Edit Unit Kerja', 'Edit Unit Kerja Berhasil'),
(216, 1, '2022-12-10 22:31:37', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(217, 1, '2022-12-10 22:35:58', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(218, 41, '2022-12-13 14:25:14', 'Tambah Event', 'Tambah Event Berhasil'),
(219, 41, '2022-12-14 19:03:49', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(220, 1, '2022-12-22 20:07:01', 'Event', 'Update Tamplate Event Berhasil'),
(221, 1, '2022-12-22 20:15:21', 'Event', 'Update Tamplate Event Berhasil'),
(222, 1, '2022-12-22 20:19:34', 'Event', 'Update Tamplate Event Berhasil'),
(223, 1, '2022-12-22 20:19:40', 'Event', 'Update Tamplate Event Berhasil'),
(224, 1, '2022-12-22 20:19:40', 'Event', 'Update Tamplate Event Berhasil'),
(225, 1, '2022-12-22 20:20:30', 'Event', 'Update Tamplate Event Berhasil'),
(226, 1, '2022-12-22 20:20:34', 'Event', 'Update Tamplate Event Berhasil'),
(227, 1, '2022-12-22 20:20:34', 'Event', 'Update Tamplate Event Berhasil'),
(228, 1, '2022-12-22 20:20:38', 'Event', 'Update Tamplate Event Berhasil'),
(229, 1, '2022-12-22 20:20:38', 'Event', 'Update Tamplate Event Berhasil'),
(230, 1, '2022-12-22 20:20:38', 'Event', 'Update Tamplate Event Berhasil'),
(231, 1, '2022-12-22 20:21:49', 'Input Form Setting', 'Input Form Setting Berhasil'),
(232, 1, '2022-12-22 20:22:02', 'Event', 'Update Tamplate Event Berhasil'),
(233, 1, '2022-12-22 23:24:44', 'Input Form Setting', 'Input Form Setting Berhasil'),
(234, 41, '2022-12-23 00:06:59', 'Input Form Setting', 'Input Form Setting Berhasil'),
(235, 41, '2022-12-23 00:07:53', 'Input Form Setting', 'Input Form Setting Berhasil'),
(236, 41, '2022-12-23 00:08:04', 'Update Form Setting', 'Update Form Setting Berhasil'),
(237, 41, '2022-12-23 00:08:38', 'Input Form Setting', 'Input Form Setting Berhasil'),
(238, 1, '2022-12-23 01:22:51', 'Akses', 'Update Akses Berhasil'),
(239, 1, '2022-12-23 01:22:51', 'Akses', 'Update Akses Berhasil'),
(240, 1, '2022-12-23 01:22:51', 'Akses', 'Update Akses Berhasil'),
(241, 1, '2022-12-23 20:21:53', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(242, 1, '2022-12-23 20:21:53', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(243, 1, '2022-12-23 20:21:58', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(244, 1, '2022-12-23 20:23:22', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(245, 1, '2022-12-23 20:26:42', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(246, 1, '2022-12-23 20:26:42', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(247, 1, '2022-12-23 23:46:42', 'Survey', 'Tambah Survey Berhasil'),
(248, 1, '2022-12-27 01:16:43', 'Survey', 'Tambah Kriteria Survey Berhasil'),
(249, 1, '2022-12-27 01:21:02', 'Survey', 'Tambah Kriteria Survey Berhasil'),
(250, 1, '2022-12-27 01:21:38', 'Survey', 'Tambah Kriteria Survey Berhasil'),
(251, 1, '2022-12-27 01:21:45', 'Survey', 'Tambah Kriteria Survey Berhasil'),
(252, 1, '2022-12-27 01:38:55', 'Survey', 'Edit Kriteria Survey Berhasil'),
(253, 1, '2022-12-27 01:39:08', 'Survey', 'Edit Kriteria Survey Berhasil'),
(254, 1, '2022-12-27 01:39:26', 'Survey', 'Edit Kriteria Survey Berhasil'),
(255, 1, '2022-12-27 22:56:21', 'Survey', 'Tambah Pertanyaan Berhasil'),
(256, 1, '2022-12-27 23:02:24', 'Survey', 'Tambah Pertanyaan Berhasil'),
(257, 1, '2022-12-28 00:29:01', 'Survey', 'Tambah Alternatif Berhasil'),
(258, 1, '2022-12-28 01:00:17', 'Survey', 'Tambah Alternatif Berhasil'),
(259, 1, '2022-12-28 01:00:24', 'Survey', 'Tambah Alternatif Berhasil'),
(260, 1, '2022-12-28 01:21:31', 'Survey', 'Edit Pertanyaan Berhasil'),
(261, 1, '2022-12-28 01:21:35', 'Survey', 'Edit Pertanyaan Berhasil'),
(262, 1, '2022-12-28 01:21:35', 'Survey', 'Edit Pertanyaan Berhasil'),
(263, 1, '2022-12-28 01:42:02', 'Survey', 'Edit Alternatif Berhasil'),
(264, 1, '2022-12-28 01:42:09', 'Survey', 'Edit Alternatif Berhasil'),
(265, 1, '2022-12-28 01:42:09', 'Survey', 'Edit Alternatif Berhasil'),
(266, 1, '2022-12-28 01:42:24', 'Survey', 'Tambah Alternatif Berhasil'),
(267, 1, '2022-12-28 01:42:34', 'Survey', 'Tambah Alternatif Berhasil'),
(268, 1, '2022-12-28 01:42:44', 'Survey', 'Tambah Alternatif Berhasil'),
(269, 1, '2022-12-28 01:43:12', 'Survey', 'Edit Alternatif Berhasil'),
(270, 1, '2022-12-28 01:43:12', 'Survey', 'Edit Alternatif Berhasil'),
(271, 1, '2022-12-28 01:43:12', 'Survey', 'Edit Alternatif Berhasil'),
(272, 1, '2022-12-28 01:43:20', 'Survey', 'Edit Alternatif Berhasil'),
(273, 1, '2022-12-28 01:43:20', 'Survey', 'Edit Alternatif Berhasil'),
(274, 1, '2022-12-28 01:43:20', 'Survey', 'Edit Alternatif Berhasil'),
(275, 1, '2022-12-28 01:43:20', 'Survey', 'Edit Alternatif Berhasil'),
(276, 1, '2022-12-28 01:43:27', 'Survey', 'Edit Alternatif Berhasil'),
(277, 1, '2022-12-28 01:43:27', 'Survey', 'Edit Alternatif Berhasil'),
(278, 1, '2022-12-28 01:43:27', 'Survey', 'Edit Alternatif Berhasil'),
(279, 1, '2022-12-28 01:43:27', 'Survey', 'Edit Alternatif Berhasil'),
(280, 1, '2022-12-28 01:43:27', 'Survey', 'Edit Alternatif Berhasil'),
(281, 1, '2022-12-28 01:44:03', 'Survey', 'Tambah Pertanyaan Berhasil'),
(282, 1, '2023-01-04 19:16:54', 'Survey', 'Tambah Alternatif Berhasil'),
(283, 1, '2023-01-04 19:17:04', 'Survey', 'Tambah Alternatif Berhasil'),
(284, 1, '2023-01-04 19:17:12', 'Survey', 'Tambah Alternatif Berhasil'),
(285, 1, '2023-01-06 23:43:56', 'Survey', 'Edit Alternatif Berhasil'),
(286, 1, '2023-01-06 23:43:56', 'Survey', 'Edit Alternatif Berhasil'),
(287, 1, '2023-01-06 23:44:02', 'Survey', 'Edit Alternatif Berhasil'),
(288, 1, '2023-01-06 23:44:02', 'Survey', 'Edit Alternatif Berhasil'),
(289, 1, '2023-01-06 23:44:02', 'Survey', 'Edit Alternatif Berhasil'),
(290, 1, '2023-01-06 23:44:05', 'Survey', 'Edit Alternatif Berhasil'),
(291, 1, '2023-01-06 23:44:05', 'Survey', 'Edit Alternatif Berhasil'),
(292, 1, '2023-01-06 23:44:05', 'Survey', 'Edit Alternatif Berhasil'),
(293, 1, '2023-01-06 23:44:05', 'Survey', 'Edit Alternatif Berhasil'),
(294, 1, '2023-01-06 23:44:08', 'Survey', 'Edit Alternatif Berhasil'),
(295, 1, '2023-01-06 23:44:08', 'Survey', 'Edit Alternatif Berhasil'),
(296, 1, '2023-01-06 23:44:09', 'Survey', 'Edit Alternatif Berhasil'),
(297, 1, '2023-01-06 23:44:09', 'Survey', 'Edit Alternatif Berhasil'),
(298, 1, '2023-01-06 23:44:09', 'Survey', 'Edit Alternatif Berhasil'),
(299, 1, '2023-01-06 23:44:13', 'Survey', 'Edit Alternatif Berhasil'),
(300, 1, '2023-01-06 23:44:13', 'Survey', 'Edit Alternatif Berhasil'),
(301, 1, '2023-01-06 23:44:13', 'Survey', 'Edit Alternatif Berhasil'),
(302, 1, '2023-01-06 23:44:13', 'Survey', 'Edit Alternatif Berhasil'),
(303, 1, '2023-01-06 23:44:13', 'Survey', 'Edit Alternatif Berhasil'),
(304, 1, '2023-01-06 23:44:13', 'Survey', 'Edit Alternatif Berhasil'),
(305, 1, '2023-01-06 23:44:17', 'Survey', 'Edit Alternatif Berhasil'),
(306, 1, '2023-01-06 23:44:17', 'Survey', 'Edit Alternatif Berhasil'),
(307, 1, '2023-01-06 23:44:17', 'Survey', 'Edit Alternatif Berhasil'),
(308, 1, '2023-01-06 23:44:17', 'Survey', 'Edit Alternatif Berhasil'),
(309, 1, '2023-01-06 23:44:17', 'Survey', 'Edit Alternatif Berhasil'),
(310, 1, '2023-01-06 23:44:17', 'Survey', 'Edit Alternatif Berhasil'),
(311, 1, '2023-01-06 23:44:17', 'Survey', 'Edit Alternatif Berhasil'),
(312, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(313, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(314, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(315, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(316, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(317, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(318, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(319, 1, '2023-01-06 23:44:21', 'Survey', 'Edit Alternatif Berhasil'),
(320, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(321, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(322, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(323, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(324, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(325, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(326, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(327, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(328, 1, '2023-01-06 23:44:24', 'Survey', 'Edit Alternatif Berhasil'),
(329, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(330, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(331, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(332, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(333, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(334, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(335, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(336, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(337, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(338, 1, '2023-01-06 23:44:28', 'Survey', 'Edit Alternatif Berhasil'),
(339, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(340, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(341, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(342, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(343, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(344, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(345, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(346, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(347, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(348, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(349, 1, '2023-01-06 23:44:32', 'Survey', 'Edit Alternatif Berhasil'),
(350, 1, '2023-01-06 23:44:51', 'Survey', 'Tambah Pertanyaan Berhasil'),
(351, 1, '2023-01-06 23:44:59', 'Survey', 'Tambah Alternatif Berhasil'),
(352, 1, '2023-01-06 23:45:07', 'Survey', 'Tambah Alternatif Berhasil'),
(353, 1, '2023-01-06 23:45:13', 'Survey', 'Tambah Alternatif Berhasil'),
(354, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(355, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(356, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(357, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(358, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(359, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(360, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(361, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(362, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(363, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(364, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(365, 1, '2023-01-06 23:45:28', 'Survey', 'Edit Alternatif Berhasil'),
(366, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(367, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(368, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(369, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(370, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(371, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(372, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(373, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(374, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(375, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(376, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(377, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(378, 1, '2023-01-06 23:45:39', 'Survey', 'Edit Alternatif Berhasil'),
(379, 1, '2023-01-06 23:45:49', 'Survey', 'Edit Alternatif Berhasil'),
(380, 1, '2023-01-06 23:45:57', 'Survey', 'Edit Alternatif Berhasil'),
(381, 1, '2023-01-06 23:45:57', 'Survey', 'Edit Alternatif Berhasil'),
(382, 1, '2023-01-07 01:35:03', 'Survey', 'Tambah Alternatif Berhasil'),
(383, 1, '2023-01-10 21:39:23', 'Input Akses Baru', 'Input Akses Baru Berhasil'),
(384, 1, '2023-01-11 19:20:48', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(385, 1, '2023-01-11 19:20:48', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(386, 1, '2023-01-11 19:20:48', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(387, 1, '2023-01-11 19:20:48', 'Unit Kerja', 'Edit Anggota Unit Kerja Baru Berhasil'),
(388, 1, '2023-01-14 12:02:29', 'Survey', 'Tambah Kriteria Survey Berhasil'),
(389, 1, '2023-01-14 12:02:39', 'Survey', 'Tambah Kriteria Survey Berhasil'),
(390, 1, '2023-01-14 12:02:49', 'Survey', 'Tambah Kriteria Survey Berhasil'),
(391, 1, '2023-01-14 12:03:08', 'Survey', 'Tambah Pertanyaan Berhasil'),
(392, 1, '2023-01-14 12:03:15', 'Survey', 'Tambah Pertanyaan Berhasil'),
(393, 1, '2023-01-14 12:03:29', 'Survey', 'Tambah Pertanyaan Berhasil'),
(394, 1, '2023-01-14 12:03:39', 'Survey', 'Tambah Pertanyaan Berhasil'),
(395, 1, '2023-01-14 12:03:51', 'Survey', 'Tambah Alternatif Berhasil'),
(396, 1, '2023-01-14 12:03:58', 'Survey', 'Tambah Alternatif Berhasil'),
(397, 1, '2023-01-14 12:04:04', 'Survey', 'Tambah Alternatif Berhasil'),
(398, 1, '2023-01-14 12:04:10', 'Survey', 'Tambah Alternatif Berhasil'),
(399, 1, '2023-01-14 12:04:16', 'Survey', 'Tambah Alternatif Berhasil'),
(400, 1, '2023-01-14 12:04:22', 'Survey', 'Tambah Alternatif Berhasil'),
(401, 1, '2023-01-14 12:04:29', 'Survey', 'Tambah Alternatif Berhasil'),
(402, 1, '2023-01-14 12:04:34', 'Survey', 'Tambah Alternatif Berhasil'),
(403, 1, '2023-01-14 12:04:42', 'Survey', 'Tambah Alternatif Berhasil'),
(404, 1, '2023-01-14 12:04:48', 'Survey', 'Tambah Alternatif Berhasil'),
(405, 1, '2023-01-14 12:04:54', 'Survey', 'Tambah Alternatif Berhasil'),
(406, 1, '2023-01-14 12:05:01', 'Survey', 'Tambah Alternatif Berhasil'),
(407, 1, '2023-02-15 23:25:42', 'Akses', 'Ubah Password Berhasil'),
(408, 1, '2023-02-15 23:29:34', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(409, 1, '2023-02-15 23:30:00', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(410, 1, '2023-02-15 23:30:00', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(411, 1, '2023-02-15 23:30:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(412, 1, '2023-02-15 23:30:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(413, 1, '2023-02-15 23:30:11', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(414, 1, '2023-02-15 23:30:26', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(415, 1, '2023-02-15 23:30:26', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(416, 1, '2023-02-15 23:30:26', 'Edit Akses Baru', 'Edit Akses Baru Berhasil'),
(417, 1, '2023-05-11 01:12:47', 'Tambah Event', 'Tambah Event Berhasil'),
(418, 1, '2023-05-11 01:27:42', 'Input Riwayat Kerja', 'Input Riwayat Kerja Berhasil'),
(419, 1, '2023-05-14 17:25:17', 'Update Dukungan Sele', 'Update Dukungan Selesai Berhasil');

-- --------------------------------------------------------

--
-- Table structure for table `log_api`
--

DROP TABLE IF EXISTS `log_api`;
CREATE TABLE IF NOT EXISTS `log_api` (
  `id_log_api` int(10) NOT NULL AUTO_INCREMENT,
  `id_setting_api_key` int(10) DEFAULT NULL,
  `api_key` text,
  `service_name` text NOT NULL,
  `response` text NOT NULL,
  `datetime` varchar(25) NOT NULL,
  PRIMARY KEY (`id_log_api`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_api`
--

INSERT INTO `log_api` (`id_log_api`, `id_setting_api_key`, `api_key`, `service_name`, `response`, `datetime`) VALUES
(1, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Propinsi', 'success', '2022-09-02 15:27:00'),
(2, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Kabupaten', 'success', '2022-09-02 15:27:15'),
(3, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Kecamatan', 'success', '2022-09-02 15:27:25'),
(4, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Desa', 'success', '2022-09-02 15:27:35'),
(5, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Partner', 'success', '2022-09-02 15:27:42'),
(6, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Personnel', 'success', '2022-09-02 15:27:53'),
(7, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2022-09-02 15:28:14'),
(8, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi medical treatment', 'success', '2022-09-02 15:28:23'),
(9, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Partner Registration', 'Partner Contact is already registered', '2022-09-02 15:28:35'),
(10, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Partner Registration', 'Partner Contact is already registered', '2022-09-02 15:29:21'),
(11, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Partner Registration', 'success', '2022-09-02 15:29:29'),
(12, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Member Registration', 'Member Email Already Used', '2022-09-02 15:29:54'),
(13, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Member Registration', 'Member Email Already Used', '2022-09-02 15:30:13'),
(14, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Member Registration', 'success', '2022-09-02 15:30:26'),
(15, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Validation Code', 'success', '2022-09-02 15:30:52'),
(16, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Resend Email Validation', 'success', '2022-09-02 15:31:13'),
(17, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Validation Email', 'success', '2022-09-02 15:31:22'),
(18, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-02 15:32:15'),
(19, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Insert Screening', 'success', '2022-09-02 15:32:49'),
(20, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Insert Transaction', 'Email pasien tidak boleh kosong', '2022-09-02 15:33:52'),
(21, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Insert Transaction', 'success', '2022-09-02 15:34:22'),
(22, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2022-09-02 15:34:42'),
(23, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Detail Page', 'success', '2022-09-02 15:34:49'),
(25, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Content', 'success', '2022-09-02 15:35:04'),
(28, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List Page Posting', 'Success', '2022-09-02 15:38:04'),
(29, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Content', 'success', '2022-09-02 15:39:02'),
(30, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Insert Transaction', 'success', '2022-09-02 16:59:01'),
(31, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2022-09-05 19:31:24'),
(32, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'Your selected medical treatment plan date is invalid', '2022-09-20 22:08:21'),
(33, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Personnel', 'success', '2022-09-20 22:08:55'),
(34, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2022-09-20 22:09:00'),
(35, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-20 22:09:22'),
(36, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-20 22:11:14'),
(37, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-20 22:11:45'),
(38, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-20 22:13:32'),
(39, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-20 22:14:16'),
(40, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-21 19:41:01'),
(41, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-21 19:42:19'),
(42, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-21 19:43:30'),
(43, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-21 19:43:58'),
(44, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-21 20:56:48'),
(45, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'Registration is limited', '2022-09-21 20:57:29'),
(46, 12, '2efe458d1a9dd60ddcb0be88d36098', 'General Registration', 'success', '2022-09-21 20:57:59'),
(47, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Insert Screening', 'success', '2022-09-21 21:01:16'),
(48, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Insert Transaction', 'success', '2022-09-21 21:03:27'),
(49, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Partner Registration', 'success', '2022-09-25 22:36:13'),
(50, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Partner', 'success', '2022-10-15 17:04:25'),
(51, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 22:38:03'),
(52, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 22:38:25'),
(53, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 22:40:31'),
(54, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 22:41:01'),
(55, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 23:47:06'),
(56, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 23:47:52'),
(57, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 23:52:40'),
(58, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 23:52:52'),
(59, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 23:53:50'),
(60, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List URL Dinamis', 'Success', '2023-01-17 23:54:27'),
(61, 12, '2efe458d1a9dd60ddcb0be88d36098', 'List Page Posting', 'Success', '2023-02-13 19:01:49'),
(62, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Participant accounts have not been validated', '2023-10-03 01:25:40'),
(63, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 01:25:51'),
(64, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'Member Email Already Used', '2023-10-03 04:17:25'),
(65, 0, '0', 'Referensi Jadwal Praktek', 'Only POST data transmission method is allowed', '2023-10-03 10:28:47'),
(66, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 10:28:54'),
(67, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 10:29:08'),
(68, 0, '0', 'Referensi Jadwal Praktek', 'Kode Kupon cannot be empty', '2023-10-03 10:33:34'),
(69, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 10:33:42'),
(70, 0, '0', 'Referensi Jadwal Praktek', 'The API Key you are using is invalid', '2023-10-03 11:02:59'),
(71, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 11:03:39'),
(72, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 11:04:46'),
(73, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 11:06:13'),
(74, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data', '2023-10-03 11:09:56'),
(75, 0, '0', 'Referensi Jadwal Praktek', 'Kode Transaksi Sudah Ada', '2023-10-03 11:10:11'),
(76, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 11:11:20'),
(77, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Input Data Gagal', '2023-10-03 11:47:17'),
(78, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Input Data Gagal', '2023-10-03 11:48:21'),
(79, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Input Data Gagal', '2023-10-03 11:48:33'),
(80, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Input Data Gagal', '2023-10-03 11:50:07'),
(81, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Input Data Gagal', '2023-10-03 11:51:33'),
(82, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Input Data Gagal', '2023-10-03 11:51:50'),
(83, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Input Data Gagal', '2023-10-03 11:55:01'),
(84, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>Update Data Gagal', '2023-10-03 11:55:56'),
(85, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br>{\"ServerKey\":\"SB-Mid-server-RWIfjoriobGtv0veoWqF_YWK\",\"Production\":\"false\",\"order_id\":\"ORDID-13-1696308986\",\"gross_amount\":\"700000\",\"first_name\":\"Syamsul\",\"last_name\":\"Maarif\",\"email\":\"syamsul@gmail.com\",\"phone\":\"089667768578\",\"kode_transaksi\":\"KDT-13-12-1\"}', '2023-10-03 11:56:26'),
(86, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br> Keterangan : Update Data Gagal', '2023-10-03 11:59:13'),
(87, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:02:19'),
(88, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:03:58'),
(89, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:05:06'),
(90, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:06:02'),
(91, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:06:35'),
(92, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:06:44'),
(93, 0, '0', 'Referensi Jadwal Praktek', 'Terjadi kesalahan pada saat menyimpan data transaksi <br> Keterangan : Update Data Gagal', '2023-10-03 12:07:17'),
(94, 0, '0', 'Referensi Jadwal Praktek', 'Jumlah Tagihan Tidak Boleh Kosong', '2023-10-03 12:11:12'),
(95, 0, '0', 'Referensi Jadwal Praktek', 'Kode Transaksi Tidak Valid, Atau Tidak Ditemukan Pada Database', '2023-10-03 12:12:42'),
(96, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:13:00'),
(97, 0, '0', 'Referensi Jadwal Praktek', '', '2023-10-03 12:13:31'),
(98, 0, '0', 'Referensi Jadwal Praktek', 'Resource id #6', '2023-10-03 12:15:22'),
(99, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 12:17:22'),
(100, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 12:17:34'),
(101, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 12:17:48'),
(102, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 12:18:20'),
(103, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 13:40:54'),
(104, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 21:11:50'),
(105, 0, '0', 'Referensi Jadwal Praktek', 'Transaction status can only be Lunas, Pending and Expired', '2023-10-03 21:47:15'),
(106, 0, '0', 'Referensi Jadwal Praktek', 'Transaction status can only be Lunas, Pending and Expired', '2023-10-03 21:47:21'),
(107, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-03 21:47:38'),
(108, 0, '0', 'Referensi Jadwal Praktek', 'The transaction has been paid in full, you cannot delete a transaction that has been paid in full', '2023-10-03 21:47:42'),
(109, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Incorrect email and password combination', '2023-10-04 20:57:23'),
(110, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Incorrect email and password combination', '2023-10-04 20:57:38'),
(111, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-04 20:57:51'),
(112, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'The registration quota is full', '2023-10-04 21:10:18'),
(113, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-04 21:10:24'),
(114, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Participant accounts have not been validated', '2023-10-04 21:34:08'),
(115, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-04 21:34:22'),
(116, 0, '0', 'Generate Token Lupa Password', 'Only POST data transmission method is allowed', '2023-10-04 22:10:42'),
(117, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', '', '2023-10-04 22:10:47'),
(118, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:12:37'),
(119, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:13:10'),
(120, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'Email Not Valid', '2023-10-04 22:13:20'),
(121, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:13:25'),
(122, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:14:12'),
(123, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:19:02'),
(124, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Ubah Password', 'Code Cannot Be Empty', '2023-10-04 22:35:16'),
(125, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:35:21'),
(126, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:35:39'),
(127, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:35:49'),
(128, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Ubah Password', 'Code Cannot Be Empty', '2023-10-04 22:36:01'),
(129, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Ubah Password', 'The unique code you used has expired', '2023-10-04 22:37:06'),
(130, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Ubah Password', 'success', '2023-10-04 22:37:54'),
(131, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Ubah Password', 'The combination of unique code and email does not match', '2023-10-04 22:39:06'),
(132, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'success', '2023-10-04 22:39:12'),
(133, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Ubah Password', 'success', '2023-10-04 22:39:19'),
(134, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Khusus untuk mahasiswa kedokteran spesialis', '2023-10-04 22:43:28'),
(135, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Khusus untuk mahasiswa kedokteran spesialis', '2023-10-04 22:46:15'),
(136, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Khusus untuk mahasiswa kedokteran spesialis', '2023-10-04 22:46:33'),
(137, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Khusus untuk mahasiswa kedokteran spesialis', '2023-10-04 22:47:57'),
(138, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Khusus untuk mahasiswa kedokteran spesialis', '2023-10-04 22:59:03'),
(139, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'Khusus untuk mahasiswa kedokteran spesialis', '2023-10-04 22:59:32'),
(140, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Absensi On Site', 'Attendance Session is Over', '2023-10-04 23:17:26'),
(141, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Absensi On Site', 'Participants Have Filled in Absences!', '2023-10-04 23:18:06'),
(142, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Absensi On Site', 'success', '2023-10-04 23:18:23'),
(143, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Absensi On Site', 'success', '2023-10-04 23:28:39'),
(144, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-05 00:04:53'),
(145, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Generate Token Lupa Password', 'Email Not Valid', '2023-10-05 00:13:17'),
(146, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Ubah Password', 'Email Not Valid', '2023-10-05 00:14:20'),
(147, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-05 23:54:59'),
(148, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-05 23:58:17'),
(149, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-06 00:00:10'),
(150, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-06 00:01:20'),
(151, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'ID Event Category Not Valid', '2023-10-06 00:32:51'),
(152, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-06 00:34:10'),
(153, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-06 00:35:19'),
(154, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'The new email you use has been previously registered', '2023-10-06 00:35:42'),
(155, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-06 00:36:20'),
(156, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'You cannot change the package because the payment has already been paid in full', '2023-10-06 00:40:37'),
(157, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-06 00:40:47'),
(158, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-06 00:51:03'),
(159, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-06 00:52:29'),
(160, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'ID Event Category Not Valid', '2023-10-06 21:39:28'),
(161, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'ID Event Category Not Valid', '2023-10-06 21:39:47'),
(162, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-06 21:40:27'),
(163, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'ID Event Category Not Valid', '2023-10-07 04:24:39'),
(164, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'ID Event Category Not Valid', '2023-10-07 04:25:00'),
(165, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-07 04:25:07'),
(166, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-07 04:34:45'),
(167, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-07 06:08:18'),
(168, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-07 06:30:35'),
(169, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Pendaftaran Peserta', 'success', '2023-10-07 21:51:47'),
(170, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-08 01:14:11'),
(171, 0, '0', 'Referensi Jadwal Praktek', 'Kode Transaksi Sudah Ada', '2023-10-08 01:14:49'),
(172, 12, '2efe458d1a9dd60ddcb0be88d36098', 'Referensi Jadwal Praktek', 'success', '2023-10-08 01:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `log_email`
--

DROP TABLE IF EXISTS `log_email`;
CREATE TABLE IF NOT EXISTS `log_email` (
  `id_log_email` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text,
  `email` text NOT NULL,
  `subjek` text NOT NULL,
  `pesan` text NOT NULL,
  `datetime` text NOT NULL,
  PRIMARY KEY (`id_log_email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_email`
--

INSERT INTO `log_email` (`id_log_email`, `nama`, `email`, `subjek`, `pesan`, `datetime`) VALUES
(1, 'Solihul Hadi', 'dhiforester@gmail.com', 'Validasi Pendaftaran', 'Selamat malam, silahkan lakukan validasi eaae5466ace3c45f8aa1cee36c1654', '1661103345'),
(2, 'Solihul Hadi', 'dhiforester@gmail.com', 'Validasi Pendaftaran', 'Selamat malam, silahkan lakukan validasi 03e826630d4f3c836e6eceeacd929b', '1661103468'),
(3, 'Solihul Hadi', 'dhiforester@gmail.com', 'Validasi Pendaftaran Klinik Metro', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/metro/ValidasiEmail.php?Token=e66375de75db92a1f576466968cd69>Klik Disini</a>', '1661105133'),
(4, 'Solihul Hadi', 'dhiforester@gmail.com', 'Validasi Pendaftaran Klinik Metro', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/metro/ValidasiEmail.php?Token=75a571fe72305d66f156377885a0ae>Klik Disini</a>', '1661168157'),
(5, 'Naya Nurmayasari', 'solihulhadi141213@gmail.com', 'Validasi Pendaftaran Klinik Metro', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/metro/ValidasiEmail.php?Token=b3039d1a355521267ae8278e549930>Klik Disini</a>', '1661168751'),
(6, 'Suwarno', 'solihulhadi141213@gmail.com', 'Validasi Pendaftaran Klinik Metro', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/metro/ValidasiEmail.php?Token=ced4b498ccd7cc6987e48b7e3c657c>Klik Disini</a>', '1661169968'),
(7, 'Suwarno', 'solihulhadi141213@gmail.com', 'Validasi Pendaftaran Klinik Metro', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/metro/ValidasiEmail.php?Token=bd4e84ce3e25ca9e8c591e98cf38f4>Klik Disini</a>', '1661170043'),
(8, 'Suwarno', 'solihulhadi141213@gmail.com', 'Validasi Pendaftaran Klinik Metro', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/metro/ValidasiEmail.php?Token=ddf0c5ca351f7eaf28624b1630390d>Klik Disini</a>', '1661170606'),
(9, 'Solihul hadi', 'mr_nesta2000@yahoo.com', 'Validasi Pendaftaran Klinik Metro', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/metro/ValidasiEmail.php?Token=7d530a47ac2a65f10fef62bd923dca>Klik Disini</a>', '1662107470'),
(10, 'Solihul Hadi', 'solihulhadi141213@gmail.com', 'Validasi Email Pendaftaran RSU El-Syifa', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/echojob/ValidasiEmail.php?Token=db81551930d16c6c8c3f9b81de46aa>Klik Disini</a>', '2022-12-23 00:43:32'),
(11, 'Solihul Hadi', 'solihulhadi141213@gmail.com', 'Validasi Email Pendaftaran RSU El-Syifa', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/echojob/ValidasiEmail.php?Token=de401e462f3b8c5c801577e2f167e9>Klik Disini</a>', '2022-12-23 00:54:56'),
(12, 'Solihul Hadi', 'solihulhadi141213@gmail.com', 'Validasi Email Pendaftaran RSU El-Syifa', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/echojob/ValidasiEmail.php?Token=becaf669fba7a2ff8ce3dc87affc89>Klik Disini</a>', '2022-12-23 01:03:57'),
(13, 'Solihul Hadi', 'solihulhadi141213@gmail.com', 'Validasi Email Pendaftaran RSU El-Syifa', 'Berikut ini kami kirimkan URL untuk melakukan validasi pendaftaran anda <a href=http://localhost:81/echojob/ValidasiEmail.php?Token=7d3e0a0d8e2ed0dece116ca2b63b13>Klik Disini</a>', '2022-12-23 01:04:59'),
(14, '', '', 'Undangan Survey', 'kepada Yth. Solihul Hadi <br> Kami mengundang anda untuk mengisi survey pada tautan berikut ini: http://localhost:81/echojob/Survey.php?id=1&token=MTY3MjMyNDM0Nw==<br>Terima Kasih.', '2022-12-29 21:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `lupa_password`
--

DROP TABLE IF EXISTS `lupa_password`;
CREATE TABLE IF NOT EXISTS `lupa_password` (
  `id_lupa_password` int(10) NOT NULL AUTO_INCREMENT,
  `id_peserta` int(10) NOT NULL,
  `tanggal_dibuat` varchar(30) NOT NULL,
  `tanggal_expired` varchar(30) NOT NULL,
  `code_unik` text NOT NULL,
  PRIMARY KEY (`id_lupa_password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting_api_key`
--

DROP TABLE IF EXISTS `setting_api_key`;
CREATE TABLE IF NOT EXISTS `setting_api_key` (
  `id_setting_api_key` int(19) NOT NULL AUTO_INCREMENT,
  `datetime_api_key` varchar(25) NOT NULL,
  `title_api_key` varchar(20) NOT NULL,
  `description_api_key` text NOT NULL,
  `api_key` text NOT NULL,
  `status_api_key` varchar(15) NOT NULL,
  PRIMARY KEY (`id_setting_api_key`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_api_key`
--

INSERT INTO `setting_api_key` (`id_setting_api_key`, `datetime_api_key`, `title_api_key`, `description_api_key`, `api_key`, `status_api_key`) VALUES
(4, '1664127456', 'Developer Team RZF', 'Ini adalah api key percobaan untuk rzf2', '97c9807abeddb6d704c7446d1d66a8', 'Active'),
(12, '1664127226', 'Landing Page', 'Ini adalah API key yang digunakan oleh halaman landing page', '2efe458d1a9dd60ddcb0be88d36098', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `setting_email_gateway`
--

DROP TABLE IF EXISTS `setting_email_gateway`;
CREATE TABLE IF NOT EXISTS `setting_email_gateway` (
  `id_setting_email_gateway` int(10) NOT NULL AUTO_INCREMENT,
  `email_gateway` text,
  `password_gateway` varchar(20) DEFAULT NULL,
  `url_provider` text,
  `port_gateway` varchar(10) DEFAULT NULL,
  `nama_pengirim` varchar(25) DEFAULT NULL,
  `url_service` text NOT NULL,
  `validasi_email` varchar(10) NOT NULL,
  PRIMARY KEY (`id_setting_email_gateway`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_email_gateway`
--

INSERT INTO `setting_email_gateway` (`id_setting_email_gateway`, `email_gateway`, `password_gateway`, `url_provider`, `port_gateway`, `nama_pengirim`, `url_service`, `validasi_email`) VALUES
(1, 'dhiforester@rsuelsyifa.com', 'solihulhadi1412', 'mail.rsuelsyifa.com', '465', 'Admin RSU El-Syifa', 'http://mailer.rsuelsyifa.com', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `setting_general`
--

DROP TABLE IF EXISTS `setting_general`;
CREATE TABLE IF NOT EXISTS `setting_general` (
  `id_setting_general` int(10) NOT NULL AUTO_INCREMENT,
  `title_page` varchar(20) NOT NULL,
  `kata_kunci` text NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat_bisnis` text NOT NULL,
  `email_bisnis` text NOT NULL,
  `telepon_bisnis` varchar(15) NOT NULL,
  `favicon` text NOT NULL,
  `logo` text NOT NULL,
  `base_url` text NOT NULL,
  PRIMARY KEY (`id_setting_general`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_general`
--

INSERT INTO `setting_general` (`id_setting_general`, `title_page`, `kata_kunci`, `deskripsi`, `alamat_bisnis`, `email_bisnis`, `telepon_bisnis`, `favicon`, `logo`, `base_url`) VALUES
(1, 'RSU El-Syifa', 'Event, Seminar, Simposium', 'Aplikasi untuk mengelola data event dan integrasi website', 'Jalan RE Martadinata No 108 Kel.Ancaran Kec.Kuningan Jawa Barat 45512', 'rsuelsyifa@gmail.com', '0232876240', '467bbd0abfe8648c50cfcf31689d11.png', 'c701fe27deee8e48fd4e6bd8de2fc2.png', 'http://localhost:81/seminar');

-- --------------------------------------------------------

--
-- Table structure for table `setting_payment`
--

DROP TABLE IF EXISTS `setting_payment`;
CREATE TABLE IF NOT EXISTS `setting_payment` (
  `id_setting_payment` int(10) NOT NULL AUTO_INCREMENT,
  `api_payment_url` text,
  `id_marchant` text,
  `client_key` text,
  `server_key` text,
  `snap_url` text,
  `production` varchar(10) NOT NULL,
  `aktif_payment_gateway` varchar(10) NOT NULL COMMENT 'Ya,Tidak',
  PRIMARY KEY (`id_setting_payment`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_payment`
--

INSERT INTO `setting_payment` (`id_setting_payment`, `api_payment_url`, `id_marchant`, `client_key`, `server_key`, `snap_url`, `production`, `aktif_payment_gateway`) VALUES
(1, 'https://payment.rsuelsyifa.co.id', 'G353849916', 'SB-Mid-client-JSrxj1orrwPiAVdo', 'SB-Mid-server-RWIfjoriobGtv0veoWqF_YWK', 'https://app.sandbox.midtrans.com/snap/snap.js', 'false', 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `setting_sertifikat`
--

DROP TABLE IF EXISTS `setting_sertifikat`;
CREATE TABLE IF NOT EXISTS `setting_sertifikat` (
  `id_setting_sertifikat` int(20) NOT NULL AUTO_INCREMENT,
  `id_event_setting` text,
  `group_name` text NOT NULL,
  `text_align` varchar(20) NOT NULL COMMENT 'left, right, center',
  `line_height` varchar(20) NOT NULL COMMENT 'ex: 175mm',
  `margin_left` varchar(20) NOT NULL COMMENT 'ex: 187px',
  `font_name` text,
  `font_size` text,
  `font_color` text COMMENT 'nama warna sesuai katalog',
  `img_bg` text,
  PRIMARY KEY (`id_setting_sertifikat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
