-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2021 at 05:59 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kearsipandpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` enum('kabiro','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Ahmed', 'admin', 'admin123', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `berkas_proposal`
--

CREATE TABLE `berkas_proposal` (
  `id` int(11) NOT NULL,
  `id_penomoran` int(11) NOT NULL,
  `nama_kegiatan` varchar(40) NOT NULL,
  `link` text NOT NULL,
  `tanggal_kegiatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berkas_proposal`
--

INSERT INTO `berkas_proposal` (`id`, `id_penomoran`, `nama_kegiatan`, `link`, `tanggal_kegiatan`) VALUES
(7, 1, 'oke', 'msdkslfk', '2021-07-23'),
(8, 2, 'forum legislasi', 'drive/sicndsjcnksckncks', '2021-07-29'),
(9, 1, 'jejak pendapat', 'drive//kjsnkjnnjkndks', '2021-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `konstitusi`
--

CREATE TABLE `konstitusi` (
  `id` int(11) NOT NULL,
  `id_penomoran` int(11) NOT NULL,
  `nama_konstitusi` varchar(70) NOT NULL,
  `berkas` mediumblob NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penomoran`
--

CREATE TABLE `penomoran` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `nama_kegiatan` varchar(60) NOT NULL,
  `penomoran` text NOT NULL,
  `jumlah` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penomoran`
--

INSERT INTO `penomoran` (`id`, `nomor`, `nama_kegiatan`, `penomoran`, `jumlah`) VALUES
(1, '1', 'forum legislasi', '21/43/dpmvokasi2021', '4'),
(2, '2', 'Training organisation', '12/dpmvokasi2020/II', '27'),
(3, '3', 'surat peringatan II bem vokasi', 'II/SP/DPMVokasi2020', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rapat_besar`
--

CREATE TABLE `rapat_besar` (
  `id` int(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `notulen` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rapat_koordinasi`
--

CREATE TABLE `rapat_koordinasi` (
  `id` int(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `notulen` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rapat_pleno`
--

CREATE TABLE `rapat_pleno` (
  `id` int(20) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `notulen` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekap_anggota`
--

CREATE TABLE `rekap_anggota` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tunggakan` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` enum('lunas','belum lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekap_organisasi`
--

CREATE TABLE `rekap_organisasi` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `bulan` varchar(60) NOT NULL,
  `berkas` mediumblob NOT NULL,
  `keterangan` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `id_penomoran` int(11) NOT NULL,
  `nama_dikirim` varchar(40) NOT NULL,
  `jenis_kegiatan` varchar(40) NOT NULL,
  `link` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `id_penomoran`, `nama_dikirim`, `jenis_kegiatan`, `link`, `tanggal`) VALUES
(1, 3, 'Himasesi UB', 'TO', 'drive/kjsnvknsdvnkvksks', '2021-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nama_pengirim` varchar(40) NOT NULL,
  `jenis_kegiatan` varchar(40) NOT NULL,
  `link` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nama_pengirim`, `jenis_kegiatan`, `link`, `tanggal`) VALUES
(1, 'Himmasi', 'sertijab', 'jdbksbkd ncskdcnkn', '2021-07-08'),
(2, 'BEM Vokasi', 'PKKMB Vokasi 2021', 'https://drive.google.com/drive/folders/1655_7OWwhlUB-r3OOQw5Q-lvpiCzzlDQ', '2021-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `template_surat`
--

CREATE TABLE `template_surat` (
  `id` int(11) NOT NULL,
  `jenis_kegiatan` varchar(40) NOT NULL,
  `berkas` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_surat`
--

INSERT INTO `template_surat` (`id`, `jenis_kegiatan`, `berkas`) VALUES
(2, 'jaranan', 0x323032312d30372d30335f3139343934362d30312050454e47414e5441522050524f4752414d2053495354454d2044494e414d49532e706466);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berkas_proposal`
--
ALTER TABLE `berkas_proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penomoran` (`id_penomoran`);

--
-- Indexes for table `konstitusi`
--
ALTER TABLE `konstitusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penomoran` (`id_penomoran`);

--
-- Indexes for table `penomoran`
--
ALTER TABLE `penomoran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rapat_besar`
--
ALTER TABLE `rapat_besar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `rapat_koordinasi`
--
ALTER TABLE `rapat_koordinasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `rapat_pleno`
--
ALTER TABLE `rapat_pleno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `rekap_anggota`
--
ALTER TABLE `rekap_anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `rekap_organisasi`
--
ALTER TABLE `rekap_organisasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penomoran` (`id_penomoran`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_surat`
--
ALTER TABLE `template_surat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berkas_proposal`
--
ALTER TABLE `berkas_proposal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `konstitusi`
--
ALTER TABLE `konstitusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penomoran`
--
ALTER TABLE `penomoran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rapat_besar`
--
ALTER TABLE `rapat_besar`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rapat_koordinasi`
--
ALTER TABLE `rapat_koordinasi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rapat_pleno`
--
ALTER TABLE `rapat_pleno`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekap_anggota`
--
ALTER TABLE `rekap_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekap_organisasi`
--
ALTER TABLE `rekap_organisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `template_surat`
--
ALTER TABLE `template_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkas_proposal`
--
ALTER TABLE `berkas_proposal`
  ADD CONSTRAINT `berkas_proposal_ibfk_1` FOREIGN KEY (`id_penomoran`) REFERENCES `penomoran` (`id`);

--
-- Constraints for table `konstitusi`
--
ALTER TABLE `konstitusi`
  ADD CONSTRAINT `konstitusi_ibfk_1` FOREIGN KEY (`id_penomoran`) REFERENCES `penomoran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rapat_besar`
--
ALTER TABLE `rapat_besar`
  ADD CONSTRAINT `rapat_besar_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rapat_koordinasi`
--
ALTER TABLE `rapat_koordinasi`
  ADD CONSTRAINT `rapat_koordinasi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rapat_pleno`
--
ALTER TABLE `rapat_pleno`
  ADD CONSTRAINT `rapat_pleno_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rekap_anggota`
--
ALTER TABLE `rekap_anggota`
  ADD CONSTRAINT `rekap_anggota_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rekap_organisasi`
--
ALTER TABLE `rekap_organisasi`
  ADD CONSTRAINT `rekap_organisasi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_ibfk_1` FOREIGN KEY (`id_penomoran`) REFERENCES `penomoran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
