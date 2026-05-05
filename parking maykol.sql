-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.38-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para parking
CREATE DATABASE IF NOT EXISTS `parking` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `parking`;

-- Volcando estructura para tabla parking.parqueaderos
CREATE TABLE IF NOT EXISTS `parqueaderos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `type_vehicle` varchar(50) DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `space` int(11) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_parking` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla parking.parqueaderos: ~15 rows (aproximadamente)
INSERT INTO `parqueaderos` (`id`, `description`, `type_vehicle`, `piso`, `space`, `location`, `user_id`, `id_parking`) VALUES
	(1, 'Parqueadero 1', 'carro', 1, 1, 'carvajal', 0, 1),
	(2, 'Parqueadero 1', 'carro', 1, 2, 'carvajal', 0, 1),
	(3, 'Parqueadero 1', 'carro', 1, 3, 'carvajal', 0, 1),
	(4, 'Parqueadero 1', 'carro', 2, 1, 'carvajal', 0, 1),
	(5, 'Parqueadero 1', 'moto', 1, 1, 'carvajal', 0, 1),
	(6, 'Parqueadero 1', 'moto', 1, 2, 'carvajal', 0, 1),
	(7, 'Parqueadero 1', 'carro', 2, 2, 'carvajal', 0, 1),
	(8, 'Parqueadero 1', 'carro', 3, 1, 'carvajal', 13, 1),
	(9, 'Parqueadero 1', 'moto', 2, 1, 'carvajal', 0, 1),
	(10, 'Parqueadero 1', 'moto', 3, 1, 'carvajal', 0, 1),
	(11, 'Parqueadero 1', 'bicicleta', 1, 1, 'carvajal', 0, 1),
	(12, 'Parqueadero 2', 'carro', 1, 1, 'carimagua', 0, 2),
	(13, 'Parqueadero 2', 'moto', 1, 1, 'carimagua', 0, 2),
	(14, 'Parqueadero 2', 'bicicleta', 1, 1, 'carimagua', 0, 2),
	(15, 'Parqueadero 2', 'moto', 1, 2, 'carimagua', 0, 2);

-- Volcando estructura para tabla parking.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla parking.roles: ~2 rows (aproximadamente)
INSERT INTO `roles` (`id`, `description`) VALUES
	('1', 'Admin'),
	('2', 'Usuario');

-- Volcando estructura para tabla parking.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `document` int(11) DEFAULT NULL,
  `tp_vehicle` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `parking_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla parking.usuarios: ~10 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `name`, `document`, `tp_vehicle`, `place`, `user`, `password`, `rol_id`, `parking_id`) VALUES
	(2, 'Admin', 123456789, '', '0', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1),
	(4, 'Andres', 123456789, 'carro', 'AKE44F', 'andres', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0),
	(5, 'maicol', 123456, 'moto', 'AER45R', 'maicol', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0),
	(7, 'benito', 12345, 'moto', 'AKE44F', 'benito', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0),
	(8, 'Mauricio', 3691215, 'carro', 'AER45R', 'andres', '348dc21a8acf9658140e0536eb14783d', 2, 0),
	(13, 'user', 12345, 'carro', 'SFW983', 'user', '827ccb0eea8a706c4c34a16891f84e7b', 2, 8),
	(14, 'adminuno', 123, '', '0', 'adminuno', 'c4ca4238a0b923820dcc509a6f75849b', 1, 12),
	(15, 'admindos', 123, '', '0', 'admindos', 'c4ca4238a0b923820dcc509a6f75849b', 1, 12),
	(16, 'admin', 23456, '', '0', 'admin', '9e1e06ec8e02f0a0074f2fcc6b26303b', 1, 1),
	(17, 'admin', 12345, '', '0', 'abc', '99c5e07b4d5de9d18c350cdf64c5aa3d', 1, 12);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
