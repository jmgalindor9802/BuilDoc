<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyecto</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
        <a href="Proyecto.html"><button class="btn btn-lg float-end custom-btn" type="submit"
            style="font-size: 15px; margin-right: 5px;">+ Crear
            proyecto</button></a>
        <button class="btn btn-lg float-end custom-btn" type="submit"
          style="font-size: 15px; margin-right: 5px;">Proyectos eliminados</button>
        <h1 class="display-6 mb-3" style="margin-bottom: 5px;">Ultimos proyectos creados</h1>
        <div class="dropdown mb-3">
          <button id="proyectoSeleccionado" class="btn btn-secondary dropdown-toggle" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Todos los proyectos
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Todos los proyectos</a></li>
            <li><a class="dropdown-item" href="#">Bogotá</a></li>
            <li><a class="dropdown-item" href="#">Medellín</a></li>
            <li><a class="dropdown-item" href="#">Barranquilla</a></li>
            <li><a class="dropdown-item" href="#">Cali</a></li>
            <li><a class="dropdown-item" href="#">Cartagena</a></li>
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
            
            require(conexion.php);
            
            $sql = $conectar->query("SELECT * from ga_proyecto
            INNER JOIN ga_cliente ON ga_proyecto.fk_id_proyecto = ga_cliente.pk_id_cliente");



            while ($resultado = $sql->fetch_assoc()){
            
            ?>

            <tr>
              <th scope="row"><?php echo $resultado ['proNombre']?></th>
              <th scope="row"><?php echo $resultado ['proMunicipio']?></th>
              <th scope="row"><?php echo $resultado ['fk_id_cliente']?></th>
              <th scope="row"><?php echo $resultado ['proFecha_creacion']?></th>
              <th scope="row">
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

              </th>
            </tr>
            <?php
            }
            ?>
            <tr>
              <td>Construcción de Viaducto Sur</td>
              <td>Medellín</td>
              <td>Constructora Bolívar</td>
              <td>2023-08-22 08:30:15</td>
              <td>
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
            <tr>
              <td>Proyecto de Carretera Transversal</td>
              <td>Barranquilla</td>
              <td>Constructora Bolívar</td>
              <td>2023-05-10 15:20:45</td>
              <td>
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
            <tr>
              <td>Ampliación de Aeropuerto Internacional</td>
              <td>Cali</td>
              <td>Constructora Bolívar</td>
              <td>2023-07-18 10:55:00</td>
              <td>
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
            <tr>
              <td>Proyecto de Túnel Subterráneo</td>
              <td>Bogotá</td>
              <td>Constructora Bolívar</td>
              <td>2023-09-01 14:10:20</td>
              <td>
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
            <tr>
              <td>Construcción de Puentes y Pasarelas</td>
              <td>Medellín</td>
              <td>Constructora Bolívar</td>
              <td>2023-03-30 11:25:40</td>
              <td>
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
            <tr>
              <td>Proyecto de Reciclaje de Agua</td>
              <td>Cartagena</td>
              <td>Constructora Bolívar</td>
              <td>2023-10-05 13:35:50</td>
              <td>
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
            <tr>
              <td>Construcción de Vías Rurales</td>
              <td>Bogotá</td>
              <td>Constructora Bolívar</td>
              <td>2023-04-12 09:40:10</td>
              <td>
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
            <tr>
              <td>Proyecto de Presa Hidroeléctrica</td>
              <td>Medellín</td>
              <td>Constructora Bolívar</td>
              <td>2023-11-20 16:15:30</td>
              <td>
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
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Ventanas emergentes o modals -->
  <div class="modal" id="ActualizarProyecto" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Actualizar</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h1 class="modal-title fs-6" id="NombreProyectoLabel" style="text-align: start;">Nombre:
          </h1>
          <input class="float-start" name="NombreAct" type="text">
          <br>
          <br>
          <h1 class="modal-title fs-6" id="DescripcionProyectoLabel" style="text-align: start;">
            Descripcion:</h1>
          <input class="float-start" name="DescripcionAct" type="text">
          <br>
          <br>
          <h1 class="modal-title fs-6" id="MunicipioProyectoLabel" style="text-align: start;">
            Municipio:</h1>
          <input class="float-start" name="MunicipioAct" type="text">
          <br>
          <br>
          <h1 class="modal-title fs-6" id="DireccionProyectoLabel" style="text-align: start;">
            Direccion:</h1>
          <input class="float-start" name="DireccionAct" type="text">
          <br>
          <br>
          <h1 class="modal-title fs-6" id="RutaProyectoLabel" style="text-align: start;">Ruta:</h1>
          <input class="float-start" name="RutaAct" type="text">
          <br>
          <br>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="DetallesProyecto" tabindex="-1" aria-labelledby="DetallesProyecto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <!-- Encabezado de la ventana importante ponerlo -->
        <div class="modal-header">
          <div class="row align-items-center w-100">
            <div class="col-6">
              <h5 class="modal-title">Proyecto</h5>
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
              <p class="lead text-black">Se verificaron que las dimensiones de las columnas hechas no
                cumplen con los
                diseños
                en
                planos</p>
              <h6 class="text-muted text-bold">Involucrados</h6>
              <p class="lead text-black"></p>No se presentan Involucrados</p>
              <h6 class="text-muted text-bold">Sugerencias</h6>
              <p class="lead text-black">Se le informa al contratista que debe demoler las columnas A1
                y A3 porque no
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
                <p class="lead text-black">Se realizó una nueva inspección en el área afectada para
                  verificar la
                  efectividad
                  de las medidas tomadas.</p>
                <h6 class="text-muted text-bold">Sugerencias</h6>
                <p class="lead text-black">Se confirmó que las correcciones fueron exitosas y se
                  levantó la suspensión
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
                <p class="lead text-black">Se programó una reunión de seguimiento con el contratista
                  para evaluar el
                  avance
                  de las correcciones.</p>
                <h6 class="text-muted text-bold">Sugerencias</h6>
                <p class="lead text-black">El contratista presentó avances significativos y se acordó
                  continuar
                  supervisando
                  el progreso.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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