<?php
require '../conexion.php';

// Verificar si los datos del formulario están presentes
if (
    isset($_POST["Nombre_fase"]) && !empty($_POST["Nombre_fase"]) &&
    isset($_POST["Proyecto_fase"]) && !empty($_POST["Proyecto_fase"]) &&
    isset($_POST["Descripcion_fase"]) && !empty($_POST["Descripcion_fase"])
) {
    // Obtener datos del formulario
    $Nombre = $_POST["Nombre_fase"];
    $Proyecto = $_POST["Proyecto_fase"];
    $Descripcion = $_POST["Descripcion_fase"];
    $Estado = "PENDIENTE";

    // Llamada al procedimiento almacenado
    $stmt = $conectar->prepare("CALL InsertarFase(?, ?, ?, ?)");
    $stmt->bind_param("sssi", $Nombre, $Descripcion, $Estado, $Proyecto);

    // Ejecutar la llamada al procedimiento almacenado
    if ($stmt->execute()) {
        // Imprimir mensaje en la consola del navegador
        echo "<script>console.log('Procedimiento almacenado ejecutado con éxito.');</script>";
        
        // Redirigir a Inspecciones_dashboard.php
        header("Location: Tareas_dashboard.php");
        // Cerrar la conexión y liberar recursos
        $stmt->close();
        mysqli_close($conectar);
    } else {
        // Imprimir mensaje de error en la consola del navegador
        echo "<script>console.error('Error al ejecutar el procedimiento almacenado: " . $stmt->error . "');</script>";
    }
} else {
    // Imprimir mensaje en la consola del navegador
    echo "<script>console.error('Error: Datos de formulario incompletos.');</script>";
}
?>