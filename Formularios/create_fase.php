<?php
require 'conexion.php';
var_dump($_POST);
// Verificar si los datos del formulario están presentes
if (
    isset($_POST["Nombre_fase"]) && !empty($_POST["Nombre_fase"]) &&
    isset($_POST["Proyecto_fase"]) && !empty($_POST["Proyecto_fase"]) &&
    isset($_POST["Descripcion_fase"]) && !empty($_POST["Descripcion_fase"])
) {
    // Obtener datos del formulario
    $Nombre = $_POST["Nombre_fase"];
    $Proyecto = $_POST["Proyecto_fase"];
    $Descripcion = $_POST[ "Descripcion_fase"];
    $Estado = "PENDIENTE";

    // Llamada al procedimiento almacenado
    $stmt = $conectar->prepare("CALL InsertarFase(?, ?, ?, ?)");
    $stmt->bind_param("sssi", $Nombre, $Descripcion, $Estado, $Proyecto);

    // Ejecutar la llamada al procedimiento almacenado
    if ($stmt->execute()) {
        echo "Los datos se almacenaron correctamente.";
    } else {
        echo "Error, no se guardaron los datos correctamente: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    mysqli_close($conectar);

    header("location: Tareas_dashboard.php");
} else {
    echo "Error: Datos de formulario incompletos.";
}
?>
