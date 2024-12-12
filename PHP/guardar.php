<?php
include 'C:/xampp/htdocs/IntelliLearn/PHP/conexion.php';

// Mapeo de roles
$mapa_roles = [
    'estudiante' => 0,
    'profesor' => 1
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['Nombre'];
    $nombreUsuario = $_POST['NombreUsuario'];
    $email = $_POST['Email'];
    $contraseña = $_POST['Contraseña'];
    $confirmarContraseña = $_POST['ConfirmarContraseña'];
    $rol = $_POST['rol']; // Cambiado de 'Rol' a 'role'

    // Validar que las contraseñas coinciden
    if ($contraseña !== $confirmarContraseña) {
        die("Las contraseñas no coinciden.");
    }

    // Validar el rol
    if (!isset($mapa_roles[$rol])) {
        die("Rol no válido.");
    }
    $rol_numeric = $mapa_roles[$rol];

    // Cifrar la contraseña
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    // Comprobar si el correo ya existe
    $checkEmail = "SELECT * FROM usuarios WHERE Email = ?";
    $stmtCheck = $conexion->prepare($checkEmail);
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        echo "¡La dirección de correo electrónico ya existe!";
    } else {
        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO usuarios (Nombre, NombreUsuario, Email, Contraseña, Rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        // Vincular los parámetros
        $stmt->bind_param("ssssi", $nombre, $nombreUsuario, $email, $hashed_password, $rol_numeric);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }

        $stmt->close();
    }
    $stmtCheck->close();
    $conexion->close();
}
?>
   
