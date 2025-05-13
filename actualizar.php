<?php
require "conexion.php";

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "Correo inválido.";
    exit;
}

$stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?");
$stmt->bind_param("ssi", $nombre, $correo, $id);

echo $stmt->execute() ? "Usuario actualizado." : "Error al actualizar.";
$stmt->close();
$conexion->close();
?>
