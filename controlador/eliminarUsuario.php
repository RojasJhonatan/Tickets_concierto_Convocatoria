<?php
include("../modelo/conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../vista/listaUsuarios.php");
} else {
    echo "Error: " . $conn->error;
}
?>