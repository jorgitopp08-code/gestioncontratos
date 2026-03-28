CREATE DATABASE IF NOT EXISTS empresa
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE empresa;

-- Este script recrea las tablas base. Haz respaldo si ya tienes datos.
DROP TABLE IF EXISTS empleados;
DROP TABLE IF EXISTS admin;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    pin VARCHAR(50) NOT NULL
);

INSERT INTO admin (usuario, pin)
VALUES ('admin', '1234');

CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cedula VARCHAR(20) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    fecha_ingreso DATE NOT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    correo VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
