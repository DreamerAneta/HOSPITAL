<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el número de habitación enviado por GET
if (isset($_GET['habitacion'])) {
    $habitacion = $_GET['habitacion'];

    // Consulta SQL para obtener la información del ticket según la ID de la habitación
    $sql = "SELECT HABITACIONES.Id_Habitacion, PACIENTES.Nombre AS NombrePaciente, MEDICO.Nombre AS NombreMedico, TICKETS.Id_Ticket, DETALLES.Id_Producto, PRODUCTOS.Nombre AS NombreProducto, DETALLES.Cantidad, DETALLES.Precio, SUM(TICKETS.Total) AS Total
    FROM HABITACIONES
    INNER JOIN PACIENTES ON HABITACIONES.Id_Paciente = PACIENTES.Id_Paciente
    INNER JOIN MEDICO ON HABITACIONES.Id_Medico = MEDICO.Id_Medico
    INNER JOIN TICKETS ON HABITACIONES.Id_Habitacion = TICKETS.Id_Habitacion
    INNER JOIN DETALLES ON TICKETS.Id_Ticket = DETALLES.Id_Ticket
    INNER JOIN PRODUCTOS ON DETALLES.Id_Producto = PRODUCTOS.Id_Producto
    WHERE HABITACIONES.Id_Habitacion = $habitacion
    GROUP BY TICKETS.Id_Ticket";

    $result = $conn->query($sql); // Ejecutar la consulta SQL

    if ($result !== false && $result->num_rows > 0) {
        $ticketHTML = "<h2>Ticket</h2>";
        while ($row = $result->fetch_assoc()) {
            $ticketHTML .= "<p>ID Ticket: " . $row["Id_Ticket"] . "</p>";
            $ticketHTML .= "<p>Nombre del Paciente: " . $row["NombrePaciente"] . "</p>";
            $ticketHTML .= "<p>Nombre del Médico: " . $row["NombreMedico"] . "</p>";
            $ticketHTML .= "<h3>Detalles del Ticket</h3>";
            $ticketHTML .= "<ul>";
            $ticketHTML .= "<li>" . $row["NombreProducto"] . " - Cantidad: " . $row["Cantidad"] . " - Precio: $" . $row["Precio"] . "</li>";
            // Puedes continuar agregando más detalles si hay varios productos en el ticket
            $ticketHTML .= "</ul>";
            $ticketHTML .= "<p>Total: $" . $row["Total"] . "</p>";
        }
        echo $ticketHTML;
    } else {
        echo "No hay datos para mostrar.";
    }
} else {
    echo "No se ha especificado una habitación.";
}

$conn->close();
?>
