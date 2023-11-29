<?php 
    include_once("conexion.php");
    var_dump($_POST);
    if (
        isset($_POST["proyecto_inspeccion"]) && !empty($_POST["proyecto_inspeccion"]) &&
        isset($_POST["nombre_Inspeccion"]) && !empty($_POST["nombre_Inspeccion"]) &&
        isset($_POST["insPeriodicidad"]) && !empty($_POST["insPeriodicidad"]) &&
        isset($_POST["fourmulario_inspeccion"]) && !empty($_POST["fourmulario_inspeccion"]) &&
        isset($_POST["descripcionInspeccion"]) && !empty($_POST["descripcionInspeccion"]) &&
        isset($_POST["Id_inspeccion"]) && !empty($_POST["Id_inspeccion"])
    ){

    $idInspeccion = $_POST['Id_inspeccion'];
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

    $sql = "UPDATE gii_inspeccion SET 
            insNombre = '".$nomInspeccion."',
            insDescripcion = '".$insDescripcion."',
            insEstado = '".$EstadoIns."',
            insFecha_inicial = '".$fechaUsar."',
            insPeriodicidad = '".$insperiodicidad."',
            insFecha_final = '".$insFechaFinal."',
            fk_id_usuario = '".$autor."',
            fk_id_proyecto = '".$Proyecto."',
            fk_id_usuario_inspector = '".$inspector."'
            WHERE pk_id_inspeccion = ".$idInspeccion;
            

    if ($resultado = $conectar->query($sql)) {
        header("location:Usuario_dashboard.php");
    }                           
    }
?>