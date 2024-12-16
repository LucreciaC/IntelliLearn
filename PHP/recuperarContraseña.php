<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/IntelliLearn/vendor/PHPMailer/Exception.php';
require 'C:/xampp/htdocs/IntelliLearn/vendor/PHPMailer/PHPMailer.php';
require 'C:/xampp/htdocs/IntelliLearn/vendor/PHPMailer/SMTP.php';

session_start();
include 'C:/xampp/htdocs/IntelliLearn/PHP/conexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Función para enviar el correo
function enviarCorreo($destinatario, $asunto, $mensaje) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lucre252@gmail.com'; // Tu correo
        $mail->Password = 'hadk gspl joex groy'; // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('lucre252@gmail.com', 'Soporte IntelliLearn');
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $mensaje;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Error al enviar el correo: " . $mail->ErrorInfo;
    }
}

// Manejo del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);

    if (empty($email) || empty($username)) {
        echo "Por favor, completa todos los campos.";
        exit();
    }

    // Verificar si el correo y el nombre de usuario existen
    $sql = "SELECT * FROM usuarios WHERE email = ? AND NombreUsuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Generar token único y expiración
        $token = bin2hex(random_bytes(16));
        $tokenExpire = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Guardar token en la base de datos
        $updateSql = "UPDATE usuarios SET token = ?, token_expire = ? WHERE email = ?";
        $updateStmt = $conexion->prepare($updateSql);
        $updateStmt->bind_param("sss", $token, $tokenExpire, $email);
        $updateStmt->execute();

        // Enviar correo con enlace
        $recoveryLink = "http://localhost/IntelliLearn/PHP/restablecerContraseña.php?token=" . $token;
        $asunto = "Recuperación de contraseña";
        $mensaje = "Hola " . $username . ",<br><br>";
        $mensaje .= "Hemos recibido una solicitud para recuperar tu contraseña.<br>";
        $mensaje .= "Haz clic en el siguiente enlace para restablecer tu contraseña:<br>";
        $mensaje .= "<a href='" . $recoveryLink . "'>Restablecer contraseña</a><br><br>";
        $mensaje .= "Si no realizaste esta solicitud, ignora este mensaje.<br><br>";
        $mensaje .= "Saludos,<br>El equipo de IntelliLearn.";

        if (enviarCorreo($email, $asunto, $mensaje) === true) {
            echo "Correo enviado correctamente. Revisa tu bandeja de entrada.";
        } else {
            echo "Error al enviar el correo.";
        }

        $updateStmt->close();
    } else {
        echo "El correo electrónico o nombre de usuario no existen en nuestra base de datos.";
    }

    $stmt->close();
    $conexion->close();
}
?>
