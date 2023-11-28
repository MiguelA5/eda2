<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $sexo = $_POST["sexo"];
    
    // Manejo de la imagen de perfil (foto)
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
        $nombre_foto = $_FILES["foto"]["name"];
        $ruta_foto = "carpeta_de_destino/" . $nombre_foto; // Establece la ruta de destino en tu servidor
        move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_foto);
    }

    // Conexión a la base de datos (debes configurar esto)
    $conexion = mysqli_connect("tu_host", "tu_usuario", "tu_contrasena", "tu_base_de_datos");

    if (!$conexion) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    // Escapar caracteres para evitar inyección SQL (mejora la seguridad)
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $contrasena = mysqli_real_escape_string($conexion, $contrasena);

    // Consulta SQL para insertar el registro en la base de datos
    $sql = "INSERT INTO usuarios (nombre, contrasena, fecha_nacimiento, sexo, foto) 
            VALUES ('$nombre', '$contrasena', '$fecha_nacimiento', '$sexo', '$ruta_foto')";

    if (mysqli_query($conexion, $sql)) {
        // Registro exitoso
        header("Location: index.html");
        exit(); // Asegura que no se procesen más instrucciones después de la redirección
    } else {
        echo "Error en el registro: " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>
