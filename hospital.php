<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 60;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            display: flexbox;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .productos,
        .ticket {
            flex-basis: calc(50% - 20px);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <script>
        function mostrarTicket() {
            var numHabitacion = document.getElementById("numHabitacion").value;
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("ticketDiv").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET", "obtener_ticket.php?habitacion=" + numHabitacion, true);
            xmlhttp.send();
        }
    </script>
</head>

<body>
    <div class="Productos">
        <h1>LISTA DE PRODUCTOS</h1>
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

        // Consulta SQL para obtener los productos
        $sql = "SELECT Id_Producto, Nombre, Precio FROM PRODUCTOS";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                  </tr>";
            // Output de cada fila de datos
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["Id_Producto"] . "</td>
                        <td>" . $row["Nombre"] . "</td>
                        <td>$ " . $row["Precio"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "0 resultados";
        }

        $conn->close();
        ?>
    </div>
    <div class="Ticket">
        <h1>Selecciona el número de habitación:</h1>
        <select id="numHabitacion" onchange="mostrarTicket()">
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hospital";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Consulta SQL para obtener las habitaciones disponibles
            $sql = "SELECT Id_Habitacion FROM HABITACIONES";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["Id_Habitacion"] . "'>Habitación " . $row["Id_Habitacion"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay habitaciones disponibles</option>";
            }

            $conn->close();
            ?>
        </select>
        <div id="ticketDiv">
            <?php include 'obtener_ticket.php'; ?>
        </div>
    </div>
</body>

</html>