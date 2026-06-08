<?php
session_start();
$usuarioLogueado = isset($_SESSION['rol']);
$rol = $usuarioLogueado ? $_SESSION['rol'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tickets y Eventos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #121212;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: black;
            color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 15px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            font-size: 18px;
            transition: background 0.2s;
        }

        .btn-eventos {
            background-color: #007bff;
        }

        .btn-eventos:hover {
            background-color: #0056b3;
        }

        .btn-tickets {
            background-color: #28a745;
        }

        .btn-tickets:hover {
            background-color: #218838;
        }

        .btn-usuarios {
            background-color: #17a2b8;
        }

        .btn-usuarios:hover {
            background-color: #117a8b;
        }

        .bienvenida {
            margin-bottom: 20px;
            padding: 10px;
            background: #121212;
            color: #fff;
            border-radius: 5px;
        }

        .logout {
            background-color: #dc3545;
        }

        .logout:hover {
            background-color: #b02a37;
        }
    </style>
</head>

<body>

    <div class="container">

    <?php if ($usuarioLogueado && $rol == 1): // 1 = Administrador ?>
        <div class="bienvenida">
            <h3>
                Bienvenido,
                <?php echo htmlspecialchars($_SESSION['nombre']); ?>
            </h3>

            <p>
                Rol:
                <strong>
                    <?php echo ($_SESSION['rol']==1)?'Administrador' : 'Cliente'; ?>
                </strong>
            </p>
        </div>
        <?php endif; ?>

        <h1>🎟️ Sistema de Gestión de Conciertos</h1>

        <p>Selecciona el módulo al que deseas ingresar:</p>

        <div class="menu">

            <?php if (!$usuarioLogueado): ?>
                <a href="vista/listaEventos.php" class="btn btn-eventos">Ver Eventos</a>
            <?php else: ?>
                <a href="vista/listaEventos.php" class="btn btn-eventos">Gestionar Eventos</a>
            <?php endif; ?>

            <?php if ($usuarioLogueado && $rol == 1): // 1 = Administrador ?>

            <a href="vista/listaTickets.php" class="btn btn-tickets">
                Gestionar Tickets
            </a>

            <a href="vista/formularioCrearUsuario.php" class="btn btn-usuarios">
                Registro de Usuarios
            </a>
            <?php endif; ?>
            <?php if (!$usuarioLogueado): ?>
                <a href="vista/login.php" class="btn btn-tickets">Iniciar Sesión</a>
            <?php else: ?>
                <a href="controlador/logout.php" class="btn logout">Cerrar Sesión</a>
            <?php endif; ?>


        </div>

    </div>

</body>
</html>
