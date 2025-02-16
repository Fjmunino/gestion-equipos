-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         11.7.2-MariaDB-log - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla gestion_equipos.player
CREATE TABLE IF NOT EXISTS `player` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `number` tinyint(3) unsigned NOT NULL,
  `captain` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `team_id` (`team_id`),
  CONSTRAINT `player_team_id` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_equipos.player: ~2 rows (aproximadamente)
DELETE FROM `player`;
INSERT INTO `player` (`id`, `team_id`, `name`, `surname`, `birth`, `number`, `captain`) VALUES
	(11, 23, 'Brahím', 'Díaz', '2008-12-12', 12, 0),
	(12, 23, 'Luka', 'Modric', '1985-12-12', 10, 1);

-- Volcando estructura para tabla gestion_equipos.team
CREATE TABLE IF NOT EXISTS `team` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `sport` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `year_of_foundation` date NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_equipos.team: ~2 rows (aproximadamente)
DELETE FROM `team`;
INSERT INTO `team` (`id`, `name`, `city`, `sport`, `slug`, `year_of_foundation`, `created_at`) VALUES
	(23, 'Real Madrid C.F.', 'Madrid', 'Fútbol', 'real-madrid-c-f-', '2025-01-31', '2025-02-16 12:05:27'),
	(24, 'Unicaja', 'Málaga', 'Baloncesto', 'unicaja', '2000-02-15', '2025-02-16 12:06:53');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
