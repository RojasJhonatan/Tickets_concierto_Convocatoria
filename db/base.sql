CREATE DATABASE IF NOT EXISTS MVC_Tickets_eventos;
USE MVC_Tickets_eventos;

CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fecha_hora Datetime NOT NULL,
    lugar VARCHAR(100) NOT NULL,
    capacidad_max int(10) NOT NULL,
    precio_base
);
