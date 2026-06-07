<?php
include_once '../modelo/conexion.php';

/* Verificar conexión */
if (!isset($conn)) {
    die("Error: La variable de conexión \$conn no está definida.");
}

/* Consultar todos los eventos y almacenar el resultado */
$resultado = $conn->query("SELECT * FROM eventos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Eventos</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #121212;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .header-banner {
            background-color: #e50914; 
            padding: 30px 20px;
            margin-bottom: 10px;
        }

        .header-banner h2 {
            margin: 0;
            color: white;
            font-size: 28px;
            font-weight: bold;
        }

        .btn-add {
            display: inline-block;
            margin: 20px;
            padding: 10px 18px;
            background: #0095f6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-add:hover {
            background: #007acc;
        }

        .btn-delete {
            display: inline-block;
            padding: 8px 14px;
            background: #ed4956;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-delete:hover {
            background: #d11a2a;
        }

        .btn-edit {
            display: inline-block;
            padding: 8px 14px;
            background: #363636;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
            margin-right: 5px;
        }
        .btn-edit:hover {
            background: #4a4a4a;
        }

        .table-container {
            max-width: 95%;
            margin: 0 auto;
            padding: 0 20px 40px 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1e1e1e;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #2d2d2d;
        }

        th {
            background-color: #262626;
            color: #a8a8a8;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            color: #e1e1e1;
            font-size: 15px;
        }

        tr:hover td {
            background-color: #252525;
        }

        .actions-cell {
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <div class="header-banner">
        <h2>Eventos Registrados</h2>
    </div>

    <a href="formularioCrearEvento.php" class="btn-add">＋ Registrar nuevo evento</a>

    <!-- Contenedor de la tabla -->
    <div class="table-container">
        <table>
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha y Hora</th>
                    <th>Lugar</th>
                    <th>Capacidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Filas de la tabla -->
            <tbody>
                <!-- Si hay resultados -->
                <?php if ($resultado): ?>
                    <!-- Iterar sobre cada evento con la funcion fetch_assoc() -->
                    <?php while ($evento = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $evento['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($evento['titulo']); ?></strong></td>
                        <td><?php echo htmlspecialchars($evento['descripcion']); ?></td>
                        <td><?php echo $evento['fecha_hora']; ?></td>
                        <td><?php echo htmlspecialchars($evento['lugar']); ?></td>
                        <td><?php echo $evento['capacidad_max']; ?></td>
                        <td>$<?php echo $evento['precio_base']; ?></td>
                        <td class="actions-cell">
                            <a href="formularioActualizarEvento.php?id=<?php echo $evento['id']; ?>" class="btn-edit">Editar</a>
                            <a href="../controlador/eliminarEvento.php?id=<?php echo $evento['id']; ?>" class="btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este evento?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <!-- Si no hay resultados -->
                <?php else: ?>
                    <tr><td colspan="8">Error al cargar datos o tabla vacía.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>