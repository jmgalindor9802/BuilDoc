<?php 

include_once("../conexion.php");

    $Id = $_GET['Id'];
    $sql = "DELETE FROM ga_proyecto WHERE pk_id_proyecto ='$Id'";

    $query = mysqli_query($conectar, $sql);
    if ($query === TRUE) {
        header("location:Proyecto_dashboard.php");
      }                           
    

?>