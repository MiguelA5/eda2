<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos (debes configurar esto)
    $conexion = mysqli_connect("tu_host", "tu_usuario", "tu_contrasena", "tu_base_de_datos");

    if (!$conexion) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    // Recupera los datos del formulario
    $nombreUsuario = $_POST["nombreUsuario"];
    $correo = $_POST["correo"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $sexo = $_POST["sexo"];
    
    // Escapar caracteres para evitar inyección SQL (mejora la seguridad)
    $nombreUsuario = mysqli_real_escape_string($conexion, $nombreUsuario);
    $correo = mysqli_real_escape_string($conexion, $correo);
    $fechaNacimiento = mysqli_real_escape_string($conexion, $fechaNacimiento);
    $sexo = mysqli_real_escape_string($conexion, $sexo);

    // ID del usuario (cambia 1 por el ID del usuario deseado)
    $usuarioID = 1;

    // Consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE Usuarios SET NombreUsuario = '$nombreUsuario', Correo = '$correo', FechaNacimiento = '$fechaNacimiento', Sexo = '$sexo' WHERE ID = $usuarioID";

    if (mysqli_query($conexion, $sql)) {
        // Redirige de vuelta al perfil
        header("Location: perfil.php?id=$usuarioID");
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>
