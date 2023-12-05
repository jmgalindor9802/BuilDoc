<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fase</title>
    <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <style>
    
        .custom-btn {
            background-color: #0074e4;
            color: #ffffff;
        }

      
    </style>

<header>
    <?php include('../Header.php'); ?>
</header>
</head>
<body>
    <!-- Encabezado de la pagina -->
    <div class="row ">
        <div class="col-lg-2">
            <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
            <?php include('../Menu.php'); ?>
        </div>
        <div class="col-lg-10" style="padding-left: 5%; padding-right: 5%;">
            <nav aria-label="breadcrumb" class="d-flex align-items-center  ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Tareas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear fase</li>
                </ol>
            </nav>
            <h4 class="mb-3">Nueva fase</h4>
            <div class="col-12  ">
                <br>
                <form action="create_fase.php" method="post" class="needs-validation " style="max-height: 70vh; " novalidate>
                    <!-- INSERTAR NOMBRE FASE -->
                    <div class="row g-3">   
                        <div class="col-sm-6">
                            <label  for="Nombre_fase" class="form-label">Nombre de la
                                fase</label>
                            <input name="Nombre_fase" type="text" class="form-control" id="Nombre_fase" placeholder="Nombre de la fase" required>
                            <div class="invalid-feedback">
                                Se requiere un nombre válido.
                            </div>
                        </div>
                        <!-- INSERTAR PROYECTO CON LISTA DESPLEGABLE -->
                        <div class="col-md-6">
                            <label for="country" class="form-label">Proyecto</label>
                            <select name="Proyecto_fase" class="form-select" id="country" required>
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
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["pk_id_proyecto"] . "'>" . $row["proNombre"] . "</option>";
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
                        <!-- DESCRIPCION DE LA FASE -->
                        <div class="row g-3">
                        <label  for="Descripcion_fase" class="form-label">Descripción</label>
                        <textarea name="Descripcion_fase" class="form-control" id="Descripcion_fase" rows="4" placeholder="Descripción de la fase" required maxlength="450"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripción válida.
                        </div>
                        </div>
                        <br>
                        <!-- Botón "Guardar fase" que abre el modal -->
                        <button class="btn btn-lg float-end custom-btn" id="guardarFaseButton"
                        style="font-size: 15px;">Guardar fase</button>

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
                                    La fase se ha creado exitosamente.
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

<!-- ... Bibliotecas jQuery y Bootstrap ... -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- ... Tu script personalizado ... -->
<script src="../crear_fase.js"></script>
<script>
$(document).ready(function () {
  $('#guardarFaseButton').on('click', function (event) {
       // Evitar la redirección predeterminada
       event.preventDefault();
    // Lógica para abrir el modal
    $('#confirmModal').modal('show');
  });
});
</script>

</body>


</html>