CREATE DATABASE DB_3P

USE  DB_3P


CREATE TABLE personas 
(
idpersona 		INT AUTO_INCREMENT PRIMARY KEY,
nombres 		VARCHAR(30) 		NOT NULL,
apellidos 		VARCHAR(30) 		NOT NULL,
dni			CHAR(9) 		NOT NULL,
correo   		VARCHAR(40) 		NOT NULL,
genero 			CHAR(1) 		NOT NULL,

CONSTRAINT uk_dni_per  UNIQUE (dni),
CONSTRAINT ck_ge_per CHECK( genero IN ('M', 'F'))
)
ENGINE = INNODB

INSERT INTO personas (nombres, apellidos , dni, correo, genero) VALUES
		('Luis David','Cusi Gonzales',73196921,'cusiluis04@gmail.com','M');


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

ALTER TABLE clientes ADD estado CHAR(1)NOT NULL DEFAULT '1';

INSERT INTO clientes (idempresa, idpersona, direccion ,telefono) VALUES
		(1, NULL ,'Calle Oscar R.BuenaVista' , 965476454);
		
INSERT INTO clientes (idempresa, idpersona, direccion ,telefono) VALUES
		(NULL, 1 ,'Calle Oscar R.Benavides' , 965476254);
		



DROP TABLE empresas
(
idempresa INT AUTO_INCREMENT PRIMARY KEY,
nombre	VARCHAR(30) NOT NULL,
ruc 		CHAR(11) NOT NULL,

CONSTRAINT uk_ruc_emp  UNIQUE (ruc)
)ENGINE = INNODB;


INSERT INTO empresas (nombre , ruc) VALUES 
	('Grupo Cafimi', 10125436576);

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


-- PROCEDIMIENTOS MODULO CLIENTES

-- LISTAR CLIENTES PERSONAS/EMPRESAS

DELIMITER $$
CREATE PROCEDURE spu_clientes_listar()
BEGIN 
	SELECT
		CLI.idcliente,
	    COALESCE(EM.nombre, PE.nombres) AS cliente,
	    COALESCE(EM.ruc, PE.dni) AS identidad,
	    CLI.direccion,
	    CLI.telefono
	FROM clientes CLI
	LEFT JOIN personas PE ON CLI.idpersona = PE.idpersona
	LEFT JOIN empresas EM ON CLI.idempresa = EM.idempresa;

END $$

CALL spu_clientes_listar();

-- REGISTRAR PERSONAS COMO CLIENTE
DELIMITER $$ 
CREATE PROCEDURE spu_clientesPer_registrar
(
-- param persona
IN _nombres VARCHAR(30),
IN _apellidos VARCHAR(30),
IN _dni  CHAR(9),
IN _correo VARCHAR(40),
IN _genero CHAR(1),

-- param cliente
IN _direccion VARCHAR(60),
IN _telefono  CHAR(9)
)
BEGIN 

	DECLARE g_idpersona INT;
	
	INSERT INTO personas (nombres, apellidos, dni , correo, genero) VALUES
						(_nombres, _apellidos, _dni, _correo, _genero);
	
	SELECT LAST_INSERT_ID() INTO g_idpersona;

	INSERT INTO clientes (idpersona, direccion, telefono) VALUES
			(g_idpersona, _direccion , _telefono);

END $$

CALL spu_clientesPer_registrar("Lucio","Herrera", 76576825 ,"Llucio02@gmail.com","M","Chincha Alta", 965654565);

SELECT * FROM empresas
SELECT * FROM clientes



-- REGISTRAR EMPRESA COMO CLIENTE
DELIMITER $$ 
CREATE PROCEDURE spu_clientesEmp_registrar
(
-- param empresa
IN _nombre VARCHAR(30),
IN _ruc    CHAR(11),

-- param cliente
IN _direccion VARCHAR(60),
IN _telefono  CHAR(9)
)
BEGIN 

	DECLARE g_idempresa INT;
	
	INSERT INTO empresas (nombre, ruc) VALUES
						(_nombre, _ruc);
	
	SELECT LAST_INSERT_ID() INTO g_idempresa;

	INSERT INTO clientes (idempresa, direccion, telefono) VALUES
			(g_idempresa, _direccion , _telefono);
END $$

CALL spu_clientesEmp_registrar("Avicola vania", 11323235454, "Av.centenario", 943425435);



-- ELIMINAR CLIENTE

DELIMITER $$
CREATE PROCEDURE spu_clientes_delete(IN _idcliente INT)
BEGIN 
	UPDATE clientes SET 
	estado = 0
	WHERE idcliente = _idcliente;
	
END $$

CALL spu_clientes_delete();





















DELIMITER $$
CREATE PROCEDURE spu_servicios_listar()
BEGIN 
	SELECT idservicio, tiposervicio, duracionE, garantia
	FROM servicios
	WHERE estado = 1;
END$$

CALL spu_servicios_listar

INSERT INTO servicios (tiposervicio, duracionE, garantia)VALUES
('Mantenimiento', '3 dias', '1 año')


DELIMITER$$
CREATE PROCEDURE spu_servicios_registrar
(
IN _tiposervicio VARCHAR(100),
IN _duracionE VARCHAR(20),
IN _garantia VARCHAR(20)
)
BEGIN
	INSERT INTO servicios(tiposervicio, duracionE, garantia)VALUES
	(_tiposervicio, _duracionE, _garantia);
END$$

CALL spu_servicios_registrar('Reparacion', '2 dias', '2 meses')