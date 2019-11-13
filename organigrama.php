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
          Organigrama General
          <small></small>
        </h1>
        <!-- <h4 class="breadcrumb">Ruta</h4> -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Para elegir una dependencia solo da click en la que deseas acceder. Además, puedes usar la rueda del ratón para hacer zoom.</h3>
          </div>
          <div class="box-body text-center animated slideInDown" id="chart-container">
            <div class="row">
              <div class="col-lg-10" style="margin-bottom:5px;">
                <img src="assets/img/organigrama_general.png" alt="..." class="img-thumbnail" id="diagrama">
              </div>
              <div class="col-lg-2 text-right">
                <div class="callout callout-success">
                  <h4>Dependencias</h4>
                </div>
                <!-- CODIGO EN PHP PARA OBTENER TODO EL CONTENIDO DE LA TABLA dependencias-->
                <?php

                try {
                  $stmt = $objetoPDO->prepare("SELECT id_dependencia, nombre FROM dependencias");
                  $stmt->execute();
                  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($resultado as $row) { ?>
                    <a href="organigrama-dependencia.php?id=<?php echo $row['id_dependencia']; ?>" class="btn btn-default btn-block" style="margin-bottom:4px;white-space: normal;"><?php echo $row["nombre"]; ?></a>
                  <?php }
                  } catch (Exception $e) { ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                    Ocurrió un error con el siguiente mensaje: <?php echo $e; ?>
                  </div>
                <?php } ?>
                <!-- FIN CODIGO PHP -->
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <!-- /.box-footer-->
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
  <!-- POPPER -->
  <script src="js/popper.min.js"></script>
  <!-- TOOLTIP -->
  <script src="js/tooltip.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="js/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="js/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>
  <!-- Orgchat -->
  <script src="js/jquery.orgchart.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="js/demo.js"></script>

  <script src="js/organigrama-general.js"></script>

</body>

</html>