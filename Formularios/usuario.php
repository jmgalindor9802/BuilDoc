<?php 

require 'conexion.php';

$CC = $_POST["CC"];
$nombre = $_POST["NombreUsu"];
$apellido = $_POST["ApellidoUsu"];
$nombreEPS = $_POST["EPSusu"];
$nombreARL = $_POST["ARLusu"];
$fechaNacimiento = $_POST["FechaNacimientoUsu"];
$municipio = $_POST["DireccionUsu"];
$direccion = $_POST["MunicipioUsu"];
$profesion = $_POST["ProfesionUsu"];
$contrasenia = $_POST["ContraseniaUsu"];
$telefono = $_POST["TelefonoUsu"];
$correo = $_POST["CorreoUsu"];

$insert = "INSERT INTO usuario(pk_id_usuario, usuNombre, usuApellido, usuNombre_eps, usuNombre_arl, 
usuFecha_nacimiento, usuMunicipio, usuDireccion_residencia, usuProfesion, usuContrasenia, 
usuTelefono, usuCorreo) VALUES ('$CC', '$nombre', '$apellido', '$nombreEPS', '$nombreARL', 
'$fechaNacimiento', '$municipio', '$direccion', '$profesion', '$contrasenia', '$telefono', 
'$correo')";

$query = mysqli_query($conectar, $insert);

if($query){

    echo "Los datos se amacenaron correctamente.";

}else{

    echo "Error, no se guardaron los datos correctamente.";

}

?>