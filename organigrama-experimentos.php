<!DOCTYPE html>
<html>
<head>
  <?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    $id = $_GET["id"];
  ?>
  <script src="js/paper-full.js"></script>
  <script type="text/paperscript" canvas="canvas">
	// Create a Paper.js Path to draw a line into it:
	var path = new Path();
	// Give the stroke a color
	path.strokeColor = 'black';
	var start = new Point(100, 100);
	// Move to start and draw a line from there
	path.moveTo(start);
	// Note the plus operator on Point objects.
	// PaperScript does that for us, and much more!
  path.lineTo(start + [ 100, -50 ]);
  
  // Create a circle shaped path with its center at the center
// of the view and a radius of 30:
var path = new Path.Circle({
	center: view.center,
	radius: 30,
	strokeColor: 'black'
});

function onResize(event) {
	// Whenever the window is resized, recenter the path:
	path.position = view.center;
}
var myPoint = new Point(10, 20); 
console.log(myPoint); // { x: 10, y: 
  var myPath = new Path();
myPath.add(myPoint);
</script>
</head>  
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
    <h1 id="nombre_dependencia">EXPERIMENTO ORGANIGRAMA GENERAL</h1>
  </section>
  <!-- Main content -->
  <section class="content">
  <input type="hidden" name="id_area" id="id_area" value="<?php echo $id;?>">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      </div>  
      <div class="box-body text-center animated slideInDown" id="div_canvas">
        <canvas id="canvas" stye="widht:100%;height:100%;" resize="true">

        </canvas>
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
<!-- EL Script que contiene todas las funciones de este modulo -->
<script src="js/experimentos.js"></script>

</body>
</html>
