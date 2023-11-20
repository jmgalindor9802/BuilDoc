<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tareas</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


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

<body style="height: 100vh; display: flex; flex-direction: column; overflow: hidden;">
  <header>
    <iframe src="Header.html" class="w-100" height="78" style="max-height:78px;" title="Encabezado"></iframe>
  </header>

  <div class="row flex-grow-1 ">
    <div class="col-lg-2 ">
      <iframe src="Menu.html" class="w-100 " height="100%" style="max-height: 100%;" title="Menú principal"></iframe>
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
        
        <a href="crear_tarea.html"><button class="btn btn-lg float-end custom-btn" type="submit"
          style="font-size: 15px;">+ Crear
          tarea</button></a>
          <a href="create_fase_form.php"><button class="btn btn-lg float-end custom-btn" type="submit"
          style="font-size: 15px; margin-right: 10px;">+ Crear fase</button></a>
        <h1 class="display-6">Tareas próximas</h1>
        <div class="dropdown">
          <button id="proyectoSeleccionado" class="btn btn-secondary dropdown-toggle" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Todos los proyectos
          </button>
          <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
              <li><a class="dropdown-item" href="#">Todos los proyectos</a></li>
              <?php
              require('conexion.php');

              // Verificar la conexión
              if (!$conectar) {
                  die("Conexión fallida: " . mysqli_connect_error());
              }

              // Consulta para obtener nombres e IDs de proyectos de la base de datos
              $sql = "SELECT pk_id_proyecto, proNombre FROM ga_proyecto ORDER BY proNombre";
              $result = mysqli_query($conectar, $sql);

              // Rellenar opciones del select con los resultados de la consulta
              if ($result && mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      echo '<li><a class="dropdown-item" href="#">' . $row["proNombre"] . '</a></li>';
                  }
              }
              ?>

          </ul>

          
        </div>
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
    </tr>
    </thead>
    <tbody>

    <?php
    require('conexion.php');

    // Verificar la conexión
    if ($conectar->connect_error) {
        die("Error en la conexión a la base de datos: " . $conectar->connect_error);
    }

    // Llamada al procedimiento almacenado
    $proyecto = isset($_POST['proyecto']) ? $_POST['proyecto'] : NULL;
    $result = $conectar->query("CALL listar_tareas_pendientes_proximos_7_dias_por_proyecto(6)");

    // Procesar los resultados y mostrar en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['Proyecto']}</td>";
        echo "<td>{$row['Fase']}</td>";
        echo "<td>{$row['Tarea']}</td>";
        echo "<td>{$row['Fecha_Limite']}</td>";
        echo "<td>{$row['Responsable']}</td>";
        echo "<td>{$row['Tiempo_Restante']}</td>";
        echo "</tr>";
    }

    // Cerrar la conexión
    $conectar->close();
    ?>

    </tbody>
</table>
          
              </div>
      </div>
    </div>
  </div>

  <script src="Tareas_dashboard.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>