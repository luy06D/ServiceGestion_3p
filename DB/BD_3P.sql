CREATE DATABASE DB_3P;




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
(1, 3, '15-09-2023', 'nada que decir', '1 mes')
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
(7, 1, 6000, 2, 'P')
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
(7, 2, '10-09-2023', '16-09-2023', 'P', 'Local del cliente'),
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

SELECT * FROM equipos

CREATE TABLE equipos
(
idequipo		INT AUTO_INCREMENT PRIMARY KEY,
idtipoequipo	INT NOT NULL,
idmarca			INT NOT NULL,
descripcion		VARCHAR(100) NOT NULL,
create_at		DATETIME	NOT NULL DEFAULT NOW(),
update_at		DATETIME	NULL,
inactive_at		DATETIME NULL,
CONSTRAINT fk10	FOREIGN KEY (idtipoequipo) REFERENCES tipoequipo(idtipoequipo),
CONSTRAINT fk11	FOREIGN KEY (idmarca) REFERENCES marcas(idmarca)
)ENGINE = INNODB;

INSERT INTO equipos(idtipoequipo, idmarca, descripcion)VALUES
(1,2,'nada que decir'),
(2,3,'nada que decir')


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
(2,2,'96532145875',200)

SELECT * FROM marcas


-- SPU USUARIO --
DELIMITER$$ 
CREATE PROCEDURE spu_user_login(IN _usuario VARCHAR(30))
BEGIN 

	SELECT 	usuarios.idusuario, 
		personas.apellidos, personas.nombres,
		usuarios.usuario, usuarios.claveacceso

	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	WHERE usuario = _usuario;
END$$

SELECT * FROM usuarios



