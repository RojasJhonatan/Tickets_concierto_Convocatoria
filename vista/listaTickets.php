<?php
session_start();

/* Verificar sesión */
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include_once '../modelo/conexion.php';

/* Administrador: ve todos los tickets */
if ($_SESSION['rol'] == 1) {

    $sql = "
        SELECT
            t.id,
            t.codigo,
            t.estado,
            t.fecha_compra,
            e.titulo AS evento,
            u.nombre AS usuario
        FROM tickets t
        INNER JOIN eventos e ON t.evento_id = e.id
        INNER JOIN usuarios u ON t.usuario_id = u.id
        ORDER BY t.id DESC
    ";

    $resultado = $conn->query($sql);

}
/* Cliente: solo ve sus tickets */
else {

    $stmt = $conn->prepare("
        SELECT
            t.id,
            t.codigo,
            t.estado,
            t.fecha_compra,
            e.titulo AS evento
        FROM tickets t
        INNER JOIN eventos e ON t.evento_id = e.id
        WHERE t.usuario_id = ?
        ORDER BY t.id DESC
    ");

    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();

    $resultado = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tickets</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121212;
            color: #ffffff;
            margin: 0;
        }

        .header {
            background: #e50914;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
        }

        .top {
            text-align: center;
            padding: 20px;
        }

        table {
            width: 95%;
            margin: 0 auto 30px auto;
            border-collapse: collapse;
            background: #1e1e1e;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #262626;
        }

        tr:hover {
            background: #252525;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            background: #0095f6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn:hover {
            background: #007acc;
        }

        .estado-pagado {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>
            <?= ($_SESSION['rol'] == 1) ? '🎟 Tickets Vendidos' : '🎫 Mis Tickets'; ?>
        </h2>
    </div>

    <div class="top">
        <a class="btn" href="../index.php">
            🏠 Volver al Inicio
        </a>
    </div>

    <table>

        <tr>
            <th>ID</th>
            <th>Evento</th>

            <?php if ($_SESSION['rol'] == 1): ?>
                <th>Usuario</th>
            <?php endif; ?>

            <th>Código</th>
            <th>Estado</th>
            <th>Fecha de Compra</th>
        </tr>

        <?php while ($fila = $resultado->fetch_assoc()): ?>

            <tr>

                <td>
                    <?= $fila['id'] ?>
                </td>

                <td>
                    <?= htmlspecialchars($fila['evento']) ?>
                </td>

                <?php if ($_SESSION['rol'] == 1): ?>
                    <td>
                        <?= htmlspecialchars($fila['usuario']) ?>
                    </td>
                <?php endif; ?>

                <td>
                    <?= htmlspecialchars($fila['codigo']) ?>
                </td>

                <td class="estado-pagado">
                    <?= htmlspecialchars($fila['estado']) ?>
                </td>

                <td>
                    <?= $fila['fecha_compra'] ?>
                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</body>

</html>