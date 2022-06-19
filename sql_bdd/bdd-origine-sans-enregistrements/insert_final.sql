INSERT INTO `droits` (`idDroit`, `typeDroits`) VALUES
(1, 'admin'),
(2, 'membre'),
(3, 'visiteur');

INSERT INTO `famillevegetaux` (`idFamilleVegetal`, `nomFamilleVegetal`) VALUES
(1, ''),
(2, 'Astéracées'),
(3, 'Polygonacées'),
(4, 'Solanacées'),
(5, 'Violaceae'),
(6, 'Cucurbitaceae'),
(7, 'Passifloraceae'),
(8, 'Rosaceae');

INSERT INTO `typevegetaux` (`idTypeVegetal`, `nomTypeVegetal`) VALUES
(1, ''),
(2, 'Racine, tubercule, rhizome, etc'),
(3, 'Fruit'),
(4, 'Fleur'),
(5, 'Graine');

INSERT INTO `utilisateurs` (`idUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `pseudoUtilisateur`, `mailUtilisateur`, `mdpUtilisateur`, `imageUtilisateur`, `activationCode`, `clef`, `idDroit`) VALUES
(1, 'NomMembre2', 'PrenomMembre2', 'membre2', 'arnaud.depetris@gmail.com', '$2y$10$bBMUTAenRhTFHDh5X7sT8e7XdOOWlXxVsmmFCbtYgGW2oruanp7du', '', 0, 2603, 2),
(2, 'NomMembre1', 'PrenomMembre1', 'membre1', 'arnaud.depetris@gmail.com', '$2y$10$C/EzsA5tIoHo43UeUR8ZquPmtS9EJwYn7VWZgxchwPxhzww7wwJyC', 'profils/profil.png', 1, 7914, 2),
(3, 'Admin1', 'Admin', 'admin', 'arnaud.depetris@gmail.com', '$2y$10$e2zfUO1PzcFyt5MAnTTkIuSCFWrNQt/f9pKGmYCieo0p.Lb/3zIYK', 'profils/profil.png', 1, 8266, 1);

INSERT INTO `vegetaux` (`idVegetal`, `nomVegetal`, `infosVegetal`, `imageVegetal`, `plantationVegetal`, `idUtilisateur`, `idFamilleVegetal`) VALUES
(1, 'Graines de courges', 'Graines de courges infos', '53628_graines-de-courges.jpg', 'Tempéré', NULL, 6),
(2, 'fruits de la passion autres variétés', 'fruits de la passion autres variétés infos', '24571_Fruits_passion.jpg', 'Tropical', NULL, 7),
(3, 'Rose', 'Rose infos', '19002_RosePetale.jpg', 'Tout', NULL, 8),
(4, 'Fruits de la passion', 'Fruits de la passion infos', '65679_Fruit-de-la-passion.png', 'Tropical', NULL, 7),
(5, 'Violettes', 'Violettes infos', '64125_violette.jpeg', 'Tempéré', NULL, 5),
(6, 'Pomme de terre', 'Pomme de terre infos', '77596_pomme_de_terre.jpg', 'Tout', NULL, 4);

INSERT INTO `appartenir` (`idTypeVegetal`, `idVegetal`) VALUES
(5, 1),
(4, 2),
(4, 3),
(3, 4),
(4, 5),
(2, 6);
