CREATE DATABASE neongonz;

USE neongonz;

DROP TABLE Agencias;
CREATE TABLE Agencias (
	id INT(3) AUTO_INCREMENT,
    nombre VARCHAR (100),
    responsable VARCHAR (100),
    PRIMARY KEY(id)
);



DROP TABLE Automoviles;
CREATE TABLE Automoviles(
	economico INT(5),
    idAgencia INT(3),
    
    PRIMARY KEY(economico),
    
    CONSTRAINT fk_automovil FOREIGN KEY (idAgencia)
	REFERENCES Agencias(id)
);

        
DROP TABLE Servicios;
CREATE TABLE Servicios(
	id INT(6) AUTO_INCREMENT,
    idAgencia INT (3),
    costoUnitario decimal(10,2),
    fecha DATE,
    
    PRIMARY KEY(id),
    
	CONSTRAINT fk_servicio FOREIGN KEY (idAgencia)
	REFERENCES Agencias(id)
);

ALTER TABLE Servicios
ADD COLUMN tipo VARCHAR(50);
ALTER TABLE Servicios
ADD COLUMN concepto VARCHAR(100);



DROP TABLE ServicioAutomovil;
CREATE TABLE ServicioAutomovil(
	idServicio INT(6),
    economico INT(5),
    creado_el TIMESTAMP,
    
    PRIMARY KEY (idServicio, economico),
    
    CONSTRAINT fk_servicio_servicio FOREIGN KEY (idServicio)
	REFERENCES Servicios(id),

	CONSTRAINT fk_servicio_automovil FOREIGN KEY (economico)
	REFERENCES Automoviles(economico)
);


