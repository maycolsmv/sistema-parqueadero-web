-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.25-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla parking.parqueaderos: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `parqueaderos` DISABLE KEYS */;
INSERT INTO `parqueaderos` (`id`, `description`, `type_vehicle`, `piso`, `space`, `location`, `user_id`) VALUES
	(1, 'Parqueadero 1', 'carro', 1, 1, 'carvajal', 0),
	(2, 'Parqueadero 1', 'carro', 1, 2, 'carvajal', 0),
	(3, 'Parqueadero 1', 'carro', 1, 3, 'carvajal', 0),
	(4, 'Parqueadero 1', 'carro', 2, 1, 'carvajal', 0),
	(5, 'Parqueadero 1', 'moto', 1, 1, 'carvajal', 0),
	(6, 'Parqueadero 1', 'moto', 1, 2, 'carvajal', 0),
	(7, 'Parqueadero 1', 'carro', 2, 2, 'carvajal', 0),
	(8, 'Parqueadero 1', 'carro', 3, 1, 'carvajal', 0),
	(9, 'Parqueadero 1', 'moto', 2, 1, 'carvajal', 0),
	(10, 'Parqueadero 1', 'moto', 3, 1, 'carvajal', 0),
	(11, 'Parqueadero 1', 'bicicleta', 1, 1, 'carvajal', 0),
	(12, 'Parqueadero 2', 'carro', 1, 1, 'carimagua', 0),
	(13, 'Parqueadero 2', 'moto', 1, 1, 'carimagua', 7),
	(14, 'Parqueadero 2', 'bicicleta', 1, 1, 'carimagua', 0),
	(15, 'Parqueadero 2', 'moto', 1, 2, 'carimagua', 4);
/*!40000 ALTER TABLE `parqueaderos` ENABLE KEYS */;

-- Volcando datos para la tabla parking.roles: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `description`) VALUES
	(1, 'Admin'),
	(2, 'Usuario');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando datos para la tabla parking.usuarios: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `name`, `document`, `tp_vehicle`, `place`, `user`, `password`, `rol_id`, `parking_id`) VALUES
	(1, 'admin', '123456789', '', '0', 'aad', '76876', 1, 0),
	(2, 'Admin', '123456789', '', '0', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0),
	(3, 'Admin', '123456789', '', '0', 'admin', '12345', 1, 0),
	(4, 'Andres', '123456789', 'moto', 'AKE44F', 'andres', '827ccb0eea8a706c4c34a16891f84e7b', 2, 15),
	(5, 'maicol', '123456', 'moto', 'AER45R', 'maicol', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0),
	(6, 'Angela', '123456789', 'carro', 'AER45R', 'angel', '827ccb0eea8a706c4c34a16891f84e7b', 2, 0),
	(7, 'benito', '12345', 'moto', 'AKE44F', 'benito', '827ccb0eea8a706c4c34a16891f84e7b', 2, 13),
	(8, 'Mauricio', '3691215', 'carro', 'AER45R', 'andres', '348dc21a8acf9658140e0536eb14783d', 2, 0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
