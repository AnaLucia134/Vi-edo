<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "envero";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        header("Location: error.html");
        exit();
    }

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $servicio = $_POST['servicio'];
    $fecha_reservacion = $_POST['trip-start'];

    $sql = "INSERT INTO reservacion (nombre, correo, servicio, fecha_reservacion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $correo, $servicio, $fecha_reservacion);

    if ($stmt->execute()) {
        header("Location: realizado.html");
        exit();
    } else {
        header("Location: error.html");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: error.html");
    exit();
}
?>
