<?php
require('conexion.php');

// Verificar la conexión
if (!$conectar) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta para obtener las tareas desde la base de datos
$sql = "SELECT proyecto, fase, tarea, fecha_limite, responsable FROM tu_tabla_tareas";
$result = mysqli_query($conectar, $sql);

// Comprobar si hay resultados
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table id="tablaTareas" class="table table-striped table-hover sticky-header">';
    echo '<caption>Esta tabla muestra las tareas pendientes por proyecto seleccionado</caption>';
    echo '<thead>';
    echo '<tr>';
    echo '<th class="col-2" scope="col">Proyecto</th>';
    echo '<th class="col-2" scope="col">Fase</th>';
    echo '<th class="col-3" scope="col">Tarea</th>';
    echo '<th class="col-2" scope="col">Fecha y Hora Límite</th>';
    echo '<th class="col-2" scope="col">Responsable</th>';
    echo '<th class="col-1" scope="col">Tiempo Restante</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Imprimir filas de la tabla con los datos de la base de datos
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['proyecto'] . '</td>';
        echo '<td>' . $row['fase'] . '</td>';
        echo '<td>' . $row['tarea'] . '</td>';
        echo '<td>' . $row['fecha_limite'] . '</td>';
        echo '<td>' . $row['responsable'] . '</td>';
        echo '<td></td>'; // Aquí puedes poner la lógica para el tiempo restante
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No hay tareas en la base de datos.';
}

// Cerrar la conexión
mysqli_close($conectar);
?>
