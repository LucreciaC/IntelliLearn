<?php
$servidor = "localhost";
$usuario = "root";
$password = "Lucrecia1";
$base_datos = "intellilearn";

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
echo "Conexión exitosa<br>";

?>