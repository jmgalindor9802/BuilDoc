<?php

require 'conexion.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

    // Obtener datos del formulario
    $nombre = $_POST["ProyectoNombre"];
    $municipio = $_POST["ProyectoMunicipio"];
    $direccion = $_POST["ProyectoDireccion"];
    $descripcion = $_POST["ProyectoDescripcion"];
    $ruta = $_POST["ProyectoRuta"];
    $cliente = $_POST["ProyectoCliente"];

    $insert_proyecto = $conectar->prepare("INSERT INTO ga_proyecto (proNombre, proMunicipio, proDireccion, proDescripcion, proRuta, fk_id_cliente) 
    VALUES (?, ?, ?, ?, ?, ?)");
    $insert_proyecto->bind_param("sssssi", $nombre, $municipio, $direccion, $descripcion, $ruta, $cliente);

    if ($insert_proyecto->execute()) {
        $id_proyecto = $insert_proyecto->insert_id;
        if (isset($_POST["usuarios_proyecto"]) && is_array($_POST["usuarios_proyecto"])) {
            $usuarios_asignados = $_POST["usuarios_proyecto"];
            foreach ($usuarios_asignados as $id_usuario) {
                $insert_intermedia = $conectar->prepare("INSERT INTO usuarios_proyectos (fk_id_usuario, fk_id_proyecto) VALUES (?, ?)");
                $insert_intermedia->bind_param("ii", $id_usuario, $id_proyecto);
                $insert_intermedia->execute();
            }
        }
        echo "Proyecto creado exitosamente.";
    } else {
        echo "Error al crear el proyecto: " . $insert_proyecto->error;
    }

    $insert_proyecto->close();
} else {
    echo "Error: Datos de formulario incompletos.";
}

mysqli_close($conectar);
?>