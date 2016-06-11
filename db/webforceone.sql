-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 05 Juin 2016 à 22:02
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `webforceone`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `cat_id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(100) DEFAULT NULL,
  `cat_date_creation` datetime DEFAULT NULL,
  `cat_date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_date_creation`, `cat_date_update`) VALUES
(1, 'Thriller', '2016-06-02 00:00:00', NULL),
(2, 'Drame', '2016-06-07 00:00:00', NULL),
(3, 'Action', '2016-06-02 00:00:00', NULL),
(4, 'Police', '2016-06-02 00:00:00', NULL),
(5, 'Romance', '2016-06-16 00:00:00', NULL),
(6, 'Fantastique', '2016-06-05 21:14:35', '2016-06-05 21:14:35'),
(7, 'Horreur', '2016-06-05 21:57:17', '2016-06-05 21:57:17');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `mov_id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `sto_id` int(10) UNSIGNED NOT NULL,
  `mov_title` varchar(128) DEFAULT NULL,
  `mov_cast` text,
  `mov_synopsis` text,
  `mov_path` varchar(255) DEFAULT NULL,
  `mov_original_title` varchar(128) DEFAULT NULL,
  `mov_image` varchar(255) DEFAULT NULL,
  `mov_date_creation` date DEFAULT NULL,
  `mov_date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `movie`
--

INSERT INTO `movie` (`mov_id`, `cat_id`, `sto_id`, `mov_title`, `mov_cast`, `mov_synopsis`, `mov_path`, `mov_original_title`, `mov_image`, `mov_date_creation`, `mov_date_update`) VALUES
(1, 1, 1, 'Kill Bill', 'Uma Thurman', 'Kill Bill is an American two-part martial arts film, as well as the fourth film written and directed by Quentin Tarantino', 'https://www.youtube.com/embed/RWwGXIjxbnI', 'Kill Bill', 'http://ecx.images-amazon.com/images/I/51MXGK8EZSL.jpg', '2016-06-08', NULL),
(2, 5, 1, 'TiTaniC', 'Leonardo Di Caprio, Kate Winslett', 'Titanic was a British passenger liner that sank in the North Atlantic Ocean in the early morning of 15 April 1912, after colliding with an iceberg during her maiden voyage from Southampton to New York City.', 'https://www.youtube.com/embed/Quf4qIkD3KY', 'TiTanic Liverpool', 'https://images-na.ssl-images-amazon.com/images/I/51d17yMqhVL.jpg', '2016-06-10', NULL),
(3, 3, 1, 'Die Hard 4', 'Bruce Willis', 'New York City policeman John McClane (Bruce Willis) is visiting his estranged wife (Bonnie Bedelia) and two daughters on Christmas Eve. He joins her at a holiday party in the headquarters of the Japanese-owned business she works for.', 'https://www.youtube.com/embed/xqjICXgcsZM', 'Die Hard', 'http://s3.thcdn.com/productimg/0/600/600/17/54117-1309362906-600470.jpg', '2016-06-02', NULL),
(4, 4, 1, 'Bad Boys II', 'Will Smith, Martin Lawrence', 'The drug ecstasy is flowing into Miami, and the police want it stopped. Police Detective Marcus Burnett (Martin Lawrence) and his partner, Mike Lowrey (Will Smith), are just the men to do it', 'https://www.youtube.com/embed/APhw7rju-Co', 'Bad Boys II', 'http://ecx.images-amazon.com/images/I/51GXM3243YL._SY300_.jpg', '2016-06-02', NULL),
(5, 1, 2, 'Troie', 'Brad Pitt', 'Troie, â€” qui vient du nom de Tros â€” est aussi appelÃ©e Ilios ou Ilion, â€” qui vient du nom de son fondateur : Ilos â€” est une ancienne citÃ© semi-lÃ©gendaire de Troade en Asie Mineure, situÃ©e non loin de la mer Ã‰gÃ©e, Ã  l''entrÃ©e de l''Hellespont.', 'https://www.youtube.com/embed/OFWOzENwX3M', 'Troy', 'http://www.dvd-comme-au-cinema.com/5351-large_default/troie-dvd-cadeau.jpg', '2016-06-05', '2016-06-05 13:13:59');

-- --------------------------------------------------------

--
-- Structure de la table `storage`
--

CREATE TABLE `storage` (
  `sto_id` int(10) UNSIGNED NOT NULL,
  `sto_name` varchar(32) DEFAULT NULL,
  `sto_date_creation` datetime DEFAULT NULL,
  `sto_date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `storage`
--

INSERT INTO `storage` (`sto_id`, `sto_name`, `sto_date_creation`, `sto_date_update`) VALUES
(1, 'OneDrive', '2016-06-10 00:00:00', NULL),
(2, 'Local Disk', '2016-06-09 00:00:00', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mov_id`),
  ADD KEY `movie_FKIndex1` (`sto_id`),
  ADD KEY `movie_FKIndex2` (`cat_id`);

--
-- Index pour la table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`sto_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `mov_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `storage`
--
ALTER TABLE `storage`
  MODIFY `sto_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
