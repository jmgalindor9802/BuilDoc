<?php
// Requerir el archivo de conexión
require '../conexion.php';

// Verificar si se ha enviado una solicitud POST (para AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $cedula = $_POST["Cedula"];
    $nombre = $_POST["NombreUsu"];
    $apellido = $_POST["ApellidoUsu"];
    $eps = $_POST["EPS"];
    $arl = $_POST["ARL"];
    $fechaNacimiento = $_POST["FechaNacimiento"];
    $municipio = $_POST["MunicipioUsu"];
    $direccion = $_POST["DireccionUsu"];
    $correo = $_POST["CorreoUsu"];
    $telefono = $_POST["TelefonoUsu"];
    $profesion = $_POST["ProfesionUsu"];
    $contrasenia = $_POST["ContraseniaUsu"];

    // Consulta para verificar si el usuario ya existe
    $consulta_usuario = $conectar->prepare("SELECT pk_id_usuario FROM usuario WHERE pk_id_usuario = ?");
    $consulta_usuario->bind_param("i", $cedula);
    $consulta_usuario->execute();
    $resultado = $consulta_usuario->get_result();

    if ($resultado->num_rows > 0) {
        echo "2"; // El usuario ya existe
    } else {
        // Preparar la consulta de inserción
        $insert_usuario = $conectar->prepare("INSERT INTO usuario 
            (pk_id_usuario, usuNombre, usuApellido, usuNombre_eps, usuNombre_arl, usuFecha_nacimiento,
            usuMunicipio, usuDireccion_residencia, usuProfesion, usuContrasenia, usuTelefono, usuCorreo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_usuario->bind_param("isssssssssss", $cedula, $nombre, $apellido, $eps, $arl, $fechaNacimiento, 
            $municipio, $direccion, $profesion, $contrasenia, $telefono, $correo);

        // Ejecutar la consulta de inserción
        if ($insert_usuario->execute()) {
            echo 1;
            header("location:Usuario_dashboard.php");
        } else {
            echo "0"; // Error al crear el usuario
        }

        // Cerrar la consulta de inserción
        $insert_usuario->close();
    }

    // Cerrar la consulta de verificación de usuario
    $consulta_usuario->close();
} else {
    // Si los datos del formulario están incompletos o se accede directamente al archivo PHP, puedes manejarlo aquí.
    echo "Error: Acceso inválido.";
}
?>
