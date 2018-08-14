-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 05:34 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_webitc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nama`, `keterangan`) VALUES
(1, 'php', 'bahasa pemrograman php');

-- --------------------------------------------------------

--
-- Table structure for table `post_details`
--

CREATE TABLE `post_details` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` varchar(32) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_details`
--

INSERT INTO `post_details` (`id`, `id_post`, `id_user`, `id_category`) VALUES
(1, 1, '97704685514784769', 0),
(2, 1, '97704685514784769', 0),
(3, 4, '97704685514784769', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_masters`
--

CREATE TABLE `post_masters` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `img` text NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_masters`
--

INSERT INTO `post_masters` (`id`, `id_kategori`, `judul`, `created_at`, `updated_at`, `img`, `isi`) VALUES
(2, 0, 'Pelatihan Basic Java', '2018-06-13 00:11:06', '2018-06-13 11:46:17', 'Desert.jpg', 'Pelatihan Java kali ini sangat dasar jadi diharapkan yang sudah menguasai dasarnya tidak perlu mengikutinya lagipula bisa dipelajari sendiri kok :D'),
(4, 0, 'Pelatihan Web Development Menggunakan Laravel', '2018-06-13 11:15:39', '2018-08-13 15:10:21', '38168668_1763548250428309_2854038800785473536_o.jpg', 'Pada kesempatan kali ini kita akan melaksanakan pelatihan web development, pelatihan ini merupakan pelatihan tahunan jadi yang belum mendapat kesempatan pada pelatihan kali ini bisa mencoba tahun depan, tapi saya sarankan untuk memulai belajar sendiri, karena kemampuan untuk belajar sendiri itu sangat diperlukan sedangkan dalam pelatihan ini kalau kalian tidak mengulik lagi sendiri mungkin tidak bisa explore lagi lebih jauh lagi tentang pemrograman khususnya web development yang sangat cepat perkembangannya.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nim` int(10) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `level` char(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nim`, `nama_lengkap`, `level`, `created_at`, `updated_at`) VALUES
('97797700732321792', 'admin1', '$2y$12$w23awHuMIqiWGghV0r.3/ONiLCZQTNESwNW2q8Xti.BG2b2jD9fOq', 'admin1@itc.com', 0, NULL, 'A', '2018-08-14 01:09:49', '0000-00-00 00:00:00'),
('97797700732321793', 'member1', '$2y$12$7Cy5zkJAOjpBDWe4NvOO/OYbyTnvuRwYTK9QhqFfKkfYMiQmdcFUa', 'member1@itc.com', 0, NULL, 'U', '2018-08-14 02:43:56', '2018-08-14 02:43:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_details`
--
ALTER TABLE `post_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_masters`
--
ALTER TABLE `post_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`,`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_details`
--
ALTER TABLE `post_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_masters`
--
ALTER TABLE `post_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
