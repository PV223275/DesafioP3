<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro_usuarios";

try {
    $conexion = new mysqli($servername, $username, $password, $dbname);
    if ($conexion->connect_error) {
        throw new Exception("Conexión fallida: " . $conexion->connect_error);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

