<?php
require "conexion.php";

$resultado = $conexion->query("SELECT id, nombre, correo, fecha_nacimiento FROM usuarios");

echo '<table class="table table-bordered">';
echo '<thead><tr><th>Nombre</th><th>Correo</th><th>Fecha Nacimiento</th><th>Acciones</th></tr></thead>';
echo '<tbody>';

while ($row = $resultado->fetch_assoc()) {
    echo "<tr>
        <td class='nombre'>{$row['nombre']}</td>
        <td class='correo'>{$row['correo']}</td>
        <td>{$row['fecha_nacimiento']}</td>
        <td>
            <button class='btn btn-warning btn-sm btn-actualizar' data-id='{$row['id']}'>Actualizar</button>
            <button class='btn btn-danger btn-sm btn-eliminar' data-id='{$row['id']}'>Eliminar</button>
        </td>
    </tr>";
}

echo '</tbody></table>';
$conexion->close();
?>
