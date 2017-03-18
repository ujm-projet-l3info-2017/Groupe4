-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 18 Mars 2017 à 15:55
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `statisfoot`
--

-- --------------------------------------------------------

--
-- Structure de la table `but`
--

CREATE TABLE `but` (
  `id` int(11) NOT NULL,
  `joueur_id` int(11) NOT NULL,
  `type_but_id` int(11) NOT NULL,
  `type_action_id` int(11) NOT NULL,
  `match_foot_id` int(11) NOT NULL,
  `min_jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `nom_club` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `club`
--

INSERT INTO `club` (`id`, `nom_club`) VALUES
(1, 'ASSE'),
(2, 'OL');

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `nom_compet` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `saison` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `competition`
--

INSERT INTO `competition` (`id`, `nom_compet`, `saison`, `date_deb`, `date_fin`) VALUES
(1, 'coup de france', '2016-2017', '2017-03-01', '2017-03-09'),
(2, 'ligue1', '2016-2017', '2017-03-14', '2017-03-07');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `niveau_id` int(11) NOT NULL,
  `systeme_id` int(11) NOT NULL,
  `nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`id`, `club_id`, `niveau_id`, `systeme_id`, `nom`) VALUES
(1, 1, 1, 1, 'ASSE de saint-etienne'),
(2, 2, 1, 2, 'OL de Lyon');

-- --------------------------------------------------------

--
-- Structure de la table `equipe_manager`
--

CREATE TABLE `equipe_manager` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `equipe_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `id` int(11) NOT NULL,
  `poste_id` int(11) NOT NULL,
  `nom_j` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_j` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `date_naiss` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joueur_equipe`
--

CREATE TABLE `joueur_equipe` (
  `id` int(11) NOT NULL,
  `joueur_id` int(11) NOT NULL,
  `equipe_id` int(11) NOT NULL,
  `poste` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `titulaire` tinyint(1) NOT NULL,
  `remplacant` tinyint(1) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `nom_manag` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_manag` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `num_tel` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `match_equipe`
--

