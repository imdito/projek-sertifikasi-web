-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2025 at 04:05 PM
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
(3, 4, 3, '2025-10-27 21:24:40'),
(4, 2, 3, '2025-10-27 21:30:13'),
(6, 2, 2, '2025-10-27 21:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(9) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `genre` enum('romance','action','comedy','horror') NOT NULL,
  `sutradara` varchar(30) NOT NULL,
  `gambar` text NOT NULL DEFAULT 'https://www.yobelscm.biz/mexico/wp-content/uploads/sites/12/woocommerce-placeholder.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `judul`, `genre`, `sutradara`, `gambar`) VALUES
(2, 'alis in sunda', 'action', 'ga tau', 'https://imgs.search.brave.com/_WBHPbcdJYo0Y5g16OzsTmEumb8AAGZqA1rvnuuyFKI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMud2lraWEubm9j/b29raWUubmV0L2Fs/aWNlaW5ib3JkZXJs/YW5kL2ltYWdlcy8z/LzMxL0FsaWNlX2lu/X0JvcmRlcmxhbmRf/KE5ldGZsaXgpX1Nl/YXNvbl8xX1Bvc3Rl/cl8wMS5qcGcvcmV2/aXNpb24vbGF0ZXN0/L3NjYWxlLXRvLXdp/ZHRoLWRvd24vMjY3/P2NiPTIwMjAxMjEx/MDc0MTM1'),
(3, 'doraemon', 'comedy', 'kenchiro', 'https://imgs.search.brave.com/_UQzQV_jFjYiwNWxASMpxddxu6ZsMROOPKkvioCEW4E/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL00v/TVY1QllUSmlNREV4/TW1FdE1qbGlNQzAw/WkRKaExXRXlaR010/TkRJMllqTXpaRGhr/WldZMFhrRXlYa0Zx/Y0djQC5qcGc'),
(4, 'tes', 'horror', 'aloksss', 'https://imgs.search.brave.com/r5if-auvuuYKws87SCrrsflZlpknRCug8hPd11gA8qI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJjYXZlLmNv/bS93cC93cDYwMDQ3/MTAuanBn'),
(5, 'bokef', 'comedy', 'kkjgk', 'https://imgs.search.brave.com/O5jXugQiIbiWt70oYrV52ck-XTBlL4G1cXKwJGsA9XQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZS50bWRiLm9yZy90/L3Avb3JpZ2luYWwv/dzdqYWtnSlZOOUVK/bzl5QlVQa2x0MGpw/bXZzLmpwZw');

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
(4, 'admin', 'admin@admin.com', '$2y$10$NqhgIG.DVX3m9FhEiX/wGuHFs2Ql7GZjFwLriyy0y84kJZn1jcBKe', 'admin', '2025-10-27 09:58:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_movie` (`id_movie`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bookmark_ibfk_2` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
