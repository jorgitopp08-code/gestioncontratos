CREATE DATABASE empresa;

USE empresa;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    pin VARCHAR(10)
);

INSERT INTO admin VALUES (1,'admin','1234');

CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20),
    nombre VARCHAR(100),
    fecha_ingreso DATE,
    telefono VARCHAR(20),
    correo VARCHAR(100)
);