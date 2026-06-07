<?php
include("../modelo/conexion.php");
$result = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios Registrados</title>
  <style>
    body { font-family: Arial; 
        margin: 0;
        background: #111;
        color: white;
    }

    header { background: #e50914;
        text-align: center;
        padding: 20px;
    }
    .evento { display: flex;
        flex-wrap: wrap;    
        gap: 15px;
        justify-content: center;
        padding: 20px;
    }
    
    .card {
      flex: 1 1 250px;
      background: #222;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
    }
    
    .card img { max-width: 100%;
        border-radius: 8px;
    }
    button { background: #e50914;
        border: none; padding: 10px; color: white; margin-top: 10px; border-radius: 5px; cursor: pointer;
    }
    
    .user-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
      width: 90%;
      max-width: 1000px;
      margin-bottom: 40px;
    
    }
    .container-btn {
        display: flex;
        justify-content: center; /* Centra horizontalmente */
    }

    .btn-delete {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 14px;
      background: #ed4956;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
      font-weight: bold;
      transition: background 0.2s;
    }
    .btn-delete:hover {
      background: #d11a2a;
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
    }
    .btn-add:hover {
      background: #007acc;
    }
  </style>
</head>
<body>
    <header><h2>Usuarios Registrados</h2></header>
    <div class="user-list">
    <?php while ($fila = $result->fetch_assoc()) { ?>
      <div class="card">
        <h3><?= htmlspecialchars($fila['nombre']) ?></h3>
        <p><?= htmlspecialchars($fila['telefono']) ?></p>
        <p><?= htmlspecialchars($fila['email']) ?></p>
        <p><?= htmlspecialchars($fila['contraseña']) ?></p>
        <p><?= htmlspecialchars($fila['direccion']) ?></p>
        <p><?= htmlspecialchars($fila['rol']) ?></p>
        <a class="btn-delete" href="../controlador/eliminarUsuario.php?id=<?= $fila['id'] ?>">Eliminar</a>
      </div>
    <?php } ?>
  </div>
  <div class="container-btn">
    <a class="btn-add" href="formularioCrearUsuario.php">➕ Registrar nuevo usuario</a>
  </div>
</body>
</html>
