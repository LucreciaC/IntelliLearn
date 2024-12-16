<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirige al usuario al login si no está logueado
    header("Location: http://localhost/IntelliLearn/PHP/iniciarSesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #FFEAB6;
            padding: 20px;
            width: 360px;
            border-radius: 3rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .register-button {
            width: 100%;
            padding: 10px;
            background-color: #b3c6cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-button:hover {
            background-color: #99aabb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cambiar Contraseña</h2>
        <form method="POST" action="procesarCambioContraseña.php">
            <label for="currentPassword">Contraseña Actual:</label>
            <input type="password" name="currentPassword" placeholder="Contraseña actual" required />
            <label for="newPassword">Nueva Contraseña:</label>
            <input type="password" name="newPassword" placeholder="Nueva contraseña" required />
            <label for="confirmPassword">Confirmar Contraseña:</label>
            <input type="password" name="confirmPassword" placeholder="Confirmar contraseña" required />
            <button type="submit" class="register-button">Actualizar Contraseña</button>
        </form>
    </div>
</body>
</html>
