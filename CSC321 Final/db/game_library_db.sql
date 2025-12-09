-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 07:29 AM
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
-- Database: `game_library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `release_year` int(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `title`, `genre`, `platform`, `release_year`, `image`, `description`) VALUES
(1, 'Minecraft', 'Sandbox', NULL, 2011, 'images/minecraft.jpg', 'Build, explore, and survive in a blocky world.'),
(2, 'Wii Sports', 'Sports', NULL, 2006, 'images/wiiSports.jpg', 'A collection of sports simulations using the motion sense of the Wii remote.'),
(3, 'Red Dead Redemption 2', 'Action-adventure', NULL, 2018, 'images/redDeadRedemption2.jpg', 'Play as an outlaw set in the late 1800s in a vast open world.'),
(4, 'The Oregon Trail', 'Strategy', NULL, 1971, 'images/oregonTrail.jpg', 'Manage your supplies, make decisions, and survive on your journey to Oregon.'),
(5, 'Cyberpunk 2077', 'Action role-playing', NULL, 2020, 'images/cyberpunk.jpg', 'Navigate a world filled with crime in this futuristic open world RPG.'),
(6, 'The Sims', NULL, NULL, NULL, 'https://upload.wikimedia.org/wikipedia/en/2/22/The_Sims_Coverart.png?20180311170203', 'Create and control people in an open sandbox world.'),
(11, 'Super Mario Bros.', NULL, NULL, NULL, 'https://upload.wikimedia.org/wikipedia/en/0/03/Super_Mario_Bros._box.png', 'Super Mario Bros. is a 1985 platform game developed and published by Nintendo for the NES, it is the successor to the 1983 arcade game Mario Bros. and the first game in the Super Mario series. Players control Mario, or his brother Luigi in the multiplayer mode, to traverse the Mushroom Kingdom to rescue Princess Peach from Bowser. They traverse side-scrolling stages while avoiding hazards such as enemies and pits and collecting power-ups such as the Super Mushroom, Fire Flower and Starman.'),
(12, 'Sonic The Hedgehog', NULL, NULL, NULL, 'https://upload.wikimedia.org/wikipedia/en/b/ba/Sonic_the_Hedgehog_1_Genesis_box_art.jpg', 'Sonic the Hedgehog is a 1991 platform game developed and published by Sega for the Sega Genesis. The player controls Sonic, a hedgehog who can run at supersonic speeds. The story follows Sonic as he aims to foil the mad scientist Doctor Eggman\'s plans to seek the powerful Chaos Emeralds. The gameplay involves collecting rings as a form of health.');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `game_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `review_text` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `game_id`, `user_id`, `rating`, `review_text`) VALUES
(1, 1, 1, NULL, 'Really good game'),
(2, 2, 1, NULL, 'It\'s a really good game, it was a core part of my childhood.'),
(3, 3, 1, NULL, 'One of the best games ever, it made me cry.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'JohnDoe@email.com', 'Password1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
