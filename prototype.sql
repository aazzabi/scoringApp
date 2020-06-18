-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2020 at 08:10 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prototype`
--

-- --------------------------------------------------------

--
-- Table structure for table `choix`
--

DROP TABLE IF EXISTS `choix`;
CREATE TABLE IF NOT EXISTS `choix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `critere_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` int(11) NOT NULL,
  `coefficient` int(11) NOT NULL,
  `pondere` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F4880919E5F45AB` (`critere_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contribuable`
--

DROP TABLE IF EXISTS `contribuable`;
CREATE TABLE IF NOT EXISTS `contribuable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `formeJuridique` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activite` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `etat` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `immatriculation` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `declarationDeposees` double NOT NULL,
  `nbrEcheancePlanReglementNonRespectee` int(11) NOT NULL,
  `nbrPaiementParChequeSansProvision` int(11) NOT NULL,
  `paiementEffectuesAuPlusTardDateExigibilite` double NOT NULL,
  `montantDesImpositionDeclareesSpontanement` double NOT NULL,
  `montantTotalDesImpositionsEmises` double NOT NULL,
  `dateDebutActivite` datetime DEFAULT NULL,
  `montantDroitsDouaneDeclaresSpontanement` double NOT NULL,
  `montantTotalDroitsDouane` double NOT NULL,
  `montantCotisationsSocialesDecalresSpontanement` double NOT NULL,
  `montantTotalCotisationsSociales` double NOT NULL,
  `montantTresorerie` double NOT NULL,
  `montantDetteFiscale` double NOT NULL,
  `montantResultatComptable3` double NOT NULL,
  `montantResultatComptable2` double NOT NULL,
  `montantResultatComptable1` double NOT NULL,
  `montantExcedentBrutExploitation` double NOT NULL,
  `montantRevenuGlobalDeclare3` double NOT NULL,
  `montantRevenuGlobalDeclare2` double NOT NULL,
  `montantRevenuGlobalDeclare1` double NOT NULL,
  `valeurImmobilisationsCorporellesEtIncorporelles` double NOT NULL,
  `valeurImmobilisationsFinancieres` double NOT NULL,
  `valeurDuPatrimoine` double NOT NULL,
  `montantTotalActif` double NOT NULL,
  `montantCapitauxPropres` double NOT NULL,
  `montantCreancesClients` double NOT NULL,
  `montantAutresCreances` double NOT NULL,
  `loyersDeclares1` double NOT NULL,
  `montantPaiementParEtat` double NOT NULL,
  `valeurImportations1` double NOT NULL,
  `creditOuExcedentTVA` double NOT NULL,
  `montantCreance` double NOT NULL,
  `secteurActivite` double NOT NULL,
  `CahtAnnuel` double NOT NULL,
  `structureDette` int(11) NOT NULL,
  `montantDette4` double NOT NULL,
  `montantDette3` double NOT NULL,
  `montantDette2` double NOT NULL,
  `montantDette1` double NOT NULL,
  `autresGaranties` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `garantiePrivilegeSurImmeuble` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cautionBancaire` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `plansDeReglement` int(11) NOT NULL,
  `dateDebutCreancePlusAncienne` datetime DEFAULT NULL,
  `dateActionRecouvrementOffensive` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `contribuable`
--

