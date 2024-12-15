<?php
ob_start(); // Inicia el almacenamiento en búfer
session_start();
include 'C:/xampp/htdocs/IntelliLearn/PHP/conexion.php';

// Habilitar depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['NombreUsuario']);
    $password = trim($_POST['Contraseña']);

    // Consulta SQL para verificar el usuario y su rol
    $sql = "SELECT idUsuarios, NombreUsuario, Contraseña, rol FROM usuarios WHERE NombreUsuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificación de datos recuperados
        $rol = (int)$user['rol']; // Convertir explícitamente el rol a entero
        echo "DEBUG - Rol recuperado de la base de datos: " . $rol . "<br>";

        // Verificar contraseña
        if (password_verify($password, $user['Contraseña'])) {
            $_SESSION['user_id'] = $user['idUsuarios'];
            $_SESSION['username'] = $user['NombreUsuario'];
            $_SESSION['rol'] = $rol;

            // Redirigir según el rol
            if ($rol === 0) { // Estudiante
                echo "DEBUG - Redirigiendo a lecciones.html<br>";
                header("Location: http://localhost/IntelliLearn/HTML/lecciones.html");
                exit();
            } elseif ($rol === 1) { // Profesor
                echo "DEBUG - Redirigiendo a panelProfesor.html<br>";
                header("Location: http://localhost/IntelliLearn/HTML/panelProfesor.html");
                exit();
            } else {
                echo "DEBUG - Rol desconocido: " . $rol;
                exit();
            }
        } else {
            echo "DEBUG - Contraseña incorrecta.";
            exit();
        }
    } else {
        echo "DEBUG - El usuario no existe.";
        exit();
    }

    $stmt->close();
    $conexion->close();
}
ob_end_flush();
?>
