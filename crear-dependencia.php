<!DOCTYPE html>
<html>
<head>
  <?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
  ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php
    include_once 'templates/barra.php';
    include_once 'templates/asidebar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Dependencia
        <small></small>
      </h1>
      <h4 class="breadcrumb">Ruta</h4>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">llenar el formulario para crear una dependencia</h3>
        </div>
        <div class="box-body">
          <form role="form" enctype="multipart/form-data"  method="post" action="modelos/modelo-dependencia.php" id="guardar-registro">
            <div class="box-body">
              <div class="form-group">
                <label for="usuario">Nombre de la Dependencia:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="escriba el nombre" required>
              </div>
              <div class="form-group">
                <label for="objetivo-general">Cargar el diagrama de la dependencia:</label>
                <input type="file" id="diagrama" name="diagrama" accept=".png">
              </div>
              <div class="form-group">
                <label for="objetivo-general">Cargar el archivo del objetivo general:</label>
                <input type="file" id="objetivo-general" name="objetivo-general" accept=".pdf">
              </div>
              <div class="form-group">
                <label for="perfil-puesto">Cargar el archivo del perfil de puesto:</label>
                <input type="file" id="perfil-puesto" name="perfil-puesto" accept=".pdf">
              </div>
              <div class="form-group">
                <label for="atribucion">Cargar el archivo de las atribuciones:</label>
                <input type="file" id="atribucion" name="atribucion" accept=".pdf">
              </div>
            </div>
            <div class="box-footer">
              <input type="hidden" name="registro" value="nuevo">
              <button type="submit" class="btn btn-primary">Añadir</button>
               <a href="lista-dependencias.php" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php
    include_once 'templates/footer.php';
  ?>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script src="js/dependencia-ajax.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
