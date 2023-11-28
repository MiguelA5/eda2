<?php
// Conexión a la base de datos (reemplaza estos valores por los de tu propia base de datos)
$servername = "tu_servidor";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los resultados enviados por AJAX
$data = json_decode(file_get_contents("php://input"), true);

// Insertar los resultados en la base de datos
$visual = $data['visual'];
$auditivo = $data['auditivo'];
$cinestesico = $data['cinestesico'];

// Aquí deberías escribir la consulta SQL para insertar los resultados en tu base de datos
// Por ejemplo:
$sql = "INSERT INTO resultados (visual, auditivo, cinestesico) VALUES ($visual, $auditivo, $cinestesico)";

if ($conn->query($sql) === TRUE) {
    echo "Resultados insertados correctamente en la base de datos";
} else {
    echo "Error al insertar resultados: " . $conn->error;
}

// Cierra la conexión a la base de datos
$conn->close();
?>
