<?php
$servidor = "localhost";
$usuario = "root";
$password = "Lucrecia1";
$base_datos = "intellilearn";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
echo "Conexión exitosa";
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $first_name = $_POST['first_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Validar que las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Cifrar la contraseña antes de guardarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuarios (first_name, username, email, password, role) 
            VALUES (:first_name, :username, :email, :password, :role)";
    
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    try {
        $stmt->execute([
            ':first_name' => $first_name,
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password,
            ':role' => $role
        ]);
        echo "Usuario registrado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>