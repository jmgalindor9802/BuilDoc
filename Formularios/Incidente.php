<?php 

require 'conexion.php';

var_dump($_POST);
// Verificar si los datos del formulario están presentes
if (
    isset($_POST["Nombre_incidente"]) && !empty($_POST["Nombre_incidente"]) &&
    isset($_POST["Descripcion_incidente"]) && !empty($_POST["Descripcion_incidente"]) &&
    isset($_POST["Gravedad_incidente"]) && !empty($_POST["Gravedad_incidente"]) &&
    isset($_POST["Proyecto_incidente"]) && !empty($_POST["Proyecto_incidente"]) &&
    isset($_POST["Sugerencia_incidente"]) && isset($_POST["Nombre_involucrado"]) &&
    isset($_POST["Apellido_involucrado"]) && isset($_POST["Identificación_involucrado"]) &&
    isset($_POST["Evidencia_incidente"]) && isset($_POST["Justificacion_involucrado"])){


 // Obtiene los datos del formulario
 $Nombre = $_POST["Nombre_incidente"];
 $DescInc = $_POST["Descripcion_incidente"];
 $autor = (int) '1011234567';
 $EstadoInc = 'INICIALIZADO';
 $GraInc = $_POST["Gravedad_incidente"];
 $SugInc = $_POST["Sugerencia_incidente"];
 $Proyecto = $_POST["Proyecto_incidente"];
 $NomInv = $_POST["Nombre_involucrado"];
 $ApeInv = $_POST["Apellido_involucrado"];
 $IdInv = (int) $_POST["Identificación_involucrado"];
 $JusInv= $_POST["Justificacion_involucrado"];
 $EviInc = $_POST["Evidencia_incidente"];

 // Llamada al procedimiento almacenado
 $stmt = $conectar->prepare("CALL InsertarIncidente(?, ?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("sssssii", $Nombre, $DescInc, $EstadoInc, $GraInc, $SugInc, $autor, $Proyecto);

 // Ejecutar la llamada al procedimiento almacenado
 if ($stmt->execute()) {
    echo "Los datos se almacenaron correctamente.";
} else {
    echo "Error, no se guardaron los datos correctamente: " . $stmt->error;
}
// Cerrar la conexión y liberar recursos
$stmt->close();
mysqli_close($conectar);
}else {
    echo "Error: Datos de formulario incompletos.";
}