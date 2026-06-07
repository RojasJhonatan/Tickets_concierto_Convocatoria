<?php
/* Validamos que sea un post para editar */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../modelo/conexion.php';

    /* Obtenemos los datos del formulario */
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_hora = $_POST['fecha_hora'];
    $lugar = $_POST['lugar'];
    $capacidad_max = $_POST['capacidad_max'];
    $precio_base = $_POST['precio_base'];

    // Sentencia preparada para UPDATE con MySQLi
    $stmt = $conn->prepare("UPDATE eventos SET titulo = ?, descripcion = ?, fecha_hora = ?, lugar = ?, capacidad_max = ?, precio_base = ? WHERE id = ?");
    $stmt->bind_param("ssssiii", $titulo, $descripcion, $fecha_hora, $lugar, $capacidad_max, $precio_base, $id);

    /* Ejecutamos la sentencia y luego redirigimos a la lista */
    if ($stmt->execute()) {
        header("Location: ../vista/listaEventos.php");
        exit();
    } else {
        echo "Error al actualizar el evento: " . $conn->error;
    }
    $stmt->close();
}
?>