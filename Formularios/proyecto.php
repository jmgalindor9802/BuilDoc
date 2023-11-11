<?php
require("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos del formulario principal
    $nombre = $_POST["ProyectoNombre"];
    $municipio = $_POST["ProyectoMunicipio"];
    $direccion = $_POST["ProyectoDireccion"];
    $descripcion = $_POST["ProyectoDescripcion"];
    $cliente = $_POST["ProyectoCliente"];

    // Consulta para la inserción en la tabla principal
    $insert_proyecto = "INSERT INTO ga_proyecto(proNombre, proMunicipio, proDireccion, proDescripcion, proRuta, fk_id_cliente) 
                       VALUES ('$nombre', '$municipio', '$direccion', '$descripcion', '', '$cliente')";

    // Ejecutar la consulta para insertar en ga_proyecto
    $result_proyecto = mysqli_query($conectar, $insert_proyecto);

    if ($result_proyecto) {
        // Obtener el ID del proyecto recién insertado
        $id_proyecto = mysqli_insert_id($conectar);

        // Datos del formulario de usuarios asignados
        $usuarios_asignados = isset($_POST["usuarios_proyecto"]) ? $_POST["usuarios_proyecto"] : [];

        // Consulta para la inserción en la tabla intermedia
        foreach ($usuarios_asignados as $id_usuario) {
            $insert_intermedia = "INSERT INTO usuarios_proyectos(fk_id_usuario, fk_id_proyecto) 
                                 VALUES ('$id_usuario', '$id_proyecto')";
            $result_intermedia = mysqli_query($conectar, $insert_intermedia);

        }

        echo "Proyecto creado exitosamente.";
    } else {
        echo "Error al crear el proyecto: " . mysqli_error($conectar);
    }
}

?>
