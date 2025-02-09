<?php
// Incluimos el archivo de conexión
require_once 'config/conexion.php';

// Creamos una instancia de la clase Conexion
$conexion = new Conexion();

// Intentamos conectar a la base de datos
try {
    $conn = $conexion->Conectar();
    if ($conn) {
        echo "Conectado a la BD";
    }
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>