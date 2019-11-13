<!DOCTYPE html>
<html>
<head>
	 <?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    ?>
<body  class="hold-transition skin-blue sidebar-mini">
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
    		Crear Actor
    		<small>Crear un actor y definir si lleva atribución</small>
    	</h1>
    	<h4 class="breadcrumb">Ruta</h4>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="alert alert-warning text-center">
                    Si el actor es un Director se deberá cargar su atribución
                </div>
            </div> 
             <div class="box-body">
                <form role="form" enctype="multipart/form-data" name="guardar-registro" id="guardar-registro" method="post" action="modelos/modelo-actor.php">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="usuario">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre del actor" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="es_director" name="es_director" value="0" onclick="mostrar_atribucion(this)">
                            <label class="form-check-label" for="es_director">¿Es Director?</label>
                        </div>
                        <div class="form-group hidden" id="div_atribucion">
                            <label for="atribucion">Cargar la atribución del Director</label>
                            <input type="file" class="form-control-file" id="atribucion" name="atribucion">
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="registro" value="nuevo">
                        <button type="submit" class="btn btn-primary">Crear Actor</button>
                        <a href="lista-actores.php" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
                    </div>
                </form>
             </div>
        </div>
    </section>

	</div> <!--fin content-wrapper-->
	<?php
    include_once 'templates/footer.php';
    ?>
</div> <!--fin wrapper-->
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

<script src="js/actor-ajax.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>