<!DOCTYPE html>
<html>
<head>
  <?php
    include_once 'funciones/sesiones.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
    include_once 'templates/header.php';
    $id_proceso = $_GET["id"];

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
        Editar Proceso
        <small>Llenar el formulario para crear una proceso y añadir los actores involucrados</small>
      </h1>
      <!-- <h4 class="breadcrumb">Ruta</h4> -->
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Codigo PHP  -->
    <?php
    $resultado;
    $resultado_areas = 0;
    try {
      $stmt = $objetoPDO->prepare("SELECT id_proceso, nombre as nombreProceso, ruta_diagrama, ruta_ficha, numero_actores,
      area_perteneciente FROM procesos WHERE id_proceso = :id");
      $stmt->bindParam(":id",$id_proceso);
      if(!$stmt->execute()){
        throw new Exception("No se ejecutó el query");
      }
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      throw $e->getMessage();
    }
    ?>
    <?php
      try {
        $stmt = $objetoPDO->prepare("SELECT id_area,nombre FROM areas ORDER BY nombre");
        $stmt->execute();
        $resultado_areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$stmt->execute()) {
          throw new Exception("No se ejecutó el query");
        }
        $resultado_areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } 
      catch (Exception $e) {
         $e->getMessage();
      }
    ?>

    <!-- Codigo PHP -->

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Proceso</h3>
        </div>
        <div class="box-body">
        <input type="text" id="no_actores_actual" value="<?php echo $resultado[0]['numero_actores'];?>" hidden>
          <form enctype="multipart/form-data" name="actualizar-registro" id="actualizar-registro" method="post" action="modelos/modelo-proceso.php">
            <input type="hidden" id="id_proceso" name="id_proceso" value="<?php echo $id_proceso;?>">
            <div class="box-body" id="div_proceso">
              <div class="form-group">
                <label for="nombre">Nombre del Proceso</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder=""  value="<?php echo $resultado[0]["nombreProceso"];?>" required>
              </div>
              <div class="form-group">
                <label for="area_perteneciente">Área:</label>
                <select name="area_perteneciente" id="area_perteneciente" class="form-control" required >
                  <!-- Codigo PHP  -->
                  <?php 
                     foreach($resultado_areas as $row) {?>
                    <option value="<?php echo $row['id_area'];?>" <?php if($row["id_area"] == $resultado[0]["area_perteneciente"]){echo "selected";}?> ><?php echo $row["nombre"];?></option>
                  <?php }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label for="diagrama">Cargar el diagrama:</label>
                <input type="file" id="diagrama" name="diagrama" accept=".png">
                <br>
                <a href="<?php echo "admin_area/".$resultado[0]["ruta_diagrama"];?>" target="_blank">Ver Archivo</a>
                <input type="hidden" name="ruta_diagrama_actual" value="<?php echo $resultado[0]["ruta_diagrama"];?>">
              </div>
              <div class="form-group">
                <label for="ficha">Cargar Ficha Técnica:</label>
                <input type="file" id="ficha" name="ficha" accept=".pdf">
                <br>
                <a href="<?php echo "admin_area/".$resultado[0]["ruta_ficha"];?>" target="_blank">Ver Archivo</a>
                <input type="hidden" name="ruta_ficha_actual" value="<?php echo $resultado[0]["ruta_ficha"];?>">
              </div>
              <div class="form-group"> 
                <label for="numero_actores">Número de Actores:</label>
                <select name="numero_actores" class="form-control" id="numero_actores"> 
                <?php
                  for($contador = 0; $contador < 15; $contador++){
                    if($contador == $resultado[0]["numero_actores"])
                    { ?>
                      <option value="<?php echo $contador;?>" selected><?php echo $contador;?></option>
                    <?php } ?> 
                    <option value="<?php echo $contador;?>"><?php echo $contador;?></option>
                  <?php } 
                ?>
                </select>
              </div>
            </div>
            <div class="box-footer">
              <input type="hidden" name="registro" value="actualizar">
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->

   <!-- Contenido de Actores-->
   <section class="content" id="seccion_actores">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Añadir Actores</h3>
        </div>
        <div class="box-body">
          <form role="form" name="guardar-actores" id="guardar-actores" method="post" action="modelos/modelo-proceso.php">
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

<script src="js/editar_proceso_ajax.js"></script>
</body>
</html>
