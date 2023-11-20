<?php 

    require_once "class_usuario.php";

    //$contrasenia = sha1($_POST['ContraseniaUsu']);
    $datos = array(
        "CC" => $_POST['CC'],
        "NombreUsu" => $_POST['NombreUsu'],
        "ApellidoUsu" => $_POST['ApellidoUsu'],
        "EPSusu" => $_POST['EPSusu'],
        "ARL" => $_POST['ARL'],
        "FechaNacimientoUsu" => $_POST['FechaNacimientoUsu'],
        "DireccionUsu" => $_POST['DireccionUsu'],
        "MunicipioUsu" => $_POST['MunicipioUsu'],
        "CorreoUsu" => $_POST['CorreoUsu'],
        "TelefonoUsu" => $_POST['TelefonoUsu'],
        "ProfesionUsu" => $_POST['ProfesionUsu'],
        "ContraseniaUsu" => $_POST['ContraseniaUsu']
    );    

    $usuario = new Usuario();
    $exito = $usuario->agregarUsuario($datos);
    echo $exito;


?>