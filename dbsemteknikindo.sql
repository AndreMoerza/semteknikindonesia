-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2021 at 05:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsemteknikindo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbarang`
--

CREATE TABLE `tblbarang` (
  `idbarang` int(11) NOT NULL,
  `namabrg` varchar(100) NOT NULL,
  `idsupp` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbarang`
--

INSERT INTO `tblbarang` (`idbarang`, `namabrg`, `idsupp`, `harga`) VALUES
(0, 'Baja ringan', 3, 5000),
(3, 'Besi', 3, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tblcust`
--

CREATE TABLE `tblcust` (
  `idcust` int(11) NOT NULL,
  `npwp` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcust`
--

INSERT INTO `tblcust` (`idcust`, `npwp`, `nama`, `alamat`, `telepon`) VALUES
(2, 123456789, 'PT EON', 'Cikarang', 123456789),
(3, 419248210481204, 'Kawasaki', 'Bekasi', 5920582352305);

-- --------------------------------------------------------

--
-- Table structure for table `tblmarketing`
--

CREATE TABLE `tblmarketing` (
  `idmarketing` int(11) NOT NULL,
  `namamarketing` text NOT NULL,
  `nohp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmarketing`
--

INSERT INTO `tblmarketing` (`idmarketing`, `namamarketing`, `nohp`) VALUES
(2, 'Johan', 1234567890),
(3, 'Teddy', 56789011010101);

-- --------------------------------------------------------

--
-- Table structure for table `tblpiccust`
--

CREATE TABLE `tblpiccust` (
  `idpiccust` int(11) NOT NULL,
  `idcust` int(11) NOT NULL,
  `namapic` text NOT NULL,
  `nohp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpiccust`
--

INSERT INTO `tblpiccust` (`idpiccust`, `idcust`, `namapic`, `nohp`) VALUES
(2, 2, 'Jajang', 1231344141),
(3, 2, 'Dedi', 575595959),
(4, 3, 'Juhara', 4253523523),
(5, 3, 'sule', 346346);

-- --------------------------------------------------------

--
-- Table structure for table `tblpurchaseorder`
--

CREATE TABLE `tblpurchaseorder` (
  `nopo` text NOT NULL,
  `tanggalpo` date NOT NULL,
  `idcust` int(11) NOT NULL,
  `idpiccust` int(11) NOT NULL,
  `idmarketing` int(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpurchaseorder`
--

INSERT INTO `tblpurchaseorder` (`nopo`, `tanggalpo`, `idcust`, `idpiccust`, `idmarketing`, `potongan`, `ppn`, `total`) VALUES
('12345', '2021-03-29', 3, 4, 2, 5, 10, 4250000),
('0000', '2021-03-31', 3, 5, 3, 5, 10, 4250000);

-- --------------------------------------------------------

--
-- Table structure for table `tblpurchaseorder_detail`
--

CREATE TABLE `tblpurchaseorder_detail` (
  `nopo` text NOT NULL,
  `idbarang` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpurchaseorder_detail`
--

INSERT INTO `tblpurchaseorder_detail` (`nopo`, `idbarang`, `harga`, `quantity`, `status`) VALUES
('12345', 0, 5000, 1000, 1),
('0000', 0, 5000, 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupp`
--

CREATE TABLE `tblsupp` (
  `idsupp` int(11) NOT NULL,
  `npwp` bigint(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsupp`
--

INSERT INTO `tblsupp` (`idsupp`, `npwp`, `nama`, `alamat`, `telepon`) VALUES
(0, 123456789, 'test', 'test', 37194371247),
(3, 2131244455455, 'coba', 'coba', 31120831208302);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `skpd` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`username`, `password`, `skpd`, `type`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', '001', 'ADMIN'),
('test', 'cc03e747a6afbbcbf8be7668acfebee5', '', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbarang`
--
ALTER TABLE `tblbarang`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `idsupp` (`idsupp`);

--
-- Indexes for table `tblcust`
--
ALTER TABLE `tblcust`
  ADD PRIMARY KEY (`idcust`);

--
-- Indexes for table `tblmarketing`
--
ALTER TABLE `tblmarketing`
  ADD PRIMARY KEY (`idmarketing`);

--
-- Indexes for table `tblpiccust`
--
ALTER TABLE `tblpiccust`
  ADD PRIMARY KEY (`idpiccust`);

--
-- Indexes for table `tblsupp`
--
ALTER TABLE `tblsupp`
  ADD PRIMARY KEY (`idsupp`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`username`,`skpd`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbarang`
--
ALTER TABLE `tblbarang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcust`
--
ALTER TABLE `tblcust`
  MODIFY `idcust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmarketing`
--
ALTER TABLE `tblmarketing`
  MODIFY `idmarketing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpiccust`
--
ALTER TABLE `tblpiccust`
  MODIFY `idpiccust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblsupp`
--
ALTER TABLE `tblsupp`
  MODIFY `idsupp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbarang`
--
ALTER TABLE `tblbarang`
  ADD CONSTRAINT `tblbarang_ibfk_1` FOREIGN KEY (`idsupp`) REFERENCES `tblsupp` (`idsupp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
