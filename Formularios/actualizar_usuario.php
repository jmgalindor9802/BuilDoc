<?php 

include_once("conexion.php");

    $Id = $_POST['IdUser'];
    $EPS = $_POST['ActEPS'];
    $ARL = $_POST['ActARL'];
    $Municipio = $_POST['ActMunicipio'];
    $Direccion = $_POST['ActDireccion'];
    $Correo = $_POST['ActCorreo'];
    $Telefono = $_POST['ActTelefono'];
    $Contrasenia = $_POST['ActContrasenia'];

    $sql = "UPDATE usuario SET usuNombre_eps='".$EPS."',
                               usuNombre_arl='".$ARL."',
                               usuMunicipio='".$Municipio."',
                               usuDireccion_residencia='".$Direccion."',
                               usuCorreo='".$Correo."',
                               usuTelefono='".$Telefono."',
                               usuContrasenia='".$Contrasenia."' WHERE pk_id_usuario = ".$Id."";

    if ($resultado = $conectar->query($sql)) {
        header("location:Usuario_dashboard.php");
      }                           
    

?>