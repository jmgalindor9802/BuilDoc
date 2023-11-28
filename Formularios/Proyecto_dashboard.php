<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyecto</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  




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
      padding-left: 8%;
      padding-right: 8%;
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
      <nav aria-label="breadcrumb">
        <ol class=" breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Proyectos</a></li>
        </ol>
      </nav>
      <div>
        <h4 class="mb-3">Proyectos</h4>
        <a href="crear_proyecto_form.php"><button class="btn btn-lg float-end custom-btn" type="submit"
            style="font-size: 15px; margin-right: 5px;">+ Crear
            proyecto</button></a>
        <h1 class="display-6 mb-3" style="margin-bottom: 5px;">Ultimos proyectos creados</h1>
        <div class="dropdown mb-3">
        <button id="proyectoSeleccionado" class="btn btn-secondary dropdown-toggle" type="button"
            data-toggle="dropdown" aria-expanded="false">
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
              $sql = "SELECT proMunicipio FROM ga_proyecto ORDER BY proMunicipio";
              $result = mysqli_query($conectar, $sql);
              
              // Rellenar opciones del select con los resultados de la consulta
              if ($result && mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      echo '<li><a class="dropdown-item" href="#">' . $row["proMunicipio"] . '</a></li>';
                  }
              } else {
                  echo "No se encontraron resultados.";
              }              
              ?>
          </ul>
        </div>
      </div>

      <div class="table-responsive vh-80">
        <table id="tablaProyectos" class="table table-striped table-hover sticky-header">
          <caption>Esta tabla muestra los proyectos existentes.</caption>
          <thead>
            <tr>
              <th scope="col">Proyecto</th>
              <th scope="col">Municipio</th>
              <th scope="col">Cliente</th>
              <th scope="col">Fecha de Creacion</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            
            require("conexion.php");
            
            $sql = $conectar->query("SELECT * from ga_proyecto
            INNER JOIN ga_cliente ON ga_proyecto.fk_id_cliente = ga_cliente.pk_id_cliente 
            ORDER BY proFecha_creacion DESC");



            while ($resultado = $sql->fetch_assoc()){
            
            ?>

            <tr>
              <td scope="row"><?php echo $resultado ['proNombre']?></td>
              <td scope="row"><?php echo $resultado ['proMunicipio']?></td>
              <td scope="row"><?php echo $resultado ['cliNombre']?></td>
              <td scope="row"><?php // Utiliza la función date de PHP para formatear la fecha
                                    $fechaHora = $resultado['proFecha_creacion'];
                                    $fechaFormateada = date("j M Y", strtotime($fechaHora)); 
                                    echo $fechaFormateada;?></td>
              <td scope="row">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                    <path
                      d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                  </svg>
                </button>
                <ul class="dropdown-menu">
                  <li><a id="btn-desplegable-detalles" href="#" class="dropdown-item" data-bs-toggle="modal"
                      data-bs-target="#ActualizarProyecto">Actualizar</a></li>
                  <li><a id="btn-desplegable-seguimiento" href="#" class="dropdown-item" data-bs-toggle="modal"
                      data-bs-target="#DetallesProyecto">Detalles</a></li>
                  <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                      data-bs-target="#EliminarProyecto">Archivar <svg xmlns="http://www.w3.org/2000/svg" width="16"
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
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <?php 
  require("conexion.php");
            
  $sql = $conectar->query("SELECT * from ga_proyecto
  INNER JOIN ga_cliente ON ga_proyecto.fk_id_cliente = ga_cliente.pk_id_cliente");

  while ($resultado = $sql->fetch_assoc()){
            
  ?>
  <!-- Ventanas emergentes o modals -->
  <div class="modal fade" id="ActualizarProyecto" tabindex="-1" aria-labelledby="ActualizarProyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <!-- Encabezado de la ventana importante ponerlo -->
        <div class="modal-header">
          <div class="row align-items-center w-100">
            <div class="col-6">
              <h5 class="modal-title"><?php echo $resultado ['proNombre']?></h5>
            </div>

          </div>
        </div>
        <!-- cuerpo de la ventana nesesario ponerlo -->
        <div class="modal-body">
          <div id="Act" style="display: block; width: 700px;">
            <div class="border-bottom row">
              <div class="col-8">
                <p class="lead text-black">Actualización Proyecto</p>
              </div>
            </div>
            <div style="padding: 5%;">
            <h6 class="text-muted text-bold">Nuevo nombre</h6>
            <input type="text" name="proNombreActualizar" class="form-control" id="proNombreActualizar" 
            placeholder="Nombre" required>
            <div class="invalid-feedback">
                  Se requiere una dirección válido.
            </div>
            <br>
            <h6 class="text-muted text-bold">Nuevo municipio</h6>
            <input type="text" name="proMunicipioActualizar" class="form-control" id="proMunicipioActualizar" 
            placeholder="Municipio" required>
            <div class="invalid-feedback">
                  Se requiere una dirección válido.
            </div>
            <br>  
            <h6 class="text-muted text-bold">Nueva direccion</h6>
            <input type="text" name="proDireccionActualizar" class="form-control" id="proDireccionActualizar" 
            placeholder="Direccion" required>
            <br>  
            <h6 class="text-muted text-bold">Nueva descripcion</h6>
            <input type="text" name="proDescripcionActualizar" class="form-control" id="proDescripcionActualizar" 
            placeholder="Descripcion" required>
            <div class="invalid-feedback">
                  Se requiere una dirección válido.
            </div>
            <br>            
            <h6 class="text-muted text-bold">Nueva ruta</h6>
            <input type="text" name="proRutaActualizar" class="form-control" id="prRutaActualizar" 
            placeholder="Ruta" required>
            <div class="invalid-feedback">
                  Se requiere una dirección válido.
            </div>
            <br>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>

  <?php 
  require("conexion.php");
            
  $sql = $conectar->query("SELECT * from ga_proyecto
  INNER JOIN ga_cliente ON ga_proyecto.fk_id_cliente = ga_cliente.pk_id_cliente");

  while ($resultado = $sql->fetch_assoc()){
            
  ?>
  <div class="modal fade" id="DetallesProyecto" tabindex="-1" aria-labelledby="DetallesProyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <!-- Encabezado de la ventana importante ponerlo -->
        <div class="modal-header">
          <div class="row align-items-center w-100">
            <div class="col-6">
              <h5 class="modal-title"><?php echo $resultado ['proNombre']?></h5>
            </div>
            <div class="col-6 text-end">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
          </div>
        </div>
        <!-- cuerpo de la ventana nesesario ponerlo -->
        <div class="modal-body">
          <div id="Detalles_incidente" style="display: block; width: 700px;">
            <div class="border-bottom row">
              <div class="col-8">
                <p class="lead text-black">Informacion Proyecto</p>
              </div>
            </div>
            <div style="padding: 5%;">
            <h6 class="text-muted text-bold">Municipio</h6>
              <p class="lead text-black"><?php echo $resultado ['proMunicipio']?></p>
              <h6 class="text-muted text-bold">Direccion</h6>
              <p class="lead text-black"><?php echo $resultado ['proDireccion']?></p>
              <h6 class="text-muted text-bold">Descripcion</h6>
              <p class="lead text-black"><?php echo $resultado ['proDescripcion']?></p>
              <h6 class="text-muted text-bold">Fecha de Creacion</h6>
              <p class="lead text-black"><?php
                // $resultado['proFecha_creacion'] debería contener la fecha en formato ISO 8601, por ejemplo, "2023-11-15T12:30:00"
                $fechaHora = $resultado['proFecha_creacion'];
                // Llama a la función formatearFechaHora con la fecha y hora
                $fechaHoraFormateada = formatearFechaHora($fechaHora);
                echo $fechaHoraFormateada;
              ?></p>
              <h6 class="text-muted text-bold">Ruta</h6>
              <p class="lead text-black"><?php echo $resultado ['proRuta']?></p>
            </div>
            <div class="border-bottom row">
              <div class="col-8">
                <p class="lead text-black">Informacion Cliente</p>
              </div>
            </div>
            <div style="padding: 5%;">
            <h6 class="text-muted text-bold">Nombre</h6>
              <p class="lead text-black"><?php echo $resultado ['cliNombre']?></p>
              <h6 class="text-muted text-bold">Correo</h6>
              <p class="lead text-black"><?php echo $resultado ['cliCorreo']?></p>
              <h6 class="text-muted text-bold">Telefono</h6>
              <p class="lead text-black"><?php echo $resultado ['cliTelefono']?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>

  <div class="modal" tabindex="-1" id="EliminarProyecto">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar proyecto</h5>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro de eliminar este proyecto?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="Proyecto.js"></script>
  <script src="Proyecto_dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>