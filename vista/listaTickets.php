<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include_once '../modelo/conexion.php';

$sql = "SELECT
            t.id,
            t.codigo,
            t.estado,
            t.fecha_compra,
            e.titulo AS evento,
            u.nombre AS usuario
        FROM tickets t
        INNER JOIN eventos e ON t.evento_id = e.id
        INNER JOIN usuarios u ON t.usuario_id = u.id
        ORDER BY t.id DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Tickets</title>

<style>
body{
    font-family: Arial;
    background:#f4f4f4;
    padding:20px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th,td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}

th{
    background:#007bff;
    color:white;
}

a{
    text-decoration:none;
}

.btn{
    padding:8px 12px;
    border-radius:5px;
    color:white;
}

.crear{
    background:#28a745;
}

.editar{
    background:#ffc107;
    color:black;
}

.eliminar{
    background:#dc3545;
}

.volver{
    background:#17a2b8;
}
</style>

</head>
<body>

<h2>Listado de Tickets</h2>

<br>

<a href="formularioCrearTicket.php" class="btn crear">
Crear Ticket
</a>

<a href="../index.php" class="btn volver">
Volver
</a>

<br><br>

<table>

<tr>
<th>ID</th>
<th>Evento</th>
<th>Usuario</th>
<th>Código</th>
<th>Estado</th>
<th>Fecha Compra</th>
<th>Acciones</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()){ ?>

<tr>

<td><?= $fila['id'] ?></td>
<td><?= $fila['evento'] ?></td>
<td><?= $fila['usuario'] ?></td>
<td><?= $fila['codigo'] ?></td>
<td><?= $fila['estado'] ?></td>
<td><?= $fila['fecha_compra'] ?></td>

<td>

<a
class="btn editar"
href="formularioActualizarTicket.php?id=<?= $fila['id'] ?>">
Editar
</a>

<a
class="btn eliminar"
onclick="return confirm('¿Eliminar ticket?')"
href="../controlador/eliminarTicket.php?id=<?= $fila['id'] ?>">
Eliminar
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
