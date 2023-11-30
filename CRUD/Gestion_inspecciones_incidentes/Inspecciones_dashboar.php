<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inspecciones</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
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
      background-color: #ffffff;
      /* Puedes ajustar el color de fondo según tus preferencias */
    }

    #Detalles_incidente {
      top: calc(100% - 579px);
      left: calc(100% - 680px);
      width: 50vw;
      height: 50vh;
    }

    .linea-tiempo {
      fill: #001f3f;
    }

    .btn-detalles:hover {
      background-color: #0074e4;
      color: white !important;
    }
  </style>
</head>
<header>
<?php include('../Header.php'); ?>
  </header>
<body style="height: 100vh; display: flex; flex-direction: column; overflow: hidden;">
  <!-- Encabezado de la pagina -->
 

  <!-- Cuerpo de la pagina -->
  <div class="row flex-grow-1">
    <div class="col-lg-2">
      <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
      <?php include('../Menu.php'); ?>
    </div>
    <div class="col-10 border-left custom-form">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav">
        <!-- indicador de la ubicacion actual en la pagina -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Inspecciones</a></li>
        </ol>
      </nav>

      <div>
        <h4 class="mb-3">Inspecciones</h4>

        <a href="programarInspeccion.php">
          <!-- Boton para agregar nuevos incidentes -->
          <button class="btn btn-lg float-end custom-btn" type="submit" style="font-size: 15px;"><svg
              xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
              viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg> Agendar inspeccion
          </button></a>

        <h1>Ultimas Inspecciones</h1>
      </div>

      <div class="table-responsive dataTables_wrapper dt-bootstrap5">

        <table id="Tabla_incidentes" class="table table-striped sticky-header" style="width:100%">
          <thead>
            <tr>
              <th scope="col">Inspeccion</th>
              <th scope="col">Estado</th>
              <th scope="col">Proyecto</th>
              <th scope="col">Fecha inicial</th>
              <th scope="col">Fecha final</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              require("../conexion.php");
              
              $sql = $conectar -> query("SELECT 
              gii_inspeccion.pk_id_inspeccion,
              gii_inspeccion.insNombre,
              gii_inspeccion.insEstado,
              gii_inspeccion.insFecha_inicial,
              gii_inspeccion.insFecha_final,
              ga_proyecto.proNombre
              FROM gii_inspeccion
              INNER JOIN
              ga_proyecto ON gii_inspeccion.fk_id_proyecto = ga_proyecto.pk_id_proyecto
              ORDER BY insFecha_creacion DESC;");
              while($Resultado = $sql->fetch_assoc()){
            ?>
            <tr>
              <td>
                <?php echo $Resultado['insNombre']?>
              </td>
              <td>
                <?php echo $Resultado['insEstado']?>
              </td>
              <td>
                <?php echo $Resultado['proNombre']?>
              </td>
              <td>
                <?php 
                  $fechaHoraInicial = $Resultado['insFecha_inicial'];
                  $fechaFormateadaInicial = date("j M Y", strtotime($fechaHoraInicial)); 
                  echo $fechaFormateadaInicial;?>
              </td>
              <td>
                <?php 
                  $fechaHoraFinal = $Resultado['insFecha_final'];
                  $fechaFormateadaFinal = date("j M Y", strtotime($fechaHoraFinal));
                  echo $fechaFormateadaFinal;?>
              </td>
              <td><button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                    <path
                      d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                  </svg>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item btn-desplegable-detalles" data-bs-toggle="modal"
                      data-bs-target="#modalDetallesIncidente">Detalles</a></li>
                  <li><a href="EliminarInspeccionProgramada.php?Id_recuperadoInspeccion=<?php echo $Resultado['pk_id_inspeccion'];?>" class="dropdown-item text-danger">Quitar <svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                          d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                        <path
                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                      </svg></a></li>
                  <li><a href="actualizarInspeccionProgramada.php?Id_recuperadoInspeccion=<?php echo $Resultado['pk_id_inspeccion'];?>" class="dropdown-item btn-desplegable-Actualizar">Actualizar inspeccion</a></li>
                </ul>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Ventana emergente o modal -->

  <div class="modal fade" id="modalDetallesIncidente" tabindex="-1" aria-labelledby="Detalles_incidente"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <!-- Encabezado de la ventana importante ponerlo -->
        <div class="modal-header">
          <div class="row align-items-center w-100">
            <div class="col-6">
              <h5 class="modal-title">Incidentes #1</h5>
            </div>
            <div class="col-6 text-end">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row align-items-center" style="margin-top: 20px;">
              <div class="col-4">
                <button id="DetallesButton" class="btn btn-detalles" type="button">
                  Detalles
                </button>
              </div>
              <div class="col-4">
                <button id="SeguimientoButton" class="btn btn-detalles" type="button">
                  Seguimiento
                </button>
              </div>
              <div class="col-4">
                <a href="../Formularios/Inspeccion.html">
                  <button id="SeguimientoButton" class="btn btn-detalles" type="button">
                    Agendar inspeccion
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- cuerpo de la ventana nesesario ponerlo -->
        <div class="modal-body">
          <div id="Detalles_incidente" style="display: block; width: 700px;">
            <div class="border-bottom row">
              <h6 class="text-muted text-bold">Autor del reporte</h6>
              <div class="col-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                  class="bi bi-person-circle border-right" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
              </div>
              <div class="col-8">
                <p class="lead text-black">María Rodríguez</p>
              </div>
            </div>
            <div style="padding: 5%;">
              <h6 class="text-muted text-bold">Incidente</h6>
              <p class="lead text-black">Dimensiones de columnas fundidas de primera planta</p>
              <h6 class="text-muted text-bold">Estado</h6>
              <p class="lead text-black">Inicializado</p>
              <h6 class="text-muted text-bold">Gravedad</h6>
              <p class="lead text-black">Alto</p>
              <h6 class="text-muted text-bold">Descripcion</h6>
              <p class="lead text-black">Se verificaron que las dimensiones de las columnas hechas no cumplen con los
                diseños
                en
                planos</p>
              <h6 class="text-muted text-bold">Involucrados</h6>
              <p class="lead text-black"></p>No se presentan Involucrados</p>
              <h6 class="text-muted text-bold">Sugerencias</h6>
              <p class="lead text-black">Se le informa al contratista que debe demoler las columnas A1 y A3 porque no
                cumplieron
                con las
                dimensiones de los diseños en planos</p>
              <h6 class="text-muted text-bold">Proyecto</h6>
              <p class="lead text-black">Proyecto de Carretera Transversal</p>


              <h6 class="text-muted text-bold">Fecha y hora del reporte</h6>
              <p class="lead text-black">2023-10-24 18:59:27</p>
            </div>
          </div>
          <div id="Seguimiento" style="display: none;">
            <div class="row">
              <div class="col-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-circle-fill linea-tiempo" viewBox="0 0 16 16">
                  <circle cx="8" cy="8" r="8" />
                </svg>
              </div>
              <div class="col-11">
                <h6 class="text-muted text-bold">Fecha y hora del reporte</h6>
                <p class="lead text-black">2023-10-24 18:59:28</p>
                <h6 class="text-muted text-bold">Descripcion</h6>
                <p class="lead text-black">Se realizó una nueva inspección en el área afectada para verificar la
                  efectividad
                  de las medidas tomadas.</p>
                <h6 class="text-muted text-bold">Sugerencias</h6>
                <p class="lead text-black">Se confirmó que las correcciones fueron exitosas y se levantó la suspensión
                  de
                  labores.</p>
              </div>
              <br>
              <div class="col-1 linea-tiempo">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-circle-fill linea-tiempo" viewBox="0 0 16 16">
                  <circle cx="8" cy="8" r="8" />
                </svg>
              </div>
              <div class="col-11">
                <h6 class="text-muted text-bold">Fecha y hora del reporte</h6>
                <p class="lead text-black">2023-10-24 19:59:27</p>
                <h6 class="text-muted text-bold">Descripcion</h6>
                <p class="lead text-black">Se programó una reunión de seguimiento con el contratista para evaluar el
                  avance
                  de las correcciones.</p>
                <h6 class="text-muted text-bold">Sugerencias</h6>
                <p class="lead text-black">El contratista presentó avances significativos y se acordó continuar
                  supervisando
                  el progreso.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="Incidentes_dashboard.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#Tabla_incidentes').DataTable();
    });
  </script>

  
</body>

</html>