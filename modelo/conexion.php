<?php
$host = "localhost";
$port = 3330;
$user = "root";     // Usuario 
$pass = "";         // Contraseña 
$db = "MVC_Tickets_eventos";

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>