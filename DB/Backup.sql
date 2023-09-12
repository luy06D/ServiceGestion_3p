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
  `idempresa` int(11) DEFAULT NULL,
  `idpersona` int(11) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `telefono` char(9) NOT NULL,
  PRIMARY KEY (`idcliente`),
  KEY `fk_idp_cli` (`idpersona`),
  KEY `fk_ide_cliente` (`idempresa`),
  CONSTRAINT `fk_ide_cliente` FOREIGN KEY (`idempresa`) REFERENCES `empresas` (`idempresa`),
  CONSTRAINT `fk_idp_cli` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `clientes` */

/*Table structure for table `contratos` */

DROP TABLE IF EXISTS `contratos`;

CREATE TABLE `contratos` (
  `idcontrato` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `fechacontrato` date NOT NULL,
  `estadocontrato` char(1) NOT NULL,
  PRIMARY KEY (`idcontrato`),
  KEY `fk_cli_con` (`idcliente`),
  CONSTRAINT `fk_cli_con` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contratos` */

/*Table structure for table `desc_servicio` */

DROP TABLE IF EXISTS `desc_servicio`;

CREATE TABLE `desc_servicio` (
  `iddesc` int(11) NOT NULL AUTO_INCREMENT,
  `idservicio` int(11) NOT NULL,
  `idcontrato` int(11) NOT NULL,
  `numrepuesto` varchar(10) NOT NULL,
  PRIMARY KEY (`iddesc`),
  KEY `fk_ser_desc` (`idservicio`),
  KEY `fk_con_desc` (`idcontrato`),
  CONSTRAINT `fk_con_desc` FOREIGN KEY (`idcontrato`) REFERENCES `contratos` (`idcontrato`),
  CONSTRAINT `fk_ser_desc` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `desc_servicio` */

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `ruc` char(11) NOT NULL,
  PRIMARY KEY (`idempresa`),
  UNIQUE KEY `uk_ruc_emp` (`ruc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `empresas` */

/*Table structure for table `equipo_serie` */

DROP TABLE IF EXISTS `equipo_serie`;

CREATE TABLE `equipo_serie` (
  `idequiposerie` int(11) NOT NULL AUTO_INCREMENT,
  `iddesc` int(11) NOT NULL,
  `idequipo` int(11) NOT NULL,
  `numeroserie` varchar(30) NOT NULL,
  PRIMARY KEY (`idequiposerie`),
  KEY `fk_des_equ` (`iddesc`),
  KEY `fk_equ_equ` (`idequipo`),
  CONSTRAINT `fk_des_equ` FOREIGN KEY (`iddesc`) REFERENCES `desc_servicio` (`iddesc`),
  CONSTRAINT `fk_equ_equ` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`idequipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `equipo_serie` */

/*Table structure for table `equipos` */

DROP TABLE IF EXISTS `equipos`;

CREATE TABLE `equipos` (
  `idequipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipoR` varchar(60) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock` smallint(6) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idequipo`),
  UNIQUE KEY `uk_nom_re` (`nombre`),
  UNIQUE KEY `uk_mol_re` (`modelo`,`marca`),
  CONSTRAINT `ck_pre_re` CHECK (`precio` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `equipos` */

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `dni` char(9) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `genero` char(1) NOT NULL,
  PRIMARY KEY (`idpersona`),
  UNIQUE KEY `uk_dni_per` (`dni`),
  CONSTRAINT `ck_ge_per` CHECK (`genero` in ('M','F'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `personas` */

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `tiposervicio` varchar(100) NOT NULL,
  `duracionE` varchar(20) NOT NULL,
  `garantia` varchar(20) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `servicios` */

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nivelacceso` char(1) NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_us_usu` (`usuario`,`idpersona`),
  KEY `fk_idp_usu` (`idpersona`),
  CONSTRAINT `fk_idp_usu` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
