<?php
// Requerir el archivo de conexión
require '../conexion.php';

// Verificar si se ha enviado una solicitud POST (para AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $NIT = $_POST["ClienteNIT"];
    $nombre = $_POST["ClienteNombre"];
    $correo = $_POST["ClienteCorreo"];
    $telefono = $_POST["ClienteTelefono"];


    // Consulta para verificar si el usuario ya existe
    $consulta_cliente = $conectar->prepare("SELECT pk_id_cliente FROM ga_cliente WHERE pk_id_cliente = ?");
    $consulta_cliente->bind_param("i", $NIT);
    $consulta_cliente->execute();
    $resultado = $consulta_cliente->get_result();

    if ($resultado->num_rows > 0) {
        echo "2"; // El usuario ya existe
    } else {
        // Preparar la consulta de inserción
        $insert_cliente = $conectar->prepare("INSERT INTO ga_cliente 
            (pk_id_cliente, cliNombre, cliCorreo, cliTelefono) 
            VALUES (?, ?, ?, ?)");
        $insert_cliente->bind_param("isss", $NIT, $nombre, $correo, $telefono);

        // Ejecutar la consulta de inserción
        if ($insert_cliente->execute()) {
            echo 1;
            header("location:Cliente_dashboard.php");
        } 
        // Cerrar la consulta de inserción
        $insert_cliente->close();
    }

    // Cerrar la consulta de verificación de usuario
    $consulta_cliente->close();
} else {
    // Si los datos del formulario están incompletos o se accede directamente al archivo PHP, puedes manejarlo aquí.
    echo "Error: Acceso inválido.";
}
?>
