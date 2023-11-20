<?php 

    require_once "conexion.php";

    class Usuario extends Conectar{

        public function agregarUsuario($datos){

            $conexion = Conectar::conexion();
            /*if (self::buscarUsuarioRepetido($datos)){
                return 2;
            }else {*/

            $sql = "INSERT INTO usuario(pk_id_usuario, 
                                         usuNombre, usuApellido, usuNombre_eps, 
                                         usuNombre_arl, usuFecha_nacimiento, 
                                         usuMunicipio, usuDireccion_residencia,
                                         usuProfesion, usuContrasenia, usuTelefono, 
                                         usuCorreo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";    

            $query = $conexion->prepare($sql);

            $query->bind_param('isssssssssss', 
                    $datos['CC'],
                    $datos['NombreUsu'],
                    $datos['ApellidoUsu'],
                    $datos['EPSusu'],
                    $datos['ARL'],
                    $datos['FechaNacimientoUsu'],
                    $datos['DireccionUsu'],
                    $datos['MunicipioUsu'],
                    $datos['CorreoUsu'],
                    $datos['TelefonoUsu'],
                    $datos['ProfesionUsu'],
                    $datos['ContraseniaUsu']);


            $exito = $query->execute();
            $query->close();
            return $exito;

        }/*}

        public function buscarUsuarioRepetido($datos){
            $conexion = Conectar::conexion();
        
            $sql = "SELECT pk_id_usuario FROM usuario
                    WHERE pk_id_usuario = ?";
        
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $datos['CC']);
            $query->execute();
        
            $query->store_result();
            $numRows = $query->num_rows;
        
            $query->close();
        
            // Si se encuentra algún usuario con el CC o correo proporcionados
            // devuelve true (repetido), de lo contrario, devuelve false
            return ($numRows > 0);
        }*/
        


    }

?>