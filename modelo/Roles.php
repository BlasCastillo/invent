<?php

//conexion
require_once '../config/Conexion.php';

class Roles
{

    //para la conexion
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->Conectar();
    }


    //para los datos
    private $id;
    private $nombre;
    private $valor;


    //setters y getters
    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

    public function getValor(){
        return $this->valor;
        }
        
    public function setValor($valor){
        $this->valor = $valor;
    }

    public function crearRol($nombre, $valor) {
        try {
            echo "Datos recibidos en el modelo: Nombre - $nombre, Valor - $valor"; // Depuración
            $query = "INSERT INTO roles (nombre, valor) VALUES (:nombre, :valor)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':valor', $valor);
            $stmt->execute();
            echo "Rol creado exitosamente"; // Depuración
            return true;
        } catch(PDOException $e) {
            echo "Error al crear los roles: " . $e->getMessage();
            return false;
        }
    }
    

    public function actualizarRol($id, $nombre, $valor) {
        try {
            $query = "UPDATE roles SET nombre = :nombre, valor = :valor WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':valor', $valor);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al actualizar los roles: ". $e->getMessage();
            return false;
        }
    }

    public function eliminarRol($id) {
        try {
            $query = "DELETE FROM roles WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error al eliminar los roles: ". $e->getMessage();
            return false;
        }
    }

    public function obtenerTodosRoles() {
        try {
            $query = "SELECT * FROM roles";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener los roles: ". $e->getMessage();
            return false;
        }
    }

    public function obtenerRolPorId($id) {
        try {
            $query = "SELECT * FROM roles WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener el rol: ". $e->getMessage();
            return false;
        }
    }

    public function buscarRolPorNombre($nombre) {
        try {
            $query = "SELECT * FROM roles WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindValue(':nombre', "%$nombre%");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al buscar los roles: " . $e->getMessage();
            return false;
        }
    }

    public function verificarRolExistente($nombre) {
        try {
            $query = "SELECT COUNT(*) FROM roles WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch(PDOException $e) {
            echo "Error al verificar los roles: " . $e->getMessage();
            return false;
        }
    }
}