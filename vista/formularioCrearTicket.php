<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include_once '../modelo/conexion.php';

$eventos = $conn->query("SELECT * FROM eventos");
$usuarios = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Ticket</title>
</head>

<body>

<h2>Crear Ticket</h2>

<form action="../controlador/crearTicket.php" method="POST">

<label>Evento:</label>

<select name="evento_id" required>

<?php while($e = $eventos->fetch_assoc()){ ?>

<option value="<?= $e['id'] ?>">
<?= $e['titulo'] ?>
</option>

<?php } ?>

</select>

<br><br>

<label>Usuario:</label>

<select name="usuario_id" required>

<?php while($u = $usuarios->fetch_assoc()){ ?>

<option value="<?= $u['id'] ?>">
<?= $u['nombre'] ?>
</option>

<?php } ?>

</select>

<br><br>

<label>Código:</label>

<input
type="text"
name="codigo"
required>

<br><br>

<label>Estado:</label>

<select name="estado">

<option value="Activo">Activo</option>
<option value="Usado">Usado</option>
<option value="Cancelado">Cancelado</option>

</select>

<br><br>

<button type="submit">
Guardar Ticket
</button>

</form>

</body>
</html>
