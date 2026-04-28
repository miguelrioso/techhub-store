<?php
session_start();
require_once __DIR__ . "/../app/models/Usuario.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioModel = new Usuario();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $usuario = $usuarioModel->login($email, $password);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header("Location: /techhub/public/");
        exit;
    } else {
        $mensaje = "Correo o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

<form method="POST">
    <input type="email" name="email" placeholder="Correo" required><br><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>
    <button type="submit">Ingresar</button>
</form>

<p><?php echo $mensaje; ?></p>

</body>
</html>