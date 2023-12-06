<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detalles proyecto</title>
  <link rel="shortcut icon" href="../recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <style>

    #usuario_proyecto {
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
    <div class="col-10 border-left custom-form">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Proyectos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detalles Proyecto</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Detalles proyecto</h4>
      <div class="col-12 custom-form vh-80">
          <?php
            
            include ('../conexion.php');
            
            $sql = "SELECT * FROM ga_proyecto WHERE pk_id_proyecto=".$_GET['pk_id_proyecto'];
            $resultado = $conectar->query($sql);
            $row = $resultado->fetch_assoc();
            
          ?>
          <input type="hidden" class="form-control" name="IdProyecto" value="<?php echo $row['pk_id_proyecto'] ?>">
          <div class="row g-3">
            <div class="col-sm-12">
              <label id="ProyectoNombre" for="document" class="form-label">Nombre</label>
              <input name="ProyectoNombre" type="text" class="form-control" 
              value="<?php echo $row['proNombre']?>" disabled readonly>
            </div>
            <div class="col-sm-6">
            <label id="ProyectoMunicipio" for="document" class="form-label">Municipio</label>
              <input name="ProyectoMunicipio" type="text" class="form-control" 
              value="<?php echo $row['proMunicipio']?>" disabled readonly>
            </div>
            <div class="col-md-6">
              <label id="ProyectoDireccion" for="lastName" class="form-label">Direccion</label>
              <input name="ProyectoDireccion" type="text" class="form-control"
                value="<?php echo $row['proDireccion']?>" disabled readonly>
            </div>
            <div class="col-sm-12">
            <label id="ProyectoDescripcion" for="lastName" class="form-label">Descripcion</label>
            <input name="ProyectoDescripcion" type="text" class="form-control"
                value="<?php echo $row['proDescripcion']?>" disabled readonly>
            </div>
            <div class="col-6">
              <label for="FechaCreacion" class="form-label">Fecha de creacion</label>
              <div class="input-group has-validation">
                <input name="FechaCreacion" type="text" class="form-control"
                value="<?php echo $row['proFecha_creacion']?>" disabled readonly>
              </div>
            </div>
            <?php
            include ('../conexion.php');
            
            $sql = "SELECT ga_proyecto.*, ga_cliente.cliNombre 
                    FROM ga_proyecto 
                    INNER JOIN ga_cliente ON ga_proyecto.fk_id_cliente = ga_cliente.pk_id_cliente 
                    WHERE ga_proyecto.pk_id_proyecto=".$_GET['pk_id_proyecto'];
            
            $resultado = $conectar->query($sql);
            $row = $resultado->fetch_assoc();
            ?>
            <div class="col-md-6">
              <label id="ProyectoCliente" for="municipio" class="form-label">Cliente</label>
              <input name="ProyectoCliente" type="text" class="form-control"
              value="<?php echo $row['cliNombre']?>" disabled readonly>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
              <h4>Usuarios asignados</h4>
                  <ul class="list-group" id="usuario_proyecto" >
                  <?php
                  //Lista de Usuarios
                  include("../conexion.php");
                  $pk_id_proyecto = $_GET['pk_id_proyecto'];
                  $sql = $conectar->query("SELECT usuario.pk_id_usuario, CONCAT(usuario.usuNombre, ' ', usuario.usuApellido) AS nombre_completo 
                  FROM usuario 
                  INNER JOIN usuarios_proyectos ON usuario.pk_id_usuario = usuarios_proyectos.fk_id_usuario 
                  WHERE usuarios_proyectos.fk_id_proyecto = $pk_id_proyecto 
                  ORDER BY nombre_completo ASC");
                  while ($resultado = $sql->fetch_assoc()) {
                      echo '<div class="form-check">
                              <label class="form-check-label" for="checkbox' . $resultado['pk_id_usuario'] . '" disabled readonly>'. $resultado['nombre_completo'] . '</label>
                            </div>';
                  }
                  ?>
                  </ul>
              </div>
            </div>
            <div class="py-4">
              <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;"
              href="Proyecto_dashboard.php">Volver</a>
            </div>
            </div>
            </div>
            
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>