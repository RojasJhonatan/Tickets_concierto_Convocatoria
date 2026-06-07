<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tickets y Eventos</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color: #f9f9f9; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        .menu { display: flex; flex-direction: column; gap: 15px; margin-top: 30px; }
        .btn { padding: 15px; text-decoration: none; color: white; font-weight: bold; border-radius: 5px; font-size: 18px; transition: background 0.2s; }
        .btn-eventos { background-color: #007bff; }
        .btn-eventos:hover { background-color: #0056b3; }
        .btn-tickets { background-color: #28a745; }
        .btn-tickets:hover { background-color: #218838; }
        .btn-usuarios { background-color: #17a2b8; }
        .btn-usuarios:hover { background-color: #117a8b; }
    </style>
</head>
<body>

    <div class="container">
        <h1>🎟️ Sistema de Gestión de Conciertos</h1>
        <p>Selecciona el módulo al que deseas ingresar:</p>

        <div class="menu">
            <a href="vista/listaEventos.php" class="btn btn-eventos">Gestionar Eventos (Tu Módulo)</a>
            
            <a href="vista/listaTickets.php" class="btn btn-tickets">Gestionar Tickets</a>
            <a href="vista/formularioCrearUsuario.php" class="btn btn-usuarios">Registro de Usuarios</a>
            <a href="vista/login.php" class="btn btn-usuarios">Login</a>
        </div>
    </div>

</body>
</html>