INSERT INTO `contribuable` (`id`, `libelle`, `formeJuridique`, `activite`, `etat`, `immatriculation`, `declarationDeposees`, `nbrEcheancePlanReglementNonRespectee`, `nbrPaiementParChequeSansProvision`, `paiementEffectuesAuPlusTardDateExigibilite`, `montantDesImpositionDeclareesSpontanement`, `montantTotalDesImpositionsEmises`, `dateDebutActivite`, `montantDroitsDouaneDeclaresSpontanement`, `montantTotalDroitsDouane`, `montantCotisationsSocialesDecalresSpontanement`, `montantTotalCotisationsSociales`, `montantTresorerie`, `montantDetteFiscale`, `montantResultatComptable3`, `montantResultatComptable2`, `montantResultatComptable1`, `montantExcedentBrutExploitation`, `montantRevenuGlobalDeclare3`, `montantRevenuGlobalDeclare2`, `montantRevenuGlobalDeclare1`, `valeurImmobilisationsCorporellesEtIncorporelles`, `valeurImmobilisationsFinancieres`, `valeurDuPatrimoine`, `montantTotalActif`, `montantCapitauxPropres`, `montantCreancesClients`, `montantAutresCreances`, `loyersDeclares1`, `montantPaiementParEtat`, `valeurImportations1`, `creditOuExcedentTVA`, `montantCreance`, `secteurActivite`, `CahtAnnuel`, `structureDette`, `montantDette4`, `montantDette3`, `montantDette2`, `montantDette1`, `autresGaranties`, `garantiePrivilegeSurImmeuble`, `cautionBancaire`, `plansDeReglement`, `dateDebutCreancePlusAncienne`, `dateActionRecouvrementOffensive`) VALUES
(1, 'annon', 'Societe Anonyme', 'sociÃ©tÃ©', 'Réglement amiable en cours', 'spontannee', 99, 0, 0, 0, 0, 0, '1995-09-06 00:00:00', 0, 0, 0, 0, 0, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 60, 0, 0, 0, 0, 0, 1110000000, 0, 4, 3, 2, 1, '', '', '', 0, NULL, NULL),
(19, 'libs', 'SARL ou GIE', 'activite', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, NULL, NULL),
(22, 'azeazeaeae', 'aeaeazeaze', 'azeaeaazeazea', 'ratissage', NULL, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, NULL, NULL),
(23, 'azeazeaeae', 'aeaeazeaze', 'azeaeaazeazea', NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `creance`
--

DROP TABLE IF EXISTS `creance`;
CREATE TABLE IF NOT EXISTS `creance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribuable_id` int(11) DEFAULT NULL,
  `recette` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secteurActivite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateDebutPriseEnCharge` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `dernierAct` datetime NOT NULL,
  `dernierPaiement` datetime NOT NULL,
  `immatriculation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `statut` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `origine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_82D1060E31DEE1C6` (`contribuable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `creance`
--

INSERT INTO `creance` (`id`, `contribuable_id`, `recette`, `secteurActivite`, `dateDebutPriseEnCharge`, `dateFin`, `dernierAct`, `dernierPaiement`, `immatriculation`, `score`, `montant`, `statut`, `type`, `origine`) VALUES
(1, 1, '9badhet MIDOUN', 'Tech', '2014-05-07 00:00:00', '2020-06-10 00:00:00', '2020-06-06 00:00:00', '2020-06-06 00:00:00', 'IMMAT', NULL, 50, '', '', 'DGI : Taxation d\'office des défaillants déclaratifs'),
(2, 22, '9badhet Marsa', 'Tech', '2020-06-01 00:00:00', '2020-06-10 00:00:00', '2020-06-06 00:00:00', '2020-06-06 00:00:00', 'IMMAT', NULL, NULL, '', '', 'Créance non fiscale');

-- --------------------------------------------------------

--
-- Table structure for table `critere`
--

DROP TABLE IF EXISTS `critere`;
CREATE TABLE IF NOT EXISTS `critere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `critereFilename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7F6A8053B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `critere`
--

INSERT INTO `critere` (`id`, `libelle`, `isActive`, `critereFilename`, `created_by_id`) VALUES
(1, 'Etat', 1, 'scoreEtat', 1),
(2, 'Anciennete', 0, 'scoreAnciennete', 1),
(33, 'FormeJuridique', 0, 'formeJuridique', 1),
(35, 'chiffre d\'affaire', 0, 'chiffreAffaire', 1),
(36, 'Viabilite (personnes physiques)', 0, 'scoreViabilitePersonnesPhysiques', 1),
(37, 'Viabilite (entreprises) par le bilan', 0, 'scoreViabiliteEntreprisesBilan', 1),
(38, 'Type de creance', 0, 'scoreTypedeCreance', 1),
(39, 'Statut d\'importateur regulier', 0, 'scoreStatutImportateurRegulier', 1),
(40, 'Statut de fournisseur de lâ€™Etat', 0, 'scoreStatutFournisseurEtat', 1),
(41, 'Solvabilite par le patrimoine', 0, 'scoreSolvabilitePatrimoine', 1),
(42, 'Solvabilite (entreprises) par le bilan, immobilisations financiÃ¨res', 0, 'scoreSolvabiliteEntreprisesBilan', 1),
(43, 'Situation de tresorerie', 0, 'scoreSituationTresorerie ', 1),
(44, 'Sincerite des elements declares', 0, 'scoreSinceriteElementsDeclares', 1),
(45, 'Viabilite (personnes physiques)', 0, 'scoreSalaireMoyenne', 1),
(46, 'Paiement des impositions', 0, 'ScorePaiementImpositions', 1),
(47, 'Origine de la creance', 1, 'scoreOrigine', 1),
(48, 'Niveau dâ€™endettement (entreprises)', 0, 'scoreNiveauEndettement', 1),
(49, 'Nature de l\'activite exercee', 0, 'scoreNatureActivite', 1),
(50, 'Montant total de la dette', 0, 'scoreMontantTotDette', 1),
(51, ' Autres administrations', 0, ' ScoreAutresAdministrations', 1),
(52, ' DepotDeclarations', 0, ' scoreDepotDeclarations', 1),
(53, ' Evolution', 0, ' ScoreEvolution', 1),
(54, ' Existence Autres Creanciers', 0, ' ScoreExistenceAutresCreanciers', 2),
(55, ' Existence d\'un credit de TVA ou d\'un excedent de versement d\'acomptes provisionnels', 0, ' ScoreExistenceCreditTVA', 1),
(56, ' Existence dâ€™autres creanciers (dettes)', 0, ' ScoreExistenceDebiteurs', 1),
(57, ' Existence de locataires', 0, ' ScoreExistenceLocataires', 1),
(58, 'Existence  de garanties', 0, ' ScoreGarantie', 1),
(59, 'Existence  de garanties', 0, ' ScoreGarantie', 1),
(60, 'Historique de lâ€™action en recouvrement', 0, ' ScoreHistoriqueActionRecouvrement', 1),
(61, 'Historique des plans de rÃ¨glement', 0, 'ScoreHistoriquePlansReglement', 1),
(62, 'Immatriculation', 0, ' ScoreImmatriculation', 1),
(63, 'Viabilite (entreprises) par le resultat', 0, 'scoreViabiliteParResultat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `username`, `role`) VALUES
(1, 'Azzabi', 'Arafet', 'arafet.azzabi@gmail.com', '$2y$10$4DoR4H.nFWFqSim2lUG6KelTW0dhaLPk1hqtjYjxvLlt8KkzPYSlK', 'arafet', 'ADMIN'),
(2, 'test', 'test', 'test', '$2y$10$4DoR4H.nFWFqSim2lUG6KelTW0dhaLPk1hqtjYjxvLlt8KkzPYSlK', 'test', 'ADMIN'),
(3, 'test', 'test', 'test', '$2y$10$fv4d5InWwrC4CxGbwjV4b.nVUnXrrek3MjNuOZoezRHyOSOiJdAM6', 'test', 'ADMIN'),
(4, 'dorra', 'dorra', 'seifallah.azzabi@gmail.com', '$2y$10$4tXWB2EaXvZwWVL4ltDCcuDzLGcE9VcyrJ7kJoR2UQFg/8IIImhvu', 'dorra', 'AGENT'),
(5, 'azeaze', 'eaazeaez', 'arafet.azzabi@esprit.tn', '$2y$10$4DoR4H.nFWFqSim2lUG6KelTW0dhaLPk1hqtjYjxvLlt8KkzPYSlK', 'aze', 'AGENT'),
(7, 'ccc', 'cccc', 'arafet.azzabi@bb.tn', '$2y$10$vHDNRGZddI5jRYzT3sP6MuM/nQKb9idSZL.qzpPTf7t254ZacWdPa', 'username', 'ADMIN'),
(9, 'dddd', 'dddd', 'ddd@amazea.com', '$2y$10$iozzSsaSb78/TnEb0a7GneLFFw/gbDSA65otXOJl07EcsWMi0khNe', 'dddd', 'AGENT'),
(10, 'test', 'test', 'tesaezazet', '$2y$10$2/PMY2/PKnoaRL7vJHisieORVFunBlKb7314Otxgnml37s2deOF82', 'test', 'ADMIN'),
(14, 'aeaezaze', 'azeaze', 'arafet.azzabi@esprit.aaa', '$2y$10$JFxWosIpi6jE2mGduuBZuOb.4TcnlgsSKds0fBvIEtLwCkF9swBwi', 'aaaaava', 'AGENT'),
(15, 'test', 'test', 'test@gmail.com', '$2y$10$Ke7pvQejX/lYf.tXvm6aZ./B732Fh2pV4FmIKsMx4Mn.L8fMa32Ri', 'test', 'AGENT'),
(16, 'maa', 'maa', 'maa@aaa.Aaa', '$2y$10$EfslOz5g7B6QycAzfaY5feTTBGNYPNUdhYbb3izH3ZnFpbSVc5Lc6', 'maaa', 'AGENT'),
(17, 'naaar', 'naaar', 'naaar.naaar@naaar.com', '$2y$10$V6bl4Bdpcn.NSxaKPhpXFeU.7vLD56fxYxji/gmWwrDVeLNb2Ruxu', 'naaar', 'ADMIN'),
(18, 'test add', 'test add', 'testadd@esprit.tn', '$2y$10$AsTgeTJFq/Zw0kHhh30JTec1iXNPG/1agVM9nJ9nOFrhVcFpq9l4u', 'test-add', 'AGENT');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choix`
--
ALTER TABLE `choix`
  ADD CONSTRAINT `FK_4F4880919E5F45AB` FOREIGN KEY (`critere_id`) REFERENCES `critere` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `creance`
--
ALTER TABLE `creance`
  ADD CONSTRAINT `FK_82D1060E31DEE1C6` FOREIGN KEY (`contribuable_id`) REFERENCES `contribuable` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `critere`
--
ALTER TABLE `critere`
  ADD CONSTRAINT `FK_7F6A8053B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
