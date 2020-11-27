-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Oct 17, 2020 at 11:03 PM
-- Server version: 10.5.5-MariaDB-1:10.5.5+maria~focal
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `Alojamiento`
--

CREATE TABLE `Alojamiento` (
  `idAlojamiento` int(20) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `metrosCuadrados` decimal(5,2) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Galeria`
--

CREATE TABLE `Galeria` (
  `idAlojamiento` varchar(20) NOT NULL,
  `num` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `extension` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `DNI` varchar(9) NOT NULL,
  `nick` varchar(30) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellidos` varchar(120) NOT NULL,
  `telefono` int(9) NOT NULL,
  `FechNac` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `clave` TEXT NOT NULL,
  `cuenta` BLOB NOT NULL,
  `rol` enum('Admin','Cliente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Usuario`
--

-- Clave de Admin: 123abc
INSERT INTO `Usuario` (`DNI`, `nick`, `Nombre`, `Apellidos`, `telefono`, `FechNac`, `email`, `clave`, `cuenta`, `rol`) VALUES
('11111111A', 'admin', 'Admin', 'Administrador', 111111111, '0000-00-00', 'admin@email.com', '$2y$10$cI0NukwYTDbyx.YDsE6Haefpn1h2eUMVyEf96Fo.FYzwaef30J3ve', AES_ENCRYPT('ES481324567899846', '8A68AKSGGBHBSDEW465892456IWR38YR732') , 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Alojamiento`
--
ALTER TABLE `Alojamiento`
  ADD PRIMARY KEY (`idAlojamiento`);

--
-- Indexes for table `Galeria`
--
ALTER TABLE `Galeria`
  ADD PRIMARY KEY (`idAlojamiento`,`num`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Alojamiento`
--
ALTER TABLE `Alojamiento`
  MODIFY `idAlojamiento` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
