$(document).ready(function() {
    // Validar que solo se ingresen números en el campo de usuario
    $('#usuario').on('input', function() {
        let usuario = $(this).val();
        // Si se detecta un carácter no numérico, mostrar alerta y limpiar el campo
        if (!/^\d+$/.test(usuario)) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Solo se permiten números.',
            });
            $(this).val(usuario.replace(/\D/g, ''));
        }
    });

    // Validar el formulario al hacer submit
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío del formulario
        let usuario = $('#usuario').val();
        let clave = $('#clave').val();

        // Validar que el usuario tenga entre 7 y 8 dígitos
        if (usuario.length < 7 || usuario.length > 8) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El usuario debe tener entre 7 y 8 dígitos.',
            });
            return;
        }

        // Validar que el usuario esté dentro del rango 3000000 y 40000000
        let numeroUsuario = parseInt(usuario);
        if (numeroUsuario < 3000000 || numeroUsuario > 40000000) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El usuario debe estar entre 3000000 y 40000000.',
            });
            return;
        }

        // Si todo está correcto, mostrar mensaje de éxito
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Formulario enviado correctamente.',
        }).then(() => {
            // Aquí podrías agregar la lógica para enviar el formulario
            // window.location.href = 'ruta_de_destino';
        });
    });
});