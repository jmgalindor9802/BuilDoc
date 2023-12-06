<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tarea</title>
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

       
  
    </style>
</head>
<header>
  <?php include('../Header.php'); ?>
  </header>

<body >
    <!-- Encabezado de la pagina -->
 
    <div class="row flex-grow-1">
        <div class="col-lg-2">
            <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
            <?php include('../Menu.php'); ?>
        </div>
        <div class="col-10" style="padding-left: 5%; padding-right: 5%;">
            <nav aria-label="breadcrumb" class="d-flex align-items-center ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Tareas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear tarea</li>
                </ol>
            </nav>
            <h4 class="mb-3 ">Nueva tarea</h4>
            <div class="col-12 ">
                <br>

                <form class="needs-validation " style="max-height: 70vh;  overflow-y;" novalidate method="post" action="crear_tarea.php" >
                    <!-- INSERTAR PROYECTO CON LISTA DESPLEGABLE -->
                    <div class="row g-3 ">
                            <div class="col-sm-5" >
                                    <label for="proyectoSelect" class="form-label">Proyecto</label>
                                    <select  name="Proyecto_tarea" class="form-select" id="proyectoSelect" required onchange="cargarFases()">
                                        <option value="">Elegir...</option>
                                        <?php
                                        require('../conexion.php');

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
                                                echo "<option value='" . $row["pk_id_proyecto"] . "'>" . $row["proNombre"] . "</option>";
                                            }
                                        }
                                        ?>
                                        </select>

                                        <div class="invalid-feedback">
                                        Seleccione una fase.
                                        </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label for="faseSelect" class="form-label">Fase</label>
                                                    <select name="Fase_tarea" class="form-select" id="faseSelect" required data-proyecto-id="">
                                                        <option value="">Elegir...</option>
                                                    </select>

                                                    <div class="invalid-feedback">
                                                        Seleccione una fase.
                                                    </div>
                                                </div>
                                        </div>
                                    
                    <br>
                    <div class="row g-3">
                        <div class="col-sm-5">
                            <label for="Nombre_Tarea" class="form-label">Nombre de la
                                tarea</label>
                            <input name="Nombre_Tarea" type="text" class="form-control" id="Nombre_Tarea" placeholder="Nombre de la tarea"
                                required>
                            <div class="invalid-feedback">
                                Se requiere un nombre válido.
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label  for="fechaLimite" class="form-label">Fecha y hora
                                límite</label>
                            <input name="fechaLimite" type="datetime-local" class="form-control" id="fechaLimite" required>
                            <div class="invalid-feedback">
                                Seleccione una fecha y hora válida.
                            </div>
                            <div class="invalid-feedback" id="error-fecha-mensaje">
                                La fecha y hora límite debe ser posterior a la actual.
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row g-3">
                    <div class="col-sm-10">
                        <label for="descripcionTarea" class="form-label">Descripción</label>
                        <textarea name="descripcionTarea" class="form-control" id="descripcionTarea" rows="4"
                            placeholder="Descripción de la tarea" required maxlength="450"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripción válida.
                        </div>
                    </div>
                    </div>
                    <br>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select name="prioridad" class="form-select" id="prioridad" required>
                                <option value="">Seleccionar</option>
                                <option value="1">Alta</option>
                                <option value="2">Baja</option>
                            </select>
                            <div class="invalid-feedback">
                                Seleccione una prioridad.
                            </div>
                        </div>

                       
                    </div>
                    <br>
                   
                            <div class="row g-3" >
                                <div class="col-md-5">
                                    <h4>Asignar usuarios</h4>
                                    <ul class="list-group" style="max-height: 300px; overflow-y: auto;" >
                                    <?php
                                    //Lista de Usuarios
                                    include("../conexion.php");
                                    $sql = $conectar->query("SELECT pk_id_usuario, CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo 
                                    FROM usuario ORDER BY nombre_completo ASC");
                                    while ($resultado = $sql->fetch_assoc()) {
                                        echo '<div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="usuarios_tareas[]" value="' . $resultado['pk_id_usuario'] . '" id="checkbox' . $resultado['pk_id_usuario'] . '">
                                        <label class="form-check-label" for="usuarios_tareas' . $resultado['pk_id_usuario'] . '">' . $resultado['nombre_completo'] . '</label>
                                      </div>';
                                    }
                                    ?>
                                    </ul>
                                </div>
                                <div class="col-md-5" >
                                    <h4>Asignar tareas dependientes</h4>    
                                    <ul class="list-group" id="tasksContainer" style="max-height: 300px; overflow-y: auto;">
                                    </ul>
                                </div>
                            </div>   
                            <br> 
                            <div class="col-md-5">               
                            <!-- Botón "Guardar tarea" que abre el modal -->
                        <button class="btn btn-lg float-end custom-btn" id="guardarTareaButton"
                        style="font-size: 15px;">Guardar tarea</button>

                        <!-- Modal de confirmación -->
                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Confirmar envío</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas enviar el formulario?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary"
                                        id="confirmarModalButton">Confirmar</button>
                                </div>
                            </div>
                        </div>
                        </div>
                                        <!-- Modal de éxito -->
                                        <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                                        aria-labelledby="successModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    La tarea se ha creado exitosamente.
                                                </div>
                                            </div>

                                        </div>
                           
                        </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <!-- ... Tu script personalizado ... -->
<script src="crear_tarea.js"></script>
<script>

// Lógica para abrir el modal de confirmación
$('#guardarTareaButton').on('click', function (event) {
  // Evitar la redirección predeterminada
  event.preventDefault();
  // Lógica para abrir el modal
  $('#confirmModal').modal('show');
});

// Lógica para enviar el formulario cuando se confirma en el modal
$('#confirmarModalButton').on('click', function () {
  // Descomentar la siguiente línea si deseas enviar el formulario desde el modal
  $('form').submit();
  // Cerrar el modal de confirmación
  $('#confirmModal').modal('hide');
});
</script>

</body>

</html>