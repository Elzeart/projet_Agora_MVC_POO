-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 11 mars 2022 à 17:29
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agoraagricultureurbaine3`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `idTypeVegetal` int(11) NOT NULL,
  `idVegetal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `appartenir`
--

INSERT INTO `appartenir` (`idTypeVegetal`, `idVegetal`) VALUES
(2, 12),
(3, 5),
(3, 8),
(4, 7),
(4, 11),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

CREATE TABLE `avoir` (
  `idVegetalTroc` int(11) NOT NULL,
  `idTroc` int(11) NOT NULL,
  `quantite` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `idCommentaire` int(11) NOT NULL,
  `titreCommentaire` varchar(100) NOT NULL,
  `contenuCommentaire` text NOT NULL,
  `dateCommentaire` date NOT NULL,
  `idRecette` int(11) DEFAULT NULL,
  `idUtilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE `composer` (
  `idIngrediant` int(11) NOT NULL,
  `idRecette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `concerner`
--

CREATE TABLE `concerner` (
  `idRecette` int(11) NOT NULL,
  `idSaison` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `decerner`
--

CREATE TABLE `decerner` (
  `idNotation` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `idDroit` int(11) NOT NULL,
  `typeDroits` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`idDroit`, `typeDroits`) VALUES
(1, 'admin'),
(2, 'membre'),
(3, 'visiteur');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `idEvenement` int(11) NOT NULL,
  `nomEvenement` varchar(50) NOT NULL,
  `dateEvenement` date NOT NULL,
  `contenuEvenement` text NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idLieu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `famillevegetaux`
--

CREATE TABLE `famillevegetaux` (
  `idFamilleVegetal` int(11) NOT NULL,
  `nomFamilleVegetal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `famillevegetaux`
--

INSERT INTO `famillevegetaux` (`idFamilleVegetal`, `nomFamilleVegetal`) VALUES
(1, ''),
(2, 'Astéracées'),
(3, 'Polygonacées'),
(4, 'Solanacées'),
(5, 'Violaceae'),
(6, 'Cucurbitaceae'),
(7, 'Passifloraceae'),
(8, 'Rosaceae');

-- --------------------------------------------------------

--
-- Structure de la table `ingrediants`
--

CREATE TABLE `ingrediants` (
  `idIngrediant` int(11) NOT NULL,
  `nomIngrediant` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

CREATE TABLE `lieux` (
  `idLieu` int(11) NOT NULL,
  `nomLieu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `notations`
--

CREATE TABLE `notations` (
  `idNotation` int(11) NOT NULL,
  `noteNotation` tinyint(4) NOT NULL,
  `idRecette` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE `participer` (
  `idEvenement` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `realisations`
--

CREATE TABLE `realisations` (
  `idRealisation` int(11) NOT NULL,
  `nomRealisation` varchar(50) NOT NULL,
  `infosRealisation` text NOT NULL,
  `imageRealisation` varchar(50) NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `idRecette` int(11) NOT NULL,
  `nomRecette` varchar(50) NOT NULL,
  `contenuRecette` text NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `saisonsrecettes`
--

CREATE TABLE `saisonsrecettes` (
  `idSaison` int(11) NOT NULL,
  `nomSaison` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `idService` int(11) NOT NULL,
  `nomService` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `trocs`
--

CREATE TABLE `trocs` (
  `idTroc` int(11) NOT NULL,
  `nomTroc` varchar(50) NOT NULL,
  `infoTroc` text NOT NULL,
  `idUtilisateur_propose` int(11) DEFAULT NULL,
  `idService` int(11) DEFAULT NULL,
  `idUtilisateur_accept` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `typevegetaux`
--

CREATE TABLE `typevegetaux` (
  `idTypeVegetal` int(11) NOT NULL,
  `nomTypeVegetal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typevegetaux`
--

INSERT INTO `typevegetaux` (`idTypeVegetal`, `nomTypeVegetal`) VALUES
(1, ''),
(2, 'Racine, tubercule, rhizome, etc'),
(3, 'Fruit'),
(4, 'Fleur'),
(5, 'Graine');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
  `nomUtilisateur` varchar(50) NOT NULL,
  `prenomUtilisateur` varchar(50) NOT NULL,
  `pseudoUtilisateur` varchar(50) NOT NULL,
  `mailUtilisateur` varchar(100) DEFAULT NULL,
  `mdpUtilisateur` varchar(100) NOT NULL,
  `imageUtilisateur` varchar(50) NOT NULL,
  `activationCode` tinyint(1) DEFAULT NULL,
  `clef` int(11) NOT NULL,
  `idDroit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `pseudoUtilisateur`, `mailUtilisateur`, `mdpUtilisateur`, `imageUtilisateur`, `activationCode`, `clef`, `idDroit`) VALUES
(18, 'NomMembre2', 'PrenomMembre2', 'membre2', 'arnaud.depetris@gmail.com', '$2y$10$bBMUTAenRhTFHDh5X7sT8e7XdOOWlXxVsmmFCbtYgGW2oruanp7du', '', 0, 2603, 2),
(33, 'NomMembre1', 'PrenomMembre1', 'membre1', 'arnaud.depetris@gmail.com', '$2y$10$C/EzsA5tIoHo43UeUR8ZquPmtS9EJwYn7VWZgxchwPxhzww7wwJyC', 'profils/profil.png', 1, 7914, 2),
(35, 'Admin1', 'Admin', 'azerty', 'arnaud.depetris@gmail.com', '$2y$10$e2zfUO1PzcFyt5MAnTTkIuSCFWrNQt/f9pKGmYCieo0p.Lb/3zIYK', 'profils/profil.png', 1, 8266, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vegetaux`
--

CREATE TABLE `vegetaux` (
  `idVegetal` int(11) NOT NULL,
  `nomVegetal` varchar(50) NOT NULL,
  `infosVegetal` text NOT NULL,
  `imageVegetal` varchar(50) NOT NULL,
  `plantationVegetal` text NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idFamilleVegetal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vegetaux`
--

INSERT INTO `vegetaux` (`idVegetal`, `nomVegetal`, `infosVegetal`, `imageVegetal`, `plantationVegetal`, `idUtilisateur`, `idFamilleVegetal`) VALUES
(4, 'Graines de courges', 'Graines de courges infos', '53628_graines-de-courges.jpg', 'Tempéré', NULL, 6),
(5, 'fruits de la passion autres variétés', 'fruits de la passion autres variétés infos', '24571_Fruits_passion.jpg', 'Tropical', NULL, 7),
(7, 'Rose', 'Rose infos', '51595_RosePetale.jpg', 'Tout', NULL, 8),
(8, 'Fruits de la passion', 'Fruits de la passion infos', '57519_Fruit-de-la-passion.png', 'Tropical', NULL, 7),
(11, 'Violettes', 'Violettes infos', '87329_violette.jpeg', 'Tempéré', NULL, 5),
(12, 'Pomme de terre', 'Pomme de terre infos', '77596_pomme_de_terre.jpg', 'Tout', NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `vegetauxtroc`
--

CREATE TABLE `vegetauxtroc` (
  `idVegetalTroc` int(11) NOT NULL,
  `nomVegetalTroc` varchar(50) NOT NULL,
  `infosVegetalTroc` text NOT NULL,
  `imageVegetalTroc` varchar(50) NOT NULL,
  `quantiteGlobaleVegetalTroc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`idTypeVegetal`,`idVegetal`),
  ADD KEY `appartenir_ibfk_2` (`idVegetal`);

--
-- Index pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD PRIMARY KEY (`idVegetalTroc`,`idTroc`),
  ADD KEY `idTroc` (`idTroc`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD KEY `idRecette` (`idRecette`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `composer`
--
ALTER TABLE `composer`
  ADD PRIMARY KEY (`idIngrediant`,`idRecette`),
  ADD KEY `idRecette` (`idRecette`);

--
-- Index pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD PRIMARY KEY (`idRecette`,`idSaison`),
  ADD KEY `idSaison` (`idSaison`);

--
-- Index pour la table `decerner`
--
ALTER TABLE `decerner`
  ADD PRIMARY KEY (`idNotation`,`idUtilisateur`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`idDroit`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`idEvenement`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `famillevegetaux`
--
ALTER TABLE `famillevegetaux`
  ADD PRIMARY KEY (`idFamilleVegetal`);

--
-- Index pour la table `ingrediants`
--
ALTER TABLE `ingrediants`
  ADD PRIMARY KEY (`idIngrediant`);

--
-- Index pour la table `lieux`
--
ALTER TABLE `lieux`
  ADD PRIMARY KEY (`idLieu`);

--
-- Index pour la table `notations`
--
ALTER TABLE `notations`
  ADD PRIMARY KEY (`idNotation`),
  ADD KEY `idRecette` (`idRecette`);

--
-- Index pour la table `participer`
--
ALTER TABLE `participer`
  ADD PRIMARY KEY (`idEvenement`,`idUtilisateur`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `realisations`
--
ALTER TABLE `realisations`
  ADD PRIMARY KEY (`idRealisation`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`idRecette`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `saisonsrecettes`
--
ALTER TABLE `saisonsrecettes`
  ADD PRIMARY KEY (`idSaison`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`idService`);

--
-- Index pour la table `trocs`
--
ALTER TABLE `trocs`
  ADD PRIMARY KEY (`idTroc`),
  ADD KEY `fk_propose` (`idUtilisateur_propose`),
  ADD KEY `idService` (`idService`),
  ADD KEY `fk_accept` (`idUtilisateur_accept`);

--
-- Index pour la table `typevegetaux`
--
ALTER TABLE `typevegetaux`
  ADD PRIMARY KEY (`idTypeVegetal`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD KEY `idDroit` (`idDroit`);

--
-- Index pour la table `vegetaux`
--
ALTER TABLE `vegetaux`
  ADD PRIMARY KEY (`idVegetal`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idFamilleVegetal` (`idFamilleVegetal`);

--
-- Index pour la table `vegetauxtroc`
--
ALTER TABLE `vegetauxtroc`
  ADD PRIMARY KEY (`idVegetalTroc`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `idDroit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `idEvenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `famillevegetaux`
--
ALTER TABLE `famillevegetaux`
  MODIFY `idFamilleVegetal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ingrediants`
--
ALTER TABLE `ingrediants`
  MODIFY `idIngrediant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieux`
--
ALTER TABLE `lieux`
  MODIFY `idLieu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notations`
--
ALTER TABLE `notations`
  MODIFY `idNotation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realisations`
--
ALTER TABLE `realisations`
  MODIFY `idRealisation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `idRecette` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `saisonsrecettes`
--
ALTER TABLE `saisonsrecettes`
  MODIFY `idSaison` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `idService` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `trocs`
--
ALTER TABLE `trocs`
  MODIFY `idTroc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typevegetaux`
--
ALTER TABLE `typevegetaux`
  MODIFY `idTypeVegetal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `vegetaux`
--
ALTER TABLE `vegetaux`
  MODIFY `idVegetal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `vegetauxtroc`
--
ALTER TABLE `vegetauxtroc`
  MODIFY `idVegetalTroc` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `appartenir_ibfk_1` FOREIGN KEY (`idTypeVegetal`) REFERENCES `typevegetaux` (`idTypeVegetal`),
  ADD CONSTRAINT `appartenir_ibfk_2` FOREIGN KEY (`idVegetal`) REFERENCES `vegetaux` (`idVegetal`) ON DELETE CASCADE;

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `avoir_ibfk_1` FOREIGN KEY (`idVegetalTroc`) REFERENCES `vegetauxtroc` (`idVegetalTroc`),
  ADD CONSTRAINT `avoir_ibfk_2` FOREIGN KEY (`idTroc`) REFERENCES `trocs` (`idTroc`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recettes` (`idRecette`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `composer_ibfk_1` FOREIGN KEY (`idIngrediant`) REFERENCES `ingrediants` (`idIngrediant`),
  ADD CONSTRAINT `composer_ibfk_2` FOREIGN KEY (`idRecette`) REFERENCES `recettes` (`idRecette`);

--
-- Contraintes pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD CONSTRAINT `concerner_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recettes` (`idRecette`),
  ADD CONSTRAINT `concerner_ibfk_2` FOREIGN KEY (`idSaison`) REFERENCES `saisonsrecettes` (`idSaison`);

--
-- Contraintes pour la table `decerner`
--
ALTER TABLE `decerner`
  ADD CONSTRAINT `decerner_ibfk_1` FOREIGN KEY (`idNotation`) REFERENCES `notations` (`idNotation`),
  ADD CONSTRAINT `decerner_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `evenements_ibfk_2` FOREIGN KEY (`idLieu`) REFERENCES `lieux` (`idLieu`);

--
-- Contraintes pour la table `notations`
--
ALTER TABLE `notations`
  ADD CONSTRAINT `notations_ibfk_1` FOREIGN KEY (`idRecette`) REFERENCES `recettes` (`idRecette`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`idEvenement`) REFERENCES `evenements` (`idEvenement`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `realisations`
--
ALTER TABLE `realisations`
  ADD CONSTRAINT `realisations_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `trocs`
--
ALTER TABLE `trocs`
  ADD CONSTRAINT `fk_accept` FOREIGN KEY (`idUtilisateur_accept`) REFERENCES `utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `fk_propose` FOREIGN KEY (`idUtilisateur_propose`) REFERENCES `utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `trocs_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `services` (`idService`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`idDroit`) REFERENCES `droits` (`idDroit`);

--
-- Contraintes pour la table `vegetaux`
--
ALTER TABLE `vegetaux`
  ADD CONSTRAINT `vegetaux_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `vegetaux_ibfk_2` FOREIGN KEY (`idFamilleVegetal`) REFERENCES `famillevegetaux` (`idFamilleVegetal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
