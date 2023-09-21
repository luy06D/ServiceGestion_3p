CREATE DATABASE DB_3P

USE DB_3P


CREATE TABLE personas
(
idpersona 		INT AUTO_INCREMENT PRIMARY KEY,
nombres 			VARCHAR(50) NOT NULL,
apellidos		VARCHAR(50) NOT NULL,
dni 				CHAR(8)		NOT NULL,
correo 			VARCHAR(50) NULL,
direccion 		VARCHAR(50) NOT NULL,
telefono 		CHAR(9) 		NOT NULL,
create_at 		DATETIME 	NOT NULL DEFAULT NOW(),
update_at		DATETIME 	NULL,
inactive_at		DATETIME		NULL,

CONSTRAINT uk1	UNIQUE (dni)
)ENGINE=INNODB;

INSERT INTO personas(nombres, apellidos, dni, direccion, telefono)VALUES
('Gonzalo','Garcia','75112365','El carmen','962874521'),
('Camilo','Caceres','75412375','El carmen','965874561'),
('Edu','Quiroz','72680725','CP Guayabo','959282307'),
('Jean','Mateo','65985421','Chincha','956854123'),
('Luis','Cusi','75412365','El carmen','965874521')


CREATE TABLE usuarios
(
idusuario INT  AUTO_INCREMENT PRIMARY KEY,
idpersona INT 					NOT NULL,
usuario 		VARCHAR(100) 		NOT NULL,
claveacceso VARCHAR(100) 	NOT NULL,
nivelacceso	CHAR(1) 			NOT NULL,
create_at	DATETIME 		NOT NULL DEFAULT NOW(),
update_at	DATETIME			NULL,
inactive_at	DATETIME 		NULL,

CONSTRAINT fk1	FOREIGN KEY (idpersona) REFERENCES personas(idpersona),
CONSTRAINT uk2 UNIQUE(usuario, idpersona)
)ENGINE=INNODB;

INSERT INTO usuarios(idpersona, usuario, claveacceso, nivelacceso)VALUES
(3, 'eduqcc08', '123456', 'A'),
(1, 'gonzalo','123456', 'E')
()

CREATE TABLE empresas
(
idempresa INT AUTO_INCREMENT PRIMARY KEY,
razonsocial	VARCHAR(100)	NOT NULL,
ruc			CHAR(11)		NOT NULL,
create_at	DATETIME 		NOT NULL DEFAULT NOW(),
update_at	DATETIME			NULL,
inactive_at	DATETIME 		NULL,

CONSTRAINT uk3 UNIQUE (ruc)

)ENGINE=INNODB;

INSERT INTO empresas(razonsocial, ruc)VALUES
('ninguna', '20124569854'),
('ninguna','20354126874'),
('ninguna', '10234568985')

CREATE TABLE clientes
(
idcliente	INT AUTO_INCREMENT PRIMARY KEY,
idpersona	INT  NULL,
idempresa	INT  NULL,
create_at	DATETIME 		NOT NULL DEFAULT NOW(),
update_at	DATETIME			NULL,
inactive_at	DATETIME 		NULL,

CONSTRAINT fk2	FOREIGN KEY (idpersona) REFERENCES personas(idpersona),
CONSTRAINT fk3	FOREIGN KEY (idempresa) REFERENCES empresas(idempresa)
)ENGINE=INNODB;

INSERT INTO clientes(idpersona)VALUES
(4)



CREATE TABLE contratos
(
idcontrato	INT AUTO_INCREMENT PRIMARY KEY,
idusuario	INT NOT NULL,
idcliente	INT NOT NULL,
fechacontrato	DATETIME NOT NULL DEFAULT NOW(),
fechainicio  DATE NOT NULL,
fechacierre		DATE NULL,
observacion	VARCHAR(150) NOT NULL,
garantia 	VARCHAR(20) NOT NULL,

CONSTRAINT fk4	FOREIGN KEY (idcliente) REFERENCES clientes(idcliente),
CONSTRAINT fk5	FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario)
)ENGINE = INNODB;

INSERT INTO contratos(idusuario, idcliente, fechainicio, observacion, garantia)VALUES
(1, 2, '15-09-2023', 'nada que decir', '1 mes'),
(2,1,'18-09-2023', 'nada que decir', '2 semanas')


