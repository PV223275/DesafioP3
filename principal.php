<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="container mt-5">
    <h2 class="mb-4">Formulario de Registro</h2>
    <form id="formulario">
        <div class="mb-3">
            <label>Nombre completo</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
            <label>Correo electrónico</label>
            <input type="email" name="correo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-outline-success">Registrar</button>
    </form>
    <!--Se muestra la tabla-->
    <hr class="my-4">
    <h3>Usuarios Registrados</h3>
    <div id="tablaUsuarios"></div>

    <script>
        //Funcion para cargar los usuarios
        function cargarUsuarios() {
            $.get("obtener_usuarios.php", function (data) {
                $("#tablaUsuarios").html(data);
            });
        }
        //Llamado a la funcion para agregar los usarios a la tabla
        $(document).ready(function () {
            cargarUsuarios();
            
            $("#formulario").on("submit", function (e) {
                e.preventDefault();
                $.post("insertar.php", $(this).serialize(), function (res) {
                    alert(res);
                    $("#formulario")[0].reset();
                    cargarUsuarios();
                });
            });

            $(document).on("click", ".btn-eliminar", function () {
                const id = $(this).data("id");
                if (confirm("¿Estás seguro de eliminar este usuario?")) {
                    $.post("eliminar.php", { id: id }, function (res) {
                        alert(res);
                        cargarUsuarios();
                    });
                }
            });

            $(document).on("click", ".btn-actualizar", function () {
                const fila = $(this).closest("tr");
                const id = $(this).data("id");
                const nombre = fila.find(".nombre").text();
                const correo = fila.find(".correo").text();

                const nuevoNombre = prompt("Nuevo nombre:", nombre);
                const nuevoCorreo = prompt("Nuevo correo:", correo);

                if (nuevoNombre && nuevoCorreo) {
                    $.post("actualizar.php", { id, nombre: nuevoNombre, correo: nuevoCorreo }, function (res) {
                        alert(res);
                        cargarUsuarios();
                    });
                }
            });
        });
    </script>
</body>

</html>