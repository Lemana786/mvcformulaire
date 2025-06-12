-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 14 avr. 2025 à 14:52
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `year` int NOT NULL,
  `summary` text NOT NULL,
  `creator_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `year`, `summary`, `creator_id`) VALUES
(1, 'Le monde s\'effondre', 'Chinua Achebe', 1958, 'Le protagoniste du roman, Okonkwo, est célèbre dans les villages d\'Umuofia pour ses talents de lutteur, battant un lutteur surnommé Amalinze le chat (parce qu\'il ne tombe jamais sur le dos). Okonkwo est fort, travailleur et s\'efforce de ne montrer aucune faiblesse. Il veut faire oublier le souvenir de son père Unoka, de ses dettes impayées, de sa négligence envers sa femme et ses enfants, et de sa lâcheté à la vue du sang. Okonkwo travaille à bâtir sa richesse entièrement seul, car Unoka est mort d\'une mort honteuse et ne lui a laissé que de nombreuses dettes. Il est aussi obsédé par sa masculinité, et tout petit compromis à ce sujet est rapidement renié. Par conséquent, il bat souvent ses femmes et ses enfants, et il est méchant avec ses voisins. Sa volonté d\'échapper à l\'héritage de son père le conduit à être riche, courageux et puissant parmi les gens de son village. C\'est un leader de son village. Il a atteint une position dans sa société pour laquelle il s\'est battu toute sa vie.', 7),
(2, 'Contes', 'Hans Christian Andersen', 1835, 'Les cent cinquante-six contes d\'Andersen ont tous été traduits en français, mais les titres varient d\'une édition à l\'autre. Ainsi Le Stoïque Soldat de plomb, peut devenir L\'Intrépide soldat de plomb ou L\'Inébranlable soldat de plomb. La Petite Sirène porte aussi le titre de La Petite ondine.', 4),
(3, 'Orgueil et Préjugés', 'Jane Austen', 1813, 'À Longbourn, petit bourg du Hertfordshire, sous le règne du roi George III, Mrs Bennet est déterminée à marier ses cinq filles afin d\'assurer leur avenir53, compromis par certaines dispositions testamentaires. Lorsqu\'un riche jeune homme, Mr Bingley, loue Netherfield, le domaine voisin, elle espère vivement qu\'une de ses filles saura lui plaire assez pour qu\'il l\'épouse. Malheureusement il est accompagné de ses deux sœurs, Caroline et Louisa, plutôt imbues d\'elles-mêmes, et d\'un ami très proche, Mr Darcy, jeune homme immensément riche, propriétaire d\'un grand domaine dans le Derbyshire, mais très dédaigneux et méprisant envers la société locale. ', 5),
(4, 'Le Père Goriot', 'Honoré de Balzac', 1835, 'Le roman s\'ouvre en 1819, avec la description sordide et répugnante du quartier du Val-de-Grâce et de la Maison-Vauquer, une pension parisienne située dans la rue Neuve-Sainte-Geneviève et appartenant à la veuve madame Vauquer. Plusieurs résidents s\'y côtoient, dont : Eugène de Rastignac, jeune étudiant en droit, ambitieux, à l\'esprit sagace et d\'origine modeste ; un mystérieux personnage au physique imposant et aux manières un peu rustres et grossières, nommé Vautrin ; et un ancien vermicellier ayant fait fortune pendant la Révolution, maintenant retraité, complètement désargenté et veuf, surnommé le père Goriot. À l\'époque où ce dernier est arrivé à la pension, lorsqu\'il était encore riche, la veuve Vauquer nourrissait le désir quelque peu intéressé de se marier avec lui. Mais après une malheureuse affaire dont la veuve Vauquer a injustement rejeté la faute sur M. Goriot, celle-ci s\'est mise à développer une certaine aversion pour lui et à entreprendre quelques mesquineries à son égard. C\'est elle, en particulier, qui lui a donné le surnom de \"Père Goriot\" en remplacement de \"M. Goriot\". Les médisances répétées de la veuve Vauquer à son sujet feront de lui le souffre-douleur de la pension. Son caractère taciturne n\'arrange pas les choses et laisse le champ libre aux allégations les plus fantaisistes, comme un supposé libertinage  ou une prétendue déficience mentale. Logent également dans la pension d\'autres personnes, comme mademoiselle Michonneau ou Horace Bianchon. ', 2),
(5, 'Les Hauts de Hurlevent', 'Emily Brontë', 1847, 'Une histoire d\'amour et de vengeance dans un paysage sauvage de l\'Angleterre : Mr Earnshaw, père d\'Hindley et de Catherine, adopte Heathcliff qui tombe amoureux de Catherine tandis qu\'une rivalité s\'instaure entre lui et Hindley...', 5),
(6, 'L\'Étranger', 'Albert Camus', 1942, 'Le roman met en scène un personnage-narrateur nommé Meursault, vivant à Alger en Algérie française. Le roman est découpé en deux parties.\r\n\r\nAu début de la première partie, Meursault reçoit un télégramme annonçant que sa mère, qu\'il a placée à l’hospice de Marengo, vient de mourir. Il se rend en autocar à l’asile de vieillards, situé près d’Alger. Veillant la morte toute la nuit, il assiste le lendemain à la mise en bière et aux funérailles, sans avoir l\'attitude attendue d’un fils endeuillé ; le protagoniste ne pleure pas, il ne veut pas simuler un chagrin qu\'il ne ressent pas. ', 6),
(7, 'Voyage au bout de la nuit', 'Louis-Ferdinand Céline', 1932, 'Voyage au bout de la nuit est un récit à la première personne dans lequel le personnage principal raconte son expérience de la Première Guerre mondiale, du colonialisme en Afrique, des États-Unis de l\'entre-deux guerres et de la condition sociale en général.\r\nFerdinand Bardamu a vécu la Grande Guerre et vu de près l\'ineptie meurtrière de ses supérieurs dans les tranchées. C\'est la fin de son innocence. C\'est aussi le point de départ de sa descente aux enfers sans retour. Ce long récit est d\'abord une dénonciation des horreurs de la guerre, dont le pessimisme imprègne toute l\'œuvre. Il part ensuite pour l\'Afrique, où le colonialisme est le purgatoire des Européens sans destinée. Pour lui c\'est même l\'Enfer, et il s\'enfuit vers l\'Amérique de Ford, du dieu Dollar et des bordels. Bardamu n\'aime pas les États-Unis, mais c\'est peut-être le seul lieu où il ait pu rencontrer un être (Molly) qu\'il aima (et qui l\'aima) jusqu\'au bout de son voyage sans fond.\r\n\r\nMais la vocation de Bardamu n\'est pas de travailler sur les machines des usines de Détroit ; c\'est de côtoyer la misère humaine, quotidienne et éternelle. Il retourne donc en France pour terminer ses études de médecine et devenir médecin des pauvres. Il exerce alors dans la banlieue parisienne, où il rencontre la même détresse qu\'en Afrique ou dans les tranchées de la Première Guerre mondiale. ', 6),
(14, 'Les Misérables', 'Victor Hugo', 1862, 'Les Misérables est un roman de Victor Hugo publié en 1862, l\'un des plus vastes et des plus notables de la littérature du XIX e siècle.', 1),
(15, 'Orgueil et Préjugés', 'Jane Austen', 1813, 'Orgueil et Préjugés est un roman de la femme de lettres anglaise Jane Austen paru en 1813. Il est considéré comme l\'une de ses œuvres les plus significatives et est aussi la plus connue du grand public.', 2),
(17, 'Raison et sensibilité', 'Jane Austen', 1811, 'Sense and Sensibility est le premier roman publié de la femme de lettres anglaise Jane Austen. Il paraît en 1811 de façon anonyme puisqu\'il était signé by a Lady.', 7),
(18, 'Les quatre filles du docteur March', 'Louisa May Alcott', 1868, 'Les Quatre Filles du docteur March est un roman de l’autrice américaine Louisa May Alcott, publié dans un premier temps en deux volumes. Le premier parut en 1868 et le second en 1869.', 4),
(19, 'La Femme de ménage', 'Freida McFadden', 2022, 'La Femme de ménage est le premier roman d\'une trilogie écrite par l\'autrice américaine Freida McFadden. Publié en anglais en 2022, ce thriller psychologique est traduit en français en 2023 ainsi qu\'en espagnol. Roman qualifié de populaire, il est un succès de librairie et un best-seller mondial.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `created_at`, `role`) VALUES
(1, 'Jean', '$2y$10$GbTp0bypqWvSws8xAW2Qs.b6bjMvYB2hI7NY.7.bhQWhuq5vPrTzm', '7d867c34dcb9f51cd5a4c835337a7411', '2025-04-07 13:50:49', 'user'),
(2, 'Camille', '$2y$10$0lZGb3SEvCgVySP3hUefeuR4YQTDOQ9z5QDkueVoF9ts2L9MIS1Di', 'eb1bac786594730eeeca5a2e482b9743', '2025-04-07 13:57:49', 'user'),
(3, 'ADMIN', '$2y$10$slP/PATihZHpcyz7bzc6muEes562f6jjLw8VC0R7SHjwhdoKGJRYu', 'e34448066fdeb550a1c29721da57dbed', '2025-04-13 13:28:00', 'admin'),
(4, 'Olivier', '$2y$10$QywwOPSsp7fEOH1.iHEjQOIQ2CHD1QyFMsxemx9SDfp/fX1ZK0yzO', '7be17be108e6f2225c914c6ca4e6b0b0', '2025-04-14 12:22:40', 'user'),
(5, 'Roger', '$2y$10$14zIDx4NSnVcyCwuI8rpfOxIml4SkVai8HbvlcszdxcRRctTGCZ9K', 'c89e863e1078296e6a2cbc7e9a8ee205', '2025-04-14 13:25:43', 'user'),
(6, 'Cécile', '$2y$10$DL79XveYMkV5tJYXts791.qXeELS.KII9MpSrEvU.YbDl2lALBLO6', '469012766c3dd0aee30fc1c45561d3f1', '2025-04-14 13:26:14', 'user'),
(7, 'Alice', '$2y$10$2n11GHkpJThwjaT0RcUuKez72sKLtXHnKyOcr8bLsQseGLIwYVh/m', '428812db0890797cb91008d2e019b36b', '2025-04-14 13:26:34', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
