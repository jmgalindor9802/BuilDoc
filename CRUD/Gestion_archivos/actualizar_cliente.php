<?php 

include_once("../conexion.php");

    $Id = $_POST['IdCliente'];
    $Nombre = $_POST['ActClienteNombre'];
    $Correo = $_POST['ActClienteCorreo'];
    $Telefono = $_POST['ActClienteTelefono'];

    $sql = "UPDATE ga_cliente SET cliNombre='".$Nombre."',
                                  cliCorreo='".$Correo."',
                                  cliTelefono='".$Telefono."'
                                  WHERE pk_id_cliente = ".$Id."";

    if ($resultado = $conectar->query($sql)) {
        header("location:Cliente_dashboard.php");
      }                           
    

?>