CREATE TABLE `match_equipe` (
  `id` int(11) NOT NULL,
  `equipe_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `but_marq` int(11) NOT NULL,
  `but_enc` int(11) NOT NULL,
  `corner_obt` int(11) NOT NULL,
  `corner_conc` int(11) NOT NULL,
  `tir_cadre` int(11) NOT NULL,
  `cf_obt` int(11) NOT NULL,
  `cf_conc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `match_equipe`
--

INSERT INTO `match_equipe` (`id`, `equipe_id`, `match_id`, `but_marq`, `but_enc`, `corner_obt`, `corner_conc`, `tir_cadre`, `cf_obt`, `cf_conc`) VALUES
(1, 1, 3, 0, 2, 0, 0, 0, 0, 0),
(2, 2, 3, 2, 0, 0, 0, 0, 0, 0),
(3, 1, 4, 1, 0, 8, 3, 5, 1, 0),
(4, 2, 4, 0, 1, 2, 4, 6, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `match_foot`
--

CREATE TABLE `match_foot` (
  `id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL,
  `date_match` datetime NOT NULL,
  `lieu` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `num_journee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `match_foot`
--

INSERT INTO `match_foot` (`id`, `competition_id`, `date_match`, `lieu`, `num_journee`) VALUES
(3, 1, '2017-03-15 00:00:00', 'Saint-etienne', 3),
(4, 2, '2017-03-28 00:00:00', 'lyon', 8),
(5, 2, '2017-01-09 00:00:00', 'Roanne', 10);

-- --------------------------------------------------------

--
-- Structure de la table `match_joueur`
--

CREATE TABLE `match_joueur` (
  `id` int(11) NOT NULL,
  `joueur_id` int(11) NOT NULL,
  `match_foot_id` int(11) NOT NULL,
  `poste` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `min_entre` int(11) NOT NULL,
  `min_sortie` int(11) NOT NULL,
  `nb_duel_gagne` int(11) NOT NULL,
  `nb_balle_inter` int(11) NOT NULL,
  `nb_balle_recup` int(11) NOT NULL,
  `nb_balle_arret` int(11) NOT NULL,
  `nb_centre` int(11) NOT NULL,
  `nb_tacle` int(11) NOT NULL,
  `carton_rouge` tinyint(1) NOT NULL,
  `carton_jaune` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `libelle_niv` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`id`, `libelle_niv`) VALUES
(1, 'U19'),
(2, 'U20');

-- --------------------------------------------------------

--
-- Structure de la table `passe_decisive`
--

CREATE TABLE `passe_decisive` (
  `id` int(11) NOT NULL,
  `but_id` int(11) NOT NULL,
  `joueur_id` int(11) NOT NULL,
  `type_passe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id` int(11) NOT NULL,
  `libelle_poste` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `descrip_poste` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `syst_jeu_def`
--

CREATE TABLE `syst_jeu_def` (
  `id` int(11) NOT NULL,
  `libelle_syst` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descrip_syst` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `syst_jeu_def`
--

INSERT INTO `syst_jeu_def` (`id`, `libelle_syst`, `descrip_syst`) VALUES
(1, '4-3-3', 'systeme classique.'),
(2, '3-5-2', 'syeteme offensif');

-- --------------------------------------------------------

--
-- Structure de la table `type_action`
--

CREATE TABLE `type_action` (
  `id` int(11) NOT NULL,
  `libelle_type_act` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_but`
--

CREATE TABLE `type_but` (
  `id` int(11) NOT NULL,
  `libelle_type_but` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_passe`
--

CREATE TABLE `type_passe` (
  `id` int(11) NOT NULL,
  `libelle_type_passe` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `but`
--
ALTER TABLE `but`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B132FECAA9E2D76C` (`joueur_id`),
  ADD KEY `IDX_B132FECA9B46209C` (`type_but_id`),
  ADD KEY `IDX_B132FECA29F4B125` (`type_action_id`),
  ADD KEY `IDX_B132FECA9D318F34` (`match_foot_id`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2449BA1561190A32` (`club_id`),
  ADD KEY `IDX_2449BA15B3E9C81` (`niveau_id`),
  ADD KEY `IDX_2449BA15346F772E` (`systeme_id`);

--
-- Index pour la table `equipe_manager`
--
ALTER TABLE `equipe_manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_22243905783E3463` (`manager_id`),
  ADD KEY `IDX_222439056D861B89` (`equipe_id`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD71A9C5A0905086` (`poste_id`);

--
-- Index pour la table `joueur_equipe`
--
ALTER TABLE `joueur_equipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CDF2AA99A9E2D76C` (`joueur_id`),
  ADD KEY `IDX_CDF2AA996D861B89` (`equipe_id`);

--
-- Index pour la table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `match_equipe`
--
ALTER TABLE `match_equipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_852643146D861B89` (`equipe_id`),
  ADD KEY `IDX_852643142ABEACD6` (`match_id`);

--
-- Index pour la table `match_foot`
--
ALTER TABLE `match_foot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A8E088E17B39D312` (`competition_id`);

--
-- Index pour la table `match_joueur`
--
ALTER TABLE `match_joueur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5C1E50C4A9E2D76C` (`joueur_id`),
  ADD KEY `IDX_5C1E50C49D318F34` (`match_foot_id`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `passe_decisive`
--
ALTER TABLE `passe_decisive`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_ABDCFE8DB8914BA4` (`but_id`),
  ADD KEY `IDX_ABDCFE8DA9E2D76C` (`joueur_id`),
  ADD KEY `IDX_ABDCFE8D8F70D037` (`type_passe_id`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `syst_jeu_def`
--
ALTER TABLE `syst_jeu_def`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_action`
--
ALTER TABLE `type_action`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_but`
--
ALTER TABLE `type_but`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_passe`
--
ALTER TABLE `type_passe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `but`
--
ALTER TABLE `but`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `equipe_manager`
--
ALTER TABLE `equipe_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `joueur_equipe`
--
ALTER TABLE `joueur_equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `match_equipe`
--
ALTER TABLE `match_equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `match_foot`
--
ALTER TABLE `match_foot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `match_joueur`
--
ALTER TABLE `match_joueur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `passe_decisive`
--
ALTER TABLE `passe_decisive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `syst_jeu_def`
--
ALTER TABLE `syst_jeu_def`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_action`
--
ALTER TABLE `type_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_but`
--
ALTER TABLE `type_but`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_passe`
--
ALTER TABLE `type_passe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `but`
--
ALTER TABLE `but`
  ADD CONSTRAINT `FK_B132FECA29F4B125` FOREIGN KEY (`type_action_id`) REFERENCES `type_action` (`id`),
  ADD CONSTRAINT `FK_B132FECA9B46209C` FOREIGN KEY (`type_but_id`) REFERENCES `type_but` (`id`),
  ADD CONSTRAINT `FK_B132FECA9D318F34` FOREIGN KEY (`match_foot_id`) REFERENCES `match_foot` (`id`),
  ADD CONSTRAINT `FK_B132FECAA9E2D76C` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `FK_2449BA15346F772E` FOREIGN KEY (`systeme_id`) REFERENCES `syst_jeu_def` (`id`),
  ADD CONSTRAINT `FK_2449BA1561190A32` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `FK_2449BA15B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`);

--
-- Contraintes pour la table `equipe_manager`
--
ALTER TABLE `equipe_manager`
  ADD CONSTRAINT `FK_222439056D861B89` FOREIGN KEY (`equipe_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `FK_22243905783E3463` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `FK_FD71A9C5A0905086` FOREIGN KEY (`poste_id`) REFERENCES `poste` (`id`);

--
-- Contraintes pour la table `joueur_equipe`
--
ALTER TABLE `joueur_equipe`
  ADD CONSTRAINT `FK_CDF2AA996D861B89` FOREIGN KEY (`equipe_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `FK_CDF2AA99A9E2D76C` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`);

--
-- Contraintes pour la table `match_equipe`
--
ALTER TABLE `match_equipe`
  ADD CONSTRAINT `FK_852643142ABEACD6` FOREIGN KEY (`match_id`) REFERENCES `match_foot` (`id`),
  ADD CONSTRAINT `FK_852643146D861B89` FOREIGN KEY (`equipe_id`) REFERENCES `equipe` (`id`);

--
-- Contraintes pour la table `match_foot`
--
ALTER TABLE `match_foot`
  ADD CONSTRAINT `FK_A8E088E17B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`);

--
-- Contraintes pour la table `match_joueur`
--
ALTER TABLE `match_joueur`
  ADD CONSTRAINT `FK_5C1E50C49D318F34` FOREIGN KEY (`match_foot_id`) REFERENCES `match_foot` (`id`),
  ADD CONSTRAINT `FK_5C1E50C4A9E2D76C` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`);

--
-- Contraintes pour la table `passe_decisive`
--
ALTER TABLE `passe_decisive`
  ADD CONSTRAINT `FK_ABDCFE8D8F70D037` FOREIGN KEY (`type_passe_id`) REFERENCES `type_passe` (`id`),
  ADD CONSTRAINT `FK_ABDCFE8DA9E2D76C` FOREIGN KEY (`joueur_id`) REFERENCES `joueur` (`id`),
  ADD CONSTRAINT `FK_ABDCFE8DB8914BA4` FOREIGN KEY (`but_id`) REFERENCES `but` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
