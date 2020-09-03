-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2017 at 07:41 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meupf`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `categorie_id`, `title`, `created_at`, `updated_at`, `slug`, `content`, `online`, `image`) VALUES
(1, 1, 'Le real Madrid champion', '2017-09-27 00:00:00', '2017-09-27 11:14:31', 'le-real-de_madrid', '<p>Qu&#39;est-ce que le Lorem Ipsum? Le Lorem Ipsum est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n&#39;a pas fait que survivre cinq si&egrave;cles, mais s&#39;est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n&#39;en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>', 0, '/uploads/filemanager/gallery-img7.jpg'),
(2, 1, 'Le barça contre attaque', '2017-09-27 11:07:23', NULL, 'le-barca-contre-attaque', '<div>\r\n<h2>Le bar&ccedil;a contre attaque ?</h2>\r\n\r\n<p>Le <strong>Lorem Ipsum</strong> est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n&#39;a pas fait que survivre cinq si&egrave;cles, mais s&#39;est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n&#39;en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>\r\n</div>', 1, '/uploads/filemanager/4.jpeg'),
(4, 1, 'Cristiano Ronaldo', '2017-09-27 12:14:01', NULL, 'cristiano-ronaldo', '<div>\r\n<h2>Pourquoi l&#39;utiliser?</h2>\r\n\r\n<p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et emp&ecirc;che de se concentrer sur la mise en page elle-m&ecirc;me. L&#39;avantage du Lorem Ipsum sur un texte g&eacute;n&eacute;rique comme &#39;Du texte. Du texte. Du texte.&#39; est qu&#39;il poss&egrave;de une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du fran&ccedil;ais standard. De nombreuses suites logicielles de mise en page ou &eacute;diteurs de sites Web ont fait du Lorem Ipsum leur faux texte par d&eacute;faut, et une recherche pour &#39;Lorem Ipsum&#39; vous conduira vers de nombreux sites qui n&#39;en sont encore qu&#39;&agrave; leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d&#39;y rajouter de petits clins d&#39;oeil, voire des phrases embarassantes).</p>\r\n</div>', 1, '/uploads/filemanager/4.jpeg'),
(5, 1, 'Lorem Ipsum', '2017-09-28 11:39:52', NULL, 'lorem-ipsum', '<div>\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div>\r\n<h2>Pourquoi l&#39;utiliser?</h2>\r\n\r\n<p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et emp&ecirc;che de se concentrer sur la mise en page elle-m&ecirc;me. L&#39;avantage du Lorem Ipsum sur un texte g&eacute;n&eacute;rique comme &#39;Du texte. Du texte. Du texte.&#39; est qu&#39;il poss&egrave;de une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du fran&ccedil;ais standard. De nombreuses suites logicielles de mise en page ou &eacute;diteurs de sites Web ont fait du Lorem Ipsum leur faux texte par d&eacute;faut, et une recherche pour &#39;Lorem Ipsum&#39; vous conduira vers de nombreux sites qui n&#39;en sont encore qu&#39;&agrave; leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d&#39;y rajouter de petits clins d&#39;oeil, voire des phrases embarassantes).</p>\r\n</div>', 1, '/uploads/filemanager/6.png');

-- --------------------------------------------------------

--
-- Table structure for table `categoriearticle`
--

CREATE TABLE `categoriearticle` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `post_count` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categoriearticle`
--

