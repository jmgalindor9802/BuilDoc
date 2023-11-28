<?php

require 'conexion.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

    // Obtener datos del formulario
    $cedula = $_POST["Cedula"];
    $nombre = $_POST["NombreUsu"];
    $apellido = $_POST["ApellidoUsu"];
    $eps = $_POST["EPS"];
    $arl = $_POST["ARL"];
    $fechaNacimiento = $_POST["FechaNacimientoUsu"];
    $direccion = $_POST["DireccionUsu"];
    $municipio = $_POST["MunicipioUsu"];
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
        // El usuario ya existe, redirigir al formulario nuevamente con un mensaje
        header("Location: formulario.php?error=usuario_existente");
        exit();
    } else {
        // El usuario no existe, proceder con la inserción
        $insert_usuario = $conectar->prepare("INSERT INTO usuario 
            (pk_id_usuario, usuNombre, usuApellido, usuNombre_eps, usuNombre_arl, usuFecha_nacimiento,
            usuMunicipio, usuDireccion_residencia, usuProfesion, usuContrasenia, usuTelefono, usuCorreo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_usuario->bind_param("isssssssssss", $cedula, $nombre, $apellido, $eps, $arl, $fechaNacimiento, 
            $direccion, $municipio, $profesion, $contrasenia, $telefono, $correo);

        if ($insert_usuario->execute()) {
            // Usuario creado exitosamente
            echo "Usuario creado exitosamente.";
        } else {
            // Error al crear el usuario
            echo "Error al crear el usuario: " . $insert_usuario->error;
        }

        $insert_usuario->close();
    }

    $consulta_usuario->close();
} else {
    // Datos de formulario incompletos
    echo "Error: Datos de formulario incompletos.";
}


?>