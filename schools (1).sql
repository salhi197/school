-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 12 juil. 2021 à 15:55
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `schools`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places_min` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `visible` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `num`, `nb_places_min`, `nb_places_max`, `created_at`, `updated_at`, `visible`) VALUES
(2, 'A2', '42', '73', '2021-03-16 06:11:00', '2021-03-16 06:11:00', 1),
(3, 'A1', '20', '30', '2021-03-16 06:11:00', '2021-03-16 06:11:00', 1),
(4, 'Lotfi Ghezal', '25', '35', NULL, NULL, 0),
(5, 'Sofiane Messaoudenne', '6', '17', NULL, NULL, 0),
(6, 'nom', '25', '37', NULL, NULL, 0),
(7, 'chemin_piece', '18', '39', NULL, NULL, 0),
(8, 'SSS', '25', '35', NULL, NULL, 0),
(9, 'modalite', '25', '35', NULL, NULL, 0),
(10, 'id', '25', '35', NULL, NULL, 0),
(11, 'chemin_piece', '25', '35', NULL, NULL, 0),
(12, 'chemin_piece', '25', '35', NULL, NULL, 0),
(13, 'created_at', '25', '35', NULL, NULL, 0),
(14, 'modalite', '25', '35', NULL, NULL, 0),
(15, 'created_at', '25', '35', NULL, NULL, 0),
(16, 'created_at', '25', '35', NULL, NULL, 0),
(17, 'B1', '15', '24', NULL, NULL, 1),
(18, 'B3', '25', '35', NULL, NULL, 1),
(19, 'chemin_piece', '25', '35', NULL, NULL, 0),
(20, 'Lotfi Ghezal', '25', '35', NULL, NULL, 0),
(21, 'Sofiane Messaoudenne', '25', '35', NULL, NULL, 0),
(22, 'Lotfi Ghezal', '25', '35', NULL, NULL, 0),
(23, 'chemin_piece', '25', '35', NULL, NULL, 0),
(24, 'id', '25', '35', NULL, NULL, 0),
(25, 'Lotfi Ghezal', '25', '35', NULL, NULL, 0),
(26, 'chemin_piece', '25', '35', NULL, NULL, 0),
(27, 'modalite', '28', '35', NULL, NULL, 0),
(28, 'B2', '25', '35', NULL, NULL, 1),
(29, 'B2', '25', '35', NULL, NULL, 0),
(30, 'B4', '27', '35', NULL, NULL, 1),
(31, 'B5', '25', '35', NULL, NULL, 1),
(32, 'C1', '25', '35', NULL, NULL, 1),
(33, 'C3', '25', '35', NULL, NULL, 1),
(34, 'B6', '25', '35', NULL, NULL, 1),
(35, 'C4', '25', '35', NULL, NULL, 1),
(36, 'C2', '25', '35', NULL, NULL, 1),
(37, 'B7', '25', '35', NULL, NULL, 1),
(38, 'D1', '25', '35', NULL, NULL, 1),
(39, 'D2', '30', '40', NULL, NULL, 1),
(40, 'B8', '25', '35', NULL, NULL, 1),
(41, '', '25', '35', NULL, NULL, 0),
(42, '', '25', '35', NULL, NULL, 0),
(43, 'C5', '19', '35', NULL, NULL, 1),
(44, 'D3', '25', '38', NULL, NULL, 1),
(45, 'D4', '25', '35', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ecoles`
--

