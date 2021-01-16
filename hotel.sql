-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2021 at 08:39 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) UNSIGNED NOT NULL,
  `p` varchar(1000) NOT NULL,
  `vedio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `p`, `vedio`) VALUES
(3, 'Maecenas Sollicitudin Tincidunt Maximus. Morbi Tempus Malesuada Erat Sed Pellentesque. Donec Pharetra Mattis Nulla, Id Laoreet Neque Scelerisque At. Quisque Eget Sem Non Ligula Consectetur Ultrices In Quis Augue. Donec Imperd Iet Leo Eget Tortor Dictum, Eget Varius Eros Sagittis. Curabitur Tempor Dignissim Massa Ut Faucibus Sollicitudin Tinci Dunt Maximus. Morbi Tempus Malesuada Erat Sed Pellentesque. Donec Pharetra Mattis Nulla, Id Laoreet Neque Scele Risque At. Quisque Eget Sem Non Ligula Consectetur Ultrices In Quis Augue. Donec Imperdiet Leo Eget Tortor Dictum, Eget Varius Eros Sagittis. Curabitur Tempor Dignissim Massa Ut Faucibus.', 'video_about_us5ff8720687769.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `all_foods`
--

CREATE TABLE `all_foods` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `details` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_foods`
--

INSERT INTO `all_foods` (`id`, `name`, `type`, `price`, `details`, `image`) VALUES
(2, 'Grilled Crab With Onion', 'dinner', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5fe3a6aa8671f.webp'),
(4, 'Grilled Crab With Onion', 'BREAKFAST', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff9925febd43.webp'),
(5, 'Grilled Crab With Onion', 'BREAKFAST', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff9929aea7a5.webp'),
(6, 'Grilled Crab With Onion', 'BREAKFAST', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff992c592c1e.webp'),
(7, 'Grilled Crab With Onion', 'BREAKFAST', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff992e4c893c.webp'),
(8, 'Grilled Crab With Onion', 'LUNCH', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff9930024ce3.webp'),
(9, 'Grilled Crab With Onion', 'LUNCH', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff9932b82f3f.webp'),
(10, 'Grilled Crab With Onion', 'LUNCH', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff9933b230a6.webp'),
(11, 'Grilled Crab With Onion', 'dinner', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff99356bcc98.webp'),
(12, 'Grilled Crab With Onion', 'dinner', 20, 'A Small River Named Duden Flows By Their Place And Supplies', 'food5ff9936e43cb8.webp');

-- --------------------------------------------------------

--
-- Table structure for table `all_rooms`
--

CREATE TABLE `all_rooms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `empty` varchar(255) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_rooms`
--

INSERT INTO `all_rooms` (`id`, `name`, `type`, `check_in`, `check_out`, `empty`) VALUES
(8, 'A1', 'single room', NULL, NULL, 'yes'),
(9, 'A2', 'single room', NULL, NULL, 'yes'),
(10, 'A3', 'single room', NULL, NULL, 'yes'),
(11, 'B1', 'double room', NULL, NULL, 'yes'),
(12, 'B2', 'double room', '2021-01-14', '2021-01-18', 'no'),
(13, 'C1', 'Quad room', NULL, NULL, 'yes'),
(14, 'D1', 'Triple room', NULL, NULL, 'yes'),
(15, 'D2', 'Triple room', NULL, NULL, 'yes'),
(16, 'E1', 'Queen room', NULL, NULL, 'yes'),
(17, 'E2', 'Queen room', '2021-01-12', '2021-01-19', 'no'),
(21, 'B3', 'double room', NULL, NULL, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL DEFAULT 0,
  `room_type` varchar(255) NOT NULL,
  `number_of_rooms` int(11) NOT NULL,
  `rooms_names` varchar(255) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `paid` varchar(255) NOT NULL DEFAULT 'no',
  `expire_day` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `national_id`, `check_in`, `check_out`, `adults`, `children`, `room_type`, `number_of_rooms`, `rooms_names`, `total_cost`, `notes`, `paid`, `expire_day`) VALUES
(7, 'samir hussein', '01144435326', '131235451131235', '2021-01-10', '2021-01-11', 3, 1, 'Quad room', 1, 'C1', 450, '', 'yes', NULL),
(10, 'samir ebrahim', '01144435326', '5564321321541321', '2021-01-16', '2021-01-19', 3, 1, 'Queen room,single room', 2, 'E2-A1', 4550, '', 'no', NULL),
(11, 'samir ebrahim', '01144435326', '5564321321541321', '2021-01-12', '2021-01-19', 3, 1, 'Queen room,single room', 2, 'E1-A2', 4550, '', 'no', NULL),
(12, 'Grilled Crab With Onion', '123', '14', '2021-01-12', '2021-01-14', 1, 1, 'single room', 1, 'A3', 300, '', 'yes', NULL),
(13, 'Grilled Crab With Onion', '123', '14', '2021-01-12', '2021-01-14', 1, 0, 'single room', 1, 'A3', 300, '', 'yes', NULL),
(15, 'Grilled Crab With Onion', '01155464', '14', '2021-01-12', '2021-01-19', 1, 0, 'single room', 1, 'A1', 1050, '', 'no', NULL),
(17, 'hbhjbhjbvf', '212316513', '223123132', '2021-01-12', '2021-01-19', 1, 1, 'single room', 1, 'A1', 1050, 'djnfvbdvbhjfvbdfvbjhdfvbdfvbhvdvhjdbfvhdbvhjbdfhvbfbvdjbvfj', 'no', NULL),
(18, 'admin', '01155464', '14', '2021-01-12', '2021-01-15', 3, 2, 'single room,Triple room', 2, 'A1-D1', 1500, '', 'yes', NULL),
(19, 'Grilled Crab With Onion', '01155464', '565465132132132', '2021-01-13', '2021-01-16', 3, 2, 'double room,single room', 2, 'B1-A1', 800, '', 'yes', NULL),
(21, 'F3, GLI M/T', '01033324218', '19', '2021-01-14', '2021-01-18', 2, 1, 'double room', 1, 'B2', 1000, '', 'yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_departments`
--

CREATE TABLE `food_departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_departments`
--

INSERT INTO `food_departments` (`id`, `type`) VALUES
(1, 'BREAKFAST'),
(2, 'LUNCH'),
(6, 'dinner');

-- --------------------------------------------------------

--
-- Table structure for table `home_slider`
--

CREATE TABLE `home_slider` (
  `id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `h` varchar(255) NOT NULL,
  `p` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `home_slider`
--

INSERT INTO `home_slider` (`id`, `image`, `h`, `p`) VALUES
(6, 'home_slider5ff86efa90976.webp', 'Amazing Hotel', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.'),
(7, 'home_slider5ff86f16bb253.webp', 'Amazing Hotel', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.'),
(8, 'home_slider5ff86f2ac00e3.webp', 'Amazing Hotel', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit.');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_images`
--

CREATE TABLE `hotel_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_images`
--

INSERT INTO `hotel_images` (`id`, `image`) VALUES
(7, 'hotel_images5ff872f7a3590.webp'),
(8, 'hotel_images5ff872f7a35de.webp'),
(9, 'hotel_images5ff872f7a361b.webp'),
(10, 'hotel_images5ff872f7a3646.webp'),
(11, 'hotel_images5ff872f7a3672.webp'),
(12, 'hotel_images5ff872f7a369e.webp');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_types`
--

CREATE TABLE `rooms_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `facilities` varchar(255) NOT NULL,
  `Categories` varchar(255) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms_types`
--

INSERT INTO `rooms_types` (`id`, `name`, `cost`, `adults`, `children`, `facilities`, `Categories`, `bed_type`, `image`) VALUES
(7, 'double room', 250, 2, 1, 'Closet With Hangers, Hd Flat-Screen Tv, Telephone', 'double', 'two bed', 'room5ff998925c942.webp'),
(9, 'Quad room', 450, 4, 2, 'closet with hangers, hd flat-screen tv, telephone', 'Quad', 'four beds', 'room5ff9990c2c3ce.webp'),
(10, 'Queen room', 500, 2, 0, 'closet with hangers, hd flat-screen tv, telephone', 'Queen', 'one bed', 'room5ff99994d136a.webp'),
(6, 'single room', 150, 1, 1, 'Closet With Hangers, Hd Flat-Screen Tv, Telephone', 'single', 'one bed', 'room5ff9986c3c477.webp'),
(8, 'Triple room', 350, 3, 2, 'closet with hangers, hd flat-screen tv, telephone', 'Triple', 'three beds', 'room5ff998cd05f9f.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `type`) VALUES
(1, 'samir hussein', 'samirhussein274@gmail.com', '$2y$10$8MT2VQ979F.S20jZ0T3/BOsvISgjFbbWd8Sg3.RMiF1BCq098aIqi', 'owner'),
(4, 'admin', 'admin@admin.com', '$2y$10$2.SvuJRXxyY5fC4eslEUiubuaUBa4xhEpR1m/LiePwlH9.XB.38y6', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `visitor_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `visitor_id`) VALUES
(1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `total_visits` bigint(255) NOT NULL DEFAULT 0,
  `daily_visits` bigint(255) NOT NULL DEFAULT 0,
  `today` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`total_visits`, `daily_visits`, `today`) VALUES
(167, 1, '16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_foods`
--
ALTER TABLE `all_foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `all_rooms`
--
ALTER TABLE `all_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_departments`
--
ALTER TABLE `food_departments`
  ADD PRIMARY KEY (`type`),
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `home_slider`
--
ALTER TABLE `home_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_images`
--
ALTER TABLE `hotel_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms_types`
--
ALTER TABLE `rooms_types`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `all_foods`
--
ALTER TABLE `all_foods`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `all_rooms`
--
ALTER TABLE `all_rooms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `food_departments`
--
ALTER TABLE `food_departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `home_slider`
--
ALTER TABLE `home_slider`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotel_images`
--
ALTER TABLE `hotel_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rooms_types`
--
ALTER TABLE `rooms_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_foods`
--
ALTER TABLE `all_foods`
  ADD CONSTRAINT `all_foods_ibfk_1` FOREIGN KEY (`type`) REFERENCES `food_departments` (`type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `all_rooms`
--
ALTER TABLE `all_rooms`
  ADD CONSTRAINT `all_rooms_ibfk_1` FOREIGN KEY (`type`) REFERENCES `rooms_types` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
