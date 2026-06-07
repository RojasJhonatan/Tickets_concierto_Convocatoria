<?php
/* Validamos que se haya pasado un ID */
if (isset($_GET['id'])) {
    include_once '../modelo/conexion.php';
    
    /* Obtenemos el ID del evento a eliminar */
    $id = $_GET['id'];

    // Sentencia preparada para DELETE con MySQLi
    $stmt = $conn->prepare("DELETE FROM eventos WHERE id = ?");
    $stmt->bind_param("i", $id);

    /* Ejecutamos la sentencia y luego redirigimos a la lista */
    if ($stmt->execute()) {
        header("Location: ../vista/listaEventos.php");
        exit();
    } else {
        echo "Error al eliminar el evento. Nota: si un ticket ya usa este evento, no te dejará borrarlo por la restricción de la llave foránea.";
    }
    $stmt->close();
}
?>