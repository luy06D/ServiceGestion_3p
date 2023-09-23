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



USE DB_3P


DELIMITER $$
CREATE PROCEDURE spu_servicios_listar()
BEGIN
SELECT idservicio, tiposervicio, nombreservicio, precioestimado
 FROM servicios
 WHERE inactive_at IS NULL;
 END$$

CALL spu_servicios_listar


DELIMITER $$
CREATE PROCEDURE spu_servicios_registrar
(
IN _tiposervicio VARCHAR(50),
IN _nombreservicio VARCHAR(50),
IN _precioestimado DECIMAL(7,2)
)
BEGIN 
	INSERT INTO servicios (tiposervicio, nombreservicio, precioestimado)VALUES
	(_tiposervicio, _nombreservicio, _precioestimado);
	END$$
	
	CALL spu_servicios_registrar('Reparacion', 'reparacion de pc', 50)
	
	
DELIMITER$$
CREATE PROCEDURE spu_servicios_obtener
(IN _idservicio INT)
BEGIN 
SELECT tiposervicio, nombreservicio, precioestimado
FROM servicios
WHERE idservicio = _idservicio;
END$$

CALL spu_servicios_obtener(4)

DELIMITER $$
CREATE PROCEDURE spu_servicios_update
(
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
	END$$


	DELIMITER $$
	create procedure spu_servicios_eliminar (in _idservicio int)
	begin 
			update servicios SET
			inactive_at = now()
			where idservicio = _idservicio;
			end$$

	
	CALL spu_servicios_update(6, 'Reparacion', 'Reparacion de Laptop', 30)
DELETE FROM servicios
USE DB_3P

DELETE FROM desc_servicio

SELECT * FROM servicios