CREATE TABLE servicios
(
idservicio	INT AUTO_INCREMENT PRIMARY KEY,
tiposervicio	VARCHAR(50) NOT NULL,
nombreservicio	VARCHAR(50) NOT NULL,
precioestimado DECIMAL(7,2) NOT NULL,
create_at	DATETIME	NOT NULL DEFAULT NOW(),
update_at	DATETIME	NULL,
inactive_at	DATETIME NULL,

CONSTRAINT uk4 UNIQUE (tiposervicio, nombreservicio)

)ENGINE=INNODB;

INSERT INTO servicios(tiposervicio, nombreservicio, precioestimado)VALUES
('instalaciones', 'instalacion de camaras', 5000),
('instalacion','instalacion de servidores',6000),
('Mantenimiento', 'mantenimiento de servidores',7000)

CREATE TABLE desc_servicio
(
iddescServicio		INT AUTO_INCREMENT PRIMARY KEY,
idcontrato		INT NOT NULL,
idservicio		INT NOT NULL,
precioservicio	DECIMAL(7,2) NOT NULL,
cantidad   SMALLINT NOT NULL,
estadoservicio		CHAR(1) NOT NULL, -- N=NO INICIADO P= EN PROCESO F=FINALIZADO 
create_at	DATETIME	NOT NULL DEFAULT NOW(),
update_at	DATETIME	NULL,
inactive_at	DATETIME NULL,

CONSTRAINT fk6	FOREIGN KEY (idcontrato) REFERENCES contratos(idcontrato),
CONSTRAINT fk7	FOREIGN KEY (idservicio) REFERENCES servicios(idservicio)
)ENGINE=INNODB;

-- El estado de servicio iniciado es NO INICIADO
ALTER TABLE desc_servicio MODIFY COLUMN 
estadoservicio CHAR(1) NOT NULL DEFAULT 'N';


INSERT INTO desc_servicio(idcontrato, idservicio, precioservicio, cantidad, estadoservicio)VALUES
(1, 1, 6000, 2, 'P'),
(2,2,8000,3,'N')
()

CREATE TABLE garantia
(
idgarantia	INT AUTO_INCREMENT PRIMARY KEY,
iddescServicio	INT NOT NULL,
idSoporteTecnico	INT NOT NULL,
fechaAveria	DATE NOT NULL,
fechaEjecucion	DATE 	NOT NULL,
problemadetectado	VARCHAR(150)  NULL,
solucion 	VARCHAR(150) NULL, -- N=NO INICIADO P= EN PROCESO F=FINALIZADO
estadogarantia CHAR(1)	NOT NULL,
inSitu	VARCHAR(50) NOT NULL,

CONSTRAINT fk8	FOREIGN KEY (iddescServicio) REFERENCES desc_servicio(iddescServicio),
CONSTRAINT fk9	FOREIGN KEY (idSoporteTecnico) REFERENCES usuarios(idusuario)
)ENGINE = INNODB;

INSERT INTO garantia(iddescServicio, idSoporteTecnico, fechaAveria, fechaEjecucion, estadogarantia, inSitu)VALUES
(1, 2, '10-09-2023', '16-09-2023', 'P', 'Local del cliente'),
(2,1,'10-09-2023', '16-09-2023', 'P', 'Local del cliente')


CREATE TABLE tipoequipo
(
idtipoequipo INT AUTO_INCREMENT PRIMARY KEY,
tipoequipo	VARCHAR(30) NOT NULL,
create_at	DATETIME	NOT NULL DEFAULT NOW(),
update_at	DATETIME	NULL,
inactive_at	DATETIME NULL,

CONSTRAINT uk5 UNIQUE (tipoequipo)
)ENGINE = INNODB;

INSERT INTO tipoequipo(tipoequipo)VALUES
('Teclado'),
('Router'),
('Monitor'),
('Mouse'),
('Camaras')

CREATE TABLE marcas
(
idmarca INT AUTO_INCREMENT PRIMARY KEY,
marca	VARCHAR(20) NOT NULL,
create_at	DATETIME	NOT NULL DEFAULT NOW(),
update_at	DATETIME	NULL,
inactive_at	DATETIME NULL,

CONSTRAINT uk6 UNIQUE (marca)
)ENGINE = INNODB;

