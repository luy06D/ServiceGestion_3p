CREATE DATABASE DB_3P

USE  DB_3P


CREATE TABLE personas 
(
idpersona 		INT AUTO_INCREMENT PRIMARY KEY,
nombres 			VARCHAR(30) 		NOT NULL,
apellidos 		VARCHAR(30) 		NOT NULL,
dni				CHAR(9) 				NOT NULL,
correo   		VARCHAR(40) 		NOT NULL,
genero 			CHAR(1) 				NOT NULL,

CONSTRAINT uk_dni_per  UNIQUE (dni),
CONSTRAINT ck_ge_per CHECK( genero IN ('M', 'F'))
)
ENGINE = INNODB

CREATE TABLE usuarios
(
	idusuario INT AUTO_INCREMENT PRIMARY KEY,
	idpersona	INT NOT NULL,
	usuario 	VARCHAR(30) NOT NULL,
	clave 	VARCHAR(100) NOT NULL,
	nivelacceso	CHAR(1) NOT NULL , -- A = Admin, 	
CONSTRAINT fk_idp_usu FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
CONSTRAINT uk_us_usu UNIQUE(usuario, idpersona)
)
ENGINE = INNODB;

CREATE TABLE clientes
(
	idcliente	INT AUTO_INCREMENT PRIMARY KEY,
	idempresa   INT NULL,
	idpersona	INT NULL,
	direccion  	VARCHAR(60) NULL,
	telefono 	CHAR(9) NOT NULL,
CONSTRAINT fk_idp_cli FOREIGN KEY (idpersona) REFERENCES personas(idpersona),
CONSTRAINT fk_ide_cliente FOREIGN KEY (idempresa) REFERENCES empresas (idempresa)
)
ENGINE = INNODB;

CREATE TABLE empresas
(
idempresa INT AUTO_INCREMENT PRIMARY KEY,
nombre	VARCHAR(30) NOT NULL,
ruc 		CHAR(11) NOT NULL,

CONSTRAINT uk_ruc_emp  UNIQUE (ruc)
)ENGINE = INNODB;

CREATE TABLE contratos
(
idcontrato INT AUTO_INCREMENT PRIMARY KEY,
idcliente 		INT 		NOT NULL,
fechacontrato  DATE 		NOT NULL,
estadocontrato CHAR(1) 	NOT NULL,
CONSTRAINT fk_cli_con FOREIGN KEY (idcliente) REFERENCES clientes(idcliente)
)ENGINE = INNODB;

CREATE TABLE servicios
(
idservicio INT AUTO_INCREMENT 		PRIMARY KEY,
tiposervicio   		VARCHAR (100) 	NOT NULL,
duracionE		 		VARCHAR(20)		NOT NULL,
garantia 				VARCHAR(20) 	NOT NULL,
estado 					CHAR(1) 			NOT NULL DEFAULT '1'
)ENGINE = INNODB;


CREATE TABLE desc_servicio
(
iddesc INT AUTO_INCREMENT PRIMARY KEY,
idservicio 		INT 	NOT NULL,
idcontrato		INT 	NOT NULL,
numrepuesto		VARCHAR(10) NOT NULL,

CONSTRAINT fk_ser_desc FOREIGN KEY (idservicio) REFERENCES servicios(idservicio),
CONSTRAINT fk_con_desc FOREIGN KEY (idcontrato) REFERENCES contratos(idcontrato)
)ENGINE = INNODB;

CREATE TABLE equipo_serie
(
idequiposerie INT AUTO_INCREMENT PRIMARY KEY,
iddesc	INT 	NOT NULL,
idequipo INT 	NOT NULL,
numeroserie VARCHAR(30) NOT NULL,

CONSTRAINT fk_des_equ FOREIGN KEY (iddesc) REFERENCES desc_servicio(iddesc),
CONSTRAINT fk_equ_equ FOREIGN KEY (idequipo) REFERENCES equipos(idequipo)
)ENGINE = INNODB;

CREATE TABLE equipos
(
	idequipo	INT AUTO_INCREMENT PRIMARY KEY,
	tipoR 		VARCHAR(60) NOT NULL,
	nombre		VARCHAR(100) NOT NULL,
	stock 		SMALLINT		 NOT NULL,
	precio		DECIMAL(7,2) NOT NULL,
	modelo		VARCHAR(50) NOT NULL,
	marca			VARCHAR(20) NOT NULL,
	descripcion	VARCHAR(100) NULL,
	estado 		CHAR(1) NOT NULL DEFAULT '1',
	CONSTRAINT uk_nom_re UNIQUE(nombre),
	CONSTRAINT uk_mol_re UNIQUE(modelo, marca),
	CONSTRAINT ck_pre_re CHECK(precio > 0)
)ENGINE  = INNODB;

