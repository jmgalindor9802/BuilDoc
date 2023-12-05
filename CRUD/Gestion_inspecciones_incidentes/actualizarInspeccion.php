<?php
    require '../conexion.php';
    var_dump($_POST);
    if (isset($_POST["nombre_Inspeccion"]) && !empty($_POST["nombre_Inspeccion"]) && isset($_POST["insPeriodicidad"])
    && !empty($_POST["insPeriodicidad"]) && isset($_POST["descripcionInspeccion"]) && !empty($_POST["descripcionInspeccion"]) 
    && isset($_POST["Id_inspeccion"]) && !empty($_POST["Id_inspeccion"])) {
            $nomInspeccion = $_POST["nombre_Inspeccion"];
            $insperiodicidad = $_POST["insPeriodicidad"];
            $EstadoIns = 'PENDIENTE';
            $insFormulario = $_POST["fourmulario_inspeccion"];
            $insFechaUnica = $_POST["fecha_unica_inspeccion"];
            $insFechaInicial = $_POST["fechaInicialInspeccion"];
            $insFechaFinal = $_POST["fechaFinalInspeccion"];
            $insDescripcion = $_POST["descripcionInspeccion"];
            $inspector = null;
            $id_recuperado_incidente = $_POST["Id_inspeccion"];
            $pk_id_inspeccion = $id_recuperado_incidente;

            // Determinar qué fecha usar dependiendo de la periodicidad
            if (strtoupper($insperiodicidad) == "NINGUNA") {
                // Si la periodicidad es "Ninguna", usa la fecha única
                $fechaUsar = $insFechaUnica;
                $insFechaFinal = $insFechaUnica;
            } else {
                // De lo contrario, usa la fecha inicial
                $fechaUsar = $insFechaInicial;
            }
            // Llamar al procedimiento almacenado
            $sql = "CALL actualizar_inspeccionProgramada(?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conectar->prepare($sql);
            $stmt->bind_param('issssss', $pk_id_inspeccion, $nomInspeccion, $insDescripcion, $EstadoIns, $insFechaUnica, $insperiodicidad, $insFecha_final);
            $stmt->execute();
            

            // Verificar si la ejecución fue exitosa
            if ($stmt->affected_rows > 0) {
                echo "Procedimiento almacenado ejecutado correctamente";
            } else {
                echo "Error al ejecutar el procedimiento almacenado: " . $stmt->error;
            }
            $stmt->close();
            $conectar->close();
    }else {
        echo "Los datos estan incompletos";
    }
    
    
?>