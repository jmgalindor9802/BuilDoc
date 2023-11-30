<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tareas</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

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


    .sticky-header thead th {
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      z-index: 1;
      background-color: #ffffff;
      /* Puedes ajustar el color de fondo según tus preferencias */

    }

    .tiempo-restante-rojo {
      border-left: 4px solid #FF0000;
      /* Rojo */
    }

    .tiempo-restante-amarillo {
      border-left: 4px solid #FFFF00;
      /* Amarillo */
    }

    .tiempo-restante-verde {
      border-left: 4px solid #00FF00;
      /* Verde */
    }
  </style>
</head>
<header>
  <?php include('../Header.php'); ?>
</header>

<body>
  <div class="row">
    <div class="col-lg-2 ">
      <?php include('../Menu.php'); ?>
    </div>
      <div class="col-lg-10">
        <nav aria-label="breadcrumb" class=" align-items-center  ">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Tareas</a></li>
          </ol>
        </nav>
        <div>
          <h4 class="mb-3">Tareas </h4>
          <form id="formProyecto" method="post" action="Tareas_dashboard.php">
            <a href="crear_tarea.php"><button class="btn btn-lg float-end custom-btn" type="button" style="font-size: 15px;">+ Crear
                tarea</button></a>
            <a href="create_fase_form.php"><button class="btn btn-lg float-end custom-btn" type="button" style="font-size: 15px; ">+ Crear fase</button></a>
            <h1 class="display-6">Tareas próximas</h1>
            <div class="dropdown">

            </div>
          </form>
        </div>
        <div class="table-responsive vh-80 dataTables_wrapper dt-bootstrap5">
          <table id="tablaTareas" class="table table-striped sticky-header">
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
              require("../conexion.php");
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
              while ($resultado = $sql->fetch_assoc()) {
              ?>
                <tr>
                  <td scope="row"><?php echo $resultado['nombre_proyecto'] ?></td>
                  <td scope="row"><?php echo $resultado['nombre_fase'] ?></td>
                  <td scope="row"><?php echo $resultado['tarNombre'] ?></td>
                  <td scope="row"><?php
                                  $fechaHoraInicial = $resultado['tarFecha_limite'];
                                  $fechaFormateadaInicial = date("j M Y", strtotime($fechaHoraInicial));
                                  echo $fechaFormateadaInicial ?></td>
                  <td scope="row"><?php echo $resultado['nombre_completo'] ?></td>
                  <td></td>
                  <td scope="row">
                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                      </svg>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a id="btn-desplegable-detalles" href="actualizar_usuario_form.php?pk_id_usuario=<?php echo $resultado['pk_id_tarea'] ?>" class="dropdown-item">Actualizar</a></li>
                      <li><a id="btn-desplegable-seguimiento" href="detalles_usuario_form.php?pk_id_usuario=<?php echo $resultado['pk_id_tarea'] ?>" class="dropdown-item">Detalles</a></li>
                      <li><a class="dropdown-item text-danger" href="eliminar_usuario.php?pk_id_usuario=<?php echo $resultado['pk_id_tarea'] ?>" data-bs-toggle="modal" data-bs-target="#EliminarUsuario">Archivar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
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
  
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script src="Tareas_dashboard.js"></script>
  <script type="text/javascript">
    let table = new DataTable('#tablaTareas', {
      //Para cambiar el lenguaje a español
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
        "infoEmpty": "Mostrando del 0 al 0 de 0 registros",
        "infoFiltered": "(de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando..."
      }
    })
  </script>

</body>

</html>