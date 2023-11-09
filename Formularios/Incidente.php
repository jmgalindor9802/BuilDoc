<?php 

require 'conexion.php';


$Nombre = $_POST["Nombre_incidente"];
$Proyecto = $_POST["Proyecto_incidente"];
$NomInv = $_POST["Nombre_involucrado"];
$ApeInv = $_POST["Apellido_involucrado"];
$IdInv = $_POST["Identificación_involucrado"];
$DescInc = $_POST["Descripcion_incidente"];
$SugInc = $_POST["Sugerencia_incidente"];
$GraInc = $_POST["Gravedad_incidente"];
$EviInc = $_POST["Evidencia_incidente"];


$insert = "INSERT INTO gt_fase(incNombre, incDescripcion, fk_id_proyecto) 
VALUES ('$Nombre', '$Proyecto', '$Descripcion')";

$query = mysqli_query($conectar, $insert);

if($query){

    echo "Los datos se amacenaron correctamente.";

}else{

    echo "Error, no se guardaron los datos correctamente.";

}

?>