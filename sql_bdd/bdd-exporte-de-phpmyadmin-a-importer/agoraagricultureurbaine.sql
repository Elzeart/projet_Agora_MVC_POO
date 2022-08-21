-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 août 2022 à 19:42
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agoraagricultureurbaine`
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
(2, 27),
(3, 26),
(4, 3),
(4, 5),
(4, 35),
(5, 1);

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
-- Structure de la table `dependre`
--

CREATE TABLE `dependre` (
  `idService` int(11) NOT NULL,
  `idTroc` int(11) NOT NULL
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
-- Structure de la table `noter`
--

CREATE TABLE `noter` (
  `idUtilisateur` int(11) NOT NULL,
  `idRecette` int(11) NOT NULL,
  `note` tinyint(4) NOT NULL
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
  `imageRealisation` varchar(50) DEFAULT NULL,
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
  `idUtilisateur` int(11) DEFAULT NULL
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
(2, 'Racines et assimilés'),
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
  `mailUtilisateur` varchar(100) NOT NULL,
  `mdpUtilisateur` varchar(100) NOT NULL,
  `imageUtilisateur` varchar(100) DEFAULT NULL,
  `activationCode` tinyint(4) NOT NULL,
  `clef` int(11) DEFAULT NULL,
  `idDroit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `pseudoUtilisateur`, `mailUtilisateur`, `mdpUtilisateur`, `imageUtilisateur`, `activationCode`, `clef`, `idDroit`) VALUES
(1, 'NomMembre2', 'PrenomMembre2', 'membre2', 'membre2.nonvalide@gmail.com', '$2y$10$QsxFWVvRIdcUCQHq7Iv/U.bir929LYXOSpZndc1YICr0dgRtJX8l6', 'profils/profil.png', 1, 2603, 2),
(2, 'NomMembre1', 'PrenomMembre1', 'membre1', 'membre1.Valide@gmail.com', '$2y$10$qtoft1Wdnu1mSJR6Kf3ocedTYK4bQmV3bJCiDxGmSMBdS0J/I4t5W', 'profils/profil.png', 1, 7914, 2),
(3, 'Admin1', 'Admin', 'admin', 'admin@gmail.com', '$2y$10$.EgsdkFomLP0NpcdE7FIoeRgWI2y8SkZ7Lmv30bulNokZw68uPmvW', 'profils/profil.png', 1, 8266, 1);

-- --------------------------------------------------------

--
-- Structure de la table `vegetaux`
--

CREATE TABLE `vegetaux` (
  `idVegetal` int(11) NOT NULL,
  `nomVegetal` varchar(50) NOT NULL,
  `infosVegetal` text NOT NULL,
  `imageVegetal` varchar(100) NOT NULL,
  `plantationVegetal` text NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idFamilleVegetal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vegetaux`
--

INSERT INTO `vegetaux` (`idVegetal`, `nomVegetal`, `infosVegetal`, `imageVegetal`, `plantationVegetal`, `idUtilisateur`, `idFamilleVegetal`) VALUES
(1, 'Graines de courges', 'Graines de courges infos', '53628_graines-de-courges.jpg', 'Graines de courges infos plantation', 3, 6),
(3, 'Roses', 'Roses infos', '87598_rose.jpg', 'Roses infos plantation', 3, 8),
(5, 'Violettes', 'Violettes infos', '64125_violette.jpeg', 'Violettes infos plantation', 3, 5),
(26, 'Prunes', 'Prunes infos', '43400_la-prune.jpg', 'Prunes infos plantation', 3, 8),
(27, 'Pommes de terre', 'Pommes de terre infos', '9006_potatoes.jpg', 'Pommes de terre infos plantation', 3, 4),
(35, 'passiflore', 'passiflore infos', '78ad602dcf40ee2407dc2f1f847bb213_passiflora-edulis.jpg', 'passiflore Informations sur la plantation', 3, 7);

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
  ADD KEY `idVegetal` (`idVegetal`);

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
-- Index pour la table `dependre`
--
ALTER TABLE `dependre`
  ADD PRIMARY KEY (`idService`,`idTroc`),
  ADD KEY `idTroc` (`idTroc`);

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
-- Index pour la table `noter`
--
ALTER TABLE `noter`
  ADD PRIMARY KEY (`idUtilisateur`,`idRecette`),
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
  ADD PRIMARY KEY (`idRealisation`);

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
  ADD KEY `idUtilisateur` (`idUtilisateur`);

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
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vegetaux`
--
ALTER TABLE `vegetaux`
  MODIFY `idVegetal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
-- Contraintes pour la table `dependre`
--
ALTER TABLE `dependre`
  ADD CONSTRAINT `dependre_ibfk_1` FOREIGN KEY (`idService`) REFERENCES `services` (`idService`),
  ADD CONSTRAINT `dependre_ibfk_2` FOREIGN KEY (`idTroc`) REFERENCES `trocs` (`idTroc`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`),
  ADD CONSTRAINT `evenements_ibfk_2` FOREIGN KEY (`idLieu`) REFERENCES `lieux` (`idLieu`);

--
-- Contraintes pour la table `noter`
--
ALTER TABLE `noter`
  ADD CONSTRAINT `noter_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `recettes` (`idUtilisateur`),
  ADD CONSTRAINT `noter_ibfk_2` FOREIGN KEY (`idRecette`) REFERENCES `recettes` (`idRecette`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`idEvenement`) REFERENCES `evenements` (`idEvenement`),
  ADD CONSTRAINT `participer_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

--
-- Contraintes pour la table `trocs`
--
ALTER TABLE `trocs`
  ADD CONSTRAINT `trocs_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`idUtilisateur`);

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