DROP TABLE IF EXISTS `ecoles`;
CREATE TABLE IF NOT EXISTS `ecoles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GPS` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ecoles`
--

INSERT INTO `ecoles` (`id`, `nom`, `GPS`, `adresse`, `tel1`, `tel2`, `email`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'Malek School', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3197.513088871886!2d3.16728291516929!3d36.734253579962214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128e5392cea80e4f%3A0x6c8d5f0d60f35e72!2sMALEK%20SCHOOL!5e0!3m2!1sfr!2sdz!4v1615900056009!5m2!1sfr!2sdz\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"></iframe>', 'Tamaris,Mohammadia', '0557015468', '0541624286', 'malek_school@gmail.com', 'Rien', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

DROP TABLE IF EXISTS `eleves`;
CREATE TABLE IF NOT EXISTS `eleves` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING HASH
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
CREATE TABLE IF NOT EXISTS `groupes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `pourcentage_prof` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage_ecole` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_scolaire` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prof` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matiere` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jour` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `heure_debut`, `heure_fin`, `pourcentage_prof`, `pourcentage_ecole`, `annee_scolaire`, `classe`, `prof`, `niveau`, `matiere`, `created_at`, `updated_at`, `jour`, `visible`) VALUES
(1, '10:00:00', '12:00:00', '50', '50', '21/22', 'A2', 'Ghezal-Lotfi', '2-AS-Scientifique', 'Math', '2021-07-10 14:11:58', '2021-07-10 14:11:58', 'Dimanche', 1),
(2, '08:00:00', '11:00:00', '60', '40', '21/22', 'D2', 'Ghezal-Lotfi', '3-AS-Mathelème', 'Math', '2021-07-10 14:15:11', '2021-07-10 14:15:11', 'Mercredi', 1),
(3, '10:00:00', '12:00:00', '60', '40', '21/22', 'A1', 'Belarbi-Smail', '3-AS-Math-technique', 'Physique', '2021-07-10 14:20:38', '2021-07-10 14:20:38', 'Samedi', 1),
(4, '13:30:00', '15:00:00', '60', '40', '21/22', 'B1', 'Ghezal-Lotfi', '1-AS-Scientifique', 'Math', '2021-07-10 14:22:42', '2021-07-10 14:22:42', 'Dimanche', 1),
(5, '08:00:00', '10:00:00', '50', '50', '21/22', 'A2', 'Ghezal-Lotfi', '2-AS-Scientifique', 'Math', '2021-07-10 15:02:43', '2021-07-10 15:02:43', 'Mardi', 1),
(6, '08:00:00', '09:30:00', '60', '40', '21/22', 'A2', 'Mechouari-Meriem', '2-AS-Mathelème', 'Science', '2021-07-10 15:44:16', '2021-07-10 15:44:16', 'Dimanche', 1),
(7, '10:00:00', '13:30:00', '60', '40', '21/22', 'B1', 'Ghezal-Lotfi', '2-AS-Langues', 'Math', '2021-07-12 13:11:20', '2021-07-12 13:11:20', 'Dimanche', 1),
(8, '14:00:00', '16:00:00', '50', '50', '21/22', 'A1', 'Mechouari-Meriem', '1-AS-Scientifique', 'Science', '2021-07-12 13:31:39', '2021-07-12 13:31:39', 'Dimanche', 1),
(9, '12:00:00', '14:00:00', '50', '50', '21/22', 'A2', 'Ghezal-Lotfi', '2-AS-Scientifique', 'Math', '2021-07-12 13:33:07', '2021-07-12 13:33:07', 'Dimanche', 1),
(10, '08:00:00', '10:00:00', '50', '50', '21/22', 'A1', 'Chetoui-Messoud', '1-AS-Scientifique', 'Arabe', '2021-07-12 13:42:37', '2021-07-12 13:42:37', 'Dimanche', 1),
(11, '10:00:00', '12:00:00', '60', '40', '21/22', 'A1', 'Ghezal-Lotfi', '2-AS-Scientifique', 'Math', '2021-07-12 13:45:14', '2021-07-12 13:45:14', 'Dimanche', 1),
(12, '16:00:00', '18:00:00', '50', '50', '21/22', 'A1', 'Ghezal-Lotfi', '2-AS-Scientifique', 'Math', '2021-07-12 13:50:30', '2021-07-12 13:50:30', 'Dimanche', 1),
(13, '08:00:00', '10:00:00', '40', '60', '21/22', 'A1', 'Salhi-ALI-Haider', '2-AS-Langues', 'Anglais', '2021-07-12 13:52:50', '2021-07-12 13:52:50', 'Lundi', 1),
(14, '18:00:00', '19:00:00', '50', '50', '21/22', 'A1', 'Kamel-zaoui', '2-AS-Math-technique', 'Arabe', '2021-07-12 14:00:59', '2021-07-12 14:00:59', 'Dimanche', 1),
(15, '08:00:00', '10:00:00', '65', '35', '21/22', 'A1', 'Chetoui-Messoud', '3-AM-------', 'Arabe', '2021-07-12 14:10:35', '2021-07-12 14:10:35', 'Vendredi', 1);

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
CREATE TABLE IF NOT EXISTS `matieres` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`id`, `nom`, `created_at`) VALUES
(1, 'Math', '2021-07-06 13:20:11'),
(2, 'Physique', '2021-07-06 13:40:53'),
(3, 'Science', '2021-07-06 13:45:22'),
(4, 'Arabe', '2021-07-06 13:45:46'),
(5, 'Français', '2021-07-06 13:45:58'),
(6, 'Anglais', '2021-07-06 13:46:13'),
(7, 'Histoire-Géo', '2021-07-06 13:46:40'),
(8, 'Informatique', '2021-07-06 13:46:56'),
(9, 'Economie', '2021-07-06 13:47:31'),
(10, 'Finance', '2021-07-06 13:47:41'),
(11, 'Droits', '2021-07-06 13:48:01'),
(12, 'Mécanique', '2021-07-06 13:48:59'),
(13, 'GP', '2021-07-06 13:49:32'),
(14, 'GC', '2021-07-06 13:49:41'),
(15, 'GE', '2021-07-06 13:49:50');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(45, '2014_10_12_000000_create_users_table', 1),
(46, '2014_10_12_100000_create_password_resets_table', 1),
(47, '2019_08_19_000000_create_failed_jobs_table', 1),
(48, '2021_03_14_102940_create_profs_table', 1),
(49, '2021_03_14_103219_create_niveaux_table', 1),
(50, '2021_03_14_103418_create_matieres_table', 1),
(51, '2021_03_14_103606_create_eleves_table', 1),
(52, '2021_03_14_104016_create_groupes_table', 1),
(53, '2021_03_14_105111_create_seances_table', 1),
(54, '2021_03_15_105111_create_classes_table', 1),
(55, '2021_03_15_105211_create_seancesEleve_table', 1),
(56, '2021_03_16_115443_create_ecoles_table', 1),
(57, '2021_03_16_163253_add_visible_to_classes_table', 2),
(58, '2021_03_18_143153_add_visible_to_profs_table', 3),
(59, '2021_03_18_144519_add_tel_to_profs_table', 4),
(60, '2021_03_18_150443_add_matiere_to_profs_table', 5),
(62, '2021_07_03_153658_add_cycle_to_niveaux_table', 6),
(63, '2021_07_03_155149_remove_nom_desc_from_niveaux', 7),
(64, '2021_07_06_110558_add_visible_to_niveaux_table', 8),
(65, '2021_07_06_130443_update_desc_type_for_matieres_table', 9),
(66, '2021_03_14_103419_create_matieres_table', 10),
(67, '2021_07_07_202943_add_lang_column_to_user', 11),
(68, '2021_07_10_110558_add_visible_to_groupes_table', 12),
(70, '2021_07_10_120458_add_jour_to_groupes_table', 13),
(71, '2021_07_10_104016_create_groupes_table', 14),
(72, '2021_07_10_120658_add_jour_to_groupes_table', 15),
(73, '2021_07_06_110558_add_visible_to_groupes_table', 16);

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

DROP TABLE IF EXISTS `niveaux`;
CREATE TABLE IF NOT EXISTS `niveaux` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cycle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`id`, `created_at`, `updated_at`, `niveau`, `filiere`, `cycle`, `visible`) VALUES
(1, '2021-07-03 06:14:14', NULL, '2', 'Scientifique', 'AS', 1),
(2, '2021-07-03 17:12:24', NULL, '1', 'Scientifique', 'AS', 1),
(3, NULL, NULL, '2', 'Mathelème', 'AS', 1),
(4, NULL, NULL, '2', 'Langues', 'AS', 1),
(5, NULL, NULL, '3', 'Math-technique', 'AS', 0),
(6, NULL, NULL, '1', 'lettre', 'AS', 1),
(7, NULL, NULL, '2', 'Math-technique', 'AS', 1),
(8, NULL, NULL, '2', 'lettre', 'AS', 1),
(9, NULL, NULL, '1', 'Gestion', 'AS', 0),
(10, NULL, NULL, '3', 'lettre', 'AS', 1),
(11, NULL, NULL, '3', 'Scientifique', 'AS', 1),
(12, NULL, NULL, '3', 'Mathelème', 'AS', 1),
(13, NULL, NULL, '3', 'Math-technique', 'AS', 1),
(14, NULL, NULL, '3', 'Gestion', 'AS', 1),
(15, NULL, NULL, '3', 'Gestion', 'AS', 0),
(16, NULL, NULL, '3', 'Langues', 'AS', 1),
(17, NULL, NULL, '2', 'Langues', 'AS', 0),
(18, NULL, NULL, '2', 'Gestion', 'AS', 1),
(19, NULL, NULL, '1', '------', 'AM', 1),
(20, NULL, NULL, '2', '------', 'AM', 1),
(21, NULL, NULL, '3', '------', 'AM', 1),
(22, NULL, NULL, '4', '------', 'AM', 1),
(23, NULL, NULL, '1', '------', 'AP', 1),
(24, NULL, NULL, '2', '------', 'AP', 1),
(25, NULL, NULL, '3', '------', 'AP', 1),
(26, NULL, NULL, '4', '------', 'AP', 1),
(27, NULL, NULL, '5', '------', 'AP', 1),
(28, NULL, NULL, '5', '------', 'AP', 0),
(29, NULL, NULL, '3', 'Mathelème', 'Univ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profs`
--

