<!DOCTYPE html>
<html>

<head>
  <?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  $ida = $_GET["ida"];
  $idp = $_GET["idp"];
  /* Codigo para obtener todas las dependencias  y sus relaciones */
  try {
    $area_stmn = $objetoPDO->prepare("SELECT a.id_area, a.nombre, d.nombre AS depenNombre,a.dependencia_perteneciente, a.ruta_perfil_puesto, a.ruta_atribucion, a.ruta_diagrama FROM areas AS a
    INNER JOIN dependencias AS d
    ON a.dependencia_perteneciente = d.id_dependencia
    WHERE id_area = :id;");
    $area_stmn->bindParam(":id", $ida);
    $area_stmn->execute();
    $data_area = $area_stmn->fetchAll(PDO::FETCH_ASSOC);

    $stmn = $objetoPDO->prepare("SELECT sa.id_subarea, sa.nombre,sa.nombre,sa.ruta_perfil_puesto,sa.ruta_atribucion,sa.area_perteneciente,a.nombre as nombre_area,  a.ruta_perfil_puesto as perfil_area, a.ruta_atribucion as atribucion_area  FROM sub_areas as sa INNER JOIN areas as a on sa.area_perteneciente = a.id_area WHERE area_perteneciente = :id;");
    $stmn->bindParam(":id", $ida);
    $stmn->execute();
    $data = $stmn->fetchAll(PDO::FETCH_ASSOC);
    if (!$data) { ?>
  <?php }
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
        <ol class="breadcrumb">
          <li><a href="organigrama.php"><i class="fa fa-home"></i> Organigrama General</a></li>
          <li><a href="organigrama-dependencia.php?id=<?php echo $idp;?>"><i></i> <?php echo $data_area[0]["depenNombre"];?></a></li>
          <li class="active"><?php echo $data_area[0]["nombre"];?></li>
        </ol>
        <h4><a href="<?php echo './perfiles-pdf/areas/' . $data_area[0]['ruta_perfil_puesto']; ?>" target="_blank" id="perfil_puesto">Perfil de Puesto</a></h4>
        <h4><a href="<?php echo './atribuciones-pdf/areas/' . $data_area[0]['ruta_atribucion']; ?>" target="_blank" id="atribuciones">Atribuciones</a></h4>
        <h4><a href="lista-proceso-area.php?ida=<?php echo $ida; ?>&idp=<?php echo $idp; ?>">Procesos</a></h4>
      </section>
      <!-- Main content -->
      <section class="content">
        <input type="hidden" name="id_area" id="id_area" value="<?php echo $ida; ?>">
        <input type="hidden" name="id_depen" id="id_depen" value="<?php echo $idp; ?>">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
          </div>
          <div class="box-body text-center animated slideInDown" id="chart-container">
            <!-- <ul id="ul-data" hidden></ul> -->
            <div class="row">
              <div class="col-lg-10" style="margin-bottom:5px;">
                <?php
                if (empty($data_area[0]['ruta_diagrama']) || is_null($data_area[0]['ruta_diagrama'])) {
                  $stmn = $objetoPDO->prepare("SELECT ruta_diagrama FROM dependencias WHERE id_dependencia = :id");
                  $stmn->bindParam(":id", $idp);
                  $stmn->execute();
                  $data = $stmn->fetchAll(PDO::FETCH_ASSOC);
                ?>
                  <img src="<?php echo './diagramas/'.$data[0]['ruta_diagrama'];?>" alt="..." class="img-thumbnail" id="diagrama">
                <?php } else { ?>
                  <img src="<?php echo './diagramas/areas/' . $data_area[0]['ruta_diagrama']; ?>" alt="..." class="img-thumbnail" id="diagrama">
                <?php } ?>
              </div>
              <div class="col-lg-2">
                <div class="callout callout-success">
                  <h4>Sub Direcciones</h4>
                </div>
                <?php
                try {
                  if ($data) {
                    foreach ($data as $row) { ?>
                      <a href="organigrama-subarea.php?<?php echo 'ids='.$row['id_subarea'].'&ida='.$ida.'&idp='.$idp;?>" class="btn btn-default btn-block" style="margin-bottom:4px;white-space: normal;"><?php echo $row["nombre"]; ?></a> 
                <?php }
                  } else {
                    $respuesta = array(
                      "respuesta" => "no_existe"
                    );
                  }
                } catch (Throwable $e) {
                  echo $e->getMessage();
                }
                ?>

              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="organigrama-dependencia.php?id=<?php echo $idp; ?>" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
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