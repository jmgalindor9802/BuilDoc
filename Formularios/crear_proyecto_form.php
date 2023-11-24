<!doctype html>
<html lang="es">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyecto</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <style>

    #usuario_proyecto_disponible {
      max-height: 300px; /* Cambia este valor según la altura deseada */
      overflow-y: auto;
    }

    .border-left {
      border-left: 1px solid #d7d7d7;
      height: 100%;
    }

    .custom-btn {
      background-color: #0074e4;
      color: #ffffff;
    }

    .vh-80 {
      max-height: 80vh;
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
    <div class="col-10 border-left">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Proyectos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Crear proyecto</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Nuevo proyecto</h4>
      <div class="col-12 custom-form vh-80">
        <br>

        <form id="formRegistroProyecto" class="needs-validation" method="post" action="crear_proyecto.php" 
        onsubmit="agregarNuevoProyecto()" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label id="NombreProyecto" for="name" class="form-label">Nombre</label>
              <input name="ProyectoNombre" type="text" class="form-control" id="name" placeholder="Nombre proyecto"
                value="" required>
              <div class="invalid-feedback">
                Se requiere un nombre válido.
              </div>
            </div>
            <div class="col-md-6">
              <label for="municipio" class="form-label">Municipio</label>
              <select name="ProyectoMunicipio" class="form-select" id="municipio" required>
                <option value="">Elegir...</option>
                <option value="1">Bogotá, D.C.</option>
                <option value="2">Medellín</option>
                <option value="3">Cali</option>
              </select>
              <div class="invalid-feedback">
                Se requiere un municipio válido.
              </div>
            </div>
            <div class="col-12">
              <label class="form-label">Dirección</label>
              <div class="input-group has-validation">
                <input name="ProyectoDireccion" type="text" class="form-control" id="direccion" placeholder="Dirección"
                  required>
                <div class="invalid-feedback">
                  Se requiere una dirección válida.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="Descripcion" class="form-label">Descripción</label>
              <textarea name="ProyectoDescripcion" class="form-control" id="Descripcion" rows="5"
                placeholder="Descripción de proyecto" required></textarea>
              <div class="invalid-feedback">
                Se requiere una descripción válida.
              </div>
            </div>
            
            <div class="col-md-6">
              <label for="cliente" class="form-label">Cliente</label>
              <select name="ProyectoCliente" class="form-select" id="cliente" required>
                <option value="">Elegir...</option>
                <?php
                include ("conexion.php");

                $sql = $conectar->query("SELECT * FROM ga_cliente ORDER BY cliNombre ASC");
                while ($resultado = $sql->fetch_assoc()) {

                echo "<option value='".$resultado['pk_id_cliente']."'>".$resultado
                ['cliNombre']."</option>";

                }
                ?>
              </select>
              <div class="invalid-feedback">
                Se requiere un cliente válido.
              </div>
            </div>
            <div class="col-sm-6">
              <label id="RutaProyecto" for="name" class="form-label">Ruta</label>
              <input name="ProyectoRuta" type="text" class="form-control" id="name" placeholder="Ruta proyecto"
                value="" required>
              <div class="invalid-feedback">
                Se requiere una ruta válido.
              </div>
            </div>

            <div class="row g-3">
              <div class="col-md-6">
              <h4>Asignar usuarios</h4>
                  <label for="usuario_proyecto_disponible" class="form-label">Seleccione a quienes desea asignar al proyecto</label>
                  <ul class="list-group" id="usuario_proyecto_disponible" >
                  <?php
                  //Lista de Usuarios
                  include("conexion.php");
                  $sql = $conectar->query("SELECT pk_id_usuario, CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo 
                  FROM usuario ORDER BY nombre_completo ASC");
                  while ($resultado = $sql->fetch_assoc()) {
                      echo '<div class="form-check">
                              <input class="form-check-input" type="checkbox" name="usuarios_proyecto[]" value="' . $resultado['pk_id_usuario'] . '" id="checkbox' . $resultado['pk_id_usuario'] . '">
                              <label class="form-check-label" for="checkbox' . $resultado['pk_id_usuario'] . '">' . $resultado['nombre_completo'] . '</label>
                            </div>';
                  }
                  ?>
                  </ul>
              </div>
              <div class="py-4">
                <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;"
                data-bs-toggle="modal" data-bs-target="#CrearProyecto">Guardar
                  proyecto</a>
              </div>
            </div>
            <div class="modal" tabindex="-1" id="CrearProyecto">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Crear proyecto</h5>
                  </div>
                  <div class="modal-body">
                    <p>¿Estás seguro de crear este proyecto?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="crear_proyecto_form.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
    function agregarNuevoProyecto() {
    $.ajax({
        method: "POST",
        data: $('#formRegistroProyecto').serialize(),
        url: "crear_proyecto_form.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();

            if (respuesta === "1") {
                $('#formRegistroProyecto')[0].reset();
                swal(":D", "Proyecto agregado correctamente", "success");
            } else if (respuesta === "2") {
                swal("Error", "Este proyecto ya existe, por favor añade otro.", "error");
            } else {
                swal("Error", "Hubo un problema al agregar el proyecto", "error");
            }
        },
        error: function() {
            swal("Error", "Hubo un problema al comunicarse con el servidor", "error");
        }
    });

    return false;
}
</script>
</body>

</html>