<?php
/* Validamos que sea un post para crear */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../modelo/conexion.php';

    /* Obtenemos los datos del formulario */
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_hora = $_POST['fecha_hora'];
    $lugar = $_POST['lugar'];
    $capacidad_max = $_POST['capacidad_max'];
    $precio_base = $_POST['precio_base'];

    // Sentencia preparada con MySQLi ($conn)
    $stmt = $conn->prepare("INSERT INTO eventos (titulo, descripcion, fecha_hora, lugar, capacidad_max, precio_base) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $titulo, $descripcion, $fecha_hora, $lugar, $capacidad_max, $precio_base);

    /* Ejecutamos la sentencia y luego redirigimos a la lista */
    if ($stmt->execute()) {
        header("Location: ../vista/listaEventos.php");
        exit();
    } else {
        echo "Error al guardar el evento: " . $conn->error;
    }
    $stmt->close();
}
?>