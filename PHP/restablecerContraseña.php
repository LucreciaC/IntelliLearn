<?php
session_start();
include 'C:/xampp/htdocs/IntelliLearn/PHP/conexion.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicia la estructura HTML
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }
        /* Logo */
        .navbar-logo {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
        }
        .navbar-logo .logo {
            width: 249px;
            height: 137px;
            object-fit: cover;
        }

        .container {
            background-color: #FFEAB6;
            padding: 20px;
            width: 360px;
            border-radius: 3rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="password"] {
            width: 90%;
            padding: 1rem;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .register-button {
            width: 100%;
            padding: 10px;
            background-color: #b3c6cc;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: #99aabb;
        }

        .message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar-logo">
        <a href="http://localhost/IntelliLearn/Index.html">
            <img alt="Logo" class="logo" src="http://localhost/IntelliLearn/ASSETS/Images/Logo.png"/>
        </a>
    </div>

    <div class="container">';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = trim($_GET['token']);

    // Validar token
    $sql = "SELECT * FROM usuarios WHERE token = ? AND token_expire > NOW()";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<h2>Restablecer Contraseña</h2>
              <form method="POST" action="">
                  <input type="hidden" name="token" value="' . htmlspecialchars($token) . '" />
                  <input type="password" name="newPassword" placeholder="Nueva contraseña" required />
                  <input type="password" name="confirmPassword" placeholder="Confirmar contraseña" required />
                  <button type="submit" class="register-button">Restablecer contraseña</button>
              </form>';
    } else {
        echo '<p class="message">El token es inválido o ha expirado.</p>';
    }
    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token'])) {
    $token = trim($_POST['token']);
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if ($newPassword !== $confirmPassword) {
        echo '<p class="message">Las contraseñas no coinciden.</p>';
        exit();
    }

    // Validar token nuevamente
    $sql = "SELECT * FROM usuarios WHERE token = ? AND token_expire > NOW()";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $updateSql = "UPDATE usuarios SET Contraseña = ?, token = NULL, token_expire = NULL WHERE token = ?";
        $updateStmt = $conexion->prepare($updateSql);
        $updateStmt->bind_param("ss", $hashedPassword, $token);
        $updateStmt->execute();

        echo '<p class="message" style="color: green;">Contraseña restablecida exitosamente.</p>';
        $updateStmt->close();
    } else {
        echo '<p class="message">El token es inválido o ha expirado.</p>';
    }
    $stmt->close();
} else {
    echo '<p class="message">Solicitud no válida.</p>';
}

echo '</div>
</body>
</html>';

$conexion->close();
?>
