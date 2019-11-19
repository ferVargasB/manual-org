<!DOCTYPE html>
<html>

<head>
  <?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  $id_proceso = $_GET["id"];
  $ida = 0;
  $idp = 0;
  if (isset($_GET['ida']) && isset($_GET['idp'])) {
    $ida = $_GET["ida"];
    $idp = $_GET["idp"];
  }
  ?>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <?php
    include_once 'templates/barra.php';
    include_once 'templates/asidebar.php';
    ?>
    <!-- CODIGO PHP -->
    <?php
    try {
      $stmt = $objetoPDO->prepare("SELECT p.id_proceso,p.nombre AS nombre_proceso,p.ruta_diagrama,p.ruta_ficha,p.numero_actores,p.area_perteneciente,pa.id_proceso,pa.id_actor,a.id_actor,a.nombre,a.es_director,a.ruta_atribucion FROM procesos as p INNER JOIN procesos_actores AS pa ON p.id_proceso = pa.id_proceso INNER JOIN actores AS a ON pa.id_actor = a.id_actor WHERE p.id_proceso = :id ORDER BY es_director DESC;");
      $stmt->bindParam(":id", $id_proceso);
      if ( !$stmt->execute() ) {
        echo "Something fail";
      }
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
    ?>
    <!-- FIN CODIGO PHP -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo $resultado[0]["nombre_proceso"]; ?>
          <small></small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <input type="hidden" name="id_proceso" id="id_proceso" value="<?php echo $id_proceso; ?>">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Diagrama</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-10 text-center animated zoomIn">
                <img src="<?php echo 'admin_area/' . $resultado[0]['ruta_diagrama']; ?>" alt="..." class="img-thumbnail" id="diagrama">
              </div>
              <div class="col-md-2 text-center">
                <h3>Actores</h3>
                <?php
                $contador = 0;
                foreach ($resultado as $row) {
                  if ($row["es_director"] == 1) { ?>
                    <button type="button" director-data="<?php echo $contador; ?>" class="btn btn-info btn-block" style="margin-bottom:4px;white-space: normal;" url-atri="<?php echo 'admin_area/' . $row['ruta_atribucion']; ?>"><?php echo $row["nombre"]; ?></button>
                  <?php } else { ?>
                    <button type="button" class="btn btn-secondary btn-block" style="margin-bottom:4px;white-space: normal;"><?php echo $row["nombre"]; ?></button>
                <?php }
                  $contador++;
                }
                ?>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <?php
              if ($ida != 0 && $idp != 0) { ?>
                <a href="lista-proceso-area.php?ida=<?php echo $ida; ?>&idp=<?php echo $idp; ?>" class="btn btn-primary active director" role="button" aria-pressed="true">Regresar</a>
              <?php } else { ?>
                <a href="lista-procesos.php" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
              <?php }
              ?>
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
  <script>
    $(document).ready(function() {
      $('.sidebar-menu').tree();
      var claseContent = $("content");
      claseContent.css("min-height", "");

      $("[director-data]").on("click", function() {
        var texto_seleccionado = $(this).text();
        var ruta_atribucion = $(this).attr("url-atri");
        //$("#exampleModalLabel").text(texto_seleccionado);
        $("#exampleModalLabel").text(texto_seleccionado);
        $("#atribucion_director").attr("href", ruta_atribucion);;
        $("#exampleModal").modal("show");
      });

    });
  </script>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Información del Actor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <a href="" id="atribucion_director" target="_blank">Ver Atribución</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>