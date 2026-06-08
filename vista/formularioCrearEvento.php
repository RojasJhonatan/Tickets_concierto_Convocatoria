<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../index.php");
    exit();
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
    <title>Crear Evento</title>
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

        .btn-home {
            flex: 1;
            display: inline-block;
            padding: 12px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
            text-align: center;
        }

        .btn-home:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Crear Nuevo Evento</h1>
        
        <!-- Formulario para crear un nuevo evento -->
        <form action="../controlador/crearEvento.php" method="POST">
            <div class="form-group">
                <label for="titulo">Título del Evento:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ej. Concierto de Rock" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" placeholder="Detalles del evento..." required maxlength="100"></textarea>
            </div>

            <div class="form-group">
                <label for="fecha_hora">Fecha y Hora:</label>
                <input type="datetime-local" id="fecha_hora" name="fecha_hora" required>
            </div>

            <div class="form-group">
                <label for="lugar">Lugar / Ubicación:</label>
                <input type="text" id="lugar" name="lugar" placeholder="Ej. Estadio Nacional" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="capacidad_max">Capacidad Máxima (Personas):</label>
                <input type="number" id="capacidad_max" name="capacidad_max" min="1" placeholder="Ej. 500" required>
            </div>

            <div class="form-group">
                <label for="precio_base">Precio Base ($):</label>
                <input type="number" id="precio_base" name="precio_base" min="0" placeholder="Ej. 45" required>
            </div>

            <div class="btn-group">
                <a href="listaEventos.php" class="btn-delete">Cancelar</a>
                <button type="submit" class="btn-add">Guardar Evento</button>
            </div>
        </form>
    </div>

</body>
</html>