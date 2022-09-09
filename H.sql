-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 02:43 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `h`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajoutb`
--

CREATE TABLE `ajoutb` (
  `id` int(11) NOT NULL,
  `date1` datetime NOT NULL,
  `contenu_blog` varchar(250) NOT NULL,
  `img` varchar(255) NOT NULL,
  `blog_titre` varchar(100) NOT NULL,
  `views` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ajoutb`
--

INSERT INTO `ajoutb` (`id`, `date1`, `contenu_blog`, `img`, `blog_titre`, `views`, `likes`, `id_user`) VALUES
(37, '2021-12-14 18:39:22', 'projet', 'blog-2.png', 'WEB', 0, 0, 21),
(38, '2021-12-14 20:31:13', 'aaa', 'blog-3.gif', 'math', 10, 2, 21),
(39, '2021-12-15 01:53:24', 'une enorme minouchette', 'danny.jpg', 'Minouche', 0, 0, 21);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `idcategorie` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `imagecateg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idcategorie`, `nom`, `imagecateg`) VALUES
(1, 'programmation1', 'prog.jpg'),
(2, 'math', 'math.jpg'),
(3, 'physique', 'physique.png');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `contenu` varchar(150) NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_blog` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `contenu`, `date_comment`, `id_blog`, `id_user`) VALUES
(25, 'eeee', '2021-12-15 00:02:59', 38, 21),
(26, 'j\'adore les frites', '2021-12-15 01:18:50', 38, 21);

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `idcour` int(11) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `idcategorie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`idcour`, `pdf`, `libelle`, `image`, `idcategorie`, `id_user`) VALUES
(16, 'java.jpg', 'aaa', 'C++.png', 1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `id_event` int(11) NOT NULL,
  `titre_event` varchar(200) NOT NULL,
  `date_event` date NOT NULL,
  `type_event` varchar(55) NOT NULL,
  `organisateur_event` varchar(200) NOT NULL,
  `description_event` varchar(500) NOT NULL,
  `image_event` varchar(100) NOT NULL,
  `note_event` int(11) NOT NULL,
  `nb_participant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`id_event`, `titre_event`, `date_event`, `type_event`, `organisateur_event`, `description_event`, `image_event`, `note_event`, `nb_participant`) VALUES
(1, 'FORUM Insat Junior Entreprise', '2021-11-10', 'Workshop', 'Junior Entreprise INSAT', 'Nous vous dévoilons finalement le secret de perfection: le FORUM INSAT ENTREPRISE en sa 3eme édition organisé en collaboration avec la Direction de la Vie Universitaire et des Relations avec L\'Environement', 'uploads/blog-1.jpg', 0, 0),
(3, 'ESPRIT HACKATHON', '2022-01-10', 'Hackathon', 'ESPRIT', 'marathon de programmation est un évènement durant lequel des groupes de développeurs volontaires se réunissent pendant une période de temps donnée afin de travailler sur des projets de programmation informatique de manière collaborative.', 'uploads/blog-3.png', 0, 0),
(4, 'Formation en stratégie', '2021-11-16', 'Workshop', 'Association YOUTH CLUBs', 'une formation ouverte a tout le monde pour apprendre de hardskills , bien planifier / elaborer une stratégie', 'uploads/175407225_187895209830696_5314791142523938107_n.png', 0, 0),
(17, 'Compétition en gaming ', '2021-12-10', 'Competition', 'GAME STAR', 'c', 'uploads/blog-5.jpg', 0, 0),
(18, 'Edition spéciale workshop', '2021-12-03', 'Workshop', 'Association YOUTH CLUBs', 'sdf', 'uploads/blog-4.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id_event`, `id_user`) VALUES
(3, 22),
(3, 22),
(4, 22),
(17, 21),
(18, 21),
(18, 21);

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire`
--

CREATE TABLE `questionnaire` (
  `idQuestionnaire` int(11) NOT NULL,
  `nomQuestionnaire` varchar(300) NOT NULL,
  `lienMiniature` varchar(1200) NOT NULL,
  `timer` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionnaire`
--

