/*
SQLyog Community v13.2.0 (64 bit)
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`idcliente`,`idpersona`,`idempresa`,`create_at`,`update_at`,`inactive_at`) values 
(1,NULL,2,'2023-09-14 11:03:25',NULL,NULL),
(2,4,NULL,'2023-09-14 11:03:48',NULL,NULL),
(3,6,NULL,'2023-09-14 12:40:08',NULL,NULL),
(4,NULL,4,'2023-09-14 12:47:42',NULL,NULL),
(5,7,NULL,'2023-09-14 14:28:07',NULL,NULL),
(6,NULL,5,'2023-09-14 14:33:54',NULL,NULL),
(7,NULL,6,'2023-09-14 14:52:18',NULL,NULL),
(8,8,NULL,'2023-09-18 18:48:58',NULL,NULL),
(9,NULL,8,'2023-09-18 18:57:12',NULL,NULL),
(10,NULL,9,'2023-09-24 18:58:10',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contratos` */

insert  into `contratos`(`idcontrato`,`idusuario`,`idcliente`,`fechacontrato`,`fechainicio`,`fechacierre`,`observacion`,`garantia`) values 
(1,1,2,'2023-09-14 11:11:28','0000-00-00','2023-09-24','nada que decir','1 mes'),
(2,2,1,'2023-09-14 11:11:28','0000-00-00','2023-09-23','nada que decir','2 semanas'),
(4,1,2,'2023-09-14 17:40:02','2023-09-14','2023-09-23','Prueba de procedimiento','2 meses'),
(5,1,2,'2023-09-20 19:41:30','2023-09-14','2023-09-23','Prueba2 de procedimiento','1 meses'),
(6,1,2,'2023-09-20 19:41:46','2023-09-14',NULL,'Prueba2 de procedimiento','1 meses'),
(7,1,2,'2023-09-20 19:43:01','2023-09-14','2023-09-24','Prueba2 de procedimiento','1 meses'),
(8,2,3,'2023-09-21 16:49:36','2023-09-25','0000-00-00','Prueba desde el modulo','1 mes'),
(9,2,7,'2023-09-21 17:11:44','2023-09-30','0000-00-00','Prueba de nuevo xd','1 mes'),
(10,1,2,'2023-09-21 17:20:28','2023-09-25','2023-09-24','Falla','1 meses'),
(11,1,2,'2023-09-21 17:30:37','2023-09-30','0000-00-00','Prueba controller','1 mes'),
(12,2,6,'2023-09-21 17:38:13','2023-09-28','0000-00-00','Prueba definitiva','2 meses'),
(13,2,8,'2023-09-24 00:34:14','2023-09-24','2023-09-24','Prueba del evento estado','1 mes'),
(14,2,4,'2023-09-24 00:46:36','2023-09-24','2023-09-25','Prueba 2 del evento actualizar estado proceso','2 semanas'),
(15,2,10,'2023-09-24 18:59:11','2023-09-25',NULL,'Prueba de modulo contrato','1 semanas');

/*Table structure for table `desc_equipo` */

DROP TABLE IF EXISTS `desc_equipo`;

