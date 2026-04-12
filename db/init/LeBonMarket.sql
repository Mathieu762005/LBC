-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 08 oct. 2025 à 07:01
-- Version du serveur : 8.0.43
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `LeBonMarket`
--
CREATE DATABASE IF NOT EXISTS `LeBonMarket` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `LeBonMarket`;

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE `annonces` (
  `a_id` int NOT NULL,
  `a_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `a_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `a_price` decimal(10,2) NOT NULL,
  `a_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `a_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`a_id`, `a_title`, `a_description`, `a_price`, `a_picture`, `a_publication`, `u_id`) VALUES
(1, 'coco', 'noix de coco', 12.00, NULL, '2025-09-17 13:55:00', 1),
(3, 'Bambu', 'Bambu pas cher', 234.00, NULL, '2025-09-22 06:42:19', 1),
(4, 'Ici mon annonce', 'C une annonce', 34.00, NULL, '2025-09-22 09:32:23', 3),
(5, 'test', 'ceci est un test', 45.00, NULL, '2025-09-22 09:44:31', 3),
(6, 'Zoro', 'Zoro', 67.00, '68d1399793ec2.png', '2025-09-22 11:57:11', 3),
(7, 'azeaze', 'azeazeaze', 12.00, NULL, '2025-09-22 11:59:47', 3),
(8, 'zae', 'aze', 12.00, NULL, '2025-09-22 13:09:55', 3),
(9, 'Made by Akasa', 'Made by Me', 34.00, '68d19019af767.png', '2025-09-22 18:06:17', 1),
(10, 'Premier POST', 'Super POST', 34.00, '68d2564acbfd1.png', '2025-09-23 08:11:54', 4),
(11, 'Bim Bam Boum', 'Badabooooummmmm', 45.00, '68d2976258cd6.png', '2025-09-23 12:49:38', 4),
(12, 'aze', 'aze', 12.00, NULL, '2025-09-24 15:36:11', 4),
(13, 'azeaze', 'azeaze', 12.00, NULL, '2025-09-24 15:37:15', 4),
(14, 'Super affiche de promotion', 'Vends affiche vintage, pour promouvoir une application crée en DWWM', 34.00, '68d50a51e57a9.png', '2025-09-25 09:24:33', 2),
(15, 'azeaze aze aze az eaze aze aze aze aze az e', 'azeaze', 34.00, NULL, '2025-09-25 20:55:04', 1);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE `favoris` (
  `f_id` int NOT NULL,
  `user_id` int NOT NULL,
  `annonce_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `u_id` int NOT NULL,
  `u_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_username`, `u_inscription`) VALUES
(1, 'akasa@mail.fr', '$2y$10$zNfOeVlpNkUjNSzttMMBVeOYDteLG3bvnzHt2s1ZQogPwWsBuvwTq', 'akasa', '2025-09-16 14:39:32'),
(2, 'zenitsu@mail.fr', '$2y$10$DtdNNW3mjvw3.GvObnigPe4pGZUbiTf.os255eEAPglV4kgQT2rSm', 'zenitsu', '2025-09-17 11:24:28'),
(3, 'pseudo@mail.fr', '$2y$10$9.b1ua86Ew7BFq2qfsCtXeAH.66NfkhBbLqP0hKIbGeVcP92djHf2', 'pseudo', '2025-09-22 09:27:51'),
(4, 'john@mail.fr', '$2y$10$tUgx0f.c/SNYbmPkLIkHceR8Y.3gKGv6xIhu9fc1gRq/g8nrE78hO', 'john', '2025-09-23 08:10:25');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`f_id`),
  ADD UNIQUE KEY `uniq_user_annonce` (`user_id`,`annonce_id`),
  ADD KEY `fk_favoris_annonce` (`annonce_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`),
  ADD UNIQUE KEY `u_username` (`u_username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `f_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `fk_favoris_annonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_favoris_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;