<?php
require_once '../modelo/Roles.php';


class RolesController {
    private $rolesModelo;

    public function __construct() {
        $conexion = new Conexion();
        $this->rolesModelo = new Roles($conexion->Conectar());
    }

    public function crear($nombre, $valor) {
        // Depuración de los datos recibidos
        var_dump($_POST);
    
        if ($this->rolesModelo->verificarRolExistente($nombre)) {
            echo "
            <script>
                Swal.fire({
                    title: 'Error',
                    text: 'El Rol ya existe.',
                    icon: 'error'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'RolesCrear.php'; // Redirige a la página de creación
                    }
                });
            </script>";
            exit; // Detener la ejecución del script
        } else {
            $resultado = $this->rolesModelo->crearRol($nombre, $valor);
            if ($resultado) {
                echo "
                <script>
                    Swal.fire({
                        title: 'Completado',
                        text: 'Rol creado correctamente.',
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'RolesIndex.php'; // Redirige a la lista de roles
                        }
                    });
                </script>";
            } else {
                echo "
                <script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al crear el rol.',
                        icon: 'error'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'RolesCrear.php'; // Redirige a la página de creación
                        }
                    });
                </script>";
            }
            exit; // Detener la ejecución del script
        }
    }
    
    
    

    public function eliminar($id) {
        $this->rolesModelo->eliminarRol($id);
        echo "<script>
        swal({
           title: 'Completado',
           text: 'Rol eliminado correctamente.',
           icon: 'success',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
           }
        });
     </script>";
        exit;
        // Puedes agregar lógica adicional después de eliminar el rol si es necesario
    }

    public function modificar($id,$nombre, $valor) {
        $this->rolesModelo->modificarRol($id,$nombre, $valor);
        echo "<script>
        swal({
            title: 'Completado',
            text: 'Rol modificado correctamente.',
            icon: 'success',
        }).then((willRedirect) => {
            if (willRedirect) {
            window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
            }
        });
        </script>";
        // Puedes agregar lógica adicional después de modificar el rol si es necesario
    }
    
    public function verTodos() {
        return $this->rolesModelo->obtenerTodosRoles();
    }
    
    public function verPorId($id) {
        return $this->rolesModelo->verRolPorId($id);
    }

    public function buscarPorNombre($nombre) {
        return $this->rolesModelo->buscarRolPorNombre($nombre);
    }

    public function verificarRolExistente($nombre) {
        return $this->rolesModelo->verificarRolExistente($nombre);
    }

}