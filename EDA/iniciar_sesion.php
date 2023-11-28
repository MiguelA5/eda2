<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contrasena_usuario = $_POST["contrasena_usuario"];
    
    // Conexión a la base de datos (debes configurar esto)
    $conexion = mysqli_connect("localhost", "root", "", "EDA");

    if (!$conexion) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    // Escapar caracteres para evitar inyección SQL (mejora la seguridad)
    $nombre_usuario = mysqli_real_escape_string($conexion, $nombre_usuario);
    $contrasena_usuario = mysqli_real_escape_string($conexion, $contrasena_usuario);

    // Consulta SQL para verificar el inicio de sesión
    $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre_usuario' AND contrasena = '$contrasena_usuario'";

    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        // Inicio de sesión exitoso
        session_start(); // Inicia una sesión si aún no se ha iniciado
        $_SESSION["nombre_usuario"] = $nombre_usuario;
        // Verifica si el usuario ya ha iniciado sesión antes
        if (isset($_SESSION["primer_inicio"])) {
            header("Location: formulario_de_registro.html"); // Redirige al formulario de registro
        } else {
            $_SESSION["primer_inicio"] = true;
            header("Location: index.html"); // Redirige al usuario a la página principal
        }
        exit(); // Asegura que no se procesen más instrucciones después de la redirección
    } else {
        echo "Nombre de usuario o contraseña incorrectos. Inténtalo nuevamente.";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>
