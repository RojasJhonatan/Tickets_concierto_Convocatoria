<?php
include_once '../modelo/conexion.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $conn->prepare(
        "DELETE FROM tickets WHERE id=?"
    );

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../vista/listaTickets.php");
        exit();
    }

    echo "Error al eliminar.";
}
?>
