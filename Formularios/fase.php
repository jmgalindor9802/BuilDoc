<?php 

require 'conexion.php';


    // Verificar si los datos del formulario están presentes
    if (
        isset($_POST["Nombre_fase"]) && !empty($_POST["Nombre_fase"]) &&
        isset($_POST["Proyecto_fase"]) && !empty($_POST["Proyecto_fase"]) &&
        isset($_POST["Descripcion_fase"]) && !empty($_POST["Descripcion_fase"])
    )
    
    {
        // Obtener datos del formulario
        $Nombre = $_POST["Nombre_fase"];
        $Proyecto = $_POST["Proyecto_fase"];
        $Descripcion = $_POST["Descripcion_fase"];
        $Estado = "PENDIENTE";

    // Sentencia preparada para evitar inyección de SQL
    $insert = "INSERT INTO gt_fase (fasNombre, fasDescripcion, fasEstado, fk_id_proyecto) VALUES ('$Nombre',  '$Descripcion','$Estado','$Proyecto')";

     //ejecutamos la sentencia de sql
     $query = $conectar->query($insert);

    // Verificar si la inserción fue exitosa
    if ($query) {
        echo "Los datos se almacenaron correctamente.";
    } else {
        echo "Error, no se guardaron los datos correctamente: " . mysqli_error($conectar);
    }

    // Cerrar la conexión
    mysqli_close($conectar);
    } else {
        echo "Error: Datos de formulario incompletos.";
    }

?>

