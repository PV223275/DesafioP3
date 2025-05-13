<?php
require "conexion.php";

$nombre = trim($_POST['nombre']);
$password = $_POST['password'];
$correo = trim($_POST['correo']);
$fecha = $_POST['fecha'];

if (!$nombre || !$password || !$correo || !$fecha) {
    echo 'Todos los campos son obligatorios.';
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo 'Correo inválido.';
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, password, correo, fecha_nacimiento) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $passwordHash, $correo, $fecha);

if ($stmt->execute()) {
    echo '<div class="alert alert-success">Usuario registrado exitosamente.</div>';
} else {
    echo '<div class="alert alert-danger">Error al registrar: ' . $conexion->error . '</div>';
}

$stmt->close();
$conexion->close();
?>
