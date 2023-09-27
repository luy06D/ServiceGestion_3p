CREATE DATABASE DB_3P;
USE DB_3P;



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
(2,2,8000,3,'N');

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
(2,3,'nada que decir');

ALTER TABLE equipos ADD numSerie VARCHAR(50) NOT NULL;



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

ALTER TABLE desc_equipo DROP numSerie;

INSERT INTO desc_equipo(idequipo, iddescServicio, numSerie, precio)VALUES
(1,2,'84565214253',350),
(2,2,'96532145875',200);





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

	
CALL spu_servicios_update(6, 'Reparacion', 'Reparacion de Laptop', 30)


-- SPU BUSCAR PERSONAS --
DELIMITER $$
CREATE PROCEDURE spu_buscar_persona(IN _dni CHAR(8))
BEGIN
SELECT
	idpersona,
	nombres,
	apellidos
	
FROM personas
WHERE dni = _dni;
END $$
CALL spu_buscar_persona('97643128');



-- SPU USUARIO --
DELIMITER$$
CREATE PROCEDURE spu_user_login(IN _usuario VARCHAR(30))
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
END$$


-- REGISTRAR NUEVO USUARIO --
DELIMITER $$
CREATE PROCEDURE spu_usuario_registrar 
(

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

END$$

CALL spu_usuario_registrar ('Antonio','Torres Feijo','79461340','antonio@gmail.com','Chincha','987654321','anton10','123456','E');


-- REGGISTRAR USUARIO POR IDPERSONA
DELIMITER $$
CREATE PROCEDURE spu_register_userid
(
	IN _idpersona INT,
	IN _usuario	VARCHAR(100),
	IN _claveacceso	VARCHAR(100),
	IN _nivelacceso CHAR(1)
)
BEGIN
INSERT INTO usuarios (idpersona, usuario, claveacceso, nivelacceso) VALUES
	(_idpersona, _usuario, _claveacceso, _nivelacceso);
END $$


-- SPU  REGISTRAR EQUIPOS --

-- SPU  REGISTRAR EQUIPOS --
DELIMITER $$
CREATE PROCEDURE spu_equipo_registrar
(
	IN _idtipoequipo	INT,
	IN _idmarca		INT,
	IN _descripcion		VARCHAR(100),
	IN _numSerie 		VARCHAR(50)
)
BEGIN
	INSERT INTO equipos (idtipoequipo, idmarca, descripcion, numSerie)
		VALUES (_idtipoequipo, _idmarca, _descripcion, _numSerie);
END$$
	
CALL spu_equipo_registrar('1', '2', '8 canales full HD','5689SAD566ASD9AS63df');



-- ACTUALIZAR EQUIPOS
DELIMITER $$
CREATE PROCEDURE spu_equipos_actualizar
(
	IN _idequipo	INT,
	IN _idtipoequipo INT,
	IN _idmarca	INT,
	IN _descripción	VARCHAR(100),
	IN _numSerie  VARCHAR(50)
)
BEGIN 
	UPDATE equipos SET
		idtipoequipo = _idtipoequipo,
		idmarca  = _idmarca,
		descripcion = _descripcion,
		numSerie = _numSerie
	WHERE idequipo = _idequipo;
END $$
CALL spu_equipos_actualizar(2,1,6,'Teclado completo','asd265968563Ddsa6')



-- LISTAR EQUIPOS
DELIMITER $$ 
CREATE PROCEDURE spu_equipos_listar()
BEGIN
	SELECT idequipo , tipoequipo, marca ,descripcion,numSerie
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


-- SPU BUSCAR TIPO E
DELIMITER $$
CREATE PROCEDURE spu_buscar_tipoe(IN _tipoequipo VARCHAR(30))
BEGIN
SELECT
	idtipoequipo,
	tipoequipo
FROM tipoequipo
WHERE tipoequipo = _tipoequipo;
END $$
CALL spu_buscar_tipoe('pantalla lcd');


-- ACTIVAR TIPO E--
DELIMITER $$
CREATE PROCEDURE spu_activar_tipo
(
	IN _idtipoequipo INT
)
BEGIN
	UPDATE tipoequipo SET
		inactive_at = NULL
	WHERE idtipoequipo = _idtipoequipo;
END $$
CALL spu_activar_tipo(5)


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

-- recuperar equipos --
DELIMITER $$
CREATE PROCEDURE spu_equipos_recuperar()
BEGIN
	SELECT idequipo, tipoequipo
	FROM equipos
	INNER JOIN tipoequipo ON tipoequipo.idtipoequipo = equipos.idtipoequipo
	WHERE equipos.inactive_at IS NULL;
END $$

CALL spu_equipos_recuperar()





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
				
END $$


CALL spu_contrato_registrar(1, 2, "2023-09-14", "Prueba2 de procedimiento", "1 meses", 3 , 300, 5);


DELIMITER $$
CREATE PROCEDURE spu_contratos_listar()
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

CALL spu_detalleContratos_listar(2);

-- FINALIZAR EL CONTRATO

DELIMITER $$
CREATE PROCEDURE spu_finalizarContrato
(
IN _idcontrato INT,
IN _fechacierre DATE
)
BEGIN
		UPDATE contratos SET fechacierre = _fechacierre
		WHERE idcontrato = _idcontrato;
		
		UPDATE desc_servicio SET estadoservicio = 'F'
		WHERE idcontrato = _idcontrato;
		
END $$

CALL spu_finalizarContrato(1, '2023-09-24');

-- BUSCAR CLIENTES
DELIMITER $$
CREATE PROCEDURE spu_clientes_buscar(IN _search VARCHAR(100))
BEGIN 
	SELECT
		CLI.idcliente,
	    COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes
	FROM clientes CLI
	LEFT JOIN personas PE ON CLI.idpersona = PE.idpersona
	LEFT JOIN empresas EM ON CLI.idempresa = EM.idempresa
	WHERE COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) LIKE CONCAT('%', _search, '%');
