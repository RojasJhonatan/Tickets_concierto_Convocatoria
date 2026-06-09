<?php
session_start();

include_once '../modelo/conexion.php'; 

$usuarioLogueado = isset($_SESSION['rol']);
$rol = $usuarioLogueado ? $_SESSION['rol'] : null;

$idSesion = $_SESSION['id'] ?? null;
$idUrl = $_GET['id'] ?? null;

$id = null;
$nombre = "";
$telefono = "";
$email = "";
$direccion = "";

if ($rol == 1 && !empty($idUrl)) {
    $id = $idUrl; // El admin está editando a otro usuario

    $stmt = $conn->prepare("SELECT nombre, telefono, email, direccion FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuarioData = $resultado->fetch_assoc()) {
        $nombre    = $usuarioData['nombre'];
        $telefono  = $usuarioData['telefono'];
        $email     = $usuarioData['email'];
        $direccion = $usuarioData['direccion'];
    }
    $stmt->close();

} else {
    $id = $idSesion; // El cliente se está editando a sí mismo

    $nombre    = $_SESSION['nombre'] ?? '';
    $telefono  = $_SESSION['telefono'] ?? '';
    $email     = $_SESSION['email'] ?? '';
    $direccion = $_SESSION['direccion'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualización Usuario</title>
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
        input[type="password"],
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
        <h2>Actualización de Usuario</h2>
            <form action="../controlador/actualizarUsuario.php" method="POST">
            <div class="form-group">
                <label>ID: <?= htmlspecialchars($id); ?></label>
                <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            </div>

            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="nombre" placeholder="Nombre completo" value="<?= htmlspecialchars($nombre); ?>">
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono" placeholder="+57..." value="<?= htmlspecialchars($telefono); ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" placeholder="ejemplo@email.com" value="<?= htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="********">
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="direccion" placeholder="calle # ..-.." value="<?= htmlspecialchars($direccion); ?>">
            </div>


            <?php if ($rol == 0): ?>
                <div class="form-group">
                    <label>Rol</label>

                    <input type="hidden" name="rol" value="0">

                        <small>
                            Los usuarios registrados desde esta página serán creados como clientes. <!-- Un externo siempre será registrado como cliente -->
                        </small>
                    </label>
                </div>
            <?php elseif ($rol == 1): ?> <!-- No cualquiera puede crear usuarios administradores att: Javier -->
            <div class="form-group">
                <label>Rol</label>

                <label>
                    <input type="radio" name="rol" value="0" checked>
                    Cliente
                </label>
                <label>
                    <input type="radio" name="rol" value="1">
                    Administrador
                </label>
            </div>
            <?php endif; ?>
            

            <div class="btn-group">
                <button type="submit" class="btn-add"> <!-- Le quité la opción de ver los usuarios registrados a un cliente por seguridad tatan att: Javier -->
                    Actualizar Usuario
                </button>

                <?php if ($usuarioLogueado && $rol == 1): ?> <!-- Si es admin si los puede ver -->
                    <a href="listaUsuarios.php" class="btn-delete">
                        Consultar Usuarios
                    </a>
                <?php endif; ?>

                <a href="../index.php" class="btn-home">
                    ⬅ Volver al Inicio
                </a>
            </div>
            </form>
        </div>
    </div>
</body>
</html>