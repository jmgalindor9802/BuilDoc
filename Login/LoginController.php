<?php 

require ('../CRUD/conexion.php');

if(!empty($_POST["btnIngresar"])) { 
  if(!empty($_POST["Correo"]) and !empty($_POST["Contrasenia"])){ 
     echo '<div class="alert alert-danger>" Campos vacios</div>';       
  }else {
     $correo=$_POST["Correo"];
     $contrasenia=$_POST["Contrasenia"];
     $sql=$conectar->query("SELECT * FROM usuario where usuCorreo='$correo' AND usuContrasenia='$contrasenia'");
     if ($datos=$sql->fetch_object()) {
         header("location:inicio.php");
     } else {
     echo '<div class="alert alert-danger>" No se encontro el usuario digitado.</div>';                  
     }
  }
}

?>