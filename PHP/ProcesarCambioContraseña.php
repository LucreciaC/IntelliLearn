<?php
session_start();
include 'C:/xampp/htdocs/IntelliLearn/PHP/conexion.php';

if (!isset($_SESSION['username'])) {
    // Redirige si no está logueado
    header("Location: http://localhost/IntelliLearn/PHP/iniciarSesion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $currentPassword = trim($_POST['currentPassword']);
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if ($newPassword !== $confirmPassword) {
        echo "Las nuevas contraseñas no coinciden.";
        exit();
    }

    // Obtener la contraseña actual de la base de datos
    $sql = "SELECT Contraseña FROM usuarios WHERE NombreUsuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña actual
        if (password_verify($currentPassword, $user['Contraseña'])) {
            // Actualizar la contraseña
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateSql = "UPDATE usuarios SET Contraseña = ? WHERE NombreUsuario = ?";
            $updateStmt = $conexion->prepare($updateSql);
            $updateStmt->bind_param("ss", $hashedPassword, $username);
            $updateStmt->execute();

            echo "Contraseña actualizada exitosamente.";
            $updateStmt->close();
        } else {
            echo "La contraseña actual es incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Solicitud no válida.";
}
?>