END$$

CALL spu_clientes_buscar("fa");


-- FILTRO DE CONTRATO POR CLIENTE 
DELIMITER $$
CREATE PROCEDURE spu_filtroC_cliente(IN _idcliente INT)
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

END $$

CALL spu_filtroC_cliente(1);







-- EVENTO PARA ACTUALIZAR ESTADO A PROCESO
-- AUTOMATICO

DELIMITER $$
CREATE EVENT actualizarEstadoProceso
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
BEGIN 
	UPDATE desc_servicio DS
	INNER JOIN contratos CO ON DS.idcontrato = CO.idcontrato	
	SET DS.estadoservicio = 'P'
	WHERE CO.fechainicio = CURDATE();

END $$

-- Habilita el programador de eventos
SHOW VARIABLES LIKE 'event_scheduler';
SET GLOBAL event_scheduler = ON;


DELIMITER $$
CREATE PROCEDURE spu_garantia_listar()
BEGIN
SELECT  idgarantia, servicios.nombreservicio, CONCAT(personas.apellidos, ' ', personas.nombres) AS Tecnico, fechaAveria, fechaEjecucion, problemadetectado, solucion, estadogarantia, inSitu
FROM garantia
INNER JOIN desc_servicio ON desc_servicio.iddescServicio = garantia.iddescServicio
INNER JOIN servicios ON servicios.idservicio = desc_servicio.idservicio
INNER JOIN usuarios ON usuarios.idusuario = garantia.idsoporteTecnico
INNER JOIN personas ON personas.idpersona = usuarios.idusuario
ORDER BY idgarantia DESC;
END$$

CALL spu_garantia_listar

SELECT * FROM usuarios
ALTER TABLE garantia MODIFY estadogarantia CHAR(1) NOT NULL DEFAULT 'N'

DELIMITER $$ 
CREATE PROCEDURE spu_registrar_garantia
(
IN _iddescServicio INT,
IN _idSoporteTecnico INT,
IN _fechaAveria	DATE,
IN _fechaEjecucion DATE,
IN _problemadetectado VARCHAR(150),
IN _solucion VARCHAR(150),
IN _inSitu VARCHAR(50)
)
BEGIN 

	INSERT INTO garantia (iddescServicio, idSoporteTecnico, fechaAveria, fechaEjecucion, problemadetectado, solucion, inSitu)VALUES
	(_iddescServicio, _idSoporteTecnico, _fechaAveria, _fechaEjecucion, _problemadetectado, _solucion, _inSitu);
END$$

CALL spu_registrar_garantia()





DELIMITER $$
CREATE PROCEDURE spu_clientes_garantia(IN _search VARCHAR(100))
BEGIN 
	SELECT
		CLI.idcliente,
	    COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes
	FROM clientes CLI
	LEFT JOIN personas PE ON CLI.idpersona = PE.idpersona
	LEFT JOIN empresas EM ON CLI.idempresa = EM.idempresa
	WHERE COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) LIKE CONCAT('%', _search, '%');
END$$


DELIMITER $$
CREATE PROCEDURE spu_filtroG_cliente(IN _idcliente INT)
BEGIN 

	SELECT 
	 COALESCE(EM.razonsocial, CONCAT(PE.nombres , ' ' , PE.apellidos)) AS clientes,
		SE.nombreservicio, CONCAT(PE.nombres, ' ', PE.apellidos)AS Tecnico,
		GA.fechaAveria,GA.fechaEjecucion , GA.problemadetectado,  GA.solucion, GA.inSitu
	FROM garantia GA
	INNER JOIN desc_servicio DE ON DE.iddescServicio = GA.iddescServicio
	INNER JOIN servicios SE ON SE.idservicio = DE.idservicio
	INNER JOIN contratos CO ON CO.idcontrato = DE.idcontrato
	INNER JOIN clientes CLI ON CLI.idcliente = CO.idcliente
	LEFT JOIN personas PE ON PE.idpersona = CLI.idpersona
	LEFT JOIN empresas EM ON EM.idempresa = CLI.idempresa
	WHERE CLI.idcliente = _idcliente;

END $$

CALL spu_filtroG_cliente(1)

SELECT * FROM garantia



