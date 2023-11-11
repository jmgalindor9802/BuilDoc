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
if ($resultadoInsercion === true){
    header("location: Inspecciones_dashboar.php");
}else{
    echo "Los datos no se guardaron correctamente";
}