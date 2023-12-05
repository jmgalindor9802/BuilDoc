<?php

  var_dump($_POST);
require '../conexion.php';

// Verificar si los datos del formulario están presentes
if (
    isset($_POST["Nombre_Tarea"]) && !empty($_POST["Nombre_Tarea"]) &&
    isset($_POST["descripcionTarea"]) && !empty($_POST["descripcionTarea"]) &&
    isset($_POST["prioridad"]) && !empty($_POST["prioridad"]) &&
    isset($_POST["fechaLimite"]) && !empty($_POST["fechaLimite"]) &&
    isset($_POST["Fase_tarea"]) && !empty($_POST["Fase_tarea"]) &&
    isset($_POST["usuarios_tareas"]) && !empty($_POST["usuarios_tareas"])
) {

       // Imprime los datos del formulario para depuración
       var_dump($_POST);
    // Obtener datos del formulario
    $Nombre = $_POST["Nombre_Tarea"];
    $Descripcion = $_POST["descripcionTarea"];
    $Prioridad = $_POST["prioridad"];
    $FechaLimite = $_POST["fechaLimite"];
    $Fase = $_POST["Fase_tarea"];
    $TareaDependiente = isset($_POST["tarea_tarea_dependiente"]) ? $_POST["tarea_tarea_dependiente"] : null;
    $Usuario = $_POST["usuarios_tareas"];
   
    // Llamada al procedimiento almacenado
    $stmt = $conectar->prepare("CALL InsertarTarea(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiii", $Nombre, $Descripcion, $Prioridad, $FechaLimite, $Fase, $TareaDependiente, $Usuario);

    // Ejecutar la llamada al procedimiento almacenado
    if ($stmt->execute()) {
        // Imprimir mensaje en la consola del navegador
        echo "<script>console.log('Procedimiento almacenado ejecutado con éxito.');</script>";
        
        // Redirigir a la página de tareas o a donde desees
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