DROP TABLE IF EXISTS `profs`;
CREATE TABLE IF NOT EXISTS `profs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cycle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `visible` int(11) NOT NULL DEFAULT 1,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profs`
--

INSERT INTO `profs` (`id`, `nom`, `prenom`, `cycle`, `created_at`, `updated_at`, `visible`, `tel`, `matiere`) VALUES
(1, 'Ghezal', 'Lotfi', 'Secondaire', '2021-07-21 22:00:00', NULL, 1, '0557015466', 'Math'),
(2, 'Belarbi', 'Smail', 'Secondaire', '2021-07-25 22:00:00', NULL, 1, '0551859883', 'Physique'),
(4, 'Mestfaoui', 'Wail', 'Moyen', '2021-07-10 22:00:00', NULL, 1, '0551859882', 'Math'),
(6, 'Kadri', 'Ilyes', 'Secondaire', '2021-06-30 22:00:00', NULL, 1, '0543212347', 'Arabe'),
(5, 'Salhi', 'ALI-Haider', 'Univairsitaire', '2021-07-27 22:00:00', NULL, 1, '0786543244', 'Anglais'),
(7, 'Kamel', 'zaoui', 'Secondaire', '2021-07-03 14:26:02', NULL, 1, '0786543212', 'Arabe'),
(13, 'Mechouari', 'Meriem', 'Secondaire', '2021-07-10 15:22:38', NULL, 1, '0553215678', 'Science'),
(14, 'Chetoui', 'Messoud', 'Secondaire', '2021-07-10 15:23:22', NULL, 1, '0767543212', 'Arabe'),
(15, 'Boufetta', 'Hamid', 'Secondaire', '2021-07-10 15:24:20', NULL, 1, '0765984320', 'Physique'),
(16, 'Bouhila', 'Rachid', 'Secondaire', '2021-07-10 15:25:12', NULL, 1, '0550987656', 'Physique');

