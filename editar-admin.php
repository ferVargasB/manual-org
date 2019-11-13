<!DOCTYPE html>
<html>
<head>
  <?php
    include_once 'funciones/sesiones.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/manual-org/funciones/funciones.php';
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
        Editar Administrador
        <small>Edite la información del administrador</small>
      </h1>
      <!-- <h4 class="breadcrumb">Ruta</h4> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Crear Administrador</h3>
        </div>
        <div class="box-body">
          <!-- CODIGO PHP PARA OBTENER LA INFORMACION DEL ID ACTUAL-->
          <?php
          try {
            $stmt = $objetoPDO->prepare("SELECT id_usuario,nombre,correo,password,puesto,rol FROM usuarios WHERE id_usuario= :id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $usuario_data = $stmt->fetch(PDO::FETCH_ASSOC);
          } catch (\Throwable $th) {
            //throw $th;
          }
          ?>
          <!-- FIN CODIGO PHP -->
          <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelos/modelo-admin.php">
            <div class="box-body">
              <div class="form-group">
                <label for="usuario">Nombre o Usuario:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre o usuario" value ="<?php echo $usuario_data["nombre"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="correo">Correo Eléctronico:</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Escriba el correo eléctronico" value ="<?php echo $usuario_data["correo"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value ="<?php echo $usuario_data["password"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="puesto">Puesto:</label>
                <select name="puesto" id="puesto" required>
                  <option value="director">Director</option>
                  <option value="jefe">Jefe</option>
                  <option value="recepcionista">Recepcionista</option>
                  <option value="contador">Contador</option>
                </select>
              </div>
              <div class="form-group">
                <label for="rol">Rol:</label>
                <select name="rol" id="rol" required>
                  <option value="funcionario">Funcionario</option>
                  <option value="webmaster">Webmaster (Admin)</option>
                </select>
              </div>
            </div>
            <div class="box-footer">
              <input type="hidden" name="registro" value="actualizar">
              <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
              <a href="lista-admin.php" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
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

<script src="js/admin-ajax.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
