<?php
// Verificar si es una solicitud AJAX
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Configurar el encabezado para indicar que la respuesta es JSON
    header('Content-Type: application/json');

    // Obtener los datos que deseas enviar como JSON
    $tu_data_json = array('mensaje' => '¡La solicitud AJAX se procesó correctamente!');
  
    // Devolver los datos en formato JSON
    echo json_encode($tu_data_json);
    exit(); // Asegúrate de salir para evitar ejecución adicional del script
}
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tareas</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


  <style>
    .border-left {
      border-left: 1px solid #d7d7d7;
      height: 100%;
    }

    .custom-btn {
      background-color: #0074e4;
      color: #ffffff;
    }

    .vh-80 {
      max-height: 50vh;
      overflow-y: auto;
    }

    .custom-form {
      padding-left: 5%;
      padding-right: 5%;
      
    }

    .custom-nav {
      padding-left: 4%;
      padding-right: 4%;
    }
    .sticky-header thead th {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 1;
  background-color: #ffffff; /* Puedes ajustar el color de fondo según tus preferencias */

    }

  .tiempo-restante-rojo {
    border-left: 4px solid #FF0000; /* Rojo */
}

.tiempo-restante-amarillo {
    border-left: 4px solid #FFFF00; /* Amarillo */
}

.tiempo-restante-verde {
    border-left: 4px solid #00FF00; /* Verde */
}

  


  </style>
</head>
<header>
  <?php include('../Header.php'); ?>
  </header>