-- --------------------------------------------------------

--
-- Structure de la table `seances`
--

DROP TABLE IF EXISTS `seances`;
CREATE TABLE IF NOT EXISTS `seances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_groupe` bigint(20) UNSIGNED NOT NULL,
  `num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seances_id_groupe_foreign` (`id_groupe`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `seances`
--

INSERT INTO `seances` (`id`, `id_groupe`, `num`, `created_at`, `updated_at`) VALUES
(1, 13, '1', '2021-07-11 22:00:00', NULL),
(13, 2, '', '2021-07-11 22:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `seances_eleves`
--

DROP TABLE IF EXISTS `seances_eleves`;
CREATE TABLE IF NOT EXISTS `seances_eleves` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `num_seance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paye` tinyint(1) NOT NULL,
  `presence` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `id_seance` bigint(20) UNSIGNED NOT NULL,
  `id_eleve` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seances_eleves_id_seance_foreign` (`id_seance`),
  KEY `seances_eleves_id_eleve_foreign` (`id_eleve`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `lang`) VALUES
(1, 'Lotfi Ghezal', 'ghezal.lotfi10@gmail.com', NULL, '$2y$10$eBQzRm1VgLN8jx7NHCL7DuWJQVJtZRXoggLzl41xuiQzvxczVILgO', NULL, '2021-03-16 11:46:45', '2021-07-09 13:01:02', 'ar');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
