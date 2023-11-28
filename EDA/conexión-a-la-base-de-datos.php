<?php
// Sección de conexión a la base de datos
$servername = "localhost"; // Reemplaza con la dirección del servidor de tu base de datos
$username = "root"; // Reemplaza con el nombre de usuario de la base de datos
$password = ""; // Reemplaza con la contraseña de la base de datos
$database = "EDA"; // Reemplaza con el nombre de tu base de datos

// Crear una conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

echo "Conexión exitosa"; // Esto se mostrará si la conexión es exitosa

// Puedes realizar consultas y otras operaciones en la base de datos aquí

// Cerrar la conexión cuando hayas terminado
$conexion->close();
?>
