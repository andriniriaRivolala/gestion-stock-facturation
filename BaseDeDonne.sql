-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 09 sep. 2021 à 18:24
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(20) NOT NULL,
  `nom` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(34, 'kaly');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(10) NOT NULL,
  `nom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 NOT NULL,
  `codepostal` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `address`, `codepostal`, `tel`) VALUES
(5, 'Mama', 'Andry', 'andrinirina@gmail.com', 'Ankatso', '360', '+20145554444'),
(6, 'setra', 'Hasina', 'setra@gmail.com', 'JIFJ DD 355', '362', '+2610325555'),
(7, 'Mampiononona', 'Frederyc', 'frederyc9@gmail.com', 'Cur Vontovorona Bloc 27 Porte 945', '101', '+261346198249');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(100) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date`, `client_id`, `produit_id`, `quantite`, `total`) VALUES
(115, '2021-08-16', 6, 41, 10, 360);

-- --------------------------------------------------------

--
-- Structure de la table `commande_valider`
--

CREATE TABLE `commande_valider` (
  `id` int(100) NOT NULL,
  `date` date NOT NULL,
  `client_id` int(10) NOT NULL,
  `produit_id` int(10) NOT NULL,
  `quantite` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `facturer` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande_valider`
--

INSERT INTO `commande_valider` (`id`, `date`, `client_id`, `produit_id`, `quantite`, `total`, `facturer`) VALUES
(14, '2021-06-12', 5, 40, 36, 1152, 1),
(18, '2021-06-26', 5, 41, 3, 108, 1),
(19, '2021-06-28', 5, 41, 9, 324, 1),
(20, '2021-06-28', 5, 40, 21, 672, 1),
(21, '2021-07-19', 6, 40, 3, 96, 1),
(22, '2021-07-19', 6, 40, 6, 192, 1),
(24, '2021-08-14', 7, 41, 4, 144, 1);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `commande_valider_id` int(11) NOT NULL,
  `payer` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `date`, `commande_valider_id`, `payer`) VALUES
(26, '2021-07-07', 20, 1),
(32, '2021-09-08', 20, 0),
(35, '2021-09-08', 21, 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(10) NOT NULL,
  `logo` blob NOT NULL,
  `nom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `logo`, `nom`, `prenom`, `address`, `email`, `tel`) VALUES
(12, 0x4453435f303032302e4a5047, 'hasina', 'Manaja', 'tise ankatso 12', 'dada@gmail.com', '+230244552225'),
(13, 0x50353038323438392e4a5047, 'Njato', 'Nirina', 'fotsy 25d', 'euwjeaz486@winemails.com', '+236544447444');

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `facture_id` int(225) NOT NULL,
  `total` int(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`id`, `date`, `facture_id`, `total`) VALUES
(2, '2021-09-07', 26, 625);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(10) NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 NOT NULL,
  `image` varchar(100) NOT NULL,
  `prix` int(100) NOT NULL,
  `DebutStock` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `fournisseur_id` int(30) NOT NULL,
  `categorie_id` int(10) NOT NULL,
  `souscategorie_id` int(10) NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `image`, `prix`, `DebutStock`, `stock`, `fournisseur_id`, `categorie_id`, `souscategorie_id`, `description`, `date`) VALUES
(40, 'Burgeur', 'menu-fish.PNG', 32, 42, 42, 12, 34, 26, 'fsqfg gdh ty y', '2021-06-19'),
(41, 'korena', 'nuggets-fromage.PNG', 36, 50, 37, 13, 34, 24, 'gq gg ht  jj jdf', '2021-06-11');

-- --------------------------------------------------------

--
-- Structure de la table `souscategorie`
--

CREATE TABLE `souscategorie` (
  `id` int(10) NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 NOT NULL,
  `categorie_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `souscategorie`
--

INSERT INTO `souscategorie` (`id`, `nom`, `categorie_id`) VALUES
(24, 'dessert', 34),
(25, 'plat', 34),
(26, 'entrer', 34);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(25) NOT NULL,
  `image` varchar(100) NOT NULL,
  `nom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `image`, `nom`, `prenom`, `password`, `email`, `tel`) VALUES
(20, 'IMG_20160304_114925-1-2.jpg', 'Andrinirina', 'Rivolala', '0123Andry', 'andrinirina1607@gmail.com', '+261342930324');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client` (`client_id`),
  ADD KEY `fk_produit` (`produit_id`);

--
-- Index pour la table `commande_valider`
--
ALTER TABLE `commande_valider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_valide` (`client_id`),
  ADD KEY `fk_produit_valide` (`produit_id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_valider` (`commande_valider_id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facture` (`facture_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_souscategorie_prod` (`souscategorie_id`) USING BTREE,
  ADD KEY `fk_categorie` (`categorie_id`),
  ADD KEY `fk_fournisseur` (`fournisseur_id`);

--
-- Index pour la table `souscategorie`
--
ALTER TABLE `souscategorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT pour la table `commande_valider`
--
ALTER TABLE `commande_valider`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `souscategorie`
--
ALTER TABLE `souscategorie`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produit` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_valider`
--
ALTER TABLE `commande_valider`
  ADD CONSTRAINT `fk_client_valide` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produit_valide` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_commande_valider` FOREIGN KEY (`commande_valider_id`) REFERENCES `commande_valider` (`id`);

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_facture` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fournisseur` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_souscategorie` FOREIGN KEY (`souscategorie_id`) REFERENCES `souscategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `souscategorie`
--
ALTER TABLE `souscategorie`
  ADD CONSTRAINT `categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
