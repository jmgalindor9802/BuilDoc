<?php 

require '../conexion.php';
// Verificar si los datos del formulario están presentes
if (
    isset($_POST["Nombre_incidente"]) && !empty($_POST["Nombre_incidente"]) &&
    isset($_POST["Descripcion_incidente"]) && !empty($_POST["Descripcion_incidente"]) &&
    isset($_POST["Gravedad_incidente"]) && !empty($_POST["Gravedad_incidente"]) &&
    isset($_POST["Proyecto_incidente"]) && !empty($_POST["Proyecto_incidente"]) &&
    isset($_POST["Sugerencia_incidente"]) && isset($_POST["Nombre_involucrado"]) &&
    isset($_POST["Apellido_involucrado"]) && isset($_POST["Identificación_involucrado"]) &&
    isset($_POST["Evidencia_incidente"]) && isset($_POST["Justificacion_involucrado"])
    ){


        // Obtiene los datos del formulario
        $Nombre = $_POST["Nombre_incidente"];
        $DescInc = $_POST["Descripcion_incidente"];
        $autor = (int) '1011234567';
        $EstadoInc = 'INICIALIZADO';
        $GraInc = $_POST["Gravedad_incidente"];
        $SugInc = $_POST["Sugerencia_incidente"];
        $Proyecto = $_POST["Proyecto_incidente"];
        $items1 = ($_POST["Nombre_involucrado"]);
        $items2 = ($_POST["Apellido_involucrado"]);
        $items3 = array_map('intval' , $_POST["Identificación_involucrado"]);
        $items4 = ($_POST["Justificacion_involucrado"]);
        $EviInc = $_POST["Evidencia_incidente"];
        $stmt = $conectar->prepare("CALL InsertarIncidente(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssii", $Nombre, $DescInc, $EstadoInc, $GraInc, $SugInc, $autor, $Proyecto);

        // Ejecutar la llamada al procedimiento almacenado
        if ($stmt->execute()) {
            // Crear una consulta SQL para obtener el ID del incidente más grande
            $consulta = "SELECT MAX(pk_id_incidente) AS id_incidente
            FROM gii_incidente;";

            // Ejecutar la consulta SQL
            $resultado = $conectar->query($consulta);

            // Obtener el valor del ID del incidente más grande
            if ($resultado->num_rows === 1) {
                $fila = $resultado->fetch_assoc();
                $lastIncidenteId = $fila["id_incidente"];
            } else {
                echo"Fallo la insercion del ultimo ID";
            }
            if ($lastIncidenteId === NULL || is_null($lastIncidenteId)) {
                echo "Error al insertar el incidente: El ID del incidente es NULL.";
            } else {
                echo "Los datos se almacenaron correctamente.ID: " . $lastIncidenteId;
            }
            var_dump($lastIncidenteId);
        } else {
            echo "Error, no se guardaron los datos correctamente: " . $stmt->error;
        }
    // Cerrar la conexión y liberar recursos
    $stmt->close();
    // Llamada al procedimiento almacenado
    if (
        isset($items1) && !empty($items1) &&
        isset($items2) && !empty($items2) &&
        isset($items3) && !empty($items3) &&
        isset($items4) && !empty($items4)
    ) {
        // Llamada al procedimiento almacenado
        
            /* SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT 
            (IDINVOLUCRADO, NOMBRE, APELLIDO Y JUSTIFICACION */
            while(true) {
                /* RECUPERAR LOS VALORES DE LOS ARREGLOS */
                $item1 = current($items1);
		        $item2 = current($items2);
		        $item3 = current($items3);
		        $item4 = current($items4);
                /* ASIGNARLOS A VARIABLES */
                $idInv=(( $item3 !== false) ? $item3 : ", &nbsp;");
		        $nomInv=(( $item1 !== false) ? $item1 : ", &nbsp;");
		        $apeInv=(( $item2 !== false) ? $item2 : ", &nbsp;");
		        $jusInv=(( $item4 !== false) ? $item4 : ", &nbsp;");
                $fk= (int) $lastIncidenteId;

                // Llamada al procedimiento almacenado
                $stmtInvolucrado = $conectar->prepare("CALL InsertarInvolucrado(?, ?, ?, ?, ?)");
                $stmtInvolucrado->bind_param("isssi", $idInv, $nomInv, $apeInv, $jusInv, $fk);
                $stmtInvolucrado->execute();

                /* obtener el siguiente valor adentro de cada array */
                $item1 = next( $items1 );
                $item2 = next( $items2 );
                $item3 = next( $items3 );
                $item4 = next( $items4 );

                /* verificar si ya no ahi mas valores dentro de array */
                if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;

            }

            if ($stmtInvolucrado->execute()) {
                echo "Los datos del involucrado se almacenaron correctamente.";
            } else {
                echo "Error, no se guardaron los datos del involucrado correctamente: " . $stmtInvolucrado->error;
            }
    
            // Cerrar la conexión y liberar recursos
            $stmtInvolucrado->close();
        
    
        

    }else{
        echo 'los involucrados estan vacios';
    }
    mysqli_close($conectar);
}else {
    echo "Error: Datos de formulario incompletos.";
}