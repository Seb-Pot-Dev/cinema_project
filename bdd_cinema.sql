-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour cinemaseb
CREATE DATABASE IF NOT EXISTS `cinemaseb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cinemaseb`;

-- Listage de la structure de la table cinemaseb. actor
CREATE TABLE IF NOT EXISTS `actor` (
  `id_actor` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  PRIMARY KEY (`id_actor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.actor : ~4 rows (environ)
/*!40000 ALTER TABLE `actor` DISABLE KEYS */;
INSERT INTO `actor` (`id_actor`, `firstname`, `lastname`, `sexe`, `birthdate`) VALUES
	(1, 'Georges', 'Clooney', 'Man', '1961-05-06'),
	(2, 'Christian', 'Bale', 'Man', '1974-01-30'),
	(3, 'Health', 'Ledger', 'Man', '1979-04-04'),
	(4, 'Quentin', 'Tarantino', 'Man', '1963-03-27');
/*!40000 ALTER TABLE `actor` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `movie_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  KEY `FK1_casting_movie` (`movie_id`),
  KEY `FK2_casting_actor` (`actor_id`),
  KEY `FK3_casting_role` (`role_id`),
  CONSTRAINT `FK1_casting_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id_movie`),
  CONSTRAINT `FK2_casting_actor` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id_actor`),
  CONSTRAINT `FK3_casting_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.casting : ~5 rows (environ)
/*!40000 ALTER TABLE `casting` DISABLE KEYS */;
INSERT INTO `casting` (`movie_id`, `actor_id`, `role_id`) VALUES
	(1, 2, 1),
	(2, 1, 1),
	(3, 2, 2),
	(1, 3, 3),
	(6, 4, 4);
/*!40000 ALTER TABLE `casting` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. director
CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  PRIMARY KEY (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.director : ~4 rows (environ)
/*!40000 ALTER TABLE `director` DISABLE KEYS */;
INSERT INTO `director` (`id_director`, `firstname`, `lastname`, `sexe`, `birthdate`) VALUES
	(1, 'Christopher', 'Nolan', 'Man', '1970-07-30'),
	(2, 'Joel', 'Schumacher', 'Man', '1939-08-29'),
	(3, 'Mary', 'Harron', 'Woman', '1953-01-12'),
	(4, 'Quentin', 'Tarantino', 'Man', '1963-03-27');
/*!40000 ALTER TABLE `director` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.genre : ~3 rows (environ)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `genre_name`) VALUES
	(1, 'superhero'),
	(2, 'action'),
	(3, 'sci-fi');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(50) DEFAULT NULL,
  `release_year` year(4) DEFAULT NULL,
  `movie_length` time DEFAULT NULL,
  `synopsis` longtext,
  `genre_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `FK1_movie_genre` (`genre_id`),
  KEY `FK2_movie_director` (`director_id`),
  CONSTRAINT `FK1_movie_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id_genre`),
  CONSTRAINT `FK2_movie_director` FOREIGN KEY (`director_id`) REFERENCES `director` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.movie : ~6 rows (environ)
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` (`id_movie`, `movie_name`, `release_year`, `movie_length`, `synopsis`, `genre_id`, `director_id`) VALUES
	(1, 'The Dark Knight', '2008', '02:32:00', 'Batman aborde une phase décisive de sa guerre contre le crime à Gotham City...', 1, 1),
	(2, 'Batman And Robin', '1997', '02:05:00', 'À Gotham City, un nouveau méchant fait régner la terreur par le froid, Mister Freeze...', 1, 2),
	(3, 'American Psycho', '2000', '01:41:00', 'Patrick Bateman, 27 ans, flamboyant golden-boy du Wall Street d\'avant le krach d\'octobre 1987, est un dandy beau, riche et intelligent comme tous ses amis...', 2, 3),
	(4, 'Inception', '2010', '02:28:00', 'Dans un futur proche, les États-Unis ont développé ce qui est appelé le « rêve partagé », une méthode permettant d\'influencer l\'inconscient d\'une victime pendant qu\'elle rêve, donc à partir de son subconscient...', 3, 1),
	(5, 'Pulp Fiction', '1994', '02:25:00', 'Dans un café-restaurant de Los Angeles, dans la matinée, un couple de jeunes braqueurs, Pumpkin (appelé Ringo par Jules) et Yolanda (Tim Roth et Amanda Plummer), discutent des risques que comporte leur activité. Ils se décident finalement à attaquer le lieu, afin de pouvoir dévaliser à la fois l\'établissement et les clients.', 2, 4),
	(6, 'Reservoir Dogs', '1992', '01:39:00', 'Dans un restaurant, huit hommes, en apparence décontractés, parlent, entre autres, de musique, notamment de Like a Virgin de Madonna, et du fait de savoir s\'il faut laisser, ou non, un pourboire à la serveuse. Six d\'entre eux utilisent des pseudonymes (M. White, M. Blonde, M. Orange, M. Pink, M. Blue et M. Brown) et les deux autres sont Joe Cabot, un truand de Los Angeles, et son fils Eddie.', 2, 4);
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.role : ~4 rows (environ)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `role_name`) VALUES
	(1, 'Bruce Wayne aka le Batman'),
	(2, 'Patrick Bateman'),
	(3, 'Le Joker'),
	(4, 'M. Brown');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
