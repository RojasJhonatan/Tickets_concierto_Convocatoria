<?php
include("../modelos/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización básica
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo inválido.");
    }


    // Usar consulta preparada
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, telefono, direccion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $direccion);

    if ($stmt->execute()) {
        header("Location: ../vistas/listaContactos.php");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>