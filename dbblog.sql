-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2024 at 01:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id` int NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id`, `username`, `email`, `password`) VALUES
(1, 'ESTI', 'imalistiyatus13@gmail.com', '1234'),
(2, 'a', 'hdsh@gmail.com', '1234'),
(3, 'b', 'gdgd@gmail.com', '1234'),
(4, 'eestii.1', 'hiiiestii@gmail.com', '1234'),
(5, 'a', 'ay@gmail.com', '1234'),
(6, 'as', 'as@gmail.com', '1234'),
(7, 'ESTI', 'imalistiyatus13@gmail.com', '0'),
(8, 'v', 'v@gmail.com', '0'),
(9, 'ESTI', 'a@gmail.com', '0'),
(10, 'abe', 'b@gmail.com', '0'),
(11, 'd', 'divisikwu.hmif@gmail.com', '0'),
(12, 's', 'sa@gmail.com', '$2y$10$7qWujbpe3oL33rUCKtC2dud4ft/0YIONpTENmWglsj115Oh/UWLhe'),
(13, 'admin', 'admin@mail.com', '$2y$10$TXo7HAsr7Ld2uoK.WNG/puX.JNwL3zRR6x4a61pkWGnvuQtuZavMu'),
(14, 'admin', 'admin@mail.com', '$2y$10$v9WMaaoWRd5Fq6Q23f.TIOT6wWTHEzB0DubwyBkO0B71BzwgBAG3K');

-- --------------------------------------------------------

--
-- Table structure for table `tbposts`
--

CREATE TABLE `tbposts` (
  `post_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `category` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbposts`
--

INSERT INTO `tbposts` (`post_id`, `title`, `content`, `date`, `category`, `image`) VALUES
('001', 'coba', 'coba', '2024-04-03', 'coba', 'WhatsApp Image 2024-04-26 at 03.58.13_dda8be02.jpg'),
('4', 'bismillah bisa', 'yeyy bisa', '2023-01-01', 'semangattt', 'MSI.jpg'),
('5', 'yuk bisa yuk', 'harus bisa', '2023-01-01', 'penting', 'lenovo.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbposts`
--
ALTER TABLE `tbposts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
