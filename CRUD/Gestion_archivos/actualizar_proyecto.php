<?php 

include_once("../conexion.php");

$IdProyecto = $_POST['IdProyecto'];
$Nombre = $_POST['ActProNombre'];
$Municipio = $_POST['ActProMunicipio'];
$Direccion = $_POST['ActProDireccion'];
$Descripcion = $_POST['ActProDescripcion'];
$Ruta = $_POST['ActProRuta'];
$Cliente = $_POST['ActProCliente'];

$sql = "UPDATE ga_proyecto SET proNombre = '$Nombre',
                               proMunicipio = '$Municipio',
                               proDireccion = '$Direccion',
                               proDescripcion = '$Descripcion',
                               proRuta = '$Ruta',
                               fk_id_cliente = '$Cliente'
        WHERE pk_id_proyecto = $IdProyecto";

    if ($resultado = $conectar->query($sql)) {
        header("location:Proyecto_dashboard.php");
      }                           
    

?>