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

        .vh-80 {
            max-height: 80vh;
            overflow-y: auto;
        }

        .custom-form {
            padding-left: 8%;
            padding-right: 8%;
        }

        .custom-form-h4 {
            padding-left: 8%;
            padding-right: 8%;
            font-size: 15px;
        }


        .custom-nav {
            padding-left: 4%;
            padding-right: 4%;
        }
    </style>
</head>
<header>
  <?php include('../Header.php'); ?>
  </header>

<body style="height: 100vh; display: flex; flex-direction: column; overflow: hidden;">
    <!-- Encabezado de la pagina -->
 
    <div class="row flex-grow-1">
        <div class="col-lg-2">
            <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
            <?php include('../Menu.php'); ?>
        </div>
        <div class="col-10">
            <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Tareas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear tarea</li>
                </ol>
            </nav>
            <h4 class="mb-3 custom-form">Nueva tarea</h4>
            <div class="col-12 custom-form vh-80">
                <br>

                <form class="needs-validation " style="max-height: 70vh;" novalidate method="post">
                    <!-- INSERTAR PROYECTO CON LISTA DESPLEGABLE -->
                    <div class="row g-3">
                            <div class="col-sm-6">
                                    <label for="proyectoSelect" class="form-label">Proyecto</label>
                                    <select  name="Proyecto_tarea" class="form-select" id="proyectoSelect" required>
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
                            <div class="col-sm-6">
                            <label for="faseSelect" class="form-label">Fase</label>
                                    <select  name="Fase_tarea" class="form-select" id="faseSelect" required>
                                        <option value="">Elegir...</option>
                                        <?php
                                        include('../conexion.php');

                                        // Verificar la conexión
                                        if (!$conectar) {
                                            die("Conexión fallida: " . mysqli_connect_error());
                                        }
                                        
                                        // Consulta para obtener nombres e IDs de proyectos de la base de datos
                                        $sql = "SELECT pk_id_fase, fasNombre FROM gt_fase ORDER BY fasNombre";
                                        $result = mysqli_query($conectar, $sql);

                                        // Rellenar opciones del select con los resultados de la consulta
                                        if ($result && mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row["pk_id_fase"] . "'>" . $row["fasNombre"] . "</option>";
                                            }
                                        }
                                        ?>
                                        </select>

                                    <div class="invalid-feedback">
                                        Seleccione una fase.
                                    </div>
                            </div>
                    </div>
                   
                    <br>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label id="Nombre_Tarea" for="nombreTarea" class="form-label">Nombre de la
                                tarea</label>
                            <input type="text" class="form-control" id="nombreTarea" placeholder="Nombre de la tarea"
                                required>
                            <div class="invalid-feedback">
                                Se requiere un nombre válido.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label id="Fechalimite_tarea" for="fechaInicial" class="form-label">Fecha y hora
                                límite</label>
                            <input type="datetime-local" class="form-control" id="fechaInicial" required>
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
                        <label id="Descripcion_tarea" for="descripcionTarea" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionTarea" rows="4"
                            placeholder="Descripción de la tarea" required maxlength="450"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripción válida.
                        </div>
                    </div>
                    <br>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="state" class="form-label">Prioridad</label>
                            <select class="form-select" id="state" required>
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
                                <div class="col-md-6">
                                    <h4>Asignar usuarios</h4>
                                    <label for="usuario_tarea_disponible" class="form-label">Seleccione a quienes desea asignar a la tarea</label>
                                    <ul class="list-group" id="usuario_tarea_disponible" >
                                    <?php
                                    //Lista de Usuarios
                                    include("../conexion.php");
                                    $sql = $conectar->query("SELECT pk_id_usuario, CONCAT(usuNombre, ' ', usuApellido) AS nombre_completo 
                                    FROM usuario ORDER BY nombre_completo ASC");
                                    while ($resultado = $sql->fetch_assoc()) {
                                        echo '<div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="usuarios_tareas[]" value="' . $resultado['pk_id_usuario'] . '" id="checkbox' . $resultado['pk_id_usuario'] . '">
                                                <label class="form-check-label" for="checkbox' . $resultado['pk_id_usuario'] . '">' . $resultado['nombre_completo'] . '</label>
                                                </div>';
                                    }
                                    ?>
                                    </ul>
                                </div>
                                <div class="col-md-6" id="tasksContainer">
                                    <h4>Asignar tareas dependientes</h4>
                                    <label for="tarea_tarea_dependiente" class="form-label">Seleccione a quienes desea asignar a la tarea</label>
                                    <ul class="list-group" id="tarea_tarea_dependiente" >
                                    <?php
                                    //Lista de Usuarios
                                    include("../conexion.php");
                                    $id_fase_seleccionada = $_POST['Fase_tarea']; 
                                    $id_proyecto_seleccionado = $_POST['Proyecto_tarea'];
                                    
                                    // Llamada al procedimiento almacenado
                                        $sql = "CALL ListarTareasPorFaseYProyecto(?, ?)";
                                        $stmt = $conectar->prepare($sql);
                                        $stmt->bind_param('ii', $id_fase_seleccionada, $id_proyecto_seleccionado);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                    //Rellenar las opciones del select
                                    while ($resultado = $result->fetch_assoc()) {
                                        echo '<div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tarea_tarea_dependiente[]" value="' . $resultado['pk_id_tarea'] . '" id="checkbox' . $resultado['pk_id_tarea'] . '">
                                                <label class="form-check-label" for="checkbox' . $resultado['pk_id_tarea'] . '">' . $resultado['tarNombre'] . '</label>
                                                </div>';
                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>    

                           
                            <div class="py-4">
                                <button class="btn btn-lg float-end custom-btn" type="submit"
                                    style="font-size: 15px;">Guardar
                                    tarea</button>
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
    <script src="crear_tarea.js"></script>
</body>

</html>