<body style="height: 100vh; display: flex; flex-direction: column; overflow: hidden;">
  <div class="row flex-grow-1 ">
    <div class="col-lg-2 ">
    <?php include('../Menu.php'); ?>
    </div>
    <div class="col-10 border-left custom-form">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Tareas</a></li>
        </ol>
      </nav>
      <div >
        <h4 class="mb-3">Tareas </h4>
        <form id="formProyecto" method="post" action="Tareas_dashboard.php">
        <a href="crear_tarea.php"><button class="btn btn-lg float-end custom-btn" type="button"
          style="font-size: 15px;">+ Crear
          tarea</button></a>
          <a href="create_fase_form.php"><button class="btn btn-lg float-end custom-btn" type="button"
          style="font-size: 15px; margin-right: 10px;">+ Crear fase</button></a>
        <h1 class="display-6">Tareas próximas</h1>
        <div class="dropdown">
          <button id="proyectoSeleccionado" class="btn btn-secondary dropdown-toggle" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
                     Proyectos </button>
          <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
          <li><a class="dropdown-item" href="#" onclick="seleccionarProyecto(this); document.getElementById('formProyecto').submit(); return false;" data-id="null">Todos los proyectos</a></li>
          <?php
        require('conexion.php');

        // Verificar la conexión
        if (!$conectar) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Consulta para obtener nombres e IDs de proyectos de la base de datos
        $sql = "SELECT pk_id_proyecto, proNombre FROM ga_proyecto ORDER BY proNombre";
        $result = mysqli_query($conectar, $sql);

        // Verificar si hay resultados antes de intentar acceder a $result
        if ($result && mysqli_num_rows($result) > 0) {
            // Iterar sobre los resultados
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li><a class="dropdown-item" href="#" onclick="seleccionarProyecto(this)" data-id="' . $row["pk_id_proyecto"] . '">' . $row["proNombre"] . '</a></li>';
            }
        } else {
            // No hay resultados, puedes manejarlo según tus necesidades
            echo '<li><a class="dropdown-item" href="#">No hay proyectos disponibles</a></li>';
        }

        // Cerrar la conexión
        mysqli_close($conectar);
        ?> 
          </ul>         
        </div>
      </form>
      </div>
        <div class="table-responsive vh-80">
        <table id="tablaTareas" class="table table-striped table-hover sticky-header">
    <caption>Esta tabla muestra las tareas pendientes por proyecto seleccionado</caption>
    <thead>
    <tr>
        <th class="col-2" scope="col">Proyecto</th>
        <th class="col-2" scope="col">Fase</th>
        <th class="col-3" scope="col">Tarea</th>
        <th class="col-2" scope="col">Fecha y Hora Límite</th>
        <th class="col-2" scope="col">Responsable</th>
        <th class="col-1" scope="col">Tiempo Restante</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
      require("conexion.php");
      $sql = mysqli_query($conectar, "SELECT
      gt_tarea.pk_id_tarea,
      gt_tarea.tarNombre,
      gt_tarea.tarDescripcion,
      gt_tarea.tarPrioridad,
      gt_tarea.tarEstado,
      gt_tarea.tarFecha_creacion,
      gt_tarea.tarFecha_limite,
      ga_proyecto.proNombre AS nombre_proyecto,
      gt_fase.fasNombre AS nombre_fase,
      CONCAT(usuario.usuNombre, ' ', usuario.usuApellido) AS nombre_completo
      FROM
      gt_tarea
      INNER JOIN gt_fase ON gt_tarea.fk_id_fase = gt_fase.pk_id_fase
      INNER JOIN ga_proyecto ON gt_fase.fk_id_proyecto = ga_proyecto.pk_id_proyecto
      INNER JOIN usuarios_gt_tareas ON gt_tarea.pk_id_tarea = usuarios_gt_tareas.fk_id_tarea
      INNER JOIN usuario ON usuario.pk_id_usuario = usuarios_gt_tareas.fk_id_usuario");
      while ($resultado = $sql->fetch_assoc()){
      ?>
<!-- // // Llamada al procedimiento almacenado
// $proyecto = isset($_POST['proyecto']) ? $_POST['proyecto'] : NULL;
// var_dump($proyecto);
// echo "El proyecto seleccionado es: $proyecto";

// // Preparar la consulta con un marcador de posición
// $stmt = $conectar->prepare("CALL listar_tareas_pendientes_proximos_7_dias_por_proyecto(?)");
// $stmt->bind_param("i", $proyecto);  // "i" indica que es un entero, ajusta según sea necesario
// $stmt->execute();
// $result = $stmt->get_result();

// Procesar los resultados y mostrar en la tabla -->
<tr>
              <td scope="row"><?php echo $resultado ['nombre_proyecto']?></td>
              <td scope="row"><?php echo $resultado ['nombre_fase']?></td>
              <td scope="row"><?php echo $resultado ['tarNombre']?></td>
              <td scope="row"><?php echo $resultado ['tarFecha_limite']?></td>
              <td scope="row"><?php echo $resultado ['nombre_completo']?></td>
              <td></td>
              <td scope="row">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                    <path
                      d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                  </svg>
                </button>
                <ul class="dropdown-menu">
                  <li><a id="btn-desplegable-detalles" href="actualizar_usuario_form.php?pk_id_usuario=<?php echo $resultado['pk_id_tarea']?>" class="dropdown-item">Actualizar</a></li>
                  <li><a id="btn-desplegable-seguimiento" href="detalles_usuario_form.php?pk_id_usuario=<?php echo $resultado['pk_id_tarea']?>" class="dropdown-item">Detalles</a></li>
                  <li><a class="dropdown-item text-danger" href="eliminar_usuario.php?pk_id_usuario=<?php echo $resultado['pk_id_tarea']?>" data-bs-toggle="modal"
                      data-bs-target="#EliminarUsuario">Archivar <svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                          d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                        <path
                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                      </svg></a>
                  </li>
                </ul>
              </td>
            </tr>

  <!-- Cerrar la conexión
  $stmt->close();
  $conectar->close(); -->

<?php
}
?>

    </tbody>
</table>
          
              </div>
      </div>
    </div>
  </div>

 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <script src="Tareas_dashboard.js"></script>
</body>

</html>