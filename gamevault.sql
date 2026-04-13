-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2026 at 12:58 PM
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
-- Database: `gamevault`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `developer` varchar(100) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `release_year` int(11) DEFAULT NULL,
  `platforms` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `description`, `developer`, `publisher`, `release_year`, `platforms`, `image_url`, `created_at`, `image`) VALUES
(1, 'EA Sports FC 25', 'Sports', 'A football game with updated teams and career modes.', 'EA Vancouver', 'EA Sports', 2024, 'PS5, Xbox, PC', 'assets/images/fc25.jpg', '2026-03-29 01:11:35', 'assets/images/ea_sports_fc_25.jpg'),
(2, 'Resident Evil 4', 'Horror', 'A survival horror remake with action and tense gameplay.', 'Capcom', 'Capcom', 2023, 'PS5, Xbox, PC', 'assets/images/RE4.jpg', '2026-03-29 01:11:35', 'assets/images/RE4.jpg'),
(3, 'Elden Ring', 'RPG', 'An open-world action RPG with difficult combat and exploration.', 'FromSoftware', 'Bandai Namco', 2022, 'PS5, Xbox, PC', 'assets/images/elden_ring.jpg', '2026-03-29 01:11:35', 'assets/images/elden_ring.jpg'),
(4, 'Hades', 'Action', 'A fast-paced roguelike game set in Greek mythology.', 'Supergiant Games', 'Supergiant Games', 2020, 'PC, Switch, PS5', 'assets/images/hades.jpg', '2026-03-29 01:11:35', 'assets/images/hades.jpg'),
(5, 'Super Mario World', 'Retro', 'A classic platform game from the SNES era.', 'Nintendo', 'Nintendo', 1990, 'SNES, Switch', 'assets/images/mario_world.jpg', '2026-03-29 01:11:35', 'assets/images/mario_world.jpg'),
(6, 'Age of Empires II', 'Strategy', 'A classic real-time strategy game with historical civilizations.', 'Ensemble Studios', 'Microsoft', 1999, 'PC', 'assets/images/aoe2.jpg', '2026-03-29 01:11:35', 'assets/images/AOI2.jpg'),
(12, 'Red Dead Redemption 2', 'Action', 'Open-world western adventure with cinematic storytelling.', 'Rockstar Games', 'Rockstar Games', 2018, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/red_dead_redemption_2.jpg'),
(13, 'Grand Theft Auto V', 'Action', 'Open-world crime game with story and online mode.', 'Rockstar North', 'Rockstar Games', 2013, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/grand_theft_auto_v.jpg'),
(14, 'Cyberpunk 2077', 'RPG', 'Futuristic action RPG set in Night City.', 'CD Projekt Red', 'CD Projekt', 2020, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/cyberpunk_2077.jpg'),
(15, 'Baldurs Gate 3', 'RPG', 'Party-based fantasy RPG with choice-driven story.', 'Larian Studios', 'Larian Studios', 2023, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/baldurs_gate_3.jpg'),
(16, 'Helldivers 2', 'Action', 'Co-op shooter focused on teamwork and chaos.', 'Arrowhead Game Studios', 'Sony Interactive Entertainment', 2024, 'PS5, PC', NULL, '2026-03-29 05:06:33', 'assets/images/helldivers_2.jpg'),
(17, 'Marvel Rivals', 'Action', 'Team-based hero shooter with Marvel characters.', 'NetEase Games', 'NetEase Games', 2024, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/marvel_rivals.jpg'),
(18, 'Counter-Strike 2', 'Shooter', 'Competitive tactical shooter with bomb defusal gameplay.', 'Valve', 'Valve', 2023, 'PC', NULL, '2026-03-29 05:06:33', 'assets/images/counter_strike_2.jpg'),
(19, 'Apex Legends', 'Shooter', 'Battle royale shooter with unique legends and abilities.', 'Respawn Entertainment', 'Electronic Arts', 2019, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/apex_legends.jpg'),
(20, 'PUBG Battlegrounds', 'Shooter', 'Battle royale game focused on survival and gunplay.', 'Krafton', 'Krafton', 2017, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/pubg_battlegrounds.jpg'),
(21, 'Fortnite', 'Action', 'Battle royale and creative sandbox game.', 'Epic Games', 'Epic Games', 2017, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/fortnite.jpg'),
(22, 'Minecraft', 'Sandbox', 'Block-building sandbox game with survival and creativity.', 'Mojang Studios', 'Xbox Game Studios', 2011, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/minecraft.jpg'),
(23, 'Roblox', 'Sandbox', 'Platform with user-created games and social experiences.', 'Roblox Corporation', 'Roblox Corporation', 2006, 'PC, Mobile, Console', NULL, '2026-03-29 05:06:33', 'assets/images/roblox.jpg'),
(24, 'Call of Duty Modern Warfare III', 'Shooter', 'Fast-paced military shooter with multiplayer and campaign.', 'Sledgehammer Games', 'Activision', 2023, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/call_of_duty_mw3.jpg'),
(25, 'Warframe', 'Action', 'Free-to-play sci-fi action game with co-op missions.', 'Digital Extremes', 'Digital Extremes', 2013, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/warframe.jpg'),
(26, 'Dead by Daylight', 'Horror', 'Asymmetrical horror multiplayer game.', 'Behaviour Interactive', 'Behaviour Interactive', 2016, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/dead_by_daylight.jpg'),
(27, 'The Witcher 3 Wild Hunt', 'RPG', 'Fantasy RPG with strong story and open-world exploration.', 'CD Projekt Red', 'CD Projekt', 2015, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/the_witcher_3.jpg'),
(28, 'Forza Horizon 5', 'Racing', 'Open-world racing game set in Mexico.', 'Playground Games', 'Xbox Game Studios', 2021, 'Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/forza_horizon_5.jpg'),
(29, 'Gran Turismo 7', 'Racing', 'Simulation racing game with large car collection.', 'Polyphony Digital', 'Sony Interactive Entertainment', 2022, 'PS5', NULL, '2026-03-29 05:06:33', 'assets/images/gran_turismo_7.jpg'),
(30, 'Mario Kart 8 Deluxe', 'Racing', 'Popular kart racing game for multiplayer fun.', 'Nintendo EPD', 'Nintendo', 2017, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/mario_kart_8_deluxe.jpg'),
(31, 'The Legend of Zelda Tears of the Kingdom', 'Adventure', 'Open-world fantasy adventure with exploration and creativity.', 'Nintendo EPD', 'Nintendo', 2023, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/zelda_tears_of_the_kingdom.jpg'),
(32, 'The Legend of Zelda Breath of the Wild', 'Adventure', 'Open-world action adventure set in Hyrule.', 'Nintendo EPD', 'Nintendo', 2017, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/zelda_breath_of_the_wild.jpg'),
(33, 'Super Mario Odyssey', 'Platformer', '3D platformer with creative movement and level design.', 'Nintendo EPD', 'Nintendo', 2017, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/super_mario_odyssey.jpg'),
(34, 'Super Smash Bros Ultimate', 'Fighting', 'Platform fighter with a massive crossover roster.', 'Bandai Namco Studios', 'Nintendo', 2018, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/super_smash_bros_ultimate.jpg'),
(35, 'Animal Crossing New Horizons', 'Simulation', 'Relaxing life simulation on a customizable island.', 'Nintendo EPD', 'Nintendo', 2020, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/animal_crossing_new_horizons'),
(36, 'Pokemon Scarlet', 'RPG', 'Monster collecting RPG set in an open region.', 'Game Freak', 'Nintendo', 2022, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/pokemon_scarlet.jpg'),
(37, 'Pokemon Violet', 'RPG', 'Companion version of Pokemon Scarlet.', 'Game Freak', 'Nintendo', 2022, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/pokemon_violet.jpg'),
(38, 'Pokemon Legends Arceus', 'RPG', 'Action-focused Pokemon adventure in Hisui.', 'Game Freak', 'Nintendo', 2022, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/pokemon_legends_arceus.jpg'),
(39, 'Splatoon 3', 'Shooter', 'Stylish team shooter with ink-based combat.', 'Nintendo EPD', 'Nintendo', 2022, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/splatoon_3.jpg'),
(40, 'Nintendo Switch Sports', 'Sports', 'Motion-based sports collection for casual play.', 'Nintendo', 'Nintendo', 2022, 'Switch', NULL, '2026-03-29 05:06:33', 'assets/images/nintendo_switch_sports.jpg'),
(41, 'Metaphor ReFantazio', 'RPG', 'Fantasy RPG with turn-based combat and political story.', 'Studio Zero', 'Sega', 2024, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/metaphor_refantazio.jpg'),
(42, 'Dragon Ball Sparking Zero', 'Fighting', 'Arena fighter with a large Dragon Ball roster.', 'Spike Chunsoft', 'Bandai Namco', 2024, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/dragon_ball_sparking_zero.jpg'),
(43, 'Black Myth Wukong', 'Action', 'Action game inspired by Journey to the West.', 'Game Science', 'Game Science', 2024, 'PS5, PC', NULL, '2026-03-29 05:06:33', 'assets/images/black_myth_wukong.jpg'),
(44, 'Palworld', 'Survival', 'Creature collection mixed with survival and crafting.', 'Pocketpair', 'Pocketpair', 2024, 'Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/palworld.jpg'),
(45, 'Lethal Company', 'Horror', 'Co-op horror scavenging game with tense atmosphere.', 'Zeekerss', 'Zeekerss', 2023, 'PC', NULL, '2026-03-29 05:06:33', 'assets/images/lethal_company.jpg'),
(46, 'Phasmophobia', 'Horror', 'Co-op ghost hunting horror game.', 'Kinetic Games', 'Kinetic Games', 2020, 'PC', NULL, '2026-03-29 05:06:33', 'assets/images/phasmophobia.jpg'),
(47, 'Stardew Valley', 'Simulation', 'Farming and life simulation with relaxing gameplay.', 'ConcernedApe', 'ConcernedApe', 2016, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/stardew_valley.jpg'),
(48, 'Terraria', 'Sandbox', '2D sandbox adventure with crafting and combat.', 'Re-Logic', 'Re-Logic', 2011, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/terraria.jpg'),
(49, 'No Mans Sky', 'Adventure', 'Space exploration game with base building and survival.', 'Hello Games', 'Hello Games', 2016, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/no_mans_sky.jpg'),
(50, 'Sea of Thieves', 'Adventure', 'Pirate adventure game focused on co-op exploration.', 'Rare', 'Xbox Game Studios', 2018, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/sea_of_thieves.jpg'),
(51, 'God of War Ragnarok', 'Action', 'Story-driven action adventure based on Norse mythology.', 'Santa Monica Studio', 'Sony Interactive Entertainment', 2022, 'PS5', NULL, '2026-03-29 05:06:33', 'assets/images/god_of_war_ragnarok.jpg'),
(52, 'Ghost of Tsushima Directors Cut', 'Action', 'Samurai open-world action game set in feudal Japan.', 'Sucker Punch Productions', 'Sony Interactive Entertainment', 2021, 'PS5, PC', NULL, '2026-03-29 05:06:33', 'assets/images/ghost_of_tsushima_directors_cut.jpg'),
(53, 'Hogwarts Legacy', 'RPG', 'Wizarding World action RPG set at Hogwarts.', 'Avalanche Software', 'Warner Bros. Games', 2023, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/hogwarts_legacy.jpg'),
(54, 'Assassins Creed Shadows', 'Action', 'Open-world stealth action game set in Japan.', 'Ubisoft Quebec', 'Ubisoft', 2025, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/assassins_creed_shadows.jpg'),
(55, 'Monster Hunter Wilds', 'Action', 'Hunting action game with large monsters and co-op play.', 'Capcom', 'Capcom', 2025, 'PS5, Xbox, PC', NULL, '2026-03-29 05:06:33', 'assets/images/Monster_Hunter_Wilds_cover.png'),
(56, 'Final Fantasy VII Rebirth', 'RPG', 'Story-rich action RPG continuing the remake trilogy.', 'Square Enix', 'Square Enix', 2024, 'PS5, PC', NULL, '2026-03-29 05:06:33', 'assets/images/final_fantasy_vii_rebirth.jpg'),
(57, 'Persona 5 Royal', 'RPG', 'Stylish turn-based RPG with school life and dungeon crawling.', 'P-Studio', 'Atlus', 2022, 'PS5, Xbox, PC, Switch', NULL, '2026-03-29 05:06:33', 'assets/images/persona_5_royal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `game_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 5, 'good game bro lit', '2026-03-29 03:37:41'),
(3, 2, 30, 5, 'Good game I love it', '2026-03-29 05:51:37'),
(4, 1, 30, 3, 'I didnt like i that much', '2026-03-29 05:52:50'),
(5, 2, 22, 5, 'GOOD GAME.', '2026-03-29 06:11:05'),
(6, 2, 34, 5, 'Very good game so funny to play with friend it has so many characters', '2026-03-29 10:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Ddiploy', 'jonathandiploy@gmail.com', '$2y$10$f8r6.4TA1Ck3KR5wqdE0oueJEjOaoSxh8lwlEpUCJT218ehvMYqz2', '2026-03-29 02:11:10'),
(2, 'Julieth', 'juliethbeltran2009@gmail.com', '$2y$10$DfyQWJd.t7wXBB2KsDsRZO/xzveGgZSA5JxG23dcw7sv3p0Fg.6Ey', '2026-03-29 05:50:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
