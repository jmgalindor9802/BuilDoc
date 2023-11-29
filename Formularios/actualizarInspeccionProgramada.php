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

        <form action="actualizarIns.php" method="POST" class="needs-validation " style="max-height: 70vh" novalidate>
          <?php
            include_once('conexion.php');
            // Verificar si la variable está definida y no es nula antes de usarla en la consulta
            if (isset($_REQUEST['Id_recuperadoInspeccion']) && !empty($_REQUEST['Id_recuperadoInspeccion'])) {
            $sql = "SELECT
                    i.*,
                    u.usuNombre AS nombre_usuario,
                    u.usuApellido AS apellido_usuario,
                    gp.proNombre AS nombre_proyecto
                    FROM 
                    gii_inspeccion i
                    INNER JOIN usuarios_gii_inspecciones ugi ON i.pk_id_inspeccion = ugi.fk_id_inspeccion
                    INNER JOIN usuario u ON ugi.fk_id_usuario = u.pk_id_usuario
                    INNER JOIN ga_proyecto gp ON i.fk_id_proyecto = gp.pk_id_proyecto
                    WHERE 
                    i.pk_id_inspeccion = ?";
            $stmt = $conectar->prepare($sql);
            if (!$stmt) {
              die("Error al preparar la consulta: " . $conectar->error);
            }
            $stmt->bind_param("i", $_REQUEST['Id_recuperadoInspeccion']);
            $stmt->execute();
            $resultadoConsulta = $stmt->get_result();
            if ($resultadoConsulta->num_rows > 0) {
              $row = $resultadoConsulta->fetch_assoc();
            } else {
              echo "No se encontró ningún incidente con esa ID";
            }
            $stmt->close();
            } else {
              echo "ID de incidente no válida";
            }
          ?>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="proyecto" class="form-label">Proyecto</label>
              <select name="proyecto_inspeccion" class="form-select" id="proyecto" required>
                <option value="<?php echo $row['fk_id_proyecto']; ?>">
                  <?php echo $row['nombre_proyecto']; ?>
                </option>
                <?php
    $sqlProyectos = "SELECT pk_id_proyecto, proNombre FROM ga_proyecto ORDER BY proNombre";
    $resultProyectos = mysqli_query($conectar, $sqlProyectos);

    if ($resultProyectos && mysqli_num_rows($resultProyectos) > 0) {
        while($rowProyecto = mysqli_fetch_assoc($resultProyectos)) {
            echo "<option value='" . $rowProyecto["pk_id_proyecto"] . "'>" . $rowProyecto["proNombre"] . "</option>";
        }
    }
    ?>
              </select>
              <div class="invalid-feedback">
                Se requiere seleccionar un proyecto válido.
              </div>
            </div>
            <div class="col-md-6">
              <label id="nombreInspeccion" for="firstName" class="form-label">Nombre de la inspección</label>
              <input name="nombre_Inspeccion" type="text" class="form-control" id="firstName"
                placeholder="Nombre de la inspección" value="<?php echo $row['insNombre']?>" required maxlength="280">
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
                <?php
            foreach ($periodicidades as $valorBD => $valorFormulario) {
                echo '<option value="' . $valorBD . '"';
                if ($valorBD == $row['insPeriodicidad']) {
                    echo ' selected';
                }
                echo '>' . $valorFormulario . '</option>';
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
            <div class="col-md-12" id="contenedor_FechaInspeccion">
    <label for="FechaInspeccion">Fecha y hora de la inspección</label>
    <input name="fecha_unica_inspeccion" type="datetime-local" class="form-control" id="FechaInspeccion"
           value="<?php echo date('Y-m-d\TH:i', strtotime($row['insFecha_inicial'])); ?>" required>
    <div class="invalid-feedback" id="error-fechaInspeccion-mensaje">
        Seleccione una fecha y hora válida.
    </div>
    <div class="invalid-feedback" id="error-fechaInspeccion-anterior-mensaje">
        La fecha y hora de inspección debe ser posterior a la actual.
    </div>
</div>

<div class="col-md-6" id="contenedor_fechaInicial">
    <label for="fechaInicial">Fecha y hora de inicio:</label>
    <input name="fechaInicialInspeccion" type="datetime-local" class="form-control" id="fechaInicial"
           value="<?php echo date('Y-m-d\TH:i', strtotime($row['insFecha_inicial'])); ?>" required>
    <div class="invalid-feedback" id="error-fechaInicial-mensaje">
        Seleccione una fecha y hora válida.
    </div>
    <div class="invalid-feedback" id="error-fechaInicial-anterior-mensaje">
        La fecha y hora de inicio debe ser posterior a la actual.
    </div>
</div>

<div class="col-md-6" id="contenedor_fechaFinal">
    <label for="fechaFinal">Fecha y hora de finalización:</label>
    <input name="fechaFinalInspeccion" type="datetime-local" class="form-control" id="fechaFinal"
           value="<?php echo date('Y-m-d\TH:i', strtotime($row['insFecha_final'])); ?>" required>
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
                placeholder="Descripción del proyecto" required
                maxlength="5000"><?php echo $row['insDescripcion']; ?></textarea>
              <div class="invalid-feedback">
                Se requiere una descripción válida.
              </div>
            </div>
            <div class="row g-3">
            <?php
// Recuperar inspectores asignados a la inspección actual
$sqlInspectoresAsignados = "SELECT fk_id_usuario FROM usuarios_gii_inspecciones WHERE fk_id_inspeccion = ?";
$stmtInspectoresAsignados = $conectar->prepare($sqlInspectoresAsignados);

if (!$stmtInspectoresAsignados) {
    die("Error al preparar la consulta: " . $conectar->error);
}

$stmtInspectoresAsignados->bind_param("i", $row['pk_id_inspeccion']);
$stmtInspectoresAsignados->execute();
$resultInspectoresAsignados = $stmtInspectoresAsignados->get_result();
$inspectoresAsignados = array();

while ($rowInspectorAsignado = $resultInspectoresAsignados->fetch_assoc()) {
    $inspectoresAsignados[] = $rowInspectorAsignado['fk_id_usuario'];
}

$stmtInspectoresAsignados->close();
?>
              <div class="col-md-6">
    <h4>Asignar usuarios</h4>
    <label for="usuario_proyecto_disponible" class="form-label">Seleccione a quienes desea asignar al proyecto</label>
    <ul class="list-group" id="usuario_proyecto_disponible">
        <?php
        // Lista de Usuarios
        $sqlUsuarios = $conectar->query("SELECT pk_id_usuario, CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo FROM usuario ORDER BY nombre_completo ASC");

        while ($resultadoUsuario = $sqlUsuarios->fetch_assoc()) {
            $isChecked = in_array($resultadoUsuario['pk_id_usuario'], $inspectoresAsignados) ? 'checked' : '';
            echo '<div class="form-check">
                    <input class="form-check-input" type="checkbox" name="usuarios_proyecto[]" value="' . $resultadoUsuario['pk_id_usuario'] . '" id="checkbox' . $resultadoUsuario['pk_id_usuario'] . '" ' . $isChecked . '>
                    <label class="form-check-label" for="checkbox' . $resultadoUsuario['pk_id_usuario'] . '">' . $resultadoUsuario['nombre_completo'] . '</label>
                </div>';
        }
        ?>
    </ul>
</div>
<input type="hidden" name="Id_inspeccion" value="<?php echo $_REQUEST['Id_recuperadoInspeccion']; ?>" class="d-none">

              <div class="py-4">
                <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;" data-bs-toggle="modal"
                  data-bs-target="#ProgramarInspeccion">Guardar
                  Inspeccion</a>
              </div>
            </div>
          </div>
          <div class="modal" tabindex="-1" id="ProgramarInspeccion">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Programar Inspeccion</h5>
                </div>
                <div class="modal-body">
                  <p>¿Estás seguro de programar esta inspeccion?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>

  <script src="actualizarInspeccionProgramada.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script>
    // Llama a la función que maneja la visibilidad en el evento DOMContentLoaded
    document.addEventListener("DOMContentLoaded", function () {
      actualizarVisibilidadFechas();
    });
  </script>
</body>

</html>