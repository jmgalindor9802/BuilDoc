<?php 

include_once("../conexion.php");

    $Id = $_GET['Id'];
    $sql = "DELETE FROM usuario WHERE pk_id_usuario ='$Id'";

    $query = mysqli_query($conectar, $sql);
    if ($query === TRUE) {
        header("location:Usuario_dashboard.php");
      }                           
    

?>