DELIMITER $$
CREATE PROCEDURE spu_usuario_registrar 
(

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

END$$

CALL spu_usuario_registrar ('Antonio','Torres Feijo','79461340','antonio@gmail.com','Chincha','987654321','anton10','123456','E');

SELECT * FROM usuarios
-- SPU  REGISTRAR EQUIPOS --

DELIMITER $$
CREATE PROCEDURE spu_equipo_registrar
(
	IN _idtipoequipo	INT,
	IN _idmarca		INT,
	IN _descripcion		VARCHAR(100)
)
BEGIN
	INSERT INTO equipos (idtipoequipo, idmarca, descripcion)
		VALUES (_idtipoequipo, _idmarca, _descripcion);
END$$
	
CALL spu_equipo_registrar('1', '2', '8 canales full HD');

-- ACTUALIZAR EQUIPOS

DELIMITER $$
CREATE PROCEDURE spu_equipos_actualizar
(
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
END $$
CALL spu_equipos_actualizar(2,1,6,'Teclado completo')
				-- RECUPERAR EQUIPOS --
DELIMITER $$ 
CREATE PROCEDURE spu_equipos_listar()
BEGIN
	SELECT idequipo , tipoequipo, marca ,descripcion
	FROM  equipos
	INNER JOIN tipoequipo ON tipoequipo.`idtipoequipo` = equipos.`idtipoequipo`
	INNER JOIN marcas ON marcas.`idmarca` = equipos.`idmarca`
	WHERE equipos.inactive_at IS NULL
	ORDER BY idequipo ASC;
END $$

CALL spu_equipos_listar()



-- RECUERAR TIPOS EQUIPOS

DELIMITER $$
CREATE PROCEDURE spu_tipoequip_recuperar()
BEGIN
	SELECT idtipoequipo, tipoequipo
	FROM tipoequipo
	WHERE inactive_at IS NULL;
END $$

CALL spu_tipoequip_recuperar()

-- REGISTRAR TIPOS E
DELIMITER $$
CREATE PROCEDURE spu_tipoequipo_registrar
(
	IN _tipoequipo 	VARCHAR(30)
)
BEGIN
INSERT INTO tipoequipo (tipoequipo)VALUES
	(_tipoequipo);
END $$

-- ACTUALIZAR TIPOS E
DELIMITER $$
CREATE PROCEDURE spu_tipoequip_actualizar
(
	IN _idtipoequipo INT,
	IN _tipoequipo	VARCHAR(30)
)
BEGIN
	UPDATE tipoequipo SET
		tipoequipo = _tipoequipo
	WHERE idtipoequipo = _idtipoequipo;
END $$

CALL spu_tipoequip_actualizar(1,'Teclado Génerico');

-- OBTENER TIPOS E
DELIMITER $$
CREATE PROCEDURE spu_tipoequip_obtener
(
	IN _idtipoequipo INT
)
BEGIN
	SELECT * FROM tipoequipo WHERE idtipoequipo = _idtipoequipo;
END$$

-- ELIMINAR TIPO E

DELIMITER $$
CREATE PROCEDURE spu_tipoequip_eliminar
(
	IN _idtipoequipo INT
)
BEGIN
	UPDATE tipoequipo SET inactive_at = NOW()
	WHERE idtipoequipo = _idtipoequipo;
END $$


-- RECUPERAR MARCAS
DELIMITER $$
CREATE PROCEDURE spu_marcas_recuperar()
BEGIN
	SELECT idmarca, marca
	FROM marcas
	WHERE inactive_at IS NULL;
END $$

CALL spu_marcas_recuperar();

-- REGISTRAR MARCA
DELIMITER $$
CREATE PROCEDURE spu_marca_registrar
(
	IN _marca	VARCHAR(20)
)
BEGIN
	INSERT INTO marcas (marca) VALUES
		(_marca);
END $$


ALTER TABLE marcas AUTO_INCREMENT = 1
CALL spu_marca_registrar('Dahua')

-- ACTUALIZAR MARCA 
DELIMITER $$
CREATE PROCEDURE spu_marca_actualizar
(	
	IN _idmarca	INT,
	IN _marca	VARCHAR(20)
)
BEGIN
	UPDATE marcas SET
		marca = _marca
	WHERE idmarca = _idmarca;
END $$

-- OBTENER MARCA
DELIMITER $$
CREATE PROCEDURE spu_marca_obtener
(
	IN _idmarca INT
)
BEGIN
	SELECT * FROM marcas WHERE idmarca = _idmarca;
END $$

CALL spu_marca_obtener(1)

-- ELIMINAR MARCA
DELIMITER $$
CREATE PROCEDURE spu_marca_eliminar
(
	IN _idmarca INT
)
BEGIN
	UPDATE marcas SET inactive_at = NOW()
	WHERE idmarca = _idmarca;
END $$


-- LISTAR EQUIPOS
DELIMITER $$
CREATE PROCEDURE spu_equipo_listar()
BEGIN
SELECT idequipo,
	tipoequipo,
	marca,
	descripcion
FROM equipos
	INNER JOIN tipoequipo ON tipoequipo.idtipoequipo = equipos.idtipoequipo
	INNER JOIN marcas ON marcas.idmarca = equipos.idmarca
	ORDER BY idequipo DESC;
END $$

CALL spu_equipo_listar()

DELIMITER $$
CREATE PROCEDURE spu_descripcionequipo_listar()
BEGIN
SELECT 	iddescEquipo,
	e

CALL spu_equipo_listar();

SELECT * FROM tipoequipo
SELECT * FROM marcas


END $$

INSERT INTO desc_equipo (idequipo,idDescServicio, numSerie,precio) VALUES
	(1,7,'89562317',105)
SELECT * FROM desc_equipo


DELIMITER $$
CREATE PROCEDURE ListarDescEquipo()
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
END $$
CALL ListarDescEquipo();

DELIMITER $$
CREATE PROCEDURE spu_equipos_recuperar()
BEGIN
	SELECT idequipo, tipoequipo
	FROM equipos
	INNER JOIN tipoequipo ON tipoequipo.idtipoequipo = equipos.idtipoequipo
	WHERE equipos.inactive_at IS NULL;
END $$

CALL spu_equipos_recuperar()

SELECT * FROM equipos
DELETE FROM tipoequipo
ALTER TABLE tipoequipo AUTO_INCREMENT = 1
SELECT * FROM marcas

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


DELIMITER $$
CREATE PROCEDURE spu_contratos_listar()
BEGIN

	SELECT CO.idcontrato,
	 COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes,
	 DATE(CO.fechacontrato) AS fechacontrato,
	 DS.precioservicio, CO.fechainicio, CO.garantia, DS.estadoservicio
	FROM desc_servicio DS
	INNER JOIN contratos CO ON CO.idcontrato = DS.idcontrato
	INNER JOIN clientes CLI ON CLI.idcliente = CO.idcliente
	LEFT JOIN personas PE ON PE.idpersona = CLI.idpersona
	LEFT JOIN empresas EM ON EM.idempresa = CLI.idempresa;

END$$



DELIMITER $$
CREATE PROCEDURE spu_detalleContratos_listar(IN _idcontrato INT)
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

END$$



CALL spu_detalleContratos_listar(1)


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
	CREATE PROCEDURE spu_servicios_eliminar (IN _idservicio INT)
	BEGIN 
			UPDATE servicios SET
			inactive_at = NOW()
			WHERE idservicio = _idservicio;
			END$$
USE DB_3P









SELECT * FROM servicios