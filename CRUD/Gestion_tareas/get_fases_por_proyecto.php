
<?php

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    die('Esta página solo puede ser accedida mediante una solicitud AJAX.');
}
require('../conexion.php');

// Verificar si es una solicitud AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Obtener el ID del proyecto enviado por la solicitud AJAX
    var_dump($_POST);
    $proyectoId = isset($_POST['proyecto']) ? $_POST['proyecto'] : NULL;

    // Verificar la conexión
    if (!$conectar) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Consulta para obtener las fases relacionadas con el proyecto
    $sql = "SELECT pk_id_fase, fasNombre FROM gt_fase WHERE fk_id_proyecto = ? ORDER BY fasNombre";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("i", $proyectoId);
    $stmt->execute();
    if (!$stmt->execute()) {
        die('Error en la ejecución de la consulta: ' . $stmt->error);
    }
    $result = $stmt->get_result();

    // Construir opciones del menú desplegable de fases
    $options = '<option value="">Elegir...</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row["pk_id_fase"] . '">' . $row["fasNombre"] . '</option>';
    }

    // Devolver las opciones como respuesta a la solicitud AJAX
    echo $options;

    // Cerrar la conexión
    $stmt->close();
    $conectar->close();
    exit(); // Asegúrate de salir para evitar ejecución adicional del script
}
?>
