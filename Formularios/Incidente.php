<?php 

require 'conexion.php';

var_dump($_POST);
// Verificar si los datos del formulario están presentes
if (
    isset($_POST["Nombre_incidente"]) && !empty($_POST["Nombre_incidente"]) &&
    isset($_POST["Descripcion_incidente"]) && !empty($_POST["Descripcion_incidente"]) &&
    isset($_POST["Gravedad_incidente"]) && !empty($_POST["Gravedad_incidente"]) &&
    isset($_POST["Proyecto_incidente"]) && !empty($_POST["Proyecto_incidente"]) &&
    isset($_POST["Sugerencia_incidente"]) && isset($_POST["Nombre_involucrado"]) &&
    isset($_POST["Apellido_involucrado"]) && isset($_POST["Identificación_involucrado"]) &&
    isset($_POST["Evidencia_incidente"]) && isset($_POST["Justificacion_involucrado"])){


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
 var_dump($items1);
 var_dump($items2);
 var_dump($items3);
 var_dump($items4);
 
 $stmt = $conectar->prepare("CALL InsertarIncidente(?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("sssssii", $Nombre, $DescInc, $EstadoInc, $GraInc, $SugInc, $autor, $Proyecto);

 // Ejecutar la llamada al procedimiento almacenado
 if ($stmt->execute()) {
    echo "Los datos se almacenaron correctamente.";
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
    /* SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT 
    (IDINVOLUCRADO, NOMBRE, APELLIDO Y JUSTIFICACION */
        while(true) {
            /* RECUPERAR LOS VALORES DE LOS ARREGLOS */
            $item1 = current($items1);
		    $item2 = current($items2);
		    $item3 = filter_var(current($items3), FILTER_SANITIZE_NUMBER_INT);
		    $item4 = current($items4);
            if (!filter_var(current($items3), FILTER_SANITIZE_NUMBER_INT)) {
                echo 'El valor de la variable $item1 no es un número entero.';
            }
            
            /* ASIGNARLOS A VARIABLES */
            $idInv=(( $item3 !== false) ? $item3 : ", &nbsp;");
		    $nomInv=(( $item1 !== false) ? $item1 : ", &nbsp;");
		    $apeInv=(( $item2 !== false) ? $item2 : ", &nbsp;");
		    $jusInv=(( $item4 !== false) ? $item4 : ", &nbsp;");
            $fk= (int) ('78');
            
            /* QUERY DE INSERCIÓN */
            $sql = "INSERT INTO gii_involucrado (invNombre, invApellido, invNumDocumento, invJustificacion, fk_id_incidente) 
		    VALUES ('$nomInv', '$apeInv', '$idInv', '$jusInv', $fk)";

            $sqlRes = $conectar->query($sql) or die($conectar->error);

            /* obtener el siguiente valor adentro de cada array */
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            $item3 = next( $items3 );
            $item4 = next( $items4 );

            /* verificar si ya no ahi mas valores dentro de array */
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;

        }

    }else{
        echo 'los involucrados estan vacios';
    }
    mysqli_close($conectar);
}else {
    echo "Error: Datos de formulario incompletos.";
}