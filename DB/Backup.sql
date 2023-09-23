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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`idcliente`,`idpersona`,`idempresa`,`create_at`,`update_at`,`inactive_at`) values 
(1,NULL,2,'2023-09-14 11:03:25',NULL,NULL),
(2,4,NULL,'2023-09-14 11:03:48',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contratos` */

insert  into `contratos`(`idcontrato`,`idusuario`,`idcliente`,`fechacontrato`,`fechainicio`,`fechacierre`,`observacion`,`garantia`) values 
(1,1,2,'2023-09-14 11:11:28','0000-00-00',NULL,'nada que decir','1 mes'),
(2,2,1,'2023-09-14 11:11:28','0000-00-00',NULL,'nada que decir','2 semanas');

/*Table structure for table `desc_equipo` */

DROP TABLE IF EXISTS `desc_equipo`;

CREATE TABLE `desc_equipo` (
  `iddescEquipo` int(11) NOT NULL AUTO_INCREMENT,
  `idequipo` int(11) NOT NULL,
  `iddescServicio` int(11) NOT NULL,
  `numSerie` varchar(15) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  PRIMARY KEY (`iddescEquipo`),
  UNIQUE KEY `uk7` (`numSerie`),
  KEY `fk12` (`iddescServicio`),
  KEY `fk13` (`idequipo`),
  CONSTRAINT `fk12` FOREIGN KEY (`iddescServicio`) REFERENCES `desc_servicio` (`iddescServicio`),
  CONSTRAINT `fk13` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`idequipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `desc_equipo` */

insert  into `desc_equipo`(`iddescEquipo`,`idequipo`,`iddescServicio`,`numSerie`,`precio`) values 
(1,1,2,'84565214253',350.00),
(2,2,2,'96532145875',200.00);

/*Table structure for table `desc_servicio` */

DROP TABLE IF EXISTS `desc_servicio`;

CREATE TABLE `desc_servicio` (
  `iddescServicio` int(11) NOT NULL AUTO_INCREMENT,
  `idcontrato` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `precioservicio` decimal(7,2) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `estadoservicio` char(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`iddescServicio`),
  KEY `fk6` (`idcontrato`),
  KEY `fk7` (`idservicio`),
  CONSTRAINT `fk6` FOREIGN KEY (`idcontrato`) REFERENCES `contratos` (`idcontrato`),
  CONSTRAINT `fk7` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `desc_servicio` */

insert  into `desc_servicio`(`iddescServicio`,`idcontrato`,`idservicio`,`precioservicio`,`cantidad`,`estadoservicio`,`create_at`,`update_at`,`inactive_at`) values 
(1,1,1,6000.00,2,'P','2023-09-14 11:17:34',NULL,NULL),
(2,2,2,8000.00,3,'N','2023-09-14 11:17:34',NULL,NULL);

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
(1,'ninguna','20124569854','2023-09-14 11:00:45',NULL,NULL),
(2,'ninguna','20354126874','2023-09-14 11:00:45',NULL,NULL),
(3,'ninguna','10234568985','2023-09-14 11:00:45',NULL,NULL);

/*Table structure for table `equipos` */

DROP TABLE IF EXISTS `equipos`;

CREATE TABLE `equipos` (
  `idequipo` int(11) NOT NULL AUTO_INCREMENT,
  `idtipoequipo` int(11) NOT NULL,
  `idmarca` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`idequipo`),
  KEY `fk10` (`idtipoequipo`),
  KEY `fk11` (`idmarca`),
  CONSTRAINT `fk10` FOREIGN KEY (`idtipoequipo`) REFERENCES `tipoequipo` (`idtipoequipo`),
  CONSTRAINT `fk11` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `equipos` */

insert  into `equipos`(`idequipo`,`idtipoequipo`,`idmarca`,`descripcion`) values 
(1,1,2,'nada que decir'),
(2,2,3,'nada que decir');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`nombres`,`apellidos`,`dni`,`correo`,`direccion`,`telefono`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Gonzalo','Garcia','75112365',NULL,'El carmen','962874521','2023-09-14 11:00:19',NULL,NULL),
(2,'Camilo','Caceres','75412375',NULL,'El carmen','965874561','2023-09-14 11:00:19',NULL,NULL),
(3,'Edu','Quiroz','72680725',NULL,'CP Guayabo','959282307','2023-09-14 11:00:19',NULL,NULL),
(4,'Jean','Mateo','65985421',NULL,'Chincha','956854123','2023-09-14 11:00:19',NULL,NULL),
(5,'Luis','Cusi','75412365',NULL,'El carmen','965874521','2023-09-14 11:00:19',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `servicios` */

insert  into `servicios`(`idservicio`,`tiposervicio`,`nombreservicio`,`precioestimado`,`create_at`,`update_at`,`inactive_at`) values 
(1,'instalaciones','instalacion de camaras',5000.00,'2023-09-14 11:13:31',NULL,NULL),
(2,'instalacion','instalacion de servidores',6000.00,'2023-09-14 11:13:31',NULL,NULL),
(3,'Mantenimiento','mantenimiento de servidores',7000.00,'2023-09-14 11:13:31',NULL,NULL),
(4,'Mantenimiento','Reparacion de computadora',40.00,'2023-09-14 12:44:55',NULL,NULL),
(6,'Reparacion','Reparacion de Laptop',30.00,'2023-09-14 12:48:54',NULL,NULL),
(7,'Reparacion','Reparacion de impresoras',500.00,'2023-09-14 12:54:13',NULL,NULL),
(8,'312123','instalacion de camaras',5000.00,'2023-09-14 16:10:33',NULL,NULL);

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
(1,3,'eduqcc08','123456','A','2023-09-14 11:00:40',NULL,NULL),
(2,1,'gonzalo','123456','E','2023-09-14 11:00:40',NULL,NULL);

/* Procedure structure for procedure `spu_servicios_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_listar`()
begin
select idservicio, tiposervicio, nombreservicio, precioestimado
 from servicios
 where inactive_at is NULL;
 end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_obtener`(in _idservicio int)
begin 
select tiposervicio, nombreservicio, precioestimado
from servicios
where idservicio = _idservicio;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_registrar`(
in _tiposervicio varchar(50),
in _nombreservicio varchar(50),
in _precioestimado decimal(7,2)
)
begin 
	insert into servicios (tiposervicio, nombreservicio, precioestimado)values
	(_tiposervicio, _nombreservicio, _precioestimado);
	end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_update`(
in _idservicio int,
IN _tiposervicio VARCHAR(50),
IN _nombreservicio VARCHAR(50),
IN _precioestimado DECIMAL(7,2)
)
begin
	update servicios set
	tiposervicio = _tiposervicio,
	nombreservicio = _nombreservicio,
	precioestimado = _precioestimado
	
	where idservicio = _idservicio;
	end */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
