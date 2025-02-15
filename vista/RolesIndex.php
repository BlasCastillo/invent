<?php
require_once '../controlador/RolesController.php';

$rolesController = new RolesController();
$roles = $rolesController->verTodos(); // Obtener todos los roles
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Gestión de Roles</h2>
    <a href="RolesCrear.php" class="btn btn-primary mb-3">Crear Nuevo Rol</a>

    <?php if (is_array($roles) && count($roles) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $rol): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rol['id']); ?></td>
                        <td><?php echo htmlspecialchars($rol['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($rol['valor']); ?></td>
                        <td>
                            <a href="RolesEditar.php?id=<?php echo $rol['id']; ?>" class="btn btn-warning">Modificar</a>
                            <a href="RolesEliminar.php?id=<?php echo $rol['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No hay roles disponibles.</div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>