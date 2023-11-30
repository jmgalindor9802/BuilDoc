<?php

require '../conexion.php';

// Verificar si los datos del formulario están presentes
var_dump($_GET);

if (isset($_GET["Id_recuperadoIncidente"]) && !empty($_GET["Id_recuperadoIncidente"])) {

    // Obtiene los datos del formulario
    $id_recuperado_incidente = $_GET["Id_recuperadoIncidente"];
    $idIncidente = $id_recuperado_incidente;

    // Utilizar una consulta preparada para evitar inyecciones SQL
    $sql = "DELETE FROM gii_incidente WHERE pk_id_incidente = ?";
    
    // Preparar la consulta
    $stmt = mysqli_prepare($conectar, $sql);

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "i", $idIncidente);

    // Ejecutar la consulta
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        header("Location: Incidentes_dashboard.php");
    } else {
        echo 'La eliminación falló';
    }

    // Cerrar la declaración preparada
    mysqli_stmt_close($stmt);

} else {
    echo "Error: Datos de formulario incompletos.";
}
?>