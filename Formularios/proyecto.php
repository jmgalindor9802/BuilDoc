<?php 

require 'conexion.php';

$CC = $_POST["Nombre"];


$insert = "INSERT INTO ) VALUES ()";

$query = mysqli_query($conectar, $insert);

if($query){

    echo "Los datos se amacenaron correctamente.";

}else{

    echo "Error, no se guardaron los datos correctamente.";

}

?>