<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inspeccion</title>
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
    <div class="col-10 border-left ">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Inspección</a></li>
          <li class="breadcrumb-item active" aria-current="page">Programar inspección</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Programar inspección</h4>
      <div class="col-12 custom-form vh-80">
        <br>

        <form action="inspecciones.php" method="POST" class="needs-validation " style="max-height: 70vh" novalidate>

          <div class="row g-3">
            <div class="col-md-6">
              <label for="proyecto" class="form-label">Proyecto</label>
              <select name="proyecto_inspeccion" class="form-select" id="proyecto" required>
                <option value="">Seleccionar...</option>
                <?php
                                    include_once 'conexion.php';

                                    $sql = "SELECT pk_id_proyecto, proNombre FROM ga_proyecto ORDER BY proNombre";
                                $result = mysqli_query($conectar, $sql);

                                // Rellenar opciones del select con los resultados de la consulta
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["pk_id_proyecto"] . "'>" . $row["proNombre"] . "</option>";
                                    }}
                                ?>
              </select>
              <div class="invalid-feedback">
                Se requiere seleccionar un proyecto válido.
              </div>
            </div>
            <div class="col-md-6">
              <label id="nombreInspeccion" for="firstName" class="form-label">Nombre de la inspección</label>
              <input name="nombre_Inspeccion" type="text" class="form-control" id="firstName" placeholder="Nombre de la inspección" value=""
                required required maxlength="280">
              <div class="invalid-feedback">
                Se requiere un nombre válido.
              </div>
            </div>
            <div class="col-md-6">
              <label for="periodicidad" class="form-label">Periodicidad</label>
              <!-- boton de ayuda -->
              <button type="button" class="btn btn-sm btn-secondary" id="ayudaGravedad" data-bs-toggle="popover"
                data-bs-placement="top" title="Ayuda sobre la Gravedad"
                data-bs-content="Haga clic aquí para obtener más información">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                  <path
                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                </svg>
              </button>
              <!-- lista de opciones para la seleccion -->
              <?php
// Definir un array asociativo para mapear los valores de la base de datos a los valores del formulario
$periodicidades = array(
    "DIARIA" => "Diaria",
    "SEMANAL" => "Semanal",
    "MENSUAL" => "Mensual",
    "NINGUNA" => "Ninguna",
    // Añade el valor "Ninguna" si lo necesitas
);
?>
              <select name="insPeriodicidad" class="form-select" id="periodicidad" required>
                <option value="">Seleccionar...</option>
                <?php
                foreach ($periodicidades as $valorBD => $valorFormulario) {
                  echo '<option value="' . $valorBD . '">' . $valorFormulario . '</option>';
              }
              ?>
              </select>
              <div class="invalid-feedback">
                Se requiere seleccionar una periodicidad válida.
              </div>
            </div>
            <div class="col-md-6">
              <label for="Evidencia" class="form-label">Adjuntar formulario de inspección</label>
              <input name="fourmulario_inspeccion" class="form-control" type="file" id="Evidencia" multiple required>
              <div class="invalid-feedback">
                Se requiere adjuntar una evidencia válida.
              </div>
            </div>
            <div class="col-md-12" style="display: none;" id="contenedor_FechaInspeccion">
              <label for="FechaInspeccion"> Fecha y hora de la inspección</label>
              <input name="fecha_unica_inspeccion" type="datetime-local" class="form-control" id="FechaInspeccion" required>
              <div class="invalid-feedback" id="error-fechaInspeccion-mensaje">
                Seleccione una fecha y hora válida.
              </div>
              <div class="invalid-feedback" id="error-fechaInspeccion-anterior-mensaje">
                La fecha y hora de inspección debe ser posterior a la actual.
              </div>
            </div>
            <div class="col-md-6" style="display: none;" id="contenedor_fechaInicial">
              <label for="fechaInicial">Fecha y hora de inicio:</label>
              <input name="fechaInicialInspeccion" type="datetime-local" class="form-control" id="fechaInicial" required>
              <div class="invalid-feedback" id="error-fechaInicial-mensaje">
                Seleccione una fecha y hora válida.
              </div>
              <div class="invalid-feedback" id="error-fechaInicial-anterior-mensaje">
                La fecha y hora de inicio debe ser posterior a la actual.
              </div>
            </div>
            <div class="col-md-6" style="display: none;" id="contenedor_fechaFinal">
              <label for="fechaFinal">Fecha y hora de finalización:</label>
              <input name="fechaFinalInspeccion" type="datetime-local" class="form-control" id="fechaFinal" required>
              <div class="invalid-feedback" id="error-fechaFinal-mensaje">
                La fecha y hora de finalización es inválida.
              </div>
              <div class="invalid-feedback" id="error-fechaFinal-anterior-mensaje">
                La fecha y hora de finalización debe ser posterior a la actual.
              </div>
            </div>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
              <textarea name="descripcionInspeccion" class="form-control" id="exampleFormControlTextarea1" rows="5"
                placeholder="Descripción del proyecto" required maxlength="5000"></textarea>
              <div class="invalid-feedback">
                Se requiere una descripción válida.
              </div>
            </div>
            <div class="row g-3">
              <h4>Asignar Inspector</h4>
              <div class="col-md-6">
                <label for="usuario_inspeccion_disponible" class="form-label">Seleccione quién va a realizar la
                  inspección</label>
                <select name="Inspecctor" class="form-select" id="usuario_inspeccion_disponible" multiple>
                <?php
                require 'conexion.php';
                //CONCAT nombre y apellido de usuario
                $sql = $conectar->query("SELECT CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo FROM usuario");
                while ($resultado = $sql->fetch_assoc()) {

                echo "<option value='".$resultado['pk_id_usuario']."'>".$resultado
                ['nombre_completo']."</option>";

                }
                ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="usuario_inspeccion_seleccionado" class="form-label">Inspector asignado</label>
                <div class="invalid-feedback" id="error-mensaje">
                  Seleccione al menos una persona.
                </div>
                <ul class="list-group mt-3" id="inspectores-seleccionados">
                  <!-- Aquí se agregarán las opciones seleccionadas por JavaScript -->
                </ul>
              </div>
            </div>

          </div>
          <div class="py-4">
          <button class="btn btn-lg float-end custom-btn" id="guardarFaseButton"
                            style="font-size: 15px;">Guardar incidente</button>
                            <script>

document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector('.needs-validation');
    var guardarFaseButton = document.getElementById('guardarFaseButton');
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

    guardarFaseButton.addEventListener('click', function () {
        // Verifica si el formulario es válido antes de abrir el modal
        if (form.checkValidity()) {
            confirmModal.show();
        } else {
            form.classList.add('was-validated');
        }
    });

    // Agrega un evento de clic al botón de "Confirmar" dentro del modal
    var confirmarModalButton = document.getElementById('confirmarModalButton');
    confirmarModalButton.addEventListener('click', function () {
        // Verifica si el formulario es válido antes de enviarlo
        if (form.checkValidity()) {
            form.submit(); // Envía el formulario
            confirmModal.hide(); // Cierra el modal después de enviar
        } else {
            form.classList.add('was-validated'); // Muestra los mensajes de validación
        }
    });
});
</script>
<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
aria-labelledby="confirmModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Confirmar envío</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ¿Estás seguro de que deseas enviar el formulario?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary"
                id="confirmarModalButton">Confirmar</button>
        </div>
    </div>
</div>
</div>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script src="programarInspeccion.js"></scrip>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>