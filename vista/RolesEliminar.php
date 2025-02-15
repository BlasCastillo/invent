<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.10/sweetalert2.min.js" integrity="sha512-M60HsJC4M4A8pgBOj7oC/lvJXuOc9CraWXdD4PF+KNmKl8/Mnz6AH9FANgi4SJM6D9rqPvgQt4KRFR1rPN+EUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <?php
    require_once '../controlador/RolesController.php';

    // Obtener el ID del rol desde la URL
    $id = $_GET['id'];

    // Instanciar el controlador
    $rolesController = new RolesController();

    // Obtener los datos del rol para mostrar en la confirmación
    $rol = $rolesController->obtenerRol($id);

    // Si se confirma la eliminación, procesar la solicitud
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($rolesController->eliminarRol($id)) {
            // Mostrar mensaje de éxito y redirigir
            echo "<script>
                Swal.fire({
                    title: 'Completado',
                    text: 'Rol eliminado correctamente.',
                    icon: 'success',
                }).then((willRedirect) => {
                    if (willRedirect) {
                        window.location.href = 'RolesIndex.php'; // Redirige a la página principal
                    }
                });
            </script>";
            exit;
        } else {
            // Mostrar mensaje de error
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al eliminar el rol.',
                    icon: 'error',
                }).then((willRedirect) => {
                    if (willRedirect) {
                        window.location.href = 'RolesIndex.php'; // Redirige a la página principal
                    }
                });
            </script>";
            exit;
        }
    }
    ?>

    <div class="container mt-5">
        <h2>Eliminar Rol</h2>
        <p>¿Estás seguro de que deseas eliminar el siguiente rol?</p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nombre del Rol: <?php echo $rol['nombre']; ?></h5>
                <p class="card-text">Valor del Rol: <?php echo $rol['valor']; ?></p>
            </div>
        </div>

        <!-- Formulario para confirmar la eliminación -->
        <form id="formEliminarRol" method="POST" class="mt-4">
            <button type="submit" class="btn btn-danger">Eliminar Rol</button>
            <a href="RolesIndex.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>
        // Manejar el envío del formulario con confirmación
        $(document).ready(function() {
            $('#formEliminarRol').on('submit', function(event) {
                event.preventDefault(); // Evitar el envío inmediato del formulario

                // Mostrar la alerta de confirmación
                Swal.fire({
                    title: 'Confirmar',
                    text: "¿Estás seguro de que deseas eliminar este rol? Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar rol!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, enviar el formulario
                        this.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>