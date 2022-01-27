-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2022 at 12:51 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cabinet`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `date_heure` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `id_m` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  PRIMARY KEY (`id_c`),
  KEY `fk_foreign_id_m` (`id_m`),
  KEY `fk_foreign_id_u` (`id_u`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`id_c`, `date_heure`, `duree`, `id_m`, `id_u`) VALUES
(98, 1643098800, 3300, 1, 51),
(97, 1643097600, 1800, 1, 51),
(96, 1642681800, 60, 1, 51),
(94, 1641720000, 1800, 1, 12),
(93, 1641715200, 1800, 1, 12),
(92, 1641715200, 1800, 2, 12),
(91, 1641720300, 3000, 2, 12),
(90, 1641974400, 1800, 1, 38),
(89, 0, 86400, 2, 2),
(85, 0, 1600, 2, 2),
(84, 2277300, 1600, 1, 1),
(78, 1640075400, 3600, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `id_m` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `civilite` varchar(7) NOT NULL,
  PRIMARY KEY (`id_m`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medecin`
--

INSERT INTO `medecin` (`id_m`, `nom`, `prenom`, `civilite`) VALUES
(1, 'Duplantier', 'Veronique', 'Mme'),
(2, 'Croquet', 'Clara', 'Mme');

-- --------------------------------------------------------

--
-- Table structure for table `secretariat`
--