CREATE TABLE `desc_equipo` (
  `iddescEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `idequipo` int(11) NOT NULL,
  `iddescServicio` int(11) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  PRIMARY KEY (`iddescEquipo`),
  KEY `fk12` (`iddescServicio`),
  KEY `fk13` (`idequipo`),
  CONSTRAINT `fk12` FOREIGN KEY (`iddescServicio`) REFERENCES `desc_servicio` (`iddescServicio`),
  CONSTRAINT `fk13` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`idequipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `desc_equipo` */

insert  into `desc_equipo`(`iddescEquipo`,`idequipo`,`iddescServicio`,`precio`) values 
(1,1,2,350.00),
(2,2,2,200.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `desc_servicio` */

insert  into `desc_servicio`(`iddescServicio`,`idcontrato`,`idservicio`,`precioservicio`,`cantidad`,`estadoservicio`,`create_at`,`update_at`,`inactive_at`) values 
(1,1,1,6000.00,2,'F','2023-09-14 11:17:34',NULL,NULL),
(2,2,2,8000.00,3,'F','2023-09-14 11:17:34',NULL,NULL),
(3,4,3,300.00,3,'F','2023-09-14 17:40:02',NULL,NULL),
(4,7,3,300.00,5,'F','2023-09-20 19:43:01',NULL,NULL),
(5,10,1,200.00,5,'F','2023-09-21 17:20:28',NULL,NULL),
(6,11,2,600.00,5,'N','2023-09-21 17:30:37',NULL,NULL),
(7,12,3,300.00,4,'N','2023-09-21 17:38:14',NULL,NULL),
(8,13,1,200.00,3,'F','2023-09-24 00:34:14',NULL,NULL),
(9,14,3,200.00,2,'F','2023-09-24 00:46:36',NULL,NULL),
(10,15,1,200.00,3,'N','2023-09-24 18:59:11',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `empresas` */

insert  into `empresas`(`idempresa`,`razonsocial`,`ruc`,`create_at`,`update_at`,`inactive_at`) values 
(1,'ninguna','20124569854','2023-09-14 11:00:45',NULL,NULL),
(2,'ninguna','20354126874','2023-09-14 11:00:45',NULL,NULL),
(3,'ninguna','10234568985','2023-09-14 11:00:45',NULL,NULL),
(4,'Avicola vania','11323235454','2023-09-14 12:47:42',NULL,NULL),
(5,'Minera Viña Vieja','11435445453','2023-09-14 14:33:54',NULL,NULL),
(6,'La del Valle','11435445400','2023-09-14 14:52:18',NULL,NULL),
(8,'Minera new','11234343423','2023-09-18 18:57:12',NULL,NULL),
(9,'prueba cliente','56565767878','2023-09-24 18:58:10',NULL,NULL);

/*Table structure for table `equipos` */

DROP TABLE IF EXISTS `equipos`;

CREATE TABLE `equipos` (
  `idequipo` int(11) NOT NULL AUTO_INCREMENT,
  `idtipoequipo` int(11) NOT NULL,
  `idmarca` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `numSerie` varchar(50) NOT NULL,
  PRIMARY KEY (`idequipo`),
  KEY `fk10` (`idtipoequipo`),
  KEY `fk11` (`idmarca`),
  CONSTRAINT `fk10` FOREIGN KEY (`idtipoequipo`) REFERENCES `tipoequipo` (`idtipoequipo`),
  CONSTRAINT `fk11` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `equipos` */

insert  into `equipos`(`idequipo`,`idtipoequipo`,`idmarca`,`descripcion`,`numSerie`) values 
(1,1,2,'nada que decir',''),
(2,2,3,'nada que decir','');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `garantia` */

insert  into `garantia`(`idgarantia`,`iddescServicio`,`idSoporteTecnico`,`fechaAveria`,`fechaEjecucion`,`problemadetectado`,`solucion`,`estadogarantia`,`inSitu`) values 
(1,1,2,'0000-00-00','0000-00-00',NULL,NULL,'P','Local del cliente'),
(2,2,1,'0000-00-00','0000-00-00',NULL,NULL,'P','Local del cliente');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `marcas` */

insert  into `marcas`(`idmarca`,`marca`,`create_at`,`update_at`,`inactive_at`) values 
(1,'TP Link','2023-09-14 11:30:30',NULL,NULL),
(2,'Dell','2023-09-14 11:30:30',NULL,NULL),
(3,'HP','2023-09-14 11:30:30',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`nombres`,`apellidos`,`dni`,`correo`,`direccion`,`telefono`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Gonzalo','Garcia','75112365',NULL,'El carmen','962874521','2023-09-14 11:00:19',NULL,NULL),
(2,'Camilo','Caceres','75412375',NULL,'El carmen','965874561','2023-09-14 11:00:19',NULL,NULL),
(3,'Edu','Quiroz','72680725',NULL,'CP Guayabo','959282307','2023-09-14 11:00:19',NULL,NULL),
(4,'Jean','Mateo','65985421',NULL,'Chincha','956854123','2023-09-14 11:00:19',NULL,NULL),
(5,'Luis','Cusi','75412365',NULL,'El carmen','965874521','2023-09-14 11:00:19',NULL,NULL),
(6,'Lucio','Herrera','76576825','Llucio02@gmail.com','Chincha Alta','965654565','2023-09-14 12:40:08',NULL,NULL),
(7,'Fabrizio','Barrios','78776567','barri@gmail.com','Chincha Alta','976766754','2023-09-14 14:28:07',NULL,NULL),
(8,'Maritza ','Gonzales Salazar','76768787','mari@gmail.com','El carmen-upis','978787678','2023-09-18 18:48:58',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `servicios` */

insert  into `servicios`(`idservicio`,`tiposervicio`,`nombreservicio`,`precioestimado`,`create_at`,`update_at`,`inactive_at`) values 
(1,'instalaciones','instalacion de camaras',5000.00,'2023-09-14 11:13:31',NULL,NULL),
(2,'instalacion','instalacion de servidores',6000.00,'2023-09-14 11:13:31',NULL,NULL),
(3,'Mantenimiento','mantenimiento de servidores',7000.00,'2023-09-14 11:13:31',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tipoequipo` */

insert  into `tipoequipo`(`idtipoequipo`,`tipoequipo`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Teclado','2023-09-14 11:28:15',NULL,NULL),
(2,'Router','2023-09-14 11:28:15',NULL,NULL),
(3,'Monitor','2023-09-14 11:28:15',NULL,NULL),
(4,'Mouse','2023-09-14 11:28:15',NULL,NULL),
(5,'Camaras','2023-09-14 11:28:15',NULL,NULL);

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
  UNIQUE KEY `uk2` (`usuario`,`idpersona`),
  KEY `fk1` (`idpersona`),
  CONSTRAINT `fk1` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`usuario`,`claveacceso`,`nivelacceso`,`create_at`,`update_at`,`inactive_at`) values 
(1,3,'eduqcc08','$2y$10$DMiAVrfaIrsnJw7ec1mTR.ayjupqmYOHIQw.sBfhtSrzhdUctkla6','A','2023-09-14 11:00:40',NULL,NULL),
(2,1,'gonzalo','$2y$10$HlTVamHz3CWx0.LqOIbvCeeE3lsIudvfW80Bebr6YoRjRUiVrogQW','E','2023-09-14 11:00:40',NULL,NULL);

/*!50106 set global event_scheduler = 1*/;

/* Event structure for event `actualizarEstadoProceso` */

/*!50106 DROP EVENT IF EXISTS `actualizarEstadoProceso`*/;

DELIMITER $$

/*!50106 CREATE DEFINER=`root`@`localhost` EVENT `actualizarEstadoProceso` ON SCHEDULE EVERY 1 DAY STARTS '2023-09-24 00:54:49' ON COMPLETION NOT PRESERVE ENABLE DO begin 
	update desc_servicio DS
	inner join contratos CO on DS.idcontrato = CO.idcontrato	
	set DS.estadoservicio = 'P'
	where CO.fechainicio = curdate();

end */$$
DELIMITER ;

/* Procedure structure for procedure `ListarDescEquipo` */

/*!50003 DROP PROCEDURE IF EXISTS  `ListarDescEquipo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarDescEquipo`()
BEGIN
    SELECT
        de.iddescEquipo AS idDesc_Equipo,
        s.nombreservicio AS nombreServicio,
        te.tipoequipo AS tipoequipo,
        m.marca AS marca,
        e.descripcion AS descripcion,
        de.numSerie AS numSerie,
        de.precio AS precio
    FROM
        desc_equipo de
    INNER JOIN
        equipos e ON de.idequipo = e.idequipo
    INNER JOIN
        tipoequipo te ON e.idtipoequipo = te.idtipoequipo
    INNER JOIN
        marcas m ON e.idmarca = m.idmarca
    INNER JOIN
        desc_servicio ds ON de.iddescServicio = ds.iddescServicio
    INNER JOIN
        servicios s ON ds.idservicio = s.idservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_clientesEmp_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_clientesEmp_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientesEmp_registrar`(
-- param empresa
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
-- param persona
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
-- params contratos
IN _idusuario INT,
IN _idcliente INT,
IN _fechainicio DATE,
IN _observacion VARCHAR(150),
IN _garantia VARCHAR(20),

-- params desc_servicio
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_detalleContratos_listar`(in _idcontrato INT)
BEGIN

	SELECT 
	 COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes,
	 DATE(CO.fechacontrato) AS fechacontrato, SE.tiposervicio,
	  SE.nombreservicio, CO.observacion,
	 DS.precioservicio, CO.fechainicio, CO.garantia
	FROM desc_servicio DS
	inner join servicios SE on SE.idservicio = DS.idservicio
	INNER JOIN contratos CO ON CO.idcontrato = DS.idcontrato
	INNER JOIN clientes CLI ON CLI.idcliente = CO.idcliente
	LEFT JOIN personas PE ON PE.idpersona = CLI.idpersona
	LEFT JOIN empresas EM ON EM.idempresa = CLI.idempresa
	where CO.idcontrato = _idcontrato;

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
	SELECT idequipo , tipoequipo, marca ,descripcion
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

/* Procedure structure for procedure `spu_equipo_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_equipo_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_equipo_listar`()
BEGIN
SELECT idequipo,
	tipoequipo,
	marca,
	descripcion
FROM equipos
	INNER JOIN tipoequipo ON tipoequipo.idtipoequipo = equipos.idtipoequipo
	INNER JOIN marcas ON marcas.idmarca = equipos.idmarca
	ORDER BY idequipo DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_equipo_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_equipo_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_equipo_registrar`(
	IN _idtipoequipo	INT,
	IN _idmarca		INT,
	IN _descripcion		VARCHAR(100)
)
BEGIN
	INSERT INTO equipos (idtipoequipo, idmarca, descripcion)
		VALUES (_idtipoequipo, _idmarca, _descripcion);
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
	    COALESCE(EM.razonsocial, concat(PE.nombres , ' ' , PE.apellidos)) AS clientes
	FROM clientes CLI
	LEFT JOIN personas PE ON CLI.idpersona = PE.idpersona
	LEFT JOIN empresas EM ON CLI.idempresa = EM.idempresa;


END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_getServicios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_getServicios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_getServicios`()
begin 
	select idservicio, nombreservicio
	from servicios;

end */$$
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

	SELECT 	usuarios.idusuario, 
		personas.apellidos, personas.nombres,
		usuarios.usuario, usuarios.claveacceso

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
IN _correo 		VARCHAR(40),
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
