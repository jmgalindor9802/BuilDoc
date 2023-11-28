<?php 

$host = "localhost";
$user = "root";
$clave = "";
$bd = "bd_buildoc";

$conectar=mysqli_connect($host, "$user", $clave, $bd);

if(!$conectar){
    echo 'Conexion fallida';
}
?>