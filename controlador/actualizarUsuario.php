<?php
session_start();
include_once '../modelo/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idSesion  = $_SESSION['id'] ?? null;
    $rolSesion = $_SESSION['rol'] ?? null; // 1 = Admin, 0 = Cliente

    $idUrl = $_POST['id'] ?? '';
    $id = null;

    if (!empty($idUrl)) {
        $id = $idUrl;
    } else {
        $id = $idSesion;
    }

    if (!$id) {
        die("Error: No se pudo determinar el ID del usuario a actualizar.");
    }

    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $direccion = $_POST['direccion'];
    $rol = (isset($_POST['rol'])) ? $_POST['rol'] : '0';

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo inválido.");
    }

    // Encriptar contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "UPDATE usuarios
         SET nombre=?, telefono=?, email=?, password = ?, direccion=?, rol=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "ssssssi",
        $nombre,
        $telefono,
        $email,
        $passwordHash,
        $direccion,
        $rol,
        $id
    );

    if ($stmt->execute()) {
        header("Location: ../vista/listaUsuarios.php");
        exit();
    }

    echo "Error: " . $stmt->error;
}
?>
