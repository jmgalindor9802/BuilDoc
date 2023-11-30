<?php
require '../conexion.php';

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
    $inspector = null;
    $autor = (int) '1011234567';

    // Determinar qué fecha usar dependiendo de la periodicidad
    if (strtoupper($insperiodicidad) == "NINGUNA") {
        // Si la periodicidad es "Ninguna", usa la fecha única
        $fechaUsar = $insFechaUnica;
        $insFechaFinal = $insFechaUnica;
    } else {
        // De lo contrario, usa la fecha inicial
        $fechaUsar = $insFechaInicial;
    }

    // Llamada al procedimiento almacenado
    $stmt = $conectar->prepare("CALL InsertarInspeccion(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiii", $nomInspeccion, $insDescripcion, $EstadoIns, $fechaUsar, $insperiodicidad, $insFechaFinal, $autor, $Proyecto, $inspector);

    // Ejecutar la llamada al procedimiento almacenado
    if ($stmt->execute()) {
        // Crear una consulta SQL para obtener el ID del incidente más grande
        $consulta = "SELECT MAX(pk_id_inspeccion) AS id_inspeccion FROM gii_inspeccion;";

        // Ejecutar la consulta SQL
        $resultado = $conectar->query($consulta);

        // Obtener el valor del ID del incidente más grande
        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            $lastInspeccionId = $fila["id_inspeccion"];

            // Llamada al procedimiento almacenado para los inspectores
            if (isset($_POST["usuarios_proyecto"]) && !empty($_POST["usuarios_proyecto"])) {
                $fk_ins = $lastInspeccionId;
                $usuarios_asignados = $_POST["usuarios_proyecto"];
                foreach ($usuarios_asignados as $id_usuario) {
                    $insert_inspector = $conectar->prepare("INSERT INTO usuarios_gii_inspecciones (fk_id_usuario, fk_id_inspeccion) VALUES (?, ?)");
                    $insert_inspector->bind_param("ii", $id_usuario, $fk_ins);
                    $insert_inspector->execute();
                }
            }

            // Redirigir a Inspecciones_dashboard.php
            header("Location: Inspecciones_dashboar.php");
            exit(); // Asegúrate de salir después de redirigir
        } else {
            echo "Fallo la insercion del ultimo ID";
        }
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