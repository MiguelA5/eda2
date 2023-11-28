<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa los datos del formulario y guarda la información del profesor en la base de datos
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Guarda la imagen del profesor en el servidor
    if ($_FILES["imagen_perfil"]["error"] == 0) {
        $nombre_imagen = "profesor.jpg"; // Cambia el nombre de la imagen si es necesario
        move_uploaded_file($_FILES["imagen_perfil"]["tmp_name"], $nombre_imagen);
    }

    // Redirige o muestra un mensaje de confirmación al usuario
    header("Location: inicio_sesion.php"); // Cambia la URL de redirección si es necesario
    exit;
}
?>
