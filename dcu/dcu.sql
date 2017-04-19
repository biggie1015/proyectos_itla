CREATE TABLE profesor(

id_profesor INT NOT NULL AUTO_INCREMENT,
	Correo VARCHAR(60),
	Contrasena VARCHAR(60),
	PRIMARY KEY (id_profesor)

);

INSERT INTO profesor 
VALUES(NULL,'ismel.com','hola');




CREATE TABLE fotos(

	id_foto INT NOT NULL AUTO_INCREMENT,
	ruta_foto TEXT,
    id_anuncio INT NOT NULL,
	PRIMARY KEY(id_foto)

);
ALTER TABLE FOTOS
ADD CONSTRAINT fk_anuncio
FOREIGN KEY(id_anuncio)
REFERENCES anuncios(id_anuncio);

ALTER TABLE profesor 
ADD id_estu INT NOT NULL
AFTER Correo;


INSERT INTO materias
VALUES(2,'Programacion Web','19:00:00',2,2);

INSERT INTO materias
VALUES(2,'Programacion 3','05:00:00',1,2);

INSERT INTO materias
VALUES(3,'Matematica','17:20:00',2,1);


CREATE TABLE estudiantes(

    id_estu INT NOT NULL AUTO_INCREMENT,
	nombre_estu VARCHAR(25),
	PRIMARY KEY (id_estu)
	
);
1 	issac@hotmail.com 	2 	pollito
2 	Willys@itla.com 	1	hola 	
3 	ismel.com 	0 	hola

SELECT nombre_estu,nombre_materia
FROM estudiantes as est
INNER JOIN materias AS mat
ON est.id_materia = mat.id_materias WHERE id_materias =2;

ALTER TABLE anuncios
ADD fk_anuncio INT NOT NULL
AFTER precio;



ALTER TABLE anuncios
ADD CONSTRAINT fk_anuncios
FOREIGN KEY(fk_anuncios)
REFERENCES materias(id_usuario);

INSERT INTO estudiantes
VALUES(NULL,'Ismel','1');
INSERT INTO estudiantes
VALUES(NULL,'Juan','1');
INSERT INTO estudiantes
VALUES(NULL,'Pedro','2');
-- agrgar foreign key a la tabla materias para que haga relacaion con la tabla profesor




ALTER TABLE materias
ADD CONSTRAINT fk_estu
FOREIGN KEY(id_profesor)
REFERENCES profesor(id_profesor);


SELECT nombre_estu
FROM estudiantes
WHERE id_estu = 1;


 SELECT correo,nombre_materia,contrasena
    FROM profesor AS pro
     INNER JOIN materias AS p
     ON pro.id_profesor = p.id_profesor 
	 WHERE correo = 'issac@hotmail.com';

//