<?php
require_once '../modelo/Roles.php';


class RolesController
{
    private $rolesModelo;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->rolesModelo = new Roles($conexion->Conectar());
    }

    public function crear($nombre, $valor)
    {

        if ($this->rolesModelo->verificarRolExistente($nombre)) {
            echo "<script>
            Swal.fire({
               title: 'Error',
               text: 'El Rol ya existe.',
               icon: 'error',
            }).then((willRedirect) => {
               if (willRedirect) {
                  window.location.href = 'RolesCrear.php'; // Redirige a tu página PHP
               }
            });
         </script>";
            exit;
        }
        if ($this->rolesModelo->crearRol($nombre, $valor)) {
            
            echo "<script>
             Swal.fire({
                title: 'Completado',
                text: 'Rol creado correctamente.',
                icon: 'success',
             }).then((willRedirect) => {
                if (willRedirect) {
                   window.location.href = 'RolesIndex.php'; // Redirige a tu página PHP
                }
             });
          </script>";
            exit;
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

    /*     public function crear($nombre, $valor, $descripcion, $fk_cargo)
    {
        
    } */

    public function editar($id, $nombre, $valor)
{
    if ($this->rolesModelo->verificarRolExistente($nombre, $id)) {
        echo "<script>
        Swal.fire({
           title: 'Error',
           text: 'El Rol ya existe.',
           icon: 'error',
        }).then((willRedirect) => {
           if (willRedirect) {
              window.location.href = 'RolesEditar.php?id=$id'; // Redirige a la página de edición
           }
        });
     </script>";
        exit;
    }
    if ($this->rolesModelo->editarRol($id, $nombre, $valor)) {
        echo "<script>
         Swal.fire({
            title: 'Completado',
            text: 'Rol actualizado correctamente.',
            icon: 'success',
         }).then((willRedirect) => {
            if (willRedirect) {
               window.location.href = 'RolesIndex.php'; // Redirige a la página principal
            }
         });
      </script>";
        exit;
    } else {
        echo "
            <script>
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al actualizar el rol.',
                    icon: 'error'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'RolesEditar.php?id=$id'; // Redirige a la página de edición
                    }
                });
            </script>";
    }
    exit; // Detener la ejecución del script
}

public function obtenerRol($id)
{
    // Llamar a la función del modelo para obtener el rol por ID
    $rol = $this->rolesModelo->obtenerRolPorId($id);

    if ($rol) {
        return $rol; // Retornar el rol si existe
    } else {
        // Mostrar un mensaje de error si el rol no existe
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'El rol no existe.',
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

public function eliminarRol($id)
{
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



    

    public function verTodos()
    {
        return $this->rolesModelo->obtenerTodosRoles();
    }

    /*     public function verPorId($id) {
        return $this->rolesModelo->verRolPorId($id);
    } */

    public function buscarPorNombre($nombre)
    {
        return $this->rolesModelo->buscarRolPorNombre($nombre);
    }

    public function verificarRolExistente($nombre)
    {
        return $this->rolesModelo->verificarRolExistente($nombre);
    }
}
