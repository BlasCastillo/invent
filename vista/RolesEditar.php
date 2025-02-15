<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.15.10/sweetalert2.min.js" integrity="sha512-M60HsJC4M4A8pgBOj7oC/lvJXuOc9CraWXdD4PF+KNmKl8/Mnz6AH9FANgi4SJM6D9rqPvgQt4KRFR1rPN+EUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <?php
    require_once '../controlador/RolesController.php';
    

    $id = $_GET['id'];
    $rolesController = new RolesController();
    $rol = $rolesController->obtenerRol($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = ucfirst($_POST['nombre']);
        $valor = ucfirst($_POST['valor']);
        $rolcontroller = new RolesController();
        $rolcontroller->editar($id, $nombre, $valor);
    }
    ?>
    <div class="container mt-5">
        <h2>Editar Rol</h2>
        <form id="formRol" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Rol:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $rol['nombre']; ?>" required>
                <small id="nombreHelp" class="form-text text-muted">Solo se permiten letras y debe tener al menos 4 caracteres.</small>
            </div>

            <div class="form-group">
                <label for="valor">Valor del Rol:</label>
                <select id="valor" name="valor" class="form-control" required>
                    <option value="">Seleccione un valor</option>
                    <option value="1" <?php echo ($rol['valor'] == 1) ? 'selected' : ''; ?>>ADMINISTRADOR</option>
                    <option value="2" <?php echo ($rol['valor'] == 2) ? 'selected' : ''; ?>>SUPERVISOR</option>
                    <option value="3" <?php echo ($rol['valor'] == 3) ? 'selected' : ''; ?>>COLABORADOR</option>
                </select>
            </div>

            <div class="form-floating mb-3">
                <button id="submitBtn" class="btn btn-outline-success" type="submit">Actualizar Rol. <i class="fa fa-check"></i></button>

                <a class="btn btn-outline-info" href="RolesIndex.php">Volver <i class="fa fa-right-to-bracket"></i></a>
            </div>
        </form>
    </div>

    <script>
        // Validaciones con jQuery
        $(document).ready(function() {
            $('#nombre').on('keypress', function(e) {
                // Permitir solo letras (A-Z, a-z) y espacios
                var char = String.fromCharCode(e.which);
                if (!/[A-Za-z\s]/.test(char)) {
                    e.preventDefault();
                }
            });

            $('#nombre').on('input', function() {
                // Convertir a mayúsculas
                this.value = this.value.toUpperCase();

                // Validar longitud mínima
                if (this.value.length >= 4 && this.value.trim() !== "") {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });

            // Validar el select
            $('#valor').on('change', function() {
                if ($(this).val() !== "" && $('#nombre').val().length >= 4) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });
            //  fin de Validaciones con jQuery


            // Manejar el envío del formulario
            $('#formRol').on('submit', function(e) {
                e.preventDefault(); // Evitar el envío normal del formulario
            });
            // Suponiendo que tienes un evento para el envío del formulario
            $('#formRol').on('submit', function(event) {
                event.preventDefault(); // Evitar el envío inmediato del formulario

                // Mostrar la alerta de confirmación
                Swal.fire({
                    title: 'Confirmar',
                    text: "¿Estás seguro de que deseas actualizar este rol?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, actualizar rol!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, enviar el formulario
                        this.submit(); // Envía el formulario
                    }
                });
            });
        });
    </script>

</body>

</html>