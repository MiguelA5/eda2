<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
$conexion = new mysqli("servidor", "usuario", "contraseña", "basededatos");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Recuperar el ID del usuario desde la URL (suponiendo que se pasa como un parámetro llamado "id")
$id_usuario = $_GET['id'];

// Consulta SQL para recuperar los datos del usuario
$query = "SELECT nombre, correo, otro_campo FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $nombre = $row['nombre'];
    $correo = $row['correo'];
    $otro_campo = $row['otro_campo'];

    // Muestra la información del perfil
    echo "<h1>Perfil de $nombre</h1>";
    echo "<p>Nombre: $nombre</p>";
    echo "<p>Correo Electrónico: $correo</p>";
    echo "<p>Otro Campo: $otro_campo</p>";

} else {
    echo "Usuario no encontrado.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
