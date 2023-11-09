<?php 

require 'conexion.php';


 // Obtiene los datos del formulario
 $Nombre = $_POST["Nombre_incidente"];
 $DescInc = $_POST["Descripcion_incidente"];
 $EstadoInc = "INICIALIZADO";
 $GraInc = $_POST["Gravedad_incidente"];
 $SugInc = $_POST["Sugerencia_incidente"];
 $Proyecto = $_POST["Proyecto_incidente"];
 $NomInv = $_POST["Nombre_involucrado"];
 $ApeInv = $_POST["Apellido_involucrado"];
 $IdInv = $_POST["Identificación_involucrado"];
 $EviInc = $_POST["Evidencia_incidente"];

 // Crea la consulta SQL
 $sqlInsertar = "INSERT INTO gii_incidente(incNombre, incDescripcion, incEstado, incGravedad, incFecha, incSugerencias, fk_id_usuario, fk_id_proyecto) 
 VALUES ('$Nombre', '$DescInc' ,'$EstadoInc', '$GraInc', '$SugInc', '$Proyecto')";
$sqlInsertarIncolucrado = "INSERT INTO gii_involucrado(invNombre, invApellido, invNumDocumento, invJustificacion, fk_id_incidente) 
VALUES ('$NomInv', '$ApeInv', '$IdInv', '$EviInc')";
 // Ejecuta la consulta SQL
 $query = mysqli_query($conectar, $sqlInsertar, $sqlInsertarIncolucrado);

 // Verifica si la consulta se ejecutó correctamente
 if($query) {

     // El registro se insertó correctamente
     echo "Los datos se amacenaron correctamente.";

 } else {

     // Ocurrió un error al insertar el registro
     echo "Error, no se guardaron los datos correctamente.";

 }

 // Obtiene el último pk_id_incidente
 $ultimo_id = mysqli_fetch_assoc(mysqli_query($conectar, "SELECT MAX(pk_id_incidente) AS ultimo_id
FROM gii_incidente"));

 // Asigna el valor al fk_id_incidente
 $fk_id_incidente = $ultimo_id["ultimo_id"];

 // Ejecuta la consulta SQL para insertar el registro del involucrado
 $query = mysqli_query($conectar, $sqlInsertarIncolucrado, array($fk_id_incidente));

 // Verifica si la consulta se ejecutó correctamente
 if($query) {

     // El registro se insertó correctamente
     echo "Los datos del involucrado se amacenaron correctamente.";

 } else {

     // Ocurrió un error al insertar el registro
     echo "Error, no se guardaron los datos del involucado correctamente.";

 }


?>