-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 09:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stagiarealten`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `Id` int(20) NOT NULL,
  `NomCertificat` text NOT NULL,
  `Programme` varchar(200) NOT NULL,
  `DateObtention` int(20) NOT NULL,
  `StagiaireId` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`Id`, `NomCertificat`, `Programme`, `DateObtention`, `StagiaireId`) VALUES
(1, 'Linux Essentials Certificate', 'Linux', 2023, 'CD70461');

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `Id` int(30) NOT NULL,
  `FormationTitre` varchar(200) NOT NULL,
  `Etablissement` varchar(100) NOT NULL,
  `Branche` varchar(100) NOT NULL,
  `DateDebut` varchar(20) NOT NULL,
  `DateFin` varchar(20) NOT NULL,
  `StagiaireId` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formations`
--

INSERT INTO `formations` (`Id`, `FormationTitre`, `Etablissement`, `Branche`, `DateDebut`, `DateFin`, `StagiaireId`) VALUES
(1, '3 ème année Licence', 'ESISA', 'Ingenierie Logicielle', '2021', '2025', 'CD70461');

-- --------------------------------------------------------

--
-- Table structure for table `stagiareform`
--

CREATE TABLE `stagiareform` (
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Genre` varchar(2) NOT NULL,
  `CIN` varchar(30) NOT NULL,
  `DateN` date NOT NULL,
  `Email` varchar(200) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `Adresse` varchar(300) NOT NULL,
  `Ecole` varchar(200) NOT NULL,
  `AdresseEcole` varchar(200) NOT NULL,
  `FixEcole` varchar(20) NOT NULL,
  `Filiere` varchar(100) NOT NULL,
  `EncadrantAcd` varchar(200) NOT NULL,
  `EncadrantTel` varchar(20) NOT NULL,
  `EncadrantEmail` varchar(300) NOT NULL,
  `PeriodeStage` varchar(100) NOT NULL,
  `Departement` varchar(200) NOT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `Pieces` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stagiareform`
--

INSERT INTO `stagiareform` (`Nom`, `Prenom`, `Genre`, `CIN`, `DateN`, `Email`, `telephone`, `Adresse`, `Ecole`, `AdresseEcole`, `FixEcole`, `Filiere`, `EncadrantAcd`, `EncadrantTel`, `EncadrantEmail`, `PeriodeStage`, `Departement`, `DateDebut`, `DateFin`, `Pieces`) VALUES
('Elidrissi', 'Yassine', 'ga', 'CD70461', '2001-09-25', 'yassine.elidrissi@alten.com', '0602187341', 'AV SOUSSA RCE CHEMS BLOC B ZOHOUR 2  FES', 'ESISA', '29 bis avenue Ibn Khatib, route D\'imouzzer, Fès', '05 29 03 57 67', 'Ingenierie Logicielle', '', '', '', '2 mois', 'IT Service', '2023-07-04', '2023-09-04', 0x53637265656e73686f7420323032332d30372d3131203135333931352e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `stagiareform`
--
ALTER TABLE `stagiareform`
  ADD PRIMARY KEY (`CIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `Id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
