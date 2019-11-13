<!DOCTYPE html>
<html>

<head>
  <?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  $ids = $_GET["ids"];
  $ida = $_GET["ida"];
  $idp = $_GET["idp"];
  /* Codigo para obtener todas las dependencias  y sus relaciones */
  try {
    $area_stmn = $objetoPDO->prepare("SELECT id_subarea, nombre, ruta_perfil_puesto, ruta_atribucion, ruta_diagrama, area_perteneciente FROM sub_areas WHERE id_subarea = :ids;");
    $area_stmn->bindParam(":ids", $ids);
    $area_stmn->execute();
    $data_area = $area_stmn->fetchAll(PDO::FETCH_ASSOC);

  } catch (Throwable $e) {
    echo $e->getMessage();
  }
  ?>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper" id="bodyLoco">

    <?php
    include_once 'templates/barra.php';
    include_once 'templates/asidebar.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1 id="nombre_area"><?php echo $data_area[0]['nombre']; ?></h1>
        <h4><a href="<?php echo './perfiles-pdf/sub_areas/' . $data_area[0]['ruta_perfil_puesto']; ?>" target="_blank" id="perfil_puesto">Perfil de Puesto</a></h4>
        <h4><a href="<?php echo './atribuciones-pdf/sub_areas/' . $data_area[0]['ruta_atribucion']; ?>" target="_blank" id="atribuciones">Atribuciones</a></h4>
        <h4><a href="lista-procesos-subareas.php?ids=<?php echo $ids.'&ida='.$ida.'&idp='.$idp;?>">Procesos</a></h4>
      </section>
      <!-- Main content -->
      <section class="content">
        <input type="hidden" name="id_area" id="id_area" value="<?php echo $ida; ?>">
        <input type="hidden" name="id_depen" id="id_depen" value="<?php echo $idp; ?>">
        <input type="hidden" name="id_subarea" id="id_subarea" value="<?php echo $ids; ?>">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
          </div>
          <div class="box-body text-center animated slideInDown" id="chart-container">
            <!-- <ul id="ul-data" hidden></ul> -->
            <div class="row">
              <div class="col-lg-12" style="margin-bottom:5px;">
                <?php
                if (empty($data_area[0]['ruta_diagrama']) || is_null($data_area[0]['ruta_diagrama'])) {
                  $stmn = $objetoPDO->prepare("SELECT ruta_diagrama FROM dependencias WHERE id_dependencia = :id");
                  $stmn->bindParam(":id", $idp);
                  $stmn->execute();
                  $data = $stmn->fetchAll(PDO::FETCH_ASSOC);
                ?>
                  <img src="<?php echo './diagramas/'.$data[0]['ruta_diagrama'];?>" alt="..." class="img-thumbnail" id="diagrama">
                <?php } else { ?>
                  <img src="<?php echo './diagramas/sub_areas/' . $data_area[0]['ruta_diagrama']; ?>" alt="..." class="img-thumbnail" id="diagrama">
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="organigrama-area.php?ida=<?php echo $ida.'&idp='.$idp; ?>" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
          </div>
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
  <!-- <script src="js/jquery.orgchart.min.js"></script> -->
  <!-- AdminLTE for demo purposes -->
  <script src="js/demo.js"></script>
  <!-- EL Script que contiene todas las funciones de este modulo -->
  <script src="js/organigrama-area.js"></script>
</body>

</html>