-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Sun 21.Máj 2023, 22:06
-- Verzia serveru: 10.4.27-MariaDB
-- Verzia PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `testovanie`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `client_review`
--

CREATE TABLE `client_review` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `message` varchar(200) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `client_review`
--

INSERT INTO `client_review` (`id`, `name`, `mail`, `message`, `datum`) VALUES
(32, 'Andrea', 'andrea.nagyova@yahoo.com', 'I had the best experience of my life in Africa!', '2023-05-12 11:46:17'),
(33, 'Peter Opál', 'petiopal@gmail.com', 'I created this fantastic website using PHP+MySQL  :)', '2023-05-10 15:28:42'),
(34, 'Harvey Specter', 'harvey.specter@pearsonspecterlitt.com', 'I will recommend OpálTours to everyone, I am very satisfied.', '2023-04-18 10:33:08'),
(35, 'Zac Efron', 'zacefron@warnerbros.com', 'Low prices, adventurous programmes, good organisation :D', '2023-04-26 23:57:59'),
(36, 'Mgr. Zuzana Jahodníková', 'zuzana.jahodnikova@actlegal-mph.com', 'I book trips with this company every year, needless to say ...', '2023-05-21 12:00:02');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `days` int(11) NOT NULL,
  `transportation` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `price_per_day` int(11) NOT NULL,
  `top` int(11) NOT NULL,
  `col_md` int(11) NOT NULL,
  `img_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `destination`
--

INSERT INTO `destination` (`id`, `destination`, `days`, `transportation`, `hotel_id`, `price_per_day`, `top`, `col_md`, `img_path`) VALUES
(3, 'Africa', 9, 1, 1, 67, 0, 0, 'https://cdn.thecoolist.com/wp-content/uploads/2021/02/Most-beautiful-places-in-Africa.jpg'),
(4, 'Mongolia', 3, 1, 2, 30, 0, 0, 'https://res.cloudinary.com/wilderness-travel/image/upload/c_scale,dpr_3.0,w_500/f_auto,q_auto/v1/trips/asia/mongolia/wild-mongolia/1-slide-mongolia-golden-eagle-festival-pano'),
(5, 'Bratislava', 3, 0, 3, 70, 0, 0, 'https://cdn.britannica.com/16/90316-050-3D376CFA/Bratislava-Castle-Old-Town-Slvk.jpg'),
(6, 'China', 7, 0, 4, 120, 1, 6, 'assets/images/gallary/g1.jpg'),
(7, 'Venezuela', 12, 1, 5, 45, 1, 6, 'assets/images/gallary/g2.jpg'),
(8, 'Brazil', 7, 1, 6, 55, 1, 4, 'assets/images/gallary/g3.jpg'),
(9, 'Australia', 10, 0, 7, 151, 1, 4, 'assets/images/gallary/g4.jpg'),
(10, 'Netherlands', 10, 0, 8, 86, 1, 4, 'assets/images/gallary/g5.jpg'),
(11, 'Turkey', 7, 0, 9, 45, 1, 8, 'assets/images/gallary/g6.jpg'),
(12, 'London', 5, 0, 10, 80, 1, 0, 'https://a.cdn-hotels.com/gdcs/production27/d274/43014cca-c88c-4061-ace8-58edc24531ee.jpg'),
(13, 'New York', 6, 1, 11, 200, 1, 0, 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/5f/b4/6b/caption.jpg?w=1200&h=-1&s=1'),
(26, 'Hawaii', 8, 1, 20, 130, 1, 0, 'https://www.foodandwine.com/thmb/1YAIVhv_fjIscshPQclIQNzUGpM=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Why-Travel-Is-Consumption-FT-BLOG0123-d9c9d45ed23e49708e0d1e61abfc459a.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `food`
--

INSERT INTO `food` (`id`, `type`) VALUES
(1, 'full board'),
(2, 'half board'),
(3, 'bed and breakfast');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(150) NOT NULL,
  `starts` int(11) NOT NULL,
  `id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `starts`, `id_service`) VALUES
(1, 'Obsidian Lagoon Resort', 5, 1),
(2, 'Crown Circus Hostel', 3, 3),
(3, 'Cerulean Peak Resort & Spaa', 4, 3),
(4, 'Starlight Resort', 4, 3),
(5, 'Western Park Motel', 2, 2),
(6, 'Golden Trinket Hotel', 4, 1),
(7, 'Atlantis Flower Motel', 2, 2),
(8, 'Mirrors Hotel', 5, 1),
(9, 'Beatrix ', 4, 3),
(10, 'New Apollo', 2, 2),
(11, 'The Boulevard Motel', 2, 2),
(20, 'Brass Seaside Resort', 4, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `path` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`) VALUES
(1, 'Home', 'index.php#home'),
(2, 'Favourites', 'index.php#gallery'),
(3, 'Tours', 'tours.php'),
(4, 'Special Offers', 'special_offer.php'),
(5, 'Reviews', 'tours.php#comments'),
(6, 'Contact', 'contact.php');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `id_destination` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `offers`
--

INSERT INTO `offers` (`id`, `id_destination`, `discount`, `description`) VALUES
(1, 9, 20, 'Australia is a vast and diverse country, offering stunning natural landscapes, vibrant cities, and unique wildlife. From the iconic Great Barrier Reef to the expansive Outback, Australia is a paradise for nature lovers. The country boasts multicultural cities like Sydney and Melbourne, where visitors can experience a blend of modern attractions and rich cultural heritage.'),
(2, 13, 35, 'New York, the bustling metropolis of the United States, is a vibrant and diverse city that never sleeps. The iconic skyline is adorned with towering skyscrapers, including the renowned Empire State Building and One World Trade Center. Central Park, an oasis in the heart of the city, offers a tranquil retreat amidst the urban chaos. The city is a melting pot of cultures, offering a wide range of cuisine, from street food to Michelin-starred restaurants. Broadway shows and world-class museums, such as the Metropolitan Museum of Art and the Museum of Modern Art.');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `client_review`
--
ALTER TABLE `client_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `client_review`
--
ALTER TABLE `client_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pre tabuľku `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pre tabuľku `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pre tabuľku `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pre tabuľku `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
