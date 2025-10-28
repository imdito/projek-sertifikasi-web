-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2025 at 03:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `id_movie`, `id_user`, `created_at`) VALUES
(2, 3, 3, '2025-10-27 21:24:28'),
(8, 3, 6, '2025-10-28 11:42:14'),
(11, 8, 5, '2025-10-28 21:02:05'),
(12, 3, 5, '2025-10-28 21:02:31'),
(13, 12, 5, '2025-10-28 21:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(9) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `genre` enum('romance','action','comedy','horror') NOT NULL,
  `sutradara` varchar(30) NOT NULL,
  `sinopsis` text NOT NULL,
  `gambar` text NOT NULL DEFAULT 'https://www.yobelscm.biz/mexico/wp-content/uploads/sites/12/woocommerce-placeholder.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `judul`, `genre`, `sutradara`, `sinopsis`, `gambar`) VALUES
(3, 'doraemonv2', 'action', 'kenchiro', 'film anak anak yang ceria dan menyenangkan', 'https://imgs.search.brave.com/_UQzQV_jFjYiwNWxASMpxddxu6ZsMROOPKkvioCEW4E/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL00v/TVY1QllUSmlNREV4/TW1FdE1qbGlNQzAw/WkRKaExXRXlaR010/TkRJMllqTXpaRGhr/WldZMFhrRXlYa0Zx/Y0djQC5qcGc'),
(8, 'Sore: Istri Dari Masa Depan', 'romance', 'Yandy Laurens', 'Menceritakan seorang istri yang tiba tiba datang dari masa depan', 'https://imgs.search.brave.com/pbjKJecxOHx7xtnn8CLRv3ha8pP8kp2XdBY198fMfAs/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9hc3Nl/dC50aXguaWQvd3At/Y29udGVudC91cGxv/YWRzLzIwMjUvMDcv/ZDhiMWVjZTctNjhi/NC00OTU4LWE3NGIt/ZTM5MjVkNjNiNDc1/LTYwMHg4ODUud2Vi/cA'),
(12, 'loki', 'action', 'cristoper nolan', 'Petualangan loki menjelajahi ruang dan waktu guna menyelamatkan bumi', 'https://imgs.search.brave.com/It64BF0YbBSAw9vpRtFU5qeoe3MSc_mei-WOs2dDlIE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL00v/TVY1Qk1tWmxOR1Jq/TmpZdFlUQTRaUzAw/WWpReExUZzVaVGd0/WTJabVpHWTBOakkz/WTJVelhrRXlYa0Zx/Y0djQC5qcGc');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `id_movie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `konten` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `id_movie`, `id_user`, `konten`, `created_at`) VALUES
(4, 3, 5, 'ini tes doraemon', '2025-10-28 03:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(2, 'tes', 'tes@gmail.com', '$2y$10$FutdiaGZDkC.59nHTVg5k.bMvQA2WwMQW81i57usrXdA56v.Pq9fi', 'user', '2025-10-26 17:28:13'),
(3, 'alok', 'alok@gmail.com', '$2y$10$xJ5Lbx/MI46ZycdMhGhdRuQU3jUmUwi0rUozkjlWmcb3Jtf.dkM4W', 'user', '2025-10-27 09:09:45'),
(4, 'admin', 'admin@admin.com', '$2y$10$NqhgIG.DVX3m9FhEiX/wGuHFs2Ql7GZjFwLriyy0y84kJZn1jcBKe', 'admin', '2025-10-27 09:58:23'),
(5, 'dito', 'panditostwn@gmail.com', '$2y$10$GcEJq8.8CJa2l8/8w/6OxuJ/ted4H3psaQaT.7MTH4OUBXB8O1zku', 'user', '2025-10-28 10:25:28'),
(6, 'pandito', 'pandito@gmail.com', '$2y$10$MVJ.Ml8kX6Ycf.YVEcGa5enGUcyjCrSQiYVyTaexd.lSDvLLQGQaa', 'user', '2025-10-28 11:41:44'),
(7, 'pandito', 'panditoooooo@gmail.com', '$2y$10$yby/4fT0ymdDj8gSkMaZ6OvfjG61pJfHfYSKzohMIMSJPsQwF2ShW', 'user', '2025-10-28 11:49:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_movie` (`id_movie`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_movie` (`id_movie`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bookmark_ibfk_2` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
