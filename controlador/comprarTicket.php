<?php
session_start();

/* Verificar que el usuario esté autenticado y sea cliente */
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 0) {
    header("Location: ../index.php");
    exit();
}

include_once '../modelo/conexion.php';

/* Validar que se reciba un evento */
if (!isset($_GET['evento_id'])) {
    exit('Evento no válido');
}

$evento_id = (int) $_GET['evento_id'];

/* Obtener capacidad máxima del evento */
$stmt = $conn->prepare("
    SELECT capacidad_max
    FROM eventos
    WHERE id = ?
");
$stmt->bind_param("i", $evento_id);
$stmt->execute();

$evento = $stmt->get_result()->fetch_assoc();

if (!$evento) {
    exit('Evento no encontrado');
}

/* Contar tickets vendidos para el evento */
$stmt = $conn->prepare("
    SELECT COUNT(*) AS total
    FROM tickets
    WHERE evento_id = ?
");
$stmt->bind_param("i", $evento_id);
$stmt->execute();

$vendidos = $stmt->get_result()->fetch_assoc()['total'];

/* Verificar disponibilidad */
if ($vendidos >= $evento['capacidad_max']) {
    exit('No hay cupos disponibles');
}

/* Datos del ticket */
$usuario_id = $_SESSION['id'];
$codigo = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10));
$estado = 'Pagado';

/* Registrar ticket */
$stmt = $conn->prepare("
    INSERT INTO tickets (
        evento_id,
        usuario_id,
        codigo,
        estado
    )
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "iiss",
    $evento_id,
    $usuario_id,
    $codigo,
    $estado
);

if ($stmt->execute()) {
    header("Location: ../vista/listaTickets.php");
    exit();
} else {
    echo "Error al generar el ticket: " . $stmt->error;
}

/* Cerrar recursos */
$stmt->close();
$conn->close();
?>