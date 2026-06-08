<?php
session_start();

include("../modelo/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        die("Debe completar todos los campos.");
    }

    $stmt = $conn->prepare("SELECT id, nombre, email, password, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario["password"])) {

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["email"] = $usuario["email"];
            $_SESSION["rol"] = $usuario["rol"];

            header("Location: ../index.php");
            exit();

        } else {
            echo "<h2>Contraseña incorrecta.</h2>";
        }

    } else {
        echo "<h2>Usuario no encontrado.</h2>";
    }

    $stmt->close();
    $conn->close();
}
?>
