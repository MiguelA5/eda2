<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "nombre_usuario", "contraseña", "base_de_datos");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener la lista de usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios Registrados</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
        </tr>

        <?php foreach ($usuarios as $usuario) : ?>
            <tr>
                <td><?php echo $usuario["id"]; ?></td>
                <td><?php echo $usuario["nombre"]; ?></td>
                <td><?php echo $usuario["correo"]; ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if (empty($usuarios)) : ?>
            <tr>
                <td colspan="3">No se encontraron usuarios registrados.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
