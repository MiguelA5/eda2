<?php
// Archivo: procesar_asignacion.php

// Conexión a la base de datos (ajusta los valores)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$database = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET["mostrar_usuarios"])) {
    // Consulta SQL para obtener la lista de usuarios asignados al profesor
    $sql = "SELECT id, nombre FROM usuarios WHERE profesor_id = ?"; // Ajusta la consulta según tu base de datos
    $stmt = $conn->prepare($sql);

    // Proporciona el ID del profesor (ajusta esto según tus necesidades)
    $profesor_id = 1; // Cambia esto para obtener el ID del profesor actual
    $stmt->bind_param("i", $profesor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $usuarios = array();
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }

    $stmt->close();
    echo json_encode($usuarios);
} elseif (isset($_GET["cargar_actividades"])) {
    // Consulta SQL para obtener la lista de actividades (ajusta según tus necesidades)
    $sql = "SELECT id, nombre FROM actividades"; // Ajusta la consulta según tu base de datos
    $result = $conn->query($sql);

    $actividades = array();
    while ($row = $result->fetch_assoc()) {
        $actividades[] = $row;
    }

    echo json_encode($actividades);
} elseif (isset($_GET["mostrar_detalle_usuario"])) {
    // Consulta SQL para obtener y mostrar los detalles de un usuario (ajusta según tus necesidades)
    $usuario_id = $_GET["mostrar_detalle_usuario"];
    $sql = "SELECT * FROM usuarios WHERE id = ?"; // Ajusta la consulta según tu base de datos
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    // Muestra los detalles del usuario
    echo "Detalles del Usuario:<br>";
    echo "ID: " . $usuario["id"] . "<br>";
    echo "Nombre: " . $usuario["nombre"] . "<br>";
    echo "Correo: " . $usuario["correo"] . "<br>";

    $stmt->close();
}

// Cierra la conexión a la base de datos
$conn->close();
