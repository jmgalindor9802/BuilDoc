<?php 

require 'conexion.php';


$Nombre = $_POST["Nombre_fase"];
$Proyecto = $_POST["Proyecto_fase"];
$Descripcion = $_POST["Descripcion_fase"];


$insert = "INSERT INTO gt_fase(fasNombre, fasDescripcion, fk_id_proyecto) VALUES ('$Nombre', '$Proyecto', '$Descripcion')";

$query = mysqli_query($conectar, $insert);

if($query){

    echo "Los datos se amacenaron correctamente.";

}else{

    echo "Error, no se guardaron los datos correctamente.";

}

?>