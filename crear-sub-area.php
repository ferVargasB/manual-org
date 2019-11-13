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
        Crear Sub Área
        <small>llenar el formulario para crear una sub área y vincularla a una área</small>
      </h1>
      <h4 class="breadcrumb">Ruta</h4>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Crear Sub Área</h3>
        </div>
        <div class="box-body">
          <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelos/modelo-sub-area.php">
            <div class="box-body">
              <div class="form-group">
                <label for="usuario">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre de la sub área" required>
              </div>
              <div class="form-group">
                <label for="puesto">Área a la que pertenece:</label>
                <select name="area_perteneciente" id="area_perteneciente" required>
                <!-- Codigo PHP  -->
                <?php
                try {
                  $stmt = $objetoPDO->prepare("SELECT id_area,nombre FROM areas ORDER BY nombre");
                  $stmt->execute();
                  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach($resultado as $row)
                  {?>
                    <option value="<?php echo $row['id_area'];?>"><?php echo $row["nombre"];?></option>
                  <?php }
                } catch (\Throwable $th) {
                  //throw $th;
                }
                ?>
                <!-- Codigo PHP -->
                </select>
              </div>
              <div class="form-group">
                <label for="perfil-puesto">Cargar el diagrama de la sub área:</label>
                <input type="file" id="diagrama" name="diagrama" accept=".png">
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
              <button type="submit" class="btn btn-primary">Crear Sub Área</button>
               <a href="lista-sub-areas.php" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
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

<script src="js/area-ajax.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
