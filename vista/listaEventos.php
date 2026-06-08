<?php
session_start();

include_once '../modelo/conexion.php';

/* Información de sesión */
$usuarioLogueado = isset($_SESSION['rol']);
$rol = $usuarioLogueado ? $_SESSION['rol'] : null;

/* Obtener eventos */
$resultado = $conn->query("SELECT * FROM eventos");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eventos Registrados</title>

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

        .top {
            text-align: center;
            padding: 15px;
        }

        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #1e1e1e;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #333;
            text-align: center;
        }

        th {
            background: #262626;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .buy {
            background: #28a745;
        }

        .buy:hover {
            background: #218838;
        }

        .edit {
            background: #555;
        }

        .edit:hover {
            background: #444;
        }

        .del {
            background: #dc3545;
        }

        .del:hover {
            background: #c82333;
        }

        .add {
            background: #0095f6;
        }

        .add:hover {
            background: #007acc;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Eventos Registrados</h2>
    </div>

    <div class="top">
        <a class="btn add" href="../index.php">
            🏠 Inicio
        </a>

        <?php if ($usuarioLogueado && $rol == 1): ?>
            <a class="btn add" href="formularioCrearEvento.php">
                ➕ Nuevo Evento
            </a>
        <?php endif; ?>
    </div>

    <table>

        <tr>
            <th>Título</th>
            <th>Fecha</th>
            <th>Lugar</th>
            <th>Capacidad</th>
            <th>Vendidos</th>
            <th>Disponibles</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>

        <?php while ($evento = $resultado->fetch_assoc()): ?>

            <?php
            /* Contar tickets vendidos */
            $consultaTickets = $conn->query(
                "SELECT COUNT(*) AS cantidad
                 FROM tickets
                 WHERE evento_id = {$evento['id']}"
            );

            $ticketsVendidos = $consultaTickets->fetch_assoc()['cantidad'];
            $disponibles = $evento['capacidad_max'] - $ticketsVendidos;
            ?>

            <tr>
                <td>
                    <?= htmlspecialchars($evento['titulo']) ?>
                </td>

                <td>
                    <?= $evento['fecha_hora'] ?>
                </td>

                <td>
                    <?= htmlspecialchars($evento['lugar']) ?>
                </td>

                <td>
                    <?= $evento['capacidad_max'] ?>
                </td>

                <td>
                    <?= $ticketsVendidos ?>
                </td>

                <td>
                    <?= $disponibles ?>
                </td>

                <td>
                    $<?= number_format($evento['precio_base']) ?>
                </td>

                <td>

                    <?php if (!$usuarioLogueado): ?>

                        Inicie sesión para comprar

                    <?php elseif ($rol == 0): ?>

                        <?php if ($disponibles > 0): ?>

                            <a
                                class="btn buy"
                                href="../controlador/comprarTicket.php?evento_id=<?= $evento['id'] ?>">
                                🎟 Comprar Ticket
                            </a>

                        <?php else: ?>

                            ❌ Agotado

                        <?php endif; ?>

                    <?php else: ?>

                        <a
                            class="btn edit"
                            href="formularioActualizarEvento.php?id=<?= $evento['id'] ?>">
                            ✏️ Editar
                        </a>

                        <a
                            class="btn del"
                            href="../controlador/eliminarEvento.php?id=<?= $evento['id'] ?>"
                            onclick="return confirm('¿Está seguro de eliminar este evento?')">
                            🗑 Eliminar
                        </a>

                    <?php endif; ?>

                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</body>

</html>