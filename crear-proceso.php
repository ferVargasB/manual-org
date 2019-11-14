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
          Crear Proceso
          <small>Llenar el formulario para crear una proceso y añadir los actores involucrados</small>
        </h1>
        <h4 class="breadcrumb">Ruta</h4>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Proceso</h3>
          </div>
          <div class="box-body">
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelos/modelo-proceso.php" enctype="multipart/form-data">
              <div class="box-body" id="div_proceso">
                <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre del proceso" required>
                </div>
                <div class="form-group">
                  <label for="area_perteneciente">Área:</label>
                  <select name="area_perteneciente" id="area_perteneciente" class="form-control" required>
                    <!-- Codigo PHP  -->
                    <?php
                    try {
                      $stmt = $objetoPDO->prepare("SELECT id_area,nombre FROM areas ORDER BY nombre");
                      $stmt->execute();
                      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($resultado as $row) { ?>
                        <option value="<?php echo $row['id_area']; ?>"><?php echo $row["nombre"]; ?></option>
                    <?php }
                    } catch (Exception $th) {
                      throw $e->getMessage();
                    }
                    ?>
                    <!-- Codigo PHP -->
                  </select>
                </div>
                <div class="form-group">
                  <label for="diagrama">Cargar el diagrama:</label>
                  <input type="file" id="diagrama" name="diagrama" accept=".png">
                </div>
                <div class="form-group">
                  <label for="ficha">Cargar Ficha Técnica:</label>
                  <input type="file" id="ficha" name="ficha" accept=".pdf">
                </div>
                <div class="form-group">
                  <label for="numero_actores">Número de Actores:</label>
                  <select name="numero_actores" class="form-control" id="numero_actores">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                  </select>
                </div>
              </div>
              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary">Crear Proceso</button>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->

      <!-- Contenido de Actores-->
      <section class="content hidden" id="seccion_actores">
        <!-- Default box -->
        <input type="text" hidden value="" id="id_proceso">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Añadir Actores</h3>
          </div>
          <div class="box-body">
            <form role="form" name="guardar-actores" id="guardar-actores" method="post" action="modelos/modelo-proceso.php">
              <input type="hidden" id="id_proceso" id="id_proceso">
              <div class="form-group">
                <label for="nombre_proceso">Nombre del Proceso:</label>
                <input type="text" class="form-control" id="nombre_proceso" readonly>
              </div>
              <div class="form-group">
                <label for="nombre_area">Nombre del Área:</label>
                <input type="text" class="form-control" id="nombre_area" readonly>
              </div>
              <div class="form-group">
                <label for="link_diagrama">Diagrama:</label>
                <a href="" target="_blank" id="link_diagrama">Ver Diagrama</a>
              </div>
              <div class="form-group">
                <label for="link_ficha">Ficha Técnica:</label>
                <a href="" target="_blank" id="link_ficha">Ver Ficha Técnica</a>
              </div>
              <div class="form-group">
                <label for="numero_actores_lectura">Número de Actores:</label>
                <input type="text" id="numero_actores_lectura" class="form-control" readonly>
              </div>
            </form>
            <div id="div_actores">
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- Actores /.content -->
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

  <script src="js/proceso-ajax.js"></script>
</body>

</html>