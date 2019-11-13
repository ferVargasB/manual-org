<!DOCTYPE html>
<html>

<head>
  <?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  $id = $_GET['id'];
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
          Editar Dependencia
          <small></small>
        </h1>
        <!-- <h4 class="breadcrumb">Ruta</h4> -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">llenar el formulario para editar la dependencia</h3>
          </div>
          <div class="box-body">
            <!-- CODIGO PHP PARA OBTENER LA INFORMACION DE LA DEPENDENCIA -->
            <?php
            try {
              $stmt = $objetoPDO->prepare("SELECT id_dependencia,nombre,ruta_objetivo_general,ruta_perfil_puesto,ruta_atribuciones,ruta_diagrama FROM dependencias WHERE id_dependencia = :id");
              $stmt->bindParam(":id", $id);
              $stmt->execute();
              $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (\Throwable $th) {
              echo $th;
            }
            ?>
            <!-- FIN CODIGO PHP -->
            <form role="form" enctype="multipart/form-data" name="guardar-registro" id="guardar-registro" method="post" action="modelos/modelo-dependencia.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Nombre de la Dependencia:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $resultado[0]['nombre']; ?>" required>
                </div>
                <div class="form-group">
                  <label for="objetivo-general">Cargar el diagrama de la dependencia:</label>
                  <?php if (is_null($resultado[0]['ruta_diagrama']) || empty($resultado[0]['ruta_diagrama'])){ ?>
                    <div class="alert alert-danger" role="alert">No se ha cargado un diagrama para esta dependencia</div>
                  <?php } else { ?>
                    <a href="<?php echo './diagramas/'.$resultado[0]['ruta_diagrama']; ?>" target="_blank">Ver</a>
                    <input type="hidden" name="ruta_actual_diagrama" value="<?php echo $resultado[0]['ruta_diagrama']; ?>">
                  <?php } ?>
                  <input type="file" id="diagrama" name="diagrama" accept=".png">
                </div>
                <div class="form-group">
                  <label for="objetivo-general">Cargar el archivo del objetivo general:</label>
                  <a href="<?php echo './objetivos-pdf/generales/'.$resultado[0]['ruta_objetivo_general']; ?>" target="_blank">Ver</a>
                  <input type="file" id="objetivo-general" name="objetivo-general" accept=".pdf">
                  <input type="hidden" name="ruta_actual_objetivo" value="<?php echo $resultado[0]['ruta_objetivo_general']; ?>">
                </div>
                <div class="form-group">
                  <label for="perfil-puesto">Cargar el archivo del perfil de puesto:</label>
                  <a href="<?php echo './perfiles-pdf/dependencias/'.$resultado[0]['ruta_perfil_puesto']; ?>" target="_blank">Ver</a>
                  <input type="file" id="perfil-puesto" name="perfil-puesto" accept=".pdf">
                  <input type="hidden" name="ruta_actual_perfil" value="<?php echo $resultado[0]['ruta_perfil_puesto']; ?>">
                </div>
                <div class="form-group">
                  <label for="atribucion">Cargar el archivo de las atribuciones:</label>
                  <a href="<?php echo './atribuciones-pdf/dependencias/'.$resultado[0]['ruta_atribuciones']; ?>" target="_blank">Ver</a>
                  <input type="file" id="atribucion" name="atribucion" accept=".pdf">
                  <input type="hidden" name="ruta_actual_atribucion" value="<?php echo $resultado[0]['ruta_atribuciones']; ?>">
                </div>
              </div>
              <div class="box-footer">
                <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                <input type="hidden" name="registro" value="actualizar">
                <button type="submit" <?php if ($_SESSION['rol'] == 'funcionario') {
                                        echo "disabled";
                                      } ?> class="btn btn-primary">Guardar Cambios</button>
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
    $(document).ready(function() {
      $('.sidebar-menu').tree()
    })
  </script>
</body>

</html>