<?php
include_once '../modelo/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];

    $stmt = $conn->prepare(
        "UPDATE usuarios
         SET nombre=?, telefono=?, email=?, direccion=?, rol=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "sssssi",
        $nombre,
        $telefono,
        $email,
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
