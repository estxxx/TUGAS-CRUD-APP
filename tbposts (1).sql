-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Apr 2024 pada 07.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `tbposts`
--

CREATE TABLE `tbposts` (
  `post_id` varchar(10) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbposts`
--

INSERT INTO `tbposts` (`post_id`, `title`, `content`, `date`, `category`, `image`) VALUES
('001', 'coba', 'coba', '2024-04-03', 'coba', 'WhatsApp Image 2024-04-26 at 03.58.13_dda8be02.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbposts`
--
ALTER TABLE `tbposts`
  ADD PRIMARY KEY (`post_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
