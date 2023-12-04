<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Actualizar proyecto</title>
  <link rel="shortcut icon" href="../recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <style>

    #usuario_proyecto_actualizar {
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
          <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Actualizar Proyecto</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Actualizar proyecto</h4>
      <div class="col-12 custom-form vh-80">
      <form id="formActualizarProyecto" class="needs-validation" method="post" action="actualizar_proyecto.php"
        onsubmit="actualizarProyecto()" novalidate>
        <?php
            
            include ('../conexion.php');
            
            $sql = "SELECT * FROM ga_proyecto WHERE pk_id_proyecto=".$_GET['pk_id_proyecto'];
            $resultado = $conectar->query($sql);
            $row = $resultado->fetch_assoc();
            
          ?>
          <input type="hidden" class="form-control" name="IdProyecto" value="<?php echo $row['pk_id_proyecto'] ?>">
          <div class="row g-3">
          <div class="col-sm-12">
              <label id="ActProNombre" for="document" class="form-label">Nombre</label>
              <input name="ActProNombre" type="text" class="form-control" 
              value="<?php echo $row['proNombre']?>">
            </div>
            <div class="col-sm-6">
            <label id="ActProMunicipio" for="document" class="form-label">Municipio</label>
              <input name="ActProMunicipio" type="text" class="form-control" 
              value="<?php echo $row['proMunicipio']?>">
            </div>
            <div class="col-md-6">
              <label id="ActProDireccion" for="lastName" class="form-label">Direccion</label>
              <input name="ActProDireccion" type="text" class="form-control"
                value="<?php echo $row['proDireccion']?>">
            </div>
            <div class="col-sm-12">
            <label id="ActProDescripcion" for="lastName" class="form-label">Descripcion</label>
            <input name="ActProDescripcion" type="text" class="form-control"
                value="<?php echo $row['proDescripcion']?>">
            </div>
            <div class="col-6">
              <label for="ActProFechaCreacion" class="form-label">Fecha de creacion</label>
              <div class="input-group has-validation">
                <input name="ActProFechaCreacion" type="text" class="form-control"
                value="<?php echo $row['proFecha_creacion']?>" disabled readonly>
              </div>
            </div>
            <div class="col-md-6">
              <label id="ActProRuta" for="municipio" class="form-label">Ruta</label>
              <input name="ActProRuta" type="text" class="form-control"
              value="<?php echo $row['proRuta']?>">
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
            <label id="Cliente" for="municipio" class="form-label">Cliente</label>
            <select name="ActProCliente" class="form-select" id="cliente" required>
                <option value=""><?php echo $row['cliNombre']?></option>
                <?php
                include ("../conexion.php");

                $sql = $conectar->query("SELECT * FROM ga_cliente ORDER BY cliNombre ASC");
                while ($resultado = $sql->fetch_assoc()) {

                echo "<option value='".$resultado['pk_id_cliente']."'>".$resultado
                ['cliNombre']."</option>";

                }
                ?>
            </select>
            </div>
            <div class="py-4">
              <button class="btn btn-lg float-start custom-btn" style="font-size: 15px;"
              type="submit">Actualizar
                proyecto</button>
              <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;"
              href="Proyecto_dashboard.php">Cancelar</a>
            </div>
           </div>
          </div>
        </div>
      </form>
    </div>
    </div>
  </div>

<script src="actualizar_proyecto_form.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>