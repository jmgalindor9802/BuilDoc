<?php
require 'conexion.php';

// Verificar si los datos del formulario están presentes
if (
    isset($_POST["proyecto_inspeccion"]) && !empty($_POST["proyecto_inspeccion"]) &&
    isset($_POST["nombre_Inspeccion"]) && !empty($_POST["nombre_Inspeccion"]) &&
    isset($_POST["insPeriodicidad"]) && !empty($_POST["insPeriodicidad"]) &&
    isset($_POST["fourmulario_inspeccion"]) && !empty($_POST["fourmulario_inspeccion"]) &&
    isset($_POST["descripcionInspeccion"]) && !empty($_POST["descripcionInspeccion"])
) {
    $Proyecto = $_POST["proyecto_inspeccion"];
    $nomInspeccion = $_POST["nombre_Inspeccion"];
    $insperiodicidad = $_POST["insPeriodicidad"];
    $EstadoIns = 'PENDIENTE';
    $insFormulario = $_POST["fourmulario_inspeccion"];
    $insFechaUnica = $_POST["fecha_unica_inspeccion"];
    $insFechaInicial = $_POST["fechaInicialInspeccion"];
    $insFechaFinal = $_POST["fechaFinalInspeccion"];
    $insDescripcion = $_POST["descripcionInspeccion"];
    $inspector = (int) '2637890123';
    $autor = (int) '1011234567';

    // Determinar qué fecha usar dependiendo de la periodicidad
    if (strtoupper($insperiodicidad) == "NINGUNA") {
        // Si la periodicidad es "Ninguna", usa la fecha única
        $fechaUsar = $insFechaUnica;
    } else {
        // De lo contrario, usa la fecha inicial
        $fechaUsar = $insFechaInicial;
    }

    // Llamada al procedimiento almacenado
    $stmt = $conectar->prepare("CALL InsertarInspeccion(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiii", $nomInspeccion, $insDescripcion, $EstadoIns, $fechaUsar, $insperiodicidad, $insFechaFinal, $autor, $Proyecto, $inspector);

    // Ejecutar la llamada al procedimiento almacenado
    if ($stmt->execute()) {
        echo "Los datos se almacenaron correctamente.";
    } else {
        echo "Error, no se guardaron los datos correctamente: " . $stmt->error;
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    mysqli_close($conectar);
} else {
    echo "Error: Datos de formulario incompletos.";
}
?>