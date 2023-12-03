<?php
// Realiza la lógica para obtener las tareas según el proyecto y la fase

// Verifica si se han proporcionado los parámetros esperados
if (isset($_POST['idProyecto']) && isset($_POST['idFase'])) {
    // Obtiene los valores de los parámetros
    $idProyecto = $_POST['idProyecto'];
    $idFase = $_POST['idFase'];

    // Realiza la conexión a la base de datos (asegúrate de tener tu lógica de conexión aquí)
    include('../conexion.php');

    // Llamada al procedimiento almacenado
    $sql = "CALL ListarTareasPorFaseYProyecto(?, ?)";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param('ii', $idFase, $idProyecto);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si se obtuvieron resultados
    if ($result && $result->num_rows > 0) {
        // Itera sobre los resultados y almacena en un array
        $tareas = array();
        while ($row = $result->fetch_assoc()) {
            $tareas[] = $row;
        }

        // Devuelve las tareas en formato JSON
        header('Content-Type: application/json');
        echo json_encode($tareas);
    } else {
        // No se encontraron tareas, devuelve un array vacío en formato JSON
        header('Content-Type: application/json');
        echo json_encode(array());
    }

    // Cierra la conexión
    $stmt->close();
    $conectar->close();
} else {
    // No se proporcionaron los parámetros esperados, devuelve un error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Parámetros no proporcionados'));
}
?>
