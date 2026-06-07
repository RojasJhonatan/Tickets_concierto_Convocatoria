<?php
include_once '../modelo/conexion.php';

/* Validamos la conexión */
if (!isset($conn)) {
    die("Error: La variable de conexión \$conn no está definida.");
}

/* Validamos que se haya pasado un ID */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listaEventos.php");
    exit();
}

/* Obtenemos el evento por su ID */
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM eventos WHERE id = ?");
/* Vinculamos el parámetro de acuerdo al tipo de variable (i para integer) */
$stmt->bind_param("i", $id);
$stmt->execute();
/* Extraemos el resultado */
$resultado = $stmt->get_result();
/* Lo almacenamos en una variable */
$evento = $resultado->fetch_assoc();

/* Validamos que el evento exista */
if (!$evento) {
    /* Si no existe, mostramos un error */
    die("Error: Evento no encontrado en la base de datos.");
}

/* Función para formatear la fecha */
$fecha_formateada = "";
if (!empty($evento['fecha_hora'])) {
    $fecha_formateada = date('Y-m-d\TH:i', strtotime($evento['fecha_hora']));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración del documento -->
    <meta charset="UTF-8">
    <!-- Compatibilidad con navegadores -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Vista del contenido -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <!-- Estilos CSS -->
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #121212;
            color: #f5f5f5;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .form-container {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
            width: 100%;
            max-width: 450px;
            border: 1px solid #2d2d2d;
        }

        h1 {
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 24px;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #a8a8a8;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        textarea {
            padding: 11px 14px;
            font-size: 14px;
            border: 1px solid #363636;
            border-radius: 5px;
            background-color: #121212;
            color: #fff;
            width: 100%;
            box-sizing: border-box;
            font-family: inherit;
        }

        textarea {
            resize: vertical;
            min-height: 70px;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #0095f6;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-add {
            flex: 1;
            display: inline-block;
            padding: 12px;
            background: #0095f6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        .btn-add:hover {
            background: #007acc;
        }

        .btn-delete {
            flex: 1;
            display: inline-block;
            padding: 12px;
            background: #ed4956;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        .btn-delete:hover {
            background: #d11a2a;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Editar Detalle del Evento</h1>

        <!-- Formulario para actualizar el evento -->
        <form action="../controlador/actualizarEvento.php" method="POST">
            <!-- Campo oculto para el ID del evento -->
            <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">

            <div class="form-group">
                <label for="titulo">Título del Evento:</label>
                <!-- Campo para el título del evento: Precargado -->
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($evento['titulo']); ?>" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <!-- Campo para la descripción del evento: Precargado -->
                <textarea id="descripcion" name="descripcion" required maxlength="100"><?php echo htmlspecialchars($evento['descripcion']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_hora">Fecha y Hora:</label>
                <!-- Campo para la fecha y hora del evento: Precargado -->
                <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="<?php echo $fecha_formateada; ?>" required>
            </div>

            <div class="form-group">
                <label for="lugar">Lugar / Ubicación:</label>
                <!-- Campo para el lugar o ubicación del evento: Precargado -->
                <input type="text" id="lugar" name="lugar" value="<?php echo htmlspecialchars($evento['lugar']); ?>" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="capacidad_max">Capacidad Máxima:</label>
                <!-- Campo para la capacidad máxima del evento: Precargado -->
                <input type="number" id="capacidad_max" name="capacidad_max" value="<?php echo $evento['capacidad_max']; ?>" min="1" required>
            </div>

            <div class="form-group">
                <label for="precio_base">Precio Base ($):</label>
                <!-- Campo para el precio base del evento: Precargado -->
                <input type="number" id="precio_base" name="precio_base" value="<?php echo $evento['precio_base']; ?>" min="0" required>
            </div>

            <div class="btn-group">
                <a href="listaEventos.php" class="btn-delete">Cancelar</a>
                <button type="submit" class="btn-add">Actualizar Evento</button>
            </div>
        </form>
    </div>

</body>
</html>