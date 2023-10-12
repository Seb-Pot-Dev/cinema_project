-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinemaseb
CREATE DATABASE IF NOT EXISTS `cinemaseb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
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

-- Listage des données de la table cinemaseb.casting : ~6 rows (environ)
/*!40000 ALTER TABLE `casting` DISABLE KEYS */;
INSERT INTO `casting` (`movie_id`, `actor_id`, `role_id`) VALUES
	(1, 2, 1),
	(2, 1, 1),
	(3, 2, 2),
	(1, 3, 3),
	(6, 4, 4),
	(4, 2, 4);
/*!40000 ALTER TABLE `casting` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. director
CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `sexe` varchar(10) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  PRIMARY KEY (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.director : ~5 rows (environ)
/*!40000 ALTER TABLE `director` DISABLE KEYS */;
INSERT INTO `director` (`id_director`, `firstname`, `lastname`, `sexe`, `birthdate`) VALUES
	(1, 'Christopher', 'Nolan', 'Man', '1970-07-30'),
	(2, 'Joel', 'Schumacher', 'Man', '1939-08-29'),
	(3, 'Mary', 'Harron', 'Woman', '1953-01-12'),
	(4, 'Quentin', 'Tarantino', 'Man', '1963-03-27'),
	(5, 'François', 'Bell', 'Man', '1931-11-19');
/*!40000 ALTER TABLE `director` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.genre : ~4 rows (environ)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `genre_name`) VALUES
	(1, 'superhero'),
	(2, 'action'),
	(3, 'sci-fi'),
	(4, 'Animalier');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinemaseb. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `id_movie` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(50) DEFAULT NULL,
  `release_year` year(4) DEFAULT NULL,
  `movie_length` int(11) DEFAULT NULL,
  `synopsis` longtext,
  `url_img` longtext,
  `genre_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_movie`),
  KEY `FK1_movie_genre` (`genre_id`),
  KEY `FK2_movie_director` (`director_id`),
  CONSTRAINT `FK1_movie_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id_genre`),
  CONSTRAINT `FK2_movie_director` FOREIGN KEY (`director_id`) REFERENCES `director` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinemaseb.movie : ~7 rows (environ)
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` (`id_movie`, `movie_name`, `release_year`, `movie_length`, `synopsis`, `url_img`, `genre_id`, `director_id`, `note`) VALUES
	(1, 'The Dark Knight', '2008', 152, 'Batman aborde une phase décisive de sa guerre contre le crime à Gotham City...', 'https://c8.alamy.com/compfr/pm4kac/batman-the-dark-knight-poster-2008-warner-brothers-pm4kac.jpg', 1, 1, 4),
	(2, 'Batman And Robin', '1997', 125, 'À Gotham City, un nouveau méchant fait régner la terreur par le froid, Mister Freeze...', 'https://i.etsystatic.com/10683147/r/il/08db8a/1760961745/il_570xN.1760961745_2elb.jpg', 1, 2, 3),
	(3, 'American Psycho', '2000', 141, 'Patrick Bateman, 27 ans, flamboyant golden-boy du Wall Street d\'avant le krach d\'octobre 1987, est un dandy beau, riche et intelligent comme tous ses amis...', 'https://m.media-amazon.com/images/M/MV5BZTM2ZGJmNjQtN2UyOS00NjcxLWFjMDktMDE2NzMyNTZlZTBiXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', 2, 3, 2),
	(4, 'Inception', '2010', 148, 'Dans un futur proche, les États-Unis ont développé ce qui est appelé le « rêve partagé », une méthode permettant d\'influencer l\'inconscient d\'une victime pendant qu\'elle rêve, donc à partir de son subconscient...', 'https://i.pinimg.com/originals/ae/29/e2/ae29e2656336cbf3d7fad3f6fe8cb1a4.jpg', 3, 1, 5),
	(5, 'Pulp Fiction', '1994', 145, 'Dans un café-restaurant de Los Angeles, dans la matinée, un couple de jeunes braqueurs, Pumpkin (appelé Ringo par Jules) et Yolanda (Tim Roth et Amanda Plummer), discutent des risques que comporte leur activité. Ils se décident finalement à attaquer le lieu, afin de pouvoir dévaliser à la fois l\'établissement et les clients.', 'https://static.posters.cz/image/1300/affiches-et-posters/pulp-fiction-cover-i1288.jpg', 2, 4, 4),
	(6, 'Reservoir Dogs', '1992', 99, 'Dans un restaurant, huit hommes, en apparence décontractés, parlent, entre autres, de musique, notamment de Like a Virgin de Madonna, et du fait de savoir s\'il faut laisser, ou non, un pourboire à la serveuse. Six d\'entre eux utilisent des pseudonymes (M. White, M. Blonde, M. Orange, M. Pink, M. Blue et M. Brown) et les deux autres sont Joe Cabot, un truand de Los Angeles, et son fils Eddie.', 'https://fr.web.img5.acsta.net/r_1280_720/img/f0/72/f072ac5042a2d8c11d9fb8579c7c2827.jpg', 2, 4, 3),
	(8, 'La Griffe et la Dent', '1977', 90, 'Dans l\'Est africain, des espèces animales d\'une extraordinaire variété se côtoient, se mêlent, s\'examinent avec indifférence. Tout n\'est qu\'un immense mouvement pour se nourrir. La nuit tombée, un autre monde apparaît qui s\'organise par le sang et la mort. Tout est désormais lutte ou esquive. Les mouvements deviennent fuites, poursuites, bonds, écroulements, tandis que les immobilités sont attentes, guets, inquiétudes. Ainsi révélé, le monde nocturne rompt avec la longue continuité du jour.', 'https://medias.unifrance.org/medias/245/169/174581/format_page/media.jpg', 4, 5, 1);
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
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