INSERT INTO `categoriearticle` (`id`, `name`, `created_at`, `post_count`, `slug`, `updated_at`) VALUES
(1, 'Sport', '2017-09-27 00:00:00', NULL, 'sport', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorieevent`
--

CREATE TABLE `categorieevent` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `post_count` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorieevent`
--

INSERT INTO `categorieevent` (`id`, `name`, `created_at`, `post_count`, `slug`, `updated_at`) VALUES
(1, 'After pray', '2017-09-27 00:00:00', NULL, 'after-pray', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Categoriemedia`
--

CREATE TABLE `Categoriemedia` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `post_count` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Categoriemedia`
--

INSERT INTO `Categoriemedia` (`id`, `name`, `created_at`, `post_count`, `slug`, `updated_at`) VALUES
(1, 'Predication', '2017-09-27 00:00:00', NULL, 'predication', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Categoriesermon`
--

CREATE TABLE `Categoriesermon` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `post_count` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Categoriesermon`
--

INSERT INTO `Categoriesermon` (`id`, `name`, `created_at`, `post_count`, `slug`, `updated_at`) VALUES
(1, 'familial', '2017-09-27 00:00:00', NULL, 'familial', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  `lieu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `categorie_id`, `title`, `content`, `created_at`, `updated_at`, `delete_at`, `lieu`, `image`, `date`, `phone`, `slug`, `online`, `heureDebut`, `heureFin`) VALUES
(1, 1, 'Psalmeur', '<h2>O&ugrave; puis-je m&#39;en procurer?</h2>\r\n\r\n<p>Plusieurs variations de Lorem Ipsum peuvent &ecirc;tre trouv&eacute;es ici ou l&agrave;, mais la majeure partie d&#39;entre elles a &eacute;t&eacute; alt&eacute;r&eacute;e par l&#39;addition d&#39;humour ou de mots al&eacute;atoires qui ne ressemblent pas une seconde &agrave; du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez &ecirc;tre s&ucirc;r qu&#39;il n&#39;y a rien d&#39;embarrassant cach&eacute; dans le texte. Tous les g&eacute;n&eacute;rateurs de Lorem Ipsum sur Internet tendent &agrave; reproduire le m&ecirc;me extrait sans fin, ce qui fait de lipsum.com le seul vrai g&eacute;n&eacute;rateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour g&eacute;n&eacute;rer un Lorem Ipsum irr&eacute;prochable. Le Lorem Ipsum ainsi obtenu ne contient aucune r&eacute;p&eacute;tition, ni ne contient des mots farfelus, ou des touches d&#39;humour.</p>', '2017-09-27 12:37:29', NULL, NULL, '6 rue de strasbourg', '/uploads/filemanager/4.jpeg', '2017-09-29', '0125689545', 'psalmeur', 1, '12:36:00', '17:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `description`, `image`, `created_at`) VALUES
(1, 'photo1', NULL, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `categorie_id`, `type`, `title`, `slug`, `createdAt`, `url`, `description`) VALUES
(1, 1, 'La traversé', 'Developper song', 'developper-song', '2017-09-27 00:00:00', 'https://www.youtube.com/watch?v=y6NSdGL8czw', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `responsable`
--

CREATE TABLE `responsable` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sermon`
--

CREATE TABLE `sermon` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `title`, `online`, `slug`, `content`, `created_at`) VALUES
(1, 'Nous les jeunes', 1, 'nous-les-jeunes', 'Où puis-je m\'en procurer?\r\n\r\nPlusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d\'entre elles a été altérée par l\'addition d\'humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez être sûr qu\'il n\'y a rien d\'embarrassant caché dans le texte. Tous les générateurs de Lorem Ipsum sur Internet tendent à reproduire le même extrait sans fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches d\'humour.', '2017-09-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `slug`, `image`, `online`, `created_at`) VALUES
(1, 'banniere', 'banniere', '/uploads/filemanager/11.jpeg', 1, '2017-09-27 00:00:00'),
(2, 'banniere2', 'banniere2', '/uploads/filemanager/blog-image1.jpg', 1, '2017-09-27 12:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `temoignage`
--

CREATE TABLE `temoignage` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `phone`) VALUES
(1, 'admin', 'admin', 'admin@example.com', 'admin@example.com', 1, '4bapxphs13c4gkw408ggss4kw804ww8', 'AgWx2fSQATyX2Sn/hwLJ8Ul73SvcCCYTMSLvsTEefOk1qxuZ9lSXiW5vkkFXNpylSuCzfxQVwPKTQHc/D4SzeQ==', '2017-12-09 13:50:57', 0, 0, NULL, NULL, NULL, 'a:4:{i:0;s:9:\"ROLE_USER\";i:1;s:10:\"ROLE_ADMIN\";i:2;s:11:\"ROLE_AUTEUR\";i:3;s:16:\"ROLE_SUPER_ADMIN\";}', 0, NULL, '0985784521');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_23A0E662B36786B` (`title`),
  ADD UNIQUE KEY `UNIQ_23A0E66989D9B62` (`slug`),
  ADD KEY `IDX_23A0E66BCF5E72D` (`categorie_id`);

--
-- Indexes for table `categoriearticle`
--
ALTER TABLE `categoriearticle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7D2F43DC989D9B62` (`slug`);

--
-- Indexes for table `categorieevent`
--
ALTER TABLE `categorieevent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_11A2FDEB989D9B62` (`slug`);

--
-- Indexes for table `Categoriemedia`
--
ALTER TABLE `Categoriemedia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D442E98989D9B62` (`slug`);

--
-- Indexes for table `Categoriesermon`
--
ALTER TABLE `Categoriesermon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_53751270989D9B62` (`slug`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C7294869C` (`article_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3BAE0AA72B36786B` (`title`),
  ADD UNIQUE KEY `UNIQ_3BAE0AA7989D9B62` (`slug`),
  ADD KEY `IDX_3BAE0AA7BCF5E72D` (`categorie_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6A2CA10C989D9B62` (`slug`),
  ADD KEY `IDX_6A2CA10CBCF5E72D` (`categorie_id`);

--
-- Indexes for table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sermon`
--
ALTER TABLE `sermon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A4F02DA22B36786B` (`title`),
  ADD UNIQUE KEY `UNIQ_A4F02DA2989D9B62` (`slug`),
  ADD KEY `IDX_A4F02DA2BCF5E72D` (`categorie_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E19D9AD2989D9B62` (`slug`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CFC71007989D9B62` (`slug`);

--
-- Indexes for table `temoignage`
--
ALTER TABLE `temoignage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BDADBC46989D9B62` (`slug`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categoriearticle`
--
ALTER TABLE `categoriearticle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorieevent`
--
ALTER TABLE `categorieevent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Categoriemedia`
--
ALTER TABLE `Categoriemedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Categoriesermon`
--
ALTER TABLE `Categoriesermon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sermon`
--
ALTER TABLE `sermon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temoignage`
--
ALTER TABLE `temoignage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categoriearticle` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA7BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorieevent` (`id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10CBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `Categoriemedia` (`id`);

--
-- Constraints for table `sermon`
--
ALTER TABLE `sermon`
  ADD CONSTRAINT `FK_A4F02DA2BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `Categoriesermon` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
