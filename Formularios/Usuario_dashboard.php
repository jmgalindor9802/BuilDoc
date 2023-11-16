<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuario</title>
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
  <!-- Encabezado de la pagina -->
  <header>
    <!-- Revisar que  max-height:78px funcione sin problemas en diferentes pantallas-->
    <iframe src="Header.html" class="w-100" height="78" style="max-height:78px;" title="Encabezado"></iframe>
  </header>

  <div class="row flex-grow-1">
    <div class="col-lg-2">
      <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
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
        <h4 class="mb-3">Usuarios</h4>
        <a href="Usuario.html"><button class="btn btn-lg float-end custom-btn" type="submit"
            style="font-size: 15px; margin-right: 5px;">+ Crear
            usuario</button></a>
        <h1 class="display-6 mb-3" style="margin-bottom: 5px;">Usuarios</h1>
        <div class="dropdown mb-3">
          <button id="proyectoSeleccionado" class="btn btn-secondary dropdown-toggle" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Todos los usuarios
          </button>
          <?php
            
            require("conexion.php");
            
            $sql = $conectar->query("SELECT usuMunicipio FROM usuario");



            while ($resultado = $sql->fetch_assoc()){
            
          ?>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><?php echo $resultado ['usuMunicipio']?></a></li>
          <?php
            }
          ?>  
          </ul>
        </div>
      </div>
      <div class="table-responsive vh-80">
        <table id="tablaUsuarios" class="table table-striped table-hover sticky-header">
          <caption>Esta tabla muestra los usuarios existentes.</caption>
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Municipio</th>
              <th scope="col">Telefono</th>
              <th scope="col">Correo</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            
            require("conexion.php");
            
            $sql = $conectar->query("SELECT CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo, usuMunicipio, usuTelefono, usuCorreo FROM usuario");



            while ($resultado = $sql->fetch_assoc()){
            
            ?>

            <tr>
              <td scope="row"><?php echo $resultado ['nombre_completo']?></td>
              <td scope="row"><?php echo $resultado ['usuMunicipio']?></td>
              <td scope="row"><?php echo $resultado ['usuTelefono']?></td>
              <td scope="row"><?php echo $resultado ['usuCorreo']?></td>
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

  <script src="Usuario.js"></script>
  <script src="Usuario_dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>