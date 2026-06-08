<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include_once '../modelo/conexion.php';

    $evento_id = $_POST['evento_id'];
    $usuario_id = $_POST['usuario_id'];
    $codigo = $_POST['codigo'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare(
        "INSERT INTO tickets (evento_id, usuario_id, codigo, estado)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "iiis",
        $evento_id,
        $usuario_id,
        $codigo,
        $estado
    );

    if ($stmt->execute()) {
        header("Location: ../vista/listaTickets.php");
        exit();
    }

    echo "Error: " . $stmt->error;
}
?>
