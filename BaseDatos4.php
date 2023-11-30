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
$sql = "CREATE TABLE MEDICO (
    Id_Medico INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Especialidad VARCHAR(100)
);

";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE PACIENTES (
    Id_Paciente INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Edad INT,
    Direccion VARCHAR(255),
    Telefono VARCHAR(20)
);
";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE HABITACIONES (
    Id_Habitacion INT PRIMARY KEY,
    Id_Paciente INT,
    Id_Medico INT,
    FOREIGN KEY (Id_Paciente) REFERENCES PACIENTES(Id_Paciente),
    FOREIGN KEY (Id_Medico) REFERENCES MEDICO(Id_Medico)
);


";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql = "CREATE TABLE PRODUCTOS (
    Id_Producto INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Precio DECIMAL(10, 2)
);
";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql = "CREATE TABLE TICKETS (
    Id_Ticket INT PRIMARY KEY,
    Id_Habitacion INT,
    Total DECIMAL(10, 2),
    FOREIGN KEY (Id_Habitacion) REFERENCES HABITACIONES(Id_Habitacion),

);
";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql = "CREATE TABLE DETALLES (
    Id_Detalle INT PRIMARY KEY,
    Id_Ticket INT,
    Id_Producto INT,
    Cantidad INT,
    Precio DECIMAL(10, 2),
    FOREIGN KEY (Id_Ticket) REFERENCES TICKETS(Id_Ticket),
    FOREIGN KEY (Id_Producto) REFERENCES PRODUCTOS(Id_Producto)
);
";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql = "INSERT INTO MEDICO (Id_Medico, Nombre, Especialidad)
VALUES
    (1, 'Dr. García', 'Cardiología'),
    (2, 'Dr. Martínez', 'Neurología'),
    (3, 'Dr. Rodríguez', 'Pediatría'),
    (4, 'Dra. López', 'Dermatología'),
    (5, 'Dr. Fernández', 'Oftalmología');
    ";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$sql = "INSERT INTO PACIENTES (Id_Paciente, Nombre, Edad, Direccion, Telefono)
VALUES
    (1, 'María González', 45, 'Calle Principal 123', '555-1234'),
    (2, 'Juan Pérez', 30, 'Avenida Central 456', '555-5678'),
    (3, 'Ana Rodríguez', 22, 'Calle Secundaria 789', '555-9012'),
    (4, 'Pedro Martínez', 50, 'Paseo de la Montaña 210', '555-3456'),
    (5, 'Laura Díaz', 28, 'Avenida del Río 15', '555-7890');
        ";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$sql = "INSERT INTO HABITACIONES (Id_Habitacion, Id_Paciente, Id_Medico)
VALUES
    (1, 1, 2),
    (2, 3, 4),
    (3, 2, 1),
    (4, 4, 3),
    (5, 5, 5);
        ";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$sql = "INSERT INTO TICKETS (Id_Ticket, Id_Habitacion, Total)
VALUES
    (1, 1, 150.50),
    (2, 2, 200.75),
    (3, 3, 180.00),
    (4, 4, 300.25),
    (5, 5, 250.00);
        ";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$sql = "INSERT INTO PRODUCTOS (Id_Producto, Nombre, Precio)
VALUES
    (101, 'Aspirina', 25.00),
    (102, 'Analgésico', 100.00),
    (103, 'Vendaje', 10.00),
    (104, 'Antiséptico', 5.00),
    (105, 'Antibiótico', 62.50);

";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}

$sql = "INSERT INTO DETALLES (Id_Detalle, Id_Ticket, Id_Producto, Cantidad, Precio)
VALUES
    (1, 1, 101, 2, 50.25),
    (2, 2, 102, 1, 100.50),
    (3, 3, 103, 3, 30.00),
    (4, 4, 104, 4, 25.25),
    (5, 5, 105, 2, 125.00);
        ";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}



$conn->close();
