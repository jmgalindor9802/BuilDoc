<?php
// ajax_obtener_fases.php

// Verifica que se haya recibido el parámetro idProyecto
if (isset($_POST['idProyecto'])) {
    $idProyecto = $_POST['idProyecto'];

    // Realiza la conexión a la base de datos
    require('../conexion.php');

    // Verifica la conexión
    if (!$conectar) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Llama al procedimiento almacenado para obtener las fases
    $stmt = $conectar->prepare("CALL listar_fases_por_proyecto(?)");
    $stmt->bind_param("i", $idProyecto);
    $stmt->execute();

    // Obtiene los resultados del procedimiento almacenado
    $result = $stmt->get_result();

    // Verifica si se obtuvieron resultados
    if ($result && $result->num_rows > 0) {
        $fases = array();

        // Recorre los resultados y agrega las fases al array
        while ($row = $result->fetch_assoc()) {
            $fases[] = $row;
        }

        // Devuelve las fases en formato JSON
        echo json_encode($fases);
    } else {
        // No se encontraron fases
        echo json_encode(array());
    }

    // Cierra la conexión
    $stmt->close();
    mysqli_close($conectar);
} else {
    // No se proporcionó el parámetro idProyecto
    echo json_encode(array());
}
?>
