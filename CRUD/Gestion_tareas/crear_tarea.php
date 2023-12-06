<?php

  var_dump($_POST);
  var_dump($_POST["Nombre_Tarea"], $_POST["descripcionTarea"], $_POST["prioridad"], $_POST["fechaLimite"], $_POST["Fase_tarea"], $_POST["usuarios_tareas"]);

require '../conexion.php';

// Verificar si los datos del formulario están presentes
if (
    isset($_POST["Nombre_Tarea"], $_POST["descripcionTarea"], $_POST["prioridad"], $_POST["fechaLimite"], $_POST["Fase_tarea"], $_POST["usuarios_tareas"]) &&
    !empty($_POST["Nombre_Tarea"]) && !empty($_POST["descripcionTarea"]) && !empty($_POST["prioridad"]) && !empty($_POST["fechaLimite"]) && !empty($_POST["Fase_tarea"]) && !empty($_POST["usuarios_tareas"])
) {

       // Imprime los datos del formulario para depuración
       var_dump($_POST);
       var_dump($_POST["Nombre_Tarea"], $_POST["descripcionTarea"], $_POST["prioridad"], $_POST["fechaLimite"], $_POST["Fase_tarea"], $_POST["usuarios_tareas"]);

    // Obtener datos del formulario
    $Nombre = $_POST["Nombre_Tarea"];
    $Descripcion = $_POST["descripcionTarea"];
    $Prioridad = $_POST["prioridad"];
    $FechaLimite = $_POST["fechaLimite"];
    $Fase = $_POST["Fase_tarea"];
    $TareasDependientes = isset($_POST["tarea_tarea_dependiente"]) ? implode(',', $_POST["tarea_tarea_dependiente"]) : null; 
    $UsuariosTareas = implode(',', $_POST["usuarios_tareas"]);
 // Llamada al procedimiento almacenado
 $stmt = $conectar->prepare("CALL InsertarTarea(?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("ssssiss", $Nombre, $Descripcion, $Prioridad, $FechaLimite, $Fase, $TareasDependientes, $UsuariosTareas);

    // Ejecutar la llamada al procedimiento almacenado
    if ($stmt->execute()) {
        
        // Redirigir a la página de tareas o a donde desees
        header("Location: Tareas_dashboard.php");
        exit(); // Terminar el script después de redirigir
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
