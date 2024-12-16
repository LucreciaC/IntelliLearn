<?php
session_start();
include 'C:/xampp/htdocs/IntelliLearn/PHP/conexion.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/IntelliLearn/PHP/iniciarSesion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Eliminar cuenta del usuario actual
    $username = $_SESSION['username'];

    // Consulta SQL para eliminar la cuenta
    $sql = "DELETE FROM usuarios WHERE NombreUsuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        // Destruye la sesión después de eliminar la cuenta
        session_destroy();
        echo "<script>
                alert('Tu cuenta ha sido eliminada correctamente.');
                window.location.href = 'http://localhost/IntelliLearn/Index.html';
              </script>";
    } else {
        echo "<script>alert('Error al eliminar la cuenta. Inténtalo de nuevo.');</script>";
    }

    $stmt->close();
    $conexion->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuenta</title>
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
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .buttons {
            display: flex;
            justify-content: space-around;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .confirm {
            background-color: #d9534f;
            color: white;
        }
        .confirm:hover {
            background-color: #c9302c;
        }
        .cancel {
            background-color: #b3c6cc;
            color: white;
        }
        .cancel:hover {
            background-color: #99aabb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Eliminar Cuenta</h2>
        <p>¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.</p>
        <form method="POST" action="">
            <div class="buttons">
                <button type="submit" class="confirm">Eliminar</button>
                <button type="button" class="cancel" onclick="window.location.href='http://localhost/IntelliLearn/Index.html';">Cancelar</button>
            </div>
        </form>
    </div>
</body>
</html>
