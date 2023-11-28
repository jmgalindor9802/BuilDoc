<?php

require 'conexion.php';

// Verificar si los datos del formulario están presentes
var_dump($_GET);

if (isset($_GET["Id_recuperadoInspeccion"]) && !empty($_GET["Id_recuperadoInspeccion"])) {

    // Obtiene los datos del formulario
    $id_recuperado_inspeccion = $_GET["Id_recuperadoInspeccion"];
    $idInspeccion = $id_recuperado_inspeccion;

    // Utilizar una consulta preparada para evitar inyecciones SQL
    $sql = "DELETE FROM gii_inspeccion WHERE pk_id_inspeccion = ?";
    
    // Preparar la consulta
    $stmt = mysqli_prepare($conectar, $sql);

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "i", $idInspeccion);

    // Ejecutar la consulta
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        header("Location: Inspecciones_dashboar.php");
    } else {
        echo 'La eliminación falló';
    }

    // Cerrar la declaración preparada
    mysqli_stmt_close($stmt);

} else {
    echo "Error: Datos de formulario incompletos.";
}
?>