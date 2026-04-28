<?php
require_once __DIR__ . "/../app/models/Usuario.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = new Usuario();

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($usuario->registrar($nombre, $email, $password)) {
        $mensaje = "Usuario registrado correctamente";
    } else {
        $mensaje = "Error al registrar usuario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<h2>Registro de Usuario</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required><br><br>
    <input type="email" name="email" placeholder="Correo" required><br><br>
    <input type="password" name="password" placeholder="Contraseña" required><br><br>
    <button type="submit">Registrarse</button>
</form>

<p><?php echo $mensaje; ?></p>

</body>
</html>