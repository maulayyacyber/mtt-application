-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Apr 2017 pada 06.54
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_panitia`
--

CREATE TABLE `tbl_panitia` (
  `id_panitia` int(11) NOT NULL,
  `nama_panitia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_panitia`
--

INSERT INTO `tbl_panitia` (`id_panitia`, `nama_panitia`) VALUES
(1, 'testdadad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_panitia`
--
ALTER TABLE `tbl_panitia`
  ADD PRIMARY KEY (`id_panitia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_panitia`
--
ALTER TABLE `tbl_panitia`
  MODIFY `id_panitia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
