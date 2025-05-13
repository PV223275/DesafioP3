<?php
require "conexion.php";

$id = $_POST['id'];

$stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo 'Usuario eliminado exitosamente.';
} else {
    echo 'Error al eliminar usuario: ' . $conexion->error .;
}

$stmt->close();
$conexion->close();
?>