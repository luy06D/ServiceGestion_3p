/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - db_3p
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_3p` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_3p`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) DEFAULT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idcliente`),
  KEY `fk2` (`idpersona`),
  KEY `fk3` (`idempresa`),
  CONSTRAINT `fk2` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`),
  CONSTRAINT `fk3` FOREIGN KEY (`idempresa`) REFERENCES `empresas` (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`idcliente`,`idpersona`,`idempresa`,`create_at`,`update_at`,`inactive_at`) values 
(1,7,NULL,'2023-09-27 08:04:46',NULL,NULL),
(2,8,NULL,'2023-09-27 08:15:34',NULL,NULL),
(3,NULL,1,'2023-09-27 08:50:02',NULL,NULL),
(4,NULL,2,'2023-09-27 09:33:02',NULL,NULL),
(5,NULL,3,'2023-09-27 09:33:38',NULL,NULL),
(6,9,NULL,'2023-09-27 09:37:33',NULL,NULL);

/*Table structure for table `contratos` */

DROP TABLE IF EXISTS `contratos`;

CREATE TABLE `contratos` (
  `idcontrato` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fechacontrato` datetime NOT NULL DEFAULT current_timestamp(),
  `fechainicio` date NOT NULL,
  `fechacierre` date DEFAULT NULL,
  `observacion` varchar(150) NOT NULL,
  `garantia` varchar(20) NOT NULL,
  PRIMARY KEY (`idcontrato`),
  KEY `fk4` (`idcliente`),
  KEY `fk5` (`idusuario`),
  CONSTRAINT `fk4` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  CONSTRAINT `fk5` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contratos` */

insert  into `contratos`(`idcontrato`,`idusuario`,`idcliente`,`fechacontrato`,`fechainicio`,`fechacierre`,`observacion`,`garantia`) values 
(1,1,1,'2023-09-27 08:09:00','2023-09-30','2023-09-27','prueba','3 meses'),
(2,1,1,'2023-09-27 08:10:30','2023-09-30','2023-09-27','prueba','2meses'),
(3,1,1,'2023-09-27 08:11:52','2023-10-01','2023-09-27','prueba','1 mes'),
(4,1,2,'2023-09-27 08:16:05','2023-09-29',NULL,'prueba','2 meses'),
(5,1,2,'2023-09-27 08:18:18','2023-09-27',NULL,'prueba','3 meses');

/*Table structure for table `desc_equipo` */

DROP TABLE IF EXISTS `desc_equipo`;

CREATE TABLE `desc_equipo` (
  `iddescEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `idequipo` int(11) NOT NULL,
  `iddescServicio` int(11) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`iddescEquipo`),
  KEY `fk12` (`iddescServicio`),
  KEY `fk13` (`idequipo`),
  CONSTRAINT `fk12` FOREIGN KEY (`iddescServicio`) REFERENCES `desc_servicio` (`iddescServicio`),
  CONSTRAINT `fk13` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`idequipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `desc_equipo` */

/*Table structure for table `desc_servicio` */

DROP TABLE IF EXISTS `desc_servicio`;

CREATE TABLE `desc_servicio` (
  `iddescServicio` int(11) NOT NULL AUTO_INCREMENT,
  `idcontrato` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `precioservicio` decimal(7,2) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `estadoservicio` char(1) NOT NULL DEFAULT 'N',
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`iddescServicio`),
  KEY `fk6` (`idcontrato`),
  KEY `fk7` (`idservicio`),
  CONSTRAINT `fk6` FOREIGN KEY (`idcontrato`) REFERENCES `contratos` (`idcontrato`),
  CONSTRAINT `fk7` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `desc_servicio` */

insert  into `desc_servicio`(`iddescServicio`,`idcontrato`,`idservicio`,`precioservicio`,`cantidad`,`estadoservicio`,`create_at`,`update_at`,`inactive_at`) values 
(1,1,2,1000.00,2,'F','2023-09-27 08:09:00',NULL,NULL),
(2,2,1,500.00,5,'F','2023-09-27 08:10:30',NULL,NULL),
(3,3,3,400.00,1,'F','2023-09-27 08:11:52',NULL,NULL),
(4,4,1,600.00,6,'N','2023-09-27 08:16:05',NULL,NULL),
(5,5,2,500.00,1,'P','2023-09-27 08:18:18',NULL,NULL);

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(100) NOT NULL,
  `ruc` char(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idempresa`),
  UNIQUE KEY `uk3` (`ruc`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `empresas` */

insert  into `empresas`(`idempresa`,`razonsocial`,`ruc`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Senati','20563987412','2023-09-27 08:50:02',NULL,NULL),
(2,'Avicola vania','20134658965','2023-09-27 09:33:02',NULL,NULL),
(3,'Mineria Milpo','20569874251','2023-09-27 09:33:38',NULL,NULL);

/*Table structure for table `equipos` */

DROP TABLE IF EXISTS `equipos`;

CREATE TABLE `equipos` (
  `idequipo` int(11) NOT NULL AUTO_INCREMENT,
  `idtipoequipo` int(11) NOT NULL,
  `idmarca` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `numSerie` varchar(50) NOT NULL,
  PRIMARY KEY (`idequipo`),
  KEY `fk10` (`idtipoequipo`),
  KEY `fk11` (`idmarca`),
  CONSTRAINT `fk10` FOREIGN KEY (`idtipoequipo`) REFERENCES `tipoequipo` (`idtipoequipo`),
  CONSTRAINT `fk11` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `equipos` */

insert  into `equipos`(`idequipo`,`idtipoequipo`,`idmarca`,`descripcion`,`create_at`,`update_at`,`inactive_at`,`numSerie`) values 
(1,1,1,'model2023','2023-09-25 23:56:17',NULL,NULL,'TGOP2136549875Fkq'),
(2,2,2,'model2022','2023-09-25 23:58:13',NULL,NULL,'FH023659666erm45'),
(3,3,3,'model2023','2023-09-26 00:01:40',NULL,NULL,'TGOP2136549875Fkq'),
(4,4,4,'model25','2023-09-26 10:24:57',NULL,NULL,'jl5469332asd455'),
(5,5,8,'model26','2023-09-26 20:09:46',NULL,NULL,'hgs4562368as12'),
(6,3,3,'modele23','2023-09-26 23:04:18',NULL,NULL,'klPO123659755as'),
(7,1,2,'model23','2023-09-27 09:42:39',NULL,NULL,'JHASD2656246563fj'),
(8,11,6,'model26','2023-09-27 09:45:46',NULL,NULL,'asdsadSDP26215232'),
(9,6,12,'model23','2023-09-27 09:48:37',NULL,NULL,'2aasdasASFA');

/*Table structure for table `garantia` */

DROP TABLE IF EXISTS `garantia`;

CREATE TABLE `garantia` (
  `idgarantia` int(11) NOT NULL AUTO_INCREMENT,
  `iddescServicio` int(11) NOT NULL,
  `idSoporteTecnico` int(11) NOT NULL,
  `fechaAveria` date NOT NULL,
  `fechaEjecucion` date NOT NULL,
  `problemadetectado` varchar(150) DEFAULT NULL,
  `solucion` varchar(150) DEFAULT NULL,
  `estadogarantia` char(1) NOT NULL,
  `inSitu` varchar(50) NOT NULL,
  PRIMARY KEY (`idgarantia`),
  KEY `fk8` (`iddescServicio`),
  KEY `fk9` (`idSoporteTecnico`),
  CONSTRAINT `fk8` FOREIGN KEY (`iddescServicio`) REFERENCES `desc_servicio` (`iddescServicio`),
  CONSTRAINT `fk9` FOREIGN KEY (`idSoporteTecnico`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `garantia` */

/*Table structure for table `marcas` */

DROP TABLE IF EXISTS `marcas`;

CREATE TABLE `marcas` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idmarca`),
  UNIQUE KEY `uk6` (`marca`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `marcas` */

insert  into `marcas`(`idmarca`,`marca`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Dahua','2023-09-25 23:50:34',NULL,NULL),
(2,'Hikvision','2023-09-25 23:57:49',NULL,NULL),
(3,'Ahlborn','2023-09-26 00:01:24',NULL,NULL),
(4,'Samsung','2023-09-26 08:23:11',NULL,NULL),
(5,'LG','2023-09-26 08:30:58',NULL,NULL),
(6,'Genius','2023-09-26 09:02:09',NULL,NULL),
(7,'Asus','2023-09-26 09:07:43',NULL,NULL),
(8,'Toshiba','2023-09-26 09:29:11',NULL,NULL),
(9,'Motorola','2023-09-26 09:52:22',NULL,NULL),
(10,'Panasonic','2023-09-26 10:07:25',NULL,NULL),
(11,'Marca','2023-09-26 10:12:21',NULL,NULL),
(12,'Marca2','2023-09-26 22:33:44',NULL,NULL),
(13,'Lenovo','2023-09-26 23:31:28',NULL,NULL),
(14,'Sony','2023-09-26 23:38:19',NULL,'2023-09-27 10:03:02');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` char(8) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` char(9) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idpersona`),
  UNIQUE KEY `uk1` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`nombres`,`apellidos`,`dni`,`correo`,`direccion`,`telefono`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Gonzalo','Garcia','75112365',NULL,'El carmen','962874521','2023-09-25 23:28:20',NULL,NULL),
(2,'Camilo','Caceres','75412375',NULL,'El carmen','965874561','2023-09-25 23:28:20',NULL,NULL),
(3,'Edu','Quiroz','72680725',NULL,'CP Guayabo','959282307','2023-09-25 23:28:20',NULL,NULL),
(4,'Jean','Mateo','65985421',NULL,'Chincha','956854123','2023-09-25 23:28:20',NULL,NULL),
(5,'Luis','Cusi','75412365',NULL,'El carmen','965874521','2023-09-25 23:28:20',NULL,NULL),
(6,'Juan','Almeyda Torres','21457836','juantorres@gmail.com','Lima','956456871','2023-09-26 00:03:33',NULL,NULL),
(7,'Jose ','Torres Sanchez','21563497','juants@gmail.com','Chincha','956874123','2023-09-27 08:04:46',NULL,NULL),
(8,'Pedro','Saravia Anchante','21748536','pedroanchante@gmail.com','Sunampe','958632147','2023-09-27 08:15:34',NULL,NULL),
(9,'Rosa','Magallanes Porres','21563971','rosamp@hotmail.com','Chincha','956842137','2023-09-27 09:37:33',NULL,NULL);

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `tiposervicio` varchar(50) NOT NULL,
  `nombreservicio` varchar(50) NOT NULL,
  `precioestimado` decimal(7,2) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idservicio`),
  UNIQUE KEY `uk4` (`tiposervicio`,`nombreservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `servicios` */

insert  into `servicios`(`idservicio`,`tiposervicio`,`nombreservicio`,`precioestimado`,`create_at`,`update_at`,`inactive_at`) values 
(1,'instalaciones','instalacion de camaras',5000.00,'2023-09-27 08:08:21',NULL,'2023-09-27 08:31:14'),
(2,'instalacion','instalacion de servidores',6000.00,'2023-09-27 08:08:21',NULL,'2023-09-27 08:31:16'),
(3,'Mantenimiento','mantenimiento de servidores',7000.00,'2023-09-27 08:08:21',NULL,'2023-09-27 08:31:18'),
(4,'Mantenimiento de computadoras','instalación de recursos',100.00,'2023-09-27 08:27:07',NULL,'2023-09-27 08:31:21'),
(5,'Gestión de mantenimiento','Instalación ',200.00,'2023-09-27 08:32:47',NULL,NULL),
(6,'Gestión de mantenimiento','configuración ',100.00,'2023-09-27 08:33:17',NULL,NULL),
(7,'Gestión de mantenimiento','mantenimiento preventivo',300.00,'2023-09-27 08:33:40',NULL,NULL),
(8,'Gestión de mantenimiento','mantenimiento correctivo',200.00,'2023-09-27 08:33:56',NULL,NULL),
(9,'Gestión de mantenimiento','soporte de hardware y software',300.00,'2023-09-27 08:34:21',NULL,NULL),
(10,'Desarrollo y posicionamiento','sistema web',500.00,'2023-09-27 08:35:00',NULL,NULL),
(11,'Desarrollo y posicionamiento','sistema de escritorio',500.00,'2023-09-27 08:35:17',NULL,NULL),
(12,'Desarrollo y posicionamiento','pagina web',500.00,'2023-09-27 08:35:30',NULL,NULL),
(13,'Desarrollo y posicionamiento','aplicación movil',1000.00,'2023-09-27 08:35:52',NULL,NULL),
(14,'Redes y seguridad','seguridad perimetral',1500.00,'2023-09-27 08:36:25',NULL,NULL),
(15,'Consultoria','plan de sistema de información',600.00,'2023-09-27 08:36:56',NULL,NULL);

/*Table structure for table `tipoequipo` */

DROP TABLE IF EXISTS `tipoequipo`;

CREATE TABLE `tipoequipo` (
  `idtipoequipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipoequipo` varchar(30) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idtipoequipo`),
  UNIQUE KEY `uk5` (`tipoequipo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tipoequipo` */

insert  into `tipoequipo`(`idtipoequipo`,`tipoequipo`,`create_at`,`update_at`,`inactive_at`) values 
(1,'DVR','2023-09-25 23:50:01',NULL,NULL),
(2,'Cámara','2023-09-25 23:56:59',NULL,NULL),
(3,'Sensor','2023-09-26 00:00:56',NULL,NULL),
(4,'Monitor','2023-09-26 09:03:02',NULL,NULL),
(5,'Disco duro','2023-09-26 09:05:14',NULL,NULL),
(6,'Teclado','2023-09-26 09:06:14',NULL,NULL),
(7,'Parlante','2023-09-26 09:06:31',NULL,NULL),
(8,'Laptop','2023-09-26 09:06:41',NULL,NULL),
(9,'Memoria RAM','2023-09-26 09:07:01',NULL,NULL),
(10,'Placas','2023-09-26 10:04:26',NULL,NULL),
(11,'Mouse','2023-09-26 10:11:21',NULL,NULL),
(12,'Impresora','2023-09-26 22:42:19',NULL,NULL),
(13,'Ploter','2023-09-26 22:43:34',NULL,'2023-09-27 08:03:39');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `claveacceso` varchar(100) NOT NULL,
  `nivelacceso` char(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk2` (`idpersona`),
  UNIQUE KEY `uk` (`usuario`),
  CONSTRAINT `fk1` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`usuario`,`claveacceso`,`nivelacceso`,`create_at`,`update_at`,`inactive_at`) values 
(1,4,'jean08','$2y$10$vqJOQYwKzyM012Fd4ZuXhONORoe1PqHjTOhH4LCko5FoEOdaKNxWO','A','2023-09-25 23:49:22',NULL,NULL),
(2,6,'juantorres','$2y$10$e/WNSYXhyhGMX95yOzARfelZPPzKS2YbZjORAAZXDlPrhQaMrFiIO','E','2023-09-26 00:03:33',NULL,NULL),
(3,3,'Edu','$2y$10$7L/54pK71SFwEhRW8lAcPuq7z/Q88JOPc5e7HXftrKZovDil2svoy','A','2023-09-26 20:06:35',NULL,NULL);

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `actualizarEstadoProceso` */

/*!50106 DROP EVENT IF EXISTS `actualizarEstadoProceso`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `actualizarEstadoProceso` ON SCHEDULE EVERY 1 DAY STARTS '2023-09-27 08:22:21' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN 
	UPDATE desc_servicio DS
	INNER JOIN contratos CO ON DS.idcontrato = CO.idcontrato	
	SET DS.estadoservicio = 'P'
	WHERE CO.fechainicio = CURDATE();

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_activar_tipo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_activar_tipo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_activar_tipo`(
	IN _idtipoequipo INT
)
BEGIN
	UPDATE tipoequipo SET
		inactive_at = NULL
	WHERE idtipoequipo = _idtipoequipo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_buscar_persona` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_buscar_persona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_buscar_persona`(IN _dni CHAR(8))
BEGIN
SELECT
	idpersona,
	nombres,
	apellidos
	
FROM personas
WHERE dni = _dni;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_buscar_tipoe` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_buscar_tipoe` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_buscar_tipoe`(IN _tipoequipo VARCHAR(30))
BEGIN
SELECT
	idtipoequipo,
	tipoequipo
FROM tipoequipo
WHERE tipoequipo = _tipoequipo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_clientesEmp_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_clientesEmp_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientesEmp_registrar`(
IN _razonsocial VARCHAR(30),
IN _ruc    CHAR(11)
)
BEGIN 
	DECLARE g_idempresa INT;
	
	INSERT INTO empresas (razonsocial, ruc) VALUES
						(_razonsocial, _ruc);
	
	SELECT LAST_INSERT_ID() INTO g_idempresa;
	INSERT INTO clientes (idempresa) VALUES
			(g_idempresa);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_clientesPer_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_clientesPer_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientesPer_registrar`(
IN _nombres VARCHAR(30),
IN _apellidos VARCHAR(30),
IN _dni  CHAR(9),
IN _correo VARCHAR(40),
IN _direccion VARCHAR(60),
IN _telefono  CHAR(9)
)
BEGIN 
	DECLARE g_idpersona INT;
	
	INSERT INTO personas (nombres, apellidos, dni , correo, direccion, telefono) VALUES
						(_nombres, _apellidos, _dni, _correo, _direccion, _telefono);
	
	SELECT LAST_INSERT_ID() INTO g_idpersona;
	INSERT INTO clientes (idpersona) VALUES
			(g_idpersona);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_clientes_buscar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_clientes_buscar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientes_buscar`(IN _search VARCHAR(100))
BEGIN 
	SELECT
		CLI.idcliente,
	    COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes
	FROM clientes CLI
	LEFT JOIN personas PE ON CLI.idpersona = PE.idpersona
	LEFT JOIN empresas EM ON CLI.idempresa = EM.idempresa
	WHERE COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) LIKE CONCAT('%', _search, '%');
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_contratos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_contratos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_contratos_listar`()
BEGIN
	SELECT CO.idcontrato,
	 COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes,
	 DATE(CO.fechacontrato) AS fechacontrato,
	 CO.fechainicio,CO.fechacierre, CO.garantia, DS.estadoservicio
	FROM desc_servicio DS
	INNER JOIN contratos CO ON CO.idcontrato = DS.idcontrato
	INNER JOIN clientes CLI ON CLI.idcliente = CO.idcliente
	LEFT JOIN personas PE ON PE.idpersona = CLI.idpersona
	LEFT JOIN empresas EM ON EM.idempresa = CLI.idempresa;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_contrato_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_contrato_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_contrato_registrar`(
IN _idusuario INT,
IN _idcliente INT,
IN _fechainicio DATE,
IN _observacion VARCHAR(150),
IN _garantia VARCHAR(20),
IN _idservicio INT,
IN _precioservicio DECIMAL(7,2),
IN _cantidad SMALLINT
)
BEGIN 
	
	DECLARE g_idcontrato INT;
	
	INSERT INTO contratos (idusuario, idcliente , fechainicio, observacion, garantia) VALUES
						(_idusuario, _idcliente, _fechainicio, _observacion, _garantia);
	
	SELECT LAST_INSERT_ID() INTO g_idcontrato;
	
	INSERT INTO desc_servicio (idcontrato, idservicio, precioservicio, cantidad) VALUES
								(g_idcontrato, _idservicio, _precioservicio, _cantidad);
				
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_detalleContratos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_detalleContratos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_detalleContratos_listar`(IN _idcontrato INT)
BEGIN
	SELECT 
	 COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes,
	 DATE(CO.fechacontrato) AS fechacontrato, SE.tiposervicio,
	  SE.nombreservicio, CO.observacion,
	 DS.precioservicio, CO.fechainicio, CO.garantia
	FROM desc_servicio DS
	INNER JOIN servicios SE ON SE.idservicio = DS.idservicio
	INNER JOIN contratos CO ON CO.idcontrato = DS.idcontrato
	INNER JOIN clientes CLI ON CLI.idcliente = CO.idcliente
	LEFT JOIN personas PE ON PE.idpersona = CLI.idpersona
	LEFT JOIN empresas EM ON EM.idempresa = CLI.idempresa
	WHERE CO.idcontrato = _idcontrato;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_equipos_actualizar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_equipos_actualizar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_equipos_actualizar`(
	IN _idequipo	INT,
	IN _idtipoequipo INT,
	IN _idmarca	INT,
	IN _descripción	VARCHAR(100)
)
BEGIN 
	UPDATE equipos SET
		idtipoequipo = _idtipoequipo,
		idmarca  = _idmarca
	WHERE idequipo = _idequipo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_equipos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_equipos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_equipos_listar`()
BEGIN
	SELECT idequipo , tipoequipo, marca ,descripcion,numSerie
	FROM  equipos
	INNER JOIN tipoequipo ON tipoequipo.`idtipoequipo` = equipos.`idtipoequipo`
	INNER JOIN marcas ON marcas.`idmarca` = equipos.`idmarca`
	WHERE equipos.inactive_at IS NULL
	ORDER BY idequipo ASC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_equipos_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_equipos_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_equipos_recuperar`()
BEGIN
	SELECT idequipo, tipoequipo
	FROM equipos
	INNER JOIN tipoequipo ON tipoequipo.idtipoequipo = equipos.idtipoequipo
	WHERE equipos.inactive_at IS NULL;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_equipo_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_equipo_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_equipo_registrar`(
	IN _idtipoequipo	INT,
	IN _idmarca		INT,
	IN _descripcion		VARCHAR(100),
	IN _numSerie 		VARCHAR(50)
)
BEGIN
	INSERT INTO equipos (idtipoequipo, idmarca, descripcion, numSerie)
		VALUES (_idtipoequipo, _idmarca, _descripcion, _numSerie);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtroC_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtroC_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtroC_cliente`(IN _idcliente INT)
BEGIN 

	SELECT 
	 COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes,
	 DATE(CO.fechacontrato) AS fechacontrato, SE.tiposervicio,
	  SE.nombreservicio, CO.observacion,
	 DS.precioservicio, CO.fechainicio, CO.garantia
	FROM desc_servicio DS
	INNER JOIN servicios SE ON SE.idservicio = DS.idservicio
	INNER JOIN contratos CO ON CO.idcontrato = DS.idcontrato
	INNER JOIN clientes CLI ON CLI.idcliente = CO.idcliente
	LEFT JOIN personas PE ON PE.idpersona = CLI.idpersona
	LEFT JOIN empresas EM ON EM.idempresa = CLI.idempresa
	WHERE CLI.idcliente = _idcliente;

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_finalizarContrato` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_finalizarContrato` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_finalizarContrato`(
IN _idcontrato INT,
IN _fechacierre DATE
)
BEGIN
		UPDATE contratos SET fechacierre = _fechacierre
		WHERE idcontrato = _idcontrato;
		
		UPDATE desc_servicio SET estadoservicio = 'F'
		WHERE idcontrato = _idcontrato;
		
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_getClientes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_getClientes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_getClientes`()
BEGIN 
	SELECT
		CLI.idcliente,
	    COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes
	FROM clientes CLI
	LEFT JOIN personas PE ON CLI.idpersona = PE.idpersona
	LEFT JOIN empresas EM ON CLI.idempresa = EM.idempresa;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_getServicios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_getServicios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_getServicios`()
BEGIN 
	SELECT idservicio, nombreservicio
	FROM servicios;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_marcas_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_marcas_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_marcas_recuperar`()
BEGIN
	SELECT idmarca, marca
	FROM marcas
	WHERE inactive_at IS NULL;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_marca_actualizar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_marca_actualizar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_marca_actualizar`(	
	IN _idmarca	INT,
	IN _marca	VARCHAR(20)
)
BEGIN
	UPDATE marcas SET
		marca = _marca
	WHERE idmarca = _idmarca;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_marca_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_marca_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_marca_eliminar`(
	IN _idmarca INT
)
BEGIN
	UPDATE marcas SET inactive_at = NOW()
	WHERE idmarca = _idmarca;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_marca_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_marca_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_marca_obtener`(
	IN _idmarca INT
)
BEGIN
	SELECT * FROM marcas WHERE idmarca = _idmarca;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_marca_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_marca_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_marca_registrar`(
	IN _marca	VARCHAR(20)
)
BEGIN
	INSERT INTO marcas (marca) VALUES
		(_marca);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_register_userid` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_register_userid` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_register_userid`(
	IN _idpersona INT,
	IN _usuario	VARCHAR(100),
	IN _claveacceso	VARCHAR(100),
	IN _nivelacceso CHAR(1)
)
BEGIN
INSERT INTO usuarios (idpersona, usuario, claveacceso, nivelacceso) VALUES
	(_idpersona, _usuario, _claveacceso, _nivelacceso);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_eliminar`(IN _idservicio INT)
BEGIN 
		UPDATE servicios SET
		inactive_at = NOW()
		WHERE idservicio = _idservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_listar`()
BEGIN
SELECT idservicio, tiposervicio, nombreservicio, precioestimado
 FROM servicios
 WHERE inactive_at IS NULL;
 END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_obtener`(IN _idservicio INT)
BEGIN 
SELECT tiposervicio, nombreservicio, precioestimado
FROM servicios
WHERE idservicio = _idservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_registrar`(
IN _tiposervicio VARCHAR(50),
IN _nombreservicio VARCHAR(50),
IN _precioestimado DECIMAL(7,2)
)
BEGIN 
	INSERT INTO servicios (tiposervicio, nombreservicio, precioestimado)VALUES
	(_tiposervicio, _nombreservicio, _precioestimado);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_update`(
IN _idservicio INT,
IN _tiposervicio VARCHAR(50),
IN _nombreservicio VARCHAR(50),
IN _precioestimado DECIMAL(7,2)
)
BEGIN
	UPDATE servicios SET
	tiposervicio = _tiposervicio,
	nombreservicio = _nombreservicio,
	precioestimado = _precioestimado
WHERE idservicio = _idservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_tipoequipo_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_tipoequipo_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_tipoequipo_registrar`(
	IN _tipoequipo 	VARCHAR(30)
)
BEGIN
INSERT INTO tipoequipo (tipoequipo)VALUES
	(_tipoequipo);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_tipoequip_actualizar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_tipoequip_actualizar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_tipoequip_actualizar`(
	IN _idtipoequipo INT,
	IN _tipoequipo	VARCHAR(30)
)
BEGIN
	UPDATE tipoequipo SET
		tipoequipo = _tipoequipo
	WHERE idtipoequipo = _idtipoequipo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_tipoequip_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_tipoequip_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_tipoequip_eliminar`(
	IN _idtipoequipo INT
)
BEGIN
	UPDATE tipoequipo SET inactive_at = NOW()
	WHERE idtipoequipo = _idtipoequipo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_tipoequip_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_tipoequip_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_tipoequip_obtener`(
	IN _idtipoequipo INT
)
BEGIN
	SELECT * FROM tipoequipo WHERE idtipoequipo = _idtipoequipo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_tipoequip_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_tipoequip_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_tipoequip_recuperar`()
BEGIN
	SELECT idtipoequipo, tipoequipo
	FROM tipoequipo
	WHERE inactive_at IS NULL;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_user_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_user_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_user_login`(IN _usuario VARCHAR(30))
BEGIN
  SELECT
    usuarios.idusuario,
    personas.apellidos,
    personas.nombres,
    usuarios.usuario,
    usuarios.claveacceso,
    personas.correo,
    personas.dni,
    personas.direccion,
    personas.telefono,
    personas.idpersona
  FROM usuarios
  INNER JOIN personas ON personas.idpersona = usuarios.idpersona
  WHERE usuario = _usuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuario_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuario_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuario_registrar`(
IN _nombres 	VARCHAR(30),
IN _apellidos 	VARCHAR(30),
IN _dni		CHAR(8),
IN _correo 	VARCHAR(40),
IN _direccion	VARCHAR(50),
IN _telefono	CHAR(9),
IN _usuario VARCHAR(40),
IN _claveacceso	  VARCHAR(100),
IN _nivelacceso CHAR(1)
)
BEGIN 
	DECLARE g_idpersona INT;
	
	
	INSERT INTO personas (nombres, apellidos, dni, correo, direccion,telefono ) VALUES 
			(_nombres, _apellidos, _dni, _correo,_direccion, _telefono );
	
	SELECT LAST_INSERT_ID() INTO g_idpersona;
	
	INSERT INTO usuarios (idpersona , usuario, claveacceso, nivelacceso) VALUES
			(g_idpersona, _usuario, _claveacceso, _nivelacceso);	
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
