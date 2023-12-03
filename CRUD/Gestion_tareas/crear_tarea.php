<?php
 // Insertar usuarios seleccionados en la tabla intermedia
 if (isset($_POST["usuarios_tareas"]) && is_array($_POST["usuarios_tareas"])) {
    $usuarios_asignados = $_POST["usuarios_tareas"];
    foreach ($usuarios_asignados as $id_usuario) {
        $insert_intermedia = $conectar->prepare("INSERT INTO usuarios_gt_tareas (fk_id_usuario, fk_id_tarea) VALUES (?, ?)");
        $insert_intermedia->bind_param("ii", $id_usuario, $id_tarea);
        $insert_intermedia->execute();
    }
}
?>