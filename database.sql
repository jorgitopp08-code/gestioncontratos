CREATE DATABASE empresa;
USE empresa;

CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20),
    nombre VARCHAR(100),
    email VARCHAR(100),
    telefono VARCHAR(20),
    fecha_ingreso DATE,
    tipo_contrato VARCHAR(20)
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    pin VARCHAR(255)
);

INSERT INTO admin (usuario, pin) VALUES ('Jorge Serna', SHA2('1130616741',256));