DROP TABLE IF EXISTS `secretariat`;
CREATE TABLE IF NOT EXISTS `secretariat` (
  `id` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secretariat`
--

INSERT INTO `secretariat` (`id`, `mdp`) VALUES
('etu', '$iutinfo');

-- --------------------------------------------------------

--
-- Table structure for table `usager`
--

DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
  `id_u` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `civilite` varchar(7) NOT NULL,
  `num_secu` varchar(15) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `lieu_naissance` varchar(50) NOT NULL,
  `date_naissance` int(11) NOT NULL,
  `id_m` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_u`),
  KEY `FK_Medecin` (`id_m`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usager`
--

INSERT INTO `usager` (`id_u`, `nom`, `prenom`, `civilite`, `num_secu`, `adresse`, `cp`, `ville`, `lieu_naissance`, `date_naissance`, `id_m`) VALUES
(47, 'Bert', 'Fealy', 'Mme', '6287903', '6572241', '91129', '9859523', '0453094', 1151107200, 0),
(48, 'Maisey', 'Beininck', 'Mme', '3442490', '3779239', '09174', '3313651', '1037707', -7430400, 2),
(49, 'Hurley', 'Lougheed', 'Mme', '2260089', '8147541', '87947', '0984799', '2655338', 311299200, 1),
(50, 'Janet', 'Laise', 'Mme', '3978147', '1176492', '91002', '4131905', '8735342', -596066131, NULL),
(51, 'Deschaux-Beaume', 'LÃ©o', 'M', '012345678', '0123456', '0123', 'Toulouse', 'Dax', 1017878400, 2),
(45, 'Ranna', 'Jancy', 'M', '7734578', '2257672', '22499', '5829238', '8428292', 943312974, NULL),
(46, 'Lucille', 'Alflatt', 'Mme', '4039154', '5313324', '32553', '9046789', '9490684', 285054675, NULL),
(43, 'Liv', 'Andress', 'Mme', '4721154', '8399780', '58376', '2554991', '6530692', 322089984, NULL),
(44, 'Jeri', 'Eilhart', 'Mme', '8127342', '0424988', '72341', '4938299', '3296628', 462699249, NULL),
(42, 'Osbourne', 'Tighe', 'M', '9261258', '9458391', '86613', '4245374', '3958460', -386092146, NULL),
(41, 'Morry', 'Brade', 'Mme', '2673855', '5906779', '79646', '2990402', '5715257', -469655353, NULL),
(40, 'Benedicta', 'Whybrow', 'M', '0532171', '9964089', '53992', '3402077', '0677860', 66070578, NULL),
(39, 'Rosabel', 'Pagon', 'Mme', '2848920', '1340928', '83285', '5215160', '3986059', 394747229, NULL),
(38, 'Angel', 'Beeken', 'M', '4057258', '3137984', '46904', '4287869', '0098543', -419149961, NULL),
(37, 'Vivianne', 'Gallager', 'M', '4003883', '1194590', '16896', '2043968', '5125272', 727436010, NULL),
(33, 'Benyamin', 'Morrilly', 'Mme', '0136381', '0220824', '94106', '6236812', '8649793', 1328791240, NULL),
(34, 'Bobby', 'Fellos', 'Mme', '9534768', '7784391', '56411', '6583777', '9042665', 9057435, NULL),
(35, 'Ardisj', 'Pagon', 'Mme', '9807008', '8984981', '63218', '2088838', '3491996', 471619456, NULL),
(36, 'Konstantin', 'Titmuss', 'Mme', '9689067', '8066325', '45901', '5955988', '7049064', 206458465, NULL),
(28, 'Timoteo', 'Crevagh', 'M', '5696916', '0529362', '23385', '4622541', '5398329', -327900726, NULL),
(29, 'Carolan', 'Jakeman', 'M', '1276467', '1833617', '33112', '3030316', '6853728', 592327659, NULL),
(30, 'Thomasine', 'Burry', 'Mme', '6358395', '4867916', '43573', '9282876', '1378263', -288006665, NULL),
(31, 'Betsy', 'Minker', 'Mme', '4634224', '5241040', '29628', '1046752', '7432599', -324108902, NULL),
(32, 'Laurel', 'Trubshawe', 'M', '3603644', '5742057', '35305', '5794727', '9485920', 1339732228, NULL),
(23, 'Barbra', 'Findlow', 'Mme', '3671095', '4730964', '57087', '7041112', '2725892', 797061715, NULL),
(24, 'Stirling', 'Duchateau', 'M', '9728466', '1104268', '41566', '5855271', '7645720', 1116830210, NULL),
(25, 'Cindie', 'Bonallack', 'Mme', '9410663', '2770138', '21829', '2921342', '1452679', -196991015, NULL),
(26, 'Susana', 'Yesenev', 'M', '4218429', '5108106', '72119', '8478025', '9458786', 1301643161, NULL),
(27, 'Terencio', 'McGown', 'M', '2747817', '8005235', '53228', '1005633', '2557999', 472690590, NULL),
(22, 'Den', 'Coniam', 'Mme', '2673809', '5412297', '13840', '0897969', '6511504', 656985200, NULL),
(21, 'Gill', 'Saylor', 'M', '8097647', '5886347', '87946', '2243220', '7006100', 1182921093, NULL),
(20, 'Anton', 'Eastridge', 'M', '2263698', '1802205', '01535', '3292912', '2410695', 165228832, NULL),
(16, 'Dare', 'McMains', 'M', '9613212', '1297493', '79104', '3769384', '6782588', -498711034, NULL),
(18, 'Merola', 'Seeley', 'M', '6812019', '5500761', '67668', '6576253', '9882652', -401617046, NULL),
(19, 'Tommie', 'Rossiter', 'M', '2290409', '6018392', '46591', '1655843', '8714043', 962160486, NULL),
(17, 'Mirna', 'Sherston', 'Mme', '0693700', '6021433', '55595', '7346502', '4591879', 463204239, NULL),
(14, 'Dyann', 'Scarlon', 'Mme', '7287055', '8843695', '79136', '7221322', '0461154', 623088584, NULL),
(15, 'Eula', 'Olifard', 'Mme', '0865917', '2398414', '66165', '0699858', '2242407', 447263792, NULL),
(12, 'Alphonso', 'Castelain', 'Mme', '0040586', '3610980', '89110', '6074384', '0126831', 1290135359, NULL),
(13, 'Gerald', 'Ledamun', 'Mme', '3864619', '8668335', '08377', '0271579', '2227424', 1015967498, NULL),
(11, 'Annie', 'Scarfe', 'Mme', '0268039', '6384706', '38185', '4781858', '4287506', 960281435, NULL),
(8, 'Riannon', 'Bradburn', 'M', '1247210', '7507015', '12141', '4786859', '5543879', -432734442, NULL),
(10, 'Janelle', 'Fullman', 'M', '0356965', '4153323', '31415', '5765626', '4986729', 862927687, NULL),
(9, 'Nathaniel', 'Hardacre', 'M', '4715982', '9554020', '94815', '2094071', '3540728', -339568701, NULL),
(7, 'Karylin', 'Oakhill', 'M', '0354551', '7210040', '92115', '8751508', '7040628', -502528348, NULL),
(6, 'Sanson', 'Inglesfield', 'Mme', '0917784', '0638607', '60314', '7952949', '2085361', -583503686, NULL),
(5, 'Valenka', 'Mather', 'M', '8878442', '0691749', '83005', '7826819', '2243994', 848746880, NULL),
(4, 'Jermaine', 'Barkworth', 'M', '1998577', '2422644', '82194', '5549472', '6764717', 1417327028, NULL),
(3, 'Hanson', 'Cayford', 'Mme', '0897976', '1976404', '45209', '5628958', '5669295', 959726513, NULL),
(2, 'Koo', 'Mumbray', 'M', '0067430', '3789688', '06443', '0651715', '6674772', 1171584000, 0),
(1, 'Christiane', 'Effemy', 'Mme', '2506725', '7744476', '58942', '4119342', '6048878', 350358518, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
