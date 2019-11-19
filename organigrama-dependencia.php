<!DOCTYPE html>
<html>

<head>
  <?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  $id = $_GET["id"];
  /* Codigo para obtener todas las dependencias  y sus relaciones */
  try {
    $dependenciaData =  $objetoPDO->prepare("SELECT id_dependencia,nombre, ruta_objetivo_general, ruta_perfil_puesto, ruta_atribuciones, ruta_diagrama,
    (SELECT count(*) FROM procesos_dependencias AS ps WHERE ps.dependencia_perteneciente = :id) AS noProcesos
    FROM dependencias WHERE id_dependencia = :id");
    $dependenciaData->bindParam(":id", $id);
    $dependenciaData->execute();
    $dependenciaData = $dependenciaData->fetchAll(PDO::FETCH_ASSOC);

    $stmn = $objetoPDO->prepare("SELECT a.id_area,a.nombre,depen.id_dependencia,depen.nombre AS mombre_depen,depen.ruta_objetivo_general,depen.ruta_perfil_puesto,depen.ruta_atribuciones FROM areas AS a INNER JOIN dependencias AS depen on a.dependencia_perteneciente = depen.id_dependencia WHERE a.dependencia_perteneciente = :id ORDER BY nombre ASC");
    $stmn->bindParam(":id", $id);
    $stmn->execute();
    $data = $stmn->fetchAll(PDO::FETCH_ASSOC);
    if (!$data) { ?>
      <div class="callout callout-danger">
        <h4>Esta dependencía no tiene direcciones</h4>
        <p>Por favor, agregarlas</p>
      </div>
    <?php } else { ?>

    <?php }
    } catch (Exception $e) { ?>
    <div class="callout callout-danger">
      <h4>Ocurrió un erro!</h4>
      <p><?php echo $e->getMessage(); ?></p>
    </div>
  <?php } ?>

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
        <h1 id="nombre_dependencia"><?php echo $dependenciaData[0]['nombre']; ?></h1>
        <ol class="breadcrumb">
          <li><a href="organigrama.php"><i class="fa fa-home"></i> Organigrama General</a></li>
          <li class="active"><?php echo $dependenciaData[0]["nombre"];?></li>
        </ol>
        <h4><a href="<?php echo './objetivos-pdf/generales/' . $dependenciaData[0]['ruta_objetivo_general']; ?>" target="_blank" id="objetivo_general">Objetivo General</a></h4>
        <h4><a href="<?php echo './perfiles-pdf/dependencias/' . $dependenciaData[0]['ruta_perfil_puesto']; ?>" target="_blank" id="perfil_puesto">Perfil de Puesto</a></h4>
        <h4><a href="<?php echo './atribuciones-pdf/dependencias/' . $dependenciaData[0]['ruta_atribuciones']; ?>" target="_blank" id="atribuciones">Atribuciones</a></h4>
        <?php if ( $dependenciaData[0]["noProcesos"] != "0" ) { ?> 
          <h4><a href="lista-procesos-dependencia.php?idp=<?php echo $dependenciaData[0]['id_dependencia']; ?>">Ver Procesos</a></h4>
        <?php } ?>
      </section>
      <!-- Main content -->
      <section class="content">
        <input type="hidden" name="id_area" id="id_area" value="<?php echo $id; ?>">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h4>Organigrama de la Dependencia</h4>
          </div>
          <div class="box-body text-center animated fadeIn" id="chart-container">
            <!-- <ul id="ul-data" hidden></ul> -->
            <div class="row">
              <div class="col-lg-10" style="margin-bottom:5px;">
                <img src="<?php echo './diagramas/' . $dependenciaData[0]['ruta_diagrama']; ?>" alt="..." class="img-thumbnail" id="diagrama">
              </div>
              <div class="col-lg-2">
                <div class="callout callout-success">
                  <h4>Direcciones</h4>
                </div>
                <?php
                try {
                  if ($data) {
                    foreach ($data as $row) { ?>
                      <a href="organigrama-area.php?ida=<?php echo $row['id_area'] . '&idp=' . $id; ?>" class="btn btn-default btn-block" style="margin-bottom:4px;white-space: normal;"><?php echo $row["nombre"]; ?></a>
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
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <div id="overlay"></div> 

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
  <!-- <script src="js/demo.js"></script> -->
  <!-- EL Script que contiene todas las funciones de este modulo -->
  <script src="js/organigrama-dependencia.js"></script>
  <script src="js/modal.js"></script>
</body>

</html>