INSERT INTO `questionnaire` (`idQuestionnaire`, `nomQuestionnaire`, `lienMiniature`, `timer`, `idUser`, `categorie`) VALUES
(8, 'Wide Komi Kat Wide Komi Kat', 'https://i.kym-cdn.com/photos/images/facebook/001/428/979/e86.jpg', 0, 21, NULL),
(9, 'nigga san', 'https://i.redd.it/r4m835fqrc541.jpg', 0, 21, NULL),
(10, 'This is a threat', 'https://i.redd.it/zegks16ra2821.png', 10, 21, NULL),
(40, 'Too lazy to make something good', 'https://i.redd.it/fgr4vb4jj8041.jpg', 20, 21, NULL),
(44, 'Time to Kermit sudoku', 'https://i.imgflip.com/4spzz0.gif', 70, 21, NULL),
(51, 'Minouche', '../assets/img/undefined.png', 15, 21, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `idQuestion` int(11) NOT NULL,
  `nomQuestion` varchar(300) CHARACTER SET utf8 NOT NULL,
  `idQuestionnaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`idQuestion`, `nomQuestion`, `idQuestionnaire`) VALUES
(72, 'Is Komi Kat Wide ?', 8),
(73, 'Is Komi Kat Narrow ?', 8),
(74, 'I\'m out of ideas', 8),
(75, 'Which one is better ?', 9),
(76, 'Which one is better ? (your life is on the line)', 9),
(77, 'Is this a threat ?', 10),
(78, 'Why ?', 10),
(79, 'Are you in danger ?', 10),
(80, 'A very serious question', 44),
(81, 'And another one', 44),
(82, 'kermit ded so sad can we hit 10k likes', 44),
(83, 'I want to stop this is enough please someone send end i\'m not going well for real this is a distress signal', 40),
(84, 'I want to stop this is enough please someone send end i\'m not going well for real this is a distress signal', 40),
(85, '  I want to stop this is enough please someone send end i\'m not going well for real this is a distress signal ad ASD asdASD asd ASD asd ASD asd', 40),
(86, '  unequestionexcessivementlonguesimplementpourtestersiouiounonl\'overflowfonctionnecorrectementcarilsepeutparfoisquecanemarcheplus', 44),
(102, 'unequestionexcessivementlonguesimplementpourtestersiouiounonl\'overflowfonctionnecorrectementcarilsepeutparfoisquecanemarcheplus', 44),
(115, 'Minouchette', 51);

-- --------------------------------------------------------

--
-- Table structure for table `reponses`
--

CREATE TABLE `reponses` (
  `idReponse` int(11) NOT NULL,
  `nomReponse` varchar(300) NOT NULL,
  `validite` tinyint(1) NOT NULL,
  `idQuestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reponses`
--

INSERT INTO `reponses` (`idReponse`, `nomReponse`, `validite`, `idQuestion`) VALUES
(117, 'Yes', 1, 72),
(118, 'Of course', 1, 72),
(119, 'Absolutely', 1, 72),
(120, 'Undoubtedly', 1, 72),
(121, 'Obviously', 1, 72),
(122, 'No', 0, 73),
(123, 'Impossible', 0, 73),
(124, 'Never', 0, 73),
(125, 'Unimaginable', 0, 73),
(126, 'meow', 0, 73),
(127, 'miaousse', 0, 74),
(128, 'AK-47', 0, 75),
(129, 'MP7', 0, 75),
(130, 'Neither you dumb dumb', 1, 75),
(131, 'M4A1A52WZX8A1', 0, 75),
(132, 'Komi Shouko', 1, 76),
(133, 'Manbagi Rumiko', 0, 76),
(134, 'Both', 0, 76),
(136, 'i don\'t really know', 0, 78),
(137, 'no idea', 0, 78),
(138, 'no clue', 0, 78),
(139, 'idk man she do be kinda cute ngl', 1, 78),
(140, 'Yes', 1, 77),
(141, 'Yes', 1, 77),
(142, 'Yes', 1, 77),
(143, 'perhaps', 1, 79),
(144, 'might be', 0, 79),
(145, 'there is a chance', 0, 79),
(146, 'probably', 0, 79),
(147, 'perhaps (again)', 1, 79),
(148, 'with', 0, 80),
(149, 'some', 0, 80),
(150, 'very', 0, 80),
(151, 'serious', 0, 80),
(152, 'answers', 1, 80),
(153, '*points finger*', 0, 81),
(154, 'and another one', 0, 81),
(155, '*points finger again*', 0, 81),
(156, 'AND another one', 0, 81),
(157, 'F', 1, 82),
(158, 'La question c\'est que si j\'ecrit quelque-chose de mega long comme cela est-ce que le texte va deborder correctement juste en dessous ou va-til faire de la merde comme ma vie', 1, 82),
(159, 'La question c\'est que si j\'ecrit quelque-chose de mega long comme cela est-ce que le texte va deborder correctement juste en dessous ou va-til faire de la merde comme ma vie', 1, 82),
(161, 'doifgosdifghjbsodjfhgnosdjfngoishfgosdjnfgojisdnfgosjdhfngoijert9uij3q04t98jodfgjpswdfojghq0tjosidfgjpsdofug[erjgposjfdnghpoisjfgdhpiojfrhspfidhgpsdfkjgposdijfgpsoidjfgpoisdjfgpoisjfdgphodjfpogh', 0, 85),
(162, '', 0, 84),
(163, '', 0, 85),
(164, '', 0, 84),
(166, ' AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 1, 82),
(168, 'big minouche', 1, 86),
(169, '  AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 0, 86),
(325, '', 0, 76),
(326, '', 0, 76),
(350, 'Minouche', 0, 115);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `idResult` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idQuestionnaire` int(11) DEFAULT NULL,
  `result` int(11) NOT NULL,
  `numberTry` int(11) NOT NULL,
  `dateLimit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`idResult`, `idUser`, `idQuestionnaire`, `result`, `numberTry`, `dateLimit`) VALUES
(2, 21, 44, 0, 0, NULL),
(6, 22, 44, 5, 1, NULL),
(8, 21, 40, 0, 0, NULL),
(9, 22, 40, 1, 1, NULL),
(10, 21, 10, 0, 0, NULL),
(12, 21, NULL, 0, 0, NULL),
(13, 23, 44, 1, 0, NULL),
(14, 21, 51, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `Type`) VALUES
(1, 'ROOT'),
(2, 'LEARNER'),
(3, 'INSTRUCTOR'),
(4, 'BLOGGER'),
(5, 'EVENT ORGANIZER'),
(6, 'CUSTOMER SERVICE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `id_role`, `picture`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`) VALUES
(21, 'admin', 'anesthesied@gmail.com', '$2y$10$nwviq3/zUCX0r5lxPmpoXeW0aHaVteOVPUAn63Kcd2EDbmfyxu1RK', 1, 'pepe.jpg', NULL, '2021-12-13 23:47:08', NULL, NULL),
(22, 'ahmed', 'hassene.zarrouk@esprit.tn', '$2y$10$Llw9X9wN3bx.hKHs0ucKG.ovyrLoRxop.s6wZ72v8qf/BXAZ9M81G', 2, 'pepe.jpg', NULL, '2021-12-13 23:53:02', NULL, NULL),
(23, 'SantoPotato', 'ilyesng@gmail.com', '$2y$10$5MwyEwV9PeXxljQ.q8SgNu7EOPHJ7knfp1xcbeTrLD0mnkAtYVY6u', 2, 'default.png', NULL, '2021-12-15 01:24:27', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajoutb`
--
ALTER TABLE `ajoutb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_blog_user` (`id_user`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idcategorie`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_blog` (`id_blog`),
  ADD KEY `fk_reponse_user` (`id_user`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idcour`),
  ADD KEY `idcategorie` (`idcategorie`),
  ADD KEY `fk_cours_user` (`id_user`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD KEY `pkidevent` (`id_event`),
  ADD KEY `pkiduser` (`id_user`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`idQuestionnaire`),
  ADD KEY `fk_idUserQuestionnaire` (`idUser`),
  ADD KEY `fk_idCategorieQuestionnaire` (`categorie`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idQuestion`),
  ADD KEY `fk_idQuestionnaire` (`idQuestionnaire`);

--
-- Indexes for table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `fk_idQuestion` (`idQuestion`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`idResult`),
  ADD KEY `fk_idUserResults` (`idUser`),
  ADD KEY `fk_idQuestionnaireResult` (`idQuestionnaire`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajoutb`
--
ALTER TABLE `ajoutb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `idcour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `idQuestionnaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `idReponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `idResult` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ajoutb`
--
ALTER TABLE `ajoutb`
  ADD CONSTRAINT `fk_blog_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_blog` FOREIGN KEY (`id_blog`) REFERENCES `ajoutb` (`id`),
  ADD CONSTRAINT `fk_reponse_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`idcategorie`) REFERENCES `categories` (`idcategorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cours_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `pkidevent` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id_event`),
  ADD CONSTRAINT `pkiduser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `fk_idCategorieQuestionnaire` FOREIGN KEY (`categorie`) REFERENCES `categories` (`idcategorie`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUserQuestionnaire` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_idQuestionnaire` FOREIGN KEY (`idQuestionnaire`) REFERENCES `questionnaire` (`idQuestionnaire`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `fk_idQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`idQuestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_idQuestionnaireResult` FOREIGN KEY (`idQuestionnaire`) REFERENCES `questionnaire` (`idQuestionnaire`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUserResults` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
