<?php 

include_once("../conexion.php");

    $Id = $_GET['Id'];
    $sql = "DELETE FROM ga_cliente WHERE pk_id_cliente ='$Id'";

    $query = mysqli_query($conectar, $sql);
    if ($query === TRUE) {
        header("location:Cliente_dashboard.php");
      }                           
    

?>