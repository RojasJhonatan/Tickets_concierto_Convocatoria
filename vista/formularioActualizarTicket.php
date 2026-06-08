<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include_once '../modelo/conexion.php';

$id = $_GET['id'];

$ticket = $conn->query(
"SELECT * FROM tickets WHERE id=$id"
)->fetch_assoc();

$eventos = $conn->query(
"SELECT * FROM eventos"
);

$usuarios = $conn->query(
"SELECT * FROM usuarios"
);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Actualizar Ticket</title>
</head>

<body>

<h2>Actualizar Ticket</h2>

<form
action="../controlador/actualizarTicket.php"
method="POST">

<input
type="hidden"
name="id"
value="<?= $ticket['id'] ?>">

<label>Evento:</label>

<select name="evento_id">

<?php while($e = $eventos->fetch_assoc()){ ?>

<option
value="<?= $e['id'] ?>"
<?= ($e['id']==$ticket['evento_id']) ? 'selected' : '' ?>>

<?= $e['titulo'] ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Usuario:</label>

<select name="usuario_id">

<?php while($u = $usuarios->fetch_assoc()){ ?>

<option
value="<?= $u['id'] ?>"
<?= ($u['id']==$ticket['usuario_id']) ? 'selected' : '' ?>>

<?= $u['nombre'] ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Código:</label>

<input
type="text"
name="codigo"
value="<?= $ticket['codigo'] ?>"
required>

<br><br>

<label>Estado:</label>

<select name="estado">

<option
<?= $ticket['estado']=='Activo' ? 'selected':'' ?>>
Activo
</option>

<option
<?= $ticket['estado']=='Usado' ? 'selected':'' ?>>
Usado
</option>

<option
<?= $ticket['estado']=='Cancelado' ? 'selected':'' ?>>
Cancelado
</option>

</select>

<br><br>

<button type="submit">
Actualizar Ticket
</button>

</form>

</body>
</html>
