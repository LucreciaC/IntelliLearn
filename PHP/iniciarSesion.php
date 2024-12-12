<?php
session_start();

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $username = $_POST['NombreUsuario'];
    $password = $_POST['Contraseña'];

    // Depuración: Verifica los valores recibidos
    echo "Contraseña ingresada desde el formulario: " . $password . "<br>";  // Muestra la contraseña ingresada

    // Conexión a la base de datos
    include 'C:/xampp/htdocs/IntelliLearn/PHP/conexion.php';

    // Consulta SQL para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE NombreUsuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Depuración: Muestra el hash de la contraseña almacenada
        echo "Contraseña almacenada (hash): " . $user['Contraseña'] . "<br>";

        // Verifica la contraseña con password_verify()
        if (password_verify($password, $user['Contraseña'])) {
            // Si la contraseña es correcta, iniciar sesión
            $_SESSION['user_id'] = $user['idUsuarios'];
            $_SESSION['username'] = $user['NombreUsuario'];

            // Redirigir al usuario a la página de lecciones
            header("Location: http://localhost/IntelliLearn/HTML/lecciones.html");
            exit();
        } else {
            // Si la contraseña es incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Si el usuario no existe
        echo "El usuario no existe.";
    }

    $stmt->close();
    $conexion->close();
}
?>
