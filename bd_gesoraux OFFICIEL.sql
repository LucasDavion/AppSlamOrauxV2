-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 12 déc. 2019 à 07:25
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_gesoraux`
--

-- --------------------------------------------------------

--
-- Structure de la table `choixprofdemijournee`
--

DROP TABLE IF EXISTS `choixprofdemijournee`;
CREATE TABLE IF NOT EXISTS `choixprofdemijournee` (
  `idUtilisateur` int(11) NOT NULL,
  `idDemiJournee` int(11) NOT NULL,
  `idSalle` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idDemiJournee`),
  KEY `choixProfDemiJournee_DemiJournee1_FK` (`idDemiJournee`),
  KEY `choixProfDemiJournee_Salle2_FK` (`idSalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `choixprofdemijournee`
--

INSERT INTO `choixprofdemijournee` (`idUtilisateur`, `idDemiJournee`, `idSalle`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 7, 1),
(1, 8, 1),
(1, 10, 1),
(1, 12, 1),
(5, 3, 1),
(5, 4, 1),
(5, 6, 1),
(5, 9, 1),
(5, 11, 1),
(5, 13, 1),
(7, 5, 1),
(4, 5, 2),
(4, 6, 2),
(4, 10, 2),
(3, 2, 7),
(3, 7, 7),
(3, 8, 7),
(7, 4, 8),
(10, 2, 8),
(10, 10, 8),
(10, 11, 8),
(11, 1, 8),
(6, 1, 9),
(6, 2, 9),
(6, 5, 9),
(2, 2, 10),
(2, 4, 10),
(2, 7, 10),
(2, 8, 10),
(2, 9, 10),
(2, 10, 10),
(2, 11, 10),
(8, 1, 10),
(8, 3, 10),
(8, 5, 10),
(8, 6, 10),
(9, 1, 11),
(9, 2, 11),
(12, 1, 12),
(12, 5, 12),
(12, 7, 12),
(7, 1, 13),
(11, 14, 13),
(13, 3, 13),
(13, 6, 13),
(13, 7, 13),
(14, 4, 15),
(14, 5, 15),
(14, 7, 15),
(15, 2, 16),
(15, 4, 16),
(15, 6, 16),
(15, 8, 16),
(15, 10, 16),
(16, 1, 17),
(16, 3, 17),
(16, 4, 17),
(16, 5, 17),
(16, 6, 17),
(16, 7, 17),
(16, 8, 17),
(17, 1, 18),
(17, 6, 18),
(17, 10, 18);

-- --------------------------------------------------------

--
-- Structure de la table `civilite`
--

DROP TABLE IF EXISTS `civilite`;
CREATE TABLE IF NOT EXISTS `civilite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `civilite`
--

INSERT INTO `civilite` (`id`, `libelle`, `code`) VALUES
(1, 'Monsieur', 'M.'),
(2, 'Madame', 'MME'),
(3, 'Autre', 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `demijournee`
--

DROP TABLE IF EXISTS `demijournee`;
CREATE TABLE IF NOT EXISTS `demijournee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `matinAprem` char(13) NOT NULL,
  `periode` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demijournee`
--

INSERT INTO `demijournee` (`id`, `date`, `matinAprem`, `periode`) VALUES
(1, '2019-11-14', 'matin', 'N'),
(2, '2019-11-14', 'après-midi', 'N'),
(3, '2019-11-15', 'matin', 'N'),
(4, '2019-11-15', 'après-midi', 'N'),
(5, '2019-11-18', 'matin', 'N'),
(6, '2019-11-18', 'après-midi', 'N'),
(7, '2019-11-19', 'matin', 'N'),
(8, '2019-11-19', 'après-midi', 'N'),
(9, '2019-11-20', 'matin', 'N'),
(10, '2019-11-20', 'après-midi', 'N'),
(11, '2019-11-21', 'matin', 'N'),
(12, '2019-11-21', 'après-midi', 'N'),
(13, '2019-11-25', 'matin', 'N'),
(14, '2019-11-25', 'après-midi', 'N');

-- --------------------------------------------------------

--
-- Structure de la table `discipline`
--

DROP TABLE IF EXISTS `discipline`;
CREATE TABLE IF NOT EXISTS `discipline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `discipline`
--

INSERT INTO `discipline` (`id`, `libelle`) VALUES
(1, 'Anglais'),
(2, 'Espagnol'),
(3, 'Allemand'),
(4, 'Italien');

-- --------------------------------------------------------

--
-- Structure de la table `division`
--

DROP TABLE IF EXISTS `division`;
CREATE TABLE IF NOT EXISTS `division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `division`
--

INSERT INTO `division` (`id`, `libelle`) VALUES
(1, 'TS1'),
(2, 'TS2'),
(3, 'TS3'),
(4, 'TS4'),
(5, 'TS5'),
(6, 'TES1'),
(7, 'TES2'),
(8, 'TES3');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `tiersTempsON` char(1) NOT NULL,
  `idCivilite` int(11) NOT NULL,
  `idSection` int(11) DEFAULT NULL,
  `idDivision` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Eleve_Civilite0_FK` (`idCivilite`),
  KEY `Eleve_Section1_FK` (`idSection`),
  KEY `Eleve_Division2_FK` (`idDivision`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `dateNaissance`, `tiersTempsON`, `idCivilite`, `idSection`, `idDivision`) VALUES
(1, 'ABERDANE', 'SALMA', '2002-02-18', 'N', 2, NULL, 2),
(2, 'ADOUI', 'ADAM AHMED', '2001-12-24', 'N', 1, NULL, 7),
(3, 'ALEXOPOULOS', 'JULIEN JOSE DENIS', '2001-06-22', 'N', 1, NULL, 8),
(4, 'ALFANDARI', 'APOLLINE MARION MONIQUE', '2001-09-27', 'N', 2, 1, 6),
(5, 'ALLAL', 'ALEXIA SARAH MICHELE', '2003-02-14', 'N', 2, 1, 3),
(6, 'AMOEDO', 'ELISE', '2001-12-31', 'N', 2, NULL, 2),
(7, 'AROUMOUGAM', 'RIOS SOUDAMANE', '2001-07-14', 'N', 1, 1, 3),
(8, 'AZAM', 'ALICE LOU CHARLOTTE', '2001-09-13', 'N', 2, 2, 1),
(9, 'BABEL', 'EMINA BETTY RUKIJA', '2001-06-29', 'N', 2, NULL, 6),
(10, 'BACHELIER', 'MARINE MANON', '2001-07-29', 'N', 2, 1, 4),
(11, 'BAGUET', 'YLAN FLORIAN', '2000-02-06', 'N', 1, NULL, 2),
(12, 'BEAUDAN', 'MATHEO PIERRE BARTHELEMY', '2001-04-27', 'N', 1, 1, 4),
(13, 'BECQ WOIRHAYE', 'JULES FRANCOIS LOUIS', '2001-05-03', 'O', 1, 1, 3),
(14, 'BELKACI', 'ALIENOR NATACHA SOFIA', '2001-04-10', 'N', 2, 1, 6),
(15, 'BERGERON', 'THEO LEENDERT JEAN-CLAUDE', '2001-02-09', 'N', 1, NULL, 7),
(16, 'BESLAY', 'LOUIS', '2000-09-27', 'N', 1, NULL, 1),
(17, 'BETAILLE', 'MAXIMILIEN CHARLES', '2001-09-24', 'N', 1, NULL, 1),
(18, 'BETHMONT', 'ALEXANDRE NICOLAS MORGAN', '2001-07-23', 'N', 1, NULL, 7),
(19, 'BILDIRAN', 'YUNUSAY', '2001-05-28', 'N', 2, NULL, 8),
(20, 'BIOT', 'THOMAS', '2001-01-26', 'N', 1, NULL, 3),
(21, 'BLAISE', 'ARTHUR', '2001-02-28', 'N', 1, 1, 5),
(22, 'BLERREAU', 'FLAVIE JADE VICTORIA', '2001-11-02', 'N', 2, 1, 6),
(23, 'BOUILLE', 'ESTELLE CAMILLE', '2001-10-21', 'N', 2, 1, 3),
(24, 'BOURSIER', 'SARAH MARTINE', '2001-02-01', 'N', 2, NULL, 7),
(25, 'BOURZIZA', 'YASMINE', '2001-04-20', 'N', 2, NULL, 3),
(26, 'BOUTRON', 'EVE EMMA CLAIRE', '2001-05-31', 'N', 2, 1, 4),
(27, 'BRETAUDEAU', 'CHLOE AUDE JULIE', '2001-04-03', 'N', 2, 1, 6),
(28, 'BRETON', 'GAELLE', '2001-04-30', 'N', 2, NULL, 7),
(29, 'BRIDE-BORGETTO', 'JOAN WILLIAM OLIVIER', '2000-06-13', 'O', 1, NULL, 7),
(30, 'BUREAU', 'NILS BERNARD PIERRE', '2001-04-07', 'N', 1, 1, 5),
(31, 'CAHUZAC', 'IAN CHRISTOPHER', '2001-03-20', 'N', 1, 2, 1),
(32, 'CAILLOT', 'EMMA ANDREE COLETTE', '2001-06-21', 'N', 2, NULL, 7),
(33, 'CARRET', 'ALEXIA CHLOE ANNE', '2001-11-19', 'N', 2, 2, 1),
(34, 'CARRIE', 'MARTIN ADRIEN LOUIS', '2001-08-03', 'N', 1, 1, 2),
(35, 'CASTANO', 'CHLOE MARGOT', '2001-06-22', 'N', 2, NULL, 1),
(36, 'CASTRO OLIVEIRA', 'CHLOE', '2001-02-25', 'O', 2, NULL, 7),
(37, 'CAZET', 'CLARA MARION', '2001-12-16', 'N', 2, 1, 3),
(38, 'CHALENCON', 'LEA MARIE PIERRETTE', '2001-05-28', 'N', 2, 1, 4),
(39, 'CHAMPION', 'QUENTIN HUGO', '2001-07-08', 'N', 1, NULL, 5),
(40, 'CHARON', 'MATHILDE CAROLINE AMELINE', '2001-02-15', 'N', 2, 1, 6),
(41, 'CHAVE', 'MADELEINE DOMINIQUE ANNIE', '2001-09-14', 'N', 2, NULL, 6),
(42, 'CIETERS', 'LESLIE FREDERIQUE CATHERI', '2001-08-14', 'N', 2, NULL, 3),
(43, 'CLAIR', 'LENA CHLOE LMIARA', '2001-10-18', 'N', 2, 1, 5),
(44, 'CLOAREC', 'CORENTIN PASCAL CLEMENT', '2002-08-07', 'N', 1, NULL, 5),
(45, 'COLLETTE', 'VICTOR JEAN MARIE', '2001-04-19', 'N', 1, NULL, 7),
(46, 'COLMAIRE', 'SARAH BENEDICTE', '2001-05-29', 'N', 2, NULL, 4),
(47, 'COSSIN', 'MAXIME BAPTISTE THOMAS', '2001-04-18', 'N', 1, NULL, 2),
(48, 'COUDRAY', 'CHLOE EMMY TIPHAINE', '2001-11-15', 'N', 2, 1, 3),
(49, 'COUVELARD', 'CELIA', '2001-10-23', 'N', 2, NULL, 7),
(50, 'COUVIDOU', 'GUILLAUME CHRISTIAN', '2001-07-20', 'N', 1, NULL, 4),
(51, 'CRETTEUR', 'MARTIN FRANCOIS', '2001-09-29', 'N', 1, 1, 3),
(52, 'CROZAT', 'JUSTINE CAROLINE LOUISE', '2000-04-30', 'N', 2, NULL, 7),
(53, 'CUNY', 'ANATOLE LUDOVIC JACQUES', '2001-09-15', 'N', 1, 1, 5),
(54, 'D\'ARTAGNAN', 'ANNE-SOPHIE DELPHINE', '2001-03-14', 'N', 2, NULL, 8),
(55, 'DE PAULA', 'DANIEL RUI', '2001-12-11', 'N', 1, 1, 2),
(56, 'DE WAELE', 'BENJAMIN', '2001-08-14', 'N', 1, NULL, 5),
(57, 'DEBRIL', 'GUILLAUME CORENTIN', '2002-01-06', 'N', 1, 1, 2),
(58, 'DECLERCQ', 'DORIANE ALINE DANAE', '2001-01-02', 'N', 2, NULL, 5),
(59, 'DEDENYS', 'CLOE FANNY CAMILLE', '2001-05-23', 'N', 2, NULL, 2),
(60, 'DELAROCHE', 'ANDREA', '2002-10-14', 'N', 1, NULL, 7),
(61, 'DELOBEL', 'ELLIOT REGINALD', '2001-12-03', 'N', 1, 1, 5),
(62, 'DELPLACE', 'MATHILDE', '2001-03-04', 'N', 2, NULL, 7),
(63, 'DEPREZ', 'SARA ANITA CECILE', '2001-05-25', 'N', 2, NULL, 7),
(64, 'DESMETTRE', 'ELSA', '2001-12-22', 'N', 2, 1, 6),
(65, 'DESPRES', 'BAPTISTE CLAUDE', '2001-01-22', 'N', 1, 1, 6),
(66, 'DESVIGNES', 'MARGUERITE EMMA', '2001-08-08', 'N', 2, 2, 1),
(67, 'DEULIN', 'KILLIAN', '1999-10-28', 'N', 1, NULL, 1),
(68, 'DIAS', 'DILARA', '2001-10-17', 'N', 2, NULL, 1),
(69, 'DION', 'ARTHUR', '2001-04-07', 'N', 1, 1, 3),
(70, 'DIOP', 'DJIBRIL', '2001-01-27', 'N', 1, NULL, 8),
(71, 'DOMART', 'FLORA HAI CHAO', '2001-12-28', 'N', 2, 1, 3),
(72, 'DREUE', 'FLORIAN FRANCOIS MAURICE', '2001-02-13', 'N', 1, NULL, 1),
(73, 'DUBERNARD', 'HELENE CAMILLE', '2001-12-23', 'N', 2, 1, 4),
(74, 'DUBOCAGE', 'MARIA', '2000-10-01', 'N', 2, 1, 6),
(75, 'DUBOIS', 'GUILLAUME NATHAN', '2001-12-17', 'N', 1, 1, 4),
(76, 'DUBOIS', 'THOMAS THIERRY', '2001-05-11', 'N', 1, NULL, 7),
(77, 'DUCHAUX', 'MANON SYLVIANE ELIANE', '2001-06-10', 'O', 2, NULL, 2),
(78, 'DUCRET', 'ENZO MICHEL SYLVAIN', '2000-09-08', 'N', 1, NULL, 8),
(79, 'DUFRENNE', 'LEANA LUCIE MARIE', '2001-08-21', 'N', 2, 1, 3),
(80, 'DUPLESSI', 'PAUL THOMAS', '2001-01-09', 'N', 1, NULL, 2),
(81, 'DUTEIL', 'MARCUS ALBERT', '2001-01-12', 'N', 1, NULL, 2),
(82, 'DUVAL', 'LAURIE ALEXIA', '2001-07-24', 'N', 2, NULL, 2),
(83, 'ECK', 'ROMAIN', '2001-07-06', 'N', 1, NULL, 3),
(84, 'EL RHARBI', 'NADIA', '2001-09-09', 'N', 2, NULL, 3),
(85, 'ELOY', 'MAUD LOLITA RENEE', '2001-02-23', 'N', 2, NULL, 4),
(86, 'FACE', 'CHRISTA', '2000-04-29', 'N', 2, NULL, 3),
(87, 'FALICON', 'TATIANA ARLETTE EVELYNE', '2001-05-22', 'N', 2, NULL, 1),
(88, 'FARRUGIA', 'MATTHIEU THOMAS', '2001-03-06', 'N', 1, 1, 5),
(89, 'FAURE', 'CLEMENTINE', '2001-04-15', 'N', 2, 2, 1),
(90, 'FAVIER', 'ALEXANDRA CHANTAL MARTINE', '2001-07-11', 'N', 2, NULL, 7),
(91, 'FERNANDES', 'EVA ELODIE VERONIQUE', '2000-12-10', 'N', 2, NULL, 2),
(92, 'FERRE', 'BATISTE ROLAND', '2002-03-21', 'N', 1, 1, 5),
(93, 'FOFANA', 'LAMINE', '2001-08-07', 'N', 1, NULL, 6),
(94, 'FONBONNE', 'JONATHAN DAVID MAURICE', '2000-09-07', 'N', 1, NULL, 4),
(95, 'FONTAINE', 'CLEMENCE DENISE LAURENCE', '2001-01-30', 'N', 2, 1, 3),
(96, 'FOREAU', 'GAUTHIER AXEL', '2001-12-08', 'N', 1, NULL, 2),
(97, 'FOUCHET', 'PAUL', '2000-10-09', 'N', 1, NULL, 2),
(98, 'FROGER', 'ROMAIN BLAISE', '2002-01-26', 'N', 1, 1, 4),
(99, 'GARCIA', 'CELINA BEATRIZ', '2001-09-12', 'N', 2, NULL, 3),
(100, 'GAUTHIER', 'COPPELIA CLARA', '2001-05-29', 'N', 2, 1, 4),
(101, 'GIBERT', 'LESLIE MICHAELLA', '2001-07-02', 'N', 2, NULL, 3),
(102, 'GILBERT', 'MALO FRANCOIS JEAN', '2001-04-13', 'N', 1, NULL, 8),
(103, 'GIRARD', 'MATHYS ROMAIN', '2001-04-13', 'N', 1, NULL, 1),
(104, 'GISSER', 'MARIE', '2001-06-13', 'N', 2, NULL, 3),
(105, 'GODARD', 'BASTIEN', '2001-04-01', 'N', 1, NULL, 7),
(106, 'GODFREY', 'OLIVIA HONOR', '2001-09-11', 'N', 2, 1, 6),
(107, 'GONIN', 'PIERRE MATHIEU', '2001-03-04', 'N', 1, 1, 4),
(108, 'GRATON', 'THOMAS CLAUDE ROLAND', '2001-01-31', 'N', 1, NULL, 7),
(109, 'GUEST', 'JULIE MARYVONNE GHISLAINE', '2001-01-15', 'N', 2, 1, 3),
(110, 'GUIBERT', 'CAMILLE CECILE MONIQUE', '2001-04-27', 'N', 2, NULL, 3),
(111, 'GUO', 'YIXIN', '2000-01-12', 'N', 2, NULL, 6),
(112, 'HADDAD', 'INES MONIQUE MESSAOUDA', '2001-08-07', 'N', 2, 1, 6),
(113, 'HAJIB', 'IHSSANE', '2001-08-29', 'N', 2, 1, 6),
(114, 'HARACHE', 'GAETAN JEAN-MARIE LUCAS', '2001-02-13', 'N', 1, NULL, 1),
(115, 'HARMER', 'SEBASTIEN DOUGLAS SERRIDG', '2000-10-26', 'N', 1, NULL, 1),
(116, 'HAUSSOULIER', 'LUCILE', '2001-04-24', 'N', 2, NULL, 7),
(117, 'HEBERT', 'ALICE MARIE LAURE', '2001-12-05', 'N', 2, 1, 6),
(118, 'HEDREVILLE', 'JOAQUIM LLOYD BENJAMIN', '2001-12-23', 'N', 1, 1, 5),
(119, 'HEME', 'ELSA EVE', '2001-08-29', 'N', 2, 2, 1),
(120, 'HOUIS', 'ELEA', '2001-11-06', 'N', 2, NULL, 1),
(121, 'IATRINO', 'BENJAMIN DANIEL', '2001-04-21', 'N', 1, 1, 2),
(122, 'JACONELLI', 'THEO OCTAVE', '2001-12-11', 'O', 1, NULL, 1),
(123, 'JACQUEMET', 'MORGANE MYRIAM ANNICK', '2001-09-14', 'N', 2, NULL, 6),
(124, 'JACQUES', 'NICOLAS BERNARD ALFREDO', '2001-10-02', 'N', 1, 1, 3),
(125, 'JAOUEN', 'JULIA ANA ISABELLE', '2001-03-07', 'N', 2, 2, 1),
(126, 'JARRY', 'MARION THERESE MARIE', '2001-01-23', 'N', 2, NULL, 7),
(127, 'JARZAGUET', 'CLARA JULIETTE', '2001-02-12', 'N', 2, 1, 2),
(128, 'J\'DIR', 'MYRIAM', '2001-07-31', 'N', 2, NULL, 7),
(129, 'JEAN', 'OMBELINE MARIANNE NATHALI', '2001-07-02', 'N', 2, NULL, 5),
(130, 'JOUANJEAN', 'ASTRID CARINE SANDRINE', '2001-07-22', 'N', 2, NULL, 1),
(131, 'KADDOURI', 'ILHAM', '1999-10-09', 'N', 2, NULL, 1),
(132, 'KADDOURI', 'NOUREDDINE', '2001-05-29', 'N', 1, NULL, 2),
(133, 'KAFAIT', 'MAHNOOR', '2000-07-18', 'N', 2, NULL, 7),
(134, 'KERIOU', 'YLIES', '2001-10-31', 'N', 1, 1, 6),
(135, 'KERROC\'H', 'ANNA MORGANE MARITE', '2001-08-08', 'N', 2, 1, 5),
(136, 'LALOUM', 'WILLIAM ADAM CHARLY', '2001-11-14', 'N', 1, 1, 4),
(137, 'LAMBRET', 'MARGAUX JEANNE MARIE', '2002-01-22', 'N', 2, 1, 3),
(138, 'LAUNAY', 'NICOLAS JEAN-CLAUDE', '2001-12-23', 'N', 1, NULL, 1),
(139, 'LAURENT', 'CLEO JASMINE MARIE-JOSEE', '2001-02-27', 'O', 2, NULL, 2),
(140, 'LE GUILLY', 'ERWANN GERARD MICHEL', '2002-03-30', 'N', 1, 1, 4),
(141, 'LEBRAUD', 'VALENTIN ALEXANDRE', '1999-04-25', 'O', 1, NULL, 5),
(142, 'LEBRUN', 'BENOITE PRISCILLA MARGUER', '2001-02-10', 'N', 2, 1, 6),
(143, 'LECLERC', 'HUGO CHARLES JEAN', '2001-03-04', 'N', 1, NULL, 2),
(144, 'LECLERE', 'LEOPOLD OLIVIER GERALD', '2001-04-08', 'N', 1, 1, 5),
(145, 'LEDOYEN', 'ALEXANDRE REGIS ANDRE', '2002-08-19', 'N', 1, 1, 6),
(146, 'LEGRAND', 'REBECCA DORINE', '2001-03-09', 'N', 2, NULL, 7),
(147, 'LEGRESY', 'CHLOE SANDRA', '2001-05-08', 'N', 2, NULL, 6),
(148, 'LEGROS', 'THEVA JACK LUCIEN', '1999-04-30', 'N', 1, NULL, 7),
(149, 'LELEUP', 'THEO', '2002-05-01', 'N', 1, 1, 4),
(150, 'LENOHIN', 'KEASY MARIE-LINDSAY MAYMO', '2001-06-14', 'N', 2, NULL, 1),
(151, 'LEON', 'MYLENE ILIANA PAOLINE', '2001-03-25', 'N', 2, 1, 3),
(152, 'LEROUX', 'ANTHONY', '2000-09-15', 'N', 1, NULL, 6),
(153, 'LESNARD', 'TANGUY LUCIEN JEAN', '2001-05-25', 'N', 1, 1, 5),
(154, 'LETANG', 'CONSTANCE ELISABETH GINET', '2001-03-15', 'N', 2, NULL, 6),
(155, 'L\'HEUREUX', 'HUGO ERIC FABRICE', '2002-01-19', 'N', 1, 1, 3),
(156, 'LINKES', 'FELICIA ODILE NICOLE', '2001-06-20', 'N', 2, NULL, 7),
(157, 'LOGEZ', 'LAURA JOSETTE BRIGITTE', '2001-06-18', 'N', 2, NULL, 8),
(158, 'LORIDAN', 'ROMANE MARTINE THERESE', '2001-06-13', 'N', 2, NULL, 5),
(159, 'LYON', 'RAPHAEL ALEXANDRE', '2001-03-03', 'N', 1, 1, 2),
(160, 'MAILLY', 'LUC CLAUDE PAUL', '2001-01-13', 'N', 1, NULL, 8),
(161, 'MALAPELLE', 'CLARA YVETTE JOSETTE', '2001-09-16', 'N', 2, NULL, 8),
(162, 'MARCEL', 'HUGO DENIS DANIEL', '2001-06-15', 'N', 1, 1, 5),
(163, 'MARIE', 'VIANNEY', '2001-10-02', 'N', 1, NULL, 2),
(164, 'MARTEL', 'LEA NICOLE DENISE', '2002-11-04', 'N', 2, 1, 6),
(165, 'MARTIN', 'THIBAULT MICHEL JEAN', '2001-09-03', 'N', 1, 1, 2),
(166, 'MARTINEZ', 'VINCENT ESTEBAN NATHAN', '2001-05-24', 'O', 1, NULL, 4),
(167, 'MAULVAULT', 'ALINE', '2001-01-06', 'N', 2, NULL, 3),
(168, 'MCAULEY', 'ZACHARY KOCH', '2001-05-11', 'N', 1, 2, 1),
(169, 'MEHTOUGUI', 'ACHRAF', '2001-09-18', 'N', 1, NULL, 2),
(170, 'MELLY', 'PAULINE', '2001-06-21', 'N', 2, NULL, 8),
(171, 'MENERET -SIMON', 'SOLENE SOLANGE JEANNETTE', '2001-12-06', 'N', 2, NULL, 8),
(172, 'MENOU', 'DIANE MONIQUE', '2001-08-28', 'N', 2, 1, 6),
(173, 'MESNIER-LEVATIC', 'SACHA DIMITRI', '2001-04-14', 'N', 1, 1, 2),
(174, 'MICHEL', 'EMELINE DELPHINE', '2001-12-20', 'N', 2, NULL, 8),
(175, 'MIXTUR', 'MELVIN - ALLEN JOEL FRED', '2001-01-22', 'N', 1, NULL, 8),
(176, 'MOINET', 'EMILIE MADELEINE CECILE', '2000-12-04', 'N', 2, NULL, 8),
(177, 'MOLON', 'EVA RENEE SYLVIE', '2002-05-15', 'N', 2, NULL, 7),
(178, 'MONIER', 'ANTOINE VINCENT FRANCOIS-', '2001-01-05', 'N', 1, NULL, 2),
(179, 'MONRAISIN', 'ALEXI', '2001-10-16', 'N', 1, NULL, 8),
(180, 'MOUELLE MOUNGALA', 'ISMAEL', '2001-05-28', 'N', 1, NULL, 7),
(181, 'MOULIN', 'LOIS ROBIN', '2001-09-20', 'N', 1, 1, 2),
(182, 'NAYAR', 'LAVANYA ELEANOR KAUR', '2001-09-16', 'N', 2, 2, 1),
(183, 'NAYRAT', 'EMELINE', '2000-11-22', 'N', 2, NULL, 3),
(184, 'NGAINDJO', 'SERGE WILFRIED', '2001-08-30', 'N', 1, NULL, 7),
(185, 'NGAMI LIKIBI', 'DYLAN ARISTOTE MICHEL', '2001-03-27', 'N', 1, NULL, 8),
(186, 'NGUYEN', 'LUC HONG PHUC', '2001-02-24', 'N', 1, NULL, 4),
(187, 'NICOLAS', 'JULIEN CHRISTOPHER JOSE', '2001-05-26', 'N', 1, NULL, 1),
(188, 'OUSSELIM', 'ASMAA', '2000-12-22', 'N', 2, NULL, 6),
(189, 'PAIXAO', 'LUCA', '2001-05-05', 'N', 1, NULL, 8),
(190, 'PASTE DADONE', 'AXEL CLAUDE GUY', '2001-05-03', 'N', 1, NULL, 4),
(191, 'PAUCHET', 'JULIEN', '2001-08-16', 'N', 1, NULL, 4),
(192, 'PAUL', 'CARLA', '2001-04-20', 'N', 2, NULL, 3),
(193, 'PIETO', 'SIMON JEAN VICTOR', '2001-10-29', 'O', 1, NULL, 1),
(194, 'PIETRUSZKA', 'RAPHAEL HERY DENIS', '2001-11-07', 'N', 1, NULL, 8),
(195, 'POGAM', 'MARTIN PASCAL EMMANUEL', '2001-12-04', 'N', 1, 1, 2),
(196, 'PRAQUIN', 'FELIX MATHURIN PIERRE', '2001-06-28', 'N', 1, 1, 2),
(197, 'PUECH', 'JEREMY ALAIN ROBERT', '2001-04-12', 'N', 1, NULL, 8),
(198, 'QUARTERMAINE', 'LENA PERRINE', '2001-08-19', 'N', 2, 1, 2),
(199, 'RAZAC', 'VALENTIN PAUL JEAN', '2002-01-23', 'N', 1, 1, 3),
(200, 'REICHMAN', 'RAPHAEL EDGAR', '2001-08-22', 'N', 1, 1, 4),
(201, 'REMAZEILLES', 'ANAIS GENEVIEVE DENISE', '2001-01-17', 'N', 2, 1, 5),
(202, 'RENARD', 'EVA-DORINE MICHELE', '2000-08-03', 'N', 2, NULL, 7),
(203, 'RICHET', 'ELISA MARYVONNNE VERONIQU', '2002-01-19', 'N', 2, 2, 6),
(204, 'RIVRIN', 'ROMAIN KYLLIAN CLEMENT', '2001-09-27', 'N', 1, NULL, 7),
(205, 'ROSSO', 'CHIARA', '2001-06-08', 'O', 2, NULL, 2),
(206, 'ROUGEMONT', 'ELLIOTT', '2001-06-17', 'N', 1, NULL, 6),
(207, 'SALAUN', 'LOUISE-ANNE GABRIELLE JOS', '2001-09-07', 'N', 2, 1, 5),
(208, 'SAUVAGE', 'SOLENN ERIKA ALEXANDRA', '2001-03-19', 'N', 2, 1, 6),
(209, 'SAVELL-CONGREVE', 'HARRY JAMES', '2001-04-20', 'N', 1, NULL, 6),
(210, 'SCORNET', 'ILONA CHRISTELLE CAROLINE', '2001-02-01', 'N', 2, NULL, 8),
(211, 'SELLE', 'LEA JUSTINE', '2001-05-24', 'N', 2, 1, 2),
(212, 'SELMI', 'SOFIANE', '2001-05-28', 'N', 1, NULL, 6),
(213, 'SERCER', 'ALEXANDRE JEAN MARIE', '2000-10-26', 'O', 1, NULL, 8),
(214, 'SERRAI', 'EMMA', '2001-12-13', 'N', 2, NULL, 7),
(215, 'SERRANO', 'MATTEO GILBERT CLAUDE', '2001-06-13', 'N', 1, NULL, 4),
(216, 'SMAIL', 'AKSEL', '2001-12-06', 'O', 1, NULL, 3),
(217, 'SMAIL', 'LOUISE', '2001-12-06', 'N', 2, 1, 3),
(218, 'SOUMAH', 'NINA', '2001-04-29', 'N', 2, 1, 6),
(219, 'STEVENAZZI', 'CLARA LAURENCE', '2001-04-03', 'N', 2, NULL, 8),
(220, 'STOURBE', 'ALBAN MICHEL ROGER', '2001-10-04', 'N', 1, 1, 4),
(221, 'SWIDERSKI', 'MARINE SIMONE JOSIANE', '2000-04-19', 'N', 2, NULL, 2),
(222, 'SZPIRGLAS', 'FELIX', '2002-07-26', 'N', 1, 1, 4),
(223, 'TALIBART', 'MALO PIERRE-JEAN LAURENT', '2001-05-14', 'N', 1, 1, 5),
(224, 'TASSIN', 'MATTEO EYRIAN', '2001-06-05', 'N', 1, NULL, 8),
(225, 'TETU', 'MARYSE ROMAINE AIMEE', '2001-09-11', 'N', 2, NULL, 1),
(226, 'THILLOUX', 'CHLOE DENISE CATHERINE', '2001-05-04', 'N', 2, NULL, 7),
(227, 'THIOUB', 'KADIATA', '2001-07-02', 'N', 2, 2, 1),
(228, 'THUMARIN', 'JULIEN NICOLAS', '2002-08-25', 'N', 1, 1, 5),
(229, 'TOURAILLE', 'MAXENCE MICHEL ROGER', '2000-10-26', 'N', 1, NULL, 6),
(230, 'TOURE', 'LISA TAI', '2000-02-28', 'N', 2, NULL, 6),
(231, 'TOURNES-SAVRY', 'SACHA JEAN', '2003-02-03', 'N', 1, NULL, 1),
(232, 'TROALEN', 'GWENOLA CLAUDYE DANIELLE', '2001-08-10', 'N', 2, NULL, 7),
(233, 'VALERIO', 'ALICE JULIETTE', '2001-06-25', 'N', 2, 1, 3),
(234, 'VANDEKERCHOVE', 'VALENTIN CLEMENT STANISLA', '2001-01-12', 'N', 1, NULL, 3),
(235, 'VANDEKERCKHOVE', 'NINON ZOE MARIE', '2001-12-30', 'N', 2, NULL, 1),
(236, 'VANDERSPEETEN', 'THIBAUD JEAN-PAUL', '2001-08-11', 'N', 1, 1, 2),
(237, 'VAZ VIEIRA', 'PAULINE', '2000-12-21', 'O', 2, NULL, 7),
(238, 'VERNOUX-YAHMI', 'ELISA SELIHA LEILA', '2001-08-20', 'N', 2, NULL, 8),
(239, 'VIGNJEVIC', 'MILA', '2001-04-21', 'N', 2, 1, 5),
(240, 'VILLIERS', 'CLEMENT LAURENT JEAN-CLAU', '2001-05-14', 'N', 1, 1, 3),
(241, 'VIROT', 'AUDRAN', '2001-07-29', 'N', 1, NULL, 6),
(242, 'WYCZSANY', 'ILANA FRANCOISE LUCIENNE', '2001-01-19', 'N', 2, NULL, 2);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `elevespassantep`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `elevespassantep`;
CREATE TABLE IF NOT EXISTS `elevespassantep` (
`idE` int(11)
,`nomE` varchar(50)
,`prenomE` varchar(50)
,`divisionE` varchar(100)
,`salleE` varchar(5)
,`disciplineE` varchar(50)
,`epreuveE` varchar(50)
,`jourE` date
,`plagHoraireE` varchar(5)
,`dureeEpreuveE` int(11)
,`tiersTempsE` char(1)
,`absenceE` char(1)
,`idP` int(11)
,`nomP` varchar(50)
,`prenomP` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idDiscipline` int(11) NOT NULL,
  `idNatureEpreuve` int(11) DEFAULT NULL,
  `dureeEpreuve` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Epreuve_Discipline0_FK` (`idDiscipline`),
  KEY `Epreuve_NatureEpreuve1_FK` (`idNatureEpreuve`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `epreuve`
--

INSERT INTO `epreuve` (`id`, `idDiscipline`, `idNatureEpreuve`, `dureeEpreuve`) VALUES
(1, 1, 1, 30),
(2, 1, 2, 30),
(3, 2, 1, 30),
(4, 2, 2, 30),
(5, 3, 1, 30),
(6, 3, 2, 30),
(7, 4, 1, 30),
(8, 4, 2, 30);

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `idEtablissement` int(11) NOT NULL AUTO_INCREMENT,
  `complementNom` varchar(100) NOT NULL,
  `nomEtablissement` varchar(50) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `tel` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `siteWeb` varchar(200) NOT NULL,
  PRIMARY KEY (`idEtablissement`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`idEtablissement`, `complementNom`, `nomEtablissement`, `adresse`, `cp`, `ville`, `tel`, `email`, `siteWeb`) VALUES
(1, 'Cité scolaire de Chantilly', 'Lycée Jean Rostand', 'Place Georges Paquier', '60634', ' Chantilly', '03.44.62.47.00', 'ce.0600009j@ac-amiens.fr', 'http://rostand.lyc.ac-amiens.fr');

-- --------------------------------------------------------

--
-- Structure de la table `natureepreuve`
--

DROP TABLE IF EXISTS `natureepreuve`;
CREATE TABLE IF NOT EXISTS `natureepreuve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `natureepreuve`
--

INSERT INTO `natureepreuve` (`id`, `libelle`) VALUES
(1, 'LV1'),
(2, 'LV2');

-- --------------------------------------------------------

--
-- Structure de la table `nomexam`
--

DROP TABLE IF EXISTS `nomexam`;
CREATE TABLE IF NOT EXISTS `nomexam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `nomexam`
--

INSERT INTO `nomexam` (`id`, `nom`) VALUES
(1, 'Oraux de langues');

-- --------------------------------------------------------

--
-- Structure de la table `optionmenu`
--

DROP TABLE IF EXISTS `optionmenu`;
CREATE TABLE IF NOT EXISTS `optionmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) NOT NULL,
  `nomScript` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `optionmenu`
--

INSERT INTO `optionmenu` (`id`, `libelle`, `nomScript`) VALUES
(1, 'choixEleve', 'choix_eleve.php');

-- --------------------------------------------------------

--
-- Structure de la table `optionmenuutilisateur`
--

DROP TABLE IF EXISTS `optionmenuutilisateur`;
CREATE TABLE IF NOT EXISTS `optionmenuutilisateur` (
  `idOption` int(11) NOT NULL,
  `idTypeUtil` int(11) NOT NULL,
  PRIMARY KEY (`idOption`,`idTypeUtil`),
  KEY `idOption` (`idOption`),
  KEY `idTypeUtil` (`idTypeUtil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `passageepreuve`
--

DROP TABLE IF EXISTS `passageepreuve`;
CREATE TABLE IF NOT EXISTS `passageepreuve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inscritBenef` char(1) NOT NULL,
  `derogation` char(1) NOT NULL,
  `absence` char(1) DEFAULT NULL,
  `idEleve` int(11) NOT NULL,
  `idDemiJournee` int(11) DEFAULT NULL,
  `idPlage` int(11) DEFAULT NULL,
  `idEpreuve` int(11) NOT NULL,
  `idProfChoix` int(11) DEFAULT NULL,
  `idSalle` int(11) DEFAULT NULL,
  `idProfAffecte` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PassageEpreuve_Epreuve2_FK` (`idEpreuve`),
  KEY `PassageEpreuve_Salle4_FK` (`idSalle`),
  KEY `PassageEpreuve_Professeur3_FK` (`idProfChoix`),
  KEY `PassageEpreuve_Professeur5_FK` (`idProfAffecte`),
  KEY `idEleve` (`idEleve`),
  KEY `idDemiJournee` (`idDemiJournee`,`idPlage`)
) ENGINE=InnoDB AUTO_INCREMENT=483 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `passageepreuve`
--

INSERT INTO `passageepreuve` (`id`, `inscritBenef`, `derogation`, `absence`, `idEleve`, `idDemiJournee`, `idPlage`, `idEpreuve`, `idProfChoix`, `idSalle`, `idProfAffecte`) VALUES
(1, 'N', 'N', NULL, 1, 5, 2, 1, 6, 9, 6),
(2, 'N', 'N', NULL, 1, 5, 4, 4, 14, 15, 14),
(3, 'N', 'N', NULL, 2, 6, 7, 1, 4, 2, 4),
(4, 'N', 'N', NULL, 2, 5, 2, 4, 14, 15, 14),
(5, 'N', 'N', NULL, 3, 1, 3, 1, 6, 9, 6),
(6, 'N', 'N', NULL, 3, 7, 4, 4, 14, 15, 14),
(7, 'N', 'N', NULL, 4, 1, 1, 1, 6, 9, 6),
(8, 'N', 'N', NULL, 4, 7, 2, 4, 14, 15, 14),
(9, 'N', 'N', NULL, 5, 1, 4, 1, 6, 9, 6),
(10, 'N', 'N', NULL, 5, 8, 5, 6, 16, 17, 16),
(11, 'N', 'N', NULL, 6, 1, 1, 3, 1, 1, 1),
(12, 'N', 'N', NULL, 6, 6, 8, 2, 4, 2, 4),
(13, 'N', 'N', 'O', 7, 2, 5, 1, 6, 9, 6),
(14, 'N', 'N', NULL, 7, 5, 1, 4, 14, 15, 14),
(15, 'N', 'N', NULL, 8, NULL, NULL, 1, NULL, NULL, NULL),
(16, 'N', 'N', NULL, 8, 5, 4, 4, 14, 15, 14),
(17, 'N', 'N', 'O', 9, 2, 6, 1, 6, 9, 6),
(18, 'N', 'N', NULL, 9, 6, 5, 8, 15, 16, 15),
(19, 'N', 'N', NULL, 10, 9, 3, 1, 5, 1, 5),
(20, 'N', 'N', NULL, 10, 5, 4, 6, 16, 17, 16),
(21, 'N', 'N', NULL, 11, 3, 1, 1, 5, 1, 5),
(22, 'N', 'N', NULL, 11, 7, 2, 4, 14, 15, 14),
(23, 'N', 'N', NULL, 12, 3, 4, 1, 5, 1, 5),
(24, 'N', 'N', NULL, 12, 4, 5, 4, 14, 15, 14),
(25, 'N', 'N', NULL, 13, 11, 1, 1, 10, 8, 10),
(26, 'N', 'N', NULL, 13, 7, 2, 4, 14, 15, 14),
(27, 'N', 'N', NULL, 14, 3, 1, 5, 16, 17, 16),
(28, 'N', 'N', NULL, 14, 10, 8, 2, 4, 2, 4),
(29, 'N', 'N', NULL, 15, 11, 2, 1, 10, 8, 10),
(30, 'N', 'N', NULL, 15, 12, 5, 4, 1, 1, 1),
(31, 'O', 'N', NULL, 16, NULL, NULL, 1, NULL, NULL, NULL),
(32, 'N', 'N', NULL, 16, 7, 4, 4, 14, 15, 14),
(33, 'N', 'N', NULL, 17, 11, 1, 1, 2, 1, 5),
(34, 'N', 'N', NULL, 17, 1, 3, 6, 16, 17, 16),
(35, 'N', 'N', NULL, 18, 2, 5, 1, 10, 8, 10),
(36, 'N', 'N', NULL, 18, 12, 7, 4, 1, 1, 1),
(37, 'N', 'N', NULL, 19, 10, 7, 2, 4, 2, 4),
(38, 'N', 'N', NULL, 20, 7, 2, 1, 3, 7, 3),
(39, 'N', 'N', NULL, 20, 7, 4, 6, 16, 17, 16),
(40, 'N', 'N', NULL, 21, 9, 1, 1, 5, 1, 5),
(41, 'N', 'N', NULL, 21, 7, 2, 6, 16, 17, 16),
(42, 'N', 'N', NULL, 22, 2, 5, 1, 10, 8, 10),
(43, 'N', 'N', NULL, 22, 4, 6, 4, 14, 15, 14),
(44, 'N', 'N', NULL, 23, 7, 1, 1, 3, 7, 3),
(45, 'N', 'N', NULL, 23, 5, 3, 6, 16, 17, 16),
(46, 'N', 'N', NULL, 24, 11, 4, 1, 5, 1, 5),
(47, 'N', 'N', NULL, 24, 7, 1, 4, 14, 15, 14),
(48, 'N', 'N', NULL, 25, 5, 4, 1, 4, 2, 4),
(49, 'N', 'N', NULL, 25, 1, 2, 4, 12, 12, 12),
(50, 'N', 'N', NULL, 26, 2, 6, 1, 10, 8, 10),
(51, 'N', 'N', NULL, 26, 1, 2, 6, 16, 17, 16),
(52, 'N', 'N', NULL, 27, 11, 2, 1, 10, 8, 10),
(53, 'N', 'N', NULL, 27, 5, 2, 4, 12, 12, 12),
(54, 'N', 'N', NULL, 28, 11, 1, 1, 10, 8, 10),
(55, 'N', 'N', NULL, 28, 5, 2, 4, 14, 15, 14),
(56, 'N', 'N', NULL, 29, 11, 4, 1, 10, 8, 10),
(57, 'N', 'N', NULL, 29, 4, 5, 4, 14, 15, 14),
(58, 'N', 'N', NULL, 30, 11, 1, 1, 5, 1, 5),
(59, 'N', 'N', NULL, 30, 3, 3, 6, 16, 17, 16),
(60, 'N', 'N', NULL, 31, NULL, NULL, 1, NULL, NULL, NULL),
(61, 'N', 'N', NULL, 31, 4, 6, 6, 16, 17, 16),
(62, 'N', 'N', NULL, 32, 11, 1, 1, 10, 8, 10),
(63, 'N', 'N', NULL, 32, 5, 3, 4, 14, 15, 14),
(64, 'N', 'N', NULL, 33, NULL, NULL, 1, NULL, NULL, NULL),
(65, 'N', 'N', NULL, 33, 7, 1, 6, 16, 17, 16),
(66, 'N', 'N', NULL, 34, 9, 2, 1, 5, 1, 5),
(67, 'N', 'N', NULL, 34, 3, 4, 6, 16, 17, 16),
(68, 'N', 'N', NULL, 35, 10, 6, 1, 2, 2, 4),
(69, 'N', 'N', NULL, 35, 5, 2, 4, 14, 15, 14),
(70, 'N', 'N', NULL, 36, 11, 3, 1, 10, 8, 10),
(71, 'N', 'N', NULL, 36, 7, 4, 4, 14, 15, 14),
(72, 'N', 'N', NULL, 37, 5, 1, 1, 4, 2, 4),
(73, 'N', 'N', NULL, 37, 7, 4, 4, 1, 1, 1),
(74, 'N', 'N', NULL, 38, 10, 5, 1, 4, 2, 4),
(75, 'N', 'N', NULL, 38, 6, 5, 6, 16, 17, 16),
(76, 'N', 'N', NULL, 39, 3, 2, 1, 5, 1, 5),
(77, 'N', 'N', NULL, 39, 7, 1, 4, 12, 12, 12),
(78, 'N', 'N', NULL, 40, 3, 1, 5, 16, 17, 16),
(79, 'N', 'N', NULL, 40, 6, 7, 2, 4, 2, 4),
(80, 'N', 'N', NULL, 41, 5, 3, 1, 4, 2, 4),
(81, 'N', 'N', NULL, 41, 1, 4, 6, 16, 17, 16),
(82, 'N', 'N', NULL, 42, 10, 6, 1, 4, 2, 4),
(83, 'N', 'N', NULL, 42, 7, 2, 4, 1, 1, 1),
(84, 'N', 'N', NULL, 43, 1, 1, 5, 17, 18, 17),
(85, 'N', 'N', NULL, 43, 6, 8, 2, 4, 2, 4),
(86, 'N', 'N', NULL, 44, 5, 1, 1, 4, 2, 4),
(87, 'N', 'N', NULL, 44, 1, 1, 4, 11, 8, 11),
(88, 'N', 'N', NULL, 45, 11, 4, 1, 10, 8, 10),
(89, 'N', 'N', NULL, 45, 5, 2, 4, 12, 12, 12),
(90, 'N', 'N', NULL, 46, 5, 2, 1, 4, 2, 4),
(91, 'N', 'N', NULL, 46, 2, 5, 4, 1, 1, 1),
(92, 'N', 'N', NULL, 47, 10, 5, 1, NULL, 8, 10),
(93, 'N', 'N', NULL, 47, 2, 8, 4, 1, 1, 1),
(94, 'N', 'N', NULL, 48, 5, 2, 1, 4, 2, 4),
(95, 'N', 'N', NULL, 48, 10, 5, 4, 1, 1, 1),
(96, 'N', 'N', NULL, 49, 4, 5, 1, 5, 1, 5),
(97, 'N', 'N', NULL, 49, 3, 1, 4, 13, 13, 13),
(98, 'N', 'N', NULL, 50, 5, 4, 1, 4, 2, 4),
(99, 'N', 'N', NULL, 50, 4, 6, 8, 15, 16, 15),
(100, 'N', 'N', NULL, 51, 10, 6, 1, 4, 2, 4),
(101, 'N', 'N', NULL, 51, 3, 2, 6, 16, 17, 16),
(102, 'N', 'N', NULL, 52, 11, 3, 1, 5, 1, 5),
(103, 'N', 'N', NULL, 52, 12, 6, 4, 1, 1, 1),
(104, 'N', 'N', NULL, 53, 11, 1, 1, 10, 8, 10),
(105, 'N', 'N', NULL, 53, 7, 2, 6, 16, 17, 16),
(106, 'N', 'N', NULL, 54, 11, 4, 1, 10, 8, 10),
(107, 'N', 'N', NULL, 55, 2, 6, 1, 9, 11, 9),
(108, 'N', 'N', NULL, 55, 7, 2, 4, 1, 1, 1),
(109, 'N', 'N', NULL, 56, 11, 2, 1, 10, 8, 10),
(110, 'N', 'N', NULL, 56, 1, 4, 4, 11, 8, 11),
(111, 'N', 'N', NULL, 57, 1, 1, 1, 9, 11, 9),
(112, 'N', 'N', NULL, 57, 5, 2, 6, 16, 17, 16),
(113, 'N', 'N', NULL, 58, 11, 4, 1, 10, 8, 10),
(114, 'N', 'N', NULL, 58, 7, 2, 4, 12, 12, 12),
(115, 'N', 'N', NULL, 59, 1, 2, 1, 9, 11, 9),
(116, 'N', 'N', NULL, 59, 7, 1, 4, 12, 12, 12),
(117, 'N', 'N', NULL, 60, 9, 4, 1, 5, 1, 5),
(118, 'N', 'N', NULL, 60, 3, 1, 4, 13, 13, 13),
(119, 'N', 'N', NULL, 61, 1, 1, 5, 16, 17, 16),
(120, 'N', 'N', NULL, 61, 6, 8, 2, 4, 2, 4),
(121, 'N', 'N', NULL, 62, 10, 6, 1, 4, 2, 4),
(122, 'N', 'N', NULL, 62, 7, 1, 4, 13, 13, 13),
(123, 'N', 'N', NULL, 63, 11, 2, 1, 5, 1, 5),
(124, 'N', 'N', NULL, 63, 1, 3, 4, 11, 8, 11),
(125, 'N', 'N', NULL, 64, 2, 7, 1, 6, 9, 6),
(126, 'N', 'N', NULL, 64, 7, 3, 4, 1, 1, 1),
(127, 'N', 'N', NULL, 65, 1, 3, 1, 6, 9, 6),
(128, 'N', 'N', NULL, 65, 12, 6, 4, 1, 1, 1),
(129, 'N', 'N', NULL, 66, NULL, NULL, 1, NULL, NULL, NULL),
(130, 'N', 'N', NULL, 66, 7, 4, 4, 1, 1, 1),
(131, 'N', 'N', NULL, 67, 5, 4, 1, 6, 9, 6),
(132, 'N', 'N', NULL, 67, 10, 7, 4, 1, 1, 1),
(133, 'N', 'N', NULL, 68, 5, 1, 1, 6, 9, 6),
(134, 'N', 'N', NULL, 68, 3, 2, 4, 13, 13, 13),
(135, 'N', 'N', NULL, 69, 6, 6, 1, 4, 2, 4),
(136, 'N', 'N', NULL, 69, 7, 1, 4, 1, 1, 1),
(137, 'N', 'N', NULL, 70, 11, 2, 1, 10, 8, 10),
(138, 'N', 'N', NULL, 70, 2, 6, 4, 1, 1, 1),
(139, 'N', 'N', NULL, 71, 2, 6, 1, 6, 9, 6),
(140, 'N', 'N', NULL, 71, 8, 5, 8, 15, 16, 15),
(141, 'N', 'N', NULL, 72, 7, 1, 1, 3, 7, 3),
(142, 'N', 'N', NULL, 72, 7, 2, 4, 13, 13, 13),
(143, 'N', 'N', NULL, 73, 7, 1, 1, 3, 7, 3),
(144, 'N', 'N', NULL, 73, 5, 2, 6, 16, 17, 16),
(145, 'N', 'N', NULL, 74, 9, 4, 1, 5, 1, 5),
(146, 'N', 'N', NULL, 74, 4, 5, 6, 16, 17, 16),
(147, 'N', 'N', NULL, 75, 1, 1, 1, 6, 9, 6),
(148, 'N', 'N', NULL, 75, 8, 5, 4, 1, 1, 1),
(149, 'N', 'N', NULL, 76, 6, 6, 1, 4, 2, 4),
(150, 'N', 'N', NULL, 76, 1, 1, 4, 12, 12, 12),
(151, 'N', 'N', NULL, 77, 1, 2, 1, 9, 11, 9),
(152, 'N', 'N', NULL, 77, 2, 6, 4, 1, 1, 1),
(153, 'N', 'N', NULL, 78, 10, 5, 1, 10, 8, 10),
(154, 'N', 'N', NULL, 78, 7, 2, 4, 1, 1, 1),
(155, 'N', 'N', NULL, 79, 5, 1, 1, 7, 1, 7),
(156, 'N', 'N', NULL, 79, 8, 6, 4, 1, 1, 1),
(157, 'N', 'N', NULL, 80, 2, 6, 1, 9, 11, 9),
(158, 'N', 'N', NULL, 80, 1, 4, 4, 1, 1, 1),
(159, 'N', 'N', NULL, 81, 1, 3, 1, 9, 11, 9),
(160, 'N', 'N', NULL, 81, 7, 4, 6, 16, 17, 16),
(161, 'N', 'N', NULL, 82, 1, 1, 1, 9, 11, 9),
(162, 'N', 'N', NULL, 82, 7, 1, 4, 12, 12, 12),
(163, 'N', 'N', NULL, 83, 5, 4, 1, 6, 9, 6),
(164, 'N', 'N', NULL, 83, 4, 6, 6, 16, 17, 16),
(165, 'N', 'N', NULL, 84, 5, 1, 1, 6, 9, 6),
(166, 'N', 'N', NULL, 84, 1, 2, 4, 12, 12, 12),
(167, 'N', 'N', NULL, 85, 2, 6, 1, 6, 9, 6),
(168, 'N', 'N', NULL, 85, 3, 1, 4, 13, 13, 13),
(169, 'N', 'N', NULL, 86, 5, 2, 1, 6, 9, 6),
(170, 'O', 'N', NULL, 86, NULL, NULL, 4, 1, NULL, NULL),
(171, 'N', 'N', NULL, 87, 1, 4, 1, 6, 9, 6),
(172, 'N', 'N', NULL, 87, 3, 3, 4, 13, 13, 13),
(173, 'N', 'N', NULL, 88, 1, 1, 5, 16, 17, 16),
(174, 'N', 'N', NULL, 88, 6, 7, 2, 5, 1, 5),
(175, 'N', 'N', NULL, 89, NULL, NULL, 1, NULL, NULL, NULL),
(176, 'N', 'N', NULL, 89, 3, 1, 4, 13, 13, 13),
(177, 'N', 'N', NULL, 90, 5, 4, 1, 4, 2, 4),
(178, 'N', 'N', NULL, 90, 1, 2, 4, 11, 8, 11),
(179, 'O', 'N', NULL, 91, NULL, NULL, 1, 9, NULL, NULL),
(180, 'O', 'N', NULL, 91, NULL, NULL, 4, 1, NULL, NULL),
(181, 'N', 'N', NULL, 92, 5, 1, 5, 16, 17, 16),
(182, 'N', 'N', NULL, 92, 4, 7, 2, 5, 1, 5),
(183, 'N', 'N', NULL, 93, 3, 3, 1, 5, 1, 5),
(184, 'N', 'N', NULL, 93, 8, 6, 4, 1, 1, 1),
(185, 'N', 'N', NULL, 94, 1, 1, 1, 8, 10, 8),
(186, 'N', 'N', NULL, 94, 1, 4, 4, 1, 1, 1),
(187, 'N', 'N', NULL, 95, 1, 2, 1, 7, 13, 7),
(188, 'N', 'N', NULL, 95, 7, 4, 6, 16, 17, 16),
(189, 'N', 'N', NULL, 96, 1, 1, 1, 9, 11, 9),
(190, 'N', 'N', NULL, 96, 2, 5, 4, 1, 1, 1),
(191, 'N', 'N', NULL, 97, 1, 4, 1, 9, 11, 9),
(192, 'N', 'N', NULL, 97, 2, 8, 4, 1, 1, 1),
(193, 'N', 'N', NULL, 98, 3, 1, 1, 8, 10, 8),
(194, 'N', 'N', NULL, 98, 7, 3, 6, 16, 17, 16),
(195, 'N', 'N', NULL, 99, 5, 3, 1, 7, 1, 7),
(196, 'N', 'N', NULL, 99, 1, 2, 4, 1, 1, 1),
(197, 'N', 'N', NULL, 100, 1, 2, 1, 8, 10, 8),
(198, 'N', 'N', NULL, 100, 8, 6, 4, 1, 1, 1),
(199, 'N', 'N', NULL, 101, 1, 4, 1, 7, 13, 7),
(200, 'N', 'N', NULL, 101, 1, 3, 4, 1, 1, 1),
(201, 'N', 'N', NULL, 102, 11, 3, 1, 10, 8, 10),
(202, 'N', 'N', NULL, 102, 5, 4, 6, 16, 17, 16),
(203, 'N', 'N', NULL, 103, 1, 1, 1, 8, 10, 8),
(204, 'N', 'N', NULL, 103, 7, 1, 4, 13, 13, 13),
(205, 'N', 'N', NULL, 104, 1, 2, 1, 7, 13, 7),
(206, 'N', 'N', NULL, 104, 8, 7, 4, 1, 1, 1),
(207, 'N', 'N', NULL, 105, 3, 2, 1, 5, 1, 5),
(208, 'N', 'N', NULL, 105, 1, 2, 4, 11, 8, 11),
(209, 'N', 'N', NULL, 106, 11, 4, 1, 5, 1, 5),
(210, 'N', 'N', NULL, 106, 7, 1, 4, 1, 1, 1),
(211, 'N', 'N', NULL, 107, 5, 1, 1, 8, 10, 8),
(212, 'N', 'N', NULL, 107, 3, 2, 4, 13, 13, 13),
(213, 'N', 'N', NULL, 108, 4, 6, 1, 5, 1, 5),
(214, 'N', 'N', NULL, 108, 1, 1, 4, 11, 8, 11),
(215, 'N', 'N', NULL, 109, 1, 2, 1, 7, 13, 7),
(216, 'N', 'N', NULL, 109, 10, 6, 4, 1, 1, 1),
(217, 'N', 'N', NULL, 110, 1, 1, 1, 7, 13, 7),
(218, 'N', 'N', NULL, 110, 1, 4, 4, 1, 1, 1),
(219, 'N', 'N', NULL, 111, 3, 4, 1, 5, 1, 5),
(220, 'N', 'N', NULL, 111, 7, 4, 6, 16, 17, 16),
(221, 'N', 'N', NULL, 112, 11, 1, 1, 5, 1, 5),
(222, 'N', 'N', NULL, 112, 2, 6, 8, 15, 16, 15),
(223, 'N', 'N', NULL, 113, 9, 4, 1, 5, 1, 5),
(224, 'N', 'N', NULL, 113, 2, 8, 4, 1, 1, 1),
(225, 'N', 'N', NULL, 114, 3, 1, 1, 8, 10, 8),
(226, 'N', 'N', NULL, 114, 12, 5, 4, 1, 1, 1),
(227, 'N', 'N', NULL, 115, 5, 2, 1, 8, 10, 8),
(228, 'N', 'N', NULL, 115, 1, 2, 4, 1, 1, 1),
(229, 'N', 'N', NULL, 116, 11, 2, 1, 5, 1, 5),
(230, 'N', 'N', NULL, 116, 1, 3, 4, 11, 8, 11),
(231, 'N', 'N', NULL, 117, 6, 6, 1, 5, 1, 5),
(232, 'N', 'N', NULL, 117, 5, 1, 4, 12, 12, 12),
(233, 'N', 'N', NULL, 118, 3, 1, 5, 16, 17, 16),
(234, 'N', 'N', NULL, 118, 4, 8, 2, 5, 1, 5),
(235, 'N', 'N', NULL, 119, NULL, NULL, 1, NULL, NULL, NULL),
(236, 'N', 'N', NULL, 119, 7, 4, 4, 1, 1, 1),
(237, 'N', 'N', NULL, 120, 5, 1, 3, 14, 15, 14),
(238, 'N', 'N', NULL, 120, 4, 8, 2, 5, 1, 5),
(239, 'N', 'N', NULL, 121, 1, 2, 1, 9, 11, 9),
(240, 'N', 'N', NULL, 121, 5, 3, 6, 16, 17, 16),
(241, 'N', 'N', NULL, 122, 11, 4, 1, 5, 1, 5),
(242, 'N', 'N', NULL, 122, 7, 1, 4, 1, 1, 1),
(243, 'N', 'N', NULL, 123, 5, 1, 1, 7, 1, 7),
(244, 'N', 'N', NULL, 123, 3, 4, 6, 16, 17, 16),
(245, 'N', 'N', NULL, 124, 1, 4, 1, 7, 13, 7),
(246, 'N', 'N', NULL, 124, 6, 5, 8, 15, 16, 15),
(247, 'N', 'N', NULL, 125, NULL, NULL, 1, NULL, NULL, NULL),
(248, 'N', 'N', NULL, 125, 5, 4, 6, 16, 17, 16),
(249, 'N', 'N', NULL, 126, 5, 1, 1, 4, 2, 4),
(250, 'N', 'N', NULL, 126, 1, 2, 4, 11, 8, 11),
(251, 'N', 'N', NULL, 127, 1, 3, 1, 9, 11, 9),
(252, 'N', 'N', NULL, 127, 2, 7, 4, 1, 1, 1),
(253, 'N', 'N', NULL, 128, 5, 2, 1, 4, 2, 4),
(254, 'N', 'N', NULL, 128, 7, 1, 4, 12, 12, 12),
(255, 'N', 'N', NULL, 129, 1, 2, 5, 17, 18, 17),
(256, 'N', 'N', NULL, 129, 4, 8, 2, 5, 1, 5),
(257, 'N', 'N', NULL, 130, 5, 1, 3, 14, 15, 14),
(258, 'N', 'N', NULL, 130, 7, 4, 2, 3, 7, 3),
(259, 'N', 'N', NULL, 131, 7, 3, 1, 3, 7, 3),
(260, 'O', 'N', NULL, 131, NULL, NULL, 4, 1, NULL, NULL),
(261, 'N', 'N', NULL, 132, 1, 1, 1, 9, 11, 9),
(262, 'N', 'N', NULL, 132, 5, 1, 4, 12, 12, 12),
(263, 'N', 'N', NULL, 133, 7, 2, 1, 3, 7, 3),
(264, 'N', 'N', NULL, 133, 1, 4, 4, 11, 8, 11),
(265, 'N', 'N', NULL, 134, 1, 1, 1, 7, 13, 7),
(266, 'N', 'N', NULL, 134, 7, 3, 6, 16, 17, 16),
(267, 'N', 'N', NULL, 135, 4, 5, 1, 5, 1, 5),
(268, 'N', 'N', NULL, 135, 7, 1, 6, 16, 17, 16),
(269, 'N', 'N', NULL, 136, 5, 1, 1, 8, 10, 8),
(270, 'N', 'N', NULL, 136, 3, 4, 6, 16, 17, 16),
(271, 'N', 'N', NULL, 137, 1, 4, 1, 7, 13, 7),
(272, 'N', 'N', NULL, 137, 1, 2, 6, 16, 17, 16),
(273, 'N', 'N', NULL, 138, 7, 1, 1, 3, 7, 3),
(274, 'N', 'N', NULL, 138, 10, 6, 4, 1, 1, 1),
(275, 'N', 'O', NULL, 139, NULL, NULL, 3, 1, NULL, NULL),
(276, 'N', 'O', NULL, 139, NULL, NULL, 2, 9, NULL, NULL),
(277, 'N', 'N', NULL, 140, 1, 1, 1, 8, 10, 8),
(278, 'N', 'N', NULL, 140, 5, 2, 6, 16, 17, 16),
(279, 'N', 'N', NULL, 141, 3, 4, 1, 5, 1, 5),
(280, 'N', 'N', NULL, 141, 1, 4, 4, 11, 8, 11),
(281, 'N', 'N', NULL, 142, 1, 1, 1, 7, 13, 7),
(282, 'N', 'N', NULL, 142, 3, 3, 6, 16, 17, 16),
(283, 'N', 'N', NULL, 143, 1, 4, 1, 9, 11, 9),
(284, 'N', 'N', NULL, 143, 1, 1, 4, 12, 12, 12),
(285, 'N', 'N', NULL, 144, 5, 1, 1, 8, 10, 8),
(286, 'N', 'N', NULL, 144, 1, 4, 6, 16, 17, 16),
(287, 'N', 'N', NULL, 145, 1, 4, 1, 7, 13, 7),
(288, 'N', 'N', NULL, 145, 1, 2, 4, 1, 1, 1),
(289, 'N', 'N', NULL, 146, 11, 2, 1, 5, 1, 5),
(290, 'N', 'N', NULL, 146, 1, 2, 4, 12, 12, 12),
(291, 'N', 'N', NULL, 147, 2, 5, 7, 15, 16, 15),
(292, 'N', 'N', NULL, 147, 5, 4, 2, 7, 1, 7),
(293, 'N', 'N', NULL, 148, 11, 3, 1, 5, 1, 5),
(294, 'N', 'N', NULL, 148, 7, 2, 4, 13, 13, 13),
(295, 'N', 'N', NULL, 149, 3, 1, 1, 8, 10, 8),
(296, 'N', 'N', NULL, 149, 7, 2, 6, 16, 17, 16),
(297, 'N', 'N', NULL, 150, 1, 4, 1, 6, 9, 6),
(298, 'N', 'N', NULL, 150, 8, 5, 6, 16, 17, 16),
(299, 'N', 'N', NULL, 151, 1, 1, 1, 7, 13, 7),
(300, 'N', 'N', NULL, 151, 10, 5, 4, 1, 1, 1),
(301, 'N', 'N', NULL, 152, 1, 3, 1, 7, 13, 7),
(302, 'N', 'N', NULL, 152, 4, 5, 8, 15, 16, 15),
(303, 'N', 'N', NULL, 153, 1, 1, 5, 17, 18, 17),
(304, 'N', 'N', NULL, 153, 3, 3, 2, 8, 10, 8),
(305, 'N', 'N', NULL, 154, 4, 6, 1, 5, 1, 5),
(306, 'N', 'N', NULL, 154, 8, 5, 8, 15, 16, 15),
(307, 'N', 'N', NULL, 155, 1, 2, 1, 7, 13, 7),
(308, 'N', 'N', NULL, 155, 10, 6, 4, 1, 1, 1),
(309, 'N', 'N', NULL, 156, 3, 1, 1, 5, 1, 5),
(310, 'N', 'N', NULL, 156, 1, 4, 4, 1, 1, 1),
(311, 'N', 'N', NULL, 157, 3, 2, 1, 8, 10, 8),
(312, 'N', 'N', NULL, 157, 8, 7, 4, 1, 1, 1),
(313, 'N', 'N', NULL, 158, 1, 1, 5, 17, 18, 17),
(314, 'N', 'N', NULL, 158, 7, 3, 2, 3, 7, 3),
(315, 'N', 'N', NULL, 159, 1, 4, 1, 9, 11, 9),
(316, 'N', 'N', NULL, 159, 1, 1, 4, 1, 1, 1),
(317, 'N', 'N', NULL, 160, 5, 1, 1, 8, 10, 8),
(318, 'N', 'N', NULL, 160, 2, 6, 4, 1, 1, 1),
(319, 'N', 'N', NULL, 161, 5, 2, 1, 8, 10, 8),
(320, 'N', 'N', NULL, 161, 1, 2, 4, 1, 1, 1),
(321, 'N', 'N', NULL, 162, 1, 2, 1, 8, 10, 8),
(322, 'N', 'N', NULL, 162, 5, 4, 6, 16, 17, 16),
(323, 'N', 'N', NULL, 163, 2, 6, 1, 9, 11, 9),
(324, 'N', 'N', NULL, 163, 7, 3, 4, 1, 1, 1),
(325, 'N', 'N', NULL, 164, 3, 4, 1, 5, 1, 5),
(326, 'N', 'N', NULL, 164, 12, 6, 4, 1, 1, 1),
(327, 'N', 'N', NULL, 165, 1, 1, 3, 12, 12, 12),
(328, 'N', 'N', NULL, 165, 2, 6, 2, 9, 11, 9),
(329, 'N', 'N', NULL, 166, 1, 4, 1, 6, 9, 6),
(330, 'N', 'N', NULL, 166, 10, 7, 4, 1, 1, 1),
(331, 'N', 'N', NULL, 167, 5, 1, 1, 7, 1, 7),
(332, 'N', 'N', NULL, 167, 2, 6, 8, 15, 16, 15),
(333, 'N', 'N', NULL, 168, NULL, NULL, 1, NULL, NULL, NULL),
(334, 'N', 'N', NULL, 168, 7, 1, 6, 16, 17, 16),
(335, 'N', 'N', NULL, 169, 9, 2, 1, 5, 1, 5),
(336, 'N', 'N', NULL, 169, 1, 2, 4, 12, 12, 12),
(337, 'N', 'N', NULL, 170, 4, 6, 1, 5, 1, 5),
(338, 'N', 'N', NULL, 170, 7, 2, 4, 1, 1, 1),
(339, 'N', 'N', NULL, 171, 9, 3, 1, 5, 1, 5),
(340, 'N', 'N', NULL, 171, 10, 6, 4, 1, 1, 1),
(341, 'N', 'N', NULL, 172, 3, 1, 1, 5, 1, 5),
(342, 'N', 'N', NULL, 172, 5, 2, 6, 16, 17, 16),
(343, 'N', 'N', NULL, 173, 1, 4, 1, 9, 11, 9),
(344, 'N', 'N', NULL, 173, 7, 2, 4, 12, 12, 12),
(345, 'N', 'N', NULL, 174, 11, 1, 1, 5, 1, 5),
(346, 'N', 'N', NULL, 174, 8, 5, 4, 1, 1, 1),
(347, 'N', 'N', NULL, 175, 3, 2, 1, 8, 10, 8),
(348, 'N', 'N', NULL, 175, 1, 1, 4, 1, 1, 1),
(349, 'O', 'N', NULL, 176, NULL, NULL, 1, 8, NULL, NULL),
(350, 'O', 'N', NULL, 176, NULL, NULL, 4, 13, NULL, NULL),
(351, 'N', 'N', NULL, 177, 3, 2, 1, 5, 1, 5),
(352, 'N', 'N', NULL, 177, 2, 6, 4, 1, 1, 1),
(353, 'N', 'N', NULL, 178, 2, 5, 1, 9, 11, 9),
(354, 'N', 'N', NULL, 178, 1, 2, 6, 16, 17, 16),
(355, 'N', 'N', NULL, 179, 1, 2, 1, 8, 10, 8),
(356, 'N', 'N', NULL, 179, 7, 2, 4, 13, 13, 13),
(357, 'N', 'N', NULL, 180, 1, 1, 3, 11, 8, 11),
(358, 'N', 'N', NULL, 180, 4, 7, 2, 5, 1, 5),
(359, 'N', 'N', NULL, 181, 1, 2, 1, 9, 11, 9),
(360, 'N', 'N', NULL, 181, 12, 6, 4, 1, 1, 1),
(361, 'N', 'N', NULL, 182, NULL, NULL, 1, NULL, NULL, NULL),
(362, 'N', 'N', NULL, 182, 7, 2, 6, 16, 17, 16),
(363, 'N', 'N', NULL, 183, 5, 2, 1, 7, 1, 7),
(364, 'N', 'N', NULL, 183, 12, 7, 4, 1, 1, 1),
(365, 'N', 'N', NULL, 184, 1, 1, 3, 11, 8, 11),
(366, 'N', 'N', NULL, 184, 6, 7, 2, 5, 1, 5),
(367, 'N', 'N', NULL, 185, 3, 2, 1, 8, 10, 8),
(368, 'N', 'N', NULL, 185, 7, 1, 6, 16, 17, 16),
(369, 'N', 'N', NULL, 186, 1, 2, 1, 6, 9, 6),
(370, 'N', 'N', NULL, 186, 3, 2, 4, 13, 13, 13),
(371, 'N', 'N', NULL, 187, 2, 7, 1, 6, 9, 6),
(372, 'N', 'N', NULL, 187, 7, 1, 4, 13, 13, 13),
(373, 'N', 'N', NULL, 188, 2, 5, 7, 15, 16, 15),
(374, 'N', 'N', NULL, 188, 4, 8, 2, 5, 1, 5),
(375, 'N', 'N', NULL, 189, 1, 1, 1, 8, 10, 8),
(376, 'N', 'N', NULL, 189, 7, 1, 4, 13, 13, 13),
(377, 'N', 'N', NULL, 190, 5, 3, 1, 6, 9, 6),
(378, 'N', 'N', NULL, 190, 4, 5, 6, 16, 17, 16),
(379, 'N', 'N', NULL, 191, 5, 1, 1, 6, 9, 6),
(380, 'N', 'N', NULL, 191, 2, 6, 8, 15, 16, 15),
(381, 'N', 'N', NULL, 192, 5, 2, 1, 7, 1, 7),
(382, 'N', 'N', NULL, 192, 1, 1, 4, 1, 1, 1),
(383, 'N', 'N', NULL, 193, 1, 2, 1, 6, 9, 6),
(384, 'N', 'N', NULL, 193, 1, 4, 6, 16, 17, 16),
(385, 'N', 'N', NULL, 194, 5, 2, 1, 8, 10, 8),
(386, 'N', 'N', NULL, 194, 1, 2, 6, 16, 17, 16),
(387, 'N', 'N', NULL, 195, 11, 2, 1, 5, 1, 5),
(388, 'N', 'N', NULL, 195, 8, 6, 4, 1, 1, 1),
(389, 'N', 'N', NULL, 196, 6, 6, 1, 5, 1, 5),
(390, 'N', 'N', NULL, 196, 3, 2, 6, 16, 17, 16),
(391, 'N', 'N', NULL, 197, 7, 2, 1, 3, 7, 3),
(392, 'N', 'N', NULL, 197, 2, 7, 4, 1, 1, 1),
(393, 'N', 'N', NULL, 198, 9, 1, 1, 5, 1, 5),
(394, 'N', 'N', NULL, 198, 1, 3, 6, 16, 17, 16),
(395, 'N', 'N', NULL, 199, 5, 2, 1, 7, 1, 7),
(396, 'N', 'N', NULL, 199, 4, 6, 6, 16, 17, 16),
(397, 'N', 'N', NULL, 200, 5, 1, 1, 6, 9, 6),
(398, 'N', 'N', NULL, 200, 3, 2, 4, 13, 13, 13),
(399, 'N', 'N', NULL, 201, 5, 1, 5, 16, 17, 16),
(400, 'N', 'N', NULL, 201, 1, 3, 2, 8, 10, 8),
(401, 'N', 'N', NULL, 202, 9, 2, 1, 5, 1, 5),
(402, 'N', 'N', NULL, 202, 7, 2, 4, 13, 13, 13),
(403, 'N', 'N', NULL, 203, NULL, NULL, 1, NULL, NULL, NULL),
(404, 'N', 'N', NULL, 203, 1, 3, 4, 1, 1, 1),
(405, 'N', 'N', NULL, 204, 7, 2, 1, 3, 7, 3),
(406, 'N', 'N', NULL, 204, 1, 4, 4, 11, 8, 11),
(407, 'N', 'N', NULL, 205, 3, 1, 1, 5, 1, 5),
(408, 'N', 'N', NULL, 205, 5, 1, 4, 12, 12, 12),
(409, 'N', 'N', NULL, 206, 9, 4, 1, 5, 1, 5),
(410, 'N', 'N', NULL, 206, 6, 5, 6, 16, 17, 16),
(411, 'N', 'N', NULL, 207, 1, 1, 5, 17, 18, 17),
(412, 'N', 'N', NULL, 207, 1, 3, 2, 8, 10, 8),
(413, 'N', 'N', NULL, 208, 11, 4, 1, 5, 1, 5),
(414, 'N', 'N', NULL, 208, 7, 1, 4, 1, 1, 1),
(415, 'N', 'N', NULL, 209, 9, 2, 1, 5, 1, 5),
(416, 'N', 'N', NULL, 209, 7, 3, 4, 14, 15, 14),
(417, 'N', 'N', NULL, 210, 6, 5, 1, 5, 1, 5),
(418, 'N', 'N', NULL, 210, 7, 1, 4, 14, 15, 14),
(419, 'N', 'N', NULL, 211, 3, 3, 1, 5, 1, 5),
(420, 'N', 'N', NULL, 211, 5, 2, 4, 12, 12, 12),
(421, 'N', 'N', NULL, 212, 6, 6, 1, 5, 1, 5),
(422, 'N', 'N', NULL, 212, 3, 2, 6, 16, 17, 16),
(423, 'N', 'N', NULL, 213, 1, 1, 3, 12, 12, 12),
(424, 'N', 'N', NULL, 213, 10, 8, 2, 4, 2, 4),
(425, 'N', 'N', NULL, 214, 9, 1, 1, 5, 1, 5),
(426, 'N', 'N', NULL, 214, 1, 2, 4, 11, 8, 11),
(427, 'N', 'N', NULL, 215, 10, 5, 1, 4, 2, 4),
(428, 'N', 'N', NULL, 215, 4, 6, 8, 15, 16, 15),
(429, 'N', 'N', NULL, 216, 5, 1, 1, 7, 1, 7),
(430, 'N', 'N', NULL, 216, 4, 6, 8, 15, 16, 15),
(431, 'N', 'N', NULL, 217, 5, 3, 1, 7, 1, 7),
(432, 'N', 'N', NULL, 217, 4, 5, 8, 15, 16, 15),
(433, 'N', 'N', NULL, 218, 3, 1, 5, 16, 17, 16),
(434, 'N', 'N', NULL, 218, 2, 8, 2, 6, 9, 6),
(435, 'N', 'N', NULL, 219, 6, 6, 1, 5, 1, 5),
(436, 'N', 'N', NULL, 219, 5, 2, 4, 14, 15, 14),
(437, 'N', 'N', NULL, 220, 5, 2, 1, 6, 9, 6),
(438, 'N', 'N', NULL, 220, 5, 4, 4, 14, 15, 14),
(439, 'N', 'N', NULL, 221, 9, 1, 1, 5, 1, 5),
(440, 'N', 'N', NULL, 221, 7, 4, 4, 1, 1, 1),
(441, 'N', 'N', NULL, 222, 5, 3, 1, 6, 9, 6),
(442, 'N', 'N', NULL, 222, 4, 6, 4, 14, 15, 14),
(443, 'N', 'N', NULL, 223, 1, 1, 5, 16, 17, 16),
(444, 'N', 'N', NULL, 223, 6, 8, 2, 4, 2, 4),
(445, 'N', 'N', NULL, 224, 3, 2, 1, 8, 10, 8),
(446, 'N', 'N', NULL, 224, 5, 1, 4, 14, 15, 14),
(447, 'N', 'N', NULL, 225, 1, 2, 1, 6, 9, 6),
(448, 'N', 'N', NULL, 225, 7, 3, 4, 14, 15, 14),
(449, 'N', 'N', NULL, 226, 6, 5, 1, 5, 1, 5),
(450, 'N', 'N', NULL, 226, 7, 1, 4, 14, 15, 14),
(451, 'N', 'N', NULL, 227, NULL, NULL, 1, NULL, NULL, NULL),
(452, 'N', 'N', NULL, 227, 5, 4, 4, 14, 15, 14),
(453, 'N', 'N', NULL, 228, 5, 2, 1, 8, 10, 8),
(454, 'N', 'N', NULL, 228, 3, 2, 6, 16, 17, 16),
(455, 'N', 'N', NULL, 229, 6, 5, 1, 4, 2, 4),
(456, 'N', 'N', NULL, 229, 7, 4, 4, 14, 15, 14),
(457, 'N', 'N', NULL, 230, 5, 2, 1, 4, 2, 4),
(458, 'N', 'N', NULL, 230, 2, 6, 8, 15, 16, 15),
(459, 'N', 'N', NULL, 231, 5, 4, 1, 6, 9, 6),
(460, 'N', 'N', NULL, 231, 4, 6, 4, 14, 15, 14),
(461, 'N', 'N', NULL, 232, 3, 2, 1, 5, 1, 5),
(462, 'N', 'N', NULL, 232, 5, 3, 4, 14, 15, 14),
(463, 'N', 'N', NULL, 233, 1, 3, 1, 7, 13, 7),
(464, 'N', 'N', NULL, 233, 5, 1, 6, 16, 17, 16),
(465, 'N', 'N', NULL, 234, 1, 2, 1, 6, 9, 6),
(466, 'N', 'N', NULL, 234, 3, 4, 6, 16, 17, 16),
(467, 'N', 'N', NULL, 235, 2, 6, 1, 6, 9, 6),
(468, 'N', 'N', NULL, 235, 7, 1, 4, 14, 15, 14),
(469, 'N', 'N', NULL, 236, 6, 5, 1, 4, 2, 4),
(470, 'N', 'N', NULL, 236, 5, 2, 4, 12, 12, 12),
(471, 'N', 'N', NULL, 237, 5, 1, 1, 4, 2, 4),
(472, 'N', 'N', NULL, 237, 7, 2, 4, 14, 15, 14),
(473, 'N', 'N', NULL, 238, 1, 2, 1, 8, 10, 8),
(474, 'N', 'N', NULL, 238, 7, 2, 4, 12, 12, 12),
(475, 'N', 'N', NULL, 239, 1, 1, 5, 16, 17, 16),
(476, 'N', 'N', NULL, 239, 10, 7, 2, 4, 2, 4),
(477, 'N', 'N', NULL, 240, 5, 2, 1, 7, 1, 7),
(478, 'N', 'N', NULL, 240, 5, 1, 6, 16, 17, 16),
(479, 'N', 'N', NULL, 241, 5, 3, 1, 4, 2, 4),
(480, 'N', 'N', NULL, 241, 1, 4, 6, 16, 17, 16),
(481, 'N', 'N', NULL, 242, 2, 5, 1, 9, 11, 9),
(482, 'N', 'N', NULL, 242, 5, 1, 4, 12, 12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `plage`
--

DROP TABLE IF EXISTS `plage`;
CREATE TABLE IF NOT EXISTS `plage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heureDebut` varchar(5) NOT NULL,
  `heureFin` varchar(5) NOT NULL,
  `nbMaxEleve` int(11) NOT NULL,
  `matinAprem` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `plage`
--

INSERT INTO `plage` (`id`, `heureDebut`, `heureFin`, `nbMaxEleve`, `matinAprem`) VALUES
(1, '8:00', '9:00', 4, 'matin'),
(2, '9:00', '10:00', 4, 'matin'),
(3, '10:30', '11:00', 2, 'matin'),
(4, '11:00', '12:00', 4, 'matin'),
(5, '13:30', '14:00', 2, 'après-midi'),
(6, '14:00', '15:00', 4, 'après-midi'),
(7, '15:30', '16:00', 2, 'après-midi'),
(8, '16:00', '17:00', 4, 'après-midi');

-- --------------------------------------------------------

--
-- Structure de la table `plagedemijournee`
--

DROP TABLE IF EXISTS `plagedemijournee`;
CREATE TABLE IF NOT EXISTS `plagedemijournee` (
  `idDemiJournee` int(11) NOT NULL,
  `idPlage` int(11) NOT NULL,
  PRIMARY KEY (`idDemiJournee`,`idPlage`),
  KEY `PlageDemiJournee_DemiJournee0_FK` (`idDemiJournee`),
  KEY `PlageDemiJournee_Plage1_FK` (`idPlage`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `plagedemijournee`
--

INSERT INTO `plagedemijournee` (`idDemiJournee`, `idPlage`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(10, 5),
(10, 6),
(10, 7),
(10, 8),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 5),
(12, 6),
(12, 7),
(12, 8);

-- --------------------------------------------------------

--
-- Structure de la table `profenseigdivision`
--

DROP TABLE IF EXISTS `profenseigdivision`;
CREATE TABLE IF NOT EXISTS `profenseigdivision` (
  `idUtilisateur` int(11) NOT NULL,
  `idDivision` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idDivision`),
  KEY `enseigner_a_Division1_FK` (`idDivision`),
  KEY `idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `libelle`) VALUES
(1, '120'),
(2, '121'),
(7, '119'),
(8, '125'),
(9, '126'),
(10, '127'),
(11, '128'),
(12, '106'),
(13, '103'),
(14, '107'),
(15, '105'),
(16, '108'),
(17, '109'),
(18, '104'),
(19, '124'),
(20, '126');

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id`, `libelle`) VALUES
(1, 'Européenne'),
(2, 'Internationale');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `selectioneleve`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `selectioneleve`;
CREATE TABLE IF NOT EXISTS `selectioneleve` (
`nom` varchar(50)
,`prenom` varchar(50)
,`division` varchar(100)
,`natureepreuve` varchar(50)
,`professeur` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la table `tabletempo`
--

DROP TABLE IF EXISTS `tabletempo`;
CREATE TABLE IF NOT EXISTS `tabletempo` (
  `idUtilisateur` int(11) NOT NULL,
  `idDemiJournee` int(11) NOT NULL,
  `idSalle` int(11) NOT NULL,
  `idPlage` int(11) NOT NULL,
  `date` date NOT NULL,
  `nbMaxEleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tabletempo`
--

INSERT INTO `tabletempo` (`idUtilisateur`, `idDemiJournee`, `idSalle`, `idPlage`, `date`, `nbMaxEleve`) VALUES
(1, 1, 1, 1, '2019-11-14', 0),
(6, 1, 9, 1, '2019-11-14', 0),
(7, 1, 13, 1, '2019-11-14', 0),
(8, 1, 10, 1, '2019-11-14', 0),
(9, 1, 11, 1, '2019-11-14', 0),
(11, 1, 8, 1, '2019-11-14', 0),
(12, 1, 12, 1, '2019-11-14', 0),
(16, 1, 17, 1, '2019-11-14', 0),
(17, 1, 18, 1, '2019-11-14', 0),
(5, 3, 1, 1, '2019-11-15', 0),
(8, 3, 10, 1, '2019-11-15', 0),
(13, 3, 13, 1, '2019-11-15', 0),
(16, 3, 17, 1, '2019-11-15', 0),
(4, 5, 2, 1, '2019-11-18', 0),
(6, 5, 9, 1, '2019-11-18', 0),
(7, 5, 1, 1, '2019-11-18', 0),
(8, 5, 10, 1, '2019-11-18', 0),
(12, 5, 12, 1, '2019-11-18', 0),
(14, 5, 15, 1, '2019-11-18', 0),
(16, 5, 17, 1, '2019-11-18', 0),
(1, 7, 1, 1, '2019-11-19', 0),
(2, 7, 10, 1, '2019-11-19', 3),
(3, 7, 7, 1, '2019-11-19', 0),
(12, 7, 12, 1, '2019-11-19', 0),
(13, 7, 13, 1, '2019-11-19', 0),
(14, 7, 15, 1, '2019-11-19', 0),
(16, 7, 17, 1, '2019-11-19', 0),
(2, 9, 10, 1, '2019-11-20', 4),
(5, 9, 1, 1, '2019-11-20', 0),
(2, 11, 10, 1, '2019-11-21', 4),
(5, 11, 1, 1, '2019-11-21', 0),
(10, 11, 8, 1, '2019-11-21', 0),
(1, 1, 1, 2, '2019-11-14', 0),
(6, 1, 9, 2, '2019-11-14', 0),
(7, 1, 13, 2, '2019-11-14', 0),
(8, 1, 10, 2, '2019-11-14', 0),
(9, 1, 11, 2, '2019-11-14', 0),
(11, 1, 8, 2, '2019-11-14', 0),
(12, 1, 12, 2, '2019-11-14', 0),
(16, 1, 17, 2, '2019-11-14', 0),
(17, 1, 18, 2, '2019-11-14', 3),
(5, 3, 1, 2, '2019-11-15', 0),
(8, 3, 10, 2, '2019-11-15', 0),
(13, 3, 13, 2, '2019-11-15', 0),
(16, 3, 17, 2, '2019-11-15', 0),
(4, 5, 2, 2, '2019-11-18', 0),
(6, 5, 9, 2, '2019-11-18', 0),
(7, 5, 1, 2, '2019-11-18', 0),
(8, 5, 10, 2, '2019-11-18', 0),
(12, 5, 12, 2, '2019-11-18', 0),
(14, 5, 15, 2, '2019-11-18', 0),
(16, 5, 17, 2, '2019-11-18', 0),
(1, 7, 1, 2, '2019-11-19', 0),
(2, 7, 10, 2, '2019-11-19', 4),
(3, 7, 7, 2, '2019-11-19', 0),
(12, 7, 12, 2, '2019-11-19', 1),
(13, 7, 13, 2, '2019-11-19', 0),
(14, 7, 15, 2, '2019-11-19', 0),
(16, 7, 17, 2, '2019-11-19', 0),
(2, 9, 10, 2, '2019-11-20', 4),
(5, 9, 1, 2, '2019-11-20', 0),
(2, 11, 10, 2, '2019-11-21', 4),
(5, 11, 1, 2, '2019-11-21', 0),
(10, 11, 8, 2, '2019-11-21', 0),
(1, 1, 1, 3, '2019-11-14', 0),
(6, 1, 9, 3, '2019-11-14', 0),
(7, 1, 13, 3, '2019-11-14', 0),
(8, 1, 10, 3, '2019-11-14', 0),
(9, 1, 11, 3, '2019-11-14', 0),
(11, 1, 8, 3, '2019-11-14', 0),
(12, 1, 12, 3, '2019-11-14', 2),
(16, 1, 17, 3, '2019-11-14', 0),
(17, 1, 18, 3, '2019-11-14', 2),
(5, 3, 1, 3, '2019-11-15', 0),
(8, 3, 10, 3, '2019-11-15', 1),
(13, 3, 13, 3, '2019-11-15', 1),
(16, 3, 17, 3, '2019-11-15', 0),
(4, 5, 2, 3, '2019-11-18', 0),
(6, 5, 9, 3, '2019-11-18', 0),
(7, 5, 1, 3, '2019-11-18', 0),
(8, 5, 10, 3, '2019-11-18', 2),
(12, 5, 12, 3, '2019-11-18', 2),
(14, 5, 15, 3, '2019-11-18', 0),
(16, 5, 17, 3, '2019-11-18', 0),
(1, 7, 1, 3, '2019-11-19', 0),
(2, 7, 10, 3, '2019-11-19', 2),
(3, 7, 7, 3, '2019-11-19', 0),
(12, 7, 12, 3, '2019-11-19', 2),
(13, 7, 13, 3, '2019-11-19', 2),
(14, 7, 15, 3, '2019-11-19', 0),
(16, 7, 17, 3, '2019-11-19', 0),
(2, 9, 10, 3, '2019-11-20', 2),
(5, 9, 1, 3, '2019-11-20', 0),
(2, 11, 10, 3, '2019-11-21', 2),
(5, 11, 1, 3, '2019-11-21', 0),
(10, 11, 8, 3, '2019-11-21', 0),
(1, 1, 1, 4, '2019-11-14', 0),
(6, 1, 9, 4, '2019-11-14', 0),
(7, 1, 13, 4, '2019-11-14', 0),
(8, 1, 10, 4, '2019-11-14', 4),
(9, 1, 11, 4, '2019-11-14', 0),
(11, 1, 8, 4, '2019-11-14', 0),
(12, 1, 12, 4, '2019-11-14', 4),
(16, 1, 17, 4, '2019-11-14', 0),
(17, 1, 18, 4, '2019-11-14', 4),
(5, 3, 1, 4, '2019-11-15', 0),
(8, 3, 10, 4, '2019-11-15', 4),
(13, 3, 13, 4, '2019-11-15', 4),
(16, 3, 17, 4, '2019-11-15', 0),
(4, 5, 2, 4, '2019-11-18', 0),
(6, 5, 9, 4, '2019-11-18', 0),
(7, 5, 1, 4, '2019-11-18', 3),
(8, 5, 10, 4, '2019-11-18', 4),
(12, 5, 12, 4, '2019-11-18', 4),
(14, 5, 15, 4, '2019-11-18', 0),
(16, 5, 17, 4, '2019-11-18', 0),
(1, 7, 1, 4, '2019-11-19', 0),
(2, 7, 10, 4, '2019-11-19', 4),
(3, 7, 7, 4, '2019-11-19', 3),
(12, 7, 12, 4, '2019-11-19', 4),
(13, 7, 13, 4, '2019-11-19', 4),
(14, 7, 15, 4, '2019-11-19', 0),
(16, 7, 17, 4, '2019-11-19', 0),
(2, 9, 10, 4, '2019-11-20', 4),
(5, 9, 1, 4, '2019-11-20', 0),
(2, 11, 10, 4, '2019-11-21', 4),
(5, 11, 1, 4, '2019-11-21', 0),
(10, 11, 8, 4, '2019-11-21', 0),
(1, 2, 1, 5, '2019-11-14', 0),
(2, 2, 10, 5, '2019-11-14', 2),
(3, 2, 7, 5, '2019-11-14', 2),
(6, 2, 9, 5, '2019-11-14', 0),
(9, 2, 11, 5, '2019-11-14', 0),
(10, 2, 8, 5, '2019-11-14', 0),
(15, 2, 16, 5, '2019-11-14', 0),
(2, 4, 10, 5, '2019-11-15', 2),
(5, 4, 1, 5, '2019-11-15', 0),
(7, 4, 8, 5, '2019-11-15', 2),
(14, 4, 15, 5, '2019-11-15', 0),
(15, 4, 16, 5, '2019-11-15', 0),
(16, 4, 17, 5, '2019-11-15', 0),
(4, 6, 2, 5, '2019-11-18', 0),
(5, 6, 1, 5, '2019-11-18', 0),
(8, 6, 10, 5, '2019-11-18', 2),
(13, 6, 13, 5, '2019-11-18', 2),
(15, 6, 16, 5, '2019-11-18', 0),
(16, 6, 17, 5, '2019-11-18', 0),
(17, 6, 18, 5, '2019-11-18', 2),
(1, 8, 1, 5, '2019-11-19', 0),
(2, 8, 10, 5, '2019-11-19', 2),
(3, 8, 7, 5, '2019-11-19', 2),
(15, 8, 16, 5, '2019-11-19', 0),
(16, 8, 17, 5, '2019-11-19', 0),
(1, 10, 1, 5, '2019-11-20', 0),
(2, 10, 10, 5, '2019-11-20', 2),
(4, 10, 2, 5, '2019-11-20', 0),
(10, 10, 8, 5, '2019-11-20', 0),
(17, 10, 18, 5, '2019-11-20', 2),
(1, 12, 1, 5, '2019-11-21', 0),
(1, 2, 1, 6, '2019-11-14', 0),
(2, 2, 10, 6, '2019-11-14', 4),
(3, 2, 7, 6, '2019-11-14', 4),
(6, 2, 9, 6, '2019-11-14', 0),
(9, 2, 11, 6, '2019-11-14', 0),
(10, 2, 8, 6, '2019-11-14', 3),
(15, 2, 16, 6, '2019-11-14', 0),
(2, 4, 10, 6, '2019-11-15', 4),
(5, 4, 1, 6, '2019-11-15', 0),
(7, 4, 8, 6, '2019-11-15', 4),
(14, 4, 15, 6, '2019-11-15', 1),
(15, 4, 16, 6, '2019-11-15', 1),
(16, 4, 17, 6, '2019-11-15', 1),
(4, 6, 2, 6, '2019-11-18', 0),
(5, 6, 1, 6, '2019-11-18', 0),
(8, 6, 10, 6, '2019-11-18', 4),
(13, 6, 13, 6, '2019-11-18', 4),
(15, 6, 16, 6, '2019-11-18', 4),
(16, 6, 17, 6, '2019-11-18', 4),
(17, 6, 18, 6, '2019-11-18', 4),
(1, 8, 1, 6, '2019-11-19', 0),
(2, 8, 10, 6, '2019-11-19', 4),
(3, 8, 7, 6, '2019-11-19', 4),
(15, 8, 16, 6, '2019-11-19', 4),
(16, 8, 17, 6, '2019-11-19', 4),
(1, 10, 1, 6, '2019-11-20', 0),
(2, 10, 10, 6, '2019-11-20', 4),
(4, 10, 2, 6, '2019-11-20', 0),
(10, 10, 8, 6, '2019-11-20', 4),
(17, 10, 18, 6, '2019-11-20', 4),
(1, 12, 1, 6, '2019-11-21', 0),
(1, 2, 1, 7, '2019-11-14', 0),
(2, 2, 10, 7, '2019-11-14', 2),
(3, 2, 7, 7, '2019-11-14', 2),
(6, 2, 9, 7, '2019-11-14', 0),
(9, 2, 11, 7, '2019-11-14', 2),
(10, 2, 8, 7, '2019-11-14', 2),
(15, 2, 16, 7, '2019-11-14', 2),
(2, 4, 10, 7, '2019-11-15', 2),
(5, 4, 1, 7, '2019-11-15', 0),
(7, 4, 8, 7, '2019-11-15', 2),
(14, 4, 15, 7, '2019-11-15', 2),
(15, 4, 16, 7, '2019-11-15', 2),
(16, 4, 17, 7, '2019-11-15', 2),
(4, 6, 2, 7, '2019-11-18', 0),
(5, 6, 1, 7, '2019-11-18', 0),
(8, 6, 10, 7, '2019-11-18', 2),
(13, 6, 13, 7, '2019-11-18', 2),
(15, 6, 16, 7, '2019-11-18', 2),
(16, 6, 17, 7, '2019-11-18', 2),
(17, 6, 18, 7, '2019-11-18', 2),
(1, 8, 1, 7, '2019-11-19', 0),
(2, 8, 10, 7, '2019-11-19', 2),
(3, 8, 7, 7, '2019-11-19', 2),
(15, 8, 16, 7, '2019-11-19', 2),
(16, 8, 17, 7, '2019-11-19', 2),
(1, 10, 1, 7, '2019-11-20', 0),
(2, 10, 10, 7, '2019-11-20', 2),
(4, 10, 2, 7, '2019-11-20', 0),
(10, 10, 8, 7, '2019-11-20', 2),
(17, 10, 18, 7, '2019-11-20', 2),
(1, 12, 1, 7, '2019-11-21', 0),
(1, 2, 1, 8, '2019-11-14', 1),
(2, 2, 10, 8, '2019-11-14', 4),
(3, 2, 7, 8, '2019-11-14', 4),
(6, 2, 9, 8, '2019-11-14', 3),
(9, 2, 11, 8, '2019-11-14', 4),
(10, 2, 8, 8, '2019-11-14', 4),
(15, 2, 16, 8, '2019-11-14', 4),
(2, 4, 10, 8, '2019-11-15', 4),
(5, 4, 1, 8, '2019-11-15', 0),
(7, 4, 8, 8, '2019-11-15', 4),
(14, 4, 15, 8, '2019-11-15', 4),
(15, 4, 16, 8, '2019-11-15', 4),
(16, 4, 17, 8, '2019-11-15', 4),
(4, 6, 2, 8, '2019-11-18', 0),
(5, 6, 1, 8, '2019-11-18', 4),
(8, 6, 10, 8, '2019-11-18', 4),
(13, 6, 13, 8, '2019-11-18', 4),
(15, 6, 16, 8, '2019-11-18', 4),
(16, 6, 17, 8, '2019-11-18', 4),
(17, 6, 18, 8, '2019-11-18', 4),
(1, 8, 1, 8, '2019-11-19', 4),
(2, 8, 10, 8, '2019-11-19', 4),
(3, 8, 7, 8, '2019-11-19', 4),
(15, 8, 16, 8, '2019-11-19', 4),
(16, 8, 17, 8, '2019-11-19', 4),
(1, 10, 1, 8, '2019-11-20', 4),
(2, 10, 10, 8, '2019-11-20', 4),
(4, 10, 2, 8, '2019-11-20', 2),
(10, 10, 8, 8, '2019-11-20', 4),
(17, 10, 18, 8, '2019-11-20', 4),
(1, 12, 1, 8, '2019-11-21', 4);

-- --------------------------------------------------------

--
-- Structure de la table `traitement`
--

DROP TABLE IF EXISTS `traitement`;
CREATE TABLE IF NOT EXISTS `traitement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `valeur` varchar(50) NOT NULL,
  `dateMaj` date NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Traitement_Administrateur0_FK` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typeutilisateur`
--

DROP TABLE IF EXISTS `typeutilisateur`;
CREATE TABLE IF NOT EXISTS `typeutilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typeutilisateur`
--

INSERT INTO `typeutilisateur` (`id`, `libelle`) VALUES
(1, 'Admin'),
(2, 'Prof'),
(3, 'Scolarite');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(30) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `idTypeUtilisateur` int(11) NOT NULL,
  `idSalleAtt` int(11) DEFAULT NULL,
  `idDiscipline` int(11) DEFAULT NULL,
  `idCivilite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idTypeUtilisateur` (`idTypeUtilisateur`),
  KEY `idSalleAtt` (`idSalleAtt`),
  KEY `FK_idDiscipline` (`idDiscipline`),
  KEY `FK_idcivilite` (`idCivilite`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `motDePasse`, `mail`, `nom`, `prenom`, `idTypeUtilisateur`, `idSalleAtt`, `idDiscipline`, `idCivilite`) VALUES
(1, 'dolores.hurtado', 'edfe4707763b80c7defe9ead7ab32d75c010474a', 'd.hurtado@gmail.com', 'Hurtado', 'Dolores', 2, 1, 2, 2),
(2, 'caroline.blatge', '287f43aa89e14005a7255be8fc246ad537087090', 'c.blatge@gmail.com', 'Blatge', 'Caroline', 2, 10, 1, 2),
(3, 'benjamin.bue', 'fc2e9fafb2d7a7978802c6a57c0669aee2f65024', 'b.bue@gmail.com', 'Bue', 'Benjamin', 2, 7, 1, 1),
(4, 'laetitia.candes', 'e70c31188c28b4c80e15e5eda52c00899f65e33e', 'l.candes@gmail.com', 'Candes', 'Laetitia', 2, 2, 1, 2),
(5, 'amar.el farissi', '4c83b77b3ab5fd8aba4e9585deb11b75ffc6c2c1', 'a.farissi@gmail.com', 'El Farissi', 'Amar', 2, 1, 1, 1),
(6, 'valerie.genty', '0b4709419aedf27e508f4ed2f1db91dc992c9e07', 'v.genty@gmail.com', 'Genty', 'Valerie', 2, 9, 1, 2),
(7, 'murielle.galby', '44b370692704bae63c70f63e3312f5f27c630fb2', 'm.galby@gmail.com', 'Galby', 'Murielle', 2, NULL, 1, 2),
(8, 'manon.lambert', '3dd5b809272e5bd20eb3bd3295847f720c0cb3ae', 'm.lambert@gmail.com', 'Lambert', 'Manon', 2, NULL, 1, 2),
(9, 'florence.sultana', '66e687bf0c705a66f4903883b15a7c051be7a16b', 'f.sultana@gmail.com', 'Sultana', 'Florence', 2, 11, 1, 2),
(10, 'dominique.trimouille', '8623809c29cc585eb39dfe4fd6dbb961237c9776', 'd.trimouille', 'Trimouille', 'Dominique', 2, 8, 1, 2),
(11, 'emmanuelle.lucas', 'f32d6a28ed31112421c7b672ad6131c8c7ac921d', 'e.lucas@gmail.com', 'Lucas', 'Emmanuelle', 2, NULL, 2, 2),
(12, 'katel.le hesran', '878e6bd843b3dd99c3e4ccf4f17c8e904ed9a1dc', 'k.lehersan@gmail.com', 'Le Hesran', 'Katel', 2, 12, 2, 2),
(13, 'lydie.preschoux', 'df60cb229b8c16fb218f320ceae26fc5863a153b', 'l.preschoux', 'Preschoux', 'Lydie', 2, 13, 2, 2),
(14, 'audrey.zavaleta', '82ab6b78e10cbd146a80dbfef6e5aa6c439ce090', 'a.zavaleta', 'Zavaleta', 'Audrey', 2, 15, 2, 2),
(15, 'milena.maselli', '1107fc0b2bd4706fd502ecd7c2de1136a4d89a9b', 'm.maselli', 'Maselli', 'Milena', 2, 16, 4, 2),
(16, 'sabine.berruyer', '4420521ec43a1758c1ead08a6793466132f58112', 'sabine.berruyer@ac-amiens.fr', 'Berruyer', 'Sabine', 2, 17, 3, 2),
(17, 'valerie.mauchamp', '06ad4d8550ce2ae936a9581d819e60f099770436', 'v.mauchamp@gmail.com', 'Mauchamp', 'Valerie', 2, 18, 3, 2),
(18, 'admin', '47ac11a73ddd132c85947e90bb7ca5b18a789990', 'admin@gmail.com', 'Admin', 'Admin', 1, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la vue `elevespassantep`
--
DROP TABLE IF EXISTS `elevespassantep`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `elevespassantep`  AS  select `eleve`.`id` AS `idE`,`eleve`.`nom` AS `nomE`,`eleve`.`prenom` AS `prenomE`,`division`.`libelle` AS `divisionE`,`salle`.`libelle` AS `salleE`,`discipline`.`libelle` AS `disciplineE`,`natureepreuve`.`libelle` AS `epreuveE`,`demijournee`.`date` AS `jourE`,`plage`.`heureDebut` AS `plagHoraireE`,`epreuve`.`dureeEpreuve` AS `dureeEpreuveE`,`eleve`.`tiersTempsON` AS `tiersTempsE`,`passageepreuve`.`absence` AS `absenceE`,`utilisateur`.`id` AS `idP`,`utilisateur`.`nom` AS `nomP`,`utilisateur`.`prenom` AS `prenomP` from ((((((((((`passageepreuve` join `eleve` on((`passageepreuve`.`idEleve` = `eleve`.`id`))) join `division` on((`eleve`.`idDivision` = `division`.`id`))) join `salle` on((`passageepreuve`.`idSalle` = `salle`.`id`))) join `epreuve` on((`passageepreuve`.`idEpreuve` = `epreuve`.`id`))) join `discipline` on((`epreuve`.`idDiscipline` = `discipline`.`id`))) join `natureepreuve` on((`epreuve`.`idNatureEpreuve` = `natureepreuve`.`id`))) join `plagedemijournee` on(((`passageepreuve`.`idDemiJournee` = `plagedemijournee`.`idDemiJournee`) and (`passageepreuve`.`idPlage` = `plagedemijournee`.`idPlage`)))) join `demijournee` on((`plagedemijournee`.`idDemiJournee` = `demijournee`.`id`))) join `plage` on((`plagedemijournee`.`idPlage` = `plage`.`id`))) join `utilisateur` on((`passageepreuve`.`idProfAffecte` = `utilisateur`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure de la vue `selectioneleve`
--
DROP TABLE IF EXISTS `selectioneleve`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ayub`@`%` SQL SECURITY DEFINER VIEW `selectioneleve`  AS  select `eleve`.`nom` AS `nom`,`eleve`.`prenom` AS `prenom`,`division`.`libelle` AS `division`,`natureepreuve`.`libelle` AS `natureepreuve`,`utilisateur`.`nom` AS `professeur` from (((((`passageepreuve` left join `utilisateur` on((`passageepreuve`.`idProfChoix` = `utilisateur`.`id`))) left join `eleve` on((`passageepreuve`.`idEleve` = `eleve`.`id`))) join `division` on((`eleve`.`idDivision` = `division`.`id`))) join `epreuve` on((`passageepreuve`.`idEpreuve` = `epreuve`.`id`))) join `natureepreuve` on((`epreuve`.`idNatureEpreuve` = `natureepreuve`.`id`))) order by `eleve`.`nom` ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `choixprofdemijournee`
--
ALTER TABLE `choixprofdemijournee`
  ADD CONSTRAINT `choixProfDemiJournee_DemiJournee1_FK` FOREIGN KEY (`idDemiJournee`) REFERENCES `demijournee` (`id`),
  ADD CONSTRAINT `choixProfDemiJournee_Professeur0_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `choixProfDemiJournee_Salle2_FK` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `Eleve_Civilite0_FK` FOREIGN KEY (`idCivilite`) REFERENCES `civilite` (`id`),
  ADD CONSTRAINT `Eleve_Division2_FK` FOREIGN KEY (`idDivision`) REFERENCES `division` (`id`);

--
-- Contraintes pour la table `epreuve`
--
ALTER TABLE `epreuve`
  ADD CONSTRAINT `Epreuve_Discipline0_FK` FOREIGN KEY (`idDiscipline`) REFERENCES `discipline` (`id`),
  ADD CONSTRAINT `Epreuve_NatureEpreuve1_FK` FOREIGN KEY (`idNatureEpreuve`) REFERENCES `natureepreuve` (`id`);

--
-- Contraintes pour la table `optionmenuutilisateur`
--
ALTER TABLE `optionmenuutilisateur`
  ADD CONSTRAINT `FK_idoption` FOREIGN KEY (`idOption`) REFERENCES `optionmenu` (`id`),
  ADD CONSTRAINT `FK_idtypeutil` FOREIGN KEY (`idTypeUtil`) REFERENCES `typeutilisateur` (`id`);

--
-- Contraintes pour la table `passageepreuve`
--
ALTER TABLE `passageepreuve`
  ADD CONSTRAINT `FK_Plagedemijournee_idDemiJournee_idPlage` FOREIGN KEY (`idDemiJournee`,`idPlage`) REFERENCES `plagedemijournee` (`idDemiJournee`, `idPlage`),
  ADD CONSTRAINT `FK_idElevePassage` FOREIGN KEY (`idEleve`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `PassageEpreuve_Epreuve2_FK` FOREIGN KEY (`idEpreuve`) REFERENCES `epreuve` (`id`),
  ADD CONSTRAINT `PassageEpreuve_Professeur3_FK` FOREIGN KEY (`idProfChoix`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `PassageEpreuve_Professeur5_FK` FOREIGN KEY (`idProfAffecte`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `PassageEpreuve_Salle4_FK` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `plagedemijournee`
--
ALTER TABLE `plagedemijournee`
  ADD CONSTRAINT `PlageDemiJournee_DemiJournee0_FK` FOREIGN KEY (`idDemiJournee`) REFERENCES `demijournee` (`id`),
  ADD CONSTRAINT `PlageDemiJournee_Plage1_FK` FOREIGN KEY (`idPlage`) REFERENCES `plage` (`id`);

--
-- Contraintes pour la table `profenseigdivision`
--
ALTER TABLE `profenseigdivision`
  ADD CONSTRAINT `enseigner_a_Division1_FK` FOREIGN KEY (`idDivision`) REFERENCES `division` (`id`),
  ADD CONSTRAINT `enseigner_a_Professeur0_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `traitement`
--
ALTER TABLE `traitement`
  ADD CONSTRAINT `Traitement_Administrateur0_FK` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_idDiscipline` FOREIGN KEY (`idDiscipline`) REFERENCES `discipline` (`id`),
  ADD CONSTRAINT `FK_idSalle` FOREIGN KEY (`idSalleAtt`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `FK_idcivilite` FOREIGN KEY (`idCivilite`) REFERENCES `civilite` (`id`),
  ADD CONSTRAINT `FK_idtypeUtilisateur` FOREIGN KEY (`idTypeUtilisateur`) REFERENCES `typeutilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