INSERT INTO marcas(marca)VALUES
('TP Link'),
('Dell'),
('HP')


CREATE TABLE equipos
(
idequipo		INT AUTO_INCREMENT PRIMARY KEY,
idtipoequipo	INT NOT NULL,
idmarca			INT NOT NULL,
descripcion		VARCHAR(100) NOT NULL,

CONSTRAINT fk10	FOREIGN KEY (idtipoequipo) REFERENCES tipoequipo(idtipoequipo),
CONSTRAINT fk11	FOREIGN KEY (idmarca) REFERENCES marcas(idmarca)
)ENGINE = INNODB;

INSERT INTO equipos(idtipoequipo, idmarca, descripcion)VALUES
(1,2,'nada que decir'),
(2,3,'nada que decir')


CREATE TABLE desc_equipo
(
iddescEquipo INT AUTO_INCREMENT PRIMARY KEY,
idequipo	INT NOT NULL,
iddescServicio	INT NOT NULL,
numSerie	VARCHAR(15) NOT NULL,
precio 	DECIMAL(7,2) NOT NULL,

CONSTRAINT fk12	FOREIGN KEY (iddescServicio) REFERENCES desc_servicio(iddescServicio),
CONSTRAINT fk13	FOREIGN KEY (idequipo) REFERENCES equipos(idequipo),
CONSTRAINT uk7 UNIQUE (numSerie)
)ENGINE = INNODB;

INSERT INTO desc_equipo(idequipo, iddescServicio, numSerie, precio)VALUES
(1,2,'84565214253',350),
(2,2,'96532145875',200);


-- PROCEDIMINETOS CONTRATOS >>>>>>>>>>>>>>>

-- REGISTRAR PERSONAS COMO CLIENTE

DELIMITER $$ 
CREATE PROCEDURE spu_clientesPer_registrar
(
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

END $$

CALL spu_clientesPer_registrar("Lucio","Herrera", 76576825 ,"Llucio02@gmail.com","Chincha Alta", 965654565);

SELECT * FROM empresas
SELECT * FROM clientes


-- REGISTRAR EMPRESA COMO CLIENTE
DELIMITER $$ 
CREATE PROCEDURE spu_clientesEmp_registrar
(
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
END $$

CALL spu_clientesEmp_registrar("Avicola vania", 11323235454);


-- GET CLIENTES
DELIMITER $$
CREATE PROCEDURE spu_getClientes()
BEGIN 

	SELECT
		CLI.idcliente,
	    COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes
	FROM clientes CLI
	LEFT JOIN personas PE ON CLI.idpersona = PE.idpersona
	LEFT JOIN empresas EM ON CLI.idempresa = EM.idempresa;


END $$

CALL spu_getClientes();


-- GET SERVICIOS 
DELIMITER $$
CREATE PROCEDURE spu_getServicios()
BEGIN 
	SELECT idservicio, nombreservicio
	FROM servicios;

END $$ 

	

-- REGISTRAR CONTRATO
DELIMITER $$
CREATE PROCEDURE spu_contrato_registrar
(
-- params contratos
IN _idusuario INT,
IN _idcliente INT,
IN _fechainicio DATE,
IN _fechacierre DATE,
IN _observacion VARCHAR(150),
IN _garantia VARCHAR(20),

-- params desc_servicio
IN _idservicio INT,
IN _precioservicio DECIMAL(7,2),
IN _cantidad SMALLINT
)
BEGIN 
	
	DECLARE g_idcontrato INT;
	
	INSERT INTO contratos (idusuario, idcliente , fechainicio, fechacierre, observacion, garantia) VALUES
						(_idusuario, _idcliente, _fechainicio, _fechacierre, _observacion, _garantia);
	
	SELECT LAST_INSERT_ID() INTO g_idcontrato;
	
	INSERT INTO desc_servicio (idcontrato, idservicio, precioservicio, cantidad) VALUES
								(g_idcontrato, _idservicio, _precioservicio, _cantidad);
				
END $$

CALL spu_contrato_registrar(1, 2, "2023-09-14", NULL, "Prueba2 de procedimiento", "1 meses", 3 , 300, 5);


SELECT * FROM desc_servicio

