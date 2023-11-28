<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS hospital";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("hospital");

// Create table
$sql = "CREATE TABLE HABITACION (
    ID_Habitacion INT NOT NULL AUTO_INCREMENT,
    Numero INT,
    Tipo VARCHAR(50),
    Estado VARCHAR(50),
    ID_Paciente INT,
    ID_Medico INT,
    PRIMARY KEY (ID_Habitacion),
    FOREIGN KEY (ID_Paciente) REFERENCES PACIENTES(ID_Paciente),
    FOREIGN KEY (ID_Medico) REFERENCES MEDICO(ID_Medico)
);

CREATE TABLE PACIENTES (
    ID_Paciente INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(50),
    Apellido VARCHAR(50),
    Edad INT,
    Genero VARCHAR(20),
    Direccion VARCHAR(100),
    ID_Habitacion INT,
    Fecha_Ingreso DATE,
    Fecha_Alta DATE,
    PRIMARY KEY (ID_Paciente),
    FOREIGN KEY (ID_Habitacion) REFERENCES HABITACION(ID_Habitacion)
);

CREATE TABLE MEDICO (
    ID_Medico INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(50),
    Especialidad VARCHAR(50),
    Telefono VARCHAR(20),
    Correo VARCHAR(100),
    PRIMARY KEY (ID_Medico)
);

CREATE TABLE PRODUCTOS (
    ID_Producto INT NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(50),
    Descripcion TEXT,
    Precio DECIMAL(10, 2),
    Cantidad_Disponible INT,
    PRIMARY KEY (ID_Producto)
);

CREATE TABLE TICKET_PRODUCTOS (
    ID_Ticket INT NOT NULL AUTO_INCREMENT,
    ID_Habitacion INT,
    ID_Paciente INT,
    Fecha DATE,
    Total DECIMAL(10, 2),
    ID_Producto INT,
    Cantidad INT,
    PRIMARY KEY (ID_Ticket),
    FOREIGN KEY (ID_Habitacion) REFERENCES HABITACION(ID_Habitacion),
    FOREIGN KEY (ID_Paciente) REFERENCES PACIENTES(ID_Paciente),
    FOREIGN KEY (ID_Producto) REFERENCES PRODUCTOS(ID_Producto)
);
";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Insert data into the table
$sql = "INSERT INTO HABITACION (Numero, Tipo, Estado, ID_Paciente, ID_Medico) VALUES
(101, 'Individual', 'Disponible', NULL, 1),
(102, 'Doble', 'Ocupada', 3, 2),
(103, 'Suite', 'Disponible', 2, NULL),
(104, 'Individual', 'Limpieza', NULL, NULL),
(105, 'Suite', 'Disponible', 4, 1);

-- Datos para la tabla PACIENTES
INSERT INTO PACIENTES (Nombre, Apellido, Edad, Género, Dirección, ID_Habitacion, Fecha_Ingreso, Fecha_Alta) VALUES
('Ana', 'García', 45, 'Femenino', 'Calle 123', NULL, '2023-01-10', '2023-01-25'),
('Juan', 'López', 30, 'Masculino', 'Av. Principal', 3, '2023-02-05', '2023-02-20'),
('María', 'Pérez', 55, 'Femenino', 'Plaza Mayor', 2, '2023-03-15', NULL),
('Carlos', 'Martínez', 28, 'Masculino', 'Callejón 45', 5, '2023-04-20', NULL),
('Sofia', 'Rodriguez', 60, 'Femenino', 'Av. Central', NULL, '2023-05-12', NULL);

-- Datos para la tabla MEDICO
INSERT INTO MEDICO (Nombre, Especialidad, Teléfono, Correo) VALUES
('Dr. López', 'Cardiología', '123456789', 'drlopez@email.com'),
('Dra. Martínez', 'Pediatría', '987654321', 'drmartinez@email.com'),
('Dr. García', 'Neurología', '111222333', 'drgarcia@email.com'),
('Dra. Rodríguez', 'Oncología', '444555666', 'drrodriguez@email.com'),
('Dr. Pérez', 'Traumatología', '777888999', 'drperez@email.com');

-- Datos para la tabla PRODUCTOS
INSERT INTO PRODUCTOS (Nombre, Descripción, Precio, Cantidad_Disponible) VALUES
('Analgésico', 'Alivia dolores leves', 10.50, 100),
('Antibiótico', 'Trata infecciones', 20.25, 75),
('Vendaje', 'Para curaciones', 5.75, 200),
('Jeringa', 'Administración de medicamentos', 3.00, 150),
('Alcohol', 'Desinfectante', 7.80, 120);

-- Datos para la tabla TICKET_PRODUCTOS
INSERT INTO TICKET_PRODUCTOS (ID_Habitacion, ID_Paciente, Fecha, Total, ID_Producto, Cantidad) VALUES
(2, 3, '2023-01-15', 50.25, 1, 2),
(3, 2, '2023-02-10', 15.50, 3, 5),
(5, 4, '2023-03-20', 30.75, 2, 3),
(1, NULL, '2023-04-25', 27.00, 4, 10),
(4, NULL, '2023-05-15', 10.50, 5, 1);
";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$conn->close();
