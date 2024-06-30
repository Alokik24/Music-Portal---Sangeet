-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 10:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sangeet1`
--
CREATE DATABASE IF NOT EXISTS `sangeet1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sangeet1`;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `album_no` int(11) DEFAULT NULL,
  `album_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `albums`:
--   `artist_id`
--       `artists` -> `artist_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `artists`:
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `comments`:
--   `user_id`
--       `users` -> `user_id`
--   `song_id`
--       `songs` -> `song_id`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `song_id`, `comment`) VALUES
(1, 3, 5, 's'),
(2, 3, 5, 'dd'),
(3, 3, 8, 'ss'),
(4, 3, 1, 'hiu\r\n'),
(5, 4, 3, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `user_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `likes`:
--   `user_id`
--       `users` -> `user_id`
--   `song_id`
--       `songs` -> `song_id`
--

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `song_id`) VALUES
(3, 6),
(3, 11),
(3, 1),
(2, 8),
(2, 1),
(4, 3),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
CREATE TABLE `music` (
  `music_id` int(11) NOT NULL,
  `album_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `music`:
--   `album_id`
--       `albums` -> `album_id`
--   `song_id`
--       `songs` -> `song_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE `playlists` (
  `playlist_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `playlist_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `playlists`:
--   `user_id`
--       `users` -> `user_id`
--

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`playlist_id`, `user_id`, `playlist_name`, `description`) VALUES
(1, 1, 'Liked Songs', 'Auto-generated Liked Songs'),
(2, NULL, 'd', ''),
(3, NULL, 'ss', ''),
(4, NULL, 'sorry ', ''),
(5, NULL, 'ss', ''),
(6, NULL, 'si', ''),
(7, NULL, 'aa', '');

-- --------------------------------------------------------

--
-- Table structure for table `playlist_songs`
--

DROP TABLE IF EXISTS `playlist_songs`;
CREATE TABLE `playlist_songs` (
  `playlist_id` int(11) DEFAULT NULL,
  `song_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `playlist_songs`:
--   `playlist_id`
--       `playlists` -> `playlist_id`
--   `song_id`
--       `songs` -> `song_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE `songs` (
  `song_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `artist` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `songs`:
--

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `title`, `artist`, `genre`, `file_path`, `thumbnail`, `likes`) VALUES
(1, 'Maahi Ve', 'A.R. Rahman', NULL, 'songs/A.R. Rahman - Maahi Ve.mp3', 'thumbnails/A.R. Rahman - Maahi Ve.jpg', 8),
(2, 'Pehla Pyaar', 'Armaan Malik', NULL, 'songs/Armaan Malik - Pehla Pyaar.mp3', 'thumbnails/Armaan Malik - Pehla Pyaar.jpg', 2),
(3, 'Tera Zikr', 'Darshan Raval', NULL, 'songs/Darshan Raval - Tera Zikr.mp3', 'thumbnails/Darshan Raval - Tera Zikr.jpg', 1),
(4, 'Dance The Night (From Barbie The Album) [Official Music Video]', 'Dua Lipa', NULL, 'songs/Dua Lipa - Dance The Night (From Barbie The Album) [Official Music Video].mp3', 'thumbnails/Dua Lipa - Dance The Night (From Barbie The Album) [Official Music Video].jpg', 0),
(5, 'Believer', 'Imagine Dragons', NULL, 'songs/Imagine Dragons - Believer.mp3', 'thumbnails/Imagine Dragons - Believer.jpg', 0),
(6, 'the magical woods', 'Kaazoom', NULL, 'songs/Kaazoom - the magical woods.mp3', 'thumbnails/Kaazoom - the magical woods.jpg', 1),
(7, 'Iktara', 'Kavita Seth, Amit Trivedi, Amitabh Bhattacharya', NULL, 'songs/Kavita Seth, Amit Trivedi, Amitabh Bhattacharya - Iktara.mp3', 'thumbnails/Kavita Seth, Amit Trivedi, Amitabh Bhattacharya - Iktara.jpg', 0),
(8, 'keeps me high', 'Kellepics', NULL, 'songs/Kellepics - keeps me high.mp3', 'thumbnails/Kellepics - keeps me high.jpg', 3),
(9, 'Aa chalke tujhe', 'Kishore kumar', NULL, 'songs/Kishore kumar - Aa chalke tujhe.mp3', 'thumbnails/Kishore kumar - Aa chalke tujhe.jpg', 0),
(10, 'Taarif Karoon Kya Uski', 'Mohammed Rafi', NULL, 'songs/Mohammed Rafi - Taarif Karoon Kya Uski.mp3', 'thumbnails/Mohammed Rafi - Taarif Karoon Kya Uski.jpg', 0),
(11, 'Water', 'Tyla, Travis Scott', NULL, 'songs/Tyla, Travis Scott - Water.mp3', 'thumbnails/Tyla, Travis Scott - Water.jpg', 1),
(12, 'I Remember Everything (feat. Kacey Musgraves)', 'Zach Bryan', NULL, 'songs/Zach Bryan - I Remember Everything (feat. Kacey Musgraves).mp3', 'thumbnails/Zach Bryan - I Remember Everything (feat. Kacey Musgraves).jpg', 0),
(13, 'Kisi Ki Muskurahaton pe', 'kishore', NULL, 'songs/kishore - Kisi Ki Muskurahaton pe.mp3', 'thumbnails/kishore - Kisi Ki Muskurahaton pe.jpg', 0),
(14, 'Khwab ho tum ya koi haqeeqat', 'kishore Kumar', NULL, 'songs/kishore Kumar - Khwab ho tum ya koi haqeeqat.mp3', 'thumbnails/kishore Kumar - Khwab ho tum ya koi haqeeqat.jpg', 0),
(15, 'ghost', 'urban beatsss', NULL, 'songs/urban beatsss - ghost.mp3', 'thumbnails/urban beatsss - ghost.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `user_type` enum('listener','artist','admin') DEFAULT 'listener'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email_id`, `username`, `password`, `phone_no`, `registration_date`, `user_type`) VALUES
(1, 'alokikgarg24@gmail.com', 'alokik', '$2y$10$te8ZqsIRrXG9SJLwrK/nSuJfe9udJLDlTJu6gnvso.sFYrV6eqXkq', '6378486701', '2023-11-29', 'listener'),
(2, 'qwf@example.com', 'alokik2', '$2y$10$06lVVU.m8vgl9WSKQAj7fO0KyI5mLQ5bswuWcwwxVfM7tAbsN9KJm', '1111111111', '2023-11-29', 'listener'),
(3, 'q2@gmail.com', 'alokik3', '$2y$10$oaIpyNAc3bg3t/YmIzmQMuylpag/yGqmQnFZE7r2yULO.XG87F6/K', '1234567890', '2023-11-29', 'listener'),
(4, 'qq@j.m', 'manav', '$2y$10$u4kfTIb295vxUmbtgmhyguTxxQ3eG0lfShQGZF16YwmPnQkkO.UiO', '1111111111', '2023-11-29', 'listener');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`music_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`playlist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`),
  ADD CONSTRAINT `music_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `playlist_songs`
--
ALTER TABLE `playlist_songs`
  ADD CONSTRAINT `playlist_songs_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`playlist_id`),
  ADD CONSTRAINT `playlist_songs_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
