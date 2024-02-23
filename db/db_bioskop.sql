-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 07:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dtm_transaksi`
--

CREATE TABLE `tbl_dtm_transaksi` (
  `id_m_transaksi` varchar(20) NOT NULL,
  `id_studio` int(5) NOT NULL,
  `day` varchar(15) DEFAULT NULL,
  `tgl_show` date NOT NULL,
  `jam_tayang` time NOT NULL,
  `harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dtm_transaksi`
--

INSERT INTO `tbl_dtm_transaksi` (`id_m_transaksi`, `id_studio`, `day`, `tgl_show`, `jam_tayang`, `harga`) VALUES
('20230501040702', 21, 'Monday', '2023-05-01', '09:06:00', 30000),
('20230504023618', 25, 'Thursday', '2023-05-04', '07:36:00', 20000),
('20230515041720', 21, 'Monday', '2023-05-15', '09:17:00', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dt_pemesanan`
--

CREATE TABLE `tbl_dt_pemesanan` (
  `id_pemesanan` varchar(20) NOT NULL,
  `kode_pesan` varchar(30) NOT NULL,
  `seat` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_film`
--

CREATE TABLE `tbl_film` (
  `id_film` int(5) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `produser` varchar(100) NOT NULL,
  `sutradara` varchar(40) NOT NULL,
  `penulis` varchar(40) NOT NULL,
  `produksi` varchar(100) NOT NULL,
  `casts` text NOT NULL,
  `sinopsis` text NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_film`
--

INSERT INTO `tbl_film` (`id_film`, `judul`, `jenis`, `produser`, `sutradara`, `penulis`, `produksi`, `casts`, `sinopsis`, `foto`) VALUES
(4, 'Jujutsu Kaisen : 0', 'Anime', 'Toho Co., Ltd.', 'Sunghoo Park', 'COBA', 'MAPPA, TOHO animation', 'Gojou, Satoru · Nakamura, Yuuichi · Nakamura, Yuuichi ; Zenin, Maki · Komatsu, Mikako · Komatsu, Mikako ; Inumaki, Toge · Uchiyama', 'Yuta Okkotsu gains control of an extremely powerful, cursed spirit and gets enrolled in the Tokyo Prefectural Jujutsu High School by sorcerers to help him control his power and keep an eye on him.', 'jjk0.jpg'),
(5, 'Shazam! Fury of the Gods', 'Superhero', 'David F. Sandberg', 'David F. Sandberg', 'Warner Bros. Pictures', 'Warner Bros. Pictures', 'Asher Angel · Billy Batson ; Jack Dylan Grazer · Freddy Freeman ; Rachel Zegler · Anthea ; Adam Brody · Super Hero Freddy.', 'Bestowed with the powers of the gods, Billy Batson and his fellow foster kids are still learning how to juggle teenage life with their adult superhero alter egos.', 'shazam.jpg'),
(6, 'Avatar: The Way of Water', 'Sci-Fi', 'James Cameron', 'James Cameron', 'James Cameron', '20th Century Studios', 'Sam Worthington as Jake Sully · Zoe Saldaña as Neytiri · Stephen Lang as Colonel Miles Quaritch · Sigourney Weaver as Kiri · Kate Winslet as Ronal.', 'Jake Sully and Ney\'tiri have formed a family and are doing everything to stay together. However, they must leave their home and explore the regions of Pandora. When an ancient threat resurfaces, Jake must fight a difficult war against the humans.', 'avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jam_tayang`
--

CREATE TABLE `tbl_jam_tayang` (
  `id_film` int(5) NOT NULL,
  `jam_tayang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_m_transaksi`
--

CREATE TABLE `tbl_m_transaksi` (
  `id_m_transaksi` varchar(20) NOT NULL,
  `id_film` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_m_transaksi`
--

INSERT INTO `tbl_m_transaksi` (`id_m_transaksi`, `id_film`, `id_studio`, `status`, `admin`) VALUES
('20230501040702', 4, 21, 1, 'admin'),
('20230504023618', 5, 25, 1, 'admin'),
('20230515041720', 4, 21, 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemesanan`
--

CREATE TABLE `tbl_pemesanan` (
  `id_pemesanan` varchar(20) NOT NULL,
  `seat` varchar(3) NOT NULL,
  `id_m_transaksi` varchar(20) NOT NULL,
  `tgl_pemesanan` date NOT NULL DEFAULT current_timestamp(),
  `admin` varchar(30) NOT NULL,
  `tgl_data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemesanan`
--

INSERT INTO `tbl_pemesanan` (`id_pemesanan`, `seat`, `id_m_transaksi`, `tgl_pemesanan`, `admin`, `tgl_data`) VALUES
('20240223082420B1', 'B1', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:24:20'),
('20240223082420B2', 'B2', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:24:20'),
('20240223083832C3', 'C3', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:38:32'),
('20240223083832C4', 'C4', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:38:32'),
('20240223083931D1', 'D1', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:39:31'),
('20240223083931D2', 'D2', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:39:31'),
('20240223083942D1', 'D1', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:39:42'),
('20240223083942D2', 'D2', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:39:42'),
('20240223083950D1', 'D1', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:39:50'),
('20240223083950D2', 'D2', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:39:50'),
('20240223084126A2', 'A2', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:41:26'),
('20240223084126B3', 'B3', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:41:26'),
('20240223084437C4', 'C4', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:44:37'),
('20240223084437D4', 'D4', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:44:37'),
('20240223084451D3', 'D3', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:44:51'),
('20240223084451E3', 'E3', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:44:51'),
('20240223084507D5', 'D5', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:45:07'),
('20240223084507E5', 'E5', '20230501040702', '2024-02-23', 'admin', '2024-02-23 08:45:07'),
('20240223084522C10', 'C10', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:45:22'),
('20240223084522C6', 'C6', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:45:22'),
('20240223084522C8', 'C8', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:45:22'),
('20240223084557D5', 'D5', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:45:57'),
('20240223084557E5', 'E5', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:45:57'),
('20240223084841A5', 'A5', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:48:41'),
('20240223084841B3', 'B3', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:48:41'),
('20240223084841C1', 'C1', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:48:41'),
('20240223085352C1', 'C1', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:53:52'),
('20240223085352C2', 'C2', '20230504023618', '2024-02-23', 'admin', '2024-02-23 08:53:52'),
('20240223085409A4', 'A4', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:54:09'),
('20240223085409B5', 'B5', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:54:10'),
('20240223085409D3', 'D3', '20230515041720', '2024-02-23', 'admin', '2024-02-23 08:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studio`
--

CREATE TABLE `tbl_studio` (
  `id_studio` int(5) NOT NULL,
  `studio` varchar(20) NOT NULL,
  `baris` int(11) NOT NULL,
  `kolom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_studio`
--

INSERT INTO `tbl_studio` (`id_studio`, `studio`, `baris`, `kolom`) VALUES
(21, 'Studio 1', 5, 5),
(22, 'Studio 2', 4, 4),
(23, 'Studio 3', 2, 2),
(24, 'Studio 4', 1, 3),
(25, 'Studio 5', 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `akses` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `akses`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin'),
(2, 'percobaan', '12345', 'Nabila', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_film`
--
ALTER TABLE `tbl_film`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `tbl_m_transaksi`
--
ALTER TABLE `tbl_m_transaksi`
  ADD PRIMARY KEY (`id_m_transaksi`);

--
-- Indexes for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tbl_studio`
--
ALTER TABLE `tbl_studio`
  ADD PRIMARY KEY (`id_studio`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_film`
--
ALTER TABLE `tbl_film`
  MODIFY `id_film` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_studio`
--
ALTER TABLE `tbl_studio`
  MODIFY `id_studio` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
