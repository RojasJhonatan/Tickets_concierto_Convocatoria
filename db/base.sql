CREATE DATABASE IF NOT EXISTS MVC_Tickets_eventos;
USE MVC_Tickets_eventos;

/* Tabla para almacenar la información de los eventos */
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fecha_hora Datetime NOT NULL,
    lugar VARCHAR(100) NOT NULL,
    capacidad_max int(10) NOT NULL,
    precio_base INT(10) NOT NULL
);

/* Tabla para almacenar la información de los usuarios */
CREATE TABLE usuarios(
     id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    rol VARCHAR(20)
);

/* Tabla para almacenar la información de los tickets */
CREATE TABLE tickets(
    id INT AUTO_INCREMENT PRIMARY KEY,
    evento_id INT NOT NULL,
    usuario_id INT NOT NULL,
    codigo INT NOT NULL UNIQUE,
    fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(20) DEFAULT "pagado",
    FOREIGN KEY (evento_id) REFERENCES eventos(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON DELETE RESTRICT ON UPDATE CASCADE
);
