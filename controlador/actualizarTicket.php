<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include_once '../modelo/conexion.php';

    $id = $_POST['id'];
    $evento_id = $_POST['evento_id'];
    $usuario_id = $_POST['usuario_id'];
    $codigo = $_POST['codigo'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare(
        "UPDATE tickets
         SET evento_id=?, usuario_id=?, codigo=?, estado=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "iiisi",
        $evento_id,
        $usuario_id,
        $codigo,
        $estado,
        $id
    );

    if ($stmt->execute()) {
        header("Location: ../vista/listaTickets.php");
        exit();
    }

    echo "Error: " . $stmt->error;
}
?>
