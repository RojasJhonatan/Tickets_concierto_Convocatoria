<?php
include("../modelo/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización básica
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $direccion = trim($_POST['direccion']);
    $rol = $_POST['rol']

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo inválido.");
    }

    // Encriptar contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Usar consulta preparada
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, telefono, email, password, direccion, rol) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("sss", $nombre, $telefono $email, $passwordHash, $direccion, rol);
    """

    if ($stmt->execute()) {
        header("Location: ../vistas/listaUsuarios.php");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>