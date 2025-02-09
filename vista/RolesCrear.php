<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Crear Nuevo Rol</h2>
    <form id="formRol" method="POST" action="../controlador/RolesController.php">
        <div class="form-group">
            <label for="nombre">Nombre del Rol:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
            <small id="nombreHelp" class="form-text text-muted">Solo se permiten letras y debe tener al menos 4 caracteres.</small>
        </div>

        <div class="form-group">
            <label for="valor">Valor del Rol:</label>
            <select id="valor" name="valor" class="form-control" required>
                <option value="">Seleccione un valor</option>
                <option value="1">ADMINISTRADOR</option>
                <option value="2">SUPERVISOR</option>
                <option value="3">COLABORADOR</option>
            </select>
        </div>

                <div class="form-floating mb-3">
                    <button id="submitBtn" class="btn btn-outline-success" type="submit">Crear Rol. <i class="fa fa-check"></i></button>

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

    // Manejar el envío del formulario
    $('#formRol').on('submit', function(e) {
    e.preventDefault(); // Evitar el envío normal del formulario
    console.log("Formulario enviado"); // Verificar en la consola del navegador
    // Resto del código...
       

        // Aquí puedes realizar una validación adicional si es necesario

        Swal.fire({
            title: 'Confirmar',
            text: "¿Estás seguro de que deseas crear este rol?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, crear rol!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Enviar el formulario si se confirma
            }
        });
    });
});
</script>

</body>
</html>
