-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2017 at 06:24 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mcsy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cctv`
--

CREATE TABLE `cctv` (
  `id_cctv` int(9) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `model` varchar(100) NOT NULL,
  `location` varchar(150) NOT NULL,
  `type` varchar(100) NOT NULL,
  `recorder` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cctv`
--

INSERT INTO `cctv` (`id_cctv`, `ip`, `model`, `location`, `type`, `recorder`) VALUES
(12, '127.0.0.1', '12', '4', '2', '1'),
(13, '190.1.1.1', '13', '5', '2', '2'),
(14, '190.2.3.4', '13', '10', '2', '2'),
(15, '190.3.4.6', '14', '8', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id_holiday` int(9) NOT NULL,
  `nm_holiday` varchar(100) NOT NULL,
  `date_holiday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id_holiday`, `nm_holiday`, `date_holiday`) VALUES
(1, 'Tahun Baru 2017', '2017-01-01'),
(2, 'Meong!', '2017-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id_location` int(11) NOT NULL,
  `location` varchar(200) NOT NULL,
  `ket` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id_location`, `location`, `ket`) VALUES
(4, 'OFC LT3 QA QC', ''),
(5, 'PRINTING', ''),
(6, 'OFC LT3 MRP SMS', ''),
(7, 'FABRIKASI 2', ''),
(8, 'LOADING', ''),
(9, 'PARKIR', ''),
(10, 'SWD', ''),
(11, 'RND', ''),
(12, 'HVAC ELNIC LT 2', ''),
(13, 'MECHANICAL', ''),
(14, 'HVAC LT 1 WH TOOLROOM', '');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id_model` int(11) NOT NULL,
  `nm_model` varchar(100) NOT NULL,
  `ket` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id_model`, `nm_model`, `ket`) VALUES
(12, 'HIKVISION DS-2CD2132-I', '-'),
(13, 'HIKVISION DS-2CD2032F-I', '-'),
(14, 'ANALOG', '-');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `id_monitoring` int(9) NOT NULL,
  `id_cctv` int(9) NOT NULL,
  `date_monitoring` date NOT NULL,
  `status` enum('M','K','H') NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`id_monitoring`, `id_cctv`, `date_monitoring`, `status`, `remark`) VALUES
(2, 2, '2017-01-03', 'H', 'Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor Lorem ipsun dolor '),
(3, 1, '2017-03-03', 'K', 'test'),
(4, 1, '2017-02-03', 'M', 'test'),
(5, 1, '2017-04-11', 'M', 'Meong'),
(7, 6, '2017-03-10', 'H', '-'),
(9, 10, '2017-03-01', 'M', 'mati/rusak/ngeong'),
(10, 9, '2017-03-29', 'K', 'test'),
(11, 10, '2017-03-29', 'K', ''),
(12, 13, '2017-04-03', 'H', ''),
(13, 12, '2017-04-13', 'K', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem ');

-- --------------------------------------------------------

--
-- Table structure for table `recorder`
--

CREATE TABLE `recorder` (
  `id_recorder` int(11) NOT NULL,
  `nm_recorder` varchar(100) NOT NULL,
  `ket` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recorder`
--

INSERT INTO `recorder` (`id_recorder`, `nm_recorder`, `ket`) VALUES
(1, 'NVR-I. iSpy', '-'),
(2, 'NVR-O, iSpy', '-');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `nm_type` varchar(100) NOT NULL,
  `ket` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `nm_type`, `ket`) VALUES
(2, 'Dome', '-'),
(3, 'Bullet', '-'),
(5, 'Other', '-');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `blokir` enum('y','n') NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `username`, `password`, `name`, `blokir`, `level`) VALUES
(1, 'rahmat', 'rahmat', 'Rahmat', 'n', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cctv`
--
ALTER TABLE `cctv`
  ADD PRIMARY KEY (`id_cctv`),
  ADD KEY `id_cctv` (`id_cctv`,`ip`,`model`,`location`,`type`,`recorder`),
  ADD KEY `id_cctv_2` (`id_cctv`,`ip`,`model`,`location`,`type`,`recorder`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id_holiday`),
  ADD KEY `id_holiday` (`id_holiday`,`nm_holiday`,`date_holiday`),
  ADD KEY `id_holiday_2` (`id_holiday`,`nm_holiday`,`date_holiday`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`),
  ADD KEY `id_location` (`id_location`,`location`),
  ADD KEY `id_location_2` (`id_location`,`location`,`ket`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id_model`),
  ADD KEY `id_model` (`id_model`,`nm_model`,`ket`);

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id_monitoring`),
  ADD KEY `id_monitoring` (`id_monitoring`,`id_cctv`,`date_monitoring`,`status`),
  ADD KEY `id_monitoring_2` (`id_monitoring`,`id_cctv`,`date_monitoring`,`status`);

--
-- Indexes for table `recorder`
--
ALTER TABLE `recorder`
  ADD PRIMARY KEY (`id_recorder`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD KEY `idusers` (`idusers`,`username`,`password`,`name`,`blokir`,`level`),
  ADD KEY `idusers_2` (`idusers`,`username`,`password`,`name`,`blokir`,`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cctv`
--
ALTER TABLE `cctv`
  MODIFY `id_cctv` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id_holiday` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id_model` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id_monitoring` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `recorder`
--
ALTER TABLE `recorder`
  MODIFY `id_recorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
