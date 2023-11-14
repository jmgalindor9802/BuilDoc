<?php 

$host = "localhost";
$user = "root";
$clave = "nico1072364046n-Ink.";
$bd = "bd_buildoc";

$conectar=mysqli_connect($host, $user, $clave, $bd);

if(!$conectar){
    echo 'Conexion fallida';
